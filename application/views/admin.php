<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <title>:: Media Informasi Antrian Cetak Kartu ::</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="<?php echo base_url("asset/js/jquery.js")?>"></script>
    <!--------------------------CSS STYLE------------------------------------->
    <link rel="stylesheet" href="<?php echo base_url("asset/css/bootstrap.min.css")?>"/>
    <link rel="stylesheet" href="<?php echo base_url("asset/plugins/datetimepicker/css/bootstrap-datetimepicker.min.css") ?>"/>
    <link rel="stylesheet" href="<?php echo base_url("asset/plugins/datetimepicker/css/bootstrap-datetimepicker-standalone.css") ?>"/>
    <link rel="stylesheet" href="<?php echo base_url("asset/plugins/datatables/datatables/css/dataTables.bootstrap4.min.css") ?>"/>
    <link rel="stylesheet" href="<?php echo base_url("asset/plugins/datatables/responsive/css/responsive.bootstrap4.min.css") ?>"/>
    <link rel="stylesheet" href="<?php echo base_url("asset/plugins/datatables/fixedheader/css/fixedHeader.bootstrap4.min.css") ?>"/>
    <link rel="stylesheet" href="<?php echo base_url("asset/plugins/select2/css/select2.min.css") ?>"/>
    <link rel="stylesheet" href="<?php echo base_url("asset/css/admin.css")?>"/>
    <link rel="stylesheet" href="<?php echo base_url("asset/css/animate.css")?>"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!--------------------------CSS STYLE------------------------------------->
</head>
<body>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
<!--header-->
<?php echo $header;?>
<!--header-->
<section class="side-left close-side-left"><!--sidebar-->
    <?php echo $sidebar;?>
</section>
<section class="side-right">
    <!--main-->
        <main>
            <div class="container">
                <?php echo $page;?>
            </div>
        </main>
    <!--main-->
    <!--footer-->
        <?php echo $footer;?>
    <!--footer-->
</section>
</body>
<!---bootstrap--->
<script type="text/javascript" src="<?php echo base_url("asset/js/popper.min.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("asset/js/bootstrap.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("asset/js/collapse.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("asset/js/main.js")?>"></script>
<!---bootstrap--->
<!---datetimepicker--->
<script type="text/javascript" src="<?php echo base_url("asset/js/moment-with-locales.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("asset/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js")?>"></script>
<!---datetimepicker--->
<script type="text/javascript" src="<?php echo base_url("asset/plugins/select2/js/select2.min.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("asset/plugins/datatables/datatables/js/jquery.dataTables.min.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("asset/plugins/datatables/datatables/js/dataTables.bootstrap4.min.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("asset/plugins/datatables/responsive/js/dataTables.responsive.min.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("asset/plugins/datatables/responsive/js/responsive.bootstrap4.min.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("asset/plugins/datatables/fixedheader/js/fixedHeader.bootstrap4.min.js")?>"></script>
</html>
