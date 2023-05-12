<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grade_Criteria_model extends CI_Model {

    public function __construct() {

        $this->load->database();

    }

    public function get() {

        $user_id = $this->session->user_id;

        $row_faculty = $this->db->where('user_id', $user_id)
                                ->get('tbl_faculty')
                                ->row_array();

        $row_subject = $this->db->where('faculty_id', $row_faculty['id'])
                                ->get('tbl_faculty_subject')
                                ->result_array();

        $criteria = array();

        foreach ($row_subject as $subject) {

            $row_criteria = $this->db->where('faculty_subject_id', $subject['id'])
                                     ->get('tbl_criteria')
                                     ->result_array();

            $criteria = array_merge($criteria, $row_criteria);

        }

        $result = array(
            'subject' => $row_subject,
            'criteria' => $criteria
        );

        return $result;

    }

    public function show_subject($id) {

        return $this->db->where('id', $id)
                        ->get('tbl_faculty_subject')
                        ->row_array();

    }

    public function show($id) {

        return $this->db->where('faculty_subject_id', $id)
                        ->get('tbl_criteria')
                        ->result_array();

    }

    public function show_criteria($id) {

        return $this->db->where('id', $id)
                        ->get('tbl_criteria')
                        ->row_array();

    }

    public function insert($id) {
        
        $data = array(
            'faculty_subject_id' => $id,
            'criteria_name' => $this->input->post('criteria'),
            'percentage' => $this->input->post('percentage'),
            'total_items' => $this->input->post('total_items'),
        );

        return $this->db->insert('tbl_criteria', $data);

    }

    public function update() {

        $id = $this->input->post('id');

        $data = array(
            'criteria_name' => $this->input->post('criteria'),
            'percentage' => $this->input->post('percentage'),
            'total_items' => $this->input->post('total_items'),
        );

        return $this->db->where('id', $id)
                        ->update('tbl_criteria', $data);

    }

    public function delete() {

        $id = $this->input->post('id');
        
        return $this->db->where('id', $id)
                        ->delete('tbl_criteria');

    }


}