<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function login($username, $password){
        $query = $this->db->get_where('users', array('username' => $username, 'password' => $password));
        return $query->row_array();
    }

    public function signup($data){
        return $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

}

?>