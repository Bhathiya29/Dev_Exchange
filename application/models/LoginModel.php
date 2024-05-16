<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {

  public function __construct() {
    parent::__construct();
    // Load database library if needed for user credential check (replace with your actual logic)
    // $this->load->database();
  }

  public function verifyCredentials($username, $password) {
    // Replace with your actual logic to check username and password against your user data source (e.g., database)
    // This is a dummy example, replace with your actual validation logic
    // Build your database query to check username and password against user table
    $query = $this->db->get_where('users', array('UserName' => $username));

    if ($query->num_rows() > 0) {
      $user = $query->row(); // Get the user data
      $stored_password = $user->Password; // Get the stored password

      //return password_verify($password, $user->Password); // Use password_verify for secure password comparison
      if ($password === $stored_password) {
        return TRUE; // Username and password match
      } else {
        return FALSE; // Password does not match
      }
    /*
    if ($username === 'admin' && $password === 'password') {
      return TRUE;
    } else {
      return FALSE;
    }*/
  }
}
public function get_userId($username){
  $query = $this->db->get_where('users', array('UserName' => $username));
  if ($query->num_rows() > 0) {
    $user = $query->row(); // Get the user data
    return $user->UserID;
  }
  return -1;
}

}
