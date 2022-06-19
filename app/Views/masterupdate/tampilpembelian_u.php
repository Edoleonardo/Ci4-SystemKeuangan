<table id="example1" class="table table-bordered table-striped tableasd">
    <thead>
        <tr>
            <th>Tanggal Faktur</th>
            <th>Kelompok</th>
            <th>Nomor Transaksi</th>
            <th>Tanggal Jatuh Tempo</th>
            <th>Nomor Faktur</th>
            <th>Total Bayar</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($datapembelian as $row) : ?>
            <tr>
                <td><?= date("d-m-Y", strtotime($row['tgl_faktur'])); ?></td>
                <td><?= $row['kelompok'] ?></td>
                <td><a href="#" type="button" onclick="OpenModalDetail('<?= $row['no_transaksi'] ?>')"><?= $row['no_transaksi'] ?></a></td>
                <td><?= date("d-m-Y", strtotime($row['tgl_jatuh_tempo'])) ?></td>
                <td><?= $row['no_faktur_supp'] ?></td>
                <td><?= number_format($row['total_bayar']) ?></td>
                <?php if ($row['cara_pembayaran'] == 'Lunas') : ?>
                    <td>
                        <?= $row['cara_pembayaran'] ?></td>
                    <td>
                    <?php elseif ($row['cara_pembayaran'] == 'Belum Selesai') : ?>
                    <td style="background-color: lightgoldenrodyellow;">
                        <?= $row['cara_pembayaran'] ?></td>
                    <td>
                    <?php else : ?>
                    <td style="background-color: lightcoral;">
                        <?= $row['cara_pembayaran'] ?></td>
                    <td>
                    <?php endif; ?>
                    <a type="button" href="/detailpembelian_u/<?= $row['id_date_pembelian'] ?>" class="btn btn-block btn-outline-danger btn-sm">Update</a>
                    </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Tanggal Faktur</th>
            <th>Kelompok</th>
            <th>Nomor Transaksi</th>
            <th>Tanggal Jatuh Tempo</th>
            <th>Nomor Faktur</th>
            <th>Total Bayar</th>
            <th>Cara Pembayaran</th>
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