<?php

require_once 'model.php';

class Game extends Model {

	public $directory;

	public function __construct($directory) {
		parent::__construct($directory, XMLHelper::parse('data/' . $directory . '/data.xml'));
		if ($this->data == null) ErrorHelper::logError('Failed to load game data in ' . $directory);
		$this->directory = $directory;
	}
}
?>