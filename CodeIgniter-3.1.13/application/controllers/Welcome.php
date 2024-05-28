<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('model_music');
    }

    public function index(){
        // Récupérer la liste des artistes
        $artists = $this->model_music->getArtists();

        // Récupérer la liste des albums
        $albums = $this->model_music->getAlbums();

        // Charger la vue 'welcome_message.php'
        $this->load->view('welcome_message', [
            'artists' => $artists,
            'albums' => $albums
        ]);
    }
}
?>
