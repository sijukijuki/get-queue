<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card border-left mb-3">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <img src="<?php echo base_url("asset/images/dashboard.svg")?>" style="padding-right: 10px">
            <div>
                <b>BERANDA</b><br>
                Halaman Utama Aplikasi Media Informasi Antrian Produksi
            </div>
        </div>
    </div>
</div>
<div class="card border-top">
    <div class="card-body">

        <div class="alert alert-warning">
            <i class="fa fa-user"></i> Hi, <?php echo strtoupper($_SESSION['nama']) ?>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card bg-primary text-white text-center">
                    <div class="card-body">
                        <i class="fa fa-user fa-3x"></i>
                    </div>
                    <div class="card-footer">
                        <?php echo $totalUser." User"; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card bg-success text-white text-center">
                    <div class="card-body">
                        <i class="fa fa-users fa-3x"></i>
                    </div>
                    <div class="card-footer">
                        <?php echo $totalCustomer." Customer"; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card bg-warning text-white text-center">
                    <div class="card-body">
                        <i class="fa fa-shopping-bag fa-3x"></i>
                    </div>
                    <div class="card-footer">
                        <?php echo $totalOrder." Order"; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card bg-danger text-white text-center">
                    <div class="card-body">
                        <i class="fa fa-print fa-3x"></i>
                    </div>
                    <div class="card-footer">
                        <?php echo number_format($totalCetak['grandTotal'])." Pcs"; ?>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-8 mb-3">
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white">On Progress..</div>
                    <div class="card-body"></div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body"></div>
                </div>
            </div>
        </div>
    </div>
</div>