<?php

class FileHelper {

	private static $blacklist = array('data.xml', 'images', 'trailers', 'README', 'Thumbs.db');

	public static function getGames($path){
		if (!($handle = @opendir($path))) return null;

		$dirs = array();

		while (false !== ($entry = readdir($handle))) {
			if (array_search($entry, FileHelper::$blacklist) !== false) continue;
			// folder starts with an underscore, ignore it
			if (substr($entry, 0, 1) === "_") continue;
			// folder starts with a period, ignore it
			if (substr($entry, 0, 1) === ".") continue;
			if ($entry == '') continue;

			$dirs[] = $entry;
		}

		closedir($handle);

		sort($dirs);

		return $dirs;
	}

	public static function getImages($path){
		if (!($handle = @opendir($path))) return null;

		$images = array();
		$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST); 
		foreach($objects as $location => $object){
			$name = $object->getFileName(); 

			// ignore all folders, they're not going in the image list
			if (!$object->isFile()) continue;
			// ignore any filename that hits the blacklist
			if (array_search($name, FileHelper::$blacklist) !== false) continue;
			// file starts with an underscore, ignore it
			if (substr($name, 0, 1) === "_") continue;
			// file starts with a period, ignore it
			if (substr($name, 0, 1) === ".") continue;

			// gets the folder name as relative to the current game
			$directory = str_replace($path, '', $object->getPath());

			// removes any leading slashes from the directory name
			$directory = ltrim($directory, DIRECTORY_SEPARATOR);

			$images[$directory][] = str_replace(DIRECTORY_SEPARATOR, '/', $location);
		}

		ksort($images);

		return $images;
	}

}

?>
