<?php
namespace Controllers;

class ArtistsController
{
	private $artists;

	public function __construct()
	{
		$this->artists = new \Models\Artists();
	}
	
	public function display()
	{
		$allArtists = $this->artists  -> getAllArtists();
		$template = "views/artists.phtml";
		include 'views/layout.phtml';
	}
}