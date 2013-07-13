<?php 
require 'controller.php';
require 'models/developer.php';
require 'helpers/xmlhelper.php';

class PresskitController extends Controller {
	public function index(){
		$developer = new Developer(XMLHelper::parse('data/data.xml'));
		ViewHelper::render('index', array('developer' => $developer));
		ViewHelper::render('trailers', array('trailers' => $developer->trailers));
	}
}
?>