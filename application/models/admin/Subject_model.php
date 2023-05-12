<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject_model extends CI_Model {

    public function __construct() {

        $this->load->database();

    }

    public function get() {

        return $this->db->get('tbl_subject')
                        ->result_array();

    }

    public function count_subject() {

        return $this->db->select('COUNT(tbl_subject.id) AS count_subject')
                        ->get('tbl_subject')
                        ->row_array();

    }

    public function count_subject_types() {

        $result = $this->db->select('subject_type, course_code, COUNT(tbl_subject.subject_type) as count')
                           ->group_by('subject_type')
                           ->group_by('course_code')
                           ->get('tbl_subject')
                           ->result_array();

        $subjectTypes = [
            1 => 'Computer Programming', 
            2 => 'Computer Networking', 
            3 => 'Computer Database', 
            4 => 'Computer Security', 
            5 => 'Computer Graphics', 
            6 => 'Computer Peripherals', 
            7 => 'Analytics', 
            8 => 'Mathematics', 
            9 => 'History & Philosophy', 
            10 => 'Business', 
            11 => 'Statistics', 
            12 => 'Arts', 
            13 => 'Service Training', 
            14 => 'Physical Education', 
            15 => 'Communication', 
            16 => 'Values', 
            17 => 'Thesis', 
            18 => 'On Job Training(OJT)'
        ];

        foreach ($result as &$row) {

            $subjectTypeCode = $row['subject_type'];

            if (isset($subjectTypes[$subjectTypeCode])) {
                $row['subject_type'] = $subjectTypes[$subjectTypeCode];
            }

        }

        return $result;

    }

    public function show($id) {

        return $this->db->where('id', $id)
                        ->get('tbl_subject')
                        ->row_array();

    }

    public function insert() {

        $data = array(
            'slug' => url_title($this->input->post('subject_code'), '-', true),
            'subject_code' => $this->input->post('course_code')." - ".$this->input->post('subject_code'),
            'subject_name' => $this->input->post('subject_name'),
            'units' => $this->input->post('units'),
            'course_code' => $this->input->post('course_code'),
            'year_level' => $this->input->post('year_level'),
            'semester' => $this->input->post('semester'),
            'subject_type' => $this->input->post('subject_type')
        );
        
        return $this->db->insert('tbl_subject', $data);
        
    }

    public function update() {

        $id = $this->input->post('id');

        $row_faculty_subject = $this->db->select('COUNT(tbl_faculty_subject.subject_id) AS count')
                                        ->where('subject_id', $id)
                                        ->get('tbl_faculty_subject')
                                        ->row_array();

        $row_student_subject = $this->db->select('COUNT(tbl_student_subjects.subject_id) AS count')
                                        ->where('subject_id', $id)
                                        ->get('tbl_student_subjects')
                                        ->row_array();

        $data_subject = array(
            'slug' => url_title($this->input->post('subject_code'), '-', true),
            'subject_code' => $this->input->post('course_code')." - ".$this->input->post('subject_code'),
            'subject_name' => $this->input->post('subject_name'),
            'units' => $this->input->post('units'),
            'course_code' => $this->input->post('course_code'),
            'year_level' => $this->input->post('year_level'),
            'semester' => $this->input->post('semester'),
            'subject_type' => $this->input->post('subject_type')
        );

        $data_id = array('id' => $id);
        $subject_id = array('subject_id' => $id);

        if($row_faculty_subject['count'] != 0 ) {

            $data_faculty_subject = array(
                'slug_subject' => url_title($this->input->post('subject_code'), '-', true),
                'subject_code' => $this->input->post('course_code')." - ".$this->input->post('subject_code'),
                'subject_name' => $this->input->post('subject_name'),
                'subject_year' => $this->input->post('year_level'),
                'subject_semester' => $this->input->post('semester'),
            );

            $result = array(
                $this->db->update('tbl_subject', $data_subject, $data_id),
                $this->db->update('tbl_faculty_subject', $data_faculty_subject, $subject_id),
            );

        } elseif($row_student_subject['count'] != 0) {

            $data_student_subject = array(
                'slug_subject' => url_title($this->input->post('subject_code'), '-', true),
                'subject_code' => $this->input->post('course_code')." - ".$this->input->post('subject_code'),
                'subject_name' => $this->input->post('subject_name'),
            );

            $result = array(
                $this->db->update('tbl_subject', $data_subject, $data_id),
                $this->db->update('tbl_student_subjects', $data_student_subject, $subject_id),
            );

        } else {

            $result = array(
                $this->db->update('tbl_subject', $data_subject, $data_id),
            );

        }

        return $result;

    }

    public function delete() {

        $id = $this->input->post('id');

        return $this->db->where('id', $id)
                        ->delete('tbl_subject');

    }

}