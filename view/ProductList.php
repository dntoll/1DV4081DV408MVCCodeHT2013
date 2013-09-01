<?php


namespace view;

class ProductList {
	private static $buyProductURL = "buyProduct";
	
	/**
	* @var \model\ProductList products
	*/
	private $products;

	/**
	* @var String message
	*/
	private $message = "";

	public function __construct(\model\ProductList $products) {
		$this->products = $products;
	}

	/**
	* @return boolean
	*/
	public function userWantsToBuy() {
		return isset($_GET[self::$buyProductURL]);
	}

	/**
	* @return Product
	*/
	public function getSelectedProduct() {

		assert($this->userWantsToBuy());
		$productIndex = $_GET[self::$buyProductURL];
		if ($this->products->hasProduct($productIndex) ) {
			return $this->products->getProduct($productIndex);
		}

		throw new  \Exception("Unknown index");
	}


	public function showProducts() {
		$ret = "<h2>products</h2>";
		foreach ($this->products->getProducts() as $key => $product) {
			$ret .= "$key <a href='?". self::$buyProductURL ."=$key'>buy</a> <br/>";
		}

		return "$ret " . $this->message;
	}

	public function showBuyErrorMessage() {
		$this->message = "unable to buy that product ";
	}

	public function buySuccessMessage() {
		$this->message = "a product has been bought";
	}

	
}