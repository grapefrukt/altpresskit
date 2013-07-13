<?php 
class Controller {
	
	public $title = "Presskit";	

	protected function render($view, $vars){
		extract($vars);
		include 'views/' . $view . '.php';
	}
}
?>