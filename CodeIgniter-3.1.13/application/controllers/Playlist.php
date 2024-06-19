 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Playlist extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_playlist');
        $this->load->model('Model_music');
        $this->load->library('session');
        $this->load->helper('url');

        if (!$this->session->userdata('utilisateur_id')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $utilisateur_id = $this->session->userdata('utilisateur_id');
        $playlists = $this->Model_playlist->getPlaylistsByUserId($utilisateur_id);
        $this->load->view('layout/header');
        $this->load->view('playlists_list', ['playlists' => $playlists]);
        $this->load->view('layout/footer');
    }

    public function create() {
        $utilisateur_id = $this->session->userdata('utilisateur_id');
       
        if ($this->input->post()) {
            $nom = $this->input->post('nom');
            $id = uniqid();
            $this->Model_playlist->createPlaylist($utilisateur_id, $id, $nom);
           
            redirect('playlist');
        } else {
            $this->load->view('layout/header');
            $this->load->view('create_playlist');
            $this->load->view('layout/footer');
        }
    }

    public function view_playlist($id) {
        $playlist = $this->Model_playlist->getPlaylistById($id);
        $songs = $this->Model_playlist->getSongsInPlaylist($id);
       
        $this->load->view('layout/header');
        $this->load->view('playlist_details', [
            'playlist' => $playlist,
            'songs' => $songs,
            'utilisateur' => $this->session->userdata('utilisateur')
        ]);
        $this->load->view('layout/footer');
    }

    public function add_to_playlist($song_id) {
        $utilisateur_id = $this->session->userdata('utilisateur_id');
        $playlists = $this->Model_playlist->getPlaylistsByUserId($utilisateur_id);
       
        $this->load->view('layout/header');
        $this->load->view('add_to_playlist', [
            'playlists' => $playlists,
            'song_id' => $song_id
        ]);
        $this->load->view('layout/footer');
    }

    public function add_song_to_playlist() {
        $playlist_id = $this->input->post('playlist_id');
        $song_id = $this->input->post('song_id');

        if ($playlist_id && $song_id) {
            if (is_numeric($playlist_id) && is_numeric($song_id)) {
                $result = $this->Model_playlist->addSongToPlaylist($playlist_id, $song_id);

                if ($result) {
                    redirect('playlist/view_playlist/' . $playlist_id);
                } else {
                    show_error('Impossible d\'ajouter la chanson à la playlist.');
                }
            } else {
                show_error('Identifiant de chanson ou de playlist invalide.');
            }
        } else {
            show_error('Identifiant de la playlist ou de la chanson non valide.');
        }
    }

    public function remove_song_from_playlist() {
        $playlist_id = $this->input->post('playlist_id');
        $song_id = $this->input->post('song_id');

        if ($playlist_id && $song_id) {
            if (is_numeric($playlist_id) && is_numeric($song_id)) {
                $result = $this->Model_playlist->removeSongFromPlaylist($playlist_id, $song_id);
               
                if ($result) {
                    redirect('playlist/view_playlist/' . $playlist_id);
                } else {
                    show_error('Impossible de supprimer la chanson de la playlist.');
                }
            } else {
                show_error('Identifiant de chanson ou de playlist invalide.');
            }
        } else {
            show_error('Identifiant de la playlist ou de la chanson non valide.');
        }
    }

    public function duplicate_playlist() {
        $playlist_id = $this->input->post('playlist_id');

        if ($playlist_id && is_numeric($playlist_id)) {
            $new_playlist_id = $this->Model_playlist->duplicatePlaylist($playlist_id);

            if ($new_playlist_id) {
                redirect('playlist' . $new_playlist_id);
            } else {
                show_error('Impossible de dupliquer la playlist.');
            }
        } else {
            show_error('Identifiant de la playlist non valide.');
        }
    }

    public function delete_playlist($playlist_id) {
        if ($playlist_id && is_numeric($playlist_id)) {
            $result = $this->Model_playlist->deletePlaylist($playlist_id);

            if ($result) {
                redirect('playlist');
            } else {
                show_error('Impossible de supprimer la playlist.');
            }
        } else {
            show_error('Identifiant de la playlist non valide.');
        }
    }
    public function generate_random_playlist() {
        // Créer un nouvel ID de playlist
        $playlist_id = random_int(1,9999999);
        $playlist_name = 'Random Playlist ' . date('Y-m-d H:i:s');
   
        // Insérer la nouvelle playlist dans la table playlists
        $data = array(
            'id' => $playlist_id,
            'nom' => $playlist_name,
            'utilisateur_id' => $this->session->userdata('utilisateur_id')
        );
        $this->db->insert('playlists', $data);
   
        // Continuer avec l'ajout des chansons à la playlist
        $songIds = $this->Model_music->get_all_song_ids();
        $albumIds = $this->Model_music->get_all_album_ids();
   
        $randomSongIds = array_rand($songIds, 5);
        $randomAlbumIds = array_rand($albumIds, 3);
   
        foreach ($randomSongIds as $songId) {
            $this->Model_playlist->addSongToPlaylist($playlist_id, $songId);
        }
   
        foreach ($randomAlbumIds as $albumId) {
            $this->add_artist_songs_to_playlist($albumId, $playlist_id);
        }
   
        // Rediriger vers la page de la nouvelle playlist
        redirect('playlist/view_playlist/' . $playlist_id);
    }
   

    private function add_artist_songs_to_playlist($album_id, $playlist_id) {
       
        $songIds = $this->Model_music->getSongIdsByAlbumId($album_id);
       
     
        foreach ($songIds as $songId) {
            $this->Model_playlist->addSongToPlaylist($playlist_id, $songId->id);
        }
    }
      // Méthode pour afficher la liste des chansons de l'artiste et la sélection de la playlist
      public function add_artist_to_playlist($artist_id) {
        // Récupérer l'utilisateur actuel
        $utilisateur_id = $this->session->userdata('utilisateur_id');
       
        // Récupérer les playlists de l'utilisateur
        $playlists = $this->Model_playlist->getPlaylistsByUserId($utilisateur_id);

        // Récupérer les chansons de l'artiste
        $songs = $this->Model_music->getSongsByArtistId($artist_id);

        // Charger la vue pour afficher les chansons et sélectionner la playlist
        $this->load->view('layout/header');
        $this->load->view('artist_song', [
            'playlists' => $playlists,
            'songs' => $songs,
            'artist_id' => $artist_id
        ]);
        $this->load->view('layout/footer');
    }

    // Méthode pour ajouter toutes les chansons de l'artiste sélectionné à la playlist choisie
    public function add_songs_to_playlist_action() {
        // Récupérer les données du formulaire
        $artist_id = $this->input->post('artist_id');
        $playlist_id = $this->input->post('playlist_id');
   
        // Récupérer les chansons de l'artiste
        $songs = $this->Model_music->getSongsByArtistId($artist_id);
   
        // Ajouter chaque chanson à la playlist
        foreach ($songs as $song) {
            $this->Model_playlist->addSongToPlaylist($playlist_id, $song->id);
        }
   
        // Rediriger vers une page de succès ou de confirmation
        redirect('playlist/view_playlist/' . $playlist_id);
    }
   
}
?>