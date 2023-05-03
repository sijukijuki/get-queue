<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html lang="en">
<head>
    <title>:: Sistem Informasi Produksi ::</title>
    <link rel="stylesheet" href="<?php echo base_url("asset/css/bootstrap.css")?>"/>
    <link rel="stylesheet" href="<?php echo base_url("asset/css/login.css")?>"/>
</head>
<body class="container">
<div style="height: 100vh;" class="d-flex justify-content-center align-items-center flex-row">
    <div class="card" style="width: 300px">
        <div class="card-body">
            <h3 class="text-pacifico mb-4 text-center text-warning">Login Please!</h3>
            <?php echo @$error; ?>
            <form class="" method="post" action="<?php echo site_url("login/ceklogin")?>">
                <div class="form-group mb-4">
                    <label for="username">Username</label>
                    <input type="text" class="form-control form-control-sm" autocomplete="off" required placeholder="Username" name="username" id="username">
                </div>
                <div class="form-group mb-4">
                    <label for="password" class="">Password</label>
                    <input type="password" class="form-control form-control-sm" required placeholder="Password" name="password" id="password">
                </div>
                <button type="submit" class="btn btn-yellow btn-sm btn-full">Masuk</button>
            </form>
        </div>
    </div>
    <div id="text" class="text-right ml-auto">
        <h4 class="text-warning"><b>Selamat Datang !</b></h4>
        <h1><b>MEDIA INFORMASI</b></h1>
        <h1><b>ANTRIAN CETAK PRODUKSI</b></h1>
    </div>
</div>
</body>
<script type="text/javascript" src="<?php echo base_url("asset/js/jquery.js")?>"></script>
</html>
