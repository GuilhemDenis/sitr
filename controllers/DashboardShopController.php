<?php

namespace Controllers;

if(!isset($_SESSION['admin']))
{
	header('location:index.php?page=admin');
	exit;
}

class DashboardShopController
{
    private $shop;
    private $albums;
	private $types;
    
	public function __construct()
	{
		$this -> shop = new \Models\Products();
        $this -> albums = new \Models\Albums();
		$this -> types = new \Models\Types();
	}
	public function display()
	{
		if (isset($_GET['id']))
		{
			$editProduct = $this -> shop -> getProductById($_GET['id']);
		}
        $allProducts = $this -> shop -> getAllProducts();
        $allAlbums = $this -> albums -> getAllAlbums();
		$allTypes = $this-> types -> getAllTypes();
        $scandir = scandir("./assets/img/shop");
		include "views/dashboardShop.phtml";
	}

    public function add()
	{
		if(!empty( $_POST))
		{
            if (!empty($_POST['album']))
                $id_album = $_POST['album'];
            else
                $id_album = null;
            $name = $_POST['name'];
			$type = $_POST['type'];
            $quantityInStock = $_POST['quantity'];
            $price = $_POST['price'];
            $description = $_POST['text'];
            $alt = $_POST['alt']; 
            $alt2 = $_POST['alt2']; 
            $alt3 = $_POST['alt3']; 
            
			// on recupere le nom de notre image
			$image_name = $_FILES['image']['name'] ;
			// on recupere tmp de notre image qui est son chemin provisoire
			$tmp_name = $_FILES['image']['tmp_name'];
			// on donne le nouveau chemin de notre image
			$image = "assets/img/shop/$image_name";
			//on donne le chemin d'acces pour l'image ancien chemin / nouveau chemin
			move_uploaded_file($tmp_name, $image);
            
            if (!empty($_FILES['image2']['name']))
            {
                $image_name2 = $_FILES['image2']['name'];
                $tmp_name2 = $_FILES['image2']['tmp_name'];
                $image2 = "assets/img/shop/$image_name2";
                move_uploaded_file($tmp_name2, $image2);
            }

            else 
                $image2 = "";

            if (!empty($_FILES['image3']['name']))
            {
                $image_name3 = $_FILES['image3']['name'] ;
                $tmp_name3 = $_FILES['image3']['tmp_name'];
                $image3 = "assets/img/shop/$image_name3";
                move_uploaded_file($tmp_name3, $image3);
            }
            else
                $image3 = "";
        
			$this -> shop -> addProduct($id_album, $name, $type, $quantityInStock, $price, $description, $image, $alt, $image2, $alt2, $image3, $alt3);
		}
	}

	public function delete()
	{
    	$this -> shop -> deleteProduct($_GET['id']);
	}
	
	public function edit()
	{
		if(!empty($_POST['id']))
		{
            //on récupère les informations du formulaire
			$id = $_POST['id'];
            $id_album = $_POST['album'];
            $name = $_POST['name'];
			$type = $_POST['type'];
            $quantityInStock = $_POST['quantity'];
            $price = $_POST['price'];
            $description = $_POST['text'];
            $alt = $_POST['alt']; 
            $alt2 = $_POST['alt2']; 
            $alt3 = $_POST['alt3']; 

			if (!empty($_FILES['image']['name']))
			{
				// on recupere le nom de notre image (var_dump)
				$image_name = $_FILES['image']['name'] ;
				// on recupere tmp de notre image qui est son chemin provisoire
				$tmp_name = $_FILES['image']['tmp_name'];
				// on donne le nouveau chemin de notre image
				$image = "assets/img/shop/$image_name";
				//on donne le chemin d'acces pour l'image ancien chemin / nouveau chemin
				move_uploaded_file($tmp_name, $image);
			}
			else
			{
                //on conserve le même chemin si aucune nouvelle image n'est fournie
				$album = $this -> shop -> getProductById($id);
				$image = $album['src'];
			}

            if (!empty($_FILES['image2']['name']))
			{
				// on recupere le nom de notre image (var_dump)
				$image_name2 = $_FILES['image2']['name'] ;
				// on recupere tmp de notre image qui est son chemin provisoire
				$tmp_name = $_FILES['image2']['tmp_name'];
				// on donne le nouveau chemin de notre image
				$image2 = "assets/img/shop/$image_name2";
				//on donne le chemin d'acces pour l'image ancien chemin / nouveau chemin
				move_uploaded_file($tmp_name, $image2);
			}
			else
			{
                //on conserve le même chemin si aucune nouvelle image n'est fournie
				$album = $this -> shop -> getProductById($id);
				$image = $album['src2'];
			}

            if (!empty($_FILES['image3']['name']))
			{
				// on recupere le nom de notre image (var_dump)
				$image_name3 = $_FILES['image3']['name'] ;
				// on recupere tmp de notre image qui est son chemin provisoire
				$tmp_name = $_FILES['image3']['tmp_name'];
				// on donne le nouveau chemin de notre image
				$image3 = "assets/img/shop/$image_name3";
				//on donne le chemin d'acces pour l'image ancien chemin / nouveau chemin
				move_uploaded_file($tmp_name, $image3);
			}
			else
			{
                //on conserve le même chemin si aucune nouvelle image n'est fournie
				$album = $this -> shop -> getProductById($id);
				$image = $album['src3'];
			}

			
			$this -> shop -> editProduct($id_album, $name, $type, $quantityInStock, $price, $description, $image, $alt, $image2, $alt2, $image3, $alt3, $id);
		}
	}
}