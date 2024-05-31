<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_music extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    public function getAlbums(){
        $query = $this->db->query(
            "SELECT album.name, album.id, year, artist.name as artistName, genre.name as genreName, jpeg 
            FROM album 
            JOIN artist ON album.artistid = artist.id
            JOIN genre ON genre.id = album.genreid
            JOIN cover ON cover.id = album.coverid
            ORDER BY year"
        );
        return $query->result();
    }

    public function getGenres() {
        $query = $this->db->query(
            "SELECT id, name FROM genre ORDER BY name"
        );
        return $query->result();
    }

    public function getAlbumsByGenreId($genreId) {
        $query = $this->db->query(
            "SELECT album.name, album.id, year, artist.name as artistName, genre.name as genreName, jpeg 
            FROM album 
            JOIN artist ON album.artistid = artist.id
            JOIN genre ON genre.id = album.genreid
            JOIN cover ON cover.id = album.coverid
            WHERE genre.id = ?
            ORDER BY year", array($genreId)
        );
        return $query->result();
    }

    public function getArtists() {
        $query = $this->db->query(
            "SELECT id, name FROM artist ORDER BY name"
        );
        return $query->result();
    }
    
    public function search_Albums($query) {
        $this->db->select('album.id, album.name, artist.name as artistName, year');
        $this->db->from('album');
        $this->db->join('artist', 'album.artistId = artist.id');
        $this->db->like('album.name', $query ,'after');
        $result = $this->db->get();
        return $result->result();
    }

    public function getAlbumById($albumId) {
        $query = $this->db->query(
            "SELECT album.name, album.id, year, artist.name as artistName, genre.name as genreName, jpeg 
            FROM album 
            JOIN artist ON album.artistid = artist.id
            JOIN genre ON genre.id = album.genreid
            JOIN cover ON cover.id = album.coverid
            WHERE album.id = ?", array($albumId)
        );
        return $query->row();
    }

    public function getSongsByAlbumId($albumId) {
        $query = $this->db->query(
            "SELECT track.number, song.name, track.duration
            FROM track
            JOIN song ON track.songId = song.id
            WHERE track.albumId = ?
            ORDER BY track.diskNumber, track.number", array($albumId)
        );
        return $query->result();
    }
}
?>

