<div class="modal fade" id="modal-modal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Detail Jual</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <section class="content">
                    <div class="row">
                        <div class="col-8">
                            <div class="card" id="card1">
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0" id="card2">
                                    <table class="table table-head-fixed text-nowrap">
                                        <tr>
                                            <td>No Retur :</td>
                                            <td>
                                                <?= $datamasterretur['no_retur'] ?>
                                            </td>
                                            <td>No Transaksi :</td>
                                            <td>
                                                <?= $datamasterretur['no_transaksi'] ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Retur :</td>
                                            <td>
                                                <?= substr($datamasterretur['tanggal_retur'], 0, 10) ?>
                                            </td>
                                            <td>Tanggal Jatuh Tempo :</td>
                                            <td>
                                                <?= substr($datamasterretur['tgl_jatuh_tempo'], 0, 10) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Total Berat :</td>
                                            <td>
                                                <?= $datamasterretur['total_berat_murni'] ?> g
                                            </td>
                                            <td> Bayar Berat Murni :</td>
                                            <td>
                                                <?= $datamasterretur['byr_berat_murni'] ?> g
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Barang :</td>
                                            <td>
                                                <?= $datamasterretur['jumlah_barang'] ?>
                                            </td>
                                            <td>No Faktur :</td>
                                            <td>
                                                <?= $datamasterretur['no_faktur_supp'] ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <div class="col-4">
                            <!-- Application buttons -->
                            <div class="card">
                                <div class="card-body" id="refreshtombol">
                                    <a href="/printnotaretur/<?= $datamasterretur['id_date_retur'] ?>" target="_blank" class="btn btn-app">
                                        <i class="fas fa-print"></i> Print Nota
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
                                    <label>Barang Retur</label>
                                    <div class="card">
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive p-0" style="max-height: 500px;">
                                            <table class="table table-head-fixed text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center;">Gambar</th>
                                                        <th style="text-align: center;">Kode</th>
                                                        <th style="text-align: center;">Jenis</th>
                                                        <th style="text-align: center;">Model</th>
                                                        <th style="text-align: center;">Berat Murni</th>
                                                        <th style="text-align: center;">Status</th>

                                                        <!-- <th>detail</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody id="tblselesairetur">
                                                    <?php foreach ($dataakanretur as $row) : ?>
                                                        <tr id="trselesairetur">
                                                            <td class="imgg"><img class="imgg" src="/img/<?= $row['nama_img'] ?>"></td>
                                                            <td><?= $row['kode'] ?></td>
                                                            <td><?= $row['jenis'] ?></td>
                                                            <td><?= $row['model'] ?></td>
                                                            <td><?= $row['berat_murni'] ?></td>
                                                            <td><?= $row['status_proses'] ?></td>
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