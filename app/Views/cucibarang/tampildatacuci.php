<table id="example1" class="table table-bordered table-striped tableasd">
    <thead>
        <tr>
            <th>Nomor Cuci</th>
            <th>Keterangan</th>
            <th>Total Berat</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($datacuci as $row) : ?>
            <tr>
                <td><?= $row['no_cuci'] ?></td>
                <td><?= $row['keterangan'] ?></td>
                <td><?= $row['total_berat'] ?></td>
                <td>
                    <?php if ($row['status_dokumen'] == 'Draft') : ?>
                        <a type="button" href="draftcuci/<?= $row['id_date_cuci'] ?>" class="btn btn-block btn-outline-danger btn-sm">Draft</a>
                    <?php else : ?>
                        <a type="button" href="draftcuci/<?= $row['id_date_cuci'] ?>" class="btn btn-block btn-outline-info btn-sm">Detail</a>
                    <?php endif ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Kode</th>
            <th>Keterangan</th>
            <th>Berat Murni</th>
            <th>Detail</th>
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