<div class="modal fade" id="modal-modal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Detail</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if ($kel == 1) : ?>
                    <section class="content">
                        <!-- Default box -->
                        <div class="card card-solid">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <h3 class="d-inline-block d-sm-none"><?= $barang['jenis'] . ' ' . $barang['model'] . ' ' . $barang['merek']  . ' ' . $barang['barcode'] ?></h3>
                                        <div class="col-12">
                                            <img src="/img/<?= $barang['gambar'] ?>" class="product-image" alt="Product Image">
                                        </div>
                                        <div class="col-12 product-image-thumbs">
                                            <div class="product-image-thumb active"><img src="/img/<?= $barang['gambar'] ?>" alt="Product Image"></div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <h3 class="my-3"><?= $barang['jenis'] . ' ' . $barang['model'] . ' ' . $barang['merek'] . ' ' . $barang['barcode'] ?></h3>
                                        <div class="card">
                                            <div class="card-body table-responsive p-0">
                                                <table class="table table-head-fixed text-nowrap">
                                                    <tbody>
                                                        <tr>
                                                            <td>No faktur :</td>
                                                            <td>
                                                                <?= $barang['no_faktur'] ?>
                                                            </td>
                                                            <td>Qty :</td>
                                                            <td>
                                                                <?= $barang['qty'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Jenis Barang :</td>
                                                            <td>
                                                                <?= $barang['jenis'] ?>
                                                            </td>
                                                            <td>Satus :</td>
                                                            <td>
                                                                <?= $barang['status'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Model Barang :</td>
                                                            <td>
                                                                <?= $barang['model'] ?>
                                                            </td>
                                                            <td>Keterangan Barang :</td>
                                                            <td>
                                                                <?= $barang['keterangan'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Merek Barang :</td>
                                                            <td>
                                                                <?= $barang['merek'] ?>
                                                            </td>
                                                            <td>Kadar Barang :</td>
                                                            <td>
                                                                <?= $barang['kadar'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Berat :</td>
                                                            <td>
                                                                <?= $barang['berat'] ?>
                                                            </td>
                                                            <td>Berat Murni :</td>
                                                            <td>
                                                                <?= $barang['berat_murni'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nilai Tukar :</td>
                                                            <td>
                                                                <?= $barang['nilai_tukar'] ?> %
                                                            </td>
                                                            <td>Ongkos :</td>
                                                            <td>
                                                                <?= number_format($barang['ongkos'], 2, ',', '.') ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Harga Beli :</td>
                                                            <td>
                                                                <?= number_format($barang['harga_beli'], 2, ',', '.') ?>
                                                            </td>
                                                            <td>Total Harga :</td>
                                                            <td>
                                                                <?= number_format($barang['total_harga'], 2, ',', '.') ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nama Supplier :</td>
                                                            <td>
                                                                <?= $barang['nama_supplier'] ?>
                                                            </td>
                                                            <td>Tanggal Faktur :</td>
                                                            <td>
                                                                <?= $barang['tgl_faktur'] ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <div class="mt-4">
                                            <a href="#" class="btn btn-primary btn-lg btn-flat" onclick="ModalEdit(<?= $barang['id_stock_1'] ?>,<?= $kel ?>)">
                                                <i class="fas fa-edit fa-lg mr-2"></i>
                                                Edit Barang
                                            </a>
                                            <a href="#" onclick="PilihBarang(<?= $barang['id_stock_1'] ?>,<?= $kel ?>)" class="btn btn-default btn-lg btn-flat">
                                                <i class="fas fa-check fa-lg mr-2"></i>
                                                Pilih Barang
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </section>
                <?php elseif ($kel == 2) : ?>
                    <section class="content">
                        <!-- Default box -->
                        <div class="card card-solid">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <h3 class="d-inline-block d-sm-none"><?= $barang['jenis'] . ' ' . $barang['model'] . ' ' . $barang['merek']  . ' ' . $barang['barcode'] ?></h3>
                                        <div class="col-12">
                                            <img src="/img/<?= $barang['gambar'] ?>" class="product-image" alt="Product Image">
                                        </div>
                                        <div class="col-12 product-image-thumbs">
                                            <div class="product-image-thumb active"><img src="/img/<?= $barang['gambar'] ?>" alt="Product Image"></div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <h3 class="my-3"><?= $barang['jenis'] . ' ' . $barang['model'] . ' ' . $barang['merek'] . ' ' . $barang['barcode'] ?></h3>
                                        <div class="card">
                                            <div class="card-body table-responsive p-0">
                                                <table class="table table-head-fixed text-nowrap">
                                                    <tbody>
                                                        <tr>
                                                            <td>No faktur :</td>
                                                            <td>
                                                                <?= $barang['no_faktur'] ?>
                                                            </td>
                                                            <td>Qty :</td>
                                                            <td>
                                                                <?= $barang['qty'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Jenis Barang :</td>
                                                            <td>
                                                                <?= $barang['jenis'] ?>
                                                            </td>
                                                            <td>Satus :</td>
                                                            <td>
                                                                <?= $barang['status'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Model Barang :</td>
                                                            <td>
                                                                <?= $barang['model'] ?>
                                                            </td>
                                                            <td>Keterangan Barang :</td>
                                                            <td>
                                                                <?= $barang['keterangan'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Merek Barang :</td>
                                                            <td>
                                                                <?= $barang['merek'] ?>
                                                            </td>
                                                            <td>Kadar Barang :</td>
                                                            <td>
                                                                <?= $barang['kadar'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Berat :</td>
                                                            <td>
                                                                <?= $barang['berat'] ?>
                                                            </td>
                                                            <td>Nama Supplier :</td>
                                                            <td>
                                                                <?= $barang['nama_supplier'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Harga Beli :</td>
                                                            <td>
                                                                <?= number_format($barang['harga_beli'], 2, ',', '.') ?>
                                                            </td>
                                                            <td>Total Harga :</td>
                                                            <td>
                                                                <?= number_format($barang['total_harga'], 2, ',', '.') ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <div class="mt-4">
                                            <a href="#" class="btn btn-primary btn-lg btn-flat" onclick="ModalEdit(<?= $barang['id_stock_2'] ?>,<?= $kel ?>)">
                                                <i class="fas fa-edit fa-lg mr-2"></i>
                                                Edit Barang
                                            </a>
                                            <a href="#" onclick="PilihBarang(<?= $barang['id_stock_2'] ?>,<?= $kel ?>)" class="btn btn-default btn-lg btn-flat">
                                                <i class="fas fa-check fa-lg mr-2"></i>
                                                Pilih Barang
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </section>
                <?php elseif ($kel == 3) : ?>
                    <section class="content">
                        <!-- Default box -->
                        <div class="card card-solid">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <h3 class="d-inline-block d-sm-none"><?= $barang['jenis'] . ' ' . $barang['model'] . ' ' . $barang['merek']  . ' ' . $barang['barcode'] ?></h3>
                                        <div class="col-12">
                                            <img src="/img/<?= $barang['gambar'] ?>" class="product-image" alt="Product Image">
                                        </div>
                                        <div class="col-12 product-image-thumbs">
                                            <div class="product-image-thumb active"><img src="/img/<?= $barang['gambar'] ?>" alt="Product Image"></div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <h3 class="my-3"><?= $barang['jenis'] . ' ' . $barang['model'] . ' ' . $barang['merek'] . ' ' . $barang['barcode'] ?></h3>
                                        <div class="card">
                                            <div class="card-body table-responsive p-0">
                                                <table class="table table-head-fixed text-nowrap">
                                                    <tbody>
                                                        <tr>
                                                            <td>No faktur :</td>
                                                            <td>
                                                                <?= $barang['no_faktur'] ?>
                                                            </td>
                                                            <td>Qty :</td>
                                                            <td>
                                                                <?= $barang['qty'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Jenis Barang :</td>
                                                            <td>
                                                                <?= $barang['jenis'] ?>
                                                            </td>
                                                            <td>Satus :</td>
                                                            <td>
                                                                <?= $barang['status'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Model Barang :</td>
                                                            <td>
                                                                <?= $barang['model'] ?>
                                                            </td>
                                                            <td>Keterangan Barang :</td>
                                                            <td>
                                                                <?= $barang['keterangan'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Merek Barang :</td>
                                                            <td>
                                                                <?= $barang['merek'] ?>
                                                            </td>
                                                            <td>Kadar Barang :</td>
                                                            <td>
                                                                <?= $barang['kadar'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Berat :</td>
                                                            <td>
                                                                <?= $barang['berat'] ?>
                                                            </td>
                                                            <td>Nama Supplier :</td>
                                                            <td>
                                                                <?= $barang['nama_supplier'] ?>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>Harga Beli :</td>
                                                            <td>
                                                                <?= number_format($barang['harga_beli'], 2, ',', '.') ?>
                                                            </td>
                                                            <td>Total Harga :</td>
                                                            <td>
                                                                <?= number_format($barang['total_harga'], 2, ',', '.') ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <div class="mt-4">
                                            <a href="#" class="btn btn-primary btn-lg btn-flat" onclick="ModalEdit(<?= $barang['id_stock_3'] ?>,<?= $kel ?>)">
                                                <i class="fas fa-edit fa-lg mr-2"></i>
                                                Edit Barang
                                            </a>
                                            <a href="#" onclick="PilihBarang(<?= $barang['id_stock_3'] ?>,<?= $kel ?>)" class="btn btn-default btn-lg btn-flat">
                                                <i class="fas fa-check fa-lg mr-2"></i>
                                                Pilih Barang
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </section>
                <?php elseif ($kel == 4) : ?>
                    <section class="content">
                        <!-- Default box -->
                        <div class="card card-solid">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <h3 class="d-inline-block d-sm-none"><?= $barang['jenis'] . ' ' . $barang['model'] . ' ' . $barang['merek']  . ' ' . $barang['barcode'] ?></h3>
                                        <div class="col-12">
                                            <img src="/img/<?= $barang['gambar'] ?>" class="product-image" alt="Product Image">
                                        </div>
                                        <div class="col-12 product-image-thumbs">
                                            <div class="product-image-thumb active"><img src="/img/<?= $barang['gambar'] ?>" alt="Product Image"></div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <h3 class="my-3"><?= $barang['jenis'] . ' ' . $barang['model'] . ' ' . $barang['merek'] . ' ' . $barang['barcode'] ?></h3>
                                        <div class="card">
                                            <div class="card-body table-responsive p-0">
                                                <table class="table table-head-fixed text-nowrap">
                                                    <tbody>
                                                        <tr>
                                                            <td>No faktur :</td>
                                                            <td>
                                                                <?= $barang['no_faktur'] ?>
                                                            </td>
                                                            <td>Qty :</td>
                                                            <td>
                                                                <?= $barang['qty'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Jenis Barang :</td>
                                                            <td>
                                                                <?= $barang['jenis'] ?>
                                                            </td>
                                                            <td>Satus :</td>
                                                            <td>
                                                                <?= $barang['status'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Model Barang :</td>
                                                            <td>
                                                                <?= $barang['model'] ?>
                                                            </td>
                                                            <td>Keterangan Barang :</td>
                                                            <td>
                                                                <?= $barang['keterangan'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Merek Barang :</td>
                                                            <td>
                                                                <?= $barang['merek'] ?>
                                                            </td>
                                                            <td>Kadar Barang :</td>
                                                            <td>
                                                                <?= $barang['kadar'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Berat :</td>
                                                            <td>
                                                                <?= $barang['berat'] ?>
                                                            </td>
                                                            <td>Nama Supplier :</td>
                                                            <td>
                                                                <?= $barang['nama_supplier'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Harga Beli :</td>
                                                            <td>
                                                                <?= number_format($barang['harga_beli'], 2, ',', '.') ?>
                                                            </td>
                                                            <td>Total Harga :</td>
                                                            <td>
                                                                <?= number_format($barang['total_harga'], 2, ',', '.') ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <div class="mt-4">
                                            <a href="#" class="btn btn-primary btn-lg btn-flat" onclick="ModalEdit(<?= $barang['id_stock_4'] ?>,<?= $kel ?>)">
                                                <i class="fas fa-edit fa-lg mr-2"></i>
                                                Edit Barang
                                            </a>
                                            <a href="#" onclick="PilihBarang(<?= $barang['id_stock_4'] ?>,<?= $kel ?>)" class="btn btn-default btn-lg btn-flat">
                                                <i class="fas fa-check fa-lg mr-2"></i>
                                                Pilih Barang
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </section>
                <?php elseif ($kel == 5) : ?>
                    <section class="content">
                        <!-- Default box -->
                        <div class="card card-solid">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <h3 class="d-inline-block d-sm-none"><?= $barang['jenis'] . ' ' . $barang['model'] . ' ' . $barang['merek']  . ' ' . $barang['barcode'] ?></h3>
                                        <div class="col-12">
                                            <img src="/img/<?= $barang['gambar'] ?>" class="product-image" alt="Product Image">
                                        </div>
                                        <div class="col-12 product-image-thumbs">
                                            <div class="product-image-thumb active"><img src="/img/<?= $barang['gambar'] ?>" alt="Product Image"></div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <h3 class="my-3"><?= $barang['jenis'] . ' ' . $barang['model'] . ' ' . $barang['merek'] . ' ' . $barang['barcode'] ?></h3>
                                        <div class="card">
                                            <div class="card-body table-responsive p-0">
                                                <table class="table table-head-fixed text-nowrap">
                                                    <tbody>
                                                        <tr>
                                                            <td>Nama Supplier :</td>
                                                            <td>
                                                                <?= $barang['nama_supplier'] ?>
                                                            </td>
                                                            <td>No faktur :</td>
                                                            <td>
                                                                <?= $barang['no_faktur'] ?>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>Jenis Barang :</td>
                                                            <td>
                                                                <?= $barang['jenis'] ?>
                                                            </td>
                                                            <td>Satus :</td>
                                                            <td>
                                                                <?= $barang['status'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Model Barang :</td>
                                                            <td>
                                                                <?= $barang['model'] ?>
                                                            </td>
                                                            <td>Keterangan Barang :</td>
                                                            <td>
                                                                <?= $barang['keterangan'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Carat :</td>
                                                            <td>
                                                                <?= $barang['carat'] ?>
                                                            </td>
                                                            <td>Qty :</td>
                                                            <td>
                                                                <?= $barang['qty'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Harga Beli :</td>
                                                            <td>
                                                                <?= number_format($barang['harga_beli'], 2, ',', '.') ?>
                                                            </td>
                                                            <td>Total Harga :</td>
                                                            <td>
                                                                <?= number_format($barang['total_harga'], 2, ',', '.') ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <div class="mt-4">
                                            <a href="#" class="btn btn-primary btn-lg btn-flat" onclick="ModalEdit(<?= $barang['id_stock_5'] ?>,<?= $kel ?>)">
                                                <i class="fas fa-edit fa-lg mr-2"></i>
                                                Edit Barang
                                            </a>
                                            <a href="#" onclick="PilihBarang(<?= $barang['id_stock_5'] ?>,<?= $kel ?>)" class="btn btn-default btn-lg btn-flat">
                                                <i class="fas fa-check fa-lg mr-2"></i>
                                                Pilih Barang
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </section>
                <?php elseif ($kel == 6) : ?>
                    <section class="content">
                        <!-- Default box -->
                        <div class="card card-solid">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <h3 class="d-inline-block d-sm-none"><?= $barang['jenis'] . ' ' . $barang['model'] . ' ' . $barang['merek']  . ' ' . $barang['barcode'] ?></h3>
                                        <div class="col-12">
                                            <img src="/img/<?= $barang['gambar'] ?>" class="product-image" alt="Product Image">
                                        </div>
                                        <div class="col-12 product-image-thumbs">
                                            <div class="product-image-thumb active"><img src="/img/<?= $barang['gambar'] ?>" alt="Product Image"></div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <h3 class="my-3"><?= $barang['jenis'] . ' ' . $barang['model'] . ' ' . $barang['merek'] . ' ' . $barang['barcode'] ?></h3>
                                        <div class="card">
                                            <div class="card-body table-responsive p-0">
                                                <table class="table table-head-fixed text-nowrap">
                                                    <tbody>
                                                        <tr>
                                                            <td>No faktur :</td>
                                                            <td>
                                                                <?= $barang['no_faktur'] ?>
                                                            </td>
                                                            <td>Nama Supplier :</td>
                                                            <td>
                                                                <?= $barang['nama_supplier'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Jenis Barang :</td>
                                                            <td>
                                                                <?= $barang['jenis'] ?>
                                                            </td>
                                                            <td>Satus :</td>
                                                            <td>
                                                                <?= $barang['status'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Model Barang :</td>
                                                            <td>
                                                                <?= $barang['model'] ?>
                                                            </td>
                                                            <td>Keterangan Barang :</td>
                                                            <td>
                                                                <?= $barang['keterangan'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Merek Barang :</td>
                                                            <td>
                                                                <?= $barang['merek'] ?>
                                                            </td>
                                                            <td>Qty :</td>
                                                            <td>
                                                                <?= $barang['qty'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Harga Beli :</td>
                                                            <td>
                                                                <?= number_format($barang['harga_beli'], 2, ',', '.') ?>
                                                            </td>
                                                            <td>Total Harga :</td>
                                                            <td>
                                                                <?= number_format($barang['total_harga'], 2, ',', '.') ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <div class="mt-4">
                                            <a href="#" class="btn btn-primary btn-lg btn-flat" onclick="ModalEdit(<?= $barang['id_stock_6'] ?>,<?= $kel ?>)">
                                                <i class="fas fa-edit fa-lg mr-2"></i>
                                                Edit Barang
                                            </a>
                                            <a href="#" onclick="PilihBarang(<?= $barang['id_stock_6'] ?>,<?= $kel ?>)" class="btn btn-default btn-lg btn-flat">
                                                <i class="fas fa-check fa-lg mr-2"></i>
                                                Pilih Barang
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </section>
                <?php endif; ?>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary btntambah" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>