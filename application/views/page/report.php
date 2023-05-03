<?php
$arrayBulan=array(
    array("no"=>"01","bulan"=>"Januari"),
    array("no"=>"02","bulan"=>"Februari"),
    array("no"=>"03","bulan"=>"Maret"),
    array("no"=>"04","bulan"=>"April"),
    array("no"=>"05","bulan"=>"Mei"),
    array("no"=>"06","bulan"=>"Juni"),
    array("no"=>"07","bulan"=>"Juli"),
    array("no"=>"08","bulan"=>"Agustus"),
    array("no"=>"09","bulan"=>"September"),
    array("no"=>"10","bulan"=>"Oktober"),
    array("no"=>"11","bulan"=>"November"),
    array("no"=>"12","bulan"=>"Desember"),
);
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card border-left mb-3">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <img src="<?php echo base_url("asset/images/report2.svg")?>" style="padding-right: 10px">
            <div>
                <b>REPORT</b><br>
                Halaman Kelola Laporan Produksi
            </div>
        </div>
    </div>
</div>
<div class="card border-top">
    <div class="card-header">
        <div class=" float-left">
            <div class="input-group">
                <form id="getData" method="POST" action="<?php echo site_url('serverside/getReport') ?>" class="form-inline">
                    <select class="custom-select" name="bulan" id="bulan">
                        <option selected="" disabled="">--Pilih Bulan--</option>
                        <?php
                        foreach ($arrayBulan as $key) {
                            echo "<option $select value=$key[no] >$key[bulan]</option>";
                        }
                        ?>
                    </select>
                    <select class="custom-select" name="tahun" id="tahun">
                        <option selected="" disabled="">--Pilih Tahun--</option>
                        <?php
                        foreach ($tahun as $key) {
                            echo "<option value=".substr($key['tgl_selesai'], 0,4)." >".substr($key['tgl_selesai'],0,4)."</option>";
                        }
                        ?>
                    </select>
                    <div class="input-group-btn">
                        <button type="submit" id="load" class="btn btn-yellow"><i class="fa fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="float-right">
            <?php
            if ($_SESSION['tipe_user']=='Produksi') {
                echo "<a href='".site_url('produksi/addReport')."' id=\"buttonModal\" class=\"btn btn-yellow btn-sm\"><i class=\"fa fa-plus-square\"></i> Add Data</a>";
            }
            ?>
            <a href="<?php echo site_url('reportbulan') ?>" target="_blank" id="print" class="disabled btn btn-outline-warning"><i class="fa fa-print"></i> Print</a>
        </div>
        <div style="clear:both"></div>
    </div>
    <div class="card-body">
        <div id="Data"></div>
    </div>
</div>