<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Playlist extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_playlist');
        $this->load->model('Model_music');
        $this->load->library('session');
        $this->load->helper('url');

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
        $utilisateur_id = $this->session->userdata('utilisateur_id');
        if ($this->input->post()) {
            $nom = $this->input->post('nom');
            $selected_albums = $this->input->post('selected_albums');
            $selected_songs = $this->input->post('selected_songs');
            $this->Model_playlist->createPlaylist($utilisateur_id, $nom, $selected_albums, $selected_songs);
            redirect('playlist');
        } else {
            $albums = $this->Model_music->getAlbums();
            $chansons = $this->Model_music->getChansons();
            $this->load->view('layout/header');
            $this->load->view('create_playlist', ['albums' => $albums, 'chansons' => $chansons]);
            $this->load->view('layout/footer');
        }
    }

    public function select_albums() {
        $albums = $this->Model_music->getAlbums();
        $this->load->view('select_albums', ['albums' => $albums]);
    }

    public function select_songs() {
        $chansons = $this->Model_music->getChansons();
        $this->load->view('select_songs', ['chansons' => $chansons]);
    }
}
?>