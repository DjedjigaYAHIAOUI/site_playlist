<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Songs extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('model_music');
        // Charge d'autres bibliothèques ou helpers nécessaires
    }

    public function view($albumId) {
        $album = $this->model_music->getAlbumById($albumId);
        $songs = $this->model_music->getSongsByAlbumId($albumId);

        $this->load->view('layout/header');
        $this->load->view('albums_song', ['album' => $album, 'songs' => $songs]);
        $this->load->view('layout/footer');
    }
}
?>