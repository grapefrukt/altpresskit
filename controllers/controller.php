<?php 

require 'helpers/viewhelper.php';

class Controller {
	
	public $title = "Presskit";

	protected $view;

	public function __construct(){
		$this->view = new ViewHelper();
	}

	protected function parse($xmlpath){
		libxml_use_internal_errors(true);
		$xml = simplexml_load_file($xmlpath, 'SimpleXMLElement', LIBXML_NOCDATA);

		foreach (libxml_get_errors() as $error) {
			echo '<p>XML Error on line ', $error->line, ' column ', $error->column, ': ', $error->message, '</p>';
		}

		if(!$xml) die();

		return $this->xml2array($xml);
	}

	private static function xml2array ( $xmlObject, $out = array ()) {
		foreach ( (array) $xmlObject as $index => $node ){
			$index = Controller::dashesToCamelCase($index);
			$out[$index] = ( is_object ( $node ) ||  is_array ( $node ) ) ? Controller::xml2array ( $node ) : $node;
		}
		return $out;
	}

	// stolen from: http://stackoverflow.com/questions/2791998/convert-dashes-to-camelcase-in-php
	private static function dashesToCamelCase($string, $capitalizeFirstCharacter = false) {
		$str = str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));

		if (!$capitalizeFirstCharacter) {
			$str[0] = lcfirst($str[0]);
		}

		return $str;
	}
}
?>