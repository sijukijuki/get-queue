<?php
defined('BASEPATH')OR exit("no access allowed directly");
/**
 * Created by PhpStorm.
 * User: dimas
 * Date: 25/10/2018
 * Time: 22:45
 */

class Login extends CI_Controller
{
    private $setSession;
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function index()
    {
        if ($this->session->flashdata('error')==TRUE)
        {
            $data['error']="<div class='alert alert-danger text-center' style='width:250px'>".$this->session->flashdata('error')."</div>";
        }else{
            $data['error']=null;
        }
        $this->load->view('login',$data);
    }
    public function ceklogin()
    {
        $data['username']=$this->input->post('username',TRUE);
        $data['password']=$this->input->post('password',TRUE);
        $this->db->select("id,nama,username,password,tipe_user,status")->where("username",$data["username"]);
        $row=$this->db->get("login_app");
        $getData=$row->row();
        if ($row->num_rows() > 0)
        {
            if (password_verify($data["password"],$getData->password))
            {
                if ($getData->status =="Unblock"){
                    $sessiondata["id"]=$getData->id;
                    $sessiondata["nama"]=$getData->nama;
                    $sessiondata["username"]=$getData->username;
                    $sessiondata["tipe_user"]=$getData->tipe_user;
                    $this->session->set_userdata($sessiondata);
                    if ($_SESSION['tipe_user']=="Admin"){
                        redirect(site_url("admin"));
                    }elseif ($_SESSION['tipe_user']=="Produksi"){
                        redirect(site_url("produksi"));
                    }elseif ($_SESSION['tipe_user']=="Manager"){
                        redirect(site_url("manager"));
                    }
                }else{
                    $error="Akun Terblokir, Hubungi Administrator";
                }
            }else{
                $error="Password Tidak cocok";
        }
        }else{
            $error="Username tidak terdaftar";
        }
        $this->session->set_flashdata("error",$error);
        redirect(site_url('login'));
    }
    public function logout()
    {
        session_destroy();
        redirect(site_url('login'));
    }
}