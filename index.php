<?php
ini_set('display_errors','On');
error_reporting(-1);

require 'controllers/presskit.php';
require 'helpers/errorhelper.php';

if (!file_exists('config.php' )) {
	ErrorHelper::logError('Missing config.php, make a copy of config-sample.php to get started.');
	require 'config-sample.php';
} else {
	require 'config.php';
}

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

if(!ErrorHelper::hasErrors()){
	$presskit = new PresskitController();
}

if(!ErrorHelper::hasErrors()){
	if($requestUrl == ''){
		$presskit->index();
	} else {
		$presskit->game($requestUrl);
	}
}

$content = ob_get_contents();
ob_end_clean();

require 'views/default.php';
?>