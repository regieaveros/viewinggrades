<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FacultySubjects extends CI_Controller {

    public function index() {

        if($this->session->logged_in && $this->session->access == 0) {
            
            $page = "index";
    
            if(!file_exists(APPPATH.'views/admin/faculty_subject/'.$page.'.php')) {
                $data['title'] = "Page Not Found";
                $this->load->view('templates/login/header', $data);
                $this->load->view('error404');
                $this->load->view('templates/login/footer');
            }
        
            $data['title'] = "Admin | List of Faculties";
            $data['data'] = $this->Faculty_Subject_model->get();
        
            $this->load->view('templates/users/header', $data);
            $this->load->view('templates/sidebar_admin');
            $this->load->view('admin/faculty_subject/'.$page, $data);
            $this->load->view('templates/users/footer');

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
        
        }
    
    }

    public function faculty($param) {

        if($this->session->logged_in && $this->session->access == 0) {

            $page = "show_faculty";
    
            if(!file_exists(APPPATH.'views/admin/faculty_subject/'.$page.'.php')) {
                $data['title'] = "Page Not Found";
                $this->load->view('templates/login/header', $data);
                $this->load->view('error404');
                $this->load->view('templates/login/footer');
            }
        
            $data['title'] = "Manage Faculty Subject";
            $data['form_delete'] = form_open('faculty-subject/delete/'.$param);
            $data['slug_name'] = $param;
            $data['faculty'] = $this->Faculty_Subject_model->join($param);
            $faculty_id = $data['faculty']['id'];
            $data['id_number'] = $data['faculty']['id_number'];
            $data['name'] = $data['faculty']['name'];
            $data['course_code'] = $data['faculty']['course_code'];
            $data['course_name'] = $data['faculty']['course_name'];
            $data['email'] = $data['faculty']['email'];
            $data['subject_count'] = $data['faculty']['subject_count'];
            $data['subject_type'] = $data['faculty']['subject_type'];
            $data['status'] = $this->Faculty_Subject_model->show_complete($faculty_id);
            $data['data'] = $this->Faculty_Subject_model->show_faculty_subject($faculty_id);
        
            $this->load->view('templates/users/header', $data);
            $this->load->view('templates/sidebar_admin');
            $this->load->view('templates/modal', $data);
            $this->load->view('admin/faculty_subject/'.$page, $data);
            $this->load->view('templates/users/footer');

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
        
        }

    }

    public function subject() {
        
        if($this->session->logged_in && $this->session->access == 0) {
            
            $slug_name = $this->uri->segment(3);
            $id = $this->uri->segment(5);

            $page = "show";
        
            if(!file_exists(APPPATH.'views/admin/subject/'.$page.'.php')) {
                $data['title'] = "Page Not Found";
                $this->load->view('templates/login/header', $data);
                $this->load->view('error404');
                $this->load->view('templates/login/footer');
            }
        
            $data['title'] = "View Subject";
            $data['subject'] = $this->Subject_model->show($id);
            $data['subject_code'] = $data['subject']['subject_code'];
            $data['subject_name'] = $data['subject']['subject_name'];
            $data['units'] = $data['subject']['units'];
            $data['course_code'] = $data['subject']['course_code'];
            $data['year_level'] = $data['subject']['year_level'];
            $data['semester'] = $data['subject']['semester'];
            $data['url'] = base_url().'faculty-subject/'.$slug_name;
        
            $this->load->view('templates/users/header', $data);
            $this->load->view('templates/sidebar_admin');
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
            
            $slug_name = $this->uri->segment(3);

            $this->form_validation->set_error_delimiters(
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">', 
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );
            $this->form_validation->set_rules('subject[]', 'Subject', 'required');
    
            if($this->form_validation->run() == FALSE) {
    
                $page = "create";
    
                if(!file_exists(APPPATH.'views/admin/faculty_subject/'.$page.'.php')) {
                    $data['title'] = "Page Not Found";
                    $this->load->view('templates/login/header', $data);
                    $this->load->view('error404');
                    $this->load->view('templates/login/footer');
                }
    
                $data['title'] = "Add New Faculty Subject";
                $data['subjects'] = $this->Faculty_Subject_model->show_subjects($slug_name);
                $data['form_create'] = form_open('faculty-subject/create/'.$slug_name);
                $data['slug_name'] = $slug_name;
                
                $this->load->view('templates/users/header', $data);
                $this->load->view('templates/sidebar_admin');
                $this->load->view('admin/faculty_subject/'.$page, $data);
                $this->load->view('templates/users/footer');
    
            } else {

                $this->Faculty_Subject_model->insert($slug_name);
                $this->session->set_flashdata('faculty_subject_added', 'New faculty subject was added!');
                redirect(base_url().'faculty-subject/'.$slug_name);
    
            }

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
        
        }
    
    }

    public function edit() {

        if($this->session->logged_in && $this->session->access == 0) {

            $slug_name = $this->uri->segment(3);
            $id = $this->uri->segment(4);
            $slug_subject = $this->uri->segment(5);
            $subject_id = $this->uri->segment(6);
            
            $this->form_validation->set_error_delimiters(
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">', 
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );
            $this->form_validation->set_rules('subject', 'Subject', 'required');
            $this->form_validation->set_rules('section', 'Section', 'required');
    
            if($this->form_validation->run() == FALSE) {
    
                $page = "edit";
    
                if(!file_exists(APPPATH.'views/admin/faculty_subject/'.$page.'.php')) {
                    $data['title'] = "Page Not Found";
                    $this->load->view('templates/login/header', $data);
                    $this->load->view('error404');
                    $this->load->view('templates/login/footer');
                }
    
                $data['title'] = "Edit Faculty Subject";
                $data['form_edit'] = form_open('faculty-subject/edit/'.$slug_name.'/'.$id.'/'.$slug_subject.'/'.$subject_id);
                $data['subjects'] = $this->Faculty_Subject_model->show_subjects($slug_name);
                $data['subject_data'] = $this->Subject_model->show($subject_id);
                $data['faculty_subject_data'] = $this->Faculty_Subject_model->show($id);
                $data['section'] = $data['faculty_subject_data']['section'];
                $data['id'] = $data['faculty_subject_data']['id'];
                $data['slug'] = $slug_name;
                $data['subject'] = $data['subject_data']['subject_code'];
                $course = $data['subject_data']['course_code'];
                $year = $data['subject_data']['year_level'];
                $semester = $data['subject_data']['semester'];
                
                $data['sections'] = $this->Section_model->show_section($course, $year, $semester);
                
                
                $this->load->view('templates/users/header', $data);
                $this->load->view('templates/sidebar_admin');
                $this->load->view('admin/faculty_subject/'.$page, $data);
                $this->load->view('templates/users/footer');
    
            } else {
    
                $this->Faculty_Subject_model->update();
                $this->session->set_flashdata('faculty_subject_updated', 'Faculty Subject was updated!');
                redirect(base_url().'faculty-subject/'.$slug_name);
    
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
            
            $slug_name = $this->uri->segment(3);

            $this->Faculty_Subject_model->delete();
            $this->session->set_flashdata('faculty_subject_deleted', 'Faculty Subject was deleted successfully!');
            redirect(base_url().'faculty-subject/'.$slug_name);

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
        
        }

    }

}