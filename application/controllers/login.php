<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->session->unset_userdata('ses_id');
        $this->session->unset_userdata('ses_user');
        $this->session->unset_userdata('ses_nama');
        $this->session->unset_userdata('ses_level');
        $this->load->view('login/index');
    }

    public function sign_in(){
        if (!$_POST['log']){
            $this->session->userdata('warning','Anda belum melakukan login');
            redirect('login');
        }
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $password = md5($password);
        $cek_login = $this->model->GetUser("where username = '$username' and password = '$password'")->num_rows();
        $tampil = $this->model->GetUser("where username = '$username' and password = '$password'")->row_array();
        if ($cek_login == 1){
            $this->session->set_userdata('ses_id',$tampil['id_user']);
            $this->session->set_userdata('ses_nama',$tampil['nama_user']);
            $this->session->set_userdata('ses_level',$tampil['level']);
            $this->session->set_userdata('ses_foto',$tampil['foto']);
            redirect('dashboard');
        }else{
            $this->session->set_flashdata('error','Maaf anda gagal login');
            redirect('login');
        }
    }

    public function sign_out(){
        if (!$this->session->userdata('ses_id')){
            $this->session->set_flashdata('error','Anda belum melakukan login');
            redirect('login');
        }
        $id_user = $this->session->userdata('ses_id');
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('F d, Y - H:i');
        $data = array(
            'last_login' => $tanggal,
        );
        $this->model->Update('user', $data, array('id_user' => $id_user));
        $this->session->unset_userdata('ses_user');
        $this->session->unset_userdata('ses_nama');
        $this->session->unset_userdata('ses_level');
        $this->session->unset_userdata('ses_foto');
        $this->session->set_flashdata('sukses', 'Terimakasih Telah Menggunakan Aplikasi SILAPGM');
        redirect('login');
    }

    public function daftar_data(){
        if (!$_POST['daftar']){
            $this->session->set_flashdata('warning','Anda belum melakukan daftar');
            redirect('login');
        }
        $username = $this->input->post('username');
        $cek_username = $this->model->GetUser("where username = '$username'")->num_rows();
        if ($cek_username > 0){
            $this->session->set_flashdata('warning','Username sudah ada');
            redirect('login');
        }else{
            $config = array(
                'upload_path' => './assets/upload/foto-user',
                'allowed_types' => 'gif|jpg|JPG|png|JPEG|pdf|doc',
                'max_size' => '2048',

            );
            $this->load->library('upload', $config);
            $this->upload->do_upload('file_upload');
            $upload_data = $this->upload->data();
            $data = array(
                'id_user' => '',
                'nama_user' => $this->input->post('nama_user'),
                'level' => $this->input->post('level'),
                'email' => $this->input->post('email'),
                'username' => $username,
                'password' => md5($this->input->post('password')),
                'foto' => $upload_data['file_name'],
            );
            $result = $this->model->Simpan('user',$data);
            if ($result == 1){
                $this->session->set_flashdata('sukses','Daftar berhasil dilakukan');
                redirect('login');
            }else{
                $this->session->set_flashdata('error', 'Daftar gagal dilakukan');
                redirect('login');
            }
        }
    }

    public function lupa_password(){
        if (!$_POST['ganti']){
            $this->session->set_flashdata('error','Anda belum melakukan lupa password');
            redirect('login');
        }
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $password_asli = $this->input->post('ulangi_password');
        $data_user = $this->model->GetUser("where email = '$email' and username = '$username'")->row_array();
        $email_asli = $data_user['email'];
        $username_asli = $data_user['username'];
        if ($email == $email_asli and $username == $username_asli and $password == $password_asli){
            $data = array(
                'password' => md5($password_asli),
            );
            $result = $this->model->Update('user',$data,array('username'=>$username));
            if ($result == 1){
                $this->session->set_flashdata('sukses','Berhasil melakukan ganti password');
                redirect('login');
            }else{
                $this->session->set_flashdata('error','Gagal melakukan ganti password');
                redirect('login');
            }
        }else{
            $this->session->set_flashdata('error','Email, Username atau password tidak sesuai');
            redirect('login');
        }
    }
}
