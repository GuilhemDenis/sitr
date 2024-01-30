<?php
namespace Controllers;

class ShopController
{
	private $shop;

	public function __construct()
	{
		$this->shop = new \Models\Products();
	}
	
	public function display()
	{
		if (isset($_GET['sort']))
		{
			if ($_GET['sort'] == 'null')
				$allProducts = $this->shop  -> getAllProducts();
			else 
				$allProducts = $this->shop  -> getAllProductsWhere($_GET['sort']);
			include "views/shop.phtml";
		}
		else 
		{
			$allProducts = $this->shop  -> getAllProducts();
			$template = "views/shop.phtml";
			include 'views/layout.phtml';
		}
	}
}