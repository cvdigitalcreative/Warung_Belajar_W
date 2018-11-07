<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	function __construct(){
		parent:: __construct();
		$this->load->model('m_mahasiswa');
		$this->load->model('m_pengunjung');
        $this->m_pengunjung->count_visitor();
	}

	public function index()
	{
		$x['count']=$this->m_mahasiswa->count_mahasiswa();
		$this->load->view('v_home',$x);
	}

	public function saveMahasiswa()
	{
		$name=strip_tags($this->input->post('name'));
		$email=strip_tags($this->input->post('email'));
		$kontak=strip_tags($this->input->post('kontak'));
		$paket=strip_tags($this->input->post('paket'));		
		$this->m_mahasiswa->save_mahasiswa($name,$email,$kontak,$paket);
        echo $this->session->set_flashdata('msg',' <p >NB: </strong> Terima Kasih Telah Mendaftar.Kami akan menghubungi anda segera</p>');
        redirect();
	}


}
