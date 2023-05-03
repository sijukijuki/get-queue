<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if ($query['status_report']!='acc'){
    $disabled="disabled";
}else{
    $disabled=null;
}
?>
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-eye"></i> Detail Report</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="text-center mb-4"><h3>Detail Laporan Produksi</h3></div>
            <div class="row">
                <div class="col-md-7">
                    <div class="row mb-1"><span class="col-md-3">Nomor SO</span><span>: <?php echo $query['no_so'] ?></span></div>
                    <div class="row mb-1"><span class="col-md-3">Tanggal SO</span><span>: <?php echo onlyDate($query['tgl']) ?></span></div>
                    <div class="row mb-1"><span class="col-md-3">Customer</span><span>: <?php echo $query['nama_Customer'] ?></span></div>
                    <div class="row mb-1"><span class="col-md-3">Sales</span><span>: <?php echo $query['nama'] ?></span></div>
                </div>
                <div class="col-md-5">
                    <div class="row mb-1"><span class="col-md-4">Tgl Cetak</span><span>: <?php echo onlyDate($query['tgl_cetak']) ?></span></div>
                    <div class="row mb-1"><span class="col-md-4">Tgl Selesai</span><span>: <?php echo onlyDate($query['tgl_selesai']) ?></span></div>
                    <div class="row mb-1"><span class="col-md-4">Jml Order</span><span>: <?php echo $query['qty'] ?> Pcs</span></div>
                    <div class="row mb-1"><span class="col-md-4">Keterangan</span><span>: <?php echo $query['Keterangan'] ?></span></div>
                </div>
            </div>
            <div class="garis mb-3">
                <span>Laporan Bahan</span>
            </div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center"><?php echo $query['pvc_print'] ?></th>
                        <th class="text-center"><?php if($query['pvc_tengah']=='NO'){
                            echo "Tanpa PVC Tengah";
                        }else{
                            echo $query['pvc_tengah'];
                        }?></th>
                        <th class="text-center">Overlay</th>
                        <th class="text-center"><?php if($query['magnetic']=='NO'){
                            echo "Tanpa Magnetic";
                        }else{
                            echo $query['magnetic'];
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
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-second btn-sm" data-dismiss="modal">Close</button>
            <a href="<?php echo site_url('reportcetak/print/'.$query['id_laporan_produksi']) ?>"  target="__blank" class="<?php echo $disabled ;?> btn btn-primary btn-sm"><i class="fa fa-print"></i> Cetak</a>
        </div>
        </form>
    </div>
</div>