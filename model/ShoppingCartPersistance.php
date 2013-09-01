<?php

namespace model;

class ShoppingCartPersistance {

	private static $cartLocation = "ShoppingCartPersistance";

	public function __construct() {
		assert(isset($_SESSION));
	}

	/**
	* @return ShoppingCart
	*/
	public function getSavedCart() {
		if (isset($_SESSION[self::$cartLocation]) == false)
			 return new ShoppingCart();
		return $_SESSION[self::$cartLocation];
	}

	/**
	* @return ShoppingCart
	*/
	public function saveCart(ShoppingCart $cart) {
		$_SESSION[self::$cartLocation] = $cart;
	}
}