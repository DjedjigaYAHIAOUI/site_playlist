<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Albums extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('model_music');
    }

    public function index(){
        $albums = $this->model_music->getAlbums();
        $this->load->view('layout/header');
        $this->load->view('albums_list',['albums'=>$albums]);
        $this->load->view('layout/footer');
    }

    public function view($albumId) {
      
        $album = $this->model_music->getAlbumById($albumId);

       
        if ($album) {
           
            $songs = $this->model_music->getSongsByAlbumId($albumId);

           
            $this->load->view('layout/header');
            $this->load->view('album_song', ['album' => $album, 'songs' => $songs]); // Vue renommée ici
            $this->load->view('layout/footer');
        } else {
            
            show_error('Album not found.', 404);
        }
    }

}
?>
