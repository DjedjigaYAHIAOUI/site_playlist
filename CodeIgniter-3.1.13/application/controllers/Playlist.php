<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Playlist extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_playlist');
        $this->load->model('Model_user');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index() {
        $this->load->view('layout/header');
        $this->load->view('playlist_list', ['playlists' => $this->Model_playlist->getPlaylistsByUserId($this->session->userdata('utilisateur_id'))]);
        $this->load->view('layout/footer');
    }

    public function create() {
        if (!$this->session->userdata('utilisateur_id')) {
            $this->session->set_userdata('redirect_url', 'playlist/create');
            redirect('auth/login');
        }

        $utilisateur_id = $this->session->userdata('utilisateur_id');
        if ($this->input->post()) {
            $nom = $this->input->post('nom');
            $this->Model_playlist->createPlaylist($utilisateur_id, $nom);
            redirect('playlist');
        } else {
            $this->load->view('layout/header');
            $this->load->view('create_playlist');
            $this->load->view('layout/footer');
        }
    }
}
?>
