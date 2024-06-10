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
        $playlist = $this->getPlaylistById($playlist_id);
        
        if (!$playlist) {
            return false;
        }

        $new_playlist_data = [
            'nom' => $playlist->nom . ' (Copie)',
            'utilisateur_id' => $playlist->utilisateur_id
        ];
        $this->db->insert('playlists', $new_playlist_data);
        $new_playlist_id = $this->db->insert_id();

        $songs = $this->getSongsInPlaylist($playlist_id);

        foreach ($songs as $song) {
            $this->db->insert('playlist_songs', [
                'playlist_id' => $new_playlist_id,
                'song_id' => $song->id
            ]);
        }

        return $new_playlist_id;
    }

    public function deletePlaylist($playlist_id) {
        // Vérifie si la playlist existe avant de la supprimer
        $this->db->where('id', $playlist_id);
        $this->db->delete('playlists');
        
        if ($this->db->affected_rows() > 0) {
            // Suppression réussie
            return true;
        } else {
            // La playlist n'existe pas ou suppression échouée
            return false;
        }
    }
}
?>

