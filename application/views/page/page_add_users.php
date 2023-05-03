<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus-square"></i> Add User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="POST" action="<?php echo site_url("serverside/addUser"); ?>" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="nama">Nama :</label>
                <div class="col-md-9">
                    <input type="text" id="nama" name="nama" required placeholder="Nama Lengkap" autocomplete="off" class="form-control form-control-sm">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="username">Username :</label>
                <div class="col-md-9">
                    <input type="text" id="username" name="username" required placeholder="Username" autocomplete="off" class="form-control form-control-sm">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="password">Password :</label>
                <div class="col-md-9">
                    <input type="text" id="password" name="password" required placeholder="Password" autocomplete="off" class="form-control form-control-sm">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="tipe_user">Tipe User :</label>
                <div class="col-md-9">
                    <select id="tipe_user" name="tipe_user" required class="form-control form-control-sm custom-select">
                        <option selected disabled>--Choose Tipe of User--</option>
                        <option value="Produksi">Produksi</option>
                        <option value="Admin">Admin</option>
                        <option value="Manager">Manager</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="status">Status :</label>
                <div class="col-md-9">
                    <select id="status" name="status" required class="form-control form-control-sm custom-select">
                        <option selected disabled>--Choose Status Login--</option>
                        <option value="Unblock">Unblock</option>
                        <option value="Block">Block</option>
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-3 col-form-label" for="ttd">Tanda Tangan :</label>
                <div class="col-md-9">
                    <input type="file" id="ttd" accept="image/png, image/jpeg, image/jpg" name="tanda_tangan" placeholder="desain_depan" autocomplete="off" class="form-control-file">
                    <small>Png or JPEG only (30mm*30mm)</small>
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
