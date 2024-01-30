<?php
namespace Controllers;

class ProductPageController
{
    private $shop;

	public function __construct()
	{
		$this->shop = new \Models\Products();
	}

	public function display()
	{
        $id = $_GET['id'];
		$product = $this->shop  -> getProductById($id);
		$template = "views/productPage.phtml";
		include 'views/layout.phtml';
	}



}