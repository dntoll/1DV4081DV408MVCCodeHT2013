<?php

namespace view;

require_once("/model/Adress.php");

class Payment {
	private static $placeOrderURL = "order";
	private static $dropOrderURL = "delete";
	private static $adress = "adress";

	//@var String
	private $message ="";

	public function __construct(ShopNavigation $navigationView, 
								ShoppingCart $cartView) {
		$this->navigationView = $navigationView;
		$this->cartView = $cartView;
	}	

	/**
	* @return boolean
	*/
	public function userPlacesOrder() {
		return isset($_POST[self::$placeOrderURL]);
	}

	/**
	* @return boolean
	*/
	public function userDropsOrder() {
		return isset($_POST[self::$dropOrderURL]);
	}

	/**
	* @return Adress
	*/
	public function getAdress() {
		if (isset($_POST[self::$adress])) {
			return new \model\Adress($_POST[self::$adress]);
		}
		throw new \Exception("no adress found");
	}


	public function pleaseFillInAdress() {
		$this->message = "Please fill in a valid Adress!";
	}

	/**
	* @return String HTML
	*/
	public function show() {

		$paymentPage = $this->navigationView->getPaymentUrl();

		return "<h1>Payment</h1>
		<form action='?$paymentPage' method='post'>
			<input type='text' name='" . self::$adress . "'/>
			<input type='submit' value='order' name='order'/>
			<input type='submit' value='cancel' name='cancel'/>
		</form>
		$this->message

		";
	}

	public function showRecipe() {
		$order = $this->cartView->showAsReceipt();
		$adress = $this->getAdress()->getAdress();

		
		return "<h1>Receipt</h1>
				$order
				<hr/>
				Adress: $adress";
	}
}