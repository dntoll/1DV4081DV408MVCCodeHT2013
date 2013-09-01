<?php

namespace model;

class OrderHandler {

	public function placeOrder(ShoppingCart $cart, Adress $adress) {
		$cartString = $this->getCartString($cart);
		$adressString = $adress->getAdress();
		file_put_contents("orders.txt", $cartString . $adressString, FILE_APPEND | LOCK_EX);
	}


	private function getCartString(ShoppingCart $cart) {
		$productLines = $cart->getProductLines();

		$ret = "
		***************************
		Order \n";
		foreach ($productLines  as $productLine) {
			$product = $productLine->getProduct();
			$count = $productLine->getCount();
			$productName = $product->getName();
			$productCode = $product->getCode();
			$priceSEK = $product->getPriceSEK();
			$lineTotal = $productLine->getLineTotal();
			$ret .= "$productName  $count * $priceSEK = $lineTotal :-\n";
			
		}
		$orderTotal = $cart->getTotalPrice();

		$ret .= "Total: $orderTotal :-
		***************************\n";
		return $ret;
	}
}