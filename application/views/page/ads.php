<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card border-left mb-3">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <img src="<?php echo base_url("asset/images/report2.svg")?>" style="padding-right: 10px">
            <div>
                <b>IKLAN BANNER</b><br>
                Halaman Kelola Iklan Banner
            </div>
        </div>
    </div>
</div>
<div class="card border-top">
    <div class="card-header">
        <form class="form-inline" method="POST" action="<?php echo site_url("serverside/ads") ?>" enctype="multipart/form-data">
            <input type="file" class="form-control form-control-sm" name="ads">
            <button type="submit" class="btn btn-yellow btn-sm">Submit</button>
        </form>
    </div>
    <div class="card-body">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>No</th>
                <th>Iklan Banner</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no=1;
            foreach ($ads as $ad)
            {
                echo '
                <tr>
                    <td>'.$no.'</td>
                    <td><img src="'.base_url("asset/images/desain_banner/".$ad['ads']).'" width="100px"></td>
                    <td><a class="btn btn-danger btn-sm" href="'.site_url("serverside/deleteAds/".$ad["id_ads"]).'"><i class="fa fa-trash-alt text-white"></i></a></td>
                </tr>
                ';
                $no++;
            }
            ?>
            </tbody>
        </table>
    </div>
</div>