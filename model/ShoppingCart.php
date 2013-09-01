<?php


namespace model;

require_once("ProductLine.php");

class ShoppingCart {

	private $productLines = array();

	public function buyProduct(Product $product) {
		if ($this->hasProduct($product)) {
			$this->productLines[$product->getCode()]->add();
		} else {
			$this->productLines[$product->getCode()] = new ProductLine($product);
		}
	}

	public function remove(Product $product) {
		if ($this->hasProduct($product)) {
			$this->productLines[$product->getCode()]->remove();

			if ($this->productLines[$product->getCode()]->getCount() == 0) {
				unset($this->productLines[$product->getCode()] );
			}
		} else {
			throw new \Exception("Tried to remove from a empty ProductLine");	
		}
	}

	public function emptyCart() {
		$this->productLines = array();
	}


	/**
	* @return array of ProductLine
	*/
	public function getProductLines() {
		return $this->productLines;
	}

	/**
	* @return float SEK
	*/
	public function getTotalPrice() {
		$total = 0.0;
		foreach($this->productLines AS $productLine) {
			$total += $productLine->getLineTotal();
		}
		return $total;
	}

	


	/**
	* @return boolean 
	*/
	private function hasProduct(Product $product) {
		return isset($this->productLines[$product->getCode()]);
	}
}