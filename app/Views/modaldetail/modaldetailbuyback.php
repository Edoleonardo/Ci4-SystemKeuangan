<div class="modal fade" id="modal-modal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Detail Buyback</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <section class="content">
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <?php if ($databuyback['status_dokumen'] == 'Draft') : ?>
                                    <div class="form-group" style="margin: 1mm;">
                                        <div class="input-group input-group-sm">
                                            <a class="btn btn-app" data-toggle="modal" data-target="#modal-nonota">
                                                <i class="fas fa-plus"></i> Tanpa Nota
                                            </a>
                                            <a class="btn btn-app" data-toggle="modal" data-target="#modal-nota">
                                                <i class="fas fa-plus"></i> Dengan Nota
                                            </a>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <tbody>
                                                <tr>
                                                    <td>No Buyback</td>
                                                    <td><?= $databuyback['no_transaksi_buyback'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Input</td>
                                                    <td><?= $databuyback['created_at'] ?></td>
                                                </tr>


                                            </tbody>
                                        </table>
                                        <!-- /.card-body -->
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                    <div class="container-fluid">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <!-- /.card-header -->
                                            <div class="card-body table-responsive p-0" style="max-height: 500px;">
                                                <table class="table table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Gambar</th>
                                                            <th>Kode</th>
                                                            <th>Qty</th>
                                                            <th>Harga Beli</th>
                                                            <th>Keterangan</th>
                                                            <th>Berat</th>
                                                            <th>Kadar</th>
                                                            <th>Nilai Tukar</th>
                                                            <th>Merek</th>
                                                            <th>Total Harga</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($tampildata as $row) : ?>
                                                            <tr>
                                                                <td><img src='/img/<?= $row['nama_img'] ?>' class='imgg'></td>
                                                                <td><?= $row['kode'] ?></td>
                                                                <td><?= $row['qty'] ?></td>
                                                                <td><?= number_format($row['harga_beli'], 2, ',', '.')  ?></td>
                                                                <td><?= $row['jenis'] ?> <?= $row['model'] ?> <?= $row['keterangan'] ?> (<?= $row['no_nota'] ?>, <?= $row['status_proses'] ?>)</td>
                                                                <td><?= $row['berat'] ?></td>
                                                                <td><?= $row['kadar'] ?></td>
                                                                <td><?= $row['nilai_tukar'] ?></td>
                                                                <td><?= $row['merek'] ?></td>
                                                                <td><?= number_format($row['total_harga'], 2, ',', '.') ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <!-- /.card-header -->
                                            <div class="card-body p-0">
                                                <table class="table table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <td>Total Berat</td>
                                                            <td><?= $databuyback['total_berat'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Total Harga</td>
                                                            <td><?= number_format($databuyback['total_harga'], 2, ',', '.') ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <!-- /.card-header -->
                                            <div class="card-body p-0" id="refreshpembayaran">

                                                <table class="table table-striped">
                                                    <tbody>
                                                        <?php if (isset($databuyback)) : ?>
                                                            <tr>
                                                                <td>Metode Pembayaran</td>
                                                                <td><?= $databuyback['pembayaran'] ?></td>
                                                            </tr>
                                                            <?php if ($databuyback['nama_bank']) : ?>
                                                                <tr>
                                                                    <td>Nama Bank</td>
                                                                    <td><?= $databuyback['nama_bank'] ?></td>
                                                                </tr>
                                                            <?php endif ?>
                                                            <?php if ($databuyback['tunai']) : ?>
                                                                <tr>
                                                                    <td>Tunai</td>
                                                                    <td><?= number_format($databuyback['tunai'], 2, ',', '.') ?></td>
                                                                </tr>
                                                            <?php endif ?>
                                                            <?php if ($databuyback['transfer']) : ?>
                                                                <tr>
                                                                    <td>Transfer</td>
                                                                    <td><?= number_format($databuyback['transfer'], 2, ',', '.') ?></td>
                                                                </tr>
                                                            <?php endif ?>
                                                        <?php endif ?>

                                                    </tbody>
                                                </table>
                                                <!-- /.card-body -->
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </section>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary btntambah" data-dismiss="modal">Selesai</button>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>