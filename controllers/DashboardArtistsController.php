<?php

namespace Controllers;

if(!isset($_SESSION['admin']))
{
	header('location:index.php?page=admin');
	exit;
}

class DashboardArtistsController
{
    private $artists;
	public function __construct()
	{
		$this -> artists = new \Models\Artists();
	}
	public function display()
	{
		if (isset($_GET['id']))
		{
			$editArtist = $this -> artists -> getArtistById($_GET['id']);
		}
	    $artistsTable = $this -> artists -> getAllArtists();
		include "views/dashboardArtists.phtml";
	}

	public function add()
	{
		if(!empty( $_POST))
		{
			$name = $_POST['name'];
			$alt = $_POST['alt'];
			$description = $_POST['text'];
			// on recupere le nom de notre image (var_dump)
			$image_name = $_FILES['image']['name'] ;
			// on recupere tmp de notre image qui est son chemin provisoire
			$tmp_name = $_FILES['image']['tmp_name'];
			// on donne le nouveau chemin de notre image
			$image = "assets/img/artistes/$image_name";
			//on donne le chemin d'acces pour l'image ancien chemin / nouveau chemin
			move_uploaded_file($tmp_name, $image);
			$this -> artists -> addArtist($name, $description, $image, $alt);
		}
	}

	public function delete()
	{
    	$this -> artists -> deleteArtist($_GET['id']);
	}
	
	public function edit()
	{
		if(!empty($_POST))
		{
			$id = $_POST['id'];
			$name = $_POST['name'];
			$alt = $_POST['alt'];
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
				$artist = $this -> artists -> getArtistById($id);
				$image = $artist['src'];
			}
			
			$this -> artists -> editArtist($name, $description, $image, $alt, $id);
		}
	}

}