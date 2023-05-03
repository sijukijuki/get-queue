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
        <div class="modal-body">
            Apakan anda yakin ACC <b><?php echo $data['no_so']."-".$data['nama_Customer'] ?></b>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-second btn-sm" data-dismiss="modal">No</button>
            <a onclick="window.location.reload()" href="<?php echo site_url('serverside/acc/'.$data['id_laporan_produksi']) ?>" id="print" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Yes</a>
        </div>
    </div>
</div>