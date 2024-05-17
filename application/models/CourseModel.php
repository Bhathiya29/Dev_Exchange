<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CourseModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_courses()
    {
        $query = $this->db->get('courses');
        return $query->result();
    }

}