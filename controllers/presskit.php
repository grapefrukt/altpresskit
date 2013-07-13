<?php 
require 'controller.php';
require 'models/developer.php';

class PresskitController extends Controller {
	public function index($id = 3){
		$developer = new Developer($this->parse('data/developer.xml'));
		$this->view->render('index', array('id' => $id, 'developer' => $developer));
	}
}
?>