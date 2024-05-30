<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_music extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getAlbums() {
        $query = $this->db->query("
            SELECT album.name, album.id, year, artist.name as artistName, genre.name as genreName, jpeg 
            FROM album 
            JOIN artist ON album.artistid = artist.id
            JOIN genre ON genre.id = album.genreid
            JOIN cover ON cover.id = album.coverid
            ORDER BY year
        ");
        return $query->result();
    }

    public function getArtists() {
        $query = $this->db->query("
            SELECT id, name FROM artist ORDER BY name
        ");
        return $query->result();
    }

    public function getAlbumById($albumId) {
        $query = $this->db->query("
            SELECT album.name, album.id, year, artist.name as artistName, genre.name as genreName, jpeg 
            FROM album 
            JOIN artist ON album.artistid = artist.id
            JOIN genre ON genre.id = album.genreid
            JOIN cover ON cover.id = album.coverid
            WHERE album.id = ?
        ", array($albumId));
        return $query->row();
    }

    public function getSongsByAlbumId($albumId) {
        $query = $this->db->query("
            SELECT track.songId as id, song.name, track.number, track.duration
            FROM track
            JOIN song ON track.songId = song.id
            WHERE track.albumId = ?
            ORDER BY track.number
        ", array($albumId));
        return $query->result();
    }

    public function searchArtists($query) {
        $this->db->like('name', $query);
        return $this->db->get('artist')->result();
    }

    public function searchAlbums($query) {
        $this->db->select('album.name, album.id, year, artist.name as artistName, genre.name as genreName, jpeg');
        $this->db->from('album');
        $this->db->join('artist', 'album.artistid = artist.id');
        $this->db->join('genre', 'genre.id = album.genreid');
        $this->db->join('cover', 'cover.id = album.coverid');
        $this->db->like('album.name', $query);
        return $this->db->get()->result();
    }

    public function getAlbumByName($name) {
        $query = $this->db->query("
            SELECT album.name, album.id, year, artist.name as artistName, genre.name as genreName, jpeg 
            FROM album 
            JOIN artist ON album.artistid = artist.id
            JOIN genre ON genre.id = album.genreid
            JOIN cover ON cover.id = album.coverid
            WHERE album.name = ?
        ", array($name));
        return $query->row();
    }

}
?>
