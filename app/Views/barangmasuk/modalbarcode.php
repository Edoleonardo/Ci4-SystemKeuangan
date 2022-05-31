<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Data Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body table-responsive p-0" style="max-height: 500px;">
                    <table class="table table-head-fixed table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Barcode</th>
                                <th style="text-align: center;">Keterangan</th>
                                <?php if ($kel != 6) : ?>
                                    <?php if ($kel != 5) : ?>
                                        <th style="text-align: center;">Berat</th>
                                    <?php else : ?>
                                        <th style="text-align: center;">Carat</th>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <th style="text-align: center;">Qty</th>
                                <th style="text-align: center;">No Faktur</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($databarcode as $row) : ?>
                                <tr onclick="PilihBarcode(<?= $row['barcode'] ?>)">
                                    <td><?= $row['barcode'] ?></td>
                                    <td><?= $row['jenis'] ?> <?= $row['model'] ?> <?= $row['keterangan'] ?></td>
                                    <?php if (isset($row['berat']) || isset($row['carat'])) : ?>
                                        <td><?= (isset($row['berat'])) ? $row['berat'] : $row['carat'] ?></td>
                                    <?php endif; ?>
                                    <td><?= $row['qty'] ?></td>
                                    <td><?= $row['no_faktur'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
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