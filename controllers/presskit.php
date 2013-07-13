<?php 
require 'controller.php';

class Presskit extends Controller {
	public function index($id = 3){
		$this->render('index', array("id" => $id));
	}
}
?>