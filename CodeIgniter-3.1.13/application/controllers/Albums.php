<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Albums extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->model('model_music');
        $this->load->model('model_playlist');
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

    public function view($albumId) {
        // Récupérer les informations de l'album
        $album = $this->model_music->getAlbumById($albumId);

        $user_id = $this->session->userdata('utilisateur_id');

        // Récupérer les chansons de l'album à partir de la table `track`
        $songs = $this->model_music->getSongsByAlbumId($albumId);

        $playlists = $this->model_playlist->getPlaylistsByUserId($user_id);

        // Définir l'ID de la playlist (si applicable)
        $playlist_id = null; // Vous pouvez mettre ici la logique pour récupérer le playlist_id si nécessaire

        // Passer les données à la vue
        $this->load->view('layout/header');
        $this->load->view('albums_song', [
            'album' => $album,
            'songs' => $songs,
            'playlist_id' => $playlist_id, // Passer l'ID de la playlist
            'playlists' => $playlists
        ]);
        $this->load->view('layout/footer');
    }
    public function add_album_to_playlist_action() {
        $albumId = $this->input->post('album_id');
        $playlistId = $this->input->post('playlist_id');
        
        if (!empty($albumId) && !empty($playlistId)) {
            // Charger le modèle Model_music si ce n'est pas déjà fait
            $this->load->model('Model_music');
    
            // Appeler la méthode pour ajouter l'album à la playlist
            $result = $this->Model_music->addAlbumToPlaylist($albumId, $playlistId);
    
            if ($result) {
                // Rediriger vers la vue de la playlist ou une autre action après l'ajout
                redirect('playlist/view/' . $playlistId);
            } else {
                // Gérer les erreurs si nécessaire
                // Par exemple, afficher un message d'erreur ou rediriger vers une page d'erreur
                redirect('error');
            }
        } else {
            // Gérer les cas où les paramètres ne sont pas fournis correctement
            // Par exemple, afficher un message d'erreur ou rediriger vers une page d'erreur
            redirect('error');
        }
    }
    
    public function album_details($albumId) {
        // Charger le modèle Model_music
        $this->load->model('Model_music');
        
        // Récupérer les détails de l'album
        $album = $this->Model_music->getAlbumById($albumId);
    
        // Récupérer la liste des playlists disponibles
        $playlists = $this->Model_playlist->getAllPlaylists();
    
        // Charger la vue des détails de l'album avec les données nécessaires
        $this->load->view('album_details', array('album' => $album, 'playlists' => $playlists));
    }
    
}
?>

