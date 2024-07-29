<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // if ($this->session->userdata('name')) {
        //     redirect('home');
        // }
        $this->load->model('auth_model', 'Auth');
    }

    public function login()
    {
        return $this->load->view('template/layout/login');
    }
    public function pendaftaran()
    {
        $data['title'] = 'Data User';
        // $data['user'] = $this->User->select();
        $data['content'] = 'user/pendaftaran';
        $this->load->view('template/layout/base', $data);
    }

    public function cek_login()
    {
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        $cekAdmin = $this->Auth->cek_admin($username);

        // Cek Apakah ada data admin
        if ($cekAdmin) {
            if (password_verify($password, $cekAdmin['password'])) {
                $sessionData = [
                    'name' => $cekAdmin['name'],
                    'id' => $cekAdmin['id'],
                    'role' => $cekAdmin['role']
                ]; 
                $this->session->set_userdata($sessionData);
                $this->session->set_flashdata('berhasil', 'Selamat Datang!');
                if($cekAdmin['role']=='superadmin'){
                    redirect('admin');
                }
                else if (!$cekAdmin['verifikasi'] ||$cekAdmin['Aktivasi']=='Ditinjau') {
                    redirect('home');
                }
                else{
                    redirect('home/pendaftaran');
                }
                
            } else {
                $this->session->set_flashdata('gagal', 'Password atau Username yang anda masukkan salah!');
                redirect('auth/login');
            }
        } {
            $this->session->set_flashdata('gagal', 'Username anda tidak terdaftar!');
            redirect('auth/login');
        }
    }

    public function register()
    {
        return $this->load->view('template/layout/register');
    }
    public function get_verif()
    {
        $data['email'] = "";
        return $this->load->view('template/layout/verifikasi',$data);
    }
    public function verif($email="")
    {
        $data['email'] = ($email != "") ? urldecode($email) : $this->input->get('email', true);
        // var_dump($data['email']);
        // die();
        $this->send_kode($data['email']);
        return $this->load->view('template/layout/verifikasi',$data);
    }
    public function send_kode($emaill) {
        // ini_set("smtp","mail.devinaayulestari1.my.id");

        // ini_set("smtp_port","465");
        $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = substr(str_shuffle($set), 0, 12);
        $data = [
            "verifikasi_kode" => $code,
            "exp_kode" => date('Y-m-d H:i:s', strtotime(' +5 minutes ')),
        ];
        $cek_email=$this->Auth->cek_email($emaill);
        if ($cek_email['exp_kode'] > date('Y-m-d H:i:s')) return;
        $this->Auth->update($data,$cek_email['id']);
        
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.devinaayulestari1.my.id',
            'smtp_port' => 465,
            'smtp_user' => 'verifikasi_akun@devinaayulestari1.my.id',
            'smtp_pass' => 'Devina12*',
            'crlf' => "\r\n",
            'newline' => "\r\n",
            'mailtype' => 'html',
            'smtp_crypto' => 'ssl',
            'wordwrap' => TRUE
        );
        $message = 	"
                    <html>
                    <head>
                        <title>Verification Code</title>
                    </head>
                    <body>
                        <h2>Thank you for Registering.</h2>
                        <p>Your Account:</p>
                        <p>Email: ".$emaill."</p>
                        <p>kode verifikasi: ".$code."</p>
                        
                    </body>
                    </html>
                    ";

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($config['smtp_user']);
        $this->email->to($emaill);
        $this->email->subject('Signup Verification Email');
        $this->email->message($message);
        $this->email->send();
    }
    public function isregister()
    {   
        $email=$this->input->post('email', true);
        $username=$this->input->post('username', true);
        $cekuser = $this->Auth->cek_admin($username);

        // Cek Apakah ada data admin
        if ($cekuser) {
            $this->session->set_flashdata('gagal', 'Username Sudah Digunakan!');
            redirect('Auth/register');
        }
        $cekemail = $this->Auth->cek_email($email);

        // Cek Apakah ada data admin
        if ($cekemail) {
            $this->session->set_flashdata('gagal', 'Email Sudah Digunakan!');
            redirect('Auth/register');
        }
        if ($this->input->post('repassword', true)!=$this->input->post('password', true)) {
            $this->session->set_flashdata('gagal', ' Password Tidak Sama!');
            redirect('Auth/register');
        }
        // enkripsi password 
        // enkripsi password 
        // enkripsi password 
        // enkripsi password 
        $password = password_hash($this->input->post('password', true), PASSWORD_DEFAULT);
        
        $data = [
            "email" => $email,
            "username" => $username,
            "password" => $password,
        ];
        // enkripsi password 
        // enkripsi password 
        // enkripsi password 
        // enkripsi password 

        $create = $this->Auth->isregister($data);
			//insert user to users table and get i
			//set up email
			// $config = array(
		  	// 	'protocol' => 'smtp',
		  	// 	'smtp_host' => 'smtp.gmail.com',
		  	// 	'smtp_port' => 587,
		  	// 	'smtp_user' => 'devinaayulestari1@gmail.com', // change it to yours
		  	// 	'smtp_pass' => 'devinaal', // change it to yours
		  	// 	'mailtype' => 'html',
		  	// 	'wordwrap' => TRUE
			// );
            
		    //sending email
		if($create){
		$this->session->set_flashdata('berhasil','Activation code sent to email');
		}
		else {
		    	// var_dump($this->email->print_debugger());
                // die();
                $this->session->set_flashdata('message', $this->email->print_debugger());
		}
        redirect('Auth/verif/'.urlencode($email));
        // Cek Apakah berhasil atau tidak
        if ($create) {
            $this->session->set_flashdata('berhasil', 'Data berhasil ditambahkan!');
            redirect('home/pendaftaran');
        }

        $this->session->set_flashdata('gagal', 'Data gagal ditambahkan!');
        redirect('Auth/register');
    
    }

    public function is_verif()
    {
        $email = $this->input->get('email', true);
        $password = $this->input->get('kode', true);

        $cekAdmin = $this->Auth->cek_email($email);

        // Cek Apakah ada data admin
        if ($cekAdmin) {
            if ($password == $cekAdmin['verifikasi_kode']) {
                $data = [
                    "verifikasi" => true,
                ];
                $create = $this->Auth->update($data,$cekAdmin['id']);
                $sessionData = [
                    'name' => $cekAdmin['name'],
                    'id' => $cekAdmin['id'],
                    'role' => $cekAdmin['role']
                ]; 
                $this->session->set_userdata($sessionData);
                $this->session->set_flashdata('berhasil', 'Selamat Datang!');
                redirect('home/pendaftaran');
                
            } else {
                $this->session->set_flashdata('gagal', 'kode Verivikasi anda masukkan salah!');
                redirect('Auth/verif/'.urlencode($email));
            }
        } {
            $this->session->set_flashdata('gagal', 'Email anda tidak terdaftar!');
            redirect('auth/register');
        }
    }
    public function reset_Pass() {
        return $this->load->view('template/layout/reset/index');
    }
    public function isResetPass() {
        $email = $this->input->post('email', true);
        $cek_email=$this->Auth->cek_email($email);
        if (empty($cek_email)) {
            $this->session->set_flashdata('gagal', 'Email anda tidak terdaftar!');
            redirect('auth/reset_Pass');
        }
        // if ($cek_email['exp_reset'] > date('Y-m-d H:i:s')){
        //     $this->session->set_flashdata('succes', 'Silahkan Cek Email yang terdaftar!');
        //     redirect('auth/reset_Pass');
        // }
        $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = substr(str_shuffle($set), 0, 20);
        $data = [
            "reset_pass" => $code,
            "exp_reset" => date('Y-m-d H:i:s', strtotime(' +5 minutes ')),
        ];
        $this->Auth->update($data,$cek_email['id']);
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.devinaayulestari1.my.id',
            'smtp_port' => 465,
            'smtp_user' => 'verifikasi_akun@devinaayulestari1.my.id',
            'smtp_pass' => 'Devina12*',
            'crlf' => "\r\n",
            'newline' => "\r\n",
            'mailtype' => 'html',
            'smtp_crypto' => 'ssl',
            'wordwrap' => TRUE
        );
        $message = 	"
                    <html>
                    <head>
                        <title>Reset Password</title>
                    </head>
                    <body>
                        <p>Your Account:</p>
                        <p>Email: ".$cek_email['email']."</p>
                        <p>Link Reset: <a href='".base_url('auth/resetPass/').$code."'>Klik Disini</a></p>
                        
                    </body>
                    </html>
                    ";
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($config['smtp_user']);
        $this->email->to($cek_email['email']);
        $this->email->subject('Reset Password Account');
        $this->email->message($message);
        $this->email->send();
        $this->session->set_flashdata('succes', 'Silahkan Cek Email yang terdaftar!');
        redirect('auth/reset_Pass');
    }
    public function resetPass($code){
        $cek_email=$this->Auth->cek_reset($code);
        if (empty($cek_email)) {
            $this->session->set_flashdata('gagal', 'Email anda tidak terdaftar!');
            redirect('auth/reset_Pass');
        }
        if ($cek_email['reset_pass'] && $cek_email['exp_reset'] < date('Y-m-d H:i:s')){
            $this->session->set_flashdata('gagal', 'Kode Expired!');
            redirect('auth/reset_Pass');
        }
        $data['akun']= $cek_email;
        return $this->load->view('template/layout/reset/reset',$data);
    }
    public function newPass(){
        $code = $this->input->post('kode', true);
        $cek_email=$this->Auth->cek_reset($code);
        if (empty($cek_email)) {
            $this->session->set_flashdata('gagal', 'Kode Expired!');
            redirect('auth/reset_Pass');
        }
        $password = password_hash($this->input->post('password', true), PASSWORD_DEFAULT);
        $data = [
            "password" => $password,
        ];
        $this->Auth->update($data,$cek_email['id']);
        redirect('auth/login');

    }

}

/* End of file Auth.php and path \application\controllers\Auth.php */
