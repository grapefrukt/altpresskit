<?php

require 'helpers/filehelper.php';

class Model {
	
	protected $data;

	public $isDeveloper = false;

	public $images = array();	
	public $logo;

	public $logoZip;
	public $imageZip;

	public function __construct($directory, $data) {
		$this->data = $data;
		$this->images = FileHelper::getImages('data' . (strlen($directory) > 0 ? '/' : '') . $directory . '/images');

		if($this->images != null) {
			foreach($this->images as $key => $image){
				if (Model::endsWith($image, 'logo.png')) {
					$this->logo = $image;
					unset($this->images[$key]);
				}

				if (Model::endsWith($image, 'images.zip')) {
					$this->imageZip = $image;
					unset($this->images[$key]);
				}

				if (Model::endsWith($image, 'logo.zip')) {
					$this->logoZip = $image;
					unset($this->images[$key]);
				}
			}
		}
	}

	public function __get($param) {
		if (isset($this->data[$param])) {
			return $this->data[$param];
		} else {
			return null;
		}
	}

	public function __isset($param) {
		return isset($this->data[$param]);
	}

	private static function endsWith($haystack, $needle) {
		$length = strlen($needle);
		if ($length == 0) {
			return true;
		}

		return (substr($haystack, -$length) === $needle);
	}
}
?>