<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Kartu Stock</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Barcode</th>
                                <th style="text-align: center;">Keterangan</th>
                                <th style="text-align: center;">Kadar</th>
                                <th style="text-align: center;">Berat</th>
                                <th style="text-align: center;">Tanggal</th>
                                <th style="text-align: center;">No Faktur</th>
                                <th style="text-align: center;">Nama Customer</th>
                                <th style="text-align: center;">Keluar</th>
                                <th style="text-align: center;">Masuk</th>
                                <th style="text-align: center;">Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $detailkartustock['barcode'] ?></td>
                                <td><?= $detailkartustock['jenis'] ?> <?= $detailkartustock['model'] ?> <?= $detailkartustock['keterangan'] ?></td>
                                <td><?= $detailkartustock['kadar'] ?></td>
                                <td><?= $detailkartustock['berat'] ?></td>
                                <td><?= substr($detailkartustock['created_at'], 0, 10) ?></td>
                                <td><?= $detailkartustock['no_faktur'] ?></td>
                                <td><?= $detailkartustock['nama_customer'] ?></td>
                                <td><?= $detailkartustock['keluar'] ?></td>
                                <td><?= $detailkartustock['masuk'] ?></td>
                                <td><?= $detailkartustock['saldo'] ?></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style=" width: auto;">Barcode</th>
                                <th>Keterangan</th>
                                <th>Kadar</th>
                                <th>Berat</th>
                                <th>Tanggal</th>
                                <th>No Faktur</th>
                                <th>Nama Customer</th>
                                <th>Keluar</th>
                                <th>Masuk</th>
                                <th>Saldo</th>
                            </tr>
                        </tfoot>
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