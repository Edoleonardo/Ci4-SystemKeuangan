<table id="example1" class="table table-bordered table-striped tableasd">
    <thead>
        <tr>
            <th>Id Barcode</th>
            <th>Jenis</th>
            <th>Keterangan</th>
            <th>model</th>
            <th>qty</th>
            <th>Berat</th>
            <th>kadar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dataopname as $r) : ?>
            <tr>
                <td><?= $r['barcode'] ?></td>
                <td><?= $r['jenis'] ?></td>
                <td><?= $r['keterangan'] ?></td>
                <td><?= $r['model'] ?></td>
                <td><?= $r['qty'] ?></td>
                <td><?= $r['berat'] ?></td>
                <td><?= $r['kadar'] ?></td>
                <td>
                    <?php if (isset($r['id_stock'])) : ?>
                        <a type="button" class="btn btn-block btn-outline-info btn-sm" href="#" onclick="OpenModal(<?= (isset($r['id_stock'])) ? $r['id_stock'] : '' ?>)">Detail</a>
                    <?php else : ?>
                        <a type="button" class="btn btn-block btn-outline-danger btn-sm" href="#" onclick="DeleteOpname(<?= (isset($r['id_stock_opname'])) ? $r['id_stock_opname'] : '' ?>)">Delete</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Id Barcode</th>
            <th>Jenis</th>
            <th>Keterangan</th>
            <th>model</th>
            <th>qty</th>
            <th>Berat</th>
            <th>kadar</th>
            <th>Aksi</th>
        </tr>
    </tfoot>
</table>


<script>
    function OpenModal(no_id) {
        $.ajax({
            type: "get",
            url: "<?php echo base_url('modaldetailopname'); ?>",
            dataType: "json",
            data: {
                no_id: no_id
            },
            success: function(result) {
                if (result.error) {
                    console.log(result.error);
                } else {
                    $('#openmodaldetail').html(result.tampilmodal)
                    $('#modal-modal').modal('toggle')
                }


            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function DeleteOpname(id) {
        $.ajax({
            type: "get",
            url: "<?php echo base_url('hapusopname'); ?>",
            dataType: "json",
            data: {
                iddetail: id
            },
            success: function(result) {
                tampildata()
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil Di Hapus',
                })
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