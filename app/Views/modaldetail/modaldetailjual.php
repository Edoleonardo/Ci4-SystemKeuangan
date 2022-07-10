<div class="modal fade" id="modal-modal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Detail Jual <?= $datapenjualan['no_transaksi_jual'] ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <section class="content">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    Nama Customer : <?= (isset($datacust['nama'])) ? $datacust['nama'] : 'NoData' ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    No Hp : <?= (isset($datacust['nohp_cust']) ? $datacust['nohp_cust'] : 'NoData') ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Tanggal Beli : <?= substr($datapenjualan['updated_at'], 0, 10) ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <div class="col-sm-6">
                            <!-- Application buttons -->
                            <div class="card" id="card1">
                                <div class="card-body" id="card2">
                                    <a class="btn btn-app" target="_blank" href="/printinvoice/<?= $datapenjualan['id_date_penjualan'] ?>" target="_blank">
                                        <i class="fas fa-print"></i> Print Invoce
                                    </a>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                    <div class="card ">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <br>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive p-0" style="max-height: 500px;">
                                            <?php if ($datapenjualan['kelompok'] == 1) : ?>
                                                <table class="table table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Gambar</th>
                                                            <th>Kode</th>
                                                            <th>Qty</th>
                                                            <th>Harga Jual</th>
                                                            <th>Ongkos</th>
                                                            <th>Jenis</th>
                                                            <th>Model</th>
                                                            <th>Keterangan</th>
                                                            <th>Berat</th>
                                                            <th>Berat Murni</th>
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
                                                                <td><?= number_format($row['harga_beli'], 2, ',', '.') ?></td>
                                                                <td><?= number_format($row['ongkos'], 2, ',', '.') ?></td>
                                                                <td><?= $row['jenis'] ?></td>
                                                                <td><?= $row['model'] ?></td>
                                                                <td><?= $row['keterangan'] ?></td>
                                                                <td><?= $row['berat'] ?></td>
                                                                <td><?= $row['berat_murni'] ?></td>
                                                                <td><?= $row['kadar'] ?></td>
                                                                <td><?= $row['nilai_tukar'] ?></td>
                                                                <td><?= $row['merek'] ?></td>
                                                                <td><?= number_format($row['total_harga'], 2, ',', '.') ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            <?php elseif ($datapenjualan['kelompok'] == 2) : ?>
                                                <table class="table table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Gambar</th>
                                                            <th>Kode</th>
                                                            <th>Qty</th>
                                                            <th>Harga Jual</th>
                                                            <th>Jenis</th>
                                                            <th>Model</th>
                                                            <th>Keterangan</th>
                                                            <th>Berat</th>
                                                            <th>Kadar</th>
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
                                                                <td><?= number_format($row['harga_beli'], 2, ',', '.') ?></td>
                                                                <td><?= $row['jenis'] ?></td>
                                                                <td><?= $row['model'] ?></td>
                                                                <td><?= $row['keterangan'] ?></td>
                                                                <td><?= $row['berat'] ?></td>
                                                                <td><?= $row['kadar'] ?></td>
                                                                <td><?= $row['merek'] ?></td>
                                                                <td><?= number_format($row['total_harga'], 2, ',', '.') ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            <?php elseif ($datapenjualan['kelompok'] == 3) : ?>
                                                <table class="table table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Gambar</th>
                                                            <th>Kode</th>
                                                            <th>Qty</th>
                                                            <th>Harga Jual</th>
                                                            <th>Jenis</th>
                                                            <th>Model</th>
                                                            <th>Keterangan</th>
                                                            <th>Berat</th>
                                                            <th>Kadar</th>
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
                                                                <td><?= number_format($row['harga_beli'], 2, ',', '.') ?></td>
                                                                <td><?= $row['jenis'] ?></td>
                                                                <td><?= $row['model'] ?></td>
                                                                <td><?= $row['keterangan'] ?></td>
                                                                <td><?= $row['berat'] ?></td>
                                                                <td><?= $row['kadar'] ?></td>
                                                                <td><?= $row['merek'] ?></td>
                                                                <td><?= number_format($row['total_harga'], 2, ',', '.') ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            <?php elseif ($datapenjualan['kelompok'] == 4) : ?>
                                                <table class="table table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Gambar</th>
                                                            <th>Kode</th>
                                                            <th>Qty</th>
                                                            <th>Harga Jual</th>
                                                            <th>Jenis</th>
                                                            <th>Model</th>
                                                            <th>Keterangan</th>
                                                            <th>Berat</th>
                                                            <th>Kadar</th>
                                                            <th>Total Harga</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($tampildata as $row) : ?>
                                                            <tr>
                                                                <td><img src='/img/<?= $row['nama_img'] ?>' class='imgg'></td>
                                                                <td><?= $row['kode'] ?></td>
                                                                <td><?= $row['qty'] ?></td>
                                                                <td><?= number_format($row['harga_beli'], 2, ',', '.') ?></td>
                                                                <td><?= $row['jenis'] ?></td>
                                                                <td><?= $row['model'] ?></td>
                                                                <td><?= $row['keterangan'] ?></td>
                                                                <td><?= $row['berat'] ?></td>
                                                                <td><?= $row['kadar'] ?></td>
                                                                <td><?= number_format($row['total_harga'], 2, ',', '.') ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            <?php elseif ($datapenjualan['kelompok'] == 5) : ?>
                                                <table class="table table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Gambar</th>
                                                            <th>Kode</th>
                                                            <th>Qty</th>
                                                            <th>Harga Jual</th>
                                                            <th>Jenis</th>
                                                            <th>Model</th>
                                                            <th>Keterangan</th>
                                                            <th>Carat</th>
                                                            <th>Total Harga</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($tampildata as $row) : ?>
                                                            <tr>
                                                                <td><img src='/img/<?= $row['nama_img'] ?>' class='imgg'></td>
                                                                <td><?= $row['kode'] ?></td>
                                                                <td><?= $row['qty'] ?></td>
                                                                <td><?= number_format($row['harga_beli'], 2, ',', '.') ?></td>
                                                                <td><?= $row['jenis'] ?></td>
                                                                <td><?= $row['model'] ?></td>
                                                                <td><?= $row['keterangan'] ?></td>
                                                                <td><?= $row['carat'] ?></td>
                                                                <td><?= number_format($row['total_harga'], 2, ',', '.') ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            <?php elseif ($datapenjualan['kelompok'] == 6) : ?>
                                                <table class="table table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Gambar</th>
                                                            <th>Kode</th>
                                                            <th>Qty</th>
                                                            <th>Harga Jual</th>
                                                            <th>Jenis</th>
                                                            <th>Model</th>
                                                            <th>Keterangan</th>
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
                                                                <td><?= number_format($row['harga_beli'], 2, ',', '.') ?></td>
                                                                <td><?= $row['jenis'] ?></td>
                                                                <td><?= $row['model'] ?></td>
                                                                <td><?= $row['keterangan'] ?></td>
                                                                <td><?= $row['merek'] ?></td>
                                                                <td><?= number_format($row['total_harga'], 2, ',', '.') ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            <?php endif ?>
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
                                        <div class="card-body p-0" id="total1">
                                            <table class="table table-striped" id="total2">
                                                <tbody>
                                                    <tr>
                                                        <td>Total Harga</td>
                                                        <td><?= number_format($datapenjualan['total_harga'], 0, ',', '.') ?></td>
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
                                        <div class="card-body p-0" id="card11">
                                            <table class="table table-striped" id="card22">
                                                <tbody>
                                                    <?php if (isset($datapenjualan)) : ?>
                                                        <?php if ($datapenjualan['pembulatan']) : ?>
                                                            <tr>
                                                                <td>Pembulatan</td>
                                                                <td><?= number_format($datapenjualan['pembulatan'], 2, ",", ".") ?></td>
                                                            </tr>
                                                        <?php endif ?>
                                                        <?php if ($datapenjualan['tunai']) : ?>
                                                            <tr>
                                                                <td>Tunai</td>
                                                                <td><?= number_format($datapenjualan['tunai'], 2, ',', '.') ?></td>
                                                            </tr>
                                                        <?php endif ?>
                                                        <?php if ($datapenjualan['debitcc']) : ?>
                                                            <tr>
                                                                <td>Debit / CC <?= ($datapenjualan['charge']) ? '(' . $datapenjualan['charge'] . ')' : '' ?> </td>
                                                                <td><?= number_format($datapenjualan['debitcc'], 2, ',', '.') ?> (<?= $datapenjualan['bank_debitcc'] ?>)</td>
                                                            </tr>
                                                        <?php endif ?>
                                                        <?php if ($datapenjualan['transfer']) : ?>
                                                            <tr>
                                                                <td>Transfer</td>
                                                                <td><?= number_format($datapenjualan['transfer'], 2, ',', '.') ?> (<?= $datapenjualan['bank_transfer'] ?>)</td>
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