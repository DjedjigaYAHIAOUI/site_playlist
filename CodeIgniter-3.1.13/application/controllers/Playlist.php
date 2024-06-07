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
            $this->Model_playlist->createPlaylist($utilisateur_id, $nom);
            redirect('playlist');
        } else {
            $this->load->view('layout/header');
            $this->load->view('create_playlist');
            $this->load->view('layout/footer');
        }
    }

    public function view_playlist($id) {
        $playlist = $this->Model_playlist->getPlaylistById($id);
        $songs = $this->Model_playlist->getSongsInPlaylist($id);
        $albums = $this->Model_playlist->getAlbumsInPlaylist($id);
        
        $this->load->view('layout/header');
        $this->load->view('playlist_detail', [
            'playlist' => $playlist,
            'songs' => $songs,
            'albums' => $albums,
            'utilisateur' => $this->session->userdata('utilisateur')
        ]);
        $this->load->view('layout/footer');
    }

    public function add_to_playlist($song_id) {
        $utilisateur_id = $this->session->userdata('utilisateur_id');
        $playlists = $this->Model_playlist->getPlaylistsByUserId($utilisateur_id);
        
        $this->load->view('layout/header');
        $this->load->view('add_to_playlist', [
            'playlists' => $playlists,
            'song_id' => $song_id
        ]);
        $this->load->view('layout/footer');
    }

    public function add_to_playlist_action() {
        $playlist_id = $this->input->post('playlist_id');
        $song_id = $this->input->post('song_id');
        
        $this->Model_playlist->addSongToPlaylist($playlist_id, $song_id);
        redirect('playlist/view_playlist/' . $playlist_id);
    }
}
?>

