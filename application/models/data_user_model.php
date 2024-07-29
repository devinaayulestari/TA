<?php
defined('BASEPATH') or exit('No direct script access allowed');

class data_user_model extends CI_Model
{
    private $table= 'data_user';
    private $id= 'id';

    public function cek_admin($username)
    {
        return $this->db->get_where($this->table, ['username' => $username])->row_array();
    }
    public function get_user($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function lengkapi($data)
    {
        return $this->db->insert($this->table, $data);
    }
    public function select_by_id($id)
    {
        $this->db->select('*,data_user.id as data_id')
        ->from($this->table)
        ->join('user',"user.id=".$this->table.".id_user")
        ->where("data_user.id",$id);
        return $this->db->get()->row_array();
    }
    public function select_by_user($id)
    {
        $this->db->select('*,data_user.id as data_id')
        ->from($this->table)
        ->join('user',"user.id=".$this->table.".id_user")
        ->where("user.id",$id);
        return $this->db->get()->result_array();
    }
    public function select()
    {
        $this->db->select('*,data_user.id as data_id')
        ->from($this->table)
        ->join('user',"user.id=".$this->table.".id_user")
        ->order_by('data_user.id','DESC');
        return $this->db->get()->result_array();
    }
    public function update($data, $id)
    {
        return $this->db->update($this->table, $data, [$this->id => $id]);
    }
    public function hapus($id)
    {
        return $this->db->delete($this->table, [$this->id => $id]);
    }
}