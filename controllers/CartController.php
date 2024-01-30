<?php
namespace Controllers;

class CartController
{
	private $shop;
	private $totalCost;

	public function __construct()
	{
		$this->shop = new \Models\Products();
	}
	
	public function display()
	{
		//réceptionner les datas qui arrivent en POST
		$datas = file_get_contents('php://input');
		//decoder le json
		$cart = json_decode($datas);
        $shoppingCart = [];
        foreach ($cart as $item)
        {
			$product = $this->shop->getProductById($item->id);
			$product['nb'] = $item->nb;
            $shoppingCart[] = $product;
        }
		foreach ($shoppingCart as $product)
		{
			$this->totalCost += ($product['price'] * $product['nb']);
		}
		include 'views/cart.phtml';
	}
}