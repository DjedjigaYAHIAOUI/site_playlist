<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_music extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getAlbums() {
        $this->db->select('album.name, album.id, year, artist.name as artistName, genre.name as genreName, jpeg');
        $this->db->from('album');
        $this->db->join('artist', 'album.artistid = artist.id');
        $this->db->join('genre', 'genre.id = album.genreid');
        $this->db->join('cover', 'cover.id = album.coverid');
        $this->db->order_by('year');
        $query = $this->db->get();
        return $query->result();
    }

    public function getArtists() {
        $this->db->select('id, name');
        $this->db->order_by('name');
        $query = $this->db->get('artist');
        return $query->result();
    }

    public function getAlbumById($albumId) {
        $this->db->select('album.name, album.id, year, artist.name as artistName, genre.name as genreName, jpeg');
        $this->db->from('album');
        $this->db->join('artist', 'album.artistid = artist.id');
        $this->db->join('genre', 'genre.id = album.genreid');
        $this->db->join('cover', 'cover.id = album.coverid');
        $this->db->where('album.id', $albumId);
        $query = $this->db->get();
        return $query->row();
    }

    public function getSongsByAlbumId($albumId) {
        $this->db->select('track.songId as id, song.name, track.number, track.duration');
        $this->db->from('track');
        $this->db->join('song', 'track.songId = song.id');
        $this->db->where('track.albumId', $albumId);
        $this->db->order_by('track.number');
        $query = $this->db->get();
        return $query->result();
    }

    public function searchArtists($query) {
        $this->db->like('name', $query);
        $query = $this->db->get('artist');
        return $query->result();
    }

    public function searchAlbums($query) {
        $this->db->select('album.name, album.id, year, artist.name as artistName, genre.name as genreName, jpeg');
        $this->db->from('album');
        $this->db->join('artist', 'album.artistid = artist.id');
        $this->db->join('genre', 'genre.id = album.genreid');
        $this->db->join('cover', 'cover.id = album.coverid');
        $this->db->like('album.name', $query);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAlbumByName($name) {
        $this->db->select('album.name, album.id, year, artist.name as artistName, genre.name as genreName, jpeg');
        $this->db->from('album');
        $this->db->join('artist', 'album.artistid = artist.id');
        $this->db->join('genre', 'genre.id = album.genreid');
        $this->db->join('cover', 'cover.id = album.coverid');
        $this->db->where('album.name', $name);
        $query = $this->db->get();
        return $query->row();
    }

}
?>
