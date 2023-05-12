<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faculty_model extends CI_Model {

    public function __construct() {

        $this->load->database();

    }

    public function get() {

        return $this->db->get('tbl_faculty')->result_array();

    }

    public function count_faculty() {
        
        return $this->db->select('COUNT(tbl_faculty.id) AS count_faculty')
                        ->get('tbl_faculty')
                        ->row_array();

    }

    public function join() {

        return $this->db->select('*')
                        ->from('user')
                        ->join('tbl_faculty', 'user.user_id = tbl_faculty.user_id')
                        ->get()
                        ->result_array();

    }

    public function show($param) {

        return $this->db->select('*')
                        ->from('user')
                        ->join('tbl_faculty', 'user.user_id = tbl_faculty.user_id')
                        ->where('tbl_faculty.id', $param)
                        ->get()
                        ->row_array();

    }

    public function insert() {

        $random = rand(1000000000,9999999999);

        $course = $this->input->post('course_code');

        $row_course = $this->db->where('code', $course)
                               ->get('tbl_course')
                               ->row_array();

        $faculty_data = array(
            'user_id' => $random,
            'id_number' => $this->input->post('id_number'),
            'slug' => url_title($this->input->post('name'), '-', true),
            'name' => $this->input->post('name'),
            'course_code' => $row_course['code'],
            'course_name' => $row_course['name'],
            'subject_type' => implode(",", $this->input->post('subject_type[]'))
        );

        $user_data = array(
            'user_id' => $random,
            'id_number' => $this->input->post('id_number'),
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'role' => 1
        );

        $result = array(
            $this->db->insert('tbl_faculty', $faculty_data),
            $this->db->insert('user', $user_data)
        );
        
        return $result;
        
    }

    public function update($id) {

        $user_id = $this->input->post('user_id');
        $course_code = $this->input->post('course_code');

        $row_course = $this->db->where('code', $course_code)
                               ->get('tbl_course')
                               ->row_array();

        $row_faculty_subject = $this->db->select('COUNT(tbl_faculty_subject.faculty_id) AS count')
                                        ->from('tbl_faculty_subject')
                                        ->where('faculty_id', $id)
                                        ->get()
                                        ->row_array();

        $row_students = $this->db->select('COUNT(tbl_students.faculty_id) AS count')
                                 ->from('tbl_students')
                                 ->where('faculty_id', $id)
                                 ->get()
                                 ->row_array();

        $row_student_subject = $this->db->select('COUNT(tbl_student_subjects.faculty_id) AS count')
                                        ->from('tbl_student_subjects')
                                        ->where('faculty_id', $id)
                                        ->get()
                                        ->row_array();

        $faculty_data = array(
            'id_number' => $this->input->post('id_number'),
            'slug' => url_title($this->input->post('name'), '-', true),
            'name' => $this->input->post('name'),
            'course_code' => $row_course['code'],
            'course_name' => $row_course['name'],
            'subject_type' => implode(",", $this->input->post('subject_type[]'))
        );

        $user_data = array(
            'id_number' => $this->input->post('id_number'),
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        );

        $faculty_user_id = array('user_id' => $user_id);
        $faculty_id = array('faculty_id' => $id);

        if($row_faculty_subject['count'] != 0 && $row_student_subject['count'] == 0 && $row_students['count'] == 0) {

            $faculty_subject_data = array(
                'slug_name' => url_title($this->input->post('name'), '-', true),
            );

            $result = array(
                $this->db->update('tbl_faculty_subject', $faculty_subject_data, $faculty_id),
                $this->db->update('tbl_faculty', $faculty_data, $faculty_user_id),
                $this->db->update('user', $user_data, $faculty_user_id)
            );

        } elseif($row_student_subject['count'] != 0 && $row_faculty_subject['count'] == 0 && $row_students['count'] == 0) {

            $students_data = array(
                'faculty_name' => $this->input->post('name'),
            );

            $result = array(
                $this->db->update('tbl_student_subjects', $students_data, $faculty_id),
                $this->db->update('tbl_faculty', $faculty_data, $faculty_user_id),
                $this->db->update('user', $user_data, $faculty_user_id)
            );

        } elseif($row_students['count'] != 0 && $row_faculty_subject['count'] == 0 && $row_student_subject['count'] == 0) {

            $students_data = array(
                'faculty_name' => $this->input->post('name'),
            );

            $result = array(
                $this->db->update('tbl_students', $students_data, $faculty_id),
                $this->db->update('tbl_faculty', $faculty_data, $faculty_user_id),
                $this->db->update('user', $user_data, $faculty_user_id)
            );

        } elseif($row_faculty_subject['count'] != 0 && $row_student_subject['count'] != 0 && $row_students['count'] != 0) {

            $faculty_subject_data = array(
                'slug_name' => url_title($this->input->post('name'), '-', true)
            );

            $students_data = array(
                'faculty_name' => $this->input->post('name')
            );

            $result = array(
                $this->db->update('tbl_students', $students_data, $faculty_id),
                $this->db->update('tbl_faculty_subject', $faculty_subject_data, $faculty_id),
                $this->db->update('tbl_student_subjects', $students_data, $faculty_id),
                $this->db->update('tbl_faculty', $faculty_data, $faculty_user_id),
                $this->db->update('user', $user_data, $faculty_user_id)
            );

        } else {
            
            $result = array(
                $this->db->update('tbl_faculty', $faculty_data, $faculty_user_id),
                $this->db->update('user', $user_data, $faculty_user_id),
            );

        }

        return $result;

    }

    public function delete() {

        $user_id = $this->input->post('id');
        $tables = array('tbl_faculty', 'user');

        return $this->db->where('user_id', $user_id)
                        ->delete($tables);


    }

}