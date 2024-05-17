<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('PostModel');
    $this->load->model('CommentModel');

    header('Access-Control-Allow-Origin: *'); 
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
    
     // Handle preflight request
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
      // Handle the preflight request
      header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
      header('Access-Control-Allow-Headers: Content-Type, Authorization');
      exit;
    } 
  }

    public function index(){

    }   

    public function content() {
        $posts = $this->PostModel->get_all_posts();

        if ($posts) {
            error_log("Posts found: " . count($posts));
            foreach($posts as $post) {
                error_log("Post ID: " . $post['PostID'] . ", caption: " . $post['Caption']);
            }
            $this->sendSuccessResponse($posts);
        } else {
            $this->sendErrorResponse('Posts not found');
        }
}

    private function sendSuccessResponse($data) {
        $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($data));
    }

    private function sendErrorResponse($message) {
        $this->output
            ->set_content_type('application/json')
            ->set_status_header(404)
            ->set_output(json_encode(['error' => $message]));
    }

    public function get_single_post() {
        $postId = $this->input->get('postId');

        $post = $this->PostModel->get_post_by_id($postId);
        if ($post) {
            $this->sendSuccessResponse($post);
        } else {
            $this->sendErrorResponse('Post not found');
        }
    }
  public function show($post_id) {
    $post = $this->Post_model->get_post_by_id($post_id);
    if ($post) {
      $comments = $this->Comment_model->get_comments_by_post_id($post_id);
      $this->load->view('single_post', ['post' => $post, 'comments' => $comments]);
    } else {
      // not handled as its not necessary
    }
  }

  public function like_post() {
    $postId = $this->input->get('postId');

    $post = $this->PostModel->get_post_by_id($postId);
    if ($post) {
      $new_likes_count = $post['Likes'] + 1;
      if ($this->PostModel->update_likes_count($postId, $new_likes_count)) {
        $post = $this->PostModel->get_post_by_id($postId);
        $this->sendSuccessResponse($post);
      } else {
        $this->sendErrorResponse('Failed to like post');
      }
    }
  }

  public function create_comment() {

      // Get JSON data sent from frontend
      $data = json_decode(file_get_contents('php://input'), true);
      // Extract username and password from JSON data
      $postId = $this->input->get('postId');
      $userId = isset($data['userID']) ? $data['userID'] : '';
      $comment = isset($data['text']) ? $data['text'] : '';
   
      error_log("UserId: " . $userId . ", Comment: " . $comment); // Log the form data


    if ($comment) {
      $data = [
        'PostID' => $postId,
        'UserID' => $userId,
        'Comment' => $comment,
      ];

      $result = $this->CommentModel->create_comment($data);

      if ($result) {
        $this->sendSuccessResponse($result);
      } else {
        $this->sendErrorResponse('Failed to create comment');
      }
      
  }
    else {
      $this->sendErrorResponse('Comment text is required');
    }
    }

  public function create_post(){
    $data = json_decode(file_get_contents('php://input'), true);
    $caption = isset($data['caption']) ? $data['caption'] : '';
    $image = isset($data['image']) ? $data['image'] : '';
    $userId = isset($data['userID']) ? $data['userID'] : '';
    $userName = isset($data['userName']) ? $data['userName'] : '';


    if ($caption && $image && $userId&& $userName) {
      $data = [
        'Caption' => $caption,
        'Image' => $image,
        'UserID' => $userId,
        'UserName' => $userName,
        'Likes' => 0,
      ];

      $result = $this->PostModel->create_post($data);

      if ($result) {
        $this->sendSuccessResponse($result);
      } else {
        $this->sendErrorResponse('Failed to create post');
      }
    } else {
      $this->sendErrorResponse('Caption, image, and user ID are required');
    }
  }
}