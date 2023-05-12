<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;

class ViewGrades extends CI_Controller {

    public function index() {

        if($this->session->logged_in && $this->session->access == 2) {

            $page = "index";
    
            if(!file_exists(APPPATH.'views/student/view_grades/'.$page.'.php')) {
                $data['title'] = "Page Not Found";
                $this->load->view('templates/login/header', $data);
                $this->load->view('error404');
                $this->load->view('templates/login/footer');
            }
        
            $data['title'] = "Student | View Grades";
            $data['data'] = $this->View_Grade_model->get();
            
            $this->load->view('templates/users/header', $data);
            $this->load->view('templates/sidebar_student');
            $this->load->view('student/view_grades/'.$page, $data);
            $this->load->view('templates/users/footer');

        } else {
            
            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');
            
        }

    }

    public function print() {

        if($this->session->logged_in && $this->session->access == 2) {

            $data['title'] = "Student Grades";
            $data['data'] = $this->View_Grade_model->get();
            $data['id_number'] = $data['data'][0]['id_number'];
            $data['name'] = $data['data'][0]['name'];
            $data['course_code'] = $data['data'][0]['course_code'];
            $data['subject_code'] = $data['data'][0]['subject_code'];
            $data['subject_name'] = $data['data'][0]['subject_name'];
            $data['section'] = $data['data'][0]['section'];
            $data['semester'] = $data['data'][0]['semester'];
            $data['year_level'] = $data['data'][0]['year_level'];
            $data['subjects'] = $this->View_Grade_model->show();

            $html = $this->load->view('student/view_grades/print', $data, TRUE);
            
            $dompdf = new Dompdf();
            $dompdf->set_option('isRemoteEnabled', true);
            $dompdf->load_html($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream('grades.pdf', array("Attachment" => FALSE));
            $dompdf->exit();

        } else {

            $data['title'] = "Page Not Found";
            $this->load->view('templates/login/header', $data);
            $this->load->view('error404');
            $this->load->view('templates/login/footer');

        }

    }

}