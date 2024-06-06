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
}
?>
