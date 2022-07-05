<table id="example1" class="table table-bordered table-striped tableasd">
    <thead>
        <tr>
            <th>Id Barcode</th>
            <th>Jenis</th>
            <th>model</th>
            <th>Keterangan</th>
            <th>qty</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($barang as $r) : ?>
            <tr>
                <td><?= $r['barcode'] ?></td>
                <td><?= $r['jenis'] ?></td>
                <td><?= $r['model'] ?></td>
                <td><?= $r['keterangan'] ?></td>
                <td><?= $r['qty'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Id Barcode</th>
            <th>Jenis</th>
            <th>model</th>
            <th>Keterangan</th>
            <th>qty</th>
        </tr>
    </tfoot>
</table>


<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "aaSorting": [],
            "buttons": ["copy", "csv", "excel", "pdf", "print", ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>