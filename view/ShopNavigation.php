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
}