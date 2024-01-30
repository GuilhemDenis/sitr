<?php

namespace Controllers;

if(!isset($_SESSION['admin']))
{
	header('location:index.php?page=admin');
	exit;
}

class DashboardNewsController
{
    private $news;
    private $albums;
    private $artists;
	public function __construct()
	{
		$this -> albums = new \Models\Albums();
		$this -> artists = new \Models\Artists();
        $this -> news = new \Models\News();
	}
	public function display()
	{
		if (isset($_GET['id']))
		{
			$editNews = $this -> news -> getNewsById($_GET['id']);
		}
	    $newsTable = $this -> news -> getAllNews();
        $allArtists = $this -> artists -> getAllArtists();
        $allAlbums = $this -> albums -> getAllAlbums();
		include "views/dashboardNews.phtml";
	}

	public function add()
	{
		if(!empty( $_POST))
		{
			$title = $_POST['title'];
            $artist = $_POST['artist'];
			$alt = $_POST['alt'];
            $date = $_POST['date'];
			$description = $_POST['text'];
			// on recupere le nom de notre image (var_dump)
			$image_name = $_FILES['image']['name'] ;
			// on recupere tmp de notre image qui est son chemin provisoire
			$tmp_name = $_FILES['image']['tmp_name'];
			// on donne le nouveau chemin de notre image
			$image = "assets/img/artistes/$image_name";
			//on donne le chemin d'acces pour l'image ancien chemin / nouveau chemin
			move_uploaded_file($tmp_name, $image);
			$this -> news -> addNews($title, $artist, $date, $description, $image, $alt);
		}
	}

	public function delete()
	{
    	$this -> news -> deleteNews($_GET['id']);
	}
	
	public function edit()
	{
		if(!empty($_POST))
		{
			$id = $_POST['id'];
			$title = $_POST['title'];
            $artist = $_POST['artist'];
			$alt = $_POST['alt'];
            $date = $_POST['date'];
			$description = $_POST['text'];
			if (!empty($_FILES['image']['name']))
			{
				// on recupere le nom de notre image (var_dump)
				$image_name = $_FILES['image']['name'] ;
				// on recupere tmp de notre image qui est son chemin provisoire
				$tmp_name = $_FILES['image']['tmp_name'];
				// on donne le nouveau chemin de notre image
				$image = "assets/img/artistes/$image_name";
				//on donne le chemin d'acces pour l'image ancien chemin / nouveau chemin
				move_uploaded_file($tmp_name, $image);
			}
			else
			{
				$article = $this -> news -> getNewsById($id);
				$image = $article['src'];
			}
			
			$this -> news -> editNews($title, $artist, $date, $description, $image, $alt, $id);
		}
	}

}