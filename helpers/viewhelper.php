<?php

class ViewHelper {

	public function render($name, $vars){
		extract($vars);
		extract(array('view' => $this));
		include 'views/' . $name . '.php';
	}

	public function link($url, $text = ''){
		if($text == '') $text = $url;
		return '<a href="' . $url . '">' . $text . '</a>';
	}

	public function email($email, $text = ''){
		return $this->link('mailto:' . $email, $text == '' ? $email : $text);
	}

	public function callto($phone, $text = ''){
		return $this->link('callto:' . urlencode($phone), $text == '' ? $phone : $text);
	}
}

?>