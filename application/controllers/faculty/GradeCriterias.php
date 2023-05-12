<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GradeCriterias extends CI_Controller {

    public function index() {

        if($this->session->logged_in && $this->session->access == 1) {

            $page = "index";
    
            if(!file_exists(APPPATH.'views/faculty/grade_criteria/'.$page.'.php')) {
                $data['title'] = "Page Not Found";
                $this->load->view('templates/login/header', $data);
                $this->load->view('error404');
                $this->load->view('templates/login/footer');
            }
        
            $data['title'] = "Faculty | List of Subjects";
            $data['data'] = $this->Grade_Criteria_model->get();
            
            $this->load->view('templates/users/header', $data);
            $this->load->view('templates/sidebar_faculty');
            $this->load->view('faculty/grade_criteria/'.$page, $data);
            $this->load->view('templates/users/footer');

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
            
        }

    }

    public function show_criteria() {

        if($this->session->logged_in && $this->session->access == 1) {

            $slug_subject = $this->uri->segment(2);
            $id = $this->uri->segment(3);

            $page = "show_criteria";
    
            if(!file_exists(APPPATH.'views/faculty/grade_criteria/'.$page.'.php')) {
                $data['title'] = "Page Not Found";
                $this->load->view('templates/login/header', $data);
                $this->load->view('error404');
                $this->load->view('templates/login/footer');
            }
        
            $data['title'] = "Manage | Grade Criteria";
            $data['data'] = $this->Grade_Criteria_model->show_subject($id);
            $data['form_delete'] = form_open('grade-criteria/delete/'.$slug_subject.'/'.$id);
            $data['subject_name'] = $data['data']['subject_name'];
            $data['subject_code'] = $data['data']['subject_code'];
            $data['course_code'] = $data['data']['course_code'];
            $data['section'] = $data['data']['section'];
            $data['subject_semester'] = $data['data']['subject_semester'];
            $data['subject_year'] = $data['data']['subject_year'];
            $data['slug_subject'] = $slug_subject;
            $data['id'] = $id;
            $data['criteria'] = $this->Grade_Criteria_model->show($id);

            $this->load->view('templates/users/header', $data);
            $this->load->view('templates/sidebar_faculty');
            $this->load->view('templates/modal', $data);
            $this->load->view('faculty/grade_criteria/'.$page, $data);
            $this->load->view('templates/users/footer');

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
            
        }

    }

    public function create() {

        if($this->session->logged_in && $this->session->access == 1) {

            $slug_subject = $this->uri->segment(3);
            $id = $this->uri->segment(4);

            $this->form_validation->set_error_delimiters(
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">', 
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );

            $this->form_validation->set_rules('criteria', 'Criteria Name', 'required');
            $this->form_validation->set_rules('percentage', 'Percentage', 'required');
            $this->form_validation->set_rules('total_items', 'Total Items', 'required');
    
            if($this->form_validation->run() == FALSE) {
    
                $page = "create";
    
                if(!file_exists(APPPATH.'views/faculty/grade_criteria/'.$page.'.php')) {
                    $data['title'] = "Page Not Found";
                    $this->load->view('templates/login/header', $data);
                    $this->load->view('error404');
                    $this->load->view('templates/login/footer');
                }
    
                $data['title'] = "Add New Criteria";
                $data['form_create'] = form_open('grade-criteria/create/'.$slug_subject.'/'.$id);
                $data['slug_subject'] = $slug_subject;
                $data['id'] = $id;
                
                $this->load->view('templates/users/header', $data);
                $this->load->view('templates/sidebar_faculty');
                $this->load->view('faculty/grade_criteria/'.$page, $data);
                $this->load->view('templates/users/footer');
    
            } else {

                $this->Grade_Criteria_model->insert($id);
                $this->session->set_flashdata('grade_criteria_added', 'New Criteria was added!');
                redirect(base_url().'grade-criteria/'.$slug_subject.'/'.$id);
    
            }

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

            $this->form_validation->set_rules('criteria', 'Criteria Name', 'required');
            $this->form_validation->set_rules('percentage', 'Percentage', 'required');
            $this->form_validation->set_rules('total_items', 'Total Items', 'required');
    
            if($this->form_validation->run() == FALSE) {
    
                $page = "edit";
    
                if(!file_exists(APPPATH.'views/faculty/grade_criteria/'.$page.'.php')) {
                    $data['title'] = "Page Not Found";
                    $this->load->view('templates/login/header', $data);
                    $this->load->view('error404');
                    $this->load->view('templates/login/footer');
                }
    
                $data['title'] = "Edit Grade Criteria";
                $data['form_edit'] = form_open('grade-criteria/edit/'.$id.'/'.$slug_subject.'/'.$subject_id);
                $data['data'] = $this->Grade_Criteria_model->show_criteria($id);
                $data['id'] = $id;
                $data['slug_subject'] = $slug_subject;
                $data['subject_id'] = $subject_id;
                $data['criteria'] = $data['data']['criteria_name'];
                $data['percentage'] = $data['data']['percentage'];
                $data['total_items'] = $data['data']['total_items'];
                
                $this->load->view('templates/users/header', $data);
                $this->load->view('templates/sidebar_faculty');
                $this->load->view('faculty/grade_criteria/'.$page, $data);
                $this->load->view('templates/users/footer');
    
            } else {
    
                $this->Grade_Criteria_model->update();
                $this->session->set_flashdata('grade_criteria_updated', 'Grade Criteria was updated!');
                redirect(base_url().'grade-criteria/'.$slug_subject.'/'.$subject_id);
    
            }

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
            
        }

    }

    public function delete() {

        if($this->session->logged_in && $this->session->access == 1) {

            $slug_subject = $this->uri->segment(3);
            $id = $this->uri->segment(4);
            
            $this->Grade_Criteria_model->delete();
            $this->session->set_flashdata('grade_criteria_deleted', 'Grade Criteria was deleted successfully!');
            redirect(base_url().'grade-criteria/'.$slug_subject.'/'.$id);

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
            
        }

    }

}