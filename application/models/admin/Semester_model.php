<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Semester_model extends CI_Model {

    public function __construct() {

        $this->load->database();

    }

    public function get() {

        return $this->db->get('tbl_semester')->result_array();

    }

    public function show($param) {

        return $this->db->where('id', $param)
                        ->get('tbl_semester')
                        ->row_array();

    }

    public function insert() {

        $data = array(
            'semester' => $this->input->post('semester')
        );

        return $this->db->insert('tbl_semester', $data);
        
    }

    public function update() {

        $id = $this->input->post('id');

        $data = array(
            'semester' => $this->input->post('semester')
        );

        return $this->db->where('id', $id)
                        ->update('tbl_semester', $data);

    }

    public function delete() {

        $id = $this->input->post('id');

        return $this->db->where('id', $id)
                        ->delete('tbl_semester');

    }

}