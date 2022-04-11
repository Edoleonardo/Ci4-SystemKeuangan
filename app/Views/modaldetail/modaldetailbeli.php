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
                        <div class="col-6">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <tbody>
                                            <tr>
                                                <td>Supplier</td>
                                                <td><?= $datapembelian['nama_supp'] ?></td>
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
                                            <tr>
                                                <td>Total Berat Murni</td>
                                                <td><?= $datapembelian['total_berat_murni'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <div class="col-6">
                            <!-- Application buttons -->
                            <div id="cardbayar">
                                <div class="card">
                                    <div class="card-body">
                                        <a class="btn btn-app" href="/printbarcode/<?= $datapembelian['id_date_pembelian'] ?>" target="_blank">
                                            <i class="fas fa-barcode"></i> Print Barcode
                                        </a>
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
                                    <div class="card">
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive p-0" style="max-height: 500px;">
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
                                            <!-- /.card-header -->
                                            <div class="card-body p-0">
                                                <table class="table table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <td>Total Berat</td>
                                                            <td><?= number_format($datapembelian['total_berat_rill'], 2, ',', '.') ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Total Berat Murni</td>
                                                            <td><?= number_format($datapembelian['total_berat_murni'], 2, ',', '.') ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <?php if ($databayar) : ?>
                                                <!-- /.card-header -->
                                                <div class="card-body table-responsive p-0" style="max-height: 500px;">
                                                    <table class="table table-hover text-nowrap">
                                                        <thead>
                                                            <tr>
                                                                <th>Cara Pembayaran</th>
                                                                <th style="text-align: center;">Kode</th>
                                                                <th>Jumlah Bayar</th>
                                                                <th>Berat Murni</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($databayar as $byr) : ?>
                                                                <tr>
                                                                    <td> <?= $byr['cara_pembayaran'] ?> </td>
                                                                    <td><?= ($byr['no_retur']) ? $byr['no_retur'] : $byr['kode_24k'] ?></td>
                                                                    <td><?= number_format($byr['jumlah_pembayaran'], 2, ',', '.') ?></td>
                                                                    <td><?= $byr['berat_murni'] ?></td>
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