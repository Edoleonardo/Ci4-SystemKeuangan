<table id="example1" class="table table-bordered table-striped tableasd">
    <thead>
        <tr>
            <th>Nomor Penjualan</th>
            <th>Tanggal Terjual</th>
            <th>Nomor Hp Customer</th>
            <th>Total Harga</th>
            <th>Pembayaran</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($datapenjualan as $row) : ?>
            <tr>
                <td><a href="#" type="button" onclick="OpenModalDetail('<?= $row['no_transaksi_jual'] ?>')"><?= $row['no_transaksi_jual'] ?></a></td>
                <td><?= date("d-m-Y", strtotime($row['created_at'])); ?></td>
                <td><?= $row['nohp_cust'] ?></td>
                <td><?= number_format($row['total_harga']) ?></td>
                <td><?= $row['pembayaran'] ?></td>
                <td>
                    <?php if ($row['status_dokumen'] == 'Draft') { ?>
                        <a type="button" href="draftpenjualan/<?= $row['id_date_penjualan'] ?>" class="btn btn-block btn-outline-danger btn-sm"><?= $row['status_dokumen'] ?></a>
                        <?php } else {
                        if ($row['status_dokumen'] == 'Retur') :
                        ?>
                            <a type="button" href="/detailpenjualan/<?= $row['id_date_penjualan'] ?>" class="btn btn-block btn-outline-danger btn-sm"><?= $row['status_dokumen'] ?></a>
                        <?php else : ?>
                            <a type="button" href="/detailpenjualan/<?= $row['id_date_penjualan'] ?>" class="btn btn-block btn-outline-info btn-sm">Detail</a>
                    <?php endif;
                    } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Nomor Penjualan</th>
            <th>Tanggal Terjual</th>
            <th>Customer</th>
            <th>Total Harga</th>
            <th>Pembayaran</th>
            <th>Aksi</th>
        </tr>
    </tfoot>
</table>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "aaSorting": []
            //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis", ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>