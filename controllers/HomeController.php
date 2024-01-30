<?php
namespace Controllers;

class HomeController
{
	private $albums;
	private $news;

	public function __construct()
	{
		$this->albums = new \Models\Albums();
		$this->news = new \Models\News();
	}
	
	public function display()
	{
		$lastAlbums = $this->albums  -> getTheLastAlbums();
		$lastNews = $this->news  -> getTheLastNews();
		$template = "views/home.phtml";
		include 'views/layout.phtml';
	}

}