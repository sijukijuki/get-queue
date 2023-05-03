<?php
defined('BASEPATH')OR exit("no access allowed directly");
/**
 * Created by PhpStorm.
 * User: dimas
 * Date: 17/08/2018
 * Time: 6:47
 */

class Produksi extends CI_Controller
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
            if ($_SESSION['tipe_user']=="Admin"){
                redirect(site_url("admin"));
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
        $data['antrian_cetak']=$this->db->join("customer_has_order","customer_has_order.id_customer=customer.id_customer")->get('customer')->result_array();
        $this->theme->theme_produksi('beranda',$data);
    }
    /*******************************************Customer***************************/
    public function customer()
    {
        $data['dataPelanggan']=$this->dbMySQL->readdata('Customer')->result_array();
        $this->theme->theme_produksi('customer',$data);
    }
    public function addCustomer(){
        $this->load->view('page/page_add_customer');
    }
    public function updateCustomer($id)
    {
        $data['customer']=$this->dbMySQL->singlewhereData("customer","id_customer",$id);
        $this->load->view("page/page_update_customer",$data);
    }
    public function deleteCustomer($id)
    {
        $data['data']=$this->dbMySQL->singlewhereData("customer","id_customer",$id);
        $this->load->view("page/page_delete_customer",$data);
    }
    /*******************************************Customer***************************/
    /*******************************************Users***************************/
    public function Users(){
        $this->theme->theme_produksi('users');
    }
    public function addUser(){
        $this->load->view('page/page_add_users');
    }
    public function deleteUser($id)
    {
        $data['data']=$this->dbMySQL->singlewhereData("login_app","id",$id);
        $this->load->view("page/page_delete_users",$data);
    }
    public function updateUser($id)
    {
        $data['data']=$this->dbMySQL->singlewhereData("login_app","id",$id);
        $this->load->view("page/page_update_users",$data);
    }
    /*******************************************Users***************************/
    /*******************************************Order***************************/
    public function order(){
        $this->theme->theme_produksi('order');
    }
    public function historyorder(){
        $this->theme->theme_produksi('HistoryOrder');
    }
    public function addOrder()
    {
        $data['nama_Sales']=$this->dbMySQL->readData('user')->result_array();
        $this->load->view('page/page_add_order',$data);
    }
    public function deleteOrder($id)
    {
        $data['query']=$this->dbMySQL->joinwheredata('customer_has_order','id_so',$id,'customer','customer.id_customer=customer_has_order.id_customer')->row_array();
        $this->load->view('page/page_delete_order',$data);
    }
    public function updateOrder($id)
    {
        $data['nama_Sales']=$this->dbMySQL->readData('user')->result_array();
        $data['query']=$this->dbMySQL->joinwheredata('customer_has_order','id_so',$id,'customer','customer.id_customer=customer_has_order.id_customer')->row_array();
        $this->load->view("page/page_update_order",$data);
    }
    /*******************************************Order***************************/
    /*******************************************Report***************************/
    public function report(){
        $data['tahun']=$this->db->query("SELECT tgl_selesai FROM laporan_produksi GROUP BY YEAR(tgl_selesai)")->result_array();
        $this->theme->theme_produksi('report',$data);
    }
    public function addReport(){
        $data['formatBahan']=$this->db->select("id_bahan, title")->get("bahan")->result_array();
        $this->load->view('page/page_add_report',$data);
    }
    public function updateReport($id){
        $data['query']=$this->getReport($id)->row_array();
        $data['formatBahan']=$this->db->select("id_bahan, title")->get("bahan")->result_array();
        $this->load->view('page/page_update_report',$data);
    }
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
    public function historyReport(){
        $this->theme->theme_produksi('historyReport');
    }
    /*******************************************Report***************************/
    /*******************************************Bahan***************************/
    public function bahan(){
        $data['query']=$this->dbMySQL->readData('bahan');
        $data['total']=$data['query']->num_rows();
        $this->theme->theme_produksi('bahan',$data);
    }
    public function addBahan(){
        $this->load->view('page/page_add_bahan');
    }
    public function deleteBahan($id)
    {
        $data['data']=$this->dbMySQL->singlewhereData("bahan","id_bahan",$id);
        $this->load->view("page/page_delete_bahan",$data);
    }
    public function updateBahan($id)
    {
        $data['query']=$this->dbMySQL->singlewhereData("bahan","id_bahan",$id);
        $this->load->view("page/page_update_bahan",$data);
    }
    /*******************************************Bahan***************************/
    /*******************************************Message***************************/
    public function message(){
        $this->theme->theme_produksi('Message');
    }
    public function detailMessage_produksi($id){
        $data['data']=$this->db->select('no_so, nama_Customer, laporan_has_status.Keterangan as Keterangan')->join('customer_has_order','customer_has_order.id_so=laporan_produksi.id_so')
            ->join('customer','customer.id_customer=customer_has_order.id_customer')
            ->join('laporan_has_status','laporan_has_status.id_laporan_has_status=laporan_produksi.id_laporan_produksi')
            ->where('id_laporan_produksi',$id)
            ->get('laporan_produksi')->row_array();
        $this->load->view('page/page_detailMessage_produksi',$data);
    }
    /*******************************************Message***************************/
    /*******************************************User Setting***************************/
    public function usersetting(){
        $data['data']=$this->dbMySQL->singleWhereData('login_app','id',$_SESSION['id']);
        $this->load->view('page/usersetting',$data);
    }
    /*******************************************User Setting***************************/
    /*******************************************Users***************************/
    public function sales(){
        $this->theme->theme_produksi('sales');
    }
    public function addsales(){
        $this->load->view('page/page_add_sales');
    }
    public function deleteSales($id)
    {
        $data['data']=$this->dbMySQL->singlewhereData("user","id_user",$id);
        $this->load->view("page/page_delete_sales",$data);
    }
    public function updateSales($id)
    {
        $data['data']=$this->dbMySQL->singlewhereData("user","id_user",$id);
        $this->load->view("page/page_update_sales",$data);
    }
    /*******************************************Users***************************/
    public function ads(){
        $data["ads"]=$this->dbMySQL->readData("ads")->result_array();
        $this->theme->theme_produksi('ads',$data);
    }
}