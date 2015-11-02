<?php

require 'model.php';
require 'helpers/xmlhelper.php';

class Developer extends Model {
	
	public $games = array();

	public function __construct() {
		parent::__construct('', XMLHelper::parse('data/data.xml'));
		$this->isDeveloper = true;

		if ($this->data == null){
			ErrorHelper::logError('Failed to load developer data');	
			return;
		} 

		$gamedirs = FileHelper::getGames('data');
		foreach($gamedirs as $gamedir){
			$this->games[$gamedir] = new Game($gamedir);
		}
		
		// sorts the games according to the sort_order property
		// if no value is set, zero is assumed
		uasort($this->games, 'Developer::_sort');
	}
	
	private static function _sort($one, $two) {
		if ($one == $two) return 0;
		$orderOne = isset($one->sort_order) ? $one->sort_order : 0;
		$orderTwo = isset($two->sort_order) ? $two->sort_order : 0;
		
		return ($orderOne < $orderTwo) ? -1 : 1;
	}
}
?>