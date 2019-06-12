<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Years extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->cek_login();
        $this->load->helper(array('form','url','file'));
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
            $this->session->set_flashdata('error','Maaf anda tidak masuk kehalaman tersebut');
            redirect('years');
        }
    }

    public function index(){
        $data = array(
            'status' => 'new',
            'code_years' => '',
            'years_name' => '',
            'data_years' => $this->model->GetYears("order by years_name asc")->result_array(),
            'content' => 'years/years-data'
        );
        $this->load->view('template/site', $data);
    }

    public function edit_years($kode = 0){
        $this->cek_user();
        if ($this->uri->segment(3) == null){
            $this->session->set_flashdata('error','Maaf anda memilih data untuk di edit');
            redirect('years');
        }
        $patch = $this->model->GetYears("where code_years = '$kode'")->result_array();
        $data = array(
            'status' => 'old',
            'code_years' => $patch[0]['code_years'],
            'years_name' => $patch[0]['years_name'],
            'data_years' => $this->model->GetYears("where code_years != '$kode' order by years_name asc")->result_array(),
            'content' => 'years/years-data'
        );
        $this->load->view('template/site', $data);
    }

    public function save_years(){
        $this->cek_user();
        if (!$_POST['save']){
            $this->session->set_flashdata('error','Anda belum melaukan tambah atau edit data');
            redirect('years');
        }
        $this->form_validation->set_rules('code_years', 'Code_years');
        $this->form_validation->set_rules('years_name', 'Years_name','required');
        $this->form_validation->set_rules('status', 'status', 'required');
        $status = $_POST['status'];
        if ($status == 'new') {
            $years_name = $_POST['years_name'];
            $cek = $this->db->query("select * from years WHERE years_name = '$years_name'")->num_rows();
            if ($cek > 0) {
                $this->session->set_flashdata('error', "Data Sudah ada");
                redirect('years');
            }else if ($this->form_validation->run()==FALSE){
                $this->session->set_flashdata('error', validation_errors()."Simpan Data Gagal Dilakukan");
                redirect('years');
            }else {
                $data = array(
                    'code_years' => $_POST['code_years'],
                    'years_name' => $_POST['years_name'],
                );
                $this->model->Simpan('years', $data);
                $this->session->set_flashdata('sukses', "Simpan Data Berhasil dilakukan");
                $path = './assets/pdf/'.$years_name;
                if (!is_dir($path)){
                    mkdir($path, 0777, TRUE);
                }
                redirect('years');
            }
        }else{
            $code_years = $_POST['code_years'];
            $years_name = $_POST['years_name'];
            $years_name2 = $_POST['years_name2'];
            $path2 = './assets/pdf/'.$years_name2;
            $path1 = './assets/pdf/'.$years_name;
            $cek = $this->db->query("select * from years WHERE years_name = '$years_name'")->num_rows();
            if ($cek > 0) {
                $data = array(
                    'code_years' => $code_years,
                    'years_name' => $years_name,
                );
                $this->db->replace('years',$data);
                if (is_dir($path2)){
                    rmdir($path2);
                }
                if (!is_dir($path1)) {
                    mkdir($path1, 0777, TRUE);
                }
                $this->session->set_flashdata('warning', "Data sudah ada otomatis update data tersebut");
                redirect('years');
            }elseif ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('error', "Update Data Gagal Dilakukan");
                redirect('years');
            }else {
                $data = array(
                    'years_name' => $_POST['years_name'],
                );
                if (is_dir($path2)){
                    rmdir($path2);
                }
                if (!is_dir($path1)) {
                    mkdir($path1, 0777, TRUE);
                }
                $this->model->Update('years', $data, array('code_years' => $code_years));
                $this->session->set_flashdata('sukses', "Update Data Berhasil dilakukan");
                redirect('years');
            }
        }
    }
    public function delete_years($kode = 1){
        $this->cek_user();
        $tampil = $this->model->GetYears("where code_years = '$kode'")->row_array();
        if ($this->uri->segment(3) == null){
            $this->session->set_flashdata('error', 'Maaf anda belum memilih data untuk dihapus');
            redirect('years');
        }
        $result = $this->model->Hapus('years', array('code_years' => $kode));
        if ($result == 1){
            $this->session->set_flashdata('sukses',"Delete Data Berhasil dilakukan");
            $path = './assets/pdf/'.$tampil['years_name'];
            if (is_dir($path)){
                rmdir($path);
            }
            redirect('years');
        }else{
            $this->session->set_flashdata('error',"Delete Data Gagal dilakukan");
            redirect('years');
        }
    }

    public function export_excel(){
        $this->cek_user();
        $data = array(
            'title' => 'Data Tahun Penelitian',
            'data_years' => $this->model->GetYears()->result_array(),
        );
        $this->load->view('years/years-laporan-excel',$data);
    }

    public function export_pdf(){
        $this->cek_user();
        ob_start();
        $data = array(
            'title' => 'Data Tahun Penelitian',
            'data_years' => $this->model->GetYears()->result_array(),
        );
        $this->load->view('years/years-laporan-pdf', $data);
        $html = ob_get_clean();

        require_once ('./assets/html2pdf/html2pdf.class.php');
        $pdf = new HTML2PDF('P','A4','en');
        $pdf->WriteHTML($html);
        $pdf->Output('Data Tahun Penelitian.pdf','D');
    }

    public function export_print(){
        $this->cek_user();
        $data = array(
            'title' => 'Data Tahun Penelitian',
            'data_years' => $this->model->GetYears()->result_array(),
        );
        $this->load->view('years/years-laporan-pdf', $data);
    }
}
?>