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
		

	public function __construct(\model\ShoppingCart $cart, 
								\model\ProductList $products,
								\model\OrderHandler $orderHandler) {

		$cartView = new \view\ShoppingCart($cart, $products);
		$this->shoppingCartController = new ShoppingCartInteraction($cart, $cartView);
		$this->buyProductsController = new BuyProducts($cart, $products);
		$this->shopNavigationView = new \view\ShopNavigation();

		$this->payForProducts = new PayForProducts($cart, 
												   $orderHandler, 
												   $this->shopNavigationView,
												   $cartView);
		

		
	}

	/**
	* @return String HTML
	*/
	public function doShop() {
		
		
		$navigations = $this->shopNavigationView->getHTML();
		if ($this->shopNavigationView->isViewingProducts()) {
			$productsList       = $this->buyProductsController->doBuyProducts();
			$shoppingCartOutput = $this->shoppingCartController->doInteractWithShoppingCart();
			return $navigations . $productsList . $shoppingCartOutput;
		} else if ($this->shopNavigationView->isPaying()) {

			$paymentOutput      = $this->payForProducts->doPay();
			$shoppingCartOutput = $this->shoppingCartController->doInteractWithShoppingCart();
			return $navigations . $shoppingCartOutput . $paymentOutput;
		}

		throw new \Exception("should never be here");
	}
}