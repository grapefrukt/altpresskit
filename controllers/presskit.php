<?php
require 'controller.php';
require 'models/developer.php';
require 'models/game.php';

class PresskitController extends Controller {

	public $developer;

	public function __construct(){
		$this->developer = new Developer();
	}

	public function index(){
		ViewHelper::$isHome = true;
		ViewHelper::$title = 'presskit for ' . $this->developer->title;
		ViewHelper::$header = $this->developer->title;
		ViewHelper::$headerImage = $this->developer->icon;
		ViewHelper::render('devfacts', array('data' => $this->developer));
		ViewHelper::render('historydescription', array('data' => $this->developer));
		ViewHelper::render('images', array('data' => $this->developer));
		ViewHelper::render('trailers', array('trailers' => $this->developer->trailers, 'directory' => ''));
		ViewHelper::render('additionals', array('data' => $this->developer));
		ViewHelper::render('teamcontact', array('data' => $this->developer, 'developer' => $this->developer));
	}

	public function game($directory){
		if(!isset($this->developer->games[$directory])){
			ErrorHelper::logError('Could not find game data in directory or incorrect BASE_PATH set in config.php');
			$this->fourohfour();
			return;
		}

		$game = $this->developer->games[$directory];

		ViewHelper::$title = 'presskit for ' . $game->title . ' by ' . $this->developer->title;
		ViewHelper::$header = $game->title;
		ViewHelper::$headerImage = "../" . $game->icon;
		ViewHelper::$headerColor = $game->color;
		ViewHelper::render('gamefacts', array('data' => $game, 'developer' => $this->developer));
		ViewHelper::render('historydescription', array('data' => $game));
		ViewHelper::render('awards', array('data' => $game));
		ViewHelper::render('trailers', array('trailers' => $game->trailers, 'directory' => $directory));
		ViewHelper::render('images', array('data' => $game));
		ViewHelper::render('additionals', array('data' => $game));
		ViewHelper::render('presscopy', array('data' => $game));
		ViewHelper::render('about', array('data' => $this->developer));
		ViewHelper::render('teamcontact', array('data' => $game, 'developer' => $this->developer));
	}

	public function credits(){
		ViewHelper::$title = ViewHelper::$header = 'alt. presskit credits';
		ViewHelper::render('credits');
	}

	public function fourohfour(){
		http_response_code(404);
		ViewHelper::$title = 'presskit for ' . $this->developer->title . ' - error';
		ViewHelper::$header = '404';
		ViewHelper::render('404');
	}
}
?>
