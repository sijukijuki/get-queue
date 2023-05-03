<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card border-left mb-3">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <img src="<?php echo base_url("asset/images/customer.svg")?>" style="padding-right: 10px">
            <div>
                <b>DATA CUSTOMER</b><br>
                Halaman Kelola Data Customer
            </div>
        </div>
    </div>
</div>
<div class="card border-top">
    <div class="card-header d-flex align-items-center">
        Data Customer
        <a href="<?php echo site_url("produksi/addCustomer")?>" id="buttonModal" class="btn btn-yellow ml-auto"><i class="fa fa-plus-square"></i> Add Data</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered dt-responsive nowrap" id="table" width="100%">
                <thead>
                <tr>
                    <th>Nama Customer</th>
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
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "fixedHeader": true,
            "ajax":{
                "url":"<?php echo site_url('serverside/jsonCustomer'); ?>",
                "type":"POST"
            },
            "columns":[
                {"data":"nama_Customer"},
                {"data":"action"},
            ]
        });
    });
</script>