<?php

namespace model;

require_once("/model/Product.php");

class ProductList {

	public function __construct() {
		$this->products = array();
	}

	/**
	* @param integer productIndex
	* @return array of Product 
	*/
	public function hasProduct($productIndex) {
		return isset($this->products[$productIndex]);
	}

	public function addProduct(Product $product) {
		if (isset($this->products[$product->getCode()])) {
			throw new \Exception("product is already in List");
		}

		$this->products[$product->getCode()] = $product;
	}

	/**
	* @return Product
	*/
	public function getProduct($productIndex) {
		assert($this->hasProduct($productIndex));

		return $this->products[$productIndex];
	}

	/**
	* @return array of Product 
	*/
	public function getProducts() {
		return $this->products;
	}
}