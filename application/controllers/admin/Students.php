<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Students extends CI_Controller {

    public function index() {

        if($this->session->logged_in && $this->session->access == 0) {
            
            $page = "index";
    
            if(!file_exists(APPPATH.'views/admin/students/'.$page.'.php')) {
                $data['title'] = "Page Not Found";
                $this->load->view('templates/login/header', $data);
                $this->load->view('error404');
                $this->load->view('templates/login/footer');
            }
        
            $data['title'] = "Admin | List of Student Sections";
            $data['data'] = $this->Student_model->get();
        
            $this->load->view('templates/users/header', $data);
            $this->load->view('templates/sidebar_admin');
            $this->load->view('admin/students/'.$page, $data);
            $this->load->view('templates/users/footer');

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
        
        }
    
    }

    public function section() {

        if($this->session->logged_in && $this->session->access == 0) {
            
            $slug_section = $this->uri->segment(3);

            $page = "show";
    
            if(!file_exists(APPPATH.'views/admin/students/'.$page.'.php')) {
                $data['title'] = "Page Not Found";
                $this->load->view('templates/login/header', $data);
                $this->load->view('error404');
                $this->load->view('templates/login/footer');
            }
        
            $data['title'] = "Manage Students";
            $data['form_delete'] = form_open('students/delete/'.$slug_section);
            $data['data'] = $this->Student_model->show_section($slug_section);
            $data['course_code'] = $data['data']['course_code'];
            $data['slug_section'] = $data['data']['slug_section'];
            $data['section'] = $data['data']['section'];
            $data['semester'] = $data['data']['semester'];
            $data['year_level'] = $data['data']['year_level'];
            $data['faculty_name'] = $data['data']['faculty_name'];
            $data['students_subject_status'] = $data['data']['students_subject_status'];
            $data['student_section_count'] = $data['data']['student_section_count'];
            $data['students'] = $this->Student_model->join($slug_section);
            $data['check_counts'] = $this->Student_model->show_complete($slug_section);
            
            $this->load->view('templates/users/header', $data);
            $this->load->view('templates/sidebar_admin');
            $this->load->view('templates/modal', $data);
            $this->load->view('admin/students/'.$page, $data);
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
            
            $slug_section = $this->uri->segment(3);

            $this->form_validation->set_error_delimiters(
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">', 
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );
            $this->form_validation->set_rules('id_number', 'ID Number', 'required');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');
    
            if($this->form_validation->run() == FALSE) {
    
                $page = "create";
    
                if(!file_exists(APPPATH.'views/admin/students/'.$page.'.php')) {
                    $data['title'] = "Page Not Found";
                    $this->load->view('templates/login/header', $data);
                    $this->load->view('error404');
                    $this->load->view('templates/login/footer');
                }
    
                $data['title'] = "Add New Student";
                $data['form_create'] = form_open('students/create/'.$slug_section);
                $data['slug_section'] = $slug_section;
                
                $this->load->view('templates/users/header', $data);
                $this->load->view('templates/sidebar_admin');
                $this->load->view('admin/students/'.$page, $data);
                $this->load->view('templates/users/footer');
    
            } else {
    
                $this->Student_model->insert($slug_section);
                $this->session->set_flashdata('students_added', 'New Student was added!');
                redirect(base_url().'students/section/'.$slug_section);
    
            }

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
        
        }
    
    }

    public function create_subjects() {

        if($this->session->logged_in && $this->session->access == 0) {

            $id = $this->uri->segment(4);
            $slug_section = $this->uri->segment(3);

            $this->Student_model->insert_subjects($id, $slug_section);
            $this->session->set_flashdata('students_subject_added', 'Student subjects was added!');
            redirect(base_url().'students/section/'.$slug_section);

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
        
        }

    }

    public function edit() {

        if($this->session->logged_in && $this->session->access == 0) {

            $id = $this->uri->segment(4);
            $slug_section = $this->uri->segment(3);
            
            $this->form_validation->set_error_delimiters(
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">', 
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );
            $this->form_validation->set_rules('id_number', 'ID Number', 'required');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');
    
            if($this->form_validation->run() == FALSE) {
    
                $page = "edit";
    
                if(!file_exists(APPPATH.'views/admin/students/'.$page.'.php')) {
                    $data['title'] = "Page Not Found";
                    $this->load->view('templates/login/header', $data);
                    $this->load->view('error404');
                    $this->load->view('templates/login/footer');
                }
    
                $data['title'] = "Edit Student";
                $data['form_edit'] = form_open('students/edit/'.$slug_section.'/'.$id);
                $data['data'] = $this->Student_model->show($id);
                $data['user_id'] = $data['data']['user_id'];
                $data['id_number'] = $data['data']['id_number'];
                $data['name'] = $data['data']['name'];
                $data['email'] = $data['data']['email'];
                $data['slug_section'] = $slug_section;
                
                $this->load->view('templates/users/header', $data);
                $this->load->view('templates/sidebar_admin');
                $this->load->view('admin/students/'.$page, $data);
                $this->load->view('templates/users/footer');
    
            } else {
    
                $this->Student_model->update($slug_section);
                $this->session->set_flashdata('students_updated', 'Student was updated!');
                redirect(base_url().'students/section/'.$slug_section);
    
            }

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
        
        }

    }

    public function complete() {

        if($this->session->logged_in && $this->session->access == 0) {

            $slug_section = $this->uri->segment(3);

            $this->Student_model->update_complete($slug_section);
            $this->session->set_flashdata('students_subject_completed', 'Students subjects are all completed!');
            redirect(base_url().'students/section/'.$slug_section);

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
        
        }

    }

    public function delete() {

        if($this->session->logged_in && $this->session->access == 0) {
            
            $slug_section = $this->uri->segment(3);

            $this->Student_model->delete();
            $this->session->set_flashdata('students_deleted', 'Student was deleted successfully!');
            redirect(base_url().'students/section/'.$slug_section);

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
        
        }

    }

}