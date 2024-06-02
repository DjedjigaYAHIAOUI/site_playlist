<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_music'); // Charger le modèle de musique
        $this->load->model('Model_playlist'); // Charger le modèle de playlist
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

    public function create_playlist() {
        if ($this->input->post()) {
            // Récupérer l'ID de l'utilisateur actuellement connecté
            $utilisateur_id = $this->session->userdata('utilisateur_id');
            
            // Récupérer le nom de la playlist à partir des données POST
            $nom = $this->input->post('nom');

            // Appeler la méthode du modèle pour créer une nouvelle playlist
            $this->Model_playlist->createPlaylist($utilisateur_id, $nom);
            
            // Rediriger vers la page d'accueil ou toute autre page appropriée après la création de la playlist
            redirect('welcome');
        }
    }
}
?>