<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subjects extends CI_Controller {

    public function index() {

        if($this->session->logged_in && $this->session->access == 0) {
            
            $page = "index";
    
            if(!file_exists(APPPATH.'views/admin/subject/'.$page.'.php')) {
                $data['title'] = "Page Not Found";
                $this->load->view('templates/login/header', $data);
                $this->load->view('error404');
                $this->load->view('templates/login/footer');
            }
        
            $data['title'] = "Admin | Manage Subject";
            $data['data'] = $this->Subject_model->get();
            $data['form_delete'] = form_open('subject/delete');
        
            $this->load->view('templates/users/header', $data);
            $this->load->view('templates/sidebar_admin');
            $this->load->view('templates/modal', $data);
            $this->load->view('admin/subject/'.$page, $data);
            $this->load->view('templates/users/footer');

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
        
        }
    
    }

    public function create() {

        if($this->session->logged_in && $this->session->access == 0) {
            
            $this->form_validation->set_error_delimiters(
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">', 
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );
            $this->form_validation->set_rules('subject_code', 'Subject Code', 'required');
            $this->form_validation->set_rules('subject_name', 'Subject Name', 'required');
            $this->form_validation->set_rules('units', 'Units', 'required');
            $this->form_validation->set_rules('course_code', 'Course', 'required');
            $this->form_validation->set_rules('year_level', 'Year Level', 'required');
            $this->form_validation->set_rules('semester', 'Semester', 'required');
            $this->form_validation->set_rules('subject_type', 'Subject Type', 'required');
    
            if($this->form_validation->run() == FALSE) {
    
                $page = "create";
    
                if(!file_exists(APPPATH.'views/admin/subject/'.$page.'.php')) {
                    $data['title'] = "Page Not Found";
                    $this->load->view('templates/login/header', $data);
                    $this->load->view('error404');
                    $this->load->view('templates/login/footer');
                }
    
                $data['title'] = "Add New Subject";
                $data['courses'] = $this->Course_model->show_staff_student();
                $data['semesters'] = $this->Semester_model->get();
                $data['form_create'] = form_open('subject/create');
                
                $this->load->view('templates/users/header', $data);
                $this->load->view('templates/sidebar_admin');
                $this->load->view('admin/subject/'.$page, $data);
                $this->load->view('templates/users/footer');
    
            } else {
    
                $this->Subject_model->insert();
                $this->session->set_flashdata('subject_added', 'New subject was added!');
                redirect(base_url().'subject');
    
            }

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
        
        }
    
    }

    public function edit($param) {
        
        if($this->session->logged_in && $this->session->access == 0) {
            
            $this->form_validation->set_error_delimiters(
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">', 
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );
            $this->form_validation->set_rules('subject_code', 'Subject Code', 'required');
            $this->form_validation->set_rules('subject_name', 'Subject Name', 'required');
            $this->form_validation->set_rules('units', 'Units', 'required');
            $this->form_validation->set_rules('course_code', 'Course', 'required');
            $this->form_validation->set_rules('year_level', 'Year Level', 'required');
            $this->form_validation->set_rules('semester', 'Semester', 'required');
            $this->form_validation->set_rules('subject_type', 'Subject Type', 'required');
    
            if($this->form_validation->run() == FALSE) {
    
                $page = "edit";
    
                if(!file_exists(APPPATH.'views/admin/subject/'.$page.'.php')) {
                    $data['title'] = "Page Not Found";
                    $this->load->view('templates/login/header', $data);
                    $this->load->view('error404');
                    $this->load->view('templates/login/footer');
                }
    
                $data['title'] = "Edit Subject";
                $data['courses'] = $this->Course_model->show_staff_student();
                $data['semesters'] = $this->Semester_model->get();
                $data['form_edit'] = form_open('subject/edit/'.$param);
                $data['data'] = $this->Subject_model->show($param);
                $data['id'] = $data['data']['id'];
                $data['subject_code'] = $data['data']['subject_code'];
                $data['subject_name'] = $data['data']['subject_name'];
                $data['units'] = $data['data']['units'];
                $data['course_code'] = $data['data']['course_code'];
                $data['year_level'] = $data['data']['year_level'];
                $data['semester'] = $data['data']['semester'];
                $data['subject_type'] = $data['data']['subject_type'];
                
                $this->load->view('templates/users/header', $data);
                $this->load->view('templates/sidebar_admin');
                $this->load->view('admin/subject/'.$page, $data);
                $this->load->view('templates/users/footer');
    
            } else {
    
                $this->Subject_model->update();
                $this->session->set_flashdata('subject_updated', 'Subject was updated!');
                redirect(base_url().'subject');
    
            }

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
        
        }

    }

    public function delete() {

        if($this->session->logged_in && $this->session->access == 0) {
            
            $this->Subject_model->delete();
            $this->session->set_flashdata('subject_deleted', 'Subject was deleted successfully!');
            redirect(base_url().'subject');

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
        
        }

    }

}