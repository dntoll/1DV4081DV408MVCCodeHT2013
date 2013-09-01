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



	/**
	* @return array of ProductLine
	*/
	public function getProductLines() {
		return $this->productLines;
	}


	/**
	* @return boolean 
	*/
	private function hasProduct(Product $product) {
		return isset($this->productLines[$product->getCode()]);
	}
}