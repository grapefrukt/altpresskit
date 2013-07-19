<?php
ini_set('display_errors','On');
error_reporting(-1);

require 'config.php';
require 'controllers/presskit.php';
require 'helpers/errorhelper.php';

$requestUrl = $_SERVER['REQUEST_URI'];

// strip GET variables from URL
if(($pos = strpos($requestUrl, '?')) !== false) {
	$requestUrl =  substr($requestUrl, 0, $pos);
}

// strip out the base path
$requestUrl = str_replace(BASE_PATH, '', $requestUrl);

// strip any leading/trailing slashes
$requestUrl = trim($requestUrl, '/');

ob_start();

$presskit = new PresskitController();
if($requestUrl == ''){
	$presskit->index();
} else {
	$presskit->game($requestUrl);
}

$content = ob_get_contents();
ob_end_clean();

require 'views/default.php';
?>