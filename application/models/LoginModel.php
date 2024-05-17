<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {

  public function __construct() {
    parent::__construct();
   
  }

  public function verifyCredentials($username, $password) {
    // Query the database
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
