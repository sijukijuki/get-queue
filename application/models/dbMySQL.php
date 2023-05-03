<?php
/**
 * Created by PhpStorm.
 * User: dimas
 * Date: 25/10/2018
 * Time: 23:18
 */

class dbMySQL extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function savedata($table,$data)
    {
        if ($this->db->insert($table,$data)) {
            return TRUE;
        } else {
            return FALSE;
        }
        ;
    }
    public function readdata($table){
        return $this->db->get($table);
    }
    public function singlewhereData($table,$column,$id)
    {
        return $this->db->where($column,$id)->get($table)->row_array();
    }
    public function multiwhereData($table,$column,$id)
    {
        return $this->db->where($column,$id)->get($table)->result_array();
    }
    public function joinwheredata($table,$column,$id,$tablejoin,$pattern){
        return $this->db->join($tablejoin,$pattern)->where($column,$id)->get($table);
    }
    public function deleteData($table,$column,$id)
    {
        return $this->db->where($column,$id)->delete($table);
    }
    public function updateData($table,$column,$id,$data)
    {
        return $this->db->where($column,$id)->update($table,$data);
    }
    public function searchData($table,$column,$text)
    {
        return $this->db->like($column,$text)->get($table)->result_array();
    }
}