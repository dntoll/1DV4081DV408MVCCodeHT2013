<?php

require_once("controller/DoShop.php");
require_once("model/ShoppingCart.php");
require_once("model/ProductList.php");
require_once("/model/Product.php");
require_once("/model/ShoppingCartPersistance.php");

session_start();

$cartSaver = new \model\ShoppingCartPersistance();

$cart = $cartSaver->getSavedCart();
$products = new \model\ProductList();

$products->addProduct(new \model\Product("Banana"));
$products->addProduct(new \model\Product("Orange"));

$storeController = new \controller\DoShop($cart, $products);
$resultHTML = $storeController->doShop();


$cartSaver->saveCart($cart);

echo $resultHTML;