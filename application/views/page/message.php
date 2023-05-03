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
        <div id="message"></div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        <?php
        if ($_SESSION['tipe_user']=='Produksi') {
            echo "$('#message').load('".site_url('serverside/getMessage_produksi')."')";
        }else{
            echo "$('#message').load('".site_url('serverside/getMessage_admin')."')";
        }
        ?>
    })
</script>