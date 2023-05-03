<table class="table table-hover table-stripped" id="table">
    <thead>
    <tr>
        <th>No</th>
        <th>Nama Customer</th>
        <th>Cetak</th>
        <th>Kerusakan</th>
        <th>Kelebihan</th>
        <th>Total</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
        <?php
        $no=1;
        $totalQTY=0;
        $totalJmlKerusakan=0;
        $totalJmlKelebihan=0;
        if (empty($query)) {
            echo "<tr><td colspan='8' class='text-center'><i>empty data</i></td></tr>";
        } else {
            foreach ($query as $key) {
                echo "
                <tr>
                <td>".$no."</td>
                <td>$key[nama_customer]</td>
                <td>".number_format($key['qty'])."</td>
                <td>".number_format($key['jml_kerusakan'])."</td>
                <td>".number_format($key['jml_kelebihan'])."</td>
                <td>".number_format(intval($key['qty']+$key['jml_kerusakan']+$key['jml_kelebihan']))."</td>
                <td>".colorStatusMessage($key['status_report'])."</td>
                <td>
                    <div class='btn-group btn-group-sm '>
                    <a href=".site_url('serverside/detailReport/'.$key['id_laporan_produksi'])." class='btn btn-primary btn-sm' id='buttonModal'><i class='fa fa-eye'></i></a>";
                    if ($_SESSION['tipe_user']=='Produksi') {
                        echo "<a href=".site_url('produksi/updateReport/'.$key['id_laporan_produksi'])." class='btn btn-warning btn-sm' id='buttonModal'><i class='fa fa-pencil-alt text-white'></i></a>";
                    }
                    echo "
                    </div>
                </td>
                </tr>
                ";
                $no++;
                $totalQTY+=$key['qty'];
                $totalJmlKerusakan+=$key['jml_kerusakan'];
                $totalJmlKelebihan+=$key['jml_kelebihan'];
            }
        }
        ?>
    </tbody>
    <tfoot >
        <tr>
            <th colspan="2">Grand Total</th>
            <th><?php echo number_format($totalQTY) ?></th>
            <th><?php echo number_format($totalJmlKerusakan) ?></th>
            <th><?php echo number_format($totalJmlKelebihan) ?></th>
            <th><?php echo number_format($totalQTY+$totalJmlKerusakan+$totalJmlKelebihan) ?></th>
            <th></th>
        </tr>
    </tfoot>
</table>