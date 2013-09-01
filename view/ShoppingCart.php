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

		$lines = $this->getProductLines(true);
		$ret = "<h2>ShoppingCart</h2>
				$lines
				$this->message";

		

		return $ret;
	}

	/**
	*  @return String HTML
	*/
	public function showAsReceipt() {
		$lines = $this->getProductLines(false);
		return "<h2>Order</h2>
				$lines
				$this->message";
	}

	private function getProductLines($showLinks) {
		$ret = "<ol>";

		$productLines = $this->cart->getProductLines();
		foreach ($productLines as $key => $productLine) {
			$product = $productLine->getProduct();
			$count = $productLine->getCount();
			$productName = $product->getName();
			$productCode = $product->getCode();
			$priceSEK = $product->getPriceSEK();
			$lineTotal = $productLine->getLineTotal();
			$ret .= "
					<li>$productName  $count * $priceSEK = $lineTotal :-";
			if ($showLinks) {					
			$ret .= "		<a href='?".self::$addURL."=$productCode'> [+] </a>
						<a href='?".self::$removeURL."=$productCode'> [-] </a>";
			};
			$ret .= "</li>";
		}
		$ret .= "</ol>";

		$orderTotal = $this->cart->getTotalPrice();

		$ret .= "Total: $orderTotal :-";
		return $ret;
	}
	
}