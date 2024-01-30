<?php
namespace Controllers;

class ArtistPageController
{
    private $artists;
    private $albums;

	public function __construct()
	{
		$this->artists = new \Models\Artists();
        $this->albums = new \Models\Albums();
	}
	
	public function display()
	{
        $id = $_GET['id'];
		$artist = $this->artists  -> getArtistById($id);
        $albumList = $this->albums  -> getAlbumsByArtist($id);
		$template = "views/artistPage.phtml";
		include 'views/layout.phtml';
	}



}