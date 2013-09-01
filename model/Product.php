<?php

namespace model;

class Product {

	/**
	* @var String code, supposed to be unique
	*/
	private $code;

	/** 
	* @param String code
	*/
	public function __construct($code) {
		$this->code = $code;
	}

	/**
	* @return String
	*/
	public function getCode() {
		return $this->code;
	}

	/**
	* @return String
	*/
	public function getName() {
		return $this->code;
	}
}