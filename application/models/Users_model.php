<?php

class Users_model extends CI_Model {

    public function __construct() {

        $this->load->database();

    }

    public function login() {

        $this->db->where('email', $this->input->post('email', true));
        $this->db->where('password', $this->input->post('password', true));

        $result = $this->db->get('user');

        if($result->num_rows() == 1) {

            return $result->row_array();

        } else {

            return false;
            
        }

    }

    public function update_profile() {

        $user_id = $this->input->post('user_id');
        $toggle = $this->input->post('toggle-password');

        if($toggle == "on") {

            $data_user = array(
                'avatar' => $this->input->post('image'),
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
            );

        } else {

            $data_user = array(
                'avatar' => $this->input->post('image'),
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
            );

        }

        if($this->session->logged_in && $this->session->access == 0) {

            $data_user_id = array('user_id' => $user_id);
            return $this->db->update('user', $data_user, $data_user_id);

        } elseif($this->session->logged_in && $this->session->access == 1) {

            $this->db->where('user_id', $user_id);
            $query_faculty = $this->db->get('tbl_faculty');
            $row_faculty = $query_faculty->row_array();

            $data_default = array(
                'faculty_name' => $this->input->post('name'),
            );

            $data_faculty = array(
                'name' => $this->input->post('name'),
                'slug' => url_title($this->input->post('name'), '-', true),
            );

            $data_user_id = array('user_id' => $user_id);
            $data_faculty_id = array('faculty_id' => $row_faculty['id']);

            $result = array(
                $this->db->update('user', $data_user, $data_user_id),
                $this->db->update('tbl_faculty', $data_faculty, $data_user_id),
                $this->db->update('tbl_section', $data_default, $data_faculty_id),
                $this->db->update('tbl_students', $data_default, $data_faculty_id),
                $this->db->update('tbl_student_subjects', $data_default, $data_faculty_id),
            );

            return $result;

        } elseif($this->session->logged_in && $this->session->access == 2) {

            $data_student = array(
                'name' => $this->input->post('name'),
                'slug' => url_title($this->input->post('name'), '-', true),
            );

            $data_user_id = array('user_id' => $user_id);

            $result = array(
                $this->db->update('user', $data_user, $data_user_id),
                $this->db->update('tbl_students', $data_student, $data_user_id),
            );

            return $result;

        } else {


            return false;

        }

    }

}