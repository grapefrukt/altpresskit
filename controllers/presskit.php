<?php 
require 'controller.php';
require 'models/developer.php';
require 'models/game.php';

class PresskitController extends Controller {
	public function index(){
		$developer = new Developer();

		ViewHelper::render('index', array('developer' => $developer));
		ViewHelper::render('images', array('images' => $developer->images));
		ViewHelper::render('trailers', array('trailers' => $developer->trailers));
	}
}
?>