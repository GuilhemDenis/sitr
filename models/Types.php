<?php

namespace Models;

class Types extends Database
{
    public function getAllTypes():array
    {
        return $this -> findAll("
    	SELECT id, name
        FROM product_types");
    }
}