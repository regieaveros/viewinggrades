<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course_model extends CI_Model {

    public function __construct() {

        $this->load->database();

    }

    public function get() {

        return $this->db->get('tbl_course')->result_array();

    }

    public function show_staff_faculty() {

        $staff = "Faculty";

        return $this->db->where('staff', $staff)
                        ->get('tbl_course')
                        ->result_array();

    }

    public function show_staff_student() {

        $staff = "Student";

        return $this->db->where('staff', $staff)
                        ->get('tbl_course')
                        ->result_array();

    }

    public function show($id) {

        return $this->db->where('id', $id)
                        ->get('tbl_course')
                        ->row_array();

    }

    public function insert() {

        $data = array(
            'code' => $this->input->post('course_code'),
            'name' => $this->input->post('course_name'),
            'staff' => $this->input->post('staff'),
        );
        
        return $this->db->insert('tbl_course', $data);
        
    }

    public function update() {

        $id = $this->input->post('id');

        $data = array(
            'code' => $this->input->post('course_code'),
            'name' => $this->input->post('course_name'),
            'staff' => $this->input->post('staff'),
        );

        return $this->db->where('id', $id)
                        ->update('tbl_course', $data);

    }

    public function delete() {

        $id = $this->input->post('id');

        return $this->db->where('id', $id)
                        ->delete('tbl_course');
                        
    }

}