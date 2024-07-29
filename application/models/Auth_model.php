<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    private $table_admin = 'user';
    private $id= 'id';

    public function cek_admin($username)
    {
        return $this->db->get_where($this->table_admin, ['username' => $username])->row_array();
    }
    public function get_user()
    {
        return $this->db->get($this->table_admin)->result();
    }

    public function isregister($data)
    {
        return $this->db->insert($this->table_admin, $data);
    }
    public function update($data,$id)
    {
        return $this->db->update($this->table_admin, $data, [$this->id => $id]);
    }

    public function cek_email($email)
    {
        return $this->db->get_where($this->table_admin, ['email' => $email])->row_array();
    }

    public function cek_reset($kode)
    {
        return $this->db->get_where($this->table_admin, ['reset_pass' => $kode])->row_array();
    }
    public function cek_user($id)
    {
        return $this->db->get_where($this->table_admin, [$this->id => $id])->row_array();
    }
    
}



/* End of file Auth_model.php and path \application\models\Auth_model.php */
