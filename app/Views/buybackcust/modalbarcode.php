<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Emas LM</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body table-responsive p-0" style="max-height:500px;">
                    <?php if ($kel == 5) : ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">Barcode</th>
                                    <th style="text-align: center;">Keterangan</th>
                                    <th style="text-align: center;">Qty</th>
                                    <th style="text-align: center;">Carat</th>
                                    <th style="text-align: center;">No Faktur</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($databarcode as $row) : ?>
                                    <tr onclick="PilihBarcode(<?= $row['barcode'] ?>)">
                                        <td><?= $row['barcode'] ?></td>
                                        <td><?= $row['jenis'] ?> <?= $row['model'] ?> <?= $row['keterangan'] ?></td>
                                        <td><?= $row['qty'] ?></td>
                                        <td><?= $row['carat'] ?></td>
                                        <td><?= $row['no_faktur'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="text-align: center;">Barcode</th>
                                    <th style="text-align: center;">Keterangan</th>
                                    <th style="text-align: center;">Kadar</th>
                                    <th style="text-align: center;">Carat</th>
                                    <th style="text-align: center;">No Faktur</th>
                                </tr>
                            </tfoot>
                        </table>
                    <?php elseif ($kel == 6) : ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">Barcode</th>
                                    <th style="text-align: center;">Keterangan</th>
                                    <th style="text-align: center;">Qty</th>
                                    <th style="text-align: center;">No Faktur</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($databarcode as $row) : ?>
                                    <tr onclick="PilihBarcode(<?= $row['barcode'] ?>)">
                                        <td><?= $row['barcode'] ?></td>
                                        <td><?= $row['jenis'] ?> <?= $row['model'] ?> <?= $row['keterangan'] ?></td>
                                        <td><?= $row['qty'] ?></td>
                                        <td><?= $row['no_faktur'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="text-align: center;">Barcode</th>
                                    <th style="text-align: center;">Keterangan</th>
                                    <th style="text-align: center;">Kadar</th>
                                    <th style="text-align: center;">No Faktur</th>
                                </tr>
                            </tfoot>
                        </table>
                    <?php else : ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">Barcode</th>
                                    <th style="text-align: center;">Keterangan</th>
                                    <th style="text-align: center;">Qty</th>
                                    <th style="text-align: center;">Berat</th>
                                    <th style="text-align: center;">No Faktur</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($databarcode as $row) : ?>
                                    <tr onclick="PilihBarcode(<?= $row['barcode'] ?>)">
                                        <td><?= $row['barcode'] ?></td>
                                        <td><?= $row['jenis'] ?> <?= $row['model'] ?> <?= $row['keterangan'] ?></td>
                                        <td><?= $row['qty'] ?></td>
                                        <td><?= $row['berat'] ?></td>
                                        <td><?= $row['no_faktur'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="text-align: center;">Barcode</th>
                                    <th style="text-align: center;">Keterangan</th>
                                    <th style="text-align: center;">Kadar</th>
                                    <th style="text-align: center;">Berat</th>
                                    <th style="text-align: center;">No Faktur</th>
                                </tr>
                            </tfoot>
                        </table>
                    <?php endif; ?>

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