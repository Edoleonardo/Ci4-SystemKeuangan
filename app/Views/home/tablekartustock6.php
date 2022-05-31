<table id="example1" class="table table-bordered table-striped tableasd">
    <thead id="tbldata">
        <tr>
            <th>Id Barcode</th>
            <th>Total Masuk</th>
            <th>Total Keluar</th>
            <th>Saldo Akhir</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($kartustock as $r) :  ?>
            <tr>
                <td><?= $r['kode'] ?></td>
                <td><?= $r['total_masuk'] ?></td>
                <td><?= $r['total_keluar'] ?></td>
                <td><?= $r['saldo_akhir'] ?></td>
                <td>
                    <a type="button" onclick="openmodal(<?= $r['kode'] ?>)" class="btn btn-block btn-outline-info btn-sm">Detail</a>
                </td>
            </tr>
        <?php
        endforeach;
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Id Barcode</th>
            <th>Total Masuk</th>
            <th>Total Keluar</th>
            <th>Saldo Akhir</th>
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