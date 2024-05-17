<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Enable CORS
header("Access-Control-Allow-Origin: http://127.0.0.1:8080");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

class Signup extends CI_Controller {

    public function __construct() {
        parent::__construct();
    
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
        
        // Load User_model
        $this->load->model('UserModel');
        
        // Check if loading was successful 
        if ($this->load->is_loaded('UserModel')) {
            error_log("User_model is loaded properly.");
        } else {
            error_log("User_model failed to load.");  
        }
    }

    public function index() {
        // No implementaion done because backbone is doing the rendering
    }

    public function register() {

        // Handle signup form submission
        $data = json_decode(file_get_contents('php://input'), true);
        
        // Validate data 
        if(empty($data['firstname']) || empty($data['lastname']) || empty($data['email']) || empty($data['username']) || empty($data['password']) || empty($data['bio']) || empty($data['dob'])|| empty($data['profilepicture'])) {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode(array('error' => 'All fields are required')));
            return;
        }

        // Save data to database using the model
        $result = $this->UserModel->register_user($data);


        if($result) {
            // Respond with success message
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array('message' => 'Signup successful')));
        } else {
            // Respond with error message
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode(array('error' => 'Failed to register user')));
        }
    }

}
