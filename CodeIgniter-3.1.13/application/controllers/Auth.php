<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Playlist extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_playlist');
        $this->load->model('Model_user');
        $this->load->library('session');

        // Vérifier l'authentification de l'utilisateur ici
        if (!$this->session->userdata('utilisateur_id')) {
            redirect('auth/login');
        }
    }
    public function register() {
        if ($this->input->post()) {
            $nom_utilisateur = $this->input->post('nom_utilisateur');
            $mot_de_passe = $this->input->post('mot_de_passe');
            $user_id = $this->model_user->register($nom_utilisateur, $mot_de_passe);
            if ($user_id) {
                // Inscription réussie, rediriger vers la page de création de playlist
                $this->session->set_userdata('utilisateur_id', $user_id);
                redirect('playlist/create');
            } else {
                // Gérer l'échec de l'inscription
                $this->load->view('register', array('error' => 'Échec de l\'inscription. Veuillez réessayer.'));
            }
        } else {
            $this->load->view('register');
        }
    }

    public function login() {
        if ($this->input->post()) {
            $nom_utilisateur = $this->input->post('nom_utilisateur');
            $mot_de_passe = $this->input->post('mot_de_passe');
            $user = $this->model_user->login($nom_utilisateur, $mot_de_passe);
            if ($user) {
                $this->session->set_userdata('utilisateur_id', $user->id);
                redirect('playlist');
            } else {
                $this->load->view('login', array('error' => 'Nom d\'utilisateur ou mot de passe invalide.'));
            }
        } else {
            $this->load->view('login');
        }
    }
    public function index() {
        $utilisateur_id = $this->session->userdata('utilisateur_id');
        $playlists = $this->Model_playlist->getPlaylistsByUserId($utilisateur_id);
        $this->load->view('layout/header');
        $this->load->view('playlist_list', ['playlists' => $playlists]);
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
}
?>