<?php
ini_set('display_errors','On');
error_reporting(-1);

require 'config.php';
require 'router/Router.php';
require 'router/Route.php';
require 'controllers/presskit.php';

$router = new Router();

$router->setBasePath(BASE_PATH);

$router->map(':id', array('controller' => 'PresskitController', 'action' => 'game'));
$router->map('/', array('controller' => 'PresskitController', 'action' => 'index'));

$route = $router->matchCurrentRequest();

ob_start();

if($route) { 
	$target = $route->getTarget();
	$controller = new $target["controller"]();
	
	call_user_func_array(array($controller, $target['action']), $route->getParameters());

} else { 
	echo '<pre>No route matched.</pre>';
} 

$content = ob_get_contents();
ob_end_clean();

require 'views/default.php';
?>