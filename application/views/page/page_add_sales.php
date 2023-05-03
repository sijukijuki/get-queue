<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus-square"></i> Add Sales</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="POST" action="<?php echo site_url("serverside/addSales"); ?>" id="submit">
        <div class="modal-body">
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="nama">Nama Sales :</label>
                <div class="col-md-9">
                    <input type="text" id="nama" name="sales_name" required placeholder="Nama Lengkap" autocomplete="off" class="form-control form-control-sm">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-second btn-sm" data-dismiss="modal">Close</button>
            <button type="submit" id="btn-Process" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Save Data</button>
        </div>
        </form>
    </div>
</div>
