<?php

namespace Controllers;

if(!isset($_SESSION['admin']))
{
	header('location:index.php?page=admin');
	exit;
}

class DashboardContactController
{
    private $contact;
	public function __construct()
	{
		$this -> contact = new \Models\Contact();
	}
	public function display()
	{
		if (isset($_GET['id']))
		{
			$editArtist = $this -> contact -> getMessageById($_GET['id']);
		}
	    $messages = $this -> contact -> getAllMessages();
		include 'views/dashboardContact.phtml';
	}

	public function delete()
	{
    	$this -> contact -> deleteMessage($_GET['id']);
	}


	
}