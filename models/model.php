<?php
class Model {
	
	private $data = array();

	public function __construct($data) {
		$this->data = $data;
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