<?php
ini_set('display_errors','On');
error_reporting(-1);

require 'router/Router.php';
require 'router/Route.php';
require 'controllers/presskit.php';

$router = new Router();

$router->setBasePath('');

$router->map('/', array('controller' => 'PresskitController', 'action' => 'index'));
$router->map('/:id', array('controller' => 'PresskitController', 'action' => 'game'));

$route = $router->matchCurrentRequest();

ob_start();

if($route) { 
	/*?>
	<strong>Target:</strong>
	<pre><?php var_dump($route->getTarget()); ?></pre>

	<strong>Parameters:</strong>
	<pre><?php var_dump($route->getParameters()); ?></pre>

	<?php */
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