<?php

namespace controller;

require_once("/view/ProductList.php");



class BuyProducts {

	public $productListView;


	public function __construct(\model\ShoppingCart $shoppingCart, \model\ProductList $products) {
		$this->productListView = new \view\ProductList($products);
		$this->shoppingCart = $shoppingCart;

	}

	/**
	* @return String HTML
	*/
	public function doBuyProducts() {
		if ($this->productListView->userWantsToBuy()) {
			try {
				$product = $this->productListView->getSelectedProduct();
			
				$this->shoppingCart->buyProduct($product );

				$this->productListView->buySuccessMessage();
			} catch (\Exception $e) {

				$this->productListView->showBuyErrorMessage();
			}
		}


		return $this->productListView->showProducts();
	}
}