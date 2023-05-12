<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;

class StudentLists extends CI_Controller {

    public function index() {

        if($this->session->logged_in && $this->session->access == 1) {

            $slug_subject = $this->uri->segment(2);
            $id = $this->uri->segment(3);

            $page = "index";
    
            if(!file_exists(APPPATH.'views/faculty/student_lists/'.$page.'.php')) {
                $data['title'] = "Page Not Found";
                $this->load->view('templates/login/header', $data);
                $this->load->view('error404');
                $this->load->view('templates/login/footer');
            }
        
            $data['title'] = "Faculty | Student Lists";
            $data['subjects'] = $this->Student_List_model->get();
            $data['id'] = $id;
            $data['slug_subject'] = $slug_subject;
            $data['students'] = $this->Student_List_model->show_students($id, $slug_subject);
            
            $this->load->view('templates/users/header', $data);
            $this->load->view('templates/sidebar_faculty');
            $this->load->view('faculty/student_lists/'.$page, $data);
            $this->load->view('templates/users/footer');

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
            
        }

    }

    public function print() {

        if($this->session->logged_in && $this->session->access == 1) {

            $slug_subject = $this->uri->segment(3);
            $id = $this->uri->segment(4);

            $faculty = $this->Student_List_model->show_faculty($id, $slug_subject);

            $data['title'] = "Student Lists";
            $data['name'] = $faculty['name'];
            $data['course_code'] = $faculty['course_code'];
            $data['subject_code'] = $faculty['subject_code'];
            $data['subject_name'] = $faculty['subject_name'];
            $data['section'] = $faculty['section'];
            $data['subject_year'] = $faculty['subject_year'];
            $data['subject_semester'] = $faculty['subject_semester'];
            $data['data'] = $this->Student_List_model->show_students($id, $slug_subject);
            $html = $this->load->view('faculty/student_lists/print', $data, TRUE);
            
            $dompdf = new Dompdf();
            $dompdf->set_option('isRemoteEnabled', true);
            $dompdf->load_html($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream('student-lists.pdf', array("Attachment" => FALSE));
            $dompdf->exit();

        } else {

            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');

        }
        
    }
    
}