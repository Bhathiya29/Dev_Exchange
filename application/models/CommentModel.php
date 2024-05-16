<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CommentModel extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  public function get_comments_by_post_id($post_id) {
    $this->db->select('comments.*, users.username');
    $this->db->from('comments');
    $this->db->join('users', 'comments.user_id = users.id');
    $this->db->where('comments.post_id', $post_id);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function create_comment($data) {
    $this->db->insert('comments', $data);
    return $this->db->insert_id();
  }
}