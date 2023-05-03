<?php
/**
 * Created by PhpStorm.
 * User: dimas
 * Date: 26/10/2018
 * Time: 1:01
 */

class Serverside extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("dbMySQL");
        $this->load->helper(array("ownHelper","cookie","file"));
        if (empty($_SESSION['nama']) or !isset($_SESSION['nama'])){
            redirect('login');
        }
    }
    /*******************************************Customer***************************/
    public function jsonCustomer()
    {
        $this->datatables->select('id_customer, nama_Customer')->from('customer');
        $this->datatables->add_column("action","<div class='btn-group btn-group-sm'><a class='btn btn-warning btn-sm' id='buttonModal' href=\"updatecustomer/$1\" id=''><i class='fa fa-pencil-alt text-white'></i></a><a class='btn btn-danger btn-sm' id='buttonModal' href=\"deletecustomer/$1\" id=''><i class='fa fa-trash-alt text-white'></i></a></div>","id_customer");
        print_r($this->datatables->generate());
    }
    public function addCustomer(){
        $setConfig=array("upload_path"=>"./asset/images/desain_customer/","max_height"=>639,"max_width"=>1017,"encrypt_name"=>TRUE);
        if ($this->do_Upload($_FILES['desain_depan']['name'],'desain_depan',$setConfig,"produksi/customer")){
            $jpeg=$this->upload->data();
            $data['desain_depan']=$jpeg['file_name'];
            $data['nama_Customer']=$this->input->post("nama_customer",TRUE);
            if ($this->dbMySQL->savedata('Customer',$data)){
                redirect(site_url('produksi/customer'));
            }
        }
    }
    public function do_Upload($file,$fileupload,$set,$link="produksi"){
        $config['upload_path']=$set['upload_path'];
        $config['allowed_types']="png|jpg|jpeg";
        $config['overwrite']=TRUE;
        $config['max_height']=$set['max_height'];
        $config['max_width']=$set['max_width'];
        $config['encrypt_name']=TRUE;
        //$config['file_name']=$file;
        if (isset($file)){
            $this->upload->initialize($config);
            if($this->upload->do_upload($fileupload)){
                return TRUE;
            }else{
                echo $this->upload->display_errors();
                echo "<a href='".site_url($link)."'>Kembali</a>";
            }
        }else{
            return FALSE;
        }
    }
    public function deleteCustomer($id){
        $this->response($this->dbMySQL->deleteData('customer','id_customer',$id));
    }
    public function updateCustomer(){
        $id=$this->input->post("id_customer",TRUE);
        if (isset($_FILES['desain_depan']['name']) && !empty($_FILES['desain_depan']['name'])) {
            $setConfig=array("upload_path"=>"./asset/images/desain_customer/","max_height"=>153,"max_width"=>244);
            if ($this->do_Upload($_FILES['desain_depan']['name'],'desain_depan',$setConfig,"produksi/customer"))
            {
                $jpeg=$this->upload->data();
                $data['desain_depan']=$jpeg['file_name'];
            }
        }
        $data['nama_Customer']=$this->input->post("nama_customer",TRUE);
        if($this->dbMySQL->updateData('customer','id_customer',$id,$data)){
            redirect(site_url('produksi/customer'));
        }
    }
    /*******************************************Customer***************************/
    /*******************************************Users***************************/
    public function addUser()
    {
        if (!empty($_FILES['tanda_tangan']['name']) && isset($_FILES['tanda_tangan']['name'])) {
            $setConfig=array("upload_path"=>"./asset/images/ttd/","max_height"=>85,"max_width"=>85,"encrypt_name"=>TRUE);
            if ($this->do_Upload($_FILES['tanda_tangan']['name'],'tanda_tangan',$setConfig)){
                $jpeg=$this->upload->data();
                $data['ttd']=$jpeg['file_name'];
            }
        }
        $data['nama']=$this->input->post('nama',TRUE);
        $data['username']=$this->input->post('username',TRUE);
        $data['password']=password_hash($this->input->post('password',TRUE),PASSWORD_DEFAULT);
        $data['tipe_user']=$this->input->post('tipe_user',TRUE);
        $data['status']=$this->input->post('status',TRUE);
        if ($this->dbMySQL->savedata('login_app',$data)){
            redirect(site_url('produksi/users'));
        }
    }
    public function jsonUser()
    {
        $this->datatables->select('id,nama,username,tipe_user,status')->from('login_app');
        $this->datatables->add_column("action","<div class='btn-group btn-group-sm'><a class='btn btn-warning btn-sm' id='buttonModal' href=\"updateuser/$1\" id=''><i class='fa fa-pencil-alt text-white'></i></a><a class='btn btn-danger btn-sm' id='buttonModal' href=\"deleteuser/$1\" id=''><i class='fa fa-trash-alt text-white'></i></a></div>","id");
        print_r($this->datatables->generate());
    }
    public function deleteuser($id){
        $this->response($this->dbMySQL->deleteData('login_app','id',$id));
    }
    public function updateUser()
    {
        $id=$this->input->post("id",TRUE);
        if (!empty($_FILES['tanda_tangan']['name']) && isset($_FILES['tanda_tangan']['name'])) {
            $setConfig=array("upload_path"=>"./asset/images/ttd/","max_height"=>85,"max_width"=>85);
            if ($this->do_Upload($_FILES['tanda_tangan']['name'],'tanda_tangan',$setConfig)){
                $jpeg=$this->upload->data();
                $data['ttd']=$jpeg['file_name'];
            }
        }
        $data['nama']=$this->input->post('nama',TRUE);
        $data['username']=$this->input->post('username',TRUE);
        $data['tipe_user']=$this->input->post('tipe_user',TRUE);
        $data['status']=$this->input->post('status',TRUE);
        if ($this->dbMySQL->updateData('login_app','id',$id,$data)){
            redirect(site_url('produksi/users'));
        }
    }
    /*******************************************Users***************************/
    /*******************************************Order***************************/
    public function addOrder()
    {
        $this->response($this->dbMySQL->savedata('customer_has_order',$this->allInputOrder()));
    }
    public function jsonSearchCustomer(){
        $search=$this->input->post('search',TRUE);
        $no=0;
        $query=$this->dbMySQL->searchData("customer","nama_Customer",$search);
        foreach ($query as $data)
        {
            $valueArray[$no]=array("id"=>$data['id_customer'],"text"=>$data['nama_Customer']);
            $no++;
        }
        $allArray=array("results"=>$valueArray);
        echo json_encode($allArray);
    }
    public function jsonOrder(){
        $this->datatables->select('id_so,no_so,customer.nama_Customer as nama_customer,qty,tgl,customer_has_order.status as status,user.nama as nama');
        $this->datatables->from('customer_has_order');
        $this->datatables->join('user','user.id_user=customer_has_order.id_user');
        $this->datatables->join('customer','customer.id_customer=customer_has_order.id_customer');
        $this->datatables->add_column("action","<div class='btn-group btn-group-sm'><a class='btn btn-warning btn-sm' id='buttonModal' href=\"updateorder/$1\" id=''><i class='fa fa-pencil-alt text-white'></i></a></div>","id_so");
        $this->datatables->where('customer_has_order.status !=','reported');
        print_r($this->datatables->generate());
    }
    public function jsonHistoryOrder(){
        $this->datatables->select('id_so,no_so,customer.nama_Customer as nama_customer,qty,tgl,customer_has_order.status as status,user.nama as nama');
        $this->datatables->from('customer_has_order');
        $this->datatables->join('user','user.id_user=customer_has_order.id_user');
        $this->datatables->join('customer','customer.id_customer=customer_has_order.id_customer');
        $this->datatables->add_column("action","<div class='btn-group btn-group-sm'><a class='btn btn-warning btn-sm' id='buttonModal' href=\"updateorder/$1\" id=''><i class='fa fa-pencil-alt text-white'></i></a></div>","id_so");
        $this->datatables->where('customer_has_order.status','reported');
        print_r($this->datatables->generate());
    }
    public function deleteOrder($id)
    {
        $this->response($this->dbMySQL->deleteData('customer_has_order','id_so',$id));
    }
    public function updateOrder(){
        $id=$this->input->post('id',TRUE);
        $this->response($this->dbMySQL->updateData('customer_has_order','id_so',$id,$this->allInputOrder()));
    }
    private function allInputOrder()
    {
        $data['no_so']=strtoupper($this->input->post('no_so',TRUE));
        $data['id_customer']=$this->input->post('id_customer',TRUE);
        $data['tgl']=localtoServerDate($this->input->post('tgl',TRUE));
        $data['id_user']=$this->input->post('id_sales',TRUE);
        $data['qty']=$this->input->post('qty',TRUE);
        $data['status']=$this->input->post('status',TRUE);
        $data['keterangan_order']=$this->input->post('keterangan_order',TRUE);
        $data['Keterangan']=$this->input->post('keterangan',TRUE);
        return $data;
    }
    /*******************************************Order***************************/
    /*******************************************Report***************************/
    public function jsonsearchOrder(){
        $search=$this->input->post('search',TRUE);
        $no=0;
        $query=$this->db->query("SELECT id_so,no_so,qty, customer.nama_Customer as nama_customer FROM customer_has_order JOIN customer ON customer.id_customer=customer_has_order.id_customer WHERE no_so LIKE '%$search%' /*OR customer.nama_Customer LIKE '%$search%'*/ AND customer_has_order.status != 'Reported'; ")->result_array();
        foreach ($query as $data)
        {
            $valueArray[$no]=array("id"=>$data['id_so'],"text"=>$data['no_so']." - ".$data['nama_customer']." - ".$data['qty']." Pcs");
            $no++;
        }
        $allArray=array("results"=>$valueArray);
        echo json_encode($allArray);
    }
    public function addReport()
    {
        $id=$this->input->post('id_so',TRUE);
        $this->db->query('START TRANSACTION');
        $db1=$this->dbMySQL->savedata('laporan_produksi',$this->allInputLapProduksi());
        $db2=$this->dbMySQL->savedata('laporan_bahan',$this->allInputLapBahan());
        $db3=$this->dbMySQL->savedata('laporan_has_status',$this->setStatus('new'));
        $db4=$this->dbMySQL->updateData('customer_has_order','id_so',$id,array('status'=>'Reported'));
        if ($db1 && $db2 && $db3 && $db4) {
            $this->db->query('COMMIT');
            $this->response();
        } else {
            $this->db->query('ROLLBACK');
            echo json_encode('Failed');
        }
    }
    public function updateReport()
    {
        $id=$this->input->post('id_so',TRUE);
        $this->db->query('START TRANSACTION');
        $db1=$this->dbMySQL->updateData('laporan_produksi','id_so',$id,$this->allInputLapProduksi());
        $db2=$this->dbMySQL->updateData('laporan_bahan','id_so',$id,$this->allInputLapBahan());
        $db3=$this->dbMySQL->updateData('laporan_has_status','id_so',$id,$this->setStatus('updated'));
        if ($db1 && $db2 && $db3) {
            $this->db->query('COMMIT');
            $this->response();
        } else {
            $this->db->query('ROLLBACK');
            echo json_encode('Failed');
        }
    }
    private function allInputLapProduksi(){
        $data['id_so']=$this->input->post('id_so',TRUE);
        $data['tgl_cetak']=serverDate($this->input->post('tgl_cetak',TRUE));
        $data['tgl_selesai']=serverDate($this->input->post('tgl_selesai',TRUE));
        $data['jml_kerusakan']=$this->input->post('jml_kerusakan',TRUE);
        $data['jml_kelebihan']=$this->input->post('jml_kelebihan',TRUE);
        $data['jml_ambil_gudang']=$this->input->post('jml_ambil_gudang',TRUE);
        $data['keterangan_rusak']=$this->input->post('keterangan',TRUE);
        return $data;
    }
    private function allInputLapBahan()
    {

        $data['id_so']=$this->input->post('id_so',TRUE);
        $data['id_bahan']=$this->input->post('id_bahan',TRUE);
        $data['jml_pvc_print']=$this->input->post('jml_pvc_print',TRUE);
        $data['jml_pvc_tengah']=$this->input->post('jml_pvc_tengah',TRUE);
        $data['jml_magnetic']=$this->input->post('jml_magnetic',TRUE);
        $data['jml_overlay']=$this->input->post('jml_overlay',TRUE);
        return $data;
    }
    private function setStatus($status)
    {
        $data['id_so']=$this->input->post('id_so',TRUE);
        $data['status_report']=$status;
        $data['pembuat']=$_SESSION['id'];
        return $data;
    }
    public function jsonHistoryReport(){
        $this->datatables->select('id_laporan_produksi,no_so,nama_Customer,qty,nama,tgl_selesai,status_report');
        $this->datatables->from('laporan_produksi');
        $this->datatables->join('laporan_has_status','laporan_has_status.id_laporan_has_status=laporan_produksi.id_laporan_produksi');
        $this->datatables->join('customer_has_order','customer_has_order.id_so=laporan_produksi.id_so');
        $this->datatables->join('customer','customer.id_customer=customer_has_order.id_customer');
        $this->datatables->join('user','user.id_user=customer_has_order.id_user');
        $this->datatables->add_column("action","<a class='btn btn-primary btn-sm' id='buttonModal' href=\"../serverside/detailReport/$1\"><i class='fa fa-eye text-white'></i></a>","id_laporan_produksi");
        //$this->datatables->where('laporan_has_status.status_report =','acc');
        print_r($this->datatables->generate());
    }
    public function detailReport($id){
        $data['query']=$this->getReportTable($id)->row_array();
        $this->load->view('page/page_detail_report',$data);
    }
    private function getReportTable($id){
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
    public function getReport(){
        $bulan=$this->input->post('bulan',TRUE);
        $tahun=$this->input->post('tahun',TRUE);
        $cookie=array(
            "name"=>"bulan_selesai",
            "value"=>"$tahun-$bulan",
            "expire"=>"3600",
            "path"=>"/"
        );
        $this->input->set_cookie($cookie);
        if ($_COOKIE['bulan_selesai']!=null) {
            $response="Success";
        }
        else{
            $response="Failed";
        }
        echo json_encode($response);
    }
    public function loadDataTable(){
        $data['query']=$this->getLoadDataTable()->result_array();
        $this->load->view('page/loadDataTable',$data);
    }
    private function getLoadDataTable(){
        $this->db->select('id_laporan_produksi,customer_has_order.id_so as id_so, customer.nama_Customer as nama_customer, qty, jml_kerusakan, jml_kelebihan,status_report');
        $data=$this->db->join('customer_has_order','customer_has_order.id_so=laporan_produksi.id_so')
        ->join('customer','customer_has_order.id_customer=customer.id_customer')
        ->join('laporan_has_status','laporan_has_status.id_laporan_has_status=laporan_produksi.id_laporan_produksi')
        ->like('tgl_selesai',$_COOKIE['bulan_selesai'])
        ->where('customer_has_order.status','reported')
        ->get('laporan_produksi');
        return $data;
    }
    /*******************************************Bahan***************************/
    public function addBahan(){
        $this->response($this->dbMySQL->saveData('bahan',$this->allInputBahan()));
    }
    public function deleteBahan($id)
    {
        $this->response($this->dbMySQL->deleteData('bahan','id_bahan',$id));
    }
    public function updateBahan(){
        $id=$this->input->post('id',TRUE);
        $this->response($this->dbMySQL->updateData('bahan','id_bahan',$id,$this->allInputBahan()));
    }
    private function allInputBahan()
    {
        $data['title']=$this->input->post('title',TRUE);
        $data['pvc_print']=$this->input->post('pvc_print',TRUE);
        $data['pvc_tengah']=$this->input->post('pvc_tengah',TRUE);
        $data['magnetic']=$this->input->post('magnetic',TRUE);
        return $data;
    }
    /*******************************************Bahan***************************/
    /*******************************************Message***************************/
    public function getStatus_admin(){
        $where=array("new","updated");
        $data=$this->db->where_in('status_report',$where)->get('laporan_has_status')->num_rows();
        echo $data;
    }
    public function getStatus_produksi(){
        $where=array("revision");
        $data=$this->db->where_in('status_report',$where)->where('laporan_has_status.pembuat',$_SESSION['id'])->get('laporan_has_status')->num_rows();
        echo $data;
    }
    public function jsongetMessage_admin(){
        $arrayStatus=array("new","updated");
        $this->datatables->select('id_laporan_produksi,customer_has_order.id_so as id_so, no_so, customer.nama_Customer as nama_customer, qty,status_report,t2.nama as nama')
        ->from('laporan_produksi')
        ->join('customer_has_order','customer_has_order.id_so=laporan_produksi.id_so')
        ->join('customer','customer_has_order.id_customer=customer.id_customer')
        ->join('laporan_has_status','laporan_has_status.id_laporan_has_status=laporan_produksi.id_laporan_produksi')
        ->join('user as t2','t2.id_user=customer_has_order.id_user')
        ->add_column("action","<a href=".site_url('admin/detailMessage/$1')." class='btn btn-primary btn-sm'><i class='fa fa-eye'></i></a>","id_laporan_produksi")
        ->where_in('laporan_has_status.status_report',$arrayStatus);
        print_r($this->datatables->generate());
    }
    public function getMessage_produksi(){
        $this->db->select('id_laporan_produksi,customer_has_order.id_so as id_so, no_so, customer.nama_Customer as nama_customer, qty,status_report,nama');
        $data['query']=$this->db->join('customer_has_order','customer_has_order.id_so=laporan_produksi.id_so')
        ->join('customer','customer_has_order.id_customer=customer.id_customer')
        ->join('laporan_has_status','laporan_has_status.id_laporan_has_status=laporan_produksi.id_laporan_produksi')
        ->join('user','user.id_user=customer_has_order.id_user')
        ->where('laporan_has_status.status_report','revision')
            ->where('laporan_has_status.pembuat',$_SESSION['id'])
        ->get('laporan_produksi')->result_array();
        $this->load->view('page/getMessage_produksi',$data);
    }
    public function revision(){
        $id=$this->input->post('id_laporan_has_status',TRUE);
        $data['Keterangan']=$this->input->post('keterangan',TRUE);
        $data['status_report']='revision';
        $this->response($this->dbMySQL->updateData("laporan_has_status","id_laporan_has_status",$id,$data));
    }
    public function acc($id){
        $data['status_report']='acc';
        $data['penyetuju']=$_SESSION['id_user'];
        if ($this->dbMySQL->updateData("laporan_has_status","id_laporan_has_status",$id,$data)){
            echo redirect('reportcetak/print/'.$id);
        }else{
            echo redirect('admin/message/');
        }
    }
    public function usersetting(){
        if (!empty($this->input->post('password'))){
            $data['password']=password_hash($this->input->post('password'));
        }
        $id=$this->input->post('id',TRUE);
        $data['nama']=$this->input->post('nama',TRUE);
        $data['username']=$this->input->post('username',TRUE);
        if ($this->dbMySQL->updateData('login_app','id',$id,$data)){
            $_SESSION['nama']=$data['nama'];
            $_SESSION['username']=$data['username'];
            $this->response();
        }
    }  /*******************************************Sales***************************/
    public function addSales()
    {
        $data['nama']=$this->input->post('sales_name',TRUE);
        $this->response($this->dbMySQL->savedata('user',$data));
    }
    public function jsonSales()
    {
        $this->datatables->select('id_user,nama')->from('user');
        $this->datatables->add_column("action","<div class='btn-group btn-group-sm'><a class='btn btn-warning btn-sm' id='buttonModal' href=\"updatesales/$1\" id=''><i class='fa fa-pencil-alt text-white'></i></a></div>","id_user");
        print_r($this->datatables->generate());
    }
    public function updateSales()
    {
        $id=$this->input->post("id_sales",TRUE);
        $data['nama']=$this->input->post('sales_name',TRUE);
        $this->response($this->dbMySQL->updateData('user','id_user',$id,$data));
    }
    public function ads()
    {
        if (!empty($_FILES['ads']['name']) && isset($_FILES['ads']['name'])) {
            $setConfig=array("upload_path"=>"./asset/images/desain_banner/","max_height"=>192,"max_width"=>425,"encrypt_name"=>TRUE,"allowed_types"=>"gif|jpg|png");
            if ($this->do_Upload($_FILES['ads']['name'],'ads',$setConfig)){
                $jpeg=$this->upload->data();
                $data['ads']=$jpeg['file_name'];
                if ($this->dbMySQL->savedata('ads',$data)){
                    redirect(site_url('produksi/ads'));
                }
            }
        }
    }
    public function deleteAds($id)
    {

        $getAds=$this->dbMySQL->singleWhereData("ads","id_ads",$id);
        if ($this->dbMySQL->deleteData("ads","id_ads",$id))
        {
            $url="./asset/images/desain_banner/".$getAds['ads'];
            unlink($url);
        }
        redirect(site_url('produksi/ads'));
    }
    /*******************************************Sales***************************/
    /*******************************************Message***************************/
    public function response($sql=null){
        if ($sql || empty($sql)){
            $response="Success";
        }
        else{
            $response="Failed";
        }
        echo json_encode($response);
    }
}