<?php
defined('BASEPATH')OR exit("no access allowed directly");
/**
 * Created by PhpStorm.
 * User: dimas
 * Date: 17/08/2018
 * Time: 6:47
 */

class Manager extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("dbMySQL");
        $this->load->database();

        if(empty($_SESSION['nama']) && !isset($_SESSION['nama']))
        {
            redirect('login');
        }else{
            if ($_SESSION['tipe_user']=="Produksi" OR $_SESSION['tipe_user']=="Admin"){
                redirect(site_url("Manager"));
            }
        }
    }
    public function index()
    {
        $data['totalUser']=$this->db->get('user')->num_rows();
        $data['totalCustomer']=$this->db->get('customer')->num_rows();
        $data['totalOrder']=$this->db->get('customer_has_order')->num_rows();
        $data['totalCetak']=$this->db->select("sum(qty) as grandTotal")->get('customer_has_order')->row_array();
        $this->theme->theme_manager('beranda',$data);
    }
    public function report(){
        $data['tahun']=$this->db->query("SELECT tgl_selesai FROM laporan_produksi GROUP BY YEAR(tgl_selesai)")->result_array();
        $this->theme->theme_manager('report',$data);
    }
    public function historyReport(){
        $this->theme->theme_manager('historyReport');
    }
    /*******************************************User Setting***************************/
    public function usersetting(){
        $data['data']=$this->dbMySQL->singleWhereData('login_app','id',$_SESSION['id']);
        $this->load->view('page/usersetting',$data);
    }
    /*******************************************User Setting***************************/
}