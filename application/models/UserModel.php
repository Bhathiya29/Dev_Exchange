<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function register_user($data) {
        if ($this->db->insert('users', $data)) {
            // Insertion successful
            return $this->db->insert_id();
        } else {
            // Insertion failed
            log_message('error', 'Failed to register user: ' . $this->db->error_message());
            return false;
        }
    }
    
    

    //public function register_user($data) {
        // Insert user data into the database
        //return $this->db->insert('users', $data);
    //}

}
