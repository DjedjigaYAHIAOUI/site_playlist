<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_playlist extends CI_Model {

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getPlaylistsByUserId($utilisateur_id) {
        $this->db->where('utilisateur_id', $utilisateur_id);
        $query = $this->db->get('playlists');
        return $query->result();
    }

    public function createPlaylist($utilisateur_id, $nom) {
        $data = array(
            'utilisateur_id' => $utilisateur_id,
            'nom' => $nom
        );
        return $this->db->insert('playlists', $data);
    }

    public function getPlaylistById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('playlists');
        return $query->row();
    }

    public function getSongsInPlaylist($playlist_id) {
        $this->db->select('chansons.*');
        $this->db->from('playlists_songs');
        $this->db->join('chansons', 'playlists_songs.song_id = chansons.id');
        $this->db->where('playlists_songs.playlist_id', $playlist_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAlbumsInPlaylist($playlist_id) {
        $this->db->select('albums.*');
        $this->db->from('playlists_albums');
        $this->db->join('albums', 'playlists_albums.album_id = albums.id');
        $this->db->where('playlists_albums.playlist_id', $playlist_id);
        $query = $this->db->get();
        return $query->result();
    }

    // Méthode pour ajouter une chanson à une playlist
    public function addSongToPlaylist($playlist_id, $song_id) {
        // Vérifier si la chanson est déjà dans la playlist
        $this->db->where('playlist_id', $playlist_id);
        $this->db->where('song_id', $song_id);
        $query = $this->db->get('playlists_songs');

        if ($query->num_rows() == 0) {
            $data = array(
                'playlist_id' => $playlist_id,
                'song_id' => $song_id
            );
            return $this->db->insert('playlists_songs', $data);
        }
        return false; // La chanson est déjà dans la playlist
    }
}

