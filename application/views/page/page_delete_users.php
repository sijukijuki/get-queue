<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash-o"></i> Delete User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            Are you Sure to Delete <b><?php echo $data['nama'] ?></b>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-second" data-dismiss="modal">Close</button>
            <a href="<?php echo site_url('serverside/deleteUser/'.$data['id'])?>" id="hapusbtn" class="btn btn-danger">Delete</a>
        </div>
    </div>
</div>
