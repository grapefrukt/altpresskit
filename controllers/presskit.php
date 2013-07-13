<?php 
require 'controller.php';
require 'models/developer.php';

class PresskitController extends Controller {
	public function index(){
		$developer = new Developer($this->parse('data/developer.xml'));
		ViewHelper::render('index', array('developer' => $developer));
		ViewHelper::render('trailers', array('trailers' => $developer->trailers));
	}
}
?>