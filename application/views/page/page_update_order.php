<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-pencil-square"></i> Edit Order</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="POST" action="<?php echo site_url("serverside/updateOrder"); ?>" id="submit">
            <div class="modal-body">
                <input type="hidden" name="id" value="<?php echo $query['id_so']; ?>"/>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label" for="id_so">No. SO :</label>
                    <div class="col-md-8">
                        <input type="text" id="no_so" value="<?php echo $query['no_so']; ?>" name="no_so" required placeholder="Nomor Sales Order" autocomplete="off" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label" for="id_customer">Nama Customer :</label>
                    <div class="col-md-8">
                        <select class="js-example-basic-single" name="id_customer" required id="id_customer">
                            <option value="<?php echo $query['id_customer']?>"><?php echo $query['nama_Customer']?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label" for="id_so">Tanggal SO :</label>
                    <div class="col-md-8">
                        <div class="input-group input-group-sm date" id="datetimepicker">
                            <input autocomplete="off" type="input" value="<?php echo servertoLocalDate($query['tgl']); ?>" required class="form-control-sm form-control" name="tgl"/>
                            <span class="input-group-addon">
                                <span><i class="fa fa-calendar-alt"></i></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label" for="id_sales">Nama Sales :</label>
                    <div class="col-md-8">
                        <select name="id_sales" id="id_sales" required class="custom-select form-control form-control-sm">
                            <?php
                            if (empty($nama_Sales)){
                                echo "<option disabled selected>Tidak Ada data</option>";
                            }else{
                                echo "<option disabled selected>-- Pilih Sales --</option>";
                                foreach ($nama_Sales as $data){
                                    if ($data['id_user']==$query['id_user'])
                                    {
                                        $selected="selected";
                                    }else{
                                        $selected=null;
                                    }
                                    echo "<option $selected value=$data[id_user]>$data[nama]</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label" for="qty">QTY :</label>
                    <div class="col-md-8">
                        <input type="number" required class="form-control-sm form-control" value="<?php echo $query['qty']?>" name="qty" id="qty"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label" for="status">Status Order :</label>
                    <div class="col-md-8">
                        <select name="status" id="status" required class="custom-select form-control form-control-sm">
                            <?php
                            $arrayStatus=array("Antri","Crop Foto","Print","Collecting","Press","Plong","Sorting","Finishing","Packing","Reported");
                            foreach ($arrayStatus as $data){
                                if ($data==$query['status'])
                                {
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
                    <label class="col-md-4 col-form-label" for="id_so">Keterangan Order :</label>
                    <div class="col-md-8">
                        <input type="text" id="no_so" value="<?php echo $query['keterangan_order']; ?>" name="keterangan_order" required placeholder="Keterangan Order" autocomplete="off" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label" for="keterangan">Keterangan :</label>
                    <div class="col-md-8">
                        <select name="keterangan" id="keterangan" required class="custom-select form-control form-control-sm">
                            <?php
                            $arrayKeterangan=array("New Customer","Repeat Order","Return");
                            foreach ($arrayKeterangan as $data){
                                if ($data==$query['Keterangan'])
                                {
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
<script type="text/javascript">
    $(document).ready(function () {
        $("#datetimepicker").datetimepicker({
            icons:{
                time: 'far fa-clock',
                date: 'far fa-calendar',
                up: 'fas fa-arrow-up',
                down: 'fas fa-arrow-down',
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right',
                today: 'fas fa-calendar-check',
                clear: 'far fa-trash-alt',
                close: 'far fa-times-circle'
            },
            locale:'id',
            format:'DD-MM-YYYY hh:mm:ss'
        });
        $('.js-example-basic-single').select2({
            width:'100%',
            dropdownParent: $('#exampleModal'),
            placeholder:'-- Pilih Customer --',
            allowClear: true,
            ajax:{
                url:"<?php echo site_url("serverside/jsonSearchCustomer")?>",
                type:'POST',
                dataType:'json',
                data: function (params) {
                    var query = {
                        search: params.term
                    }
                    return query;
                }
            },
            minimumInputLength:2,
        });
    })
</script>