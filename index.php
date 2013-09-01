<?php

require_once("controller/DoShop.php");
require_once("model/ShoppingCart.php");
require_once("model/ProductList.php");
require_once("/model/Product.php");
require_once("/model/ShoppingCartPersistance.php");
require_once("/model/OrderHandler.php");

session_start();

$cartSaver = new \model\ShoppingCartPersistance();

$cart = $cartSaver->getSavedCart();
$products = new \model\ProductList();

$products->addProduct(new \model\Product("Banana", 21));
$products->addProduct(new \model\Product("Orange", 18));

$orderHandler = new \model\OrderHandler();

$storeController = new \controller\DoShop($cart, $products, $orderHandler);
$resultHTML = $storeController->doShop();


$cartSaver->saveCart($cart);

echo $resultHTML;