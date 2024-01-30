<?php

namespace Models;

class Artists extends Database
{
    public function getAllArtists():array
    {
        return $this -> findAll("
    	SELECT artists.id, name, artists.description, artists.src, artists.alt
        FROM artists
    	ORDER BY name");
    }

    public function searchArtists($search):array
    {
        return $this -> findAll("
    	SELECT artists.id, name, artists.description, artists.src, artists.alt, albums.title
        FROM artists
    	INNER JOIN albums ON artists.id = albums.id_artist
        WHERE artists.description LIKE ?
    	ORDER BY name", ['%'.$search.'%']);
    }

    public function addArtist($name, $description, $src, $alt)
    {
	    $this -> modifyOne("
        INSERT INTO artists (name, description, src, alt)
        VALUES (?,?,?,?)
        ", [$name, $description, $src, $alt]);
    }

    public function editArtist($name, $description, $src, $alt, $id)
    {
    	$this -> modifyOne("
    	UPDATE artists
        SET name = ?, description = ?, src= ?, alt = ?
    	WHERE id = ?" ,[$name, $description, $src, $alt, $id]);
    }

    public function deleteArtist($id)
    {
    	$this -> modifyOne("
    	DELETE FROM artists
    	WHERE id = ? ", [$id]);
    }

    public function getArtistById($id)
    {
        return $this -> findOne("
    	SELECT artists.id, name, artists.description, artists.src, artists.alt
        FROM artists
    	WHERE artists.id = ?
        ORDER BY name", [$id]);
    }

    public function numberOfArtists()
    {
        return $this -> findOne("
        SELECT COUNT(id) as number FROM artists");
    }
}