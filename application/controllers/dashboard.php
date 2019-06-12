<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->cek_login();
    }

    private function cek_login(){
        if (!$this->session->userdata('ses_id')){
            $this->session->set_flashdata('error','Silahkan login terlebih dahulu');
            redirect('login');
        }
    }

    public function index(){
        $data = array(
            'total_years' => $this->model->GetYears()->num_rows(),
            'total_pendanaan' => $this->model->GetPendanaan()->num_rows(),
            'content' => 'template/dashboard',
        );
        $this->load->view('template/site', $data);
    }

}
?>