<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_Subject_model extends CI_Model {
    
    public function __construct() {

        $this->load->database();

    }

    public function get() {

        return $this->db->select('*')
                        ->select('(SELECT COUNT(tbl_student_subjects.student_id) FROM tbl_student_subjects WHERE tbl_student_subjects.student_id=tbl_students.id) AS subject_count')
                        ->get('tbl_students')
                        ->result_array();

    }

    public function join($param) {

        return $this->db->select('*')
                        ->select('(SELECT COUNT(tbl_student_subjects.student_id) FROM tbl_student_subjects WHERE tbl_student_subjects.student_id=tbl_students.id) AS subject_count')
                        ->from('user')
                        ->join('tbl_students', 'user.user_id = tbl_students.user_id')
                        ->where('tbl_students.slug', $param)
                        ->get()
                        ->row_array();

    }

    public function show_student_subject($id) {

        return $this->db->where('student_id', $id)
                        ->get('tbl_student_subjects')
                        ->result_array();

    }

    public function show($id) {

        return $this->db->where('id', $id)
                        ->get('tbl_student_subjects')
                        ->row_array();

    }

    public function show_create_subjects($id) {

        $row_student = $this->db->where('id', $id)
                                ->get('tbl_students')
                                ->row_array();

        return $this->db->where('course_code', $row_student['course_code'])
                        ->get('tbl_subject')
                        ->result_array();

    }

    public function show_edit_subjects($id) {

        $row_student_subject = $this->db->where('id', $id)
                                        ->get('tbl_student_subjects')
                                        ->row_array();

        return $this->db->where('course_code', $row_student_subject['course'])
                        ->get('tbl_subject')
                        ->result_array();

    }

    public function show_faculty($slug, $id) {

        return $this->db->select('*')
                        ->from('tbl_faculty')
                        ->join('tbl_faculty_subject', 'tbl_faculty.id = tbl_faculty_subject.faculty_id')
                        ->where('subject_id', $id)
                        ->where('slug_subject', $slug)
                        ->get()
                        ->result_array();
        
    }

    public function insert($id) {

        $subject_code = $this->input->post('subject');
        $faculty_id = $this->input->post('faculty');

        $row_faculty = $this->db->where('id', $faculty_id)
                                ->get('tbl_faculty')
                                ->row_array();

        $row_subject = $this->db->where('subject_code', $subject_code)
                                ->where('faculty_id', $faculty_id)
                                ->get('tbl_faculty_subject')
                                ->row_array();

        $data = array(
            'student_id' => $id,
            'subject_id' => $row_subject['subject_id'],
            'faculty_id' => $row_subject['faculty_id'],
            'course' => $row_subject['course_code'],
            'slug_subject' => $row_subject['slug_subject'],
            'subject_code' => $row_subject['subject_code'],
            'subject_name' => $row_subject['subject_name'],
            'section' => $row_subject['section'],
            'faculty_name' => $row_faculty['name']
        );
        
        return $this->db->insert('tbl_student_subjects', $data);

    }

    public function update($id) {

        $subject_code = $this->input->post('subject');
        $faculty_id = $this->input->post('faculty');

        $row_faculty = $this->db->where('id', $faculty_id)
                                ->get('tbl_faculty')
                                ->row_array();

        $row_subject = $this->db->where('subject_code', $subject_code)
                                ->where('faculty_id', $faculty_id)
                                ->get('tbl_faculty_subject')
                                ->row_array();

        $data = array(
            'subject_id' => $row_subject['subject_id'],
            'faculty_id' => $row_subject['faculty_id'],
            'slug_subject' => $row_subject['slug_subject'],
            'subject_code' => $row_subject['subject_code'],
            'subject_name' => $row_subject['subject_name'],
            'section' => $row_subject['section'],
            'faculty_name' => $row_faculty['name']
        );

        return $this->db->where('id', $id)
                        ->update('tbl_student_subjects', $data);

    }

    public function delete() {

        $id = $this->input->post('id');

        return $this->db->where('id', $id)
                        ->delete('tbl_student_subjects');

    }

}