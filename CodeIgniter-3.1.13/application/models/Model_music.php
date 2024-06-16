<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_music extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getAlbums() {
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

    public function getChansons() {
        $query = $this->db->query(
            "SELECT song.id, song.name, album.name as albumName, artist.name as artistName 
            FROM song 
            JOIN track ON track.songId = song.id
            JOIN album ON track.albumId = album.id
            JOIN artist ON album.artistid = artist.id
            ORDER BY album.year, track.number"
        );
        return $query->result();
    }

    public function getGenres() {
        $query = $this->db->query(
            "SELECT id, name FROM genre ORDER BY name"
        );
        return $query->result();
    }

    public function searchArtists($query) {
        $result = $this->db->query(
            "SELECT id, name FROM artist 
            WHERE name LIKE ?", array("%$query%")
        );
        return $result->result();
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
        $result = $this->db->query(
            "SELECT album.name, album.id, year, artist.name as artistName, genre.name as genreName, jpeg 
            FROM album 
            JOIN artist ON album.artistid = artist.id
            JOIN genre ON genre.id = album.genreid
            JOIN cover ON cover.id = album.coverid
            WHERE album.name LIKE ?", array("%$query%")
        );
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

    public function getArtistById($artistId) {
        $query = $this->db->query(
            "SELECT id, name FROM artist WHERE id = ?", array($artistId)
        );
        return $query->row();
    }

    public function getAlbumsByArtistId($artistId) {
        $query = $this->db->query(
            "SELECT album.name, album.id, year, artist.name as artistName, genre.name as genreName, jpeg 
            FROM album 
            JOIN artist ON album.artistid = artist.id
            JOIN genre ON genre.id = album.genreid
            JOIN cover ON cover.id = album.coverid
            WHERE artist.id = ?
            ORDER BY year", array($artistId)
        );
        return $query->result();
    }

    public function getSongsByArtistId($artistId) {
        $query = $this->db->query(
            "SELECT song.id, song.name, album.name as albumName, album.year
            FROM song
            JOIN track ON track.songId = song.id
            JOIN album ON track.albumId = album.id
            WHERE album.artistid =      ?
            ORDER BY album.year, track.number", array($artistId)
        );
        return $query->result();
    }

    public function getPopularArtists($limit = 8) {
        $this->db->select('artist.id, artist.name');
        $this->db->from('artist');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result();
    }

    public function searchSongs($query) {
        $result = $this->db->query(
            "SELECT song.id, song.name, album.name as albumName, artist.name as artistName
            FROM song
            JOIN track ON track.songId = song.id
            JOIN album ON track.albumId = album.id
            JOIN artist ON album.artistid = artist.id
            WHERE song.name LIKE ?", array("%$query%")
        );
        return $result->result();
    }

  
    public function addSongToPlaylist($songId, $playlistId) {
       
        $existingEntry = $this->db->get_where('playlists_songs', array('playlist_id' => $playlistId, 'song_id' => $songId))->row();
    
        if (!$existingEntry) {
          
            $data = array(
                'playlist_id' => $playlistId,
                'song_id' => $songId
            );
    
            return $this->db->insert('playlists_songs', $data); 
        } else {
            
            return false;
        }
    }

     
    
    
    public function addAlbumToPlaylist($albumId, $playlistId) {
        
        $songIds = $this->getSongIdsByAlbumId($albumId);
    
       
        if (!empty($songIds)) {
       
            foreach ($songIds as $songId) {
                $data = array(
                    'playlist_id' => $playlistId,
                    'song_id' => $songId->id 
                );
    
              
                $this->db->insert('playlist_songs', $data);
            }
            return true; 
        } else {
            return false; 
        }
    }
 
    public function getSongIdsByAlbumId($albumId) {
        $query = $this->db->query(
            "SELECT song.id
            FROM track
            JOIN song ON track.songId = song.id
            WHERE track.albumId = ?", array($albumId)
        );
        return $query->result();
    }
    
    public function get_all_album_ids() {
        $this->db->select('id');
        $query = $this->db->get('album');
        return $query->result();
    }
    public function get_all_song_ids() {
        $this->db->select('id');
        $query = $this->db->get('song');
        return $query->result();

        
    }
    public function search_albums_by_letter($letter) {
        $result = $this->db->query(
            "SELECT album.name, album.id, year, artist.name as artistName, genre.name as genreName, jpeg 
            FROM album 
            JOIN artist ON album.artistid = artist.id
            JOIN genre ON genre.id = album.genreid
            JOIN cover ON cover.id = album.coverid
            WHERE album.name LIKE ?", array("$letter%")
        );
        return $result->result();
    }
    
    public function search_artists_by_letter($letter) {
        $result = $this->db->query(
            "SELECT id, name FROM artist 
            WHERE name LIKE ?", array("$letter%")
        );
        return $result->result();
    }
    
    public function search_songs_by_letter($letter) {
        $result = $this->db->query(
            "SELECT song.id, song.name as songName, album.name as albumName, artist.name as artistName
            FROM song
            JOIN track ON track.songId = song.id
            JOIN album ON track.albumId = album.id
            JOIN artist ON album.artistid = artist.id
            WHERE song.name LIKE ?", array("$letter%")
        );
        return $result->result();
    }
    
}