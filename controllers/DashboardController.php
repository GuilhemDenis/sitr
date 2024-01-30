<?php

namespace Controllers;

class DashboardController
{
	private $albums;
	private $artists;

	public function __construct()
	{
		if(!isset($_SESSION['admin']))
        {
            header('location:index.php?page=admin');
            exit;
        }
		$this -> albums = new \Models\Albums();
		$this -> artists = new \Models\Artists();
	}

	
	public function display()
	{
		$totalAlbums = $this -> albums -> numberOfAlbums();
		$totalArtists = $this -> artists -> numberOfArtists();
		$template = "views/dashboard.phtml";
		include 'views/dashboardLayout.phtml';
	}
}