<?php

class ViewHelper {

	public static $title = 'presskit();';
	public static $header = 'presskit();';
	public static $template = 'default';
	public static $isHome = false;
	public static $mod_rewrite = false;

	public static function render($name, $vars = array()){
		extract($vars);
		include 'views/' . $name . '.php';
	}

	public static function link($url, $text = '', $extra = ''){
		if ($text == '') $text = $url;
		return '<a href="' . $url . '" ' . $extra . '>' . $text . '</a>';
	}

	public static function linkProject($url, $text = '', $extra = ''){
		if ($text == '') $text = $url;
		if (!ViewHelper::$mod_rewrite) $url = 'sheet.php?p=' . trim($url, '/');
		return '<a href="' . $url . '" ' . $extra . '>' . $text . '</a>';
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

	public static function alphaomega($count, $offset = 0){
		if($offset) $count++;
		return $count % 2 == 0 ? 'alpha' : 'omega';
	}
}

?>
