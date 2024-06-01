<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Playlist extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_playlist');
        $this->load->model('Model_user');
        if (!$this->session->userdata('utilisateur_id')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $utilisateur_id = $this->session->userdata('utilisateur_id');
        $playlists = $this->Model_playlist->getPlaylistsByUserId($utilisateur_id);
        $this->load->view('layout/header');
        $this->load->view('playlists_list', ['playlists' => $playlists]);
        $this->load->view('layout/footer');
    }

    public function create() {
        if ($this->input->post()) {
            $nom = $this->input->post('nom');
            $utilisateur_id = $this->session->userdata('utilisateur_id');
            $this->Model_playlist->createPlaylist($utilisateur_id, $nom);
            redirect('playlists');
        } else {
            $this->load->view('layout/header');
            $this->load->view('create_playlist');
            $this->load->view('layout/footer');
        }
    }
}
?>
