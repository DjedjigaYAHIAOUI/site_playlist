
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_user extends CI_Model {

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function register($nom_utilisateur, $mot_de_passe) {
        $data = array(
            'nom_utilisateur' => $nom_utilisateur,
            'mot_de_passe' => password_hash($mot_de_passe, PASSWORD_BCRYPT)
        );
        return $this->db->insert('utilisateurs', $data);
    }

    public function login($nom_utilisateur, $mot_de_passe) {
        $this->db->where('nom_utilisateur', $nom_utilisateur);
        $query = $this->db->get('utilisateurs');
        $user = $query->row();
        if ($user && password_verify($mot_de_passe, $user->mot_de_passe)) {
            return $user;
        } else {
            return null;
        }
    }
}
?>
