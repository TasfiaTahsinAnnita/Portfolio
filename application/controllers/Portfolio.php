<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portfolio extends CI_Controller {

    public function index() {
        $data['zones']['about']        = $this->load->view('pages/about-content', '', TRUE);
        $data['zones']['experience']   = $this->load->view('pages/experience-content', '', TRUE);
        $data['zones']['my_projects']  = $this->load->view('pages/my-projects-content', '', TRUE);
        $data['zones']['publications'] = $this->load->view('pages/publications-content', '', TRUE);
        $data['zones']['contact']      = $this->load->view('pages/contact-content', '', TRUE);
        $this->load->view('layouts/main', [
            'page' => 'pages/home-game',
            'zones' => $data['zones']
        ]);
    }

    public function download_resume() {
        $this->load->helper('download');
        $file = FCPATH . 'assets/resume/tasfiatahsin_annita_cv.pdf';
        if (file_exists($file)) {
            force_download('Tasfia_Tahsin_Annita_Resume.pdf', file_get_contents($file));
        } else {
            show_404();
        }
    }

    public function send_message() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[100]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('message', 'Message', 'required|max_length[1000]');

        if ($this->form_validation->run() == FALSE) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'error', 'errors' => $this->form_validation->error_array()]));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'success', 'msg' => 'Message transmitted!']));
        }
    }
}