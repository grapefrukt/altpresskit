<?php

class UpdateHelper {

	const url = 'https://api.github.com/repos/grapefrukt/altpresskit/tags';

	public static function check($debug = false) {
		if (UPDATE_TYPE == 0) return;

		if (LoadHelper::hasCache(UpdateHelper::url, UPDATE_FREQUENCY)) {
			if ($debug) ErrorHelper::logDebug('Not checking for new version yet.');
			return;
		}
		
		$data = LoadHelper::loadCached(UpdateHelper::url, UPDATE_FREQUENCY - 1);
		if (!$data) {
			if ($debug) ErrorHelper::logDebug('No version data loaded from server');
			return;
		}
		
		$data = json_decode($data);
		
		$newest = null;
		foreach ($data as $tag) {
			if ($newest == null || UpdateHelper::isRemoteNewer($newest->name, $tag->name)) {
				$newest = $tag;
			}
		}
		
		if ($newest == null){
			if ($debug) ErrorHelper::logDebug('No tags loaded from server');
			return;	
		} 
		
		if ($debug) ErrorHelper::logDebug('Newest server version is: ' . $newest->name);
		
		$isNewer = UpdateHelper::isRemoteNewer(VERSION, $newest->name);
		
		if ($debug) ErrorHelper::logDebug($isNewer ? "remote newer" : "local newer or same");
	}

	private static function isRemoteNewer($localString, $remoteString){
		$local = explode('.', $localString);
		$remote = explode('.', $remoteString);
		
		for ($i = 0; $i < sizeof($local) && $i < sizeof($remote); $i++) {			
			if (intval($remote[$i]) > intval($local[$i])) return true;
		}
		
		return false;
	}

}

?>