<div class="modal fade" id="modal-modal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Detail Pembelian</h4>
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
                                    <table class="table table-hover text-nowrap">
                                        <tbody>
                                            <tr>
                                                <td>Supplier</td>
                                                <td><?= $datapembelian['nama_supp'] ?></td>
                                                <input type="hidden" name="date_id" id="date_id" id="<?= $datapembelian['id_date_pembelian'] ?>">
                                            </tr>
                                            <tr>
                                                <td>No Pembayaran</td>
                                                <td><?= $datapembelian['no_transaksi'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Input</td>
                                                <td><?= $datapembelian['created_at'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Nota Supplier</td>
                                                <td><?= $datapembelian['tgl_faktur'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Jatuh Tempo</td>
                                                <td><?= $datapembelian['tgl_jatuh_tempo'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nomor Nota Supplier</td>
                                                <td><?= $datapembelian['no_faktur_supp'] ?></td>
                                            </tr>
                                            <?php if ($datapembelian['kelompok'] == 1) : ?>
                                                <tr>
                                                    <td>Total Berat Murni</td>
                                                    <td><?= $datapembelian['total_berat_murni'] ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <div class="col-sm-6">
                            <!-- Application buttons -->
                            <div id="cardbayar">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
                                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="true">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu" x-placement="bottom-start">
                                                <a class="dropdown-item" href="/printbarcode/<?= $datapembelian['id_date_pembelian'] ?>/A4" target="_blank">A4</a>
                                                <a class="dropdown-item" href="/printbarcode/<?= $datapembelian['id_date_pembelian'] ?>/A3" target="_blank">A3</a>
                                                <a class="dropdown-item" href="/printbarcode/<?= $datapembelian['id_date_pembelian'] ?>/A3+" target="_blank">A3+</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card ">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <br>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card" id="databeli">
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive p-0" style="max-height: 500px;">
                                            <?php if ($datapembelian['kelompok'] == 1) : ?>
                                                <table class="table table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Gambar</th>
                                                            <th>Kode</th>
                                                            <th>Qty</th>
                                                            <th>Jenis</th>
                                                            <th>Model</th>
                                                            <th>Keterangan</th>
                                                            <th>Berat</th>
                                                            <th>Berat Murni</th>
                                                            <th>Harga Beli</th>
                                                            <th>Ongkos</th>
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
                                                                <td><?= $row['jenis'] ?></td>
                                                                <td><?= $row['model'] ?></td>
                                                                <td><?= $row['keterangan'] ?></td>
                                                                <td><?= $row['berat'] ?></td>
                                                                <td><?= $row['berat_murni'] ?></td>
                                                                <td><?= number_format($row['harga_beli'], 2, ",", ".") ?></td>
                                                                <td><?= number_format($row['ongkos'], 2, ",", ".") ?></td>
                                                                <td><?= $row['kadar'] ?></td>
                                                                <td><?= $row['nilai_tukar'] ?></td>
                                                                <td><?= $row['merek'] ?></td>
                                                                <td><?= number_format($row['total_harga'], 2, ",", ".") ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            <?php endif; ?>
                                            <?php if ($datapembelian['kelompok'] == 2) : ?>
                                                <table class="table table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Gambar</th>
                                                            <th>Kode</th>
                                                            <th>Qty</th>
                                                            <th>Jenis</th>
                                                            <th>Model</th>
                                                            <th>Keterangan</th>
                                                            <th>Berat</th>
                                                            <th>Harga Beli</th>
                                                            <th>Ongkos</th>
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
                                                                <td><?= $row['jenis'] ?></td>
                                                                <td><?= $row['model'] ?></td>
                                                                <td><?= $row['keterangan'] ?></td>
                                                                <td><?= $row['berat'] ?></td>
                                                                <td><?= number_format($row['harga_beli'], 2, ",", ".") ?></td>
                                                                <td><?= number_format($row['ongkos'], 2, ",", ".") ?></td>
                                                                <td><?= $row['kadar'] ?></td>
                                                                <td><?= $row['merek'] ?></td>
                                                                <td><?= number_format($row['total_harga'], 2, ",", ".") ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            <?php endif; ?>
                                            <?php if ($datapembelian['kelompok'] == 3) : ?>
                                                <table class="table table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Gambar</th>
                                                            <th>Kode</th>
                                                            <th>Qty</th>
                                                            <th>Jenis</th>
                                                            <th>Model</th>
                                                            <th>Keterangan</th>
                                                            <th>Berat</th>
                                                            <th>Harga Beli</th>
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
                                                                <td><?= $row['jenis'] ?></td>
                                                                <td><?= $row['model'] ?></td>
                                                                <td><?= $row['keterangan'] ?></td>
                                                                <td><?= $row['berat'] ?></td>
                                                                <td><?= number_format($row['harga_beli'], 2, ",", ".") ?></td>
                                                                <td><?= $row['kadar'] ?></td>
                                                                <td><?= $row['merek'] ?></td>
                                                                <td><?= number_format($row['total_harga'], 2, ",", ".") ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            <?php endif; ?>
                                            <?php if ($datapembelian['kelompok'] == 4) : ?>
                                                <table class="table table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Gambar</th>
                                                            <th>Kode</th>
                                                            <th>Qty</th>
                                                            <th>Jenis</th>
                                                            <th>Model</th>
                                                            <th>Keterangan</th>
                                                            <th>Berat</th>
                                                            <th>Harga Beli</th>
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
                                                                <td><?= $row['jenis'] ?></td>
                                                                <td><?= $row['model'] ?></td>
                                                                <td><?= $row['keterangan'] ?></td>
                                                                <td><?= $row['berat'] ?></td>
                                                                <td><?= number_format($row['harga_beli'], 2, ",", ".") ?></td>
                                                                <td><?= $row['kadar'] ?></td>
                                                                <td><?= number_format($row['total_harga'], 2, ",", ".") ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            <?php endif; ?>
                                            <?php if ($datapembelian['kelompok'] == 5) : ?>
                                                <table class="table table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Gambar</th>
                                                            <th>Kode</th>
                                                            <th>Qty</th>
                                                            <th>Jenis</th>
                                                            <th>Model</th>
                                                            <th>Keterangan</th>
                                                            <th>Carat</th>
                                                            <th>Harga Beli</th>
                                                            <th>Total Harga</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($tampildata as $row) : ?>
                                                            <tr>
                                                                <td><img src='/img/<?= $row['nama_img'] ?>' class='imgg'></td>
                                                                <td><?= $row['kode'] ?></td>
                                                                <td><?= $row['qty'] ?></td>
                                                                <td><?= $row['jenis'] ?></td>
                                                                <td><?= $row['model'] ?></td>
                                                                <td><?= $row['keterangan'] ?></td>
                                                                <td><?= $row['carat'] ?></td>
                                                                <td><?= number_format($row['harga_beli'], 2, ",", ".") ?></td>
                                                                <td><?= number_format($row['total_harga'], 2, ",", ".") ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            <?php endif; ?>
                                            <?php if ($datapembelian['kelompok'] == 6) : ?>
                                                <table class="table table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Gambar</th>
                                                            <th>Kode</th>
                                                            <th>Qty</th>
                                                            <th>Jenis</th>
                                                            <th>Model</th>
                                                            <th>Keterangan</th>
                                                            <th>Harga Beli</th>
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
                                                                <td><?= $row['jenis'] ?></td>
                                                                <td><?= $row['model'] ?></td>
                                                                <td><?= $row['keterangan'] ?></td>
                                                                <td><?= number_format($row['harga_beli'], 2, ",", ".") ?></td>
                                                                <td><?= $row['merek'] ?></td>
                                                                <td><?= number_format($row['total_harga'], 2, ",", ".") ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            <?php endif; ?>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
                            <div id="refresharga">
                                <div class="row" id="refreshargaisi">

                                    <div class="col-sm-6">
                                        <div class="card">
                                            <?php if ($databayar) : ?>
                                                <!-- /.card-header -->
                                                <div class="card-body table-responsive p-0" style="max-height: 500px;">
                                                    <table class="table table-hover text-nowrap">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align: center;">Cara Pembayaran</th>
                                                                <th style="text-align: center;">Kode</th>
                                                                <th style="text-align: center;">Jumlah Bayar</th>
                                                                <?php if ($datapembelian['kelompok'] == 5) : ?>
                                                                    <th>Carat</th>
                                                                <?php endif; ?>
                                                                <?php if ($datapembelian['kelompok'] != 5 && $datapembelian['kelompok'] != 6) : ?>
                                                                    <th>Berat</th>
                                                                <?php endif; ?>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($databayar as $byr) : ?>
                                                                <tr>
                                                                    <td style="text-align: center;"> <?= $byr['cara_pembayaran'] ?> </td>
                                                                    <td style="text-align: center;"><?= ($byr['no_retur']) ? $byr['no_retur'] : $byr['kode_24k'] ?></td>
                                                                    <td style="text-align: center;"><?= number_format($byr['jumlah_pembayaran'], 2, ',', '.') ?></td>
                                                                    <?php if ($datapembelian['kelompok'] != 6) : ?>
                                                                        <td style="text-align: center;"><?= number_format($byr['berat_murni'], 2, '.', ',') ?></td>
                                                                    <?php endif; ?>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                    <!-- /.card-body -->
                                                </div>
                                            <?php endif; ?>
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