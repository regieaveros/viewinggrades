<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Semesters extends CI_Controller {

    public function index() {

        if($this->session->logged_in && $this->session->access == 0) {
            
            $page = "index";

            if(!file_exists(APPPATH.'views/admin/semester/'.$page.'.php')) {
                $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
            }

            $data['title'] = "Admin | Manage Semester";
            $data['data'] = $this->Semester_model->get();
            $data['form_delete'] = form_open('semester/delete');

            $this->load->view('templates/users/header', $data);
            $this->load->view('templates/sidebar_admin');
            $this->load->view('templates/modal', $data);
            $this->load->view('admin/semester/'.$page, $data);
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
            $this->form_validation->set_rules('semester', 'Semester', 'required');
    
            if($this->form_validation->run() == FALSE) {
    
                $page = "create";
    
                if(!file_exists(APPPATH.'views/admin/semester/'.$page.'.php')) {
                    $data['title'] = "Page Not Found";
                    $this->load->view('templates/login/header', $data);
                    $this->load->view('error404');
                    $this->load->view('templates/login/footer');
                }
    
                $data['title'] = "Add New Semester";
                $data['form_create'] = form_open('semester/create');
                
                $this->load->view('templates/users/header', $data);
                $this->load->view('templates/sidebar_admin');
                $this->load->view('admin/semester/'.$page, $data);
                $this->load->view('templates/users/footer');
    
            } else {
    
                $this->Semester_model->insert();
                $this->session->set_flashdata('semester_added', 'New semester was added!');
                redirect(base_url().'semester');
    
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
            $this->form_validation->set_rules('semester', 'Semester', 'required');
    
            if($this->form_validation->run() == FALSE) {
    
                $page = "edit";
    
                if(!file_exists(APPPATH.'views/admin/semester/'.$page.'.php')) {
                    $data['title'] = "Page Not Found";
                    $this->load->view('templates/login/header', $data);
                    $this->load->view('error404');
                    $this->load->view('templates/login/footer');
                }
    
                $data['title'] = "Edit Semester";
                $data['form_edit'] = form_open('semester/edit/'.$param);
                $data['data'] = $this->Semester_model->show($param);
                $data['id'] = $data['data']['id'];
                $data['semester'] = $data['data']['semester'];
                
                $this->load->view('templates/users/header', $data);
                $this->load->view('templates/sidebar_admin');
                $this->load->view('admin/semester/'.$page, $data);
                $this->load->view('templates/users/footer');
    
            } else {
    
                $this->Semester_model->update();
                $this->session->set_flashdata('semester_updated', 'Semester was updated!');
                redirect(base_url().'semester');
    
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
            
            $this->Semester_model->delete();
            $this->session->set_flashdata('semester_deleted', 'Semester was deleted successfully!');
            redirect(base_url().'semester');

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
        
        }

    }

}