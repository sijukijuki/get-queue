<?php
/**
 * Created by PhpStorm.
 * User: dimas
 * Date: 08/11/2018
 * Time: 23:43
 */

class reportcetak extends CI_Controller
{
    private $pdf;
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array("printPDF"));
        $this->pdf=new printPDF2('P');
        if (empty($_SESSION['nama']) or !isset($_SESSION['nama'])){
            redirect('login');
        }
        date_default_timezone_set('Asia/Jakarta');
    }
    public function print($id=1){
        $this->cek($id);
        $query=$this->getReportTable($id)->row_array();
        $this->pdf->AliasNbPages();
        $this->pdf->AddPage();
        $this->pdf->SetFont('Times','B',14);
        $this->pdf->Cell(0,5,'LAPORAN PRODUKSI',0,1,'C');
        $this->pdf->ln();
        $this->pdf->setFont('Arial','',8);
        $this->setCell('Nomor SO',$query['no_so'],86);
        $this->setCell('Tanggal Cetak',onlyDate($query['tgl_cetak']),50);
        $this->pdf->ln();
        $this->setCell('Tanggal SO',onlyDate($query['tgl']),86);
        $this->setCell('Tanggal Selesai',onlyDate($query['tgl_selesai']),50);
        $this->pdf->ln();
        $this->setCell('Nama Customer',$query['nama_Customer'],86);
        $this->setCell('Jumlah Order',$query['qty'],50);
        $this->pdf->ln();
        $this->setCell('Nama Sales',$query['nama'],86);
        $this->setCell('Keterangan',$query['Keterangan'],50);
        $this->pdf->Ln();
        $this->pdf->Ln();
        $this->setJudul('Laporan Bahan');
        $this->pdf->Ln();
        $this->cellTable($query['pvc_print'],'I','H',47.5);
        if($query['pvc_tengah']=='NO'){
            $this->cellTable('Tanpa PVC Tengah','I','H',47.5);
        }else{
            $this->cellTable($query['pvc_tengah'],'I','H',47.5);
        }
        $this->cellTable('Overlay','I','H',47.5);
        if($query['magnetic']=='NO'){
            $this->cellTable('Tanpa Magnetic','I','H',47.5);
        }else{
            $this->cellTable($query['magnetic'],'I','H',47.5);
        }
        $this->pdf->Ln();
        $this->cellTable($query['jml_pvc_print'],'B',null,47.5);
        $this->cellTable($query['jml_pvc_tengah'],'B',null,47.5);
        $this->cellTable($query['jml_overlay'],'B',null,47.5);
        $this->cellTable($query['jml_magnetic'],'B',null,47.5);
        $this->pdf->Ln();
        $this->pdf->Ln();
        $this->setJudul('Laporan Cetak');
        $this->pdf->Ln();
        $this->cellTable('Jumlah Order','I','H',38);
        $this->cellTable('Jumlah Kerusakan','I','H',38);
        $this->cellTable('Jumlah Kelebihan','I','H',38);
        $this->cellTable('Jumlah Ambil Gudang','I','H',38);
        $this->cellTable('Grand Total','I','H',38);
        $this->pdf->Ln();
        $this->cellTable($query['qty'],'B',null,38);
        $this->cellTable($query['jml_kerusakan'],'B',null,38);
        $this->cellTable($query['jml_kelebihan'],'B',null,38);
        $this->cellTable($query['jml_ambil_gudang'],'B',null,38);
        $this->cellTable($query['qty']+$query['jml_kerusakan']+$query['jml_kelebihan'],'B',null,38);
        $this->pdf->Ln();
        $this->pdf->Ln();
        $this->tableTTD('Manager Admin');
        $this->tableTTD('Manager Produksi');
        $this->tableTTD('Produksi');
        $this->pdf->Ln();
        $this->tableTTD($this->setTTD($query['ttd_penyetuju']));
        $this->tableTTD("");
        $this->tableTTD($this->setTTD($query['ttd_pembuat']));
        $this->pdf->Ln();
        $this->pdf->Ln();
        $this->pdf->Ln();
        $this->pdf->Ln();
        $this->tableTTD('( '.$query['penyetuju'].' )',"B");
        $this->tableTTD('(........................................)',"B");
        $this->tableTTD('( '.$query['pembuat'].' )',"B");
        $this->pdf->Ln();
        $this->pdf->SetFont('Arial','I',8);
        $this->pdf->Cell(0,6,'dicetak oleh  '.$_SESSION['nama'].' - '.date('l, d-M-Y H:i:s').' - Hal. '.$this->pdf->PageNo().'/{nb}',0,0,'L');
        // Page number
        $this->pdf->Output('I',$this->getNoSO($id));
    }
    private function setCell($title,$value,$ukuran){
        $this->pdf->Cell(27,5,$title,0,0,'L');
        $this->pdf->Cell($ukuran,5,': '.$value,0,0,'L');
    }
    private function setJudul($title){
        $this->pdf->SetFont('Arial','B',9);
        $this->pdf->Cell($this->pdf->GetStringWidth($title)+5,2,$title,0,1,'C');
    }
    private function cellTable($value,$style="",$h=null,$ukuran){
        if (empty($h)){
            $this->pdf->SetFillColor(255,255,255);
            $this->pdf->SetTextColor(0,0,0);
        }else{
            $this->pdf->SetFillColor(215,215,215);
            $this->pdf->SetTextColor(0,0,0);
        }
        $this->pdf->setFont('Arial',$style,9);
        $this->pdf->Cell($ukuran,7,$value,1,0,'C',true);
    }
    private function setTTD($ttd){
        $this->pdf->image(base_url('asset/images/ttd/'.$ttd),$this->pdf->GetX()+15,$this->pdf->GetY(),0,0,'JPG');
    }
    private function tableTTD($value,$style=""){
        $this->pdf->setFont('Arial',$style,10);
        $this->pdf->Cell(63.3,5,$value,0,0,'C');
    }
    private function getNoSO($id){
        $no_so=$this->db->select('no_so, nama_Customer')
            ->join('customer_has_order','customer_has_order.id_so=laporan_produksi.id_so')
            ->join('customer','customer_has_order.id_customer=customer.id_customer')
            ->where('id_laporan_produksi',$id)
            ->get('laporan_produksi')->row_array();
        return "Laporan ".$no_so['no_so'].' - '.str_replace('"','_',$no_so['nama_Customer']).".pdf";
    }
    private function getReportTable($id){
        $this->db->select("no_so,tgl,pvc_print,t1.nama as pembuat,t1.ttd as ttd_pembuat, t2.nama as penyetuju, t2.ttd as ttd_penyetuju, pvc_tengah, magnetic, tgl_cetak, tgl_selesai, nama_Customer, user.nama as nama, customer_has_order.Keterangan as Keterangan,jml_pvc_print, jml_pvc_tengah, jml_overlay, jml_magnetic, qty, jml_kerusakan, jml_kelebihan, jml_ambil_gudang");
        $this->db->from('laporan_produksi');
        $this->db->join('customer_has_order','customer_has_order.id_so=laporan_produksi.id_so');
        $this->db->join('customer','customer.id_customer=customer_has_order.id_customer');
        $this->db->join('laporan_bahan','laporan_bahan.id_so=customer_has_order.id_so');
        $this->db->join('bahan','bahan.id_bahan=laporan_bahan.id_bahan');
        $this->db->join('laporan_has_status','laporan_has_status.id_so=customer_has_order.id_so');
        $this->db->join('user','user.id_user=customer_has_order.id_user');
        $this->db->join('login_app as t1','t1.id=laporan_has_status.pembuat');
        $this->db->join('login_app as t2','t2.id=laporan_has_status.penyetuju');
        $this->db->where("id_laporan_produksi",$id);
        return $this->db->get();
    }
    private function cek($id){
        $this->db->where('id_laporan_produksi',$id);
        if ($this->db->get('laporan_produksi')->num_rows() <= 0){
            redirect(site_url('produksi'));
        }
    }
}