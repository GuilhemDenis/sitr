<?php

namespace Models;

class Products extends Database
{
    public function getAllProducts():array
    {
        return $this -> findAll("
    	SELECT products.id, id_album, products.name, quantityInStock, price, description, src, alt, src2, alt2, src3, alt3, id_type, product_types.name as type
        FROM products
        INNER JOIN product_types ON id_type = product_types.id");
    }

    public function getAllProductsWhere($sort):array
    {
        return $this -> findAll("
    	SELECT products.id, id_album, products.name, quantityInStock, price, description, src, alt, src2, alt2, src3, alt3, id_type, product_types.name as type
        FROM products
        INNER JOIN product_types ON id_type = product_types.id
        WHERE product_types.name = ?", [$sort]);
    }


    public function getProductById($id)
    {
        return $this -> findOne("
    	SELECT products.id, id_album, products.name, quantityInStock, price, description, src, alt, src2, alt2, src3, alt3, id_type, product_types.name as type
        FROM products
        INNER JOIN product_types ON id_type = product_types.id
    	WHERE products.id = ?", [$id]);
    }

    public function addProduct($id_album, $name, $type, $quantityInStock, $price, $description, $src, $alt, $src2, $alt2, $src3, $alt3)
    {
	    $this -> modifyOne("
        INSERT INTO products (id_album, name, id_type, quantityInStock, price, description, src, alt, src2, alt2, src3, alt3)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?)
        ", [$id_album, $name, $type, $quantityInStock, $price, $description, $src, $alt, $src2, $alt2, $src3, $alt3]);
    }

    public function editProduct($id_album, $name, $type, $quantityInStock, $price, $description, $src, $alt, $src2, $alt2, $src3, $alt3, $id)
    {
    	$this -> modifyOne("
    	UPDATE products
        SET id_album = ?, name = ?, id_type = ?, quantityInStock = ?, price = ?, description = ?, src = ?, alt = ?, src2 = ?, alt2 = ?, src3 = ?, alt3 = ?
    	WHERE id = ?" ,[$id_album, $name, $type, $quantityInStock, $price, $description, $src, $alt, $src2, $alt2, $src3, $alt3, $id]);
    }

    public function deleteProduct($id)
    {
    	$this -> modifyOne("
    	DELETE FROM products
    	WHERE id = ? ", [$id]);
    }

}