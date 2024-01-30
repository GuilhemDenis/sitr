<?php

namespace Models;

class Contact extends Database
{
    public function getAllMessages()
    {
        return $this -> findAll("
    	SELECT id, name, email, subject, message
        FROM contact");
    }

    public function getMessageById($email)
    {
        
    	return $this -> findOne("
    	SELECT id, name, email, subject, message
        FROM contact
    	WHERE email = ?", [$email]);
    }

    public function addMessage($name,$email,$subject,$text)
    {
        
    	$this -> modifyOne("
        INSERT INTO contact (name, email, subject, message)
        VALUES (?,?,?,?)
        ", [$name,$email,$subject,$text]);
    }

    public function deleteMessage($id)
    {
    	$this -> modifyOne("
    	DELETE FROM contact
    	WHERE id = ? ", [$id]);
    }
}