<?php
class Administrator extends CI_Controller{
    function __construct(){
        parent:: __construct();
        $this->load->model('m_login');
    }
    function index(){
        $this->load->view('admin/v_login');
    }
    function auth(){
        $username=strip_tags(str_replace("'", "", $this->input->post('username')));
        $password=strip_tags(str_replace("'", "", $this->input->post('password')));
        $u=$username;
        $p=md5($password);
        $cadmin=$this->m_login->cekadmin($u,$p);
        if($cadmin->num_rows() > 0){
         $this->session->set_userdata('masuk',true);
         $this->session->set_userdata('user',$u);
         $xcadmin=$cadmin->row_array();
             if($xcadmin['pengguna_level']=='1')
             {
                $this->session->set_userdata('akses','1');
                $idadmin=$xcadmin['pengguna_id'];
                $user_nama=$xcadmin['pengguna_nama'];
                $this->session->set_userdata('idadmin',$idadmin);
                $this->session->set_userdata('nama',$user_nama);
            }
             else if($xcadmin['pengguna_level']=='2')
             {
                 $this->session->set_userdata('akses','2');
                 $idadmin=$xcadmin['pengguna_id'];
                 $user_nama=$xcadmin['pengguna_nama'];
                 $this->session->set_userdata('idadmin',$idadmin);
                 $this->session->set_userdata('nama',$user_nama);
             } //Front Office 
        }
        
        if($this->session->userdata('masuk') == true){
            redirect('Administrator/berhasillogin');
        }else{
            redirect('Administrator/gagallogin');
        }
    }
        function berhasillogin(){
            redirect('Admin/Mahasiswa');
        }
        function gagallogin(){
            $url=base_url('Administrator');
            echo $this->session->set_flashdata('msg','<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Username Atau Password Salah</div>');
            redirect($url);
        }
        function logout(){
            $this->session->sess_destroy();
            $url=base_url('Administrator');
            redirect($url);
        }
}