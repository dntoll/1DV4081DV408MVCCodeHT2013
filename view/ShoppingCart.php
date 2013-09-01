<?php

namespace view;

class ShoppingCart {
	private static $removeURL = "remove";
	private static $addURL = "add";

	//@var \model\ShoppingCart
	private $cart;

	//@var \model\ProductList
	private $productList; 

	//@var String message
	private $message;

	public function __construct(\model\ShoppingCart $cart, \model\ProductList $products) {
		$this->cart = $cart;
		$this->productList = $products;
	}

	public function showErrorMessage() {
		$this->message = "unable to do action";
	}

	/**
	* @return boolean
	*/
	public function userWantsToRemoveItem() {
		return isset($_GET[self::$removeURL]);
	}

	/**
	* @return boolean
	*/
	public function userWantsToAddItem() {
		return isset($_GET[self::$addURL]);
	}


	/**
	* @return Product
	*/
	public function getProduct() {
		if (isset($_GET[self::$removeURL])) {
			$productCode = $_GET[self::$removeURL];
		} else if (isset($_GET[self::$addURL])) {
			$productCode = $_GET[self::$addURL];
		} else {
			throw new \Exception("no product action happened");
		}


		if ($this->productList->hasProduct($productCode )) {
			return $this->productList->getProduct($productCode);
		}

		throw new \Exception("unknown product");
	}


	/**
	*  @return String HTML
	*/
	public function showCart() {
		$ret = "<h2>ShoppingCart</h2>
		<ol>";

		$productLines = $this->cart->getProductLines();

		foreach ($productLines as $key => $productLine) {
			$product = $productLine->getProduct();
			$count = $productLine->getCount();
			$productName = $product->getName();
			$productCode = $product->getCode();
			$ret .= "
					<li>$productName  $count
						<a href='?".self::$addURL."=$productCode'> + </a>
						<a href='?".self::$removeURL."=$productCode'> - </a>
					</li>
					";
		}
		$ret .= "</ol>$this->message";

		return $ret;
	}
}