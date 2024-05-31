<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artists extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('model_music');
    }

    public function index(){
        $artists = $this->model_music->getArtists();
        $this->load->view('layout/header');
        $this->load->view('artists_list', ['artists' => $artists]);
        $this->load->view('layout/footer');
    }

    public function view($artistId) {
        $artist = $this->model_music->getArtistById($artistId);
        $albums = $this->model_music->getAlbumsByArtistId($artistId);

        $this->load->view('layout/header');
        $this->load->view('artist_albums', ['artist' => $artist, 'albums' => $albums]);
        $this->load->view('layout/footer');
    }
}
?>
