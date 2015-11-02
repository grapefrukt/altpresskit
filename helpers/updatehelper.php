<?php

class UpdateHelper {

	const url = 'https://api.github.com/repos/grapefrukt/altpresskit/tags';
	const tmp_path = 'update';
	const destination = '.';

	private static $new = null;
	public static $hasUpdate = false;
	public static $newVersion = '';

	public static function check($debug = false) {
		if (UPDATE_TYPE <= 0) {
			if ($debug) ErrorHelper::logDebug('Update checking disabled in config');
			return false;
		} 
		
		$data = LoadHelper::loadCached(UpdateHelper::url, UPDATE_FREQUENCY);
		if (!$data) {
			if ($debug) ErrorHelper::logDebug('No version data loaded from server');
			return false;
		}
		
		$data = json_decode($data);

		if ($data == null) {
			if ($debug) ErrorHelper::logDebug('No data returned from GitHub.');
			return false;
		}

		if (isset($data->message) && $data->message) {
			if ($debug) ErrorHelper::logDebug('Error from GitHub: ' . $data->message);
			return false;
		}
		
		foreach ($data as $tag) {
			if (UpdateHelper::$new == null || UpdateHelper::isRemoteNewer(UpdateHelper::$new->name, $tag->name)) {
				UpdateHelper::$new = $tag;
			}
		}
		
		if (UpdateHelper::$new == null){
			if ($debug) ErrorHelper::logDebug('No tags loaded from server');
			return false;	
		} 
		
		if ($debug) ErrorHelper::logDebug('Newest server version is: ' . UpdateHelper::$new->name);
		if ($debug) ErrorHelper::logDebug('Local version is: ' . VERSION);
		
		UpdateHelper::$newVersion = UpdateHelper::$new->name;
		UpdateHelper::$hasUpdate = UpdateHelper::isRemoteNewer(VERSION, UpdateHelper::$new->name);

		if ($debug) ErrorHelper::logDebug(UpdateHelper::$hasUpdate ? "Remote newer" : "Local newer or same");

		if (UPDATE_TYPE <= 1 || !UpdateHelper::$hasUpdate) return false;
		
		$installedUpdate = UpdateHelper::install($debug);

		return $installedUpdate;
	}

	private static function install($debug = false) {
		if (!extension_loaded('zip') ) {
			ErrorHelper::logWarning('zip extensions unavailable on server, can\'t extract updates without it');
			return;
		}

		LoadHelper::loadCached(UpdateHelper::$new->zipball_url, 1000, $debug);

		$zip = new ZipArchive();
		if ($zip->open(LoadHelper::getFilename(UpdateHelper::$new->zipball_url)) === TRUE) {

			// make sure temp directory is empty
			UpdateHelper::removeTemp();

			$success = $zip->extractTo(LoadHelper::getCacheDir() . UpdateHelper::tmp_path);

			$zip->close();

			if ($debug) ErrorHelper::logDebug('Update archive ' . ($success ? 'extracted successfully' : 'failed to extract'));
		} else {
			if ($debug) ErrorHelper::logWarning('Failed extracting update archive');
			return;
		}

		// updates from github are packed in a folder within the zip, we need the name of this folder
		$rootFolder = '';

		$iterator = UpdateHelper::getUpdateIterator(false);
		foreach ($iterator as $item) {

			// the first folder we hit when iterating will be the root folder, save that
			if ($item->isDir() && $rootFolder == '') {
				$rootFolder = $iterator->getSubPathName();
				if ($debug) ErrorHelper::logDebug('Update root folder is ' . $rootFolder);

				// we won't ever need to create the root folder, so we skip to the next item
				continue;
			} 

			// figure out destination path
			$destination = realpath(UpdateHelper::destination . UpdateHelper::removePrefix($iterator->getSubPathName(), $rootFolder));

			if ($item->isDir()) {
				if (file_exists($destination)) continue;
				
				if ($debug) ErrorHelper::logDebug('Create directory ' . $destination);
				mkdir($destination);
			} else {
				$success = copy($item, $destination);
				if ($debug) ErrorHelper::logDebug('Copy file from ' . $item . ' to ' . $destination . ($success ? ' OK' : ' Failed'));
			}
		}

		// remove any temporary files extracted in the process
		UpdateHelper::removeTemp();

		// remove the update zip file, we won't need it anymore
		unlink(LoadHelper::getFilename(UpdateHelper::$new->zipball_url));

		return true;
	}

	private static function removePrefix($str, $prefix) {
		if (substr($str, 0, strlen($prefix)) == $prefix) {
			$str = substr($str, strlen($prefix));
		}
		return $str;
	}

	private static function removeTemp(){
		// make sure update directory exists before trying to clear it
		if (!file_exists(UpdateHelper::getTempPath())) {
			mkdir(UpdateHelper::getTempPath(), 0777, true);
		}

		// recursively delete everything in update folder
		foreach (UpdateHelper::getUpdateIterator(true) as $item) {
			if ($item->isDir()) {
				//if ($debug) ErrorHelper::logDebug('rmdir ' . $item->getRealPath());
				rmdir($item->getRealPath());
			} else {
				//if ($debug) ErrorHelper::logDebug('unlink ' . $item->getRealPath());
				unlink($item->getRealPath());
			}
		}
	}

	private static function getUpdateIterator($childFirst) {
		// deleting needs to be child first, copying self first
		$mode = ($childFirst ? RecursiveIteratorIterator::CHILD_FIRST : RecursiveIteratorIterator::SELF_FIRST);
		return new RecursiveIteratorIterator(new RecursiveDirectoryIterator(UpdateHelper::getTempPath(), RecursiveDirectoryIterator::SKIP_DOTS), $mode);
	}

	private static function getTempPath() {
		return realpath(LoadHelper::getCacheDir() . UpdateHelper::tmp_path);
	}

	private static function isRemoteNewer($localString, $remoteString){
		$local = explode('.', $localString);
		$remote = explode('.', $remoteString);
		
		for ($i = 0; $i < sizeof($local) && $i < sizeof($remote); $i++) {
			$diff = intval($remote[$i]) - intval($local[$i]);
			
			// local is smaller
			if ($diff > 0) return true;
			// remote is smaller
			else if ($diff < 0) return false;
			// else, they're the same and we keep on trying
		}
		
		return false;
	}

}

?>