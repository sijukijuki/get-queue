<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card border-left mb-3">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <img src="<?php echo base_url("asset/images/bahan.svg")?>" style="padding-right: 10px">
            <div>
                <b>DATA BAHAN</b><br>
                Halaman Kelola Bahan Produki
            </div>
        </div>
    </div>
</div>
<div class="card border-top">
    <div class="card-header d-flex">
        <a href="<?php echo site_url("produksi/addBahan")?>" id="buttonModal" class="btn btn-yellow ml-auto"><i class="fa fa-plus-square"></i> Add Data</a>
    </div>
    <div class="card-body">
        <table class="table table-hover table-striped" id="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>PVC Print</th>
                <th>PVC Tengah</th>
                <th>Magnetic</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($total > 0){
                foreach ($query->result_array() as $data){
                    echo "
                        <tr>
                            <td>$data[title]</td>
                            <td>$data[pvc_print]</td>
                            <td>$data[pvc_tengah]</td>
                            <td>$data[magnetic]</td>
                            <td>
                                <div class='btn-group btn-group-sm'>
                                    <a class='btn btn-warning btn-sm' id='buttonModal' href=\"updateBahan/$data[id_bahan]\" id=''><i class='fa fa-pencil-alt text-white'></i></a>
                                    <a class='btn btn-danger btn-sm' id='buttonModal' href=\"deleteBahan/$data[id_bahan]\" id=''><i class='fa fa-trash-alt text-white'></i></a>
                                </div>
                            </td>
</td>
                        </tr>
                    ";
                }
            }else{
                echo "<tr><td colspan='5' class='text-center'><i>Data Kosong</i></td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>