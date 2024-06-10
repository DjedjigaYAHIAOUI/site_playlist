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
            // Utiliser le modèle pour supprimer la playlist
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
}
?>
