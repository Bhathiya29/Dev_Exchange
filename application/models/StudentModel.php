<?php

class StudentModel extends CI_Model{

    public function student_data(){
         $student_name = 'John Doe';
         $this->db->insert('users', array('firstname' => $student_name));
         if ($this->db->affected_rows() > 0) {
            return "Query inserted successfully.";
        } else {
            return "Error inserting query.";
        }
        return $student_name;
    }

}


?>