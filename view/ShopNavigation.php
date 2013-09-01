<?php

namespace view;

class ShopNavigation {
	private static $payUrl = "doPay";

	/**
	* @return Boolean
	*/
	public function isViewingProducts() {
		return !$this->isPaying();
		
	}

	/**
	* @return Boolean
	*/
	public function isPaying() {
		return isset($_GET[self::$payUrl]);
		
	}


	/**
	* @return String HTML
	*/
	public function getHTML() {
		return "<a href='?" . self::$payUrl . "'>Pay</a> <a href='?'>Buy</a>";
	}

	/**
	* @return String URL part
	*/
	public function getPaymentUrl() {
		return self::$payUrl;
	}

	
}