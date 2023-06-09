<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Custom404 extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper('url');

    }

    public function index() {
        
        $data['title'] = "Page Not Found";

        $this->output->set_status_header('404');
        $this->load->view('templates/login/header', $data);
        $this->load->view('error404');
        $this->load->view('templates/login/footer');
        
    }
}