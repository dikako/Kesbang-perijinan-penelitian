<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->cek_login();
    }

    private function cek_login(){
        if (!$this->session->userdata('ses_id')){
            $this->session->set_flashdata('error', 'Silahkan login terlebih dahulu');
            redirect('login');
        }
    }

    public function cek_user(){
        if ($this->session->userdata('ses_level') == 'Pengunjung' or $this->session->userdata('ses_level') == 'Pimpinan'){
            $this->session->set_flashdata('error','Maaf anda tidak bisa masuk kehalaman tersebut');
            redirect('dtlp');
        }
    }

    public function cek_pengunjung(){
        if ($this->session->userdata('ses_level') == 'Pengunjung'){
            $this->session->set_flashdata('error','Maaf anda tidak bisa masuk kehalaman tersebut');
            redirect('dtlp');
        }
    }

    public function index()
    {
        $data = array(
            'ses_level' => $this->session->userdata('ses_level'),
            'data_user' => $this->model->GetUser("order by level asc")->result_array(),
            'content' => 'user/user-data',
        );
        $this->load->view('template/site', $data);
    }

    public function detail_data($kode = 0){
        if ($this->uri->segment(3) == null){
            $this->session->set_flashdata('error', 'Silahkan pilih data untuk melihat detail');
            redirect('user');
        }
        $data_user = $this->model->GetUser("where id_user = '$kode'")->result_array();
        $data = array(
            'id_user' => $data_user[0]['id_user'],
            'nama_user' => $data_user[0]['nama_user'],
            'level' => $data_user[0]['level'],
            'email' => $data_user[0]['email'],
            'foto' => $data_user[0]['foto'],
            'last_login' => $data_user[0]['last_login'],
            'content' => 'user/user-detail',
        );
        $this->load->view('template/site', $data);
    }

    public function simpan_data(){
        $this->cek_user();
        if (!$_POST['simpan']){
            $this->session->set_flashdata('error', 'Tambah data belum dilakukan');
            redirect('user');
        }
        $id_user = '';
        $nama_user = $this->input->post('nama_user');
        $level = $this->input->post('level');
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $password = md5($password);
        $last_login = '';

        $cek_nama_user = $this->model->GetUser("where nama_user = '$nama_user'")->num_rows();
        $cek_username = $this->model->GetUser("where username = '$username'")->num_rows();
        if ($cek_nama_user > 0){
            $this->session->set_flashdata('warning', 'Nama user '.$nama_user.' sudah ada');
            redirect('user');
        }elseif ($cek_username > 0){
            $this->session->set_flashdata('warning', 'Username sudah ada');
            redirect('user');
        } else{
            $config = array(
                'upload_path' => './assets/upload/foto-user',
                'allowed_types' => 'gif|jpg|JPG|png|JPEG|pdf|doc',
                'max_size' => '2048',

            );
            $this->load->library('upload', $config);
            $this->upload->do_upload('file_upload');
            $upload_data = $this->upload->data();
            $data = array(
                'id_user' => $id_user,
                'nama_user' => $nama_user,
                'level' => $level,
                'email' => $email,
                'username' => $username,
                'password' => $password,
                'foto' => $upload_data['file_name'],
                'last_login' => $last_login,
            );
            $result = $this->model->Simpan('user',$data);
            if ($result == 1){
                $this->session->set_flashdata('sukses','Simpan data berhasil dilakukan');
                redirect('user');
            }else{
                $this->session->set_flashdata('error', 'Simpan data gagal dilakukan');
                redirect('user');
            }
        }
    }

    public function edit_data($kode = 0){
        $this->cek_user();
        if ($this->uri->segment(3) == null){
            $this->session->set_flashdata('error', 'Silahkan pilih data untuk di edit');
            redirect('user');
        }
        $data_user = $this->model->GetUser("where id_user = '$kode'")->result_array();
        $data = array(
            'id_user' => $data_user[0]['id_user'],
            'nama_user' => $data_user[0]['nama_user'],
            'level' => $data_user[0]['level'],
            'email' => $data_user[0]['email'],
            'foto' => $data_user[0]['foto'],
            'last_login' => $data_user[0]['last_login'],
            'content' => 'user/user-edit',
        );
        $this->load->view('template/site',$data);
    }

    public function update_data(){
        $this->cek_user();
        if (!$_POST['update']){
            $this->session->set_flashdata('error','Update data belum dilakukan');
            redirect('user');
        }
        $id_user = $this->input->post('id_user');
        $nama_user = $this->input->post('nama_user');
        $level = $this->input->post('level');
        $email = $this->input->post('email');
        $last_login = $this->input->post('last_login');
        if ($_FILES['file_upload']['name'] == null){
            $foto = $this->input->post('foto');
        }else{
            $foto = $_FILES['file_upload']['name'];
        }
        $data = array(
            'nama_user' => $nama_user,
            'level' => $level,
            'email' => $email,
            'foto' => $foto,
            'last_login' => $last_login,
        );
        $result = $this->model->Update('user',$data,array('id_user' => $id_user));
        if ($result == 1){
            if ($_FILES['file_upload']['name'] != null){
                unlink('./assets/upload/foto-user/'.$this->input->post('foto'));
            }
            $config = array(
                'upload_path' => './assets/upload/foto-user',
                'allowed_types' => 'gif|jpg|JPG|png|JPEG|pdf',
                'max_size' => '2048',
            );
            $this->load->library('upload', $config);
            $this->upload->do_upload('file_upload');
            $this->session->set_flashdata('sukses','Update data berhasil dilakukan');
            redirect('user');
        }else{
            $this->session->set_flasdata('error','Update data gagal dilakukan');
            redirect('user/edit_data/'.$id_user);
        }
    }

    public function hapus_data($kode = 1){
        $this->cek_user();
        if ($this->uri->segment(3) == null){
            $this->session->set_flashdata('warning','Anda belum memilih data untuk di edit');
            redirect('user');
        }
        $data_user = $this->model->GetUser("where id_user = '$kode'")->result_array();
        $foto = $data_user[0]['foto'];
        $result = $this->model->Hapus('user',array('id_user' => $kode));
        if ($result == 1){
            unlink('./assets/upload/foto-user/'.$foto);
            $this->session->set_flashdata('sukses','Hapus data berhasil dilakukan');
            redirect('user');
        }else{
            $this->session->set_flashdata('error','Hapus data gagal dilakukan');
            redirect('user');
        }
    }

    public function ganti_password($kode = 0){
        if ($this->uri->segment(3) == null){
            $this->session->set_flashdata('warning','Anda belum memilih data untuk ganti password');
            redirect('user');
        }
        $data_user = $this->model->GetUser("where id_user = '$kode'")->row_array();
        $data = array(
            'content' => 'template/ganti-password',
            'password' => $data_user['password'],
            'id_user' => $data_user['id_user'],
        );
        $this->load->view('template/site', $data);
    }

    public function ubah_password(){
        if (!$_POST['update']){
            $this->session->set_flashdata('error', 'Anda belum melakukan ganti password');
            redirect('dashboard');
        }
        $id_user = $this->input->post('id_user');
        $password = $this->input->post('password');
        $password_lama = md5($this->input->post('password_lama'));
        $password_baru = $this->input->post('password_baru');
        $ulangi_password_baru = $this->input->post('ulangi_password_baru');
        if ($password == $password_lama and $password_baru == $ulangi_password_baru){
            $data = array('password' => md5($ulangi_password_baru));
            $this->model->Update('user',$data,array('id_user' => $id_user,));
            $this->session->set_flashdata('sukses','Ganti password berhasil dilakukan');
            redirect('user');
        }else{
            $this->session->set_flashdata('error','Ganti password gagal dilakukan');
            redirect('user');
        }
    }

    public function export_excel(){
        $this->cek_user();
        $data = array(
            'title' => 'Data User',
            'data_user' => $this->model->GetUser()->result_array(),
        );
        $this->load->view('user/user-laporan-excel',$data);
    }

    public function export_pdf(){
        $this->cek_user();
        ob_start();
        $data = array(
            'title' => 'Data User',
            'data_user' => $this->model->GetUser()->result_array(),
        );
        $this->load->view('user/user-laporan-pdf', $data);
        $html = ob_get_clean();

        require_once ('./assets/html2pdf/html2pdf.class.php');
        $pdf = new HTML2PDF('P','A4','en');
        $pdf->WriteHTML($html);
        $pdf->Output('Data User.pdf','D');
    }

    public function export_print(){
        $this->cek_user();
        $data = array(
            'title' => 'Data User',
            'data_user' => $this->model->GetUser()->result_array(),
        );
        $this->load->view('user/user-laporan-pdf', $data);
    }

}
