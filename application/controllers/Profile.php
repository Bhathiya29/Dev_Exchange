<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ProfileModel');
    }

    public function profile() {
        // Getting the userId, username from the GET request
        $userId = $this->input->get('userId');
        $username = $this->input->get('userName');

        error_log("userId: " . $userId . ", userName: " . $username); // Log the form data

        if (empty($userId) && empty($username)) {
            // Responding with an error if no username is provided
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode(['error' => 'Username is required']));
            return;
        }

        // Fetching the user data from the model
        $user = $this->ProfileModel->get_user_by_userId($userId);

        if ($user) {

            // Extracingt the required fields
            $userData = [
                'username' => $user['UserName'],
                'firstname' => $user['FirstName'],
                'lastname' => $user['LastName'],
                'bio' => $user['Bio'],  
                'profile_pic' => $user['ProfilePicture']
            ];

            error_log("userName: " . $userData['username'] . ", firstName: " . $userData['firstname'] . ", lastName: " . $userData['lastname'] . ", Bio: " . $userData['bio']. ", profilePic: " . $userData['profile_pic']);

            // Responding with the user data as JSON
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($userData));
        } else {
            // Responding with an error if the user is not found
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(404)
                ->set_output(json_encode(['error' => 'User not found']));
        }
    }
}
