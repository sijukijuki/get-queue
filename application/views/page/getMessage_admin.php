<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card border-left mb-3">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <img src="<?php echo base_url("asset/images/message.svg")?>" style="padding-right: 10px">
            <div>
                <b>PESAN</b><br>
                Halaman Pesan Masuk
            </div>
        </div>
    </div>
</div>
<div class="card border-top">
    <div class="card-header"></div>
    <div class="card-body">
        <table class="table table-hover table-stripped" id="table">
            <thead>
            <tr>
                <th>No SO</th>
                <th>Nama Customer</th>
                <th>Cetak</th>
                <th>Sales</th>
                <th>Status Report</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#table').DataTable( {
            processing: true,
            serverSide: true,
            resposive:true,
            ajax:{
                "url":"<?php echo site_url('serverside/jsongetMessage_admin'); ?>",
                "type":"POST"
            },
            columns:[
                {"data":"no_so"},
                {"data":"nama_customer"},
                {"data":"qty"},
                {"data":"nama"},
                {"data":"status_report"},
                {"data":"action"},
            ]
        });
    });
</script>