<?php

namespace Controllers;

if(!isset($_SESSION['admin']))
{
	header('location:index.php?page=admin');
	exit;
}

class DashboardAlbumsController
{
    private $albums;
    private $artists;
	
	public function __construct()
	{
		$this -> albums = new \Models\Albums();
		$this -> artists = new \Models\Artists();
	}
	public function display()
	{
		if (isset($_GET['id']))
		{
			$editAlbum = $this -> albums -> getAlbumById($_GET['id']);
		}
        $allArtists = $this -> artists -> getAllArtists();
	    $albumsTable = $this -> albums -> getAllAlbums();
		include "views/dashboardAlbums.phtml";
	}

	public function add()
	{
		if(!empty( $_POST))
		{
			$title = $_POST['title'];
            $idArtist = $_POST['name'];
            $date = $_POST['date'];
			$alt = $_POST['alt'];
			$description = $_POST['text'];
			// on recupere le nom de notre image (var_dump)
			$image_name = $_FILES['image']['name'] ;
			// on recupere tmp de notre image qui est son chemin provisoire
			$tmp_name = $_FILES['image']['tmp_name'];
			// on donne le nouveau chemin de notre image
			$image = "assets/img/albums/$image_name";
			//on donne le chemin d'acces pour l'image ancien chemin / nouveau chemin
			move_uploaded_file($tmp_name, $image);
			$this -> albums -> addAlbum($title, $idArtist, $date, $description, $image, $alt);
            
		}
	}

	public function delete()
	{
    	$this -> albums -> deleteAlbum($_GET['id']);
	}
	
	public function edit()
	{
		if(!empty($_POST['id']))
		{
            //on récupère les informations du formulaire
			$id = $_POST['id'];
			$title = $_POST['title'];
            $idArtist = $_POST['name'];
            $date = $_POST['date'];
			$alt = $_POST['alt'];
			$description = $_POST['text'];
			if (!empty($_FILES['image']['name']))
			{
				// on recupere le nom de notre image (var_dump)
				$image_name = $_FILES['image']['name'] ;
				// on recupere tmp de notre image qui est son chemin provisoire
				$tmp_name = $_FILES['image']['tmp_name'];
				// on donne le nouveau chemin de notre image
				$image = "assets/img/albums/$image_name";
				//on donne le chemin d'acces pour l'image ancien chemin / nouveau chemin
				move_uploaded_file($tmp_name, $image);
			}
			else
			{
                //on conserve le même chemin si aucune nouvelle image n'est fournie
				$album = $this -> albums -> getAlbumById($id);
				$image = $album['src'];
			}
			
			$this -> albums -> editAlbum($title, $idArtist, $date, $description, $image, $alt, $id);
		}
	}

}