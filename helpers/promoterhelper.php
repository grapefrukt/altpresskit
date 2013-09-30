<?php 

class PromoterHelper {

	public static function getData($game){
		$data = PromoterHelper::simpleCachedCurl('http://promoterapp.com/dopresskit/' . $game->promoter['product'], PROMOTER_CACHE_DURATION);
		if($data == null) return;

		$promoterxml = simplexml_load_string($data);

		$promoter = XMLHelper::xml2array($promoterxml);
		XMLHelper::collapse($promoter, 'reviews', 'review');

		if (PROMOTER_OVERWRITE || !isset($game->quotes)) $game->quotes = array();

		foreach($promoter['reviews'] as $review){
			$game->quotes[] = array(
				'link' => 		 $review['url'],
				'description' => $review['quote'],
				'name' => 		 $review['reviewerName'],
				'website' => 	 $review['publicationName'],
			);
		}
	}

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
	private static function simpleCachedCurl($url, $expires, $debug = false){
		if (!function_exists('curl_version')){
			ErrorHelper::logError("Could not fetch promoter data, cURL unavailable");
			return null;
		} 

		if($debug){
			echo "simpleCachedCurl debug:<br>";
		}
		$hash = md5($url);
		$filename = dirname(__FILE__).'/../cache/' . $hash . '.cache';
		$changed = 0;
		if(file_exists($filename)) {
		  $changed = filemtime($filename);
		}
		$now = time();
		$diff = $now - $changed;   
		if ( $changed == 0 || ($diff > $expires) ) {
			if($debug){
				echo "no cache or expired --> make new request<br>";
			}
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$rawData = curl_exec($ch);
			curl_close($ch);
			if(!$rawData){
				if($debug){
					echo "cURL request failed<br>";
				}
				if($changed != 0){
					if($debug){
						echo "at least we have an expired cache --> better than nothing --> read it<br>";
					}
					$cache = unserialize(file_get_contents($filename));
					return $cache;
				}else{
					if($debug){
						echo "request failed and we have no cache at all --> FAIL<br>";
					}
					return false;
				}
			}
			if($debug){
				echo "we got a return --> save it to cache<br>";
			}
			$cache = fopen($filename, 'wb');
			$write = fwrite($cache, serialize($rawData));
			if($debug && !$write){
				echo "writing to $filename failed. Make the folder '".dirname(__FILE__).'/cache/'."' is writeable (chmod 777)<br>";
			}
			fclose($cache);
			return $rawData;
		}
		if($debug){
			echo "yay we hit the cache --> read it<br>";
		}
		$cache = unserialize(file_get_contents($filename));
		return $cache;
	}
}
?>