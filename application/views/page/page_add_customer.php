<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-pencil-alt"></i> Add Customer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="POST" action="<?php echo site_url("serverside/addCustomer"); ?>" enctype="multipart/form-data" >
        <div class="modal-body">
            <div class="row form-group">
                <label class="col-md-4 col-form-label" for="nama_customer">Nama Customer :</label>
                <div class="col-md-8">
                    <input type="text" autofocus id="nama_customer" name="nama_customer" required placeholder="Nama Customer" autocomplete="off" class="form-control form-control-sm">
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-4 col-form-label" for="desain_depan">Desain :</label>
                <div class="col-md-8">
                    <input type="file" id="desain_depan" accept="image/png, image/jpeg, image/jpg" name="desain_depan" placeholder="desain_depan" autocomplete="off" class="form-control-file">
                    <small>Png or JPEG only (86mm*56mm)</small>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-outline-second" data-dismiss="modal">Close</button>
            <button type="submit" id="btn-Process" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Save Data</button>
        </div>
        </form>
    </div>
</div>
