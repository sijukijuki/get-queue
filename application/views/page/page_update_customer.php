<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-pencil-square"></i> Edit Customer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="POST" action="<?php echo site_url("serverside/updateCustomer"); ?>" enctype="multipart/form-data">
        <div class="modal-body">
            <input type="hidden" value="<?php echo $customer['id_customer']; ?>" name="id_customer" required autocomplete="off">
            <div class="row form-group">
                <label class="col-md-4 col-form-label" for="nama_customer">Nama Customer :</label>
                <div class="col-md-8">
                    <input type="text" id="nama_customer" value="<?php echo htmlspecialchars($customer['nama_Customer']); ?>" name="nama_customer" required placeholder="Nama Customer" autocomplete="off" class="form-control form-control-sm">
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-4 col-form-label" for="desain_depan">Desain :</label>
                <div class="col-md-8">
                    <input type="file" id="desain_depan" accept="image/png, image/jpeg, image/jpg" name="desain_depan" placeholder="desain_depan" autocomplete="off" class="form-control-file">
                    <small>Png or JPEG only (86mm*56mm) - Kosongkan jika tidak mengganti Gambar</small>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-second" data-dismiss="modal">Close</button>
            <button type="submit" id="btn-Process" class="btn btn-primary"><i class="fa fa-save"></i> Save Data</button>
        </div>
        </form>
    </div>
</div>
