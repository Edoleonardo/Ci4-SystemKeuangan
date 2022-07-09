<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<script type="text/javascript" src="/js/jquery.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .table>tbody>tr>* {
        vertical-align: middle;
        text-align: center;
    }

    .imgg {
        width: 100px;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Form Penjualan Barang</h1>
                </div><!-- /.col -->
                <!-- /.content-header -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/barangkeluar">Home</a></li>
                        <li class="breadcrumb-item"><a href="/barangkeluar">Penjualan Barang</a></li>
                        <li class="breadcrumb-item active">Form Penjualan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <!-- /.card-header -->
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>
                                    Nomor Jual : <?= $datapenjualan['no_transaksi_jual'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Nama Customer : <?= (isset($datacust['nama'])) ? $datacust['nama'] : ' ' ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    No Hp : <?= (isset($datacust['nohp_cust'])) ? $datacust['nohp_cust'] : '' ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tanggal Jual : <?= substr($datapenjualan['created_at'], 0, 10) ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-sm-6">
                <!-- Application buttons -->
                <div class="card" id="card1">
                    <div class="card-body" id="card2">
                        <?php if ($datapenjualan['status_dokumen'] == 'Retur') : ?>
                            <a class="btn btn-app bg-danger" type="button" data-toggle="modal" data-target="#modal-bayar">
                                <i class="fas fa-money-bill"></i> Bayar Retur
                            </a>
                        <?php else : ?>
                            <a class="btn btn-app" target="_blank" onclick="pindahtempat('/printinvoice/<?= $datapenjualan['id_date_penjualan'] ?>')" target="_blank">
                                <i class="fas fa-print"></i> Print Invoce
                            </a>
                            <a class="btn btn-app bg-primary" type="button">
                                <i class="fas fa-check"></i> Lunas
                            </a>
                        <?php endif; ?>
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
                            <div class="card-body table-responsive p-0" id="refrshtbl1">
                                <?php if ($datapenjualan['kelompok'] == 1) : ?>
                                    <table class="table table-hover text-nowrap" id="refrshtbl2">
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
                                    <table class="table table-hover text-nowrap" id="refrshtbl2">
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
                                    <table class="table table-hover text-nowrap" id="refrshtbl2">
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
                                <?php elseif ($datapenjualan['kelompok'] == 4) : ?>
                                    <table class="table table-hover text-nowrap" id="refrshtbl2">
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
                                    <table class="table table-hover text-nowrap" id="refrshtbl2">
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
                                    <table class="table table-hover text-nowrap" id="refrshtbl2">
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
                                <?php endif; ?>
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
                                        <?php if ($datapenjualan['kelompok'] == 1 || $datapenjualan['kelompok'] == 2 || $datapenjualan['kelompok'] == 3 || $datapenjualan['kelompok'] == 4) : ?>
                                            <tr>
                                                <td>Total Berat</td>
                                                <td><?= number_format($totalberat, 2, ',', '.') ?></td>
                                            </tr>
                                        <?php elseif ($datapenjualan['kelompok'] == 5) : ?>
                                            <tr>
                                                <td>Total Carat</td>
                                                <td><?= $totalcarat ?></td>
                                            </tr>
                                        <?php elseif ($datapenjualan['kelompok'] == 6) : ?>
                                            <tr>
                                                <td>Total Qty</td>
                                                <td><?= $totalqty ?></td>
                                            </tr>
                                        <?php endif; ?>
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
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- /.modal-dialog -->
</div>
<!-- Control Sidebar -->

<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<!-- Main Footer -->
<footer class="main-footer">

</footer>
<script type="text/javascript">
    function refreshtbl() {
        $("#refrshtbl1").load("/detailpenjualan/" + document.getElementById('iddate1').value + " #refrshtbl2");
        $("#card1").load("/detailpenjualan/" + document.getElementById('iddate1').value + " #card2");
        $("#card11").load("/detailpenjualan/" + document.getElementById('iddate1').value + " #card22");
        $("#total1").load("/detailpenjualan/" + document.getElementById('iddate1').value + " #total2");
        // document.getElementById('pembayaran').value = 'Bayar Nanti'
    }

    function pindahtempat(url) {
        window.open(url);
        window.location.href = '/barangkeluar'
    }
    $(document).ready(function() {
        // tampildataretur()

    })
</script>
<?= $this->endSection(); ?>