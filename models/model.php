<?php

require 'helpers/filehelper.php';

class Model {
	
	private $data = array();
	public $images = array();

	public function __construct($directory, $data) {
		$this->data = $data;
		$this->images = FileHelper::getImages('data/' . $directory . '/images');
	}

	public function __get($param) {
		if (isset($this->data[$param])) {
			return $this->data[$param];
		} else {
			return null;
		}
	}

	public function __isset($param) {
		return isset($this->data[$param]);
	}
}
?>