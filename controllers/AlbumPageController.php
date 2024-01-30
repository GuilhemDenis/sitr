<?php
namespace Controllers;

class AlbumPageController
{
    private $albums;

	public function __construct()
	{
		$this->albums = new \Models\Albums();
	}
	
	public function display()
	{
        $id = $_GET['id'];
		$album = $this->albums  -> getAlbumById($id);
		$template = "views/albumPage.phtml";
		include 'views/layout.phtml';
	}



}