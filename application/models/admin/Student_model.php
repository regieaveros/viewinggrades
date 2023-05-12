<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_model extends CI_Model {

    public function __construct() {

        $this->load->database();

    }

    public function get() {

        return $this->db->select('*')
                        ->select('(SELECT COUNT(tbl_students.section) FROM tbl_students WHERE tbl_students.section=tbl_section.section) AS student_section_count')
                        ->get('tbl_section')
                        ->result_array();

    }

    public function count_student() {

        return $this->db->select('COUNT(tbl_students.id) AS count_student')
                        ->get('tbl_students')
                        ->row_array();

    }

    public function join($param) {

        return $this->db->select('*')
                        ->select('(SELECT COUNT(tbl_student_subjects.student_id) FROM tbl_student_subjects WHERE tbl_student_subjects.student_id=tbl_students.id) AS subject_count')
                        ->from('user')
                        ->join('tbl_students', 'user.user_id = tbl_students.user_id')
                        ->where('section', $param)
                        ->get()
                        ->result_array();

    }

    public function show_section($param) {

        return $this->db->select('*')
                        ->select('(SELECT COUNT(tbl_students.section) FROM tbl_students WHERE tbl_students.section=tbl_section.section) AS student_section_count')
                        ->where('section', $param)
                        ->get('tbl_section')
                        ->row_array();

    }

    public function show_complete($param) {

        $rows = $this->db->select('(SELECT COUNT(tbl_student_subjects.student_id) FROM tbl_student_subjects WHERE tbl_student_subjects.student_id=tbl_students.id) AS subject_count')
                         ->where('section', $param)
                         ->get('tbl_students')
                         ->result_array();

        $filtered_rows = array_filter($rows, function($row) {
            return $row['subject_count'] > 0;
        });

        $subject_counts = array_column($filtered_rows, 'subject_count');
        $num_rows = count($filtered_rows);

        if ($num_rows === 0) {

            return false;

        } elseif (count(array_unique($subject_counts)) === 1 && count($filtered_rows) === count($rows)) {

            return true;

        } else {

            return false;
        }

    }

    public function show($param) {

        return $this->db->select('*')
                        ->from('user')
                        ->join('tbl_students', 'user.user_id = tbl_students.user_id')
                        ->where('tbl_students.id', $param)
                        ->get()
                        ->row_array();

    }

    public function insert($param) {

        $row = $this->db->where('section', $param)
                        ->get('tbl_section')
                        ->row_array();

        $random = rand(1000000000,9999999999);

        $student_data = array(
            'user_id' => $random,
            'faculty_id' => $row['faculty_id'],
            'id_number' => $this->input->post('id_number'),
            'slug' => url_title($this->input->post('name'), '-', true),
            'name' => $this->input->post('name'),
            'course_code' => $row['course_code'],
            'year_level' => $row['year_level'],
            'section' => $row['section'],
            'semester' => $row['semester'],
            'faculty_name' => $row['faculty_name']
        );

        $user_data = array(
            'user_id' => $random,
            'id_number' => $this->input->post('id_number'),
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'role' => 2
        );

        $result = array(
            $this->db->insert('tbl_students', $student_data),
            $this->db->insert('user', $user_data)
        );
        
        return $result;
        
    }

    public function insert_subjects($id, $param) {

        $rows = $this->db->select('*')
                         ->from('tbl_faculty')
                         ->join('tbl_faculty_subject', 'tbl_faculty.id = tbl_faculty_subject.faculty_id')
                         ->where('section', $param)
                         ->get()
                         ->result_array();

        foreach($rows as $row) {

            $data = array(
                'student_id' => $id,
                'subject_id' => $row['subject_id'],
                'faculty_id' => $row['faculty_id'],
                'course' => $row['course_code'],
                'slug_subject' => $row['slug_subject'],
                'subject_code' => $row['subject_code'],
                'subject_name' => $row['subject_name'],
                'section' => $row['section'],
                'faculty_name' => $row['name']
            );

            $this->db->insert('tbl_student_subjects', $data);

        }

    }

    public function update($param) {

        $id = $this->input->post('id');

        $row = $this->db->where('section', $param)
                        ->get('tbl_section')
                        ->row_array();

        $student_data = array(
            'faculty_id' => $row['faculty_id'],
            'id_number' => $this->input->post('id_number'),
            'slug' => url_title($this->input->post('name'), '-', true),
            'name' => $this->input->post('name'),
            'course_code' => $row['course_code'],
            'year_level' => $row['year_level'],
            'section' => $row['section'],
            'semester' => $row['semester'],
            'faculty_name' => $row['faculty_name']
        );

        $user_data = array(
            'id_number' => $this->input->post('id_number'),
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        );

        $user_id = array('user_id' => $id);

        $result = array(
            $this->db->update('tbl_students', $student_data, $user_id),
            $this->db->update('user', $user_data, $user_id)
        );

        return $result;

    }

    public function update_complete($param) {

        $data = array(
            'students_subject_status' => 1,
        );

        return $this->db->where('section', $param)
                        ->update('tbl_section', $data);

    }

    public function delete() {

        $user_id = $this->input->post('id');
        $tables = array('tbl_students', 'user');

        return $this->db->where('user_id', $user_id)
                        ->delete($tables);

    }
}