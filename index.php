<?php
ini_set('display_errors','On');
error_reporting(-1);

define('VERSION', '0.0.1');

require 'controllers/presskit.php';
require 'helpers/errorhelper.php';
require 'helpers/updatehelper.php';

// detects if mod_rewrite is available
ViewHelper::$mod_rewrite = getenv('HTTP_MOD_REWRITE') == 'On' ? true : false;

// loads config file
if (!file_exists('config.php' )) {
	ErrorHelper::logError('Missing config.php, make a copy of config-sample.php to get started.');
	require 'config-sample.php';
} else {
	require 'config.php';
}

$requestUrl = $_SERVER['REQUEST_URI'];

// support for presskit legacy urls, also used when mod_rewrite is unavailable
if (isset($_GET['p']) && $_GET['p'] != ""){
	$requestUrl = $_GET['p'];
} else {
	// strip GET variables from URL
	if(($pos = strpos($requestUrl, '?')) !== false) {
		$requestUrl =  substr($requestUrl, 0, $pos);
	}

	// strip out the base path
	$requestUrl = str_replace(BASE_PATH, '', $requestUrl);

	// strip any leading/trailing slashes
	$requestUrl = trim($requestUrl, '/');
}

// if mod_rewrite is available and we're on a legacy url, redirect to the new, nicer one
if (ViewHelper::$mod_rewrite && isset($_GET['p'])){
	header("HTTP/1.1 301 Moved Permanently"); 
	header("Location: /" . BASE_PATH . '/' . $requestUrl); 
}

// checks for new updates and installs them if updates are enabled
if (UpdateHelper::check()){
	// if it did install updates, redirects to this page again to make sure nothing gets broken as files are changed
	header("Location: /" . BASE_PATH . '/' . $requestUrl . '?updated=1'); 
}

ob_start();

if(!ErrorHelper::hasErrors()){
	$presskit = new PresskitController();
}

if(!ErrorHelper::hasErrors()){
	if(isset($_POST['email'])){
		$presskit->email($requestUrl);
	} else if ($requestUrl == ''){
		$presskit->index();
	} else if ($requestUrl == 'credits'){
		$presskit->credits();
	} else {
		$presskit->game($requestUrl);
	}
}

$content = ob_get_contents();
ob_end_clean();

require 'views/' . ViewHelper::$template . '.php';
?>