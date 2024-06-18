<?php
defined('BASEPATH') OR exit('No direct script access allowed');


    class Search extends CI_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->model('Model_music');
            $this->load->model('Model_playlist');
            $this->load->helper('url');
        }
    
        public function index() {
            $query = $this->input->get('$query');
            $letter = $this->input->get('$letter');
        
            if ($letter) {
                $albums = $this->Model_music->search_albums_by_letter($letter);
                $artists = $this->Model_music->search_artists_by_letter($letter);
                $songs = $this->Model_music->search_songs_by_letter($letter);
            } else {
                $albums = $this->Model_music->search_albums($query);
                $artists = $this->Model_music->search_artists($query);
                $songs = $this->Model_music->search_songs($query);
            }
        
            // Débogage
            echo "<pre>";
            print_r($songs);
            echo "</pre>";
            die();
        
            $this->load->view('search_results', ['albums' => $albums, 'artists' => $artists, 'songs' => $songs]);
        }
        
    }
    