<table id="example1" class="table table-bordered table-striped tableasd">
    <thead>
        <tr>
            <th>Gambar</th>
            <th>Nomor Lebur</th>
            <th>model</th>
            <th>Berat Murni</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($datalebur as $row) : ?>
            <tr>
                <td class="imgg"><img class="imgg" src="/img/<?= ($row['nama_img']) ? $row['nama_img'] : 'default.jpg' ?>"></td>
                <td><?= $row['no_lebur'] ?></td>
                <td><?= $row['model'] ?></td>
                <td><?= $row['berat_murni'] ?></td>
                <td>
                    <?php if ($row['status_dokumen'] == 'Draft') : ?>
                        <a type="button" href="draftlebur/<?= $row['id_date_lebur'] ?>" class="btn btn-block btn-outline-danger btn-sm">Draft</a>
                    <?php else : ?>
                        <a type="button" href="draftlebur/<?= $row['id_date_lebur'] ?>" class="btn btn-block btn-outline-info btn-sm">Detail</a>
                    <?php endif ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Gambar</th>
            <th>Kode</th>
            <th>model</th>
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