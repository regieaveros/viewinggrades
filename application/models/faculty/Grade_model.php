<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grade_model extends CI_Model {

    public function __construct() {

        $this->load->database();

    }

    public function get() {

        $user_id = $this->session->user_id;

        $faculty = $this->db->where('user_id', $user_id)
                            ->get('tbl_faculty')
                            ->row_array();
        
        $faculty_subjects = $this->db->select('*')
                                     ->select('(SELECT COUNT(tbl_faculty_subject.faculty_id) FROM tbl_faculty_subject WHERE tbl_faculty_subject.faculty_id=tbl_student_subjects.faculty_id) AS count_students')
                                     ->from('tbl_student_subjects')
                                     ->join('tbl_faculty_subject', 'tbl_student_subjects.faculty_id = tbl_faculty_subject.faculty_id')
                                     ->where('tbl_faculty_subject.faculty_id', $faculty['id'])
                                     ->group_by('tbl_faculty_subject.id')
                                     ->get()
                                     ->result_array();
        
        $criteria = array();
        
        foreach ($faculty_subjects as $faculty_subject) {
            
            $criteria = array_merge(
                $criteria, 
                $this->db->where('faculty_subject_id', $faculty_subject['id'])
                         ->group_by('tbl_criteria.faculty_subject_id')
                         ->get('tbl_criteria')
                         ->result_array()
            );
        }
        
        $result = [
            'faculty_subject' => $faculty_subjects,
            'criteria' => $criteria
        ];
        
        return $result;

    }

    public function show_students($id) {

        $row_faculty_subject = $this->db->where('id', $id)
                                        ->get('tbl_faculty_subject')
                                        ->row_array();

        $row_student_subject = $this->db->select('*')
                                        ->from('tbl_students')
                                        ->join('tbl_student_subjects', 'tbl_student_subjects.student_id = tbl_students.id')
                                        ->where('tbl_student_subjects.faculty_id', $row_faculty_subject['faculty_id'])
                                        ->where('tbl_student_subjects.subject_id', $row_faculty_subject['subject_id'])
                                        ->get()
                                        ->result_array();

        return $row_student_subject;

    }

    public function show_student($id) {

        $row = $this->db->where('id', $id)
                        ->get('tbl_student_subjects')
                        ->row_array();

        return $this->db->where('id', $row['student_id'])
                        ->get('tbl_students')
                        ->row_array();

    }

    public function show($id) {

        return $this->db->where('faculty_subject_id', $id)
                        ->get('tbl_criteria')
                        ->result_array();

    }

    public function update($id) {

        $subject_id = $this->input->post('id');

        $row_criteria = $this->db->where('faculty_subject_id', $id)
                                 ->get('tbl_criteria')
                                 ->result_array();

        $data = array();

        foreach($row_criteria as $row) {
            $data[strtolower($row['criteria_name'])] = $this->input->post(strtolower($row['criteria_name'])) / $row['total_items'] * $row['percentage'];
        }
        
        $total = array_sum($data);

        $result = array(
            'final_grade' => $total,
            'grade_status' => $total >= 50 ? 1 : 0
        );

        return $this->db->where('id', $subject_id)
                        ->update('tbl_student_subjects', $result);
        
    }

}