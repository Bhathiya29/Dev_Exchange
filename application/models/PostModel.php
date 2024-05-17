<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PostModel extends CI_Model {

  public function __construct() {
    parent::__construct();
  }
  
  public function get_post_by_id($post_id) {
    $this->db->select('*');
    $this->db->from('posts');
    $this->db->where('PostID', $post_id);
    $query = $this->db->get();
    return $query->row_array();
  }

  public function get_all_posts() {
    // Select all post fields and comments.comment 
    $this->db->select('posts.*, comments.comment');
  
    // Join posts and comments tables on PostID
    $this->db->from('posts');
    $this->db->join('comments', 'posts.PostID = comments.PostID', 'left'); // Use LEFT JOIN to include posts without comments

    // Order by PostID in descending order
    $this->db->order_by('posts.PostID', 'DESC');
  
    // Execute the query
    $query = $this->db->get();
  
    // Check if any rows were found
    if ($query->num_rows() > 0) {
        // Fetch all posts and comments data as an array
        $rows = $query->result_array();
      
        // Initialize an array to store the posts with their comments
        $posts = [];
      
        // Loop through each row
        foreach ($rows as $row) {
            $post_id = $row['PostID'];
            
            // Check if the post has already been added to the posts array
            if (!isset($posts[$post_id])) {
                // Initialize the post data
                $posts[$post_id] = $row;
                // Initialize the comments array for this post
                $posts[$post_id]['comments'] = [];
            }
            
            // If the row contains a comment, add it to the comments array
            if (!empty($row['comment'])) {
                $posts[$post_id]['comments'][] = $row['comment'];
            }
        }
      
        // Return all posts as an indexed array
        return array_values($posts);
    } else {
        // Return an empty array if no posts found
        return [];
    }
}



  
  public function create_post($data) {
    $this->db->insert('posts', $data);
    $insert_id = $this->db->insert_id();

    // Get the affected rows 
    $affected_rows = $this->db->affected_rows();
    
    if ($affected_rows > 0) {
      // Get the updated row using select with same where clause
      $this->db->select('*');
      $this->db->where('PostID', $insert_id);
      $query = $this->db->get('posts');
    
      // Check if query returned a result 
      if ($query->num_rows() === 1) {
      // Return the first row as an array
      return $query->row_array();
      } else {
      // Return null if update was successful but row retrieval failed
      return null;
      }
    } else {
      // Return null if update failed 
      return null;
    }
    



  }

  public function update_likes_count($postId, $likes_count) {
    // Update the likes count as before
    $this->db->set('Likes', $likes_count);
    $this->db->where('PostID', $postId);
    $this->db->update('posts');
  
    // Get the affected rows 
    $affected_rows = $this->db->affected_rows();
  
    // If update was successful 
    if ($affected_rows > 0) {
      // Get the updated row using select with same where clause
      $this->db->select('*');
      $this->db->where('PostID', $postId);
      $query = $this->db->get('posts');
  
      // Check if query returned a result 
      if ($query->num_rows() === 1) {
        // Return the first row as an array
        return $query->row_array();
      } else {
        // Return null if update was successful but row retrieval failed
        return null;
      }
    } else {
      // Return null if update failed 
      return null;
    }
  }

  public function create_comment($data) {
    $this->db->insert('comments', $data);
    $insert_id = $this->db->insert_id();

    // Get the affected rows 
    $affected_rows = $this->db->affected_rows();
    
    if ($affected_rows > 0) {
      // Get the updated row using select with same where clause
      $this->db->select('*');
      $this->db->where('CommentID', $insert_id);
      $query = $this->db->get('comments');
  
      // Check if query returned a result 
      if ($query->num_rows() === 1) {
        // Return the first row as an array
        return $query->row_array();
      } else {
        // Return null if update was successful but row retrieval failed
        return null;
      }
    } else {
      // Return null if update failed 
      return null;
    }
  }
}