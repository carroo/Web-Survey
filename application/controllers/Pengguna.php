<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller

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

		$data['title'] = 'Pengguna';
		$data['pengguna'] = $this->db->get('pengguna')->result();
		$data['content'] = $this->load->view('pengguna', $data, TRUE); // Contoh halaman lain

		$this->load->view('adminlte', $data);
	}
	public function store() {
        $nama_pengguna = $this->input->post('nama_pengguna');
        $email = $this->input->post('email');
        $role = $this->input->post('role');
        $password = $this->input->post('password');

        $data = array(
            'nama_pengguna' => $nama_pengguna,
            'email' => $email,
            'role' => $role,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        );

        $this->db->insert('pengguna', $data);
		$this->session->set_flashdata('success', 'Data Berhasil Ditambah');
        redirect('pengguna'); 
    }

    public function update($id_pengguna) {
        $nama_pengguna = $this->input->post('nama_pengguna');
        $email = $this->input->post('email');

        $data = array(
            'nama_pengguna' => $nama_pengguna,
            'email' => $email
        );

        $this->db->where('id_pengguna', $id_pengguna);
        $this->db->update('pengguna', $data);
		$this->session->set_flashdata('success', 'Data Berhasil Diupdate');
        redirect('pengguna'); 
    }

    public function delete($id_pengguna) {
        // Delete data from the database
        $this->db->where('id_pengguna', $id_pengguna);
        $this->db->delete('pengguna');
		$this->session->set_flashdata('success', 'Data Berhasil Dihapus');
        redirect('pengguna'); 
    }
}
