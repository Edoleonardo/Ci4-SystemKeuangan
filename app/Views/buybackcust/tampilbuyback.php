<table id="example1" class="table table-bordered table-striped tableasd">
    <thead>
        <tr>
            <th>Nomor Buyback</th>
            <th>Tanggal Buyback</th>
            <th>Kelompok</th>
            <th>Total Harga</th>
            <th>Pembayaran</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($databuyback as $row) : ?>
            <tr ondblclick="OpenModelEdit('<?= $row['no_transaksi_buyback'] ?>','<?= date('Y-m-d', strtotime($row['created_at'])) ?>')">
                <td><a href="#" type="button" onclick="OpenModalDetail('<?= $row['no_transaksi_buyback'] ?>')"><?= $row['no_transaksi_buyback'] ?></a></td>
                <td><?= date("d-m-Y", strtotime($row['created_at'])); ?></td>
                <td><?= $row['kelompok'] ?></td>
                <td><?= number_format($row['total_harga']) ?></td>
                <td><?= $row['pembayaran'] ?></td>
                <td>
                    <?php if ($row['status_dokumen'] == 'Draft') { ?>
                        <a type="button" href="draftbuyback/<?= $row['id_date_buyback'] ?>" class="btn btn-block btn-outline-danger btn-sm"><?= $row['status_dokumen'] ?></a>
                    <?php } else { ?>
                        <a type="button" href="/draftbuyback/<?= $row['id_date_buyback'] ?>" class="btn btn-block btn-outline-info btn-sm">Detail</a>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Nomor Buyback</th>
            <th>Tanggal Buyback</th>
            <th>Kelompok</th>
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