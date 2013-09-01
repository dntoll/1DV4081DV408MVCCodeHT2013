<?php

namespace controller;

require_once("/view/Payment.php");

class PayForProducts {

	public function __construct(\model\ShoppingCart $cart, 
								\model\OrderHandler $orderHandler, 
								\view\ShopNavigation $navigationView,
								\view\ShoppingCart $cartView) {
		$this->paymentView = new \view\Payment($navigationView, $cartView);
		$this->cart = $cart;
		$this->orderHandler = $orderHandler;
	}

	/**
	* @return String HTML
	*/
	public function doPay() {
		if ($this->paymentView->userPlacesOrder()) {
			try {
				$adress = $this->paymentView->getAdress();

				$this->orderHandler->placeOrder($this->cart, $adress);
			
				$ret = $this->paymentView->showRecipe();
				$this->cart->emptyCart();
				return $ret;
			} catch (\model\AdressException $e) {
				$this->paymentView->pleaseFillInAdress();
			}
			
			

			
		}
		if ($this->paymentView->userDropsOrder()) {
			$this->cart->emptyCart();
		}

		return $this->paymentView->show();
	}
}