<?php
/**
 * Created by PhpStorm.
 * User: dimas
 * Date: 17/11/2018
 * Time: 20:05
 */

class reportbulan extends CI_Controller
{
    private $pdf2;
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array("printPDF"));
        $this->pdf2=new printPDF('L');
        if (empty($_SESSION['nama']) or !isset($_SESSION['nama'])){
            redirect('login');
        }
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index(){
        $this->pdf2->AliasNbPages();
        $this->pdf2->AddPage();
        $this->pdf2->SetFont('Times','B',12);
        $this->pdf2->Cell(0,5,'LAPORAN PENYELESAIAN PRODUKSI KARTU PERBULAN',0,1,'C');
        $this->pdf2->ln();
        $this->pdf2->ln();
        $this->pdf2->SetFont('Times','B',10);
        $this->pdf2->Cell(0,5,'Bulan : '.getMonthReport($_COOKIE['bulan_selesai']),0,1,'L');
        $this->pdf2->ln();
        $this->pdf2->SetFont('Arial','B',7);
        $this->pdf2->SetFillColor(219,219,219);
        $this->cellHeaderTable(8,'No');
        $this->cellHeaderTable(18,'Tgl Order');
        $this->cellHeaderTable(80,'Nama Customer');
        $this->cellHeaderTable(25,'Ket. Customer');
        $this->cellHeaderTable(20,'QTY Order');
        $this->cellHeaderTable(20,'Kerusakan');
        $this->cellHeaderTable(20,'Kelebihan');
        $this->cellHeaderTable(18,'10.000');
        $this->cellHeaderTable(50,'Keterangan');
        $this->cellHeaderTable(18,'Tgl Selesai');
        $this->pdf2->ln();
        $this->pdf2->Cell(0,0,null,1);
        $this->pdf2->SetFont('Arial','B',6);
        $this->pdf2->ln();
        $no=1;
        $grandTotalQTY=0;
        $grandTotalkerusakan=0;
        $grandTotalKelebihan=0;
        foreach ($this->getData() as $data){
            $this->pdf2->Cell(8,8,$no,1,0,'C');
            $this->setTable($data);
            $no++;
            $grandTotalQTY+=$data['qty'];
            $grandTotalkerusakan+=$data['jml_kerusakan'];
            $grandTotalKelebihan+=$data['jml_kelebihan'];
        }
        $this->pdf2->SetFillColor(50,166,255);
        $this->pdf2->SetFont('Arial','B',7);
        $this->pdf2->Cell(26,8,'Grand Total',1,0,'C',TRUE);
        $this->pdf2->Cell(105,8,null,0);
        $this->pdf2->Cell(20,8,number_format($grandTotalQTY),1,0,'C',TRUE);
        $this->pdf2->Cell(20,8,number_format($grandTotalkerusakan),1,0,'C',TRUE);
        $this->pdf2->Cell(20,8,number_format($grandTotalKelebihan),1,0,'C',TRUE);
        $this->pdf2->Cell(18,8,number_format($grandTotalQTY+$grandTotalkerusakan+$grandTotalKelebihan),1,0,'C',TRUE);
        $this->pdf2->ln();
        $this->pdf2->ln();
        $this->getKet('PVC 0.15','PVC 0.15');
        $this->getKet('PVC 0.2','PVC 0.2');
        $this->getKet('PVC 0.3','PVC 0.3');
        $this->pdf2->Cell(30,5,null);
        $this->pdf2->Cell(50,5,'Manager Admin',0,0,'C');
        $this->pdf2->Cell(30,5,null);
        $this->pdf2->Cell(50,5,'Produksi',0,0,'C');
        $this->pdf2->ln();
        $user=$this->getTTD()->row_array();
        $this->pdf2->Cell(200,0,null);
        $this->pdf2->Cell(50,0,$this->setTTD($user['ttd']),0,1);
        $this->pdf2->ln();
        $this->pdf2->Cell(120,5,null);
        $this->pdf2->Cell(50,5,'(..................................................)',0,0,'C');
        $this->pdf2->Cell(30,5,null);
        $this->pdf2->Cell(50,5,"( ".$user['nama']." )",0,0,'C');
        $this->pdf2->output('I',"Laporan Bulanan - ".getMonthReport($_COOKIE['bulan_selesai']).".pdf");
    }
    private function cellHeaderTable($width,$text){
        $this->pdf2->Cell($width,7,$text,1,0,'C',true);
    }
    private function setTable($data){
        $this->pdf2->Cell(18,8,onlyDate($data['tgl_cetak']),1,0,'C');
        $this->getColorPVC($data['pvc_print']);
        $this->pdf2->Cell(80,8,$data['nama_Customer'],1,0,'L',TRUE);
        $this->pdf2->Cell(25,8,$data['ket_customer'],1,0,'C');
        $this->pdf2->Cell(20,8,number_format($data['qty']),1,0,'C');
        $this->pdf2->Cell(20,8,number_format($data['jml_kerusakan']),1,0,'C');
        $this->pdf2->Cell(20,8,number_format($data['jml_kelebihan']),1,0,'C');
        $this->pdf2->Cell(18,8,number_format($data['qty']+$data['jml_kelebihan']+$data['jml_kerusakan']),1,0,'C');
        $this->pdf2->Cell(50,8,$data['keterangan_rusak'],1,0,'L');
        $this->pdf2->Cell(18,8,onlyDate($data['tgl_selesai']),1,0,'C');
        $this->pdf2->ln();
    }
    private function getKet($pvc_print,$title){
        $this->getColorPVC($pvc_print);
        $this->pdf2->Cell(10,5,null,0,0,null,TRUE);
        $this->pdf2->Cell(20,5,' : '.$title,0,0,'L');
    }
    public function getData(){
        $this->db->select('tgl_cetak,nama_Customer,pvc_print,customer_has_order.Keterangan as ket_customer,qty,jml_kerusakan,jml_kelebihan,tgl_selesai,keterangan_rusak')
            ->from('laporan_produksi')
            ->join('customer_has_order','laporan_produksi.id_so=customer_has_order.id_so')
            ->join('customer','customer.id_customer=customer_has_order.id_customer')
            ->join('laporan_bahan','laporan_bahan.id_laporan_bahan=laporan_produksi.id_laporan_produksi')
            ->join('bahan','bahan.id_bahan=laporan_bahan.id_bahan')
            ->like('tgl_selesai',$_COOKIE['bulan_selesai'])
            ->order_by('tgl_cetak','ASC');
        return $this->db->get()->result_array();
        //print_r($this->db->get()->result_array());
    }
    private function getColorPVC($ket){
        switch ($ket){
            case 'PVC 0.2':
                return $this->pdf2->SetFillColor(189,241,108);
                break;
            case 'PVC 0.3':
                return $this->pdf2->SetFillColor(106,199,252);
                break;
            case 'PVC 0.15':
                return $this->pdf2->SetFillColor(252,206,106);
                break;
        }
    }
    private function getTTD()
    {
        return $this->db->select('nama,ttd')->where('tipe_user','Produksi')->get('login_app');
    }
    private function setTTD($ttd){
        $this->pdf2->Image(base_url('asset/images/ttd/'.$ttd),$this->pdf2->GetX()+10,null,0,0,'JPG');
    }
}