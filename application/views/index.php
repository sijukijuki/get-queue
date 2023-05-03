<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$link=file_get_contents(site_url("utama/getAds"));
$link2=file_get_contents(site_url("utama/gettable"));
$getJSONads=json_decode($link,TRUE);
$getJSONtable=json_decode($link2,TRUE);
$getJSONads=$getJSONads["value"];
$getJSONtable=$getJSONtable["value"];
?>
<html lang="en">
<head>
    <title>:: Media Informasi Antrian Cetak ::</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="<?php echo base_url("asset/js/jquery.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("asset/js/popper.min.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("asset/js/bootstrap.min.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("asset/js/index.min.js")?>"></script>
    <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous"-->
    <link rel="stylesheet" href="<?php echo base_url("asset/css/bootstrap.min.css")?>"/>
    <link rel="stylesheet" href="<?php echo base_url("asset/css/animate.css")?>"/>
    <link rel="stylesheet" href="<?php echo base_url("asset/css/index.min.css")?>"/>
</head>
<body id="bg-body">
<div id="header" class="bg-blue-opacity mt-3">
    <div class="container-fluid d-flex align-items-center">
        <img class="float-left" src="<?php echo base_url("asset/images/logo-1.png") ?>" width="25%">
        <div class="float-right ml-auto text-center section-time bg-blue">
            <h2 id="time" class="text-warning">sdfsdf</h2>
            <p id="date" class="text-white">dfsdf</p>
        </div>
        <div style="clear: both"></div>
    </div>
</div>
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <table class="header shadow">
                        <thead>
                        <tr><th colspan="6">PRODUKSI HARI INI</th></tr>
                        <tr>
                            <th width="7%" class="text-center">NO</th>
                            <th width="53%" class="text-center">NAMA CUSTOMER</th>
                            <th width="12%" class="text-center">QTY</th>
                            <th width="16%" class="text-center">TGL ORDER</th>
                            <th width="12%" class="text-center">STATUS</th>
                        </tr>
                        </thead>
                    </table>
                    <div id="table-content">
                        <table class="table table-striped" id='tableisi'>
                            <tbody id="tbody">
                            <?php
                            for ($id=0;$id<count($getJSONtable);$id++)
                            {
                                if ($id==0){
                                    $active="active";
                                }else{
                                    $active=null;
                                }
                                $no=$id+1;
                                echo '
                                                       <tr class="$active" id="table">
                                                            <td class="text-center" width="7%" >'.$no.'</td>
                                                            <td width="53%">'.$getJSONtable[$id]["nama_Customer"].'<br><i><small>Ket : '.$getJSONtable[$id]["keterangan_order"].'</small></i></td>
                                                            <td class="text-center" width="12%">'.number_format($getJSONtable[$id]["qty"]).' Pcs</td>
                                                            <td class="text-center" width="16%">'.$getJSONtable[$id]["tgl"].'</td>
                                                            <td class="text-center"  width="12%">'.colorStatusOrder($getJSONtable[$id]["status"]).'</td>
                                                       </tr>
                                                    ';
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow mb-2">
                <div class="card-body">
                    <div class="image-inner" id="image-inner">
                        <?php
                        for ($id=0;$id<count($getJSONtable);$id++) {
                            if ($id==0){
                                $active=" active-image";
                            }else{
                                $active=null;
                            }
                            echo '
                                    <div class="image-item'.$active.'" id="image-item">
                                        <img class="d-block img-fluid w-100" src="'.base_url("asset/images/desain_customer/".$getJSONtable[$id]['images']."").'" alt="">
                                    </div>
                                ';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div id="caraousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    for ($id=0;$id<count($getJSONads);$id++)
                    {
                        if ($id==0){
                            $active=" active";
                        }else{
                            $active=null;
                        }
                        echo '
                                    <div class="carousel-item'.$active.'">
                                        <img class="d-block img-fluid w-100" src='.base_url("asset/images/desain_banner/".$getJSONads[$id]['link']."").' alt="">
                                    </div>
                                ';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    <div class="container-fluid">
        <marquee>SELAMAT DATANG DI CETAKIDCARD.CO.ID | lihat juga di website kami lainya : cetakidcardsurabaya.com </marquee>
    </div>
</div>
</body>
</html>