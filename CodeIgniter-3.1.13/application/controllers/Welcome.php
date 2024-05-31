<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_music'); // Charger le modèle de musique
        $this->load->helper('url'); // Charger l'helper pour les URLs
    }

    public function index() {
        // Récupérer tous les artistes et albums initialement
        $artists = $this->Model_music->getArtists();
        $albums = $this->Model_music->getAlbums();

        // Charger la vue principale 'welcome_message.php' avec les artistes et albums
        $this->load->view('welcome_message', [
            'artists' => $artists,
            'albums' => $albums
        ]);
    }

    public function search() {
        // Récupérer la requête de recherche depuis les données POST
        $query = $this->input->post('query');

        // Effectuer la recherche d'albums, d'artistes et de chansons en utilisant les méthodes du modèle
        $albums = $this->Model_music->search_Albums($query);
        $artists = $this->Model_music->search_Artists($query);
        $songs = $this->Model_music->search_Songs($query);

        // Charger la vue 'search_results.php' avec les résultats de la recherche
        $this->load->view('search_results', [
            'albums' => $albums,
            'artists' => $artists,
            'songs' => $songs
        ]);
    }

}
?>
