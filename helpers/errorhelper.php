<?php

class ErrorHelper {

	public static $warnings = array();
	public static $errors = array();

	public static function logError($text){
		ErrorHelper::$errors[] = $text;
	}

	public static function logWarning($text){
		ErrorHelper::$warnings[] = $text;
	}

	public static function logDebug($text){
		ErrorHelper::$warnings[] = $text;
	}

	public static function hasErrors(){
		return sizeof(ErrorHelper::$errors) > 0;
	}
}

?>