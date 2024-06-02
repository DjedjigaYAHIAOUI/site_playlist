<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model_user');
        $this->load->library('session');  // Chargement de la bibliothèque de session
        $this->load->helper('url');  // Chargement du helper URL
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
                redirect('auth/register');
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

    public function logout() {
        $this->session->unset_userdata('utilisateur_id');
        redirect('auth/login');
    }
}
?>
