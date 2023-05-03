<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i> Ubah User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="POST" action="<?php echo site_url("serverside/usersetting"); ?>" id="submit">
        <div class="modal-body">
            <input id="id_user" type="hidden" name="id_user" value="<?php echo $data['id'] ?>"/>
            <div class="row mb-3">
                <label class="custom-label col-md-4" for="nama">Nama :</label>
                <div class="col-md-8">
                    <input type="text" class="form-control form-control-sm" autocomplete="off" value="<?php echo $data['nama'] ?>" required id="nama" name="nama">
                </div>
            </div>
            <div class="row mb-3">
                <label class="custom-label col-md-4" for="username">Username :</label>
                <div class="col-md-8">
                    <input type="text" class="form-control form-control-sm" id="username" autocomplete="off" name="username"required value="<?php echo $data['username'] ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="custom-label col-md-4" for="password">Password :</label>
                <div class="col-md-8">
                    <input type="password" class="form-control form-control-sm" id="password" name="password" >
                    <small>Kosongkan Jika tidak mengubah Password !</small>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-second btn-sm" data-dismiss="modal">Close</button>
            <button type="submit" id="btn-Process" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Save Data</button>
        </div>
        </form>
    </div>
</div>