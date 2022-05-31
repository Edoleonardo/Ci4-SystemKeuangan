<table id="example1" class="table table-bordered table-striped tableasd">
    <thead>
        <tr>
            <th>Nomor Retur</th>
            <th>Jumlah Barang</th>
            <th>Berat Murni</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dataretur as $row) : ?>
            <tr>
                <td><?= $row['no_retur'] ?></td>
                <td><?= $row['jumlah_barang'] ?></td>
                <td><?= $row['total_berat'] ?></td>
                <td>
                    <?php if ($row['status_dokumen'] == 'Draft') : ?>
                        <a type="button" href="draftretur/<?= $row['id_date_retur'] ?>" class="btn btn-block btn-outline-danger btn-sm">Draft</a>
                    <?php else : ?>
                        <a type="button" href="draftretur/<?= $row['id_date_retur'] ?>" class="btn btn-block btn-outline-info btn-sm">Detail</a>
                    <?php endif ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Kode</th>
            <th>Jumlah Barang</th>
            <th>Berat Murni</th>
            <th>Detail</th>
        </tr>
    </tfoot>
</table>
<script>
    function MasukRetur(id) {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('returbarang'); ?>",
            data: {
                idbeli: id,
            },
            beforeSend: function() {
                $(".masukretur").attr('onclick', ' ')
            },
            // complete: function() {
            //     $('.btntambah').html('Tambah')
            // },
            success: function(result) {
                if (result.success) {
                    window.location.href = "/draftretur/" + result.dateid
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }
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