<?php
/**
 * Created by PhpStorm.
 * User: dimas
 * Date: 28/10/2018
 * Time: 3:07
 */

function localtoServerDate($datetime){
    $tahun=substr($datetime,6,4);
    $bulan=substr($datetime,3,2);
    $tgl=substr($datetime,0,2);
    $time=substr($datetime,11,8);
    return $tahun."-".$bulan."-".$tgl." ".$time;
}
function servertoLocalDate($datetime){
    $tahun=substr($datetime,0,4);
    $bulan=substr($datetime,5,2);
    $tgl=substr($datetime,8,2);
    $time=substr($datetime,11,8);
    return $tgl."-".$bulan."-".$tahun." ".$time;
}
function colorStatusMessage($status){
    switch ($status) {
        case 'acc':
            $result="<span class='badge badge-success'>ACC</span>";
            break;
        case 'revision':
            $result="<span class='badge badge-danger'>Revision</span>";
            break;
        case 'updated':
            $result="<span class='badge badge-warning'>Updated</span>";
            break;
        default:
            $result="<span class='badge badge-primary'>New</span>";
            break;
    }
    return $result;
}
function onlyDate($datetime){
    $tahun=substr($datetime,0,4);
    $bulan=substr($datetime,5,2);
    $tgl=substr($datetime,8,2);
    return $tgl."-".$bulan."-".$tahun;
}
function serverDate($datetime){
    $tahun=substr($datetime,6,4);
    $bulan=substr($datetime,3,2);
    $tgl=substr($datetime,0,2);
    return $tahun."-".$bulan."-".$tgl;
}
function bulanIndo($id){
    switch ($id) {
        case '1':
            echo "Januari";
            break;
        case '2':
            echo "Februari";
            break;
        case '3':
            echo "Maret";
            break;
        case '4':
            echo "April";
            break;
        case '5':
            echo "Mei";
            break;
        case '6':
            echo "Juni";
            break;
        case '7':
            echo "Juli";
            break;
        case '8':
            echo "Agustus";
            break;
        case '9':
            echo "September";
            break;
        case '10':
            echo "Oktober";
            break;
        case '11':
            echo "Nopember";
            break;
        case '12':
            echo "Desember";
            break;
        
        default:
            echo('UnKnown');
            break;
    }
}
function getMonthReport($datetime){
    $tahun=substr($datetime,0,4);
    $bulan=substr($datetime,5,2);
    switch ($bulan) {
        case '1':
            $bulan= "Januari";
            break;
        case '2':
            $bulan= "Februari";
            break;
        case '3':
            $bulan= "Maret";
            break;
        case '4':
            $bulan= "April";
            break;
        case '5':
            $bulan= "Mei";
            break;
        case '6':
            $bulan= "Juni";
            break;
        case '7':
            $bulan= "Juli";
            break;
        case '8':
            $bulan= "Agustus";
            break;
        case '9':
            $bulan= "September";
            break;
        case '10':
            $bulan= "Oktober";
            break;
        case '11':
            $bulan= "Nopember";
            break;
        case '12':
            $bulan= "Desember";
            break;

        default:
            $bulan= 'UnKnown';
            break;
    }
    return $bulan." ".$tahun;
}
function colorStatusOrder($status){
    switch ($status) {
        case 'Print':
            $result="<span class='badge badge-success'>Print</span>";
            break;
        case 'Antri':
            $result="<span class='badge badge-warning'>Antri</span>";
            break;
        case 'Collecting':
            $result="<span class='badge badge-danger'>Collecting</span>";
            break;
        case 'Press':
            $result="<span class='badge badge-primary'>Press</span>";
            break;
        case 'Plong':
            $result="<span class='badge badge-success'>Plong</span>";
            break;
        case 'Finishing':
            $result="<span class='badge badge-warning'>Finishing</span>";
            break;
        case 'Packing':
            $result="<span class='badge badge-danger'>Packing</span>";
            break;
        case 'Sorting':
            $result="<span class='badge badge-primary'>Sorting</span>";
            break;
        case 'Reported':
            $result="<span class='badge badge-success'>Reported</span>";
            break;
    }
    return $result;
}