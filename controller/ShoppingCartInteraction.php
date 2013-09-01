<?php

namespace controller;

require_once("view/ShoppingCart.php");

class ShoppingCartInteraction {
	private $shoppingCartView;
	private $shoppingCart;

	public function __construct(\model\ShoppingCart $cart, \view\ShoppingCart $shoppingCartView) {
		$this->shoppingCartView = $shoppingCartView; 
		$this->shoppingCart = $cart;
	}


	/**
	* @return String HTML
	*/
	public function doInteractWithShoppingCart() {

		try {
			if ($this->shoppingCartView->userWantsToRemoveItem() ) {
				$productToRemove = $this->shoppingCartView->getProduct();
				$this->shoppingCart->remove($productToRemove);

			}
			if ($this->shoppingCartView->userWantsToAddItem() ) {
				$productToAdd = $this->shoppingCartView->getProduct();
				$this->shoppingCart->buyProduct($productToAdd);
			}
		} catch(\Exception $e) {
			$this->shoppingCartView->showErrorMessage();

		}

		return $this->shoppingCartView->showCart();
	}
}