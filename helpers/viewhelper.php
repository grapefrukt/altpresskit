<?php

class ViewHelper {

	public function render($name, $vars){
		extract($vars);
		extract(array('view' => $this));
		include 'views/' . $name . '.php';
	}

	public function link($url){
		echo '<a href="', $url, '">', $url, '</a>';
	}
}

?>