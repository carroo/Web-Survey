<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        
        // Load the session library
        $this->load->library('session');
		
    }
	public function index()
	{
		$this->load->view('login');
	}

	public function proses_login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		// Load the database library
		$this->load->database();

		// Check if the provided credentials are valid
		$user = $this->db->get_where('pengguna', array('email' => $email))->row();
		if ($user && password_verify($password, $user->password)) {
			// User login successful, store user session data or any other necessary actions
			// For example, you can set session data like this:
			$user_data = array(
				'id_pengguna' => $user->id_pengguna,
				'nama_pengguna' => $user->nama_pengguna,
				'email' => $user->email,
				'role' => $user->role
				// Add more properties as needed
			);
			$this->session->set_userdata('user', $user_data);
			// Redirect the user to the dashboard or any other page after login
			redirect('dashboard');
		} else {
			// Login failed, redirect back to the login page with an error message
			$this->session->set_flashdata('error', 'Email atau password salah');
			redirect('login');
		}
	}

	public function register()
	{
		$this->load->view('register');
	}

	public function proses_register()
	{
		$nama_pengguna = $this->input->post('nama');
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		// Load the database library
		$this->load->database();

		// Check if the email already exists
		$existing_user = $this->db->get_where('pengguna', array('email' => $email))->row();
		if ($existing_user) {
			// Email already registered, redirect back to the registration page with an error message
			$this->session->set_flashdata('error', 'Email sudah terdaftar.');
			redirect('Login/register');
		} else {
			// Insert the new user into the database
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);
			$user_data = array(
				'nama_pengguna' => $nama_pengguna,
				'email' => $email,
				'password' => $hashed_password
			);
			$this->db->insert('pengguna', $user_data);

			// Registration successful, redirect to the login page with a success message
			$this->session->set_flashdata('success', 'Register berhasil silahkan login.');
			redirect('Login');
		}
	}
	public function logout()
	{

		// Destroy the user session
		$this->session->sess_destroy();

		// Redirect the user to the login page after logout
		redirect('login');
	}
}
