<?php

namespace controller;

require_once("controller/ShoppingCartInteraction.php");
require_once("controller/BuyProducts.php");
require_once("controller/PayForProducts.php");
require_once("view/ShopNavigation.php");


class DoShop {

	/*
	* @var ShoppingCartInteraction();
	*/
	private $shoppingCartController;

	/*
	* @var BuyProducts();
	*/
	private $productsController;

	/*
	* @var PayForProducts();
	*/
	private $payForProducts;

	/*
	* @var \view\ShopNavigation();
	*/
	private $shopNavigationView;
		

	public function __construct(\model\ShoppingCart $cart, \model\ProductList $products) {
		$this->shoppingCartController = new ShoppingCartInteraction($cart, $products);
		$this->buyProductsController = new BuyProducts($cart, $products);
		$this->payForProducts = new PayForProducts();
		$this->shopNavigationView = new \view\ShopNavigation();

		
	}

	/**
	* @return String HTML
	*/
	public function doShop() {
		
		

		if ($this->shopNavigationView->isViewingProducts()) {
			$productsList = $this->buyProductsController->doBuyProducts();
			$shoppingCartOutput = $this->shoppingCartController->doInteractWithShoppingCart();
			return $productsList . $shoppingCartOutput;
		} else if ($this->shopNavigationView->isPaying()) {

			$paymentOutput = $this->payForProducts->doPay();
			$shoppingCartOutput = $this->shoppingCartController->doInteractWithShoppingCart();
			return $shoppingCartOutput . $paymentOutput;
		}

		throw new \Exception("should never be here");
	}
}