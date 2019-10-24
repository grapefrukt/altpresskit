<?php

class ViewHelper {

	public static $title = 'presskit();';
	public static $header = 'presskit();';
	public static $headerImage = '';
	public static $headerColor = '';
	public static $template = 'default';
	public static $isHome = false;
	public static $mod_rewrite = false;

	public static function render($name, $vars = array()){
		extract($vars);
		include 'views/' . $name . '.php';
	}

	public static function link($url, $text = '', $extra = ''){
		// if no link text is supplied, we use the url
		if ($text == '') {
			$text = $url;
			// strips out the http/https at the start of the url
			$text = preg_replace('/^http(s)?:\/\//', '', $text);
		}
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
		return '<i class="icon-' . $name . ' icon-large">&nbsp;</i>';
	}

	public static function alphaomega($count, $offset = 0, $modulo = 2){
		if ($offset) $count++;
		$rest = $count % $modulo;
		if ($rest === 0) return 'alpha';
		if ($rest === $modulo - 1) return 'omega';
		return '';
	}
}

?>
