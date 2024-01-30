<?php
namespace Controllers;

class NewsController
{
	private $news;

	public function __construct()
	{
		$this->news = new \Models\News();
	}
	
	public function display()
	{
		$allNews = $this->news  -> getAllNews();
		$template = "views/news.phtml";
		include 'views/layout.phtml';
	}

}