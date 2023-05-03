<div class="container-fluid">
    <button class="btn float-right btn-secondary mb-3" id="closeMenu">x</button>
    <div style="clear: both"></div>
    <div class="text-center mb-3 mt-3">
        <b><?php echo strtoupper($_SESSION['nama']) ?></b>
        <p class="text-secondary"><?php echo $_SESSION['tipe_user'] ?> - <a id="buttonModal" href="<?php echo site_url('manager/usersetting')?>" class="btn-link">Edit Profile</a></p>
    </div>
</div>
<ul class="nav flex-column nav-pills">
    <li class="nav-item">
        <a class="nav-link link-icon" href="<?php echo site_url('manager/Report')?>"><i class="fa fa-print"></i> Print Report</a>
    </li>
    <li class="nav-item">
        <a class="nav-link link-icon" href="<?php echo site_url('manager/historyReport')?>"><i class="fa fa-clipboard"></i> Histori Laporan</a>
    </li>
</ul>