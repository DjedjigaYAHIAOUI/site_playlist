<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model_user');
    }

    public function register() {
        if ($this->input->post()) {
            $nom_utilisateur = $this->input->post('nom_utilisateur');
            $mot_de_passe = $this->input->post('mot_de_passe');
            $this->model_user->register($nom_utilisateur, $mot_de_passe);
            redirect('auth/login');
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
                redirect('playlists');
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
