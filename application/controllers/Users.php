<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function index()
    {

        if ($this->session->logged_in) {    

            if ($this->session->access == 1) {

                redirect(base_url()."grade-criteria");

            } else if ($this->session->access == 2) {

                redirect(base_url()."view-grades");

            } else {

                $page = "index";

                if (!file_exists(APPPATH . 'views/admin/' . $page . '.php')) {
                    show_404();
                }

                $count_student = $this->Student_model->count_student();
                $count_faculty = $this->Faculty_model->count_faculty();
                $count_subject = $this->Subject_model->count_subject();
                $count_section = $this->Section_model->count_section();

                $data['title'] = "Admin | Dashboard";
                $data['data'] = array(
                    [
                        'id' => 1,
                        'url' => base_url().'student-subject',
                        'title' => 'total students',
                        'icon' => '<i class="fas fa-home" style="font-size: clamp(3rem, 7vw, 1rem);"></i>',
                        'count' => $count_student['count_student']
                    ],
                    [
                        'id' => 2,
                        'url' => base_url().'faculty',
                        'title' => 'total faculty',
                        'icon' => '<i class="fas fa-users" style="font-size: clamp(3rem, 7vw, 1rem);"></i>',
                        'count' => $count_faculty['count_faculty']
                    ],
                    [
                        'id' => 3,
                        'url' => base_url().'subject',
                        'title' => 'total subject',
                        'icon' => '<i class="fas fa-sticky-note" style="font-size: clamp(3rem, 7vw, 1rem);"></i>',
                        'count' => $count_subject['count_subject']

                    ],
                    [
                        'id' => 4,
                        'url' => base_url().'section',
                        'title' => 'total section',
                        'icon' => '<i class="fas fa-th-list" style="font-size: clamp(3rem, 7vw, 1rem);"></i>',
                        'count' => $count_section['count_section']
                    ]
                );
                $data['faculty_subjects'] = $this->Faculty_Subject_model->get();
                $data['student_subjects'] = $this->Student_Subject_model->get();
                
                $this->load->view('templates/users/header', $data);
                $this->load->view('templates/sidebar_admin');
                $this->load->view('admin/' . $page, $data);
                $this->load->view('templates/users/footer');
            }
        } else {

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            $this->form_validation->set_rules('email', 'Username', 'required');

            if ($this->form_validation->run() == FALSE) {

                $data['title'] = "Login Page";
                $page = "login";

                if (!file_exists(APPPATH . 'views/login/' . $page . '.php')) {
                    show_404();
                }

                $this->load->view('templates/login/header', $data);
                $this->load->view('login/' . $page);
                $this->load->view('templates/login/footer');
            } else {

                $user = $this->Users_model->login();

                if ($user) {

                    $user_data = array(
                        'user_id' => $user['user_id'],
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'avatar' => $user['avatar'],
                        'access' => $user['role'],
                        'logged_in' => true
                    );

                    $this->session->set_userdata($user_data);
                    $this->session->set_flashdata('user_loggedin', 'You are now logged in ' . $this->session->name . '!');

                    redirect(base_url());
                } else {

                    $this->session->set_flashdata('failed_login', 'Login is invalid');
                    redirect(base_url());
                }
            }
        }
    }

    public function logout() {
        if ($this->session->logged_in) {

            $this->Users_model->update_profile();
            $this->session->unset_userdata('user_id');
            $this->session->unset_userdata('firstname');
            $this->session->unset_userdata('lastname');
            $this->session->unset_userdata('fullname');
            $this->session->unset_userdata('access');
            $this->session->unset_userdata('logged_in');
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('avatar');

            $this->session->set_flashdata('user_loggedout', 'You are now logged out');
            redirect(base_url());

        } else {
            redirect(base_url());
        }
    }

    public function profile() {

        if ($this->session->logged_in && $this->session->access == 1) {

            $this->form_validation->set_error_delimiters(
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">', 
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );
            
            if($this->input->post('toggle-password') == "on") {

                $this->form_validation->set_rules('name', 'Name', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('password', 'Password', 'required');
                $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

            } else {

                $this->form_validation->set_rules('name', 'Name', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            }
    
            if($this->form_validation->run() == FALSE) {
    
                $page = "index";
    
                if(!file_exists(APPPATH.'views/profile/'.$page.'.php')) {
                    $data['title'] = "Page Not Found";
                    $this->load->view('templates/login/header', $data);
                    $this->load->view('error404');
                    $this->load->view('templates/login/footer');
                }
    
                $data['title'] = "Faculty | Profile Details";
                $data['form_edit'] = form_open('profile');
                
                $this->load->view('templates/users/header', $data);
                $this->load->view('templates/sidebar_faculty');
                $this->load->view('profile/modal');
                $this->load->view('profile/'.$page, $data);
                $this->load->view('templates/users/footer');
    
            } else {

                $this->Users_model->update_profile();
                $this->session->unset_userdata('user_id');
                $this->session->unset_userdata('firstname');
                $this->session->unset_userdata('lastname');
                $this->session->unset_userdata('fullname');
                $this->session->unset_userdata('access');
                $this->session->unset_userdata('logged_in');
                $this->session->unset_userdata('email');
                $this->session->unset_userdata('avatar');
                $this->session->set_flashdata('user_loggedout', 'Profile was update successfully!');
                redirect(base_url());
    
            }
            
        } elseif ($this->session->logged_in && $this->session->access == 2) {

            $this->form_validation->set_error_delimiters(
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">', 
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );
            

            if($this->input->post('toggle-password') == "on") {

                $this->form_validation->set_rules('name', 'Name', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('password', 'Password', 'required');
                $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

            } else {

                $this->form_validation->set_rules('name', 'Name', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            }
    
            if($this->form_validation->run() == FALSE) {
    
                $page = "index";
    
                if(!file_exists(APPPATH.'views/profile/'.$page.'.php')) {
                    $data['title'] = "Page Not Found";
                    $this->load->view('templates/login/header', $data);
                    $this->load->view('error404');
                    $this->load->view('templates/login/footer');
                }
    
                $data['title'] = "Student | Profile Details";
                $data['form_edit'] = form_open('profile');
                
                $this->load->view('templates/users/header', $data);
                $this->load->view('templates/sidebar_student');
                $this->load->view('profile/modal');
                $this->load->view('profile/'.$page, $data);
                $this->load->view('templates/users/footer');
    
            } else {
    
                $this->Users_model->update_profile();
                $this->session->unset_userdata('user_id');
                $this->session->unset_userdata('firstname');
                $this->session->unset_userdata('lastname');
                $this->session->unset_userdata('fullname');
                $this->session->unset_userdata('access');
                $this->session->unset_userdata('logged_in');
                $this->session->unset_userdata('email');
                $this->session->unset_userdata('avatar');
                $this->session->set_flashdata('user_loggedout', 'Profile was update successfully!');
                redirect(base_url());
    
            }

        } elseif ($this->session->logged_in && $this->session->access == 0) {

            $this->form_validation->set_error_delimiters(
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">', 
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );
            

            if($this->input->post('toggle-password') == "on") {

                $this->form_validation->set_rules('name', 'Name', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('password', 'Password', 'required');
                $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

            } else {

                $this->form_validation->set_rules('name', 'Name', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            }
    
            if($this->form_validation->run() == FALSE) {
    
                $page = "index";
    
                if(!file_exists(APPPATH.'views/profile/'.$page.'.php')) {
                    $data['title'] = "Page Not Found";
                    $this->load->view('templates/login/header', $data);
                    $this->load->view('error404');
                    $this->load->view('templates/login/footer');
                }
    
                $data['title'] = "Admin | Profile Details";
                $data['form_edit'] = form_open('profile');
                
                $this->load->view('templates/users/header', $data);
                $this->load->view('templates/sidebar_admin');
                $this->load->view('profile/modal');
                $this->load->view('profile/'.$page, $data);
                $this->load->view('templates/users/footer');
    
            } else {
    
                $this->Users_model->update_profile();
                $this->session->unset_userdata('user_id');
                $this->session->unset_userdata('firstname');
                $this->session->unset_userdata('lastname');
                $this->session->unset_userdata('fullname');
                $this->session->unset_userdata('access');
                $this->session->unset_userdata('logged_in');
                $this->session->unset_userdata('email');
                $this->session->unset_userdata('avatar');
                $this->session->set_flashdata('user_loggedout', 'Profile was update successfully!');
                redirect(base_url());
    
            }

        } else {

            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');

        }

    }

    public function barchart() {
        
        if($this->session->logged_in && $this->session->access == 0) {

            $data = $this->Subject_model->count_subject_types();
            $json_data = json_encode($data);
            header('Content-Type: application/json');

            echo $json_data;

        } else {

            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');

        }

    }

}