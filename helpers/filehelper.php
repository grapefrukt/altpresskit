<?php

class FileHelper {

	private static $blacklist = array('.', '..', 'images', 'trailers');

	public static function getGames($path){
		if (!($handle = opendir($path))) return null;
		
		$dirs = array();

		while (false !== ($entry = readdir($handle))) {
			if (array_search($entry, FileHelper::$blacklist) !== false) continue;
			if ($entry == 'data.xml') continue;

			$dirs[] = $entry;
		}
		
		closedir($handle);
		
		return $dirs;
	}

}

?>