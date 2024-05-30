<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model_music'); // Charger le modèle de la musique
    }

    public function index() {
        $query = $this->input->post('query'); // Récupérer la requête de recherche depuis le formulaire POST
        $data['search_query'] = $query; // Passer la requête de recherche à la vue
        $data['artists'] = $this->model_music->searchArtists($query); // Rechercher des artistes basés sur la requête
        $data['albums'] = $this->model_music->searchAlbums($query); // Rechercher des albums basés sur la requête

        $this->load->view('layout/header'); // Charger l'en-tête de la page
        $this->load->view('search_results', $data); // Charger la vue des résultats de recherche avec les données
        $this->load->view('layout/footer'); // Charger le pied de page
    }

}
?>
