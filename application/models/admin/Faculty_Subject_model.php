<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faculty_Subject_model extends CI_Model {

    public function __construct() {

        $this->load->database();

    }

    public function get() {

        return $this->db->select('tbl_faculty.id, tbl_faculty.name, tbl_faculty.slug, tbl_faculty.course_code, tbl_faculty.course_name')
                        ->select('(SELECT COUNT(tbl_faculty_subject.faculty_id) FROM tbl_faculty_subject WHERE tbl_faculty_subject.faculty_id=tbl_faculty.id) AS subject_count')
                        ->select('(CASE WHEN (SELECT COUNT(*) FROM tbl_faculty_subject WHERE tbl_faculty_subject.faculty_id = tbl_faculty.id AND tbl_faculty_subject.section <> "") = (SELECT COUNT(*) FROM tbl_faculty_subject WHERE tbl_faculty_subject.faculty_id = tbl_faculty.id) THEN "completed" ELSE "not completed" END) AS section_status')
                        ->select('GROUP_CONCAT(DISTINCT tbl_faculty_subject.section) AS sections')
                        ->from('tbl_faculty')
                        ->join('tbl_faculty_subject', 'tbl_faculty.id = tbl_faculty_subject.faculty_id', 'left')
                        ->group_by('tbl_faculty.id')
                        ->get()
                        ->result_array();

    }

    public function join($param) {

        return $this->db->select('*')
                        ->select('(SELECT COUNT(tbl_faculty_subject.faculty_id) FROM tbl_faculty_subject WHERE tbl_faculty_subject.faculty_id=tbl_faculty.id) AS subject_count')
                        ->from('user')
                        ->join('tbl_faculty', 'user.user_id = tbl_faculty.user_id')
                        ->where('tbl_faculty.slug', $param)
                        ->get()
                        ->row_array();

    }

    public function show_faculty_subject($id) {

        return $this->db->where('faculty_id', $id)
                        ->get('tbl_faculty_subject')
                        ->result_array();

    }

    public function show($id) {
        
        $this->db->where('id', $id);

        return $this->db->get('tbl_faculty_subject')->row_array();

    }

    public function show_complete($id) {

        $row_faculty_subject = $this->db->select('tbl_faculty_subject.section')
                                        ->where('faculty_id', $id)
                                        ->get('tbl_faculty_subject')
                                        ->result_array();

        $all_have_section = true;

        foreach ($row_faculty_subject as $row) {
            if (empty($row['section'])) {
                $all_have_section = false;
                break;
            }
        }

        if ($all_have_section) {
            return "Completed";
        } else {
            return "Not Completed";
        }

    }

    public function show_subjects($param) {

        $row_faculty = $this->db->where('slug', $param)
                                ->get('tbl_faculty')
                                ->row_array();

        $subject_type_array = explode(',', $row_faculty['subject_type']);

        return $this->db->where_in('subject_type', $subject_type_array)
                        ->get('tbl_subject')
                        ->result_array();

    }

    public function insert($param) {
        
        $subject_codes = $this->input->post('subject[]');
        
        $row_faculty = $this->db->where('slug', $param)
                                ->get('tbl_faculty')
                                ->row_array();

        foreach ($subject_codes as $subject) {
            $this->db->where('subject_code', $subject);
            $result_subject = $this->db->get('tbl_subject');
            $row_subject = $result_subject->row_array();

            $data = array(
                'faculty_id' => $row_faculty['id'],
                'course_code' => $row_subject['course_code'],
                'subject_id' => $row_subject['id'],
                'slug_subject' => $row_subject['slug'],
                'subject_name' => $row_subject['subject_name'],
                'subject_code' => $row_subject['subject_code'],
                'subject_year' => $row_subject['year_level'],
                'subject_semester' => $row_subject['semester'],
            );

            $this->db->insert('tbl_faculty_subject', $data);
        }

        return true;
        
    }

    public function update() {

        $id = $this->input->post('id');
        $subject =  $this->input->post('subject');

        $row_subject = $this->db->where('subject_code', $subject)
                                ->get('tbl_subject')
                                ->row_array();

        $data = array(
            'subject_id' => $row_subject['id'],
            'course_code' => $row_subject['course_code'],
            'slug_subject' => $row_subject['slug'], 
            'subject_name' => $row_subject['subject_name'],
            'section' => $this->input->post('section'),
            'subject_code' => $row_subject['subject_code'],
            'subject_year' => $row_subject['year_level'],
            'subject_semester' => $row_subject['semester'],
        );

        return $this->db->where('id', $id)
                        ->update('tbl_faculty_subject', $data);

    }

    public function delete() {

        $id = $this->input->post('id');

        return $this->db->where('id', $id)
                        ->delete('tbl_faculty_subject');

    }

}