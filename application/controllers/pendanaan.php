<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendanaan extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->cek_login();
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
    }

    private function cek_login(){
        if (!$this->session->userdata('ses_id')){
            $this->session->set_flashdata('error', 'Silahkan login terlebih dahulu');
            redirect('login');
        }
    }

    public function cek_user(){
        if ($this->session->userdata('ses_level') == 'Pengunjung'){
            $this->session->set_flashdata('error', 'Maaf anda tidak bisa masuk kehalaman tersebut');
            redirect('pendanaan');
        }
    }

    public function index(){
        $data = array(
            'status' => 'new',
            'code_pendanaan' => '',
            'pendanaan_name' => '',
            'deskripsi' => '',
            'data_pendanaan' => $this->model->GetPendanaan('order by pendanaan_name asc')->result_array(),
            'content' => 'pendanaan/pendanaan-data',
        );
        $this->load->view('template/site', $data);
    }

    public function edit_pendanaan($kode = 0){
        $this->cek_user();
        if ($this->uri->segment(3) == null){
            $this->session->set_flashdata('error','Maaf anda belum memilih data untuk di edit');
            redirect('pendanaan');
        }
        $tampung = $this->model->GetPendanaan("where code_pendanaan = '$kode'")->result_array();
        $data = array(
            'status' => 'old',
            'code_pendanaan' => $tampung[0]['code_pendanaan'],
            'pendanaan_name' => $tampung[0]['pendanaan_name'],
            'deskripsi' => $tampung[0]['deskripsi'],
            'data_pendanaan' => $this->model->GetPendanaan("where code_pendanaan != '$kode' order by code_pendanaan")->result_array(),
            'content' => 'pendanaan/pendanaan-data',
        );
        $this->load->view('template/site', $data);
    }

    public function save_pendanaan(){
        $this->cek_user();
        if (!$_POST['save']){
            $this->session->set_flashdata('error', 'Anda belum melakukan tambah atau edit data');
            redirect('pendanaan');
        }
        $this->form_validation->set_rules('code_pendanaan', 'Code_pendanaan');
        $this->form_validation->set_rules('pendanaan_name', 'Pendanaan_name','required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $status = $_POST['status'];
        if ($status == 'new'){
            $pendanaan_name = $_POST['pendanaan_name'];
            $cek = $this->db->query("select * from pendanaan WHERE pendanaan_name = '$pendanaan_name'")->num_rows();
            if ($cek > 0){
                $this->session->set_flashdata('error','Data Sudah Ada');
                redirect('pendanaan');
            }elseif($pendanaan_name == null){
                $this->session->set_flashdata('error', 'Pendanaan Name tidak boleh NULL');
                redirect('pendanaan');
            }elseif ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('error', validation_errors().'Simpan Data Gagal dilakukan');
                redirect('pendanaan');
            }else{
                $data = array(
                    'code_pendanaan' => $_POST['code_pendanaan'],
                    'pendanaan_name' => $_POST['pendanaan_name'],
                    'deskripsi' => $_POST['deskripsi'],
                );
                $this->model->Simpan('pendanaan', $data);
                $this->session->set_flashdata('sukses','Simpan Data Berhasil dilakukan');
                redirect('pendanaan');
            }
        }else{
            $code_pendanaan = $_POST['code_pendanaan'];
            $pendanaan_name = $_POST['pendanaan_name'];
            if ($pendanaan_name == null){
                $this->session->set_flashdata('error', 'Pendanaan Name tidak boleh NULL');
                redirect('pendanaan');
            }elseif($this->form_validation->run() == false){
                $this->session->set_flashdata('error', validation_errors()."Update Data Gagal Dilakukan");
                redirect('pendanaan');
            }else{
                $data = array(
                    'pendanaan_name' => $_POST['pendanaan_name'],
                    'deskripsi' => $_POST['deskripsi'],
                );
                $this->model->Update('pendanaan',$data,array('code_pendanaan' => $code_pendanaan));
                $this->session->set_flashdata('sukses', 'Update Data Berhasil dilakukan');
                redirect('pendanaan');
            }
        }
    }
    public function delete_pendanaan($kode = 1){
        $this->cek_user();
        if ($this->uri->segment(3) == null){
            $this->session->set_flashdata('error','Maaf anda belum memilih data untuk di hapus');
            redirect('pendanaan');
        }
        $result = $this->model->Hapus('pendanaan', array('code_pendanaan' => $kode));
        if ($result == 1){
            $this->session->set_flashdata('sukses', 'Delete Data Berhasil dilakukan');
            redirect('pendanaan');
        }else{
            $this->session->set_flashdata('error', 'Delete Data Gagal dilakukan');
            redirect('pendanaan');
        }
    }

    public function export_excel(){
        $this->cek_user();
        $data = array(
            'title' => 'Data Pendanaan',
            'data_pendanaan' => $this->model->GetPendanaan()->result_array(),
        );
        $this->load->view('pendanaan/pendanaan-laporan-excel',$data);
    }

    public function export_pdf(){
        $this->cek_user();
        ob_start();
        $data = array(
            'title' => 'Data Pendanaan',
            'data_pendanaan' => $this->model->GetPendanaan()->result_array(),
        );
        $this->load->view('pendanaan/pendanaan-laporan-pdf', $data);
        $html = ob_get_clean();

        require_once ('./assets/html2pdf/html2pdf.class.php');
        $pdf = new HTML2PDF('P','A4','en');
        $pdf->WriteHTML($html);
        $pdf->Output('Data Pendanaan.pdf','D');
    }

    public function export_print(){
        $this->cek_user();
        $data = array(
            'title' => 'Data Pendanaan',
            'data_pendanaan' => $this->model->GetPendanaan()->result_array(),
        );
        $this->load->view('pendanaan/pendanaan-laporan-pdf', $data);
    }
}
?>