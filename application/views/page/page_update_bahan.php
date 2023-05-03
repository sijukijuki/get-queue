<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$arrayPvcPrint=array("PVC 0.15","PVC 0.2","PVC 0.3");
$arrayPvcTengah=array("PVC TENGAH","PROXIMITY","MIFARE","NO");
$arrayMagnetic=array("YES","NO");
?>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-pencil"></i> Edit Bahan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="POST" action="<?php echo site_url("serverside/updateBahan"); ?>" id="submit">
            <input type="hidden" value="<?php echo $query['id_bahan']?>" name="id"/>
        <div class="modal-body">
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="title">Title Bahan :</label>
                <div class="col-md-8">
                    <input type="text" id="title" value="<?php echo $query['title']?>" name="title" required placeholder="Title Bahan" autocomplete="off" class="form-control form-control-sm">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="pvc_print">PVC Print :</label>
                <div class="col-md-8">
                    <select name="pvc_print" id="pvc_print" required class="custom-select form-control form-control-sm">
                        <?php
                        foreach ($arrayPvcPrint as $data){
                            if ($data==$query['pvc_print']){
                                $selected="selected";
                            }else{
                                $selected=null;
                            }
                            echo "<option $selected value='$data'>$data</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="pvc_tengah">PVC Tengah :</label>
                <div class="col-md-8">
                    <select name="pvc_tengah" id="pvc_tengah" required class="custom-select form-control form-control-sm">
                        <?php
                        foreach ($arrayPvcTengah as $data){
                            if ($data==$query['pvc_tengah']){
                                $selected="selected";
                            }else{
                                $selected=null;
                            }
                            echo "<option $selected value='$data'>$data</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="magnetic">Magnetic :</label>
                <div class="col-md-8">
                    <select name="magnetic" id="magnetic" required class="custom-select form-control form-control-sm">
                        <?php
                        foreach ($arrayMagnetic as $data){
                            if ($data==$query['magnetic']){
                                $selected="selected";
                            }else{
                                $selected=null;
                            }
                            echo "<option $selected value='$data'>$data</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-second btn-sm" data-dismiss="modal">Close</button>
            <button type="submit" id="btn-Process" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Save Data</button>
        </div>
        </form>
    </div>
</div>