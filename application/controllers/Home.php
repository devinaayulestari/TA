<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('role') == 'superadmin') {
			redirect('admin');
		}
		if ($this->session->userdata('role') != 'admin') {
			redirect('auth/login');
		}
		$this->load->model('user_model', 'User');
		$this->load->model('data_user_model');
		$this->load->helper(array('form', 'url', 'file'));
	}

	public function index()
	{
		$data['title'] = 'CI 3 - Mazer Admin Dashboard';
		$data['data_user'] = $this->data_user_model->select_by_user($this->session->userdata('id'));
		$data['content'] = 'home';
		$this->load->view('template/layout/base', $data);
	}
	// Halaman Token 
	public function token_view()
	{
		$cek = $this->db->get_where("data_user", ["id_user" => $this->session->userdata('id')])->result();
		// var_dump ($cek);
		// die();
		
		$data['title'] = 'Lengkapi Pendftaran';
		$data['token'] = $this->User->getTokenById($this->session->userdata('id'));
		$data['content'] = 'user/token';
		$this->load->view('template/layout/base', $data);
	}
	// Halaman Pendaftaran
	public function pendaftaran()
	{
		$cek = $this->db->get_where("data_user", ["id_user" => $this->session->userdata('id')])->result();
		if (!empty($cek)) {
			redirect('home');
		}
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
			"status" => 'Ditinjau',
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

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth/login');
	}

	public function detail_pendaftaran($id)
	{
		$this->load->model('data_user_model');
		$data['title'] = 'Lengkapi Pendftaran';
		$data['data_user'] = $this->data_user_model->select_by_id($id);
		$data['content'] = 'detail_pendaftaran';
		$this->load->view('template/layout/base', $data);
	}
	public function ubah()
	{
		$this->load->model('data_user_model');
		$this->load->library('upload', 'session', 'database');
		$id_user = $this->input->post('id_user', true);
		$cek = $this->db->get_where("data_user", ["id_user" => $id_user])->row();
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
			"nama_lembaga" => $this->input->post('nama_lembaga', true),
			"nama_lengkap" => $this->input->post('nama_lengkap', true),
			"nomer_telepon" => $this->input->post('nomer_telepon', true),
			"surat_permohonan" => $surat_permohonan,
			"ktp" => $ktp,
			"sk" => $sk,
			"surat_pernyataan" => $surat_pernyataan,
			"status" => 'Ditinjau',
			"tanggal_daftar" => date('Y-m-d')
		];
		$update = $this->data_user_model->update($data, $cek->id);

		// Cek Apakah berhasil atau tidak
		if ($update) {
			$this->session->set_flashdata('berhasil', 'Data berhasil diubah!');
			redirect('home');
		}

		$this->session->set_flashdata('gagal', 'Data gagal diubah!');
		redirect('home');
	}
	public function send_kode()
	{
		$cek_email = $this->User->select_by_id($this->session->userdata('id'));
		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'mail.mehelmi.my.id',
			'smtp_port' => 465,
			'smtp_user' => 'devina@mehelmi.my.id',
			'smtp_pass' => 'devina_12345678',
			'crlf' => "\r\n",
			'newline' => "\r\n",
			'mailtype' => 'html',
			'smtp_crypto' => 'ssl',
			'wordwrap' => TRUE
		);

		$message = 	"
                    <html>
                    <head>
                        <title>Token Jwt</title>
                    </head>
                    <body>
                        <h2>Mohon Digunakan Dengan Bijaksana.</h2>
                        <p>Your Account:</p>
                        <p>Email: " . $cek_email['email'] . "</p>
                        <p>Jwt Token: " . $cek_email['jwtToken'] . "</p>
                        
                    </body>
                    </html>
                    ";
					
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from($config['smtp_user']);
		$this->email->to($cek_email['email']);
		$this->email->subject('Token JWT');
		$this->email->message($message);
		$this->email->send();
		$this->session->set_flashdata('berhasil', 'Silahkan Cek Email Anda!');
		redirect('home');
	}
	public function hapus()
	{
		$cek = $this->db->delete("data_user", ["id_user" => $this->session->userdata('id')]);
		if ($cek) {
			redirect('home');
		}
	}
}

/* End of file Home.php and path \application\controllers\Home.php */
