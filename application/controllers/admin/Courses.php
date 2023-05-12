<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends CI_Controller {

    public function index() {

        if($this->session->logged_in && $this->session->access == 0) {
            
            $page = "index";
    
            if(!file_exists(APPPATH.'views/admin/course/'.$page.'.php')) {
                $data['title'] = "Page Not Found";
                $this->load->view('templates/login/header', $data);
                $this->load->view('error404');
                $this->load->view('templates/login/footer');
            }
        
            $data['title'] = "Admin | Manage Course";
            $data['data'] = $this->Course_model->get();
            $data['form_delete'] = form_open('course/delete');
        
            $this->load->view('templates/users/header', $data);
            $this->load->view('templates/sidebar_admin');
            $this->load->view('templates/modal', $data);
            $this->load->view('admin/course/'.$page, $data);
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
            $this->form_validation->set_rules('course_code', 'Course Code', 'required');
            $this->form_validation->set_rules('course_name', 'Course Name', 'required');
    
            if($this->form_validation->run() == FALSE) {
    
                $page = "create";
    
                if(!file_exists(APPPATH.'views/admin/course/'.$page.'.php')) {
                    $data['title'] = "Page Not Found";
                    $this->load->view('templates/login/header', $data);
                    $this->load->view('error404');
                    $this->load->view('templates/login/footer');
                }
    
                $data['title'] = "Add New Course";
                $data['form_create'] = form_open('course/create');
                
                $this->load->view('templates/users/header', $data);
                $this->load->view('templates/sidebar_admin');
                $this->load->view('admin/course/'.$page, $data);
                $this->load->view('templates/users/footer');
    
            } else {
    
                $this->Course_model->insert();
                $this->session->set_flashdata('course_added', 'New course was added!');
                redirect(base_url().'course');
    
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
            $this->form_validation->set_rules('course_code', 'Course Code', 'required');
            $this->form_validation->set_rules('course_name', 'Course Name', 'required');
    
            if($this->form_validation->run() == FALSE) {
    
                $page = "edit";
    
                if(!file_exists(APPPATH.'views/admin/course/'.$page.'.php')) {
                    $data['title'] = "Page Not Found";
                    $this->load->view('templates/login/header', $data);
                    $this->load->view('error404');
                    $this->load->view('templates/login/footer');
                }
    
                $data['title'] = "Edit Course";
                $data['form_edit'] = form_open('course/edit/'.$param);
                $data['data'] = $this->Course_model->show($param);
                $data['id'] = $data['data']['id'];
                $data['course_code'] = $data['data']['code'];
                $data['course_name'] = $data['data']['name'];
                $data['staff'] = $data['data']['staff'];
                
                $this->load->view('templates/users/header', $data);
                $this->load->view('templates/sidebar_admin');
                $this->load->view('admin/course/'.$page, $data);
                $this->load->view('templates/users/footer');
    
            } else {
    
                $this->Course_model->update();
                $this->session->set_flashdata('course_updated', 'Course was updated!');
                redirect(base_url().'course');
    
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
            
            $this->Course_model->delete();
            $this->session->set_flashdata('course_deleted', 'Course was deleted successfully!');
            redirect(base_url().'course');

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
            
        }

    }

}