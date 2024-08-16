<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Survei extends CI_Controller

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

		$data['title'] = 'Survei';
		if ($this->session->userdata('user')['role'] == 0) {
			$data['survei'] = $this->db->select('survei.*, pengguna.nama_pengguna')
				->from('survei')
				->join('pengguna', 'survei.id_pengguna = pengguna.id_pengguna')
				->get()
				->result();
		} else {
			$id_pengguna = $this->session->userdata('user')['id_pengguna'];
			$data['survei'] = $this->db->select('survei.*, pengguna.nama_pengguna')
				->from('survei')
				->join('pengguna', 'survei.id_pengguna = pengguna.id_pengguna')
				->where('survei.id_pengguna', $id_pengguna)
				->get()
				->result();
		}
		$data['content'] = $this->load->view('survei/index', $data, TRUE); // Contoh halaman lain

		$this->load->view('adminlte', $data);
	}
	public function store()
	{
		$judul = $this->input->post('judul');
		$deskripsi = $this->input->post('deskripsi');
		$tanggal_mulai = $this->input->post('tanggal_mulai');
		$tanggal_selesai = $this->input->post('tanggal_selesai');

		$data = array(
			'id_pengguna' => $this->session->userdata('user')['id_pengguna'],
			'judul' => $judul,
			'deskripsi' => $deskripsi,
			'tanggal_mulai' => $tanggal_mulai,
			'tanggal_selesai' => $tanggal_selesai
		);

		$this->db->insert('survei', $data);
		$insert_id = $this->db->insert_id();

		$this->session->set_flashdata('success', 'Data Berhasil Ditambah');
		redirect('survei/pertanyaan/' . $insert_id);
	}

	public function update($id_survei)
	{
		$judul = $this->input->post('judul');
		$deskripsi = $this->input->post('deskripsi');
		$tanggal_mulai = $this->input->post('tanggal_mulai');
		$tanggal_selesai = $this->input->post('tanggal_selesai');

		$data = array(
			'judul' => $judul,
			'deskripsi' => $deskripsi,
			'tanggal_mulai' => $tanggal_mulai,
			'tanggal_selesai' => $tanggal_selesai
		);

		$this->db->where('id_survei', $id_survei);
		$this->db->update('survei', $data);
		$this->session->set_flashdata('success', 'Data Berhasil Diupdate');
		redirect('survei');
	}

	public function delete($id_survei)
	{
		// Delete data from the database
		$this->db->where('id_survei', $id_survei);
		$this->db->delete('survei');
		$this->session->set_flashdata('success', 'Data Berhasil Dihapus');
		redirect('survei');
	}
	public function pertanyaan($id_survei)
	{
		$data['survei'] = $this->db->get_where('survei', array('id_survei' => $id_survei))->row();
		$data['title'] = $data['survei']->judul;

		$data['pertanyaan'] = $this->db->get_where('pertanyaan', array('id_survei' => $id_survei))->result();
		$data['content'] = $this->load->view('survei/pertanyaan', $data, TRUE);

		$this->load->view('adminlte', $data);
	}
	public function pertanyaan_store()
	{
		// Get the form data
		$id_survei = $this->input->post('id_survei');
		$tipe_pertanyaan = $this->input->post('tipe_pertanyaan');
		$teks_pertanyaan = $this->input->post('teks_pertanyaan');
		$gambar_pertanyaan = $_FILES['gambar_pertanyaan']['name'] ?: null;

		// Upload image if available
		if ($gambar_pertanyaan) {
			// Set the upload path for the image
			$upload_path = 'public/gambar/';

			// Generate a unique name for the uploaded image to prevent overwriting
			$image_name = date('dmyHis') . '-' . $gambar_pertanyaan;

			// Set the file path for saving in the database
			$gambar_pertanyaan =  $image_name;

			// Move the uploaded file to the desired location
			move_uploaded_file($_FILES['gambar_pertanyaan']['tmp_name'], $upload_path . $image_name);
		}

		// Insert the question data into the 'pertanyaan' table
		$question_data = array(
			'id_survei' => $id_survei,
			'tipe_pertanyaan' => $tipe_pertanyaan,
			'teks_pertanyaan' => $teks_pertanyaan,
			'gambar_pertanyaan' => $gambar_pertanyaan
		);
		$this->db->insert('pertanyaan', $question_data);

		// Get the inserted question ID
		$question_id = $this->db->insert_id();

		// Insert the option data into the 'opsi' table, if applicable
		if ($tipe_pertanyaan === "pilihan_ganda" || $tipe_pertanyaan === "checkbox") {
			$text_opsi = $this->input->post('teks_opsi');

			if (!empty($text_opsi)) {
				foreach ($text_opsi as $opsi_text) {
					$option_data = array(
						'id_pertanyaan' => $question_id,
						'teks_opsi' => $opsi_text
					);
					$this->db->insert('opsi', $option_data);
				}
			}
		}
		$this->session->set_flashdata('success', 'Data Berhasil Ditambah');
		redirect('survei/pertanyaan/' . $id_survei);
	}
	public function pertanyaan_delete($id_pertanyaan)
	{
		// Delete data from the database
		$this->db->where('id_pertanyaan', $id_pertanyaan);
		$this->db->delete('pertanyaan');
		$this->session->set_flashdata('success', 'Data Berhasil Dihapus');

		redirect($_SERVER['HTTP_REFERER']);
	}
	public function isi($id_survei)
	{
		$data['survei'] = $this->db->get_where('survei', array('id_survei' => $id_survei))->row();
		if ($data['survei']->tanggal_mulai > date("Y-m-d H:i:s") || $data['survei']->tanggal_selesai < date("Y-m-d H:i:s")) {
			// The survey is not currently active, so it redirects to the dashboard.
			$this->session->set_flashdata('error', 'gagal survei belum dimulai atau sudah terlambat');
			return redirect('dashboard');
		}
		
		$data['title'] = $data['survei']->judul;

		$data['pertanyaan'] = $this->db->get_where('pertanyaan', array('id_survei' => $id_survei))->result();
		foreach ($data['pertanyaan'] as $key => $value) {
			if ($value->tipe_pertanyaan === "pilihan_ganda" || $value->tipe_pertanyaan === "checkbox") {
				$data['opsi'][$key] = $this->db->get_where('opsi', array('id_pertanyaan' => $value->id_pertanyaan))->result();
			}
		}
		$data['content'] = $this->load->view('survei/isi', $data, TRUE);

		$this->load->view('isitemplate', $data);
	}
	public function respons_store()
	{
		// Check if the form is submitted
		$id_pengguna = $this->session->userdata('user')['id_pengguna']; // Assuming you get the user ID from the session or elsewhere
		$id_pertanyaan = $this->input->post('id_pertanyaan');
		$tipe_pertanyaan = $this->input->post('tipe_pertanyaan');
		$id_survei = $this->input->post('id_survei');
		$waktu_pengiriman = date('Y-m-d H:i:s');

		// Insert the response data into the 'respons' table
		$response_data = array(
			'id_pengguna' => $id_pengguna,
			'id_survei' => $id_survei,
			'waktu_pengiriman' => $waktu_pengiriman
		);
		$this->db->insert('respons', $response_data);

		$response_id = $this->db->insert_id();
		foreach ($id_pertanyaan as $key => $value) {
			if ($tipe_pertanyaan[$key] == "essai") {
				$text_jawaban = $this->input->post('text_jawaban');
				$jawaban_data = array(
					'id_respons' => $response_id,
					'id_pertanyaan' => $value,
					'teks_jawaban' => $text_jawaban[$key]
				);
				$this->db->insert('jawaban', $jawaban_data);
			} elseif ($tipe_pertanyaan[$key] == "pilihan_ganda") {
				// Handle 'pilihan_ganda' type answer
				$id_opsi_terpilih = $this->input->post('id_opsi_terpilih');
				if (isset($id_opsi_terpilih[$key])) {
					$jawaban_data = array(
						'id_respons' => $response_id,
						'id_pertanyaan' => $value,
						'id_opsi_terpilih' => $id_opsi_terpilih[$key]
					);
					$this->db->insert('jawaban', $jawaban_data);
				}
			} elseif ($tipe_pertanyaan[$key] == "checkbox") {
				// Handle 'checkbox' type answer
				$id_opsi_terpilih = $this->input->post('id_opsi_terpilih');
				if (is_array($id_opsi_terpilih[$key])) {
					foreach ($id_opsi_terpilih[$key] as $opsi_id) {
						$jawaban_data = array(
							'id_respons' => $response_id,
							'id_pertanyaan' => $value,
							'id_opsi_terpilih' => $opsi_id
						);
						$this->db->insert('jawaban', $jawaban_data);
					}
				}
			} elseif ($tipe_pertanyaan[$key] == "file") {
				// Handle 'file' type answer
				if (isset($_FILES['path_unggahan_file']) && isset($_FILES['path_unggahan_file']['name'][$key])) {
					$file_uploads = $_FILES['path_unggahan_file'];
					$filename = $file_uploads['name'][$key];

					if ($file_uploads['error'][$key] === UPLOAD_ERR_OK) {
						// Set the upload path for the file
						$upload_path = './public/respons/';
						// Generate a unique name for the file to prevent overwriting
						$file_name = date('dmyHis') . '-' . $filename;
						// Set the file path for saving in the 'jawaban' table
						$file_path = $file_name;
						// Move the uploaded file to the desired location
						move_uploaded_file($file_uploads['tmp_name'][$key], $upload_path . $file_name);

						$jawaban_data = array(
							'id_respons' => $response_id,
							'id_pertanyaan' => $value,
							'path_unggahan_file' => $file_path
						);
						$this->db->insert('jawaban', $jawaban_data);
					}
				}
			}
		}

		$this->session->set_flashdata('success', 'Survei berhasil dikerjakan');
		redirect('Survei');
	}
	public function jawaban($id_survei)
	{
		$data['survei'] = $this->db->get_where('survei', array('id_survei' => $id_survei))->row();
		$dat['title'] = $data['survei']->judul;

		$data['pertanyaan'] = $this->db->get_where('pertanyaan', array('id_survei' => $id_survei))->result();
		foreach ($data['pertanyaan'] as $key => $value) {

			if ($value->tipe_pertanyaan === "checkbox") {
				$this->db->select('jawaban.id_pertanyaan, opsi.teks_opsi, jawaban.id_opsi_terpilih, COUNT(jawaban.id_opsi_terpilih) as jumlah');
				$this->db->from('jawaban');
				$this->db->join('opsi', 'jawaban.id_opsi_terpilih = opsi.id_opsi');
				$this->db->where('jawaban.id_pertanyaan', $value->id_pertanyaan);
				$this->db->group_by('jawaban.id_pertanyaan, jawaban.id_opsi_terpilih');

				$data['jawaban'][$key] = $this->db->get()->result();
			} else if ($value->tipe_pertanyaan === "pilihan_ganda") {
				$this->db->select('jawaban.id_pertanyaan, opsi.teks_opsi, jawaban.id_opsi_terpilih');
				$this->db->from('jawaban');
				$this->db->join('opsi', 'jawaban.id_opsi_terpilih = opsi.id_opsi');
				$this->db->where('jawaban.id_pertanyaan', $value->id_pertanyaan);

				$data['jawaban'][$key] = $this->db->get()->result();
			} else {
				$data['jawaban'][$key] = $this->db->get_where('jawaban', array('id_pertanyaan' => $value->id_pertanyaan))->result();
			}
		}
		$dat['content'] = $this->load->view('survei/jawaban', $data, TRUE);

		$this->load->view('adminlte', $dat);
	}
}
