<?php 
require 'controller.php';
require 'models/developer.php';
require 'models/game.php';

class PresskitController extends Controller {

	private $developer;

	public function __construct(){
		$this->developer = new Developer();
	}

	public function index(){
		ViewHelper::render('devfacts', array('data' => $this->developer));
		ViewHelper::render('historydescription', array('data' => $this->developer));
		ViewHelper::render('images', array('images' => $this->developer->images));
		ViewHelper::render('trailers', array('trailers' => $this->developer->trailers));
		ViewHelper::render('additionals', array('data' => $this->developer));
		ViewHelper::render('teamcontact', array('data' => $this->developer, 'developer' => $this->developer));
	}

	public function game($directory){
		$game = $this->developer->games[$directory];
		ViewHelper::render('gamefacts', array('data' => $game, 'developer' => $this->developer));
		ViewHelper::render('historydescription', array('data' => $game));
		ViewHelper::render('images', array('images' => $game->images, 'logo' => $game->logo, 'zip' => $game->imageZip));
		ViewHelper::render('trailers', array('trailers' => $game->trailers));
		ViewHelper::render('awardspress', array('data' => $game));
		ViewHelper::render('teamcontact', array('data' => $game, 'developer' => $this->developer));
	}
}
?>