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
                        <div class="col-sm-6">
                            <div class="card">
                                <!-- /.card-header -->

                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">

                                        <?php if ($datamasterlebur['status_dokumen'] == 'Selesai') : ?>
                                            <tr>
                                                <td> No Lebur :</td>
                                                <td>
                                                    <?= $datamasterlebur['no_lebur'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> Barcode :</td>
                                                <td>
                                                    <?= $datamasterlebur['kode'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Gambar :</td>
                                                <td>
                                                    <img class="imgg" src="/img/<?= $datamasterlebur['nama_img'] ?>">
                                                </td>
                                            </tr>
                                        <?php endif ?>
                                        <tr>
                                            <td> Total Berat Murni :</td>
                                            <td>
                                                <?= $datamasterlebur['berat_murni'] ?> g
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Total Berat Kotor :</td>
                                            <td>
                                                <?= $datamasterlebur['total_berat'] ?> g
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total Barang :</td>
                                            <td>
                                                <?= $datamasterlebur['jumlah_barang'] ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total Harga :</td>
                                            <td>
                                                <?= number_format($datamasterlebur['total_harga_bahan'], 0, ',', '.') ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <div class="col-sm-6">
                            <!-- Application buttons -->
                            <div class="card">
                                <div class="card-body" id="refreshtombol">
                                    <a type="button" class="btn btn-app bg-default" onclick="ModalPrintLebur(2,<?= $datamasterlebur['id_date_lebur'] ?>)">
                                        <i class="fas fa-print"></i>Print
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
                                    <label>Barang Lebur</label>
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
                                                    </tr>
                                                </thead>
                                                <tbody id="refreshtbl">
                                                    <?php foreach ($dataakanlebur as $row) : ?>
                                                        <tr id="akanlebur">
                                                            <td class="imgg"><img class="imgg" src="/img/<?= $row['nama_img'] ?>"></td>
                                                            <td><?= $row['kode'] ?></td>
                                                            <td><?= $row['jenis'] ?></td>
                                                            <td><?= $row['model'] ?></td>
                                                            <td><?= $row['berat_murni'] ?></td>
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