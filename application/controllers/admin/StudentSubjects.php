<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentSubjects extends CI_Controller {

    public function index() {

        if($this->session->logged_in && $this->session->access == 0) {
            
            $page = "index";
    
            if(!file_exists(APPPATH.'views/admin/student_subject/'.$page.'.php')) {
                $data['title'] = "Page Not Found";
                $this->load->view('templates/login/header', $data);
                $this->load->view('error404');
                $this->load->view('templates/login/footer');
            }
        
            $data['title'] = "Admin | List of Students";
            $data['data'] = $this->Student_Subject_model->get();
        
            $this->load->view('templates/users/header', $data);
            $this->load->view('templates/sidebar_admin');
            $this->load->view('templates/modal', $data);
            $this->load->view('admin/student_subject/'.$page, $data);
            $this->load->view('templates/users/footer');

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
        
        }
    
    }

    public function student($param) {

        if($this->session->logged_in && $this->session->access == 0) {
            
            $page = "show_student";
    
            if(!file_exists(APPPATH.'views/admin/student_subject/'.$page.'.php')) {
                $data['title'] = "Page Not Found";
                $this->load->view('templates/login/header', $data);
                $this->load->view('error404');
                $this->load->view('templates/login/footer');
            }
        
            $data['title'] = "Manage Student Subject";
            $data['form_delete'] = form_open('student-subject/delete/'.$param);
            $data['slug_name'] = $param;
            $data['student'] = $this->Student_Subject_model->join($param);
            $id = $data['student']['id'];
            $data['id'] = $data['student']['id'];
            $data['id_number'] = $data['student']['id_number'];
            $data['name'] = $data['student']['name'];
            $data['course_code'] = $data['student']['course_code'];
            $data['year_level'] = $data['student']['year_level'];
            $data['section'] = $data['student']['section'];
            $data['faculty_name'] = $data['student']['faculty_name'];
            $data['email'] = $data['student']['email'];
            $data['subject_count'] = $data['student']['subject_count'];

            $data['data'] = $this->Student_Subject_model->show_student_subject($id);
        
            $this->load->view('templates/users/header', $data);
            $this->load->view('templates/sidebar_admin');
            $this->load->view('templates/modal', $data);
            $this->load->view('admin/student_subject/'.$page, $data);
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
            $data['url'] = base_url().'student-subject/'.$slug_name;
        
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
            $id = $this->uri->segment(4);
            $slug_subject = $this->uri->segment(5);
            $slug_subject_id = $this->uri->segment(6);

            $this->form_validation->set_error_delimiters(
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">', 
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );
            $this->form_validation->set_rules('subject', 'Subject', 'required');
            $this->form_validation->set_rules('faculty', 'Instructor', 'required');
    
            if($this->form_validation->run() == FALSE) {
    
                $page = "create";
    
                if(!file_exists(APPPATH.'views/admin/student_subject/'.$page.'.php')) {
                    $data['title'] = "Page Not Found";
                    $this->load->view('templates/login/header', $data);
                    $this->load->view('error404');
                    $this->load->view('templates/login/footer');
                }
    
                $data['title'] = "Add New Student Subjects";
                $data['subjects'] = $this->Student_Subject_model->show_create_subjects($id);
                $data['course_code'] = $data['subjects'][0]['course_code'];
                $data['subject'] = $this->Subject_model->show($slug_subject_id);
                $data['subject_code'] = $data['subject']['subject_code'];
                $data['faculties'] = $this->Student_Subject_model->show_faculty($slug_subject, $slug_subject_id);
                $data['form_create'] = form_open('student-subject/create/'.$slug_name.'/'.$id.'/'.$slug_subject.'/'.$slug_subject_id);
                $data['slug_name'] = $slug_name;
                
                $this->load->view('templates/users/header', $data);
                $this->load->view('templates/sidebar_admin');
                $this->load->view('admin/student_subject/'.$page, $data);
                $this->load->view('templates/users/footer');
    
            } else {
    
                $this->Student_Subject_model->insert($id);
                $this->session->set_flashdata('student_subject_added', 'New Student Subject was added!');
                redirect(base_url().'student-subject/'.$slug_name);
    
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
            $slug_subject_id = $this->uri->segment(6);
            
            $this->form_validation->set_error_delimiters(
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">', 
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );
            $this->form_validation->set_rules('subject', 'Subject', 'required');
            $this->form_validation->set_rules('faculty', 'Instructor', 'required');
    
            if($this->form_validation->run() == FALSE) {
    
                $page = "edit";
    
                if(!file_exists(APPPATH.'views/admin/student_subject/'.$page.'.php')) {
                    $data['title'] = "Page Not Found";
                    $this->load->view('templates/login/header', $data);
                    $this->load->view('error404');
                    $this->load->view('templates/login/footer');
                }
    
                $data['title'] = "Edit Student Subject";
                $data['form_edit'] = form_open('student-subject/edit/'.$slug_name.'/'.$id.'/'.$slug_subject.'/'.$slug_subject_id);

                $data['subjects'] = $this->Student_Subject_model->show_edit_subjects($id);
                $data['course_code'] = $data['subjects'][0]['course_code'];
                $data['subject'] = $this->Subject_model->show($slug_subject_id);
                $data['subject_code'] = $data['subject']['subject_code'];
                
                $data['faculties'] = $this->Student_Subject_model->show_faculty($slug_subject, $slug_subject_id);
                $data['student_subject'] = $this->Student_Subject_model->show($id);
                $data['faculty_id'] = $data['student_subject']['faculty_id'];
                $data['slug_name'] = $slug_name;
                
                $this->load->view('templates/users/header', $data);
                $this->load->view('templates/sidebar_admin');
                $this->load->view('admin/student_subject/'.$page, $data);
                $this->load->view('templates/users/footer');
    
            } else {
    
                $this->Student_Subject_model->update($id);
                $this->session->set_flashdata('student_subject_updated', 'Student Subject was updated!');
                redirect(base_url().'student-subject/'.$slug_name);
    
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

            $this->Student_Subject_model->delete();
            $this->session->set_flashdata('student_subject_deleted', 'Student Subject was deleted successfully!');
            redirect(base_url().'student-subject/'.$slug_name);

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
        
        }

    }
    
}