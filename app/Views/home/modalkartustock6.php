<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="title" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body table-responsive p-0" style="max-height: 500px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Keterangan</th>
                                <th style="text-align: center;">Tanggal</th>
                                <th style="text-align: center;">No Faktur</th>
                                <th style="text-align: center;">Nama Customer</th>
                                <th style="text-align: center;">Keluar</th>
                                <th style="text-align: center;">Masuk</th>
                                <th style="text-align: center;">Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detailkartustock as $row) : ?>
                                <tr>
                                    <td><?= $row['jenis'] ?> <?= $row['model'] ?> <?= $row['keterangan'] ?></td>
                                    <td><?= substr($row['created_at'], 0, 10) ?></td>
                                    <td><a href="#" type="button" onclick="OpenModalDetail('<?= $row['no_faktur'] ?>')"><?= $row['no_faktur'] ?></a></td>
                                    <td><?= $row['nama_customer'] ?></td>
                                    <td><?= $row['keluar'] ?></td>
                                    <td><?= $row['masuk'] ?></td>
                                    <td><?= $row['saldo'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class=" modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div id="openmodaldetail"></div>
<script>
    function OpenModalDetail(no_id) {
        $.ajax({
            type: "get",
            url: "<?php echo base_url('modaldetail'); ?>",
            dataType: "json",
            data: {
                no_id: no_id
            },
            success: function(result) {
                if (result.error) {
                    console.log(result.error);
                } else {
                    $('#openmodaldetail').html(result.modaldetail)
                    $('#modal-modal').modal('toggle')
                }


            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }
</script>