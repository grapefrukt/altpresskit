<?php

class ViewHelper {

	public static $title = 'presskit();';

	public static function render($name, $vars){
		extract($vars);
		include 'views/' . $name . '.php';
	}

	public static function link($url, $text = ''){
		if ($text == '') $text = $url;
		return '<a href="' . $url . '">' . $text . '</a>';
	}

	public static function email($email, $text = ''){
		return ViewHelper::link('mailto:' . $email, $text == '' ? $email : $text);
	}

	public static function callto($phone, $text = ''){
		return ViewHelper::link('callto:' . urlencode($phone), $text == '' ? $phone : $text);
	}

	public static function icon($name){
		return '<i class="icon-' . $name . ' icon-large"></i>';
	}
}

?>