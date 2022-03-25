<div class="modal fade" id="modal-retur">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Retur</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body table-responsive p-0">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Barcode</th>
                                <th style="text-align: center;">Jenis</th>
                                <th style="text-align: center;">Model</th>
                                <th style="text-align: center;">Keterangan</th>
                                <th style="text-align: center;">Merek</th>
                                <th style="text-align: center;">Qty</th>
                                <th style="text-align: center;">Berat</th>
                                <th style="text-align: center;">Harga Beli</th>
                                <th style="text-align: center;">Kadar</th>
                                <th style="text-align: center;">Nilai Tukar</th>
                                <th style="text-align: center;">Total Harga</th>
                                <th style="text-align: center;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataretur as $row) : ?>
                                <tr>
                                    <td><?= $row['kode'] ?></td>
                                    <td><?= $row['jenis'] ?></td>
                                    <td><?= $row['model'] ?></td>
                                    <td><?= $row['keterangan'] ?></td>
                                    <td><?= $row['merek'] ?></td>
                                    <td><?= $row['qty'] ?></td>
                                    <td><?= $row['berat'] ?></td>
                                    <td><?= $row['harga_beli'] ?></td>
                                    <td><?= $row['kadar'] ?></td>
                                    <td><?= $row['nilai_tukar'] ?></td>
                                    <td><?= $row['total_harga'] ?></td>
                                    <td><?= $row['status_proses'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="text-align: center;">Barcode</th>
                                <th style="text-align: center;">Jenis</th>
                                <th style="text-align: center;">Model</th>
                                <th style="text-align: center;">Keterangan</th>
                                <th style="text-align: center;">Merek</th>
                                <th style="text-align: center;">Qty</th>
                                <th style="text-align: center;">Berat</th>
                                <th style="text-align: center;">Harga Beli</th>
                                <th style="text-align: center;">Kadar</th>
                                <th style="text-align: center;">Nilai Tukar</th>
                                <th style="text-align: center;">Total Harga</th>
                                <th style="text-align: center;">Status</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "aaSorting": [],
            "buttons": ["copy", "csv", {
                extend: "excel",
                messageTop: '<?= $pesan ?>'
            }, "pdf", "print", "colvis", ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>