<?php
/**
 * Created by PhpStorm.
 * User: dimas
 * Date: 26/08/2018
 * Time: 1:19
 */

class Theme
{
    private $ci;
    public function __construct()
    {
        $this->ci=&get_instance();
    }
    public function theme_produksi($page,$data=null)
    {
        $data['sidebar']=$this->ci->load->view('sidebar_produksi',$data,TRUE);
        $data['header']=$this->ci->load->view('header',$data,TRUE);
        $data['footer']=$this->ci->load->view('footer',$data,TRUE);
        $data['page']=$this->ci->load->view('page/'.$page,$data,TRUE);
        $this->ci->load->view('admin',$data);
    }
    public function theme_admin($page,$data=null)
    {
        $data['sidebar']=$this->ci->load->view('sidebar_admin',$data,TRUE);
        $data['header']=$this->ci->load->view('header',$data,TRUE);
        $data['footer']=$this->ci->load->view('footer',$data,TRUE);
        $data['page']=$this->ci->load->view('page/'.$page,$data,TRUE);
        $this->ci->load->view('admin',$data);
    }
    public function theme_manager($page,$data=null)
    {
        $data['sidebar']=$this->ci->load->view('sidebar_manager',$data,TRUE);
        $data['header']=$this->ci->load->view('header',$data,TRUE);
        $data['footer']=$this->ci->load->view('footer',$data,TRUE);
        $data['page']=$this->ci->load->view('page/'.$page,$data,TRUE);
        $this->ci->load->view('admin',$data);
    }
}