<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller{

    public function index(){
        $this->load->model('StudentModel');
        
        $result = $this->StudentModel->student_data();
        error_log('Student data: ' . $result);
        echo $result;
    }
}

?>