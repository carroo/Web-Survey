<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller

{

	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        
        // Load the session library
        $this->load->library('session');
        
        // Check if the user is logged in
        if (!$this->session->userdata('user')) {
            // User is not logged in, redirect to the login page
            redirect('login');
        }
        // Load the database library
        $this->load->database();
    }
	public function index()
	{

		$data['title'] = 'Dashboard';
		if($this->session->userdata('user')['role'] == 0){
			$data['survei'] = $this->db->get('survei')->result();
			$data['pengguna'] = $this->db->get('pengguna')->result();
		}else{
			$data['survei'] = $this->db->get_where('survei', array('id_pengguna' => $this->session->userdata('user')['id_pengguna']))->result();
		}
		$data['content'] = $this->load->view('dashboard', $data, TRUE); // Contoh halaman lain

		$this->load->view('adminlte', $data);
	}
}
