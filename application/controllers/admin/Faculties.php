<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faculties extends CI_Controller {

    public function index() {

        if($this->session->logged_in && $this->session->access == 0) {
            
            $page = "index";
    
            if(!file_exists(APPPATH.'views/admin/faculty/'.$page.'.php')) {
                $data['title'] = "Page Not Found";
                $this->load->view('templates/login/header', $data);
                $this->load->view('error404');
                $this->load->view('templates/login/footer');
            }
        
            $data['title'] = "Admin | Manage Faculty";
            $data['data'] = $this->Faculty_model->join();
            $data['form_delete'] = form_open('faculty/delete');
        
            $this->load->view('templates/users/header', $data);
            $this->load->view('templates/sidebar_admin');
            $this->load->view('templates/modal', $data);
            $this->load->view('admin/faculty/'.$page, $data);
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
            $this->form_validation->set_rules('id_number', 'ID Number', 'required');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('course_code', 'Course', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('subject_type[]', 'Subject Type', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
    
            if($this->form_validation->run() == FALSE) {
    
                $page = "create";
    
                if(!file_exists(APPPATH.'views/admin/faculty/'.$page.'.php')) {
                    $data['title'] = "Page Not Found";
                    $this->load->view('templates/login/header', $data);
                    $this->load->view('error404');
                    $this->load->view('templates/login/footer');
                }
    
                $data['title'] = "Add New Faculty";
                $data['courses'] = $this->Course_model->show_staff_faculty();
                $data['form_create'] = form_open('faculty/create');
                
                $this->load->view('templates/users/header', $data);
                $this->load->view('templates/sidebar_admin');
                $this->load->view('admin/faculty/'.$page, $data);
                $this->load->view('templates/users/footer');
    
            } else {
    
                $this->Faculty_model->insert();
                $this->session->set_flashdata('faculty_added', 'New faculty was added!');
                redirect(base_url().'faculty');
    
            }

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
        
        }
    
    }

    public function edit($id) {
        
        if($this->session->logged_in && $this->session->access == 0) {
            
            $this->form_validation->set_error_delimiters(
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">', 
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );
            $this->form_validation->set_rules('id_number', 'ID Number', 'required');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('course_code', 'Course', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('subject_type[]', 'Subject Type', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');
            
            if($this->form_validation->run() == FALSE) {
    
                $page = "edit";
    
                if(!file_exists(APPPATH.'views/admin/faculty/'.$page.'.php')) {
                    $data['title'] = "Page Not Found";
                    $this->load->view('templates/login/header', $data);
                    $this->load->view('error404');
                    $this->load->view('templates/login/footer');
                }
    
                $data['title'] = "Edit Faculty";
                $data['courses'] = $this->Course_model->show_staff_faculty();
                $data['form_edit'] = form_open('faculty/edit/'.$id);
                $data['data'] = $this->Faculty_model->show($id);
                $data['user_id'] = $data['data']['user_id'];
                $data['id_number'] = $data['data']['id_number'];
                $data['name'] = $data['data']['name'];
                $data['course_code'] = $data['data']['course_code'];
                $data['email'] = $data['data']['email'];
                $data['subject_type'] = $data['data']['subject_type'];
                $data['password'] = $data['data']['password'];
                
                $this->load->view('templates/users/header', $data);
                $this->load->view('templates/sidebar_admin');
                $this->load->view('admin/faculty/'.$page, $data);
                $this->load->view('templates/users/footer');
    
            } else {

                $this->Faculty_model->update($id);
                $this->session->set_flashdata('faculty_updated', 'Faculty was updated!');
                redirect(base_url().'faculty');
    
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
            
            $this->Faculty_model->delete();
            $this->session->set_flashdata('faculty_deleted', 'Faculty was deleted successfully!');
            redirect(base_url().'faculty');

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
        
        }

    }

}