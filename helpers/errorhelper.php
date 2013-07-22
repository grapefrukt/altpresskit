<?php

class ErrorHelper {

	public static $errors = array();

	public static function logError($text){
		ErrorHelper::$errors[] = $text;
	}

	public static function hasErrors(){
		return sizeof(ErrorHelper::$errors) > 0;
	}
}

?>