<?php 
require 'controller.php';
require 'models/developer.php';
require 'models/game.php';
require 'helpers/promoterhelper.php';

class PresskitController extends Controller {

	private $developer;

	public function __construct(){
		$this->developer = new Developer();
	}

	public function index(){
		ViewHelper::$title = 'presskit for ' . $this->developer->title;
		ViewHelper::$header = $this->developer->title;
		ViewHelper::render('devfacts', array('data' => $this->developer));
		ViewHelper::render('historydescription', array('data' => $this->developer));
		ViewHelper::render('images', array('data' => $this->developer));
		ViewHelper::render('trailers', array('trailers' => $this->developer->trailers));
		ViewHelper::render('additionals', array('data' => $this->developer));
		ViewHelper::render('teamcontact', array('data' => $this->developer, 'developer' => $this->developer));
	}

	public function game($directory){
		if(!isset($this->developer->games[$directory])){
			ErrorHelper::logError('Could not find game data in directory or incorrect BASE_PATH set in config.php');
		}

		$game = $this->developer->games[$directory];
		
		if(isset($game->promoter['product'])) {
			PromoterHelper::getData($game);
		}

		ViewHelper::$title = 'presskit for ' . $game->title . ' by ' . $this->developer->title;
		ViewHelper::$header = $game->title;
		ViewHelper::render('gamefacts', array('data' => $game, 'developer' => $this->developer));
		ViewHelper::render('historydescription', array('data' => $game));
		ViewHelper::render('images', array('data' => $game));
		ViewHelper::render('trailers', array('trailers' => $game->trailers));
		ViewHelper::render('awardspress', array('data' => $game));
		ViewHelper::render('teamcontact', array('data' => $game, 'developer' => $this->developer));
	}
}
?>