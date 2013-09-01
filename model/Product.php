<?php

namespace model;

class Product {

	/**
	* @var String code, supposed to be unique
	*/
	private $code;

	/**
	* @var Integer price in $
	*/
	private $priceSEK;

	/** 
	* @param String code
	*/
	public function __construct($code, $priceSEK) {
		$this->code = $code;
		$this->priceSEK = $priceSEK;
		
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

	/**
	* @return float
	*/
	public function getPriceSEK() {
		return $this->priceSEK;
	}

	
}