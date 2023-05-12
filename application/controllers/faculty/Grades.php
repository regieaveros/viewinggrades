<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grades extends CI_Controller {

    public function index() {

        if($this->session->logged_in && $this->session->access == 1) {

            $page = "index";
    
            if(!file_exists(APPPATH.'views/faculty/set_grades/'.$page.'.php')) {
                $data['title'] = "Page Not Found";
                $this->load->view('templates/login/header', $data);
                $this->load->view('error404');
                $this->load->view('templates/login/footer');
            }
        
            $data['title'] = "Faculty | List of Student Subjects";
            $data['data'] = $this->Grade_model->get(); 
            
            $this->load->view('templates/users/header', $data);
            $this->load->view('templates/sidebar_faculty');
            $this->load->view('faculty/set_grades/'.$page, $data);
            $this->load->view('templates/users/footer');

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
            
        }

    }

    public function show_grades() {

        if($this->session->logged_in && $this->session->access == 1) {

            $slug_subject = $this->uri->segment(2);
            $id = $this->uri->segment(3);

            $page = "show_grades";
    
            if(!file_exists(APPPATH.'views/faculty/set_grades/'.$page.'.php')) {
                $data['title'] = "Page Not Found";
                $this->load->view('templates/login/header', $data);
                $this->load->view('error404');
                $this->load->view('templates/login/footer');
            }
        
            $data['title'] = "Manage | Student Grades";
            $data['data'] = $this->Grade_Criteria_model->show_subject($id);
            $data['subject_name'] = $data['data']['subject_name'];
            $data['subject_code'] = $data['data']['subject_code'];
            $data['course_code'] = $data['data']['course_code'];
            $data['section'] = $data['data']['section'];
            $data['subject_semester'] = $data['data']['subject_semester'];
            $data['subject_year'] = $data['data']['subject_year'];
            $data['slug_subject'] = $slug_subject;
            $data['id'] = $id;
            $data['students'] = $this->Grade_model->show_students($id);

            $this->load->view('templates/users/header', $data);
            $this->load->view('templates/sidebar_faculty');
            $this->load->view('templates/modal', $data);
            $this->load->view('faculty/set_grades/'.$page, $data);
            $this->load->view('templates/users/footer');

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
            
        }

    }

    public function edit() {

        if($this->session->logged_in && $this->session->access == 1) {

            $id = $this->uri->segment(3);
            $slug_subject = $this->uri->segment(4);
            $subject_id = $this->uri->segment(5);
            
            $this->form_validation->set_error_delimiters(
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">', 
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );

            $criteria_name = $this->Grade_model->show($subject_id);

            foreach($criteria_name as $row) {
                $this->form_validation->set_rules(
                    strtolower($row['criteria_name']), 
                    $row['criteria_name'], 
                    'required'
                );
            }
    
            if($this->form_validation->run() == FALSE) {
    
                $page = "edit";
    
                if(!file_exists(APPPATH.'views/faculty/set_grades/'.$page.'.php')) {
                    $data['title'] = "Page Not Found";
                    $this->load->view('templates/login/header', $data);
                    $this->load->view('error404');
                    $this->load->view('templates/login/footer');
                }
    
                $data['title'] = "Input Grades Student";
                $data['form_edit'] = form_open('grades/input-grades/'.$id.'/'.$slug_subject.'/'.$subject_id);
                $data['data'] = $this->Grade_model->show($subject_id);
                $data['student'] = $this->Grade_model->show_student($id);
                $data['name'] = $data['student']['name'];
                $data['section'] = $data['student']['section'];
                $data['course_code'] = $data['student']['course_code'];
                $data['year_level'] = $data['student']['year_level'];
                $data['semester'] = $data['student']['semester'];
                $data['id'] = $id;  
                $data['slug_subject'] = $slug_subject;
                $data['subject_id'] = $subject_id;
                
                $this->load->view('templates/users/header', $data);
                $this->load->view('templates/sidebar_faculty');
                $this->load->view('faculty/set_grades/'.$page, $data);
                $this->load->view('templates/users/footer');
    
            } else {
    
                $this->Grade_model->update($subject_id);
                $this->session->set_flashdata('grades_updated', 'Grade was updated!');
                redirect(base_url().'grades/'.$slug_subject.'/'.$subject_id);
    
            }

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
            
        }

    }

}