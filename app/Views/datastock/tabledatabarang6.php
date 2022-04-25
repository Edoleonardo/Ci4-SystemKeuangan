<table id="example1" class="table table-bordered table-striped tableasd">
    <thead>
        <tr>
            <th>Gambar</th>
            <th>Id Barcode</th>
            <th>Jenis</th>
            <th>model</th>
            <th>qty</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($barang as $r) : ?>
            <tr>
                <td class="imgg"><img class="imgg" src="/img/<?= $r['gambar'] ?>" alt=""></td>
                <td><?= $r['barcode'] ?></td>
                <td><?= $r['jenis'] ?></td>
                <td><?= $r['model'] ?></td>
                <td><?= $r['qty'] ?></td>
                <td>
                    <a type="button" href="/detail/<?= $r['id_stock_6'] ?>/6" class="btn btn-block btn-outline-info btn-sm">Detail</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Gambar</th>
            <th>Id Barcode</th>
            <th>Jenis</th>
            <th>model</th>
            <th>qty</th>
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