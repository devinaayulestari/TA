<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('role') != 'superadmin') {
			redirect('auth/login');
		}
		$this->load->model('user_model', 'User');
		$this->load->helper(array('form', 'url', 'file'));
	}

	public function index()
	{
		$this->load->model('data_user_model');
		$data['title'] = 'CI 3 - Mazer Admin Dashboard';
		$data['data_user'] = $this->User->select_by_id($this->session->userdata('id'));
		$data['data_pengajuan'] = $this->data_user_model->select();
		$data['content'] = 'admin/pengajuan/index';
		$this->load->view('template/layout/base', $data);
	}

	public function list_user()
	{
		$data['title'] = 'CI 3 - Mazer Admin Dashboard';
		$data['data_user'] = $this->User->select_by_id($this->session->userdata('id'));
		$data['list_user'] = $this->User->select();
		$data['content'] = 'admin/user/index';
		$this->load->view('template/layout/base', $data);
	}

	public function pendaftaran()
	{
		$data['title'] = 'Lengkapi Pendftaran';
		$data['user'] = $this->User->select_by_id($this->session->userdata('id'));
		$data['content'] = 'user/pendaftaran';
		$this->load->view('template/layout/base', $data);
	}
	public function lengkapi()
	{
		$this->load->library('upload', 'session', 'database');
		$id_user = $this->input->post('id_user', true);
		$surat_permohonan = null;
		if ($_FILES['surat_permohonan'] != null) {
			$test = explode('.', $_FILES["surat_permohonan"]["name"]);
			$ext = end($test);
			$name = "surat_permohonan-" . $id_user . '.' . $ext;
			$location = $config['upload_path'] 		= "./assets/img/berkas/" . $name . "";
			move_uploaded_file($_FILES["surat_permohonan"]["tmp_name"], $location);
			$surat_permohonan = $name;
		}
		$ktp = null;
		if ($_FILES['ktp'] != null) {
			$test = explode('.', $_FILES["ktp"]["name"]);
			$ext = end($test);
			$name = "ktp-" . $id_user . '.' . $ext;
			$location = $config['upload_path'] 		= "./assets/img/berkas/" . $name . "";
			move_uploaded_file($_FILES["ktp"]["tmp_name"], $location);
			$ktp = $name;
		}
		$sk = null;
		if ($_FILES['sk'] != null) {
			$test = explode('.', $_FILES["sk"]["name"]);
			$ext = end($test);
			$name = "sk-" . $id_user . '.' . $ext;
			$location = $config['upload_path'] 		= "./assets/img/berkas/" . $name . "";
			move_uploaded_file($_FILES["sk"]["tmp_name"], $location);
			$sk = $name;
		}
		$surat_pernyataan = null;
		if ($_FILES['surat_pernyataan'] != null) {
			$test = explode('.', $_FILES["surat_pernyataan"]["name"]);
			$ext = end($test);
			$name = "surat_pernyataan-" . $id_user . '.' . $ext;
			$location = $config['upload_path'] 		= "./assets/img/berkas/" . $name . "";
			move_uploaded_file($_FILES["surat_pernyataan"]["tmp_name"], $location);
			$surat_pernyataan = $name;
		}

		$data = [
			"id_user" => $id_user,
			"nama_lembaga" => $this->input->post('nama_lembaga', true),
			"nama_lengkap" => $this->input->post('nama_lengkap', true),
			"nomer_telepon" => $this->input->post('nomer_telepon', true),
			"surat_permohonan" => $surat_permohonan,
			"ktp" => $ktp,
			"sk" => $sk,
			"surat_pernyataan" => $surat_pernyataan,
			"status" => 'ditinjau',
			"tanggal_daftar" => date('Y-m-d')
		];
		$this->load->model('data_user_model');
		$create = $this->data_user_model->lengkapi($data);

		// Cek Apakah berhasil atau tidak
		if ($create) {
			$this->session->set_flashdata('berhasil', 'Data berhasil dilengkapi!');
			redirect('home');
		}

		$this->session->set_flashdata('gagal', 'Data gagal dilengkapi!');
		redirect('home/pendaftaran');
	}
	public function detail_pendaftar($id)
	{
		$this->load->model('data_user_model');
		$data['title'] = 'Lengkapi Pendftaran';
		$data['user'] = $this->data_user_model->select_by_id($id);
		$data['content'] = 'admin/pengajuan/detail';
		$this->load->view('template/layout/base', $data);
	}
	public function setujui($id)
	{
		$this->load->model('data_user_model');
		$data = [
			"status" => 'Disetujui'

		];
		$update = $this->data_user_model->update($data, $id);

		// Cek Apakah berhasil atau tidak
		if ($update) {
			$this->createToken($this->data_user_model->get_user($id)["id_user"]);
			$this->session->set_flashdata('berhasil', 'Data berhasil diubah!');
			redirect('admin');
		}

		$this->session->set_flashdata('gagal', 'Data gagal diubah!');
		redirect('admin');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth/login');
	}
	public function hapus($id)
	{
		$this->load->model('data_user_model');
		$update = $this->data_user_model->hapus($id);

		// Cek Apakah berhasil atau tidak
		if ($update) {
			$this->session->set_flashdata('berhasil', 'Data berhasil diubah!');
			redirect('admin');
		}

		$this->session->set_flashdata('gagal', 'Data gagal diubah!');
		redirect('admin');
	}
	public function tolak()
	{
		$id = $this->input->POST('id');
		$pesan = $this->input->POST('pesan');
		$this->load->model('data_user_model');
		$data = [
			"status" => 'Ditolak',
			"pesan" => $pesan
		];
		$update = $this->data_user_model->update($data, $id);

		// Cek Apakah berhasil atau tidak
		if ($update) {
			$this->session->set_flashdata('berhasil', 'Data berhasil diubah!');
			redirect('admin');
		}

		$this->session->set_flashdata('gagal', 'Data gagal diubah!');
		redirect('admin');
	}

	// buat token jwt
	// buat token jwt
	// buat token jwt
	private function createToken($id)
	{
		$this->load->library('Authorization_Token');
		$user = $this->User->select_by_id($id);
		$token_data['uid'] = $user['id'];
		$token_data['username'] = $user['username'];
		$tokenData = $this->authorization_token->generateToken($token_data);
		$data = [
			"jwtToken" => $tokenData,
			"statusAkun" => "Aktif"

		];
		$update = $this->User->update($data, $id);
	}
	// buat token jwt
	// buat token jwt
	// buat token jwt



	// menonaktifkan user agr tidak bisa mengakses token 
	// menonaktifkan user agr tidak bisa mengakses token 
	
	public function nonaktifkan($id)
	{
		$data = [
			"statusAkun" => "nonAktif"

		];
		$update = $this->User->update($data, $id);

		// Cek Apakah berhasil atau tidak
		if ($update) {
			$this->session->set_flashdata('berhasil', 'Data berhasil diubah!');
			redirect('admin/list_user');
		}

		$this->session->set_flashdata('gagal', 'Data gagal diubah!');
		redirect('admin/list_user');
	}
	// menonaktifkan user agr tidak bisa mengakses token 
	// menonaktifkan user agr tidak bisa mengakses token 
	

	// mengaktifkan kembali user jika diperlukan 
	// mengaktifkan kembali user jika diperlukan 
	public function aktifkan($id)
	{
		$data = [
			"statusAkun" => "Aktif"

		];
		$update = $this->User->update($data, $id);

		// Cek Apakah berhasil atau tidak
		if ($update) {
			$this->session->set_flashdata('berhasil', 'Data berhasil diubah!');
			redirect('admin/list_user');
		}

		$this->session->set_flashdata('gagal', 'Data gagal diubah!');
		redirect('admin/list_user');
	}
}


/* End of file Home.php and path \application\controllers\Home.php */
