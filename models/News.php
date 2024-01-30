<?php

namespace Models;

class News extends Database
{
    public function getAllNews():array
    {
        return $this -> findAll("
    	SELECT news.id, news.title as title, news.description as description, DATE_FORMAT(news.publication_date,'%d %M %Y') as date, news.src as src, news.alt as alt, post, albums.title as title2, artists.name as name
        FROM news
    	INNER JOIN artists ON id_artist = artists.id
        INNER JOIN albums ON id_album = albums.id
    	ORDER BY date DESC");
    }

    public function getTheLastNews():array
    {
        return $this -> findAll("
    	SELECT news.id, news.title as title, news.description as description, DATE_FORMAT(news.publication_date,'%d %M %Y') as date, news.src as src, news.alt as alt, post, albums.title as title2, artists.name as name
        FROM news
    	INNER JOIN artists ON id_artist = artists.id
        INNER JOIN albums ON id_album = albums.id
        WHERE post = 1
    	ORDER BY date DESC
        LIMIT 2");
    }

    public function searchNews($search1,$search2):array
    {
        return $this -> findAll("
    	SELECT news.id, news.title as title, news.description as description, DATE_FORMAT(news.publication_date,'%d %M %Y') as date, news.src as src, news.alt as alt, post, albums.title as title2, artists.name as name
        FROM news
    	INNER JOIN artists ON id_artist = artists.id
        INNER JOIN albums ON id_album = albums.id
        WHERE (news.description LIKE ? OR news.title LIKE ?) && post = 1 && date <= CURRENT_TIMESTAMP
    	ORDER BY date DESC", ['%'.$search1.'%', '%'.$search2.'%']);
    }

    public function getNewsById($id)
    {
        //passage de la date en langue française
        $this -> modifyOne("SET lc_time_names = 'fr_FR';");

        return $this -> findOne("
        
    	SELECT news.id as id, news.title as title, news.description as description, DATE_FORMAT(news.publication_date,'%d %M %Y') as date, news.src as src, news.alt as alt, post, albums.title as title2, artists.name as name
        FROM news
    	INNER JOIN artists ON id_artist = artists.id
        INNER JOIN albums ON id_album = albums.id
        WHERE news.id = ?
    	ORDER BY date DESC", [$id]);
    }

    public function addNews($title, $idArtist, $date, $description, $src, $alt)
    {
	    $this -> modifyOne("
        INSERT INTO albums (title, id_artist, date, description, src, alt)
        VALUES (?,?,?,?,?,?)
        ", [$title, $idArtist, $date, $description, $src, $alt]);
    }

    public function editNews($title, $idArtist, $date, $description, $src, $alt, $id)
    {
    	$this -> modifyOne("
    	UPDATE albums
        SET title = ?, id_artist = ?, date = ?, description = ?, src= ?, alt = ?
    	WHERE id = ?" ,[$title, $idArtist, $date, $description, $src, $alt, $id]);
    }

    public function deleteNews($id)
    {
    	$this -> modifyOne("
    	DELETE FROM news
    	WHERE id = ? ", [$id]);
    }



}