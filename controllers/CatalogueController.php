<?php
namespace Controllers;

class CatalogueController
{
	private $albums;

	public function __construct()
	{
		$this->albums = new \Models\Albums();
	}
	
	public function display()
	{
		$allAlbums = $this->albums  -> getAllAlbums();
		$template = "views/catalogue.phtml";
		include 'views/layout.phtml';
	}

}