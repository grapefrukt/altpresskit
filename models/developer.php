<?php

require 'model.php';

class Developer extends Model {
	
	public $games;

	public function __construct($data) {
		parent::__construct($data);
		$games = array();
	}

}
?>