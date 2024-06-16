<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_music'); 
        $this->load->model('Model_playlist'); 
        $this->load->helper('url'); 
    }

    public function index() {
      
        $popular_artists = $this->Model_music->getPopularArtists();
        $artists = $this->Model_music->getArtists();
        $albums = $this->Model_music->getAlbums();

       
        $this->load->view('welcome_message', [
            'popular_artists' => $popular_artists,
            'artists' => $artists,
            'albums' => $albums
        ]);
    }

    public function search() {
        $query = $this->input->post('query');

        $albums = $this->Model_music->search_Albums($query);
        $artists = $this->Model_music->searchArtists($query);
        $songs = $this->Model_music->searchSongs($query);

        $this->load->view('search_results', [
            'albums' => $albums,
            'artists' => $artists,
            'songs' => $songs
        ]);
    }

    public function create_playlist() {
        if ($this->input->post()) {
            $utilisateur_id = $this->session->userdata('utilisateur_id');
            
            $nom = $this->input->post('nom');

            $this->Model_playlist->createPlaylist($utilisateur_id, $nom);
            
            redirect('welcome');
        }
    }

    public function artist_songs($artistId) {
        $songs = $this->Model_music->getSongsByArtistId($artistId);

        $playlists = $this->Model_playlist->getAllPlaylists();

        $this->load->view('artist_songs', [
            'songs' => $songs,
            'playlists' => $playlists,
            'artist_id' => $artistId  
        ]);
    }
    
}
?>

