<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;
class petani extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('Authorization_Token');	
		$this->load->model('user_model', 'User');    
	}

	public function index_get($id=null)
	{
		$headers = $this->input->request_headers(); 
		if (isset($headers['Authorization'])) {
			$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
			if (!$decodedToken['status']) {
				$this->response(["status"=>false,"message"=>"Token tidak valid"], REST_Controller::HTTP_UNAUTHORIZED);
			}
			$cek_email = $this->User->select_by_id($decodedToken['data']->uid);
			if ($cek_email['statusAkun'] == "nonAktif") {
				$this->response(["status"=>false,"message"=>"User NonAktif"], REST_Controller::HTTP_UNAUTHORIZED);
			}
			$db2 = $this->load->database('api', TRUE);
			$db2->select('*');
			$db2->from('petani');
			if (isset($id)) {
				$db2->where(['nik' => $id]);
			}
			$query = $db2->get();
			$this->response($query->result());
		}
		else {
			$this->response(['Authentication failed'], REST_Controller::HTTP_OK);
		}
	}
	public function hapus_delete($id=null)
	{  
		$headers = $this->input->request_headers();
		if (isset($headers['Authorization'])) {
			$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
			if (!$decodedToken['status']) {
				$this->response(["status"=>false,"message"=>"Token tidak valid"], REST_Controller::HTTP_UNAUTHORIZED);
			}
			$cek_email = $this->User->select_by_id($decodedToken['data']->uid);
			if ($cek_email['statusAkun'] == "nonAktif") {
				$this->response(["status"=>false,"message"=>"User NonAktif"], REST_Controller::HTTP_UNAUTHORIZED);
			}
			if ($id != null) {
				$db2 = $this->load->database('api', TRUE);
				$delete=$db2->delete('petani', ['nik' => $id]);
				if ($delete) {
					$this->response(["status"=>true,"message"=>"Data Berhasil Di Hapus"], REST_Controller::HTTP_OK);
				}else{
					$this->response(["status"=>false,"message"=>"Data Gagal Di Hapus"], REST_Controller::HTTP_BAD_REQUEST);
				}
			}else{
				$this->response(["status"=>false,"message"=>"Data Gagal Di Hapus"], REST_Controller::HTTP_BAD_REQUEST);
			}
		}
		else {
			$this->response(['Authentication failed'], REST_Controller::HTTP_OK);
		}
	}
	public function update_post($id=null)
	{  
		if ($id== null) {
			$this->response(["status"=>false,"message"=>"Parameter Tidak Boleh Kosong"], REST_Controller::HTTP_BAD_REQUEST);
		}
		$headers = $this->input->request_headers();
		if (isset($headers['Authorization'])) {
			$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
			if (!$decodedToken['status']) {
				$this->response(["status"=>false,"message"=>"Token tidak valid"], REST_Controller::HTTP_UNAUTHORIZED);
			}
			$cek_email = $this->User->select_by_id($decodedToken['data']->uid);
			if ($cek_email['statusAkun'] == "nonAktif") {
				$this->response(["status"=>false,"message"=>"User NonAktif"], REST_Controller::HTTP_UNAUTHORIZED);
			}
			$db2 = $this->load->database('api', TRUE);
			$data = [
				
				"nama" =>$this->input->post("nama"),
				"jenis_kelamin" =>$this->input->post("jenis_kelamin"),
				"kelahiran" =>$this->input->post("kelahiran"),
				"tgl_lahir" =>$this->input->post("tgl_lahir"),
				"telp" =>$this->input->post("telp"),
				"nama_ibu" =>$this->input->post("nama_ibu"),
				"alamat" =>$this->input->post("alamat"),
				"id_dusun" =>$this->input->post("id_dusun"),
				"rt" =>$this->input->post("rt"),
				"rw" =>$this->input->post("rw"),
				"id_desa" =>$this->input->post("id_desa"),
				"tgl_buat" =>$this->input->post("tgl_buat"),
				"tgl_update" =>$this->input->post("tgl_update"),
				"id_buat" =>$this->input->post("id_buat"),
				"id_update" =>$this->input->post("id_update"),
			];
			$update=$db2->update('petani',$data, ['nik' => $id]);
			if ($update) {
				$this->response(["status"=>true,"message"=>"Data Berhasil Di Update"], REST_Controller::HTTP_OK);
			}else{
				$this->response(["status"=>false,"message"=>"Data Gagal Di Update"], REST_Controller::HTTP_BAD_REQUEST);
			}
		}
		else {
			$this->response(['Authentication failed'], REST_Controller::HTTP_OK);
		}
	}
	public function tambah_post()
	{  
		$headers = $this->input->request_headers();
		if (isset($headers['Authorization'])) {
			$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
			if (!$decodedToken['status']) {
				$this->response(["status"=>false,"message"=>"Token tidak valid"], REST_Controller::HTTP_UNAUTHORIZED);
			}
			$cek_email = $this->User->select_by_id($decodedToken['data']->uid);
			if ($cek_email['statusAkun'] == "nonAktif") {
				$this->response(["status"=>false,"message"=>"User NonAktif"], REST_Controller::HTTP_UNAUTHORIZED);
			}
			$db2 = $this->load->database('api', TRUE);
			$data = [
				"nik" =>$this->input->post("nik"),
				"nama" =>$this->input->post("nama"),
				"jenis_kelamin" =>$this->input->post("jenis_kelamin"),
				"kelahiran" =>$this->input->post("kelahiran"),
				"tgl_lahir" =>$this->input->post("tgl_lahir"),
				"telp" =>$this->input->post("telp"),
				"nama_ibu" =>$this->input->post("nama_ibu"),
				"alamat" =>$this->input->post("alamat"),
				"id_dusun" =>$this->input->post("id_dusun"),
				"rt" =>$this->input->post("rt"),
				"rw" =>$this->input->post("rw"),
				"id_desa" =>$this->input->post("id_desa"),
				"tgl_buat" =>$this->input->post("tgl_buat"),
				"tgl_update" =>$this->input->post("tgl_update"),
				"id_buat" =>$this->input->post("id_buat"),
				"id_update" =>$this->input->post("id_update"),
			];
			$insert=$db2->insert('petani',$data);
			if ($insert) {
				$this->response(["status"=>true,"message"=>"Data Berhasil Di Tambah"], REST_Controller::HTTP_OK);
			}else{
				$this->response(["status"=>false,"message"=>"Data Gagal Di Tambah"], REST_Controller::HTTP_BAD_REQUEST);
			}
		}
		else {
			$this->response(['Authentication failed'], REST_Controller::HTTP_OK);
		}
	}


 
}

