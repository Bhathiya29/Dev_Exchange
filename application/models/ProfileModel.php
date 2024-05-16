<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfileModel extends CI_Model {

    public function __construct() {
        parent::__construct();
       // $this->load->database();
    }

    public function get_user_by_userId($userId) {
        $this->db->where('userID', $userId);
        $query = $this->db->get('users'); // Assuming your table name is 'users'
        return $query->row_array(); // Return a single row as an associative array
    }
}
