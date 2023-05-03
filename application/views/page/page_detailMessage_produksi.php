<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-clipboard"></i> Revisi Laporan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div>
        <div class="modal-body">
            <div class="row mb-3">
                <label class="custom-label col-md-4" for="no_so">Nomor SO :</label>
                <div class="col-md-8">
                    <input type="text" class="form-control form-control-sm" value="<?php echo $data['no_so'] ?>" id="no_so" disabled="">
                </div>
            </div>
            <div class="row mb-3">
                <label class="custom-label col-md-4" for="nama_Customer">Nama Customer :</label>
                <div class="col-md-8">
                    <input type="text" class="form-control form-control-sm" id="nama_Customer" value="<?php echo $data['nama_Customer'] ?>" disabled="">
                </div>
            </div>
            <div class="row mb-3">
                <label class="custom-label col-md-4" for="keterangan">Keterangan :</label>
                <div class="col-md-8">
                    <textarea id="keterangan" class="form-control form-control-sm" disabled="" name="keterangan" required=""><?php echo $data['Keterangan'] ?></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>