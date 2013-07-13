<?php

require_once 'model.php';

class Game extends Model {
	public function __construct($directory) {
		parent::__construct($directory, XMLHelper::parse('data/' . $directory . '/data.xml'));
	}
}
?>