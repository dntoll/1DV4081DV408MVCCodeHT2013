<?php

namespace model;

require_once("AdressException.php");

class Adress {
	//@var String adressLine
	private $adressLine;

	public function __construct($adressLine) {
		if (strlen($adressLine) < 1) {
			throw new AdressException("not a correct adress");
		}

		$this->adressLine = $adressLine;

	}


	public function getAdress() {
		return $this->adressLine;
	}
}