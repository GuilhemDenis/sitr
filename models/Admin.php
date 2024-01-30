<?php

namespace Models;

class Admin extends Database
{
    public function getAdminById($email)
    {
        
    	$result = $this -> findOne("
    	SELECT password, email, firstName, lastName
    	FROM admin
    	WHERE email = ?", [$email]);
    	
		
        if(!$result)
		{
			throw new \Exception('Cet identifiant n\'existe pas');
		}
		return $result;
    }
}