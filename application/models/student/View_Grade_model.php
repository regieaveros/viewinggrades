<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View_Grade_model extends CI_Model {

    public function __construct() {

        $this->load->database();

    }

    public function get() {

        $user_id = $this->session->user_id;

        return $this->db->select('*')
                        ->from('tbl_students')
                        ->join('tbl_student_subjects', 'tbl_student_subjects.student_id = tbl_students.id')
                        ->where('tbl_students.user_id', $user_id)
                        ->get()
                        ->result_array();
        
    }

    public function show() {

        $user_id = $this->session->user_id;

        $row_student_subjects = $this->db->select('*')
            ->from('tbl_students')
            ->join('tbl_student_subjects', 'tbl_student_subjects.student_id = tbl_students.id')
            ->where('tbl_students.user_id', $user_id)
            ->get()
            ->result_array();

        $data = array();

        foreach($row_student_subjects as $row_student_subject) {
            $result = $this->db->where('id', $row_student_subject['subject_id'])
                               ->get('tbl_subject')
                               ->result_array()[0];
                    
            $data[] = array(
                'subject_code' => $result['subject_code'],
                'subject_name' => $result['subject_name'],
                'units' => $result['units'],
                'final_grade' => $row_student_subject['final_grade'],
            );
        }

        return $data;

    }

}