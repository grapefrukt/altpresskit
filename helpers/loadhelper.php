<?php

class LoadHelper {

/*
	simpleCachedCurl V1.1
	Dirk Ginader
	ginader.com

	code: http://github.com/ginader

	easy to use cURL wrapper with added file cache

	usage: created a folder named "cache" in the same folder as this file and chmod it 777
	call this function with 3 parameters:
		$url (string) the URL of the data that you would like to load
		$expires (integer) the amound of seconds the cache should stay valid
		$debug (boolean, optional) write debug information for troubleshooting
		
	returns either the raw cURL data or false if request fails and no cache is available

	*/

	private static $error = null;

	public static function loadCached($url, $expires, $debug = false){
		if (!function_exists('curl_version')){
			ErrorHelper::logWarning('Could not fetch data, cURL unavailable');
			return null;
		}
		
		if ($debug) ErrorHelper::logDebug('cURL for: ' . $url);
		$filename = LoadHelper::getFilename($url);
		
		if (!LoadHelper::hasCache($url, $expires)) {
			if ($debug) ErrorHelper::logDebug('No cache or expired, making new request');

			$rawData = LoadHelper::load($url);
			
			if (!$rawData) {
				if ($debug) ErrorHelper::logDebug('cURL request failed: ' . LoadHelper::$error);
				if (LoadHelper::hasCache($url, -1)){
					if ($debug) ErrorHelper::logDebug('Using expired cache');
					$cache = file_get_contents($filename);
					return $cache;
				} else {
					if ($debug) ErrorHelper::logDebug('Request failed, no cache');
					return false;
				}
			}

			if ($debug) ErrorHelper::logDebug('Data returned, saving it to cache');

			$folder = LoadHelper::getCacheDir();
			if (!file_exists($folder)) mkdir($folder);

			$cache = @fopen($filename, 'wb');
			$write = $cache ? fwrite($cache, $rawData) : null;

			if (!$write) ErrorHelper::logWarning('Writing to cache failed. Make sure the folder ' . $folder . ' exists and is writeable (chmod 777)');

			if ($cache) fclose($cache);
			return $rawData;
		}

		if ($debug) ErrorHelper::logDebug('Cache hit, using that');

		return file_get_contents($filename);
	}

	/** checks for cache of specified url
	*	$expires is expiration time in seconds, put a negative value to never expire
	*/
	public static function hasCache($url, $expires){
		$filename = LoadHelper::getFilename($url);
		$changed = 0;

		if (!file_exists($filename)) return false;

		if ($expires < 0) return true;

		$changed = filemtime($filename);
		$now = time();
		$diff = $now - $changed;

		return $diff < $expires;
	}

	public static function load($url){
		LoadHelper::$error = "";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, 'altpresskit');

		/*
		ErrorHelper::logDebug(LoadHelper::getFilename('log'));
		$log = fopen(LoadHelper::getFilename('log'), "w+");
		curl_setopt($ch, CURLOPT_VERBOSE, true);
		curl_setopt($ch, CURLOPT_STDERR, $log);
		*/

		// we need to load custom https certificates here to be able to load from github securely
		curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__).'/cert/cacert.pem');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1); 
		
		$rawData = curl_exec($ch);

		LoadHelper::$error = curl_error($ch); // . "\n" + fread($log, filesize(LoadHelper::getFilename('log')));

		curl_close($ch);

		return $rawData;
	}

	public static function getFilename($url) {
		return LoadHelper::getCacheDir() . md5($url) . '.cache';
	}

	public static function getCacheDir() {
		return dirname(__FILE__) . '/../cache/';
	}
}
?>