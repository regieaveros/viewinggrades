<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Section_model extends CI_Model {

    public function __construct() {

        $this->load->database();

    }

    public function get() {
        
        return $this->db->order_by('year_level', 'ASC')
                        ->get('tbl_section')
                        ->result_array();

    }

    public function count_section() {

        return $this->db->select('COUNT(tbl_section.id) AS count_section')
                        ->get('tbl_section')
                        ->row_array();

    }

    public function show($param) {

        return $this->db->where('id', $param)
                        ->get('tbl_section')
                        ->row_array();

    }

    public function show_section($course, $year, $semester) {

        return $this->db->where('course_code', $course)
                        ->where('year_level', $year)
                        ->where('semester', $semester)
                        ->get('tbl_section')
                        ->result_array();

    }

    public function insert() {

        $faculty_name = $this->input->post('faculty_name');

        $row = $this->db->where('name', $faculty_name)
                        ->get('tbl_faculty')
                        ->row_array();

        $data = array(
            'faculty_id' => $row['id'],
            'slug_section' => url_title($this->input->post('section'), '-', true),
            'course_code' => $this->input->post('course_code'),
            'section' => $this->input->post('section'),
            'year_level' => $this->input->post('year_level'),
            'semester' => $this->input->post('semester'),
            'faculty_name' => $row['name']
        );
        
        return $this->db->insert('tbl_section', $data);
        
    }

    public function update() {

        $id = $this->input->post('id');
        $faculty_name = $this->input->post('faculty_name');

        $row = $this->db->where('name', $faculty_name)
                        ->get('tbl_faculty')
                        ->row_array();

        
        $data = array(
            'faculty_id' => $row['id'],
            'slug_section' => url_title($this->input->post('section'), '-', true),
            'course_code' => $this->input->post('course_code'),
            'section' => $this->input->post('section'),
            'year_level' => $this->input->post('year_level'),
            'semester' => $this->input->post('semester'),
            'faculty_name' => $row['name']
        );

        return $this->db->where('id', $id)
                        ->update('tbl_section', $data);

    }

    public function delete() {

        $id = $this->input->post('id');

        return $this->db->where('id', $id)
                        ->delete('tbl_section');

    }

}