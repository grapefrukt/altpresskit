<?php

class FileHelper {

	private static $blacklist = array('.', '..', 'data.xml', 'images', 'trailers', 'README', 'Thumbs.db', '.DS_Store');

	public static function getGames($path){
		if (!($handle = @opendir($path))) return null;
		
		$dirs = array();

		while (false !== ($entry = readdir($handle))) {
			if (array_search($entry, FileHelper::$blacklist) !== false) continue;
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

		while (false !== ($entry = readdir($handle))) {
			if (array_search($entry, FileHelper::$blacklist) !== false) continue;
			if (!is_file($path . '/' . $entry)) continue;
			$images[] = $path . '/' . $entry;
		}
		
		closedir($handle);

		sort($images);
		
		return $images;
	}

}

?>