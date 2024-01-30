<?php
namespace Controllers;

class ContactController
{
	private $contact;

	public function __construct()
	{
		$this->contact = new \Models\Contact();
	}
	
	public function display()
	{
		$template = "views/contact.phtml";
		include 'views/layout.phtml';
	}

	public function newMessage()
	{
		if (!empty($_POST))
		{
			$name = $_POST['name'];
			$email = $_POST['email'];
			$subject = $_POST['subject'];
			$text = $_POST['text'];
			
			$this->contact -> addMessage($name,$email,$subject,$text);
			header('location:home');
			exit;
		}
	}

	

}