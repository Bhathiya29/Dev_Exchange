<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CourseModel'); // Load the model
    }

    public function get_courses() {
        $courses = $this->CourseModel->get_all_courses(); // Call the model method to get all courses
        
        if (!empty($courses)) {
            // Data is available, send it to the front-end
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode($courses));
        } else {
            // No data available, send an error message to the front-end
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(404)
                ->set_output(json_encode(['error' => 'Courses not found']));
        }
    }

}