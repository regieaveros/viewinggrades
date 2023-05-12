<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_Grade_model extends CI_model {

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

        return $row_subject;

    }

    public function show_students($id, $slug) {

        return $this->db->select('*')
                        ->from('tbl_students')
                        ->join('tbl_student_subjects', 'tbl_student_subjects.student_id = tbl_students.id')
                        ->where('tbl_student_subjects.faculty_id', $id)
                        ->where('tbl_student_subjects.slug_subject', $slug)
                        ->get()
                        ->result_array();

    }

    public function show_faculty($id, $slug) {

        return $this->db->select('*')
                        ->from('tbl_faculty')
                        ->join('tbl_faculty_subject', 'tbl_faculty_subject.faculty_id = tbl_faculty.id')
                        ->where('tbl_faculty_subject.faculty_id', $id)
                        ->where('tbl_faculty_subject.slug_subject', $slug)
                        ->get()
                        ->row_array();

    }

}