<?php
defined('BASEPATH')OR exit("no access allowed directly");
/**
 * Created by PhpStorm.
 * User: dimas
 * Date: 17/08/2018
 * Time: 6:47
 */

class Utama extends CI_Controller
{
	public function __construct(){
		parent::__construct();
	}
    public function index()
    {
    	$data['query']=$this->db->Select('desain_depan,no_so,nama_Customer,qty,tgl,status,Keterangan,keterangan_order')->join('customer','customer.id_customer=customer_has_order.id_customer')->where('customer_has_order.status !=','Reported')->order_by('tgl','ASC')->order_by('no_so','ASC')->get('customer_has_order')->result_array();
        $this->load->view("index",$data);
    }
    public function getAds()
    {
        $setJson=array();
        $query=$this->db->select("*")->get("ads");
        if ($query->num_rows()>0){
            $data["status"]="true";
            foreach ($query->result_array() as $ad){
                $ads["id"]=$ad["id_ads"];
                $ads["link"]=$ad["ads"];
                array_push($setJson,$ads);
            }
            $data["value"]=$setJson;
        }else{
            $data["status"]="false";

        }
        echo json_encode($data);
    }
    public function getTable()
    {
        $setJson=array();
        $query=$this->db->select("no_so,nama_Customer,tgl,status,desain_depan,qty,keterangan_order")->join("customer","customer.id_customer=customer_has_order.id_customer")->where("customer_has_order.status !=","Reported")->get("customer_has_order");
        if ($query->num_rows()>0){
            $data["status"]="true";
            foreach ($query->result_array() as $table){
                $tables["no_so"]=$table["no_so"];
                $tables["nama_Customer"]=$table["nama_Customer"];
                $tables["tgl"]=onlyDate($table["tgl"]);
                $tables["status"]=$table["status"];
                $tables["qty"]=$table["qty"];
                $tables["keterangan_order"]=$table["keterangan_order"];
                $tables["images"]=$table["desain_depan"];
                array_push($setJson,$tables);
            }
            $data["value"]=$setJson;
        }else{
            $data["status"]="false";

        }
        echo json_encode($data);
    }
}