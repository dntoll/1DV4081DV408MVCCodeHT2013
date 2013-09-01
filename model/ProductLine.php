<?php

namespace model;

class ProductLine {

	/** @var Product product
	*/
	private $product;

	/** @var Integer count
	*/
	private $count;	

	public function __construct(Product $product) {
		$this->product = $product;
		$this->count = 1;
	}

	/** @return Product
	*/
	public function getProduct() {
		return $this->product;
	}

	/** @return Integer
	*/
	public function getCount() {
		return $this->count;
	}

	
	public function add() {
		$this->count++;
	}

	public function remove() {
		$this->count--;
	}
}