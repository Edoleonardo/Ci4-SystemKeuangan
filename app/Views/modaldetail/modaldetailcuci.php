<div class="modal fade" id="modal-modal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Detail Cuci</h4>
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
                                <div class="table-responsive" id="tblcard">
                                    <table class="table text-nowrap" id="tblheader">
                                        <tr>
                                            <td>Tanggal Cuci :</td>
                                            <td>
                                                <?= substr($datamastercuci['tanggal_cuci'], 0, 10) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Total Berat cuci :</td>
                                            <td>
                                                <?= $datamastercuci['total_berat'] ?> g
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nama Tukang :</td>
                                            <td>
                                                <?= $datamastercuci['nama_tukang'] ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Barang :</td>
                                            <td>
                                                <?= $datamastercuci['jumlah_barang'] ?>
                                            </td>
                                        </tr>
                                        <?php if ($datamastercuci['status_dokumen'] == 'Selesai') : ?>
                                            <tr>
                                                <td>Pembayaran :</td>
                                                <td>
                                                    <?= $datamastercuci['pembayaran'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Onkos :</td>
                                                <td>
                                                    <?= number_format($datamastercuci['harga_cuci'], 0, ',', '.') ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <div class="col-6">
                            <!-- Application buttons -->
                            <div class="card">
                                <div class="card-body" id="refreshtombol">
                                    <a class="btn btn-app" href="/printbarcodecuci/<?= $datamastercuci['id_date_cuci'] ?>" target="_blank">
                                        <i class="fas fa-barcode"></i> Print Barcode
                                    </a>
                                    <a href="/printnotacuci/<?= $datamastercuci['id_date_cuci'] ?>" target="_blank" class="btn btn-app">
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
                                    <label>Barang Cuci</label>
                                    <div class="card">
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive p-0" style="max-height: 500px;" id="tblselesaicuci">
                                            <table class="table table-head-fixed text-nowrap" id="trselesaicuci">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center;">Gambar</th>
                                                        <th style="text-align: center;">Kode</th>
                                                        <th style="text-align: center;">Jenis</th>
                                                        <th style="text-align: center;">Model</th>
                                                        <th style="text-align: center;">Berat</th>
                                                        <th style="text-align: center;">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="selesaicuci">
                                                    <?php foreach ($dataakancuci as $row) : ?>
                                                        <tr id="sudahcuci">
                                                            <td class="imgg"><img class="imgg" src="/img/<?= $row['nama_img'] ?>"></td>
                                                            <td><?= $row['kode'] ?></td>
                                                            <td><?= $row['jenis'] ?></td>
                                                            <td><?= $row['model'] ?></td>
                                                            <td><?= $row['berat'] ?></td>
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