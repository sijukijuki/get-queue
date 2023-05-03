<?php
/**
 * Created by PhpStorm.
 * User: dimas
 * Date: 08/11/2018
 * Time: 23:36
 */


require_once 'pdf/fpdf.php';
/*class printPDF extends FPDF
{
    private $ci;
    public function __construct()
    {
        $objeckPdf=new FPDF('P','mm','A4');
        $objeckPdf2=new FPDF('L','mm','A4');
        $this->ci=&get_instance();
        $this->ci->pdf=$objeckPdf;
        $this->ci->pdf2=$objeckPdf2;
    }
    public function Footer(){
        $this->ci->pdf->SetY(-15);
        $this->ci->pdf->SetFont('Arial','I',8);
        // Page number
        $this->ci->pdf->Cell(0,6,'dicetak oleh  '.$_SESSION['nama'].' - '.date('l, d-M-Y H:i:s'),0,0,'L');
        return $this->ci;
    }
}*/
class printPDF extends FPDF
{
    public function __construct($page='L',$unit='mm',$size='A4')
    {
        parent::__construct($page,$unit,$size);
    }
    public function Footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,6,'dicetak oleh  '.$_SESSION['nama'].' - '.date('l, d-M-Y H:i:s').' - Hal. '.$this->PageNo().'/{nb}',0,0,'L');
    }
}
class printPDF2 extends FPDF
{
    public function __construct($page='L',$unit='mm',$size='A4')
    {
        parent::__construct($page,$unit,$size);
    }
}