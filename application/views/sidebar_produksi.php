<div class="container-fluid">
    <div style="clear: both"></div>
    <div class="text-center mb-3 mt-3">
        <b><?php echo strtoupper($_SESSION['nama']) ?></b>
        <p class="text-secondary"><?php echo $_SESSION['tipe_user'] ?> - <a id="buttonModal" href="<?php echo site_url('produksi/usersetting')?>" class="btn-link">Edit Profile</a></p>
    </div>
</div>    <ul class="nav flex-column nav-pills">
    <li class="nav-item">
        <a class="nav-link link-icon" href="<?php echo site_url('produksi')?>"><i class="fa fa-home"></i> Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link link-icon" href="<?php echo site_url('produksi/Customer')?>"><i class="fa fa-user"></i> Data Pelanggan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link link-icon" href="<?php echo site_url('produksi/Order')?>"><i class="fa fa-trademark"></i> Data Order</a>
    </li>
    <li class="nav-item">
        <a class="nav-link link-icon" href="<?php echo site_url('produksi/historyOrder')?>"><i class="fa fa-trademark"></i>History Order</a>
    </li>
    <li class="nav-item">
        <a class="nav-link link-icon" href="<?php echo site_url('produksi/Bahan')?>"><i class="fa fa-copy"></i> Bahan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link link-icon" href="<?php echo site_url('produksi/Message')?>"><i class="fa fa-envelope"></i> Messages
            <span class="mr-auto badge badge-success text-white" id="value"></span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link link-icon" href="<?php echo site_url('produksi/Report')?>"><i class="fa fa-print"></i> Print Report</a>
    </li>
    <li class="nav-item">
        <a class="nav-link link-icon" href="<?php echo site_url('produksi/historyReport')?>"><i class="fa fa-clipboard"></i> History Report</a>
    </li>
    <li class="nav-item">
        <a class="nav-link link-icon" href="<?php echo site_url('produksi/ads')?>"><i class="fa fa-bullhorn"></i> Iklan Banner</a>
    </li>
    <li class="nav-item">
        <a class="nav-link link-icon" href="<?php echo site_url('produksi/sales')?>"><i class="fa fa-users"></i> Sales</a>
    </li>
    <li class="nav-item">
        <a class="nav-link link-icon" href="<?php echo site_url('produksi/Users')?>"><i class="fa fa-users"></i> Users</a>
    </li>
</ul>
<script type="text/javascript">
    $(document).ready(function(){
        $("#value").load("<?php echo site_url('serverside/getStatus_produksi') ?>");
    })
</script>