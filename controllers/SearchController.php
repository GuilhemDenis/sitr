<?php
namespace Controllers;

class SearchController
{
    private $albums;
    private $artists;
    private $news;


	public function __construct()
	{
		$this->albums = new \Models\Albums();
        $this->artists = new \Models\Artists();
        $this->news = new \Models\News();
	}
	
	public function display()
	{

		if (isset( $_GET['search']))
		{
			$search = $_GET['search'];
			$searchAlbums = $this->albums -> searchAlbums($search);
			$searchArtists = $this->artists -> searchArtists($search);
			$searchNews = $this->news -> searchNews($search, $search);
			include 'views/search.phtml';
		}
        else 
		{
			$search = $_POST['search'];
			$searchAlbums = $this->albums -> searchAlbums($search);
			$searchArtists = $this->artists -> searchArtists($search);
			$searchNews = $this->news -> searchNews($search, $search);
			$template = 'views/search.phtml';
			include 'views/layout.phtml';
		}
	}



}