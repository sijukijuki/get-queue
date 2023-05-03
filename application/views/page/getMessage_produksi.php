<table class="table table-hover table-stripped" id="table">
    <thead>
    <tr>
        <th>No</th>
        <th>No SO</th>
        <th>Nama Customer</th>
        <th>Cetak</th>
        <th>Sales</th>
        <th>Status Report</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $no=1;
    if (empty($query)) {
        echo "<tr ><td colspan='8' class='text-center'><i>empty data</i></td></tr>";
    } else {
        foreach ($query as $key) {
            echo "
                <tr>
                <td>".$no."</td>
                <td>$key[no_so]</td>
                <td>$key[nama_customer]</td>
                <td>$key[qty]</td>
                <td>$key[nama]</td>
                <td>".colorStatusMessage($key['status_report'])."</td>
                <td><a href=".site_url('produksi/detailMessage_produksi/'.$key['id_laporan_produksi'])." id='buttonModal' class='btn btn-primary btn-sm'><i class='fa fa-eye'></i></a></td>
                </tr>
                ";
            $no++;
        }
    }
    ?>
    </tbody>
    <tfoot>
    <tr>
        <th>No</th>
        <th>No SO</th>
        <th>Nama Customer</th>
        <th>Cetak</th>
        <th>Sales</th>
        <th>Status Report</th>
        <th>Action</th>
    </tr>
    </tfoot>
</table>