<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus-square"></i> Add Report</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="POST" action="<?php echo site_url("serverside/addReport"); ?>" id="submit">
        <div class="modal-body">
            <div class="row form-group">
                <label for="id_so" class="col-2 col-form-label">No. SO</label>
                <div class="col-10">
                    <select class="js-example-basic-single" name="id_so" id="id_so" required></select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <b>Form Laporan Produksi</b>
                    <hr>
                    <div class="row form-group">
                        <label for="tgl_cetak" class="col-md-5 col-form-label">Tanggal Cetak :</label>
                        <div class="col-md-7">
                            <input type="text"  class="form-control-sm form-control" name="tgl_cetak" id="tgl_cetak" required placeholder="" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="tgl_selesai" class="col-md-5 col-form-label">Tanggal Selesai :</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control-sm form-control" name="tgl_selesai" id="tgl_selesai" required placeholder="" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="jml_kerusakan" class="col-md-5 col-form-label">Jumlah Kerusakan :</label>
                        <div class="col-md-7">
                            <input type="number" class="form-control-sm form-control" name="jml_kerusakan" id="jml_kerusakan" required placeholder="" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="jml_kelebihan" class="col-md-5 col-form-label">Jumlah Kelebihan :</label>
                        <div class="col-md-7">
                            <input type="number" class="form-control-sm form-control" name="jml_kelebihan" id="jml_kelebihan" required placeholder="" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="jml_ambil_gudang" class="col-md-5 col-form-label">Ambil Gudang :</label>
                        <div class="col-md-7">
                            <input type="number" class="form-control-sm form-control" name="jml_ambil_gudang" id="jml_ambil_gudang" required placeholder="" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="keterangan" class="col-md-5 col-form-label">Keterangan :</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control-sm form-control" name="keterangan" id="keterangan" required placeholder="" autocomplete="off"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <b>Form Laporan Bahan</b>
                    <hr>
                    <div class="row form-group">
                        <label for="id_bahan" class="col-md-5 col-form-label">Format Bahan :</label>
                        <div class="col-md-7">
                            <select name="id_bahan" required="" class="custom-select form-control-sm form-control">
                                <option disabled="" selected="">-- Pilih Format Bahan --</option>
                                <?php
                                foreach ($formatBahan as $key) {
                                    echo "<option value=$key[id_bahan]>$key[title]</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="jml_pvc_print" class="col-md-5 col-form-label">Jml PVC Print :</label>
                        <div class="col-md-7">
                            <input type="number" class="form-control-sm form-control" name="jml_pvc_print" id="jml_pvc_print" required placeholder="" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="jml_pvc_tengah" class="col-md-5 col-form-label">Jml PVC Tengah :</label>
                        <div class="col-md-7">
                            <input type="number" class="form-control-sm form-control" name="jml_pvc_tengah" id="jml_pvc_tengah" required placeholder="" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="jml_overlay" class="col-md-5 col-form-label">Jml Overlay :</label>
                        <div class="col-md-7">
                            <input type="number" class="form-control-sm form-control" name="jml_overlay" id="jml_overlay" required placeholder="" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="jml_magnetic" class="col-md-5 col-form-label">Jml Magnetic :</label>
                        <div class="col-md-7">
                            <input type="number" class="form-control-sm form-control" name="jml_magnetic" id="jml_magnetic" required placeholder="" autocomplete="off"/>
                        </div>
                    </div>
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
<!---datetimepicker--->
<script type="text/javascript" src="<?php echo base_url("asset/js/moment-with-locales.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("asset/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js")?>"></script>
<!---datetimepicker--->
<script type="text/javascript">
    $(document).ready(function () {
        $("input#tgl_cetak, input#tgl_selesai").datetimepicker({
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
            format:'DD-MM-YYYY'
        });
        $('.js-example-basic-single').select2({
            width:'100%',
            dropdownParent: $('#exampleModal'),
            placeholder:'Input kan No so / nama Customer  ',
            allowClear: true,
            ajax:{
                url:"<?php echo site_url("serverside/jsonsearchOrder")?>",
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