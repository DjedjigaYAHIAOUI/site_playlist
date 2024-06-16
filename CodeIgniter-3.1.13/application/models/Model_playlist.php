<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_playlist extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getPlaylistsByUserId($utilisateur_id) {
        $this->db->where('utilisateur_id', $utilisateur_id);
        $query = $this->db->get('playlists');
        return $query->result();
    }

    public function createPlaylist($utilisateur_id, $id, $nom) {
        $data = array(
            'utilisateur_id' => $utilisateur_id,
            'id' => $id,
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
        $this->db->select('song.*');
        $this->db->from('playlist_songs');
        $this->db->join('song', 'playlist_songs.song_id = song.id');
        $this->db->where('playlist_songs.playlist_id', $playlist_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function addSongToPlaylist($playlist_id, $song_id) {
        $data = array(
            'playlist_id' => $playlist_id,
            'song_id' => $song_id
        );
    
        $this->db->where('id', $song_id);
        $query = $this->db->get('song');
    
        if ($query->num_rows() > 0) {
            return $this->db->insert('playlist_songs', $data);
        } else {
            return false;
        }
    }

    public function getSongByName($song_name) {
        $this->db->select('id');
        $this->db->from('song');
        $this->db->where('name', $song_name);
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function removeSongFromPlaylist($playlist_id, $song_id) {
        $this->db->where('playlist_id', $playlist_id);
        $this->db->where('song_id', $song_id);
        return $this->db->delete('playlist_songs');
    }
    public function duplicatePlaylist($playlist_id) {
        // Récupération de la playlist existante par son ID
        $playlist = $this->getPlaylistById($playlist_id);
    
        if (!$playlist) {
            return false; // La playlist n'existe pas
        }
    
        // Génération d'un nouvel ID unique pour la nouvelle playlist
        do {
            $new_playlist_id = bin2hex(random_bytes(8)); 
            $existing = $this->db->get_where('playlists', ['id' => $new_playlist_id])->row();
        } while ($existing);
    
        // Préparation des données pour la nouvelle playlist
        $new_playlist_data = [
            'id' => $new_playlist_id,
            'nom' => $playlist->nom . ' (Copie)',
            'utilisateur_id' => $playlist->utilisateur_id
        ];
    
        // Insertion de la nouvelle playlist dans la base de données
        if ($this->db->insert('playlists', $new_playlist_data)) {
            // Copie des chansons de la playlist existante vers la nouvelle playlist
            $songs = $this->getSongsInPlaylist($playlist_id);
            foreach ($songs as $song) {
                $this->db->insert('playlist_songs', [
                    'playlist_id' => $new_playlist_id,
                    'song_id' => $song->id
                ]);
            }
    
            // Redirection vers la page de la nouvelle playlist après duplication
            redirect('playlist' . $new_playlist_id);
    
            // Retourner true pour indiquer le succès (même si la redirection a lieu, pour une éventuelle utilisation ultérieure)
            return true;
        } else {
            // En cas d'erreur lors de l'insertion, loguer l'erreur et retourner false
            $error = $this->db->error();
            log_message('error', 'Database error during playlist duplication: ' . $error['message']);
            return false;
        }
    }
    
    
    public function deletePlaylist($playlist_id) {
        $this->db->where('playlist_id', $playlist_id);
        $this->db->delete('playlist_songs');
    
        $this->db->where('id', $playlist_id);
        return $this->db->delete('playlists');
    }
    public function get_all_song_ids() {
        $this->db->select('id');
        $query = $this->db->get('song');
        return $query->result_array();
    }

    public function get_all_album_ids() {
        $this->db->select('id');
        $query = $this->db->get('album');
        return $query->result_array();
    }

    public function getAllPlaylists() {
        $query = $this->db->get('playlists');
        return $query->result();
    }
}
?>