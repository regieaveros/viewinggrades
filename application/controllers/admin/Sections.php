<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sections extends CI_Controller {

    public function index() {

        if($this->session->logged_in && $this->session->access == 0) {
            
            $page = "index";
    
            if(!file_exists(APPPATH.'views/admin/section/'.$page.'.php')) {
                $data['title'] = "Page Not Found";
                $this->load->view('templates/login/header', $data);
                $this->load->view('error404');
                $this->load->view('templates/login/footer');
            }
        
            $data['title'] = "Admin | Manage Section";
            $data['data'] = $this->Section_model->get();
            $data['form_delete'] = form_open('section/delete');
        
            $this->load->view('templates/users/header', $data);
            $this->load->view('templates/sidebar_admin');
            $this->load->view('templates/modal', $data);
            $this->load->view('admin/section/'.$page, $data);
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
            $this->form_validation->set_rules('course_code', 'Course', 'required');
            $this->form_validation->set_rules('section', 'Section', 'required');
            $this->form_validation->set_rules('year_level', 'Year Level', 'required');
            $this->form_validation->set_rules('semester', 'Semester', 'required');
            $this->form_validation->set_rules('faculty_name', 'Adviser', 'required');
    
            if($this->form_validation->run() == FALSE) {
    
                $page = "create";
    
                if(!file_exists(APPPATH.'views/admin/section/'.$page.'.php')) {
                    $data['title'] = "Page Not Found";
                    $this->load->view('templates/login/header', $data);
                    $this->load->view('error404');
                    $this->load->view('templates/login/footer');
                }
    
                $data['title'] = "Add New Section";
                $data['form_create'] = form_open('section/create');
                $data['courses'] = $this->Course_model->show_staff_student();
                $data['semesters'] = $this->Semester_model->get();
                $data['faculties'] = $this->Faculty_model->get();
                
                $this->load->view('templates/users/header', $data);
                $this->load->view('templates/sidebar_admin');
                $this->load->view('admin/section/'.$page, $data);
                $this->load->view('templates/users/footer');
    
            } else {
    
                $this->Section_model->insert();
                $this->session->set_flashdata('section_added', 'New section was added!');
                redirect(base_url().'section');
    
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
            $this->form_validation->set_rules('course_code', 'Course', 'required');
            $this->form_validation->set_rules('section', 'Section', 'required');
            $this->form_validation->set_rules('year_level', 'Year Level', 'required');
            $this->form_validation->set_rules('semester', 'Semester', 'required');
            $this->form_validation->set_rules('faculty_name', 'Adviser', 'required');
    
            if($this->form_validation->run() == FALSE) {
    
                $page = "edit";
    
                if(!file_exists(APPPATH.'views/admin/section/'.$page.'.php')) {
                    $data['title'] = "Page Not Found";
                    $this->load->view('templates/login/header', $data);
                    $this->load->view('error404');
                    $this->load->view('templates/login/footer');
                }
    
                $data['title'] = "Edit Section";
                $data['form_edit'] = form_open('section/edit/'.$param);
                $data['data'] = $this->Section_model->show($param);
                $data['courses'] = $this->Course_model->show_staff_student();
                $data['semesters'] = $this->Semester_model->get();
                $data['faculties'] = $this->Faculty_model->get();
                $data['id'] = $data['data']['id'];
                $data['course_code'] = $data['data']['course_code'];
                $data['section'] = $data['data']['section'];
                $data['year_level'] = $data['data']['year_level'];
                $data['semester'] = $data['data']['semester'];
                $data['faculty_name'] = $data['data']['faculty_name'];
                
                $this->load->view('templates/users/header', $data);
                $this->load->view('templates/sidebar_admin');
                $this->load->view('admin/section/'.$page, $data);
                $this->load->view('templates/users/footer');
    
            } else {
    
                $this->Section_model->update();
                $this->session->set_flashdata('section_updated', 'Section was updated!');
                redirect(base_url().'section');
    
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
            
            $this->Section_model->delete();
            $this->session->set_flashdata('section_deleted', 'Section was deleted successfully!');
            redirect(base_url().'section');

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
        
        }

    }

}