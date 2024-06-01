<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Playlists extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_playlist');
        $this->load->model('Model_user');
        $this->load->library('session');


    }

    public function index($utilisateur_id) {
        // Vérifier l'authentification de l'utilisateur ici si nécessaire
        $playlists = $this->Model_playlist->getPlaylistsByUserId($utilisateur_id);
        $this->load->view('layout/header');
        $this->load->view('playlists_list', ['playlists' => $playlists]);
        $this->load->view('layout/footer');
    }

    public function create($utilisateur_id) {
        // Vérifier l'authentification de l'utilisateur ici si nécessaire
        if ($this->input->post()) {
            $nom = $this->input->post('nom');
            $this->Model_playlist->createPlaylist($utilisateur_id, $nom);
            redirect('playlists/index/'.$utilisateur_id);
        } else {
            $this->load->view('layout/header');
            $this->load->view('create_playlist');
            $this->load->view('layout/footer');
        }
    }
}
?>
