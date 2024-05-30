<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Albums extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('model_music');
    }

    public function index(){
        $albums = $this->model_music->getAlbums();
        $genres = $this->model_music->getGenres();

        $this->load->view('layout/header');
        $this->load->view('albums_list', ['albums' => $albums, 'genres' => $genres]);
        $this->load->view('layout/footer');
    }

    public function genre() {
        $genreId = $this->input->get('genre_id');

        if ($genreId) {
            $albums = $this->model_music->getAlbumsByGenreId($genreId);
        } else {
            $albums = $this->model_music->getAlbums();
        }

        $genres = $this->model_music->getGenres();

        $this->load->view('layout/header');
        $this->load->view('albums_list', ['albums' => $albums, 'genres' => $genres]);
        $this->load->view('layout/footer');
    }
}
?>
