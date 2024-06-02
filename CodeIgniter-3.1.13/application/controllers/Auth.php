<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model_user');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function register() {
        if ($this->input->post()) {
            $nom_utilisateur = $this->input->post('nom_utilisateur');
            $mot_de_passe = $this->input->post('mot_de_passe');
            $result = $this->model_user->register($nom_utilisateur, $mot_de_passe);

            if ($result === 'duplicate') {
                $this->load->view('login', array('register_error' => 'Le nom d\'utilisateur existe déjà. Veuillez en choisir un autre.'));
            } else {
                redirect('auth/login');
            }
        } else {
            $this->load->view('login');
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
