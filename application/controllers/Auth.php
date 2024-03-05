<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function index(){
        $this->load->helper('url'); 
        $this->load->view('login');
    }

    public function signUp(){
        $this->load->view('signup');
    }

    public function submitLogin(){
        $this->load->model('Auth_model');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->Auth_model->login($username, $password);
        if($user){
            $this->session->set_userdata('user_id', $user['UserID']);
            redirect('feed');
        }else{
            $this->session->set_flashdata('error', 'Invalid username or password');
            redirect('login');
        }
    }

    public function submitSignup(){
        $this->load->model('Auth_model');
        $data = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password')
        );

        $user_id = $this->Auth_model->signup($data);
        if($user_id){
            $this->session->set_userdata('user_id', $user_id);
            redirect('feed');
        }else{
            $this->session->set_flashdata('error', 'Error occurred while signing up');
            redirect('signup');
        }
    }
}



?>