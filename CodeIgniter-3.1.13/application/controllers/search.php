<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->models('Model_music');
    }

    public function index() {
        $query = $this->input->post('query');
        $data['search_query'] = $query;
        $data['artists'] = $this->Model_music->searchArtists($query);
        $data['albums'] = $this->Model_music->searchAlbums($query);
        $this->load->view('layout/header', $data);
        $this->load->view('search_results', $data);
        $this->load->view('layout/footer', $data);
    


        // Charger la vue 'search_results.php' pour afficher les résultats
        $this->load->view('views/search_results');
       
    }

}