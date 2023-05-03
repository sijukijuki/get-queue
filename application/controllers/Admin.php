<?php
defined('BASEPATH')OR exit("no access allowed directly");
/**
 * Created by PhpStorm.
 * User: dimas
 * Date: 17/08/2018
 * Time: 6:47
 */

class Admin extends CI_Controller
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
            if ($_SESSION['tipe_user']=="Produksi"){
                redirect(site_url("Produksi"));
            }elseif ($_SESSION['tipe_user']=="Manager") {
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
        $this->theme->theme_admin('beranda',$data);
    }
    public function report(){
        $data['tahun']=$this->db->query("SELECT tgl_selesai FROM laporan_produksi GROUP BY YEAR(tgl_selesai)")->result_array();
        $this->theme->theme_admin('report',$data);
    }
    /*public function detailReport($id){
        $data['query']=$this->getReport($id)->row_array();
        $getId=$this->db->where('id_laporan_bahan',$id)->get('laporan_bahan')->row_array();
        $data['bahan']=$this->db->where('id_bahan',$getId['id_bahan'])->get('bahan')->row_array();
        $this->load->view('page/page_detail_report',$data);
    }*/
    private function getReport($id){
        $this->db->select('*');
        $this->db->from('laporan_produksi');
        $this->db->join('customer_has_order','customer_has_order.id_so=laporan_produksi.id_so');
        $this->db->join('customer','customer.id_customer=customer_has_order.id_customer');
        $this->db->join('laporan_bahan','laporan_bahan.id_so=customer_has_order.id_so');
        $this->db->join('bahan','bahan.id_bahan=laporan_bahan.id_bahan');
        $this->db->join('laporan_has_status','laporan_has_status.id_so=customer_has_order.id_so');
        $this->db->join('user','user.id_user=customer_has_order.id_user');
        $this->db->where("id_laporan_produksi",$id);
        return $this->db->get();
    }
    public function message(){
        $this->theme->theme_admin('getMessage_admin');
    }
    public function detailMessage($id){
        //BUG DETAIL MESSAGE// $id->pakai id_SO
        $check=$this->db->select('id_laporan_has_status,status_report')->where('id_laporan_has_status',$id)->get("laporan_has_status")->row_array();
        if ($check['status_report']=='acc' || $check['status_report']=='revision') {
            redirect("admin/message");
        }
        $data['query']=$this->getReport($id)->row_array();
        $getId=$this->db->where('id_laporan_bahan',$id)->get('laporan_bahan')->row_array();
        $data['bahan']=$this->db->where('id_bahan',$getId['id_bahan'])->get('bahan')->row_array();
        $this->theme->theme_admin('page_detail_message',$data);
    }
    public function revision($id){
        $data['data']=$this->db->join('customer_has_order','customer_has_order.id_so=laporan_produksi.id_so')
        ->join('customer','customer.id_customer=customer_has_order.id_customer')
        ->where('id_laporan_produksi',$id)
        ->get('laporan_produksi')->row_array();
        $this->load->view('page/page_revision',$data);
    }
    public function acc($id){
        $data['data']=$this->db->join('customer_has_order','customer_has_order.id_so=laporan_produksi.id_so')
            ->join('customer','customer.id_customer=customer_has_order.id_customer')
            ->where('id_laporan_produksi',$id)
            ->get('laporan_produksi')->row_array();
        $this->load->view('page/page_acc',$data);
    }
    public function historyReport(){
        $this->theme->theme_admin('historyReport');
    }
    /*******************************************User Setting***************************/
    public function usersetting(){
        $data['data']=$this->dbMySQL->singleWhereData('login_app','id',$_SESSION['id']);
        $this->load->view('page/usersetting',$data);
    }
    /*******************************************User Setting***************************/
}