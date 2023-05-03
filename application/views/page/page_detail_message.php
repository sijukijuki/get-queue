<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="d-flex align-items-center">
    <img src="<?php echo base_url("asset/images/dashboard.svg")?>" style="padding-right: 10px">
    <div>
        <b>DETAIL MESSAGE</b><br>
        Halaman detail pesan
    </div>
</div>
<hr>
<div class="card border-primary">
    <div class="card-header bg-primary text-white"><i class="fa fa-list"></i> Data Message</div>
    <div class="card-body">
         <div class="text-center mb-4"><h3>Detail Laporan Produksi</h3></div>
        <div class="row mb-2">
            <div class="col-md-7">
                <div class="row mb-1"><span class="col-md-3">Nomor SO</span><span>: <?php echo $query['no_so'] ?></span></div>
                <div class="row mb-1"><span class="col-md-3">Tanggal SO</span><span>: <?php echo $query['tgl'] ?></span></div>
                <div class="row mb-1"><span class="col-md-3">Customer</span><span>: <?php echo $query['nama_Customer'] ?></span></div>
                <div class="row mb-1"><span class="col-md-3">Sales</span><span>: <?php echo $query['nama'] ?></span></div>
            </div>
            <div class="col-md-5">
                <div class="row mb-1"><span class="col-md-4">Tanggal Cetak</span><span>: <?php echo $query['tgl_cetak'] ?></span></div>
                <div class="row mb-1"><span class="col-md-4">Tanggal Selesai</span><span>: <?php echo $query['tgl_selesai'] ?></span></div>
                <div class="row mb-1"><span class="col-md-4">Jumlah Order</span><span>: <?php echo $query['qty'] ?> Pcs</span></div>
                <div class="row mb-1"><span class="col-md-4">Keterangan</span><span>: <?php echo $query['Keterangan'] ?></span></div>
            </div>
        </div>
        <div class="garis mb-3">
            <span>Laporan Bahan</span>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-center"><?php echo $bahan['pvc_print'] ?></th>
                    <th class="text-center"><?php if($bahan['pvc_tengah']=='NO'){
                        echo "Tanpa PVC Tengah";
                    }else{
                        echo $bahan['pvc_tengah'];
                    }?></th>
                    <th class="text-center">Overlay</th>
                    <th class="text-center"><?php if($bahan['magnetic']=='NO'){
                        echo "Tanpa Magnetic";
                    }else{
                        echo $bahan['magnetic'];
                    }?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center"><?php echo $query['jml_pvc_print'] ?></td>
                    <td class="text-center"><?php echo $query['jml_pvc_tengah'] ?></td>
                    <td class="text-center"><?php echo $query['jml_overlay'] ?></td>
                    <td class="text-center"><?php echo $query['jml_magnetic'] ?></td>
                </tr>
            </tbody>
        </table>
        <div class="garis mb-3">
            <span>Laporan Cetak</span>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Order QTY</th>
                    <th class="text-center">Reject</th>
                    <th class="text-center">Surplus</th>
                    <th class="text-center">Ambil Gudang</th>
                    <th class="text-center">Grand Total</th>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center"><?php echo $query['qty'] ?></td>
                    <td class="text-center"><?php echo $query['jml_kerusakan'] ?></td>
                    <td class="text-center"><?php echo $query['jml_kelebihan'] ?></td>
                    <td class="text-center"><?php echo $query['jml_ambil_gudang'] ?></td>
                    <td class="text-center"><?php echo $query['qty']+$query['jml_kerusakan']+$query['jml_kelebihan'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <a href="<?php echo site_url('admin/revision/'.$query['id_laporan_produksi']) ?>" id="buttonModal" class="btn btn-outline-primary btn-sm"><i class="fa fa-times-circle"></i> Revisi</a>
        <a href="<?php echo site_url('admin/acc/'.$query['id_laporan_produksi']) ?>" id="buttonModal" class="btn btn-primary btn-sm"><i class="fa fa-check-circle"></i> ACC</a>
    </div>
</div>