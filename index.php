<?php
ini_set('display_errors','On');
error_reporting(-1);

define('VERSION', '0.1.3');

require 'controllers/presskit.php';
require 'helpers/errorhelper.php';

// convienience function to set constants if not defined, used in config files
function set($const, $value) { defined($const) || define($const, $value); }

// loads config file
if (!file_exists('config.php' )) {
	ErrorHelper::logError('Missing config.php, make a copy of config-defaults.php to get started.');
} else {
	require 'config.php';
}

// load defaults
require 'config-defaults.php';

// detects if mod_rewrite is available (or if force flag is set)
ViewHelper::$mod_rewrite = (FORCE_MOD_REWRITE == 'true' || getenv('HTTP_MOD_REWRITE') == 'On');

$requestUrl = $_SERVER['REQUEST_URI'];

// support for presskit legacy urls, also used when mod_rewrite is unavailable
if (isset($_GET['p']) && $_GET['p'] != ''){
	$requestUrl = $_GET['p'];
} else {
	// strip GET variables from URL
	if(($pos = strpos($requestUrl, '?')) !== false) {
		$requestUrl =  substr($requestUrl, 0, $pos);
	}

	// strip out the base path
	$requestUrl = str_replace(BASE_PATH, '', $requestUrl);

	// strip any leading slashes
	$requestUrl = ltrim($requestUrl, '/');

	// if mod_rewrite is available and the request doesn't end with a slash, redirect to one that does
	if (ViewHelper::$mod_rewrite && strlen($requestUrl) > 1 && substr($requestUrl, -1) != '/'){
		header('HTTP/1.1 301 Moved Permanently');
		header('Location: /' . BASE_PATH  . $requestUrl . '/');
		exit();
	}

	// strip any leading/trailing slashes
	$requestUrl = trim($requestUrl, '/');
}

// if mod_rewrite is available and we're on a legacy url, redirect to the new, nicer one
if (ViewHelper::$mod_rewrite && isset($_GET['p'])){
	header('HTTP/1.1 301 Moved Permanently');
	header('Location: /' . BASE_PATH . $requestUrl);
	exit();
}

ob_start();

if(!ErrorHelper::hasErrors()){
	$presskit = new PresskitController();
}

if(!ErrorHelper::hasErrors()){
	if ($requestUrl == ''){
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
