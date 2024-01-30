<?php

namespace Models;

class Albums extends Database
{
    public function getAllAlbums():array
    {
        $this -> modifyOne("SET lc_time_names = 'fr_FR';");

        return $this -> findAll("
    	SELECT albums.id, artists.name, title, albums.description, albums.src, albums.alt, DATE_FORMAT(date,'%d %M %Y') as publication_date, date
        FROM albums
    	INNER JOIN artists ON id_artist = artists.id
    	ORDER BY date DESC");
    }

    public function getTheLastAlbums():array
    {
        return $this -> findAll("
    	SELECT albums.id, artists.name, title, albums.description, albums.src, albums.alt, date
        FROM albums
    	INNER JOIN artists ON id_artist = artists.id
    	ORDER BY date DESC
        LIMIT 4");
    }

    public function getAlbumById($id)
    {
        $this -> modifyOne("SET lc_time_names = 'fr_FR';");

        return $this -> findOne("
        
    	SELECT albums.id, artists.name, title, albums.description, albums.src, albums.alt, DATE_FORMAT(date,'%d %M %Y') as date, DATE_FORMAT(date,'%Y-%m-%d') as publication_date, albums.id_artist
        FROM albums
        INNER JOIN artists ON id_artist = artists.id
    	WHERE albums.id = ?", [$id]);
    }

    public function getAlbumsByArtist($id)
    {
        $this -> modifyOne("SET lc_time_names = 'fr_FR';");

        return $this -> findAll("
        
    	SELECT albums.id, artists.name, title, albums.description, albums.src, albums.alt, DATE_FORMAT(date,'%d %M %Y') as date, DATE_FORMAT(date,'%Y-%m-%d') as publication_date
        FROM albums
        INNER JOIN artists ON id_artist = artists.id
    	WHERE albums.id_artist = ?", [$id]);
    }



    public function searchAlbums($search):array
    {
        return $this -> findAll("
    	SELECT albums.id, artists.name, title, albums.description, albums.src, albums.alt, date
        FROM albums
    	INNER JOIN artists ON id_artist = artists.id
        WHERE albums.description LIKE ?
    	ORDER BY date DESC", ['%'.$search.'%']);
    }

    public function addAlbum($title, $idArtist, $date, $description, $src, $alt)
    {
	    $this -> modifyOne("
        INSERT INTO albums (title, id_artist, date, description, src, alt)
        VALUES (?,?,?,?,?,?)
        ", [$title, $idArtist, $date, $description, $src, $alt]);
    }

    public function editAlbum($title, $idArtist, $date, $description, $src, $alt, $id)
    {
    	$this -> modifyOne("
    	UPDATE albums
        SET title = ?, id_artist = ?, date = ?, description = ?, src= ?, alt = ?
    	WHERE id = ?" ,[$title, $idArtist, $date, $description, $src, $alt, $id]);
    }

    public function deleteAlbum($id)
    {
    	$this -> modifyOne("
    	DELETE FROM albums
    	WHERE id = ? ", [$id]);
    }

    public function numberOfAlbums()
    {
        return $this -> findOne("
        SELECT COUNT(id) as number FROM albums");
    }
}