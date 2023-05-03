<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card border-left mb-3">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <img src="<?php echo base_url("asset/images/history.svg")?>" style="padding-right: 10px">
            <div>
                <b>HISTORY REPORT</b><br>
                Halaman Histori Cetak Produksi
            </div>
        </div>
    </div>
</div>
<div class="card border-top">
    <div class="card-header">Data Order</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered dt-responsive nowrap" id="table" width="100%">
            <thead>
                <tr>
                    <th>No SO</th>
                    <th>Nama Customer</th>
                    <th>Jumlah Order</th>
                    <th>Sales</th>
                    <th>Tgl Selesai</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#table').DataTable( {
            processing: true,
            serverSide: true,
            resposive:true,
            ajax:{
                "url":"<?php echo site_url('serverside/jsonHistoryReport'); ?>",
                "type":"POST"
            },
            columns:[
                {"data":"no_so"},
                {"data":"nama_Customer"},
                {"data":"qty"},
                {"data":"nama"},
                {"data":"tgl_selesai"},
                {"data":"status_report"},
                {"data":"action"},
            ]
        });
    });
</script>