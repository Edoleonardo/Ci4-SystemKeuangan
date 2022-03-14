<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
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
                        <li class="breadcrumb-item"><a href="/buybackcust">Home</a></li>
                        <li class="breadcrumb-item"><a href="/buybackcust">Buyback Customer</a></li>
                        <li class="breadcrumb-item active">Form Penjualan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- <div class="col-6">
                    <form action="/scantrans" name="scannotrans" id="scannotrans" class="scannotrans" method="post">
                        <div class="form-group" style="margin: 1mm;">
                            <label>Masukan No Invoce (Nota)</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control notrans" id="notrans" onkeyup="ScannoTrans()" name="notrans" placeholder="Masukan Nomor Nota">
                                <span class="input-group-append">
                                    <button type="submit" id="scannotransbtn" class="btn btn-info btn-flat scannotransbtn">Ok</button>
                                </span>
                                <div id="validationServerUsernameFeedback" class="invalid-feedback notransmsg">
                                </div>
                            </div>
                        </div>
                    </form>
                </div> -->
            <div class="col-6">
                <div class="card">
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
                </div>
            </div>
            <div class="col-6">
                <!-- Application buttons -->
                <div class="card">
                    <div class="card-body" id="refreshtombol">
                        <a type="button" onclick="Batal()" class="btn btn-app">
                            <i class="fas fa-window-close"></i> Batal Jual
                        </a>
                        <?php if (isset($databuyback)) : ?>
                            <?php if ($databuyback['pembayaran'] == 'Bayar Nanti') : ?>
                                <a class="btn btn-app bg-danger" type="button" data-toggle="modal" data-target="#modal-bayar">
                                    <i class="fas fa-money-bill"></i> Bayar
                                </a>
                            <?php else : ?>
                                <a class="btn btn-app bg-primary" type="button" data-toggle="modal" data-target="#modal-bayar">
                                    <i class="fas fa-check"></i> Lunas
                                </a>
                            <?php endif ?>
                        <?php endif ?>

                    </div>
                    <!-- /.card-body -->
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
                                <div class="card-body table-responsive p-0">
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
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody id="databuyback">
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
                                                <td id="totalberatview"></td>
                                            </tr>
                                            <tr>
                                                <td>Total Harga</td>
                                                <td id="totalhargaview"></td>
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
                                            <?php if (isset($datapenjualan)) : ?>
                                                <tr>
                                                    <td>Metode Pembayaran</td>
                                                    <td><?= $datapenjualan['pembayaran'] ?></td>
                                                </tr>
                                                <?php if ($datapenjualan['nama_bank']) : ?>
                                                    <tr>
                                                        <td>Nama Bank</td>
                                                        <td><?= $datapenjualan['nama_bank'] ?></td>
                                                    </tr>
                                                <?php endif ?>
                                                <?php if ($datapenjualan['tunai']) : ?>
                                                    <tr>
                                                        <td>Tunai</td>
                                                        <td><?= number_format($datapenjualan['tunai'], 2, ',', '.') ?></td>
                                                    </tr>
                                                <?php endif ?>
                                                <?php if ($datapenjualan['transfer']) : ?>
                                                    <tr>
                                                        <td>Transfer</td>
                                                        <td><?= number_format($datapenjualan['transfer'], 2, ',', '.') ?></td>
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
    <!-- /.content -->
    <!-- /.content-wrapper -->
</div>


<!-- Main Footer -->
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<footer class="main-footer">

</footer>
<div class="modal fade" id="modal-nota">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Data Buyback Nota</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <form action="/scantrans" name="scannotrans" id="scannotrans" class="scannotrans" method="post">
                            <div class="form-group" style="margin: 1mm;">
                                <label>Masukan No Invoce (Nota)</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control notrans" id="notrans" onkeyup="ScannoTrans()" name="notrans" placeholder="Masukan Nomor Nota">
                                    <span class="input-group-append">
                                        <button type="submit" id="scannotransbtn" class="btn btn-info btn-flat scannotransbtn">Ok</button>
                                    </span>
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback notransmsg">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
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
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="datamodalbuyback">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!-- <button type="submit" class="btn btn-primary btnedit">Tambah</button> -->
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/tambahbuyback" id="tambahbuyback" class="tambahbuyback" name="tambahbuyback">
                    <?= csrf_field(); ?>
                    <div class="row">
                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Qty</label>
                                <input type="number" id="qty1" onkeyup="HarusBayar()" name="qty1" class="form-control" placeholder="Masukan QTY">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback qty1msg">
                                </div>
                                <input type="hidden" name="id" id="id" value="">
                                <input type="hidden" name="kel" id="kel" value="">
                                <input type="hidden" name="iddate" id="iddate" value="<?= $databuyback['id_date_buyback'] ?>">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Berat</label>
                                <input type="number" step="0.01" id="berat1" onkeyup="HarusBayar()" name="berat1" class="form-control" placeholder="Masukan Berat Bersih">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback berat1msg">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Nilai Tukar</label>
                                <input type="number" id="nilai_tukar1" onkeyup="HarusBayar()" name="nilai_tukar1" class="form-control" placeholder="Masukan Nilai Tukar">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback nilai_tukar1msg">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Harga Beli</label>
                                <input type="number" name="harga_beli1" onkeyup="HarusBayar()" id="harga_beli1" class="form-control harga_beli1" placeholder="Masukan Harga Beli">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback harga_beli1msg">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Status Barang</label>
                                <select name="status_proses" class="form-control" id="status" name="status">
                                    <option value="Cuci">Cuci</option>
                                    <option value="Retur">Retur Sales</option>
                                    <option value="Lebur">Lebur</option>
                                    <option value="Jual">Jual</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Total Harga</td>
                                        <td id="totalhargaedit"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btnedit">Tambah</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal-dialog -->
<div class="modal fade" id="modal-nonota">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Buyback Tanpa Nota</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/tambahbuybacknonota" id="tambahbuybacknonota" class="tambahbuybacknonota" name="tambahbuybacknonota">
                    <div class="row">
                        <div class="col-sm-2">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Kelompok</label>
                                <select name="kelompok" onchange="totalharga()" class="form-control" id="kelompok">
                                    <option value="1">Perhiasan Mas</option>
                                    <option value="2">Perhiasan Berlian</option>
                                    <option value="3">Logam Mulia (Antam, UBS, HWT)</option>
                                    <option value="4">Bahan Murni</option>
                                    <option value="5">Loose Diamond</option>
                                    <option value="6">Barang Dagang</option>
                                </select>
                                <input type="hidden" name="iddate" id="iddate" value="<?= $databuyback['id_date_buyback'] ?>">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Merek</label>
                                <select name="merek" class="form-control" id="merek">
                                    <?php foreach ($merek as $m) : ?>
                                        <option value="<?= $m['nama_merek'] ?>"><?= $m['nama_merek'] ?> </option>
                                    <?php endforeach; ?>
                                    <option value="-">-</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Kadar</label>
                                <select name="kadar" class="form-control" id="kadar">
                                    <?php foreach ($kadar as $m) : ?>
                                        <option value="<?= $m['nama_kadar'] ?>"><?= $m['nama_kadar'] ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Jenis</label>
                                <input type="text" name="jenis" id="jenis" class="form-control" placeholder="Masukan Jenis">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback jenismsg">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Berat</label>
                                <input type="number" onkeyup="totalharga()" step="0.01" id="berat" name="berat" class="form-control" placeholder="Masukan Berat Bersih">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback beratmsg">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Model</label>
                                <input type="text" name="model" id="model" class="form-control" placeholder="Masukan Model Barang">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Masukan Keterangan">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Qty</label>
                                <input type="Number" id="qty" onkeyup="totalharga()" name="qty" min="1" class="form-control" placeholder="Masukan jumlah">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback qtymsg">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Nilai Tukar</label>
                                <input type="number" value="100" id="nilai_tukar" onkeyup="totalharga()" name="nilai_tukar" class="form-control" placeholder="Masukan Nilai Tukar">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback nilai_tukarmsg">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Harga Beli</label>
                                <input type="number" name="harga_beli" onkeyup="totalharga()" id="harga_beli" class="form-control harga_beli" placeholder="Masukan Harga Beli">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback harga_belimsg">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Status Barang</label>
                                <select name="status_proses" class="form-control" id="status" name="status">
                                    <option value="Cuci">Cuci</option>
                                    <option value="Retur">Retur Sales</option>
                                    <option value="Lebur">Lebur</option>
                                    <option value="Jual">Jual</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Foto</label><br>
                                <button type="button" id="ambilgbr" class="btn btn-primary" data-toggle="modal" data-target="#modal-foto" onclick="cameranyala()">
                                    <i class="fa fa-camera"></i>
                                </button>
                                <div id="validationServerUsernameFeedback" class="invalid-feedback ambilgbrmsg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Total Harga</td>
                                        <td id="totalbayar"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btnedit">Tambah</button>
            </div>
            <div class="modal fade" id="modal-foto">
                <div class="modal-dialog modal-default">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Ambil Foto</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-group"><label>Gambar</label>
                                            <div class="custom-file">
                                                <input type="file" name="gambar" class="custom-file-input" id="gambar" accept="image/*">
                                                <label style="text-align: left" class="custom-file-label" for="gambar">Pilih Gambar</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div id='my_camera'>
                                        </div>
                                        <button style="text-align: center;" type='button' id='ambilfoto' class='btn btn-info ambilfoto' onclick='Foto_ulang()'>
                                            <i class='fa fa-trash'></i></button>
                                        <button type='button' id='ambilfoto' class='btn btn-info ambilfoto' onclick='Ambil_foto()'>Foto <i class='fa fa-camera'></i>
                                        </button>
                                        <input type='hidden' name='gambar' id='gambar' class='image-tag'>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="Webcam.reset()" data-dismiss="modal">Done</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-bayar">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pembayaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/pembayaranform" id="pembayaranform" class="pembayaranform" name="pembayaranform">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <!-- ./card-header -->
                                <div class="p-0">
                                    <!-- text input -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Cara Pembayaran</label>
                                                <select onchange="myPembayaran()" onclick="myPembayaran()" onclick="HarusBayar()" name="pembayaran" class="form-control pembayaran" id="pembayaran">
                                                    <option value="Transfer">Transfer</option>
                                                    <option value="Tunai">Tunai</option>
                                                    <option value="Tunai&Transfer">Tunai & Transfer</option>
                                                </select>
                                                <div id="validationServerUsernameFeedback" class="invalid-feedback pembayaranmsg">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group metodebayar">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group namabankhtml">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group metodebayar2">
                                                <!-- <label>Debit/CC</label> -->
                                                <!-- <input type="number" min="0" id="debitcc" name="debitcc" class="form-control" placeholder="Masukan Debit"> -->
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group chargehtml">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Berat</td>
                                        <td id="brtmurni"></td>
                                    </tr>
                                    <tr>
                                        <td>Harus Dibayar</td>
                                        <td id="harusbayar"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btnbayar">Bayar</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
    $('.tambahbuybacknonota').submit(function(e) {
        e.preventDefault()
        let form = $('.tambahbuybacknonota')[0];
        let data = new FormData(form)
        Swal.fire({
            title: 'Tambah',
            text: "Yakin ingin Buyback Barang ini ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Tambah',
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    data: data,
                    url: "<?php echo base_url('/tambahbuybacknonota'); ?>",
                    contentType: false,
                    processData: false,
                    cache: false,
                    dataType: "json",
                    success: function(result) {
                        console.log(result)
                        if (result.error) {
                            if (result.error.qty) {
                                $('#qty').addClass('is-invalid')
                                $('.qtymsg').html(result.error.qty)
                            } else {
                                $('#qty').removeClass('is-invalid')
                                $('.qtymsg').html('')
                            }
                            if (result.error.nilai_tukar) {
                                $('#nilai_tukar').addClass('is-invalid')
                                $('.nilai_tukarmsg').html(result.error.nilai_tukar)
                            } else {
                                $('#nilai_tukar').removeClass('is-invalid')
                                $('.nilai_tukarmsg').html('')
                            }
                            if (result.error.jenis) {
                                $('#jenis').addClass('is-invalid')
                                $('.jenismsg').html(result.error.jenis)
                            } else {
                                $('#jenis').removeClass('is-invalid')
                                $('.jenismsg').html('')
                            }
                            if (result.error.berat) {
                                $('#berat').addClass('is-invalid')
                                $('.beratmsg').html(result.error.berat)
                            } else {
                                $('#berat').removeClass('is-invalid')
                                $('.beratmsg').html('')
                            }
                            if (result.error.harga_beli) {
                                $('#harga_beli').addClass('is-invalid')
                                $('.harga_belimsg').html(result.error.harga_beli)
                            } else {
                                $('#harga_beli').removeClass('is-invalid')
                                $('.harga_belimsg').html('')
                            }
                            if (result.error.gambar) {
                                $('#ambilgbr').addClass('is-invalid')
                                $('.ambilgbrmsg').html(result.error.gambar)
                            } else {
                                $('#ambilgbr').removeClass('is-invalid')
                                $('.ambilgbrmsg').html('')
                            }
                            // if (result.error.namabank) {
                            //     $('#namabank').addClass('is-invalid')
                            //     $('.namabankmsg').html(result.error.namabank)
                            // } else {
                            //     $('#namabank').removeClass('is-invalid')
                            //     $('.namabank').html('')
                            // }
                            // if (result.error.transfer) {
                            //     $('#transfer').addClass('is-invalid')
                            //     $('.transfermsg').html(result.error.transfer)
                            // } else {
                            //     $('#transfer').removeClass('is-invalid')
                            //     $('.transfer').html('')
                            // }
                            // if (result.error.tunai) {
                            //     $('#tunai').addClass('is-invalid')
                            //     $('.tunaimsg').html(result.error.tunai)
                            // } else {
                            //     $('#tunai').removeClass('is-invalid')
                            //     $('.tunai').html('')
                            // }
                            // if (result.error.pembayaran) {
                            //     $('#pembayaran').addClass('is-invalid')
                            //     $('.pembayaranmsg').html(result.error.pembayaran)
                            // } else {
                            //     $('#pembayaran').removeClass('is-invalid')
                            //     $('.pembayaran').html('')
                            // }
                        } else {
                            $('#qty').removeClass('is-invalid')
                            $('.qtymsg').html('')
                            $('#total_berat').removeClass('is-invalid')
                            $('.total_beratmsg').html('')
                            $('#nilai_tukar').removeClass('is-invalid')
                            $('.nilai_tukarmsg').html('')
                            $('#jenis').removeClass('is-invalid')
                            $('.jenismsg').html('')
                            $('#berat').removeClass('is-invalid')
                            $('.beratmsg').html('')
                            $('#harga_beli').removeClass('is-invalid')
                            $('.harga_belimsg').html('')
                            $('#ambilgbr').removeClass('is-invalid')
                            $('.ambilgbrmsg').html('')
                            // $('#namabank').removeClass('is-invalid')
                            // $('.namabank').html('')
                            // $('#transfer').removeClass('is-invalid')
                            // $('.transfer').html('')
                            // $('#tunai').removeClass('is-invalid')
                            // $('.tunai').html('')
                            // $('#pembayaran').removeClass('is-invalid')
                            // $('.pembayaran').html('')

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Tambah',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK',
                                allowOutsideClick: false
                            }).then((choose) => {
                                if (choose.isConfirmed) {
                                    $('#modal-nonota').modal('toggle');
                                    // $("#refrestbl").load("/buybackcust #refrestbl");
                                    tampildatabuyback()
                                }
                            })
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                })
            }
        })
    })

    function totalharga() {
        var hargabeli = parseFloat(document.getElementById('harga_beli').value)
        var nilaitukar = parseFloat(document.getElementById('nilai_tukar').value)
        var berat = parseFloat(document.getElementById('berat').value)
        var kode = parseFloat(document.getElementById('kelompok').value)
        var qty = parseFloat(document.getElementById('qty').value)
        const totalbayar = document.getElementById('totalbayar')
        const brtmurni = document.getElementById('brtmurni')
        if (kode == 1 || 4 || 5 || 6) {
            beratmurni = berat * nilaitukar / 100
            harusbyr = (beratmurni * hargabeli);
        }
        if (kode == 3) {
            beratmurni = berat * nilaitukar / 100
            harusbyr = (beratmurni * hargabeli * qty);
        }
        if (kode == 2) {
            harusbyr = hargabeli
        }

        brtmurni.innerHTML = beratmurni.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        totalbayar.innerHTML = harusbyr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }

    function myPembayaran() {
        console.log('masuk')
        const carabyr = document.getElementById('pembayaran').value
        const metod1 = $('.metodebayar')
        const nmbank = $('.namabankhtml')
        const metod2 = document.getElementsByClassName('metodebayar2')
        metod1[0].innerHTML = ''
        nmbank[0].innerHTML = ''
        metod2[0].innerHTML = ''

        var NamaBank = '<label>Nama Bank Debit/CC</label><input type="text" id="namabank" name="namabank" class="form-control" placeholder="Masukan Nama Bank"><div id="validationServerUsernameFeedback" class="invalid-feedback namabankmsg"></div>'
        var Transfer = '<label>Transfer</label><input type="number" onkeyup="transfer__()" min="0" id="transfer" name="transfer" class="form-control" placeholder="Masukan transfer"><div id="validationServerUsernameFeedback" class="invalid-feedback transfermsg"></div>'
        var Tunai = '<label>Tunai</label><input type="number"  onkeyup="tunai__()" min="0" id="tunai" name="tunai" class="form-control" placeholder="Masukan tunai"><div id="validationServerUsernameFeedback" class="invalid-feedback tunaimsg"></div>'
        console.log(carabyr)

        if (carabyr == 'Transfer') {
            metod1[0].innerHTML = Transfer
            nmbank[0].innerHTML = NamaBank
            document.getElementById('transfer').value = document.getElementById('harusbayar').innerHTML.replaceAll('.', '')

        }
        if (carabyr == 'Tunai') {
            metod1[0].innerHTML = Tunai
            document.getElementById('tunai').value = document.getElementById('harusbayar').innerHTML.replaceAll('.', '')

        }

        if (carabyr == 'Tunai&Transfer') {
            metod1[0].innerHTML = Transfer
            nmbank[0].innerHTML = NamaBank
            metod2[0].innerHTML = Tunai
            document.getElementById('transfer').value = document.getElementById('harusbayar').innerHTML.replaceAll('.', '')
        }
    }

    function transfer__() {
        var tunai = document.getElementById('tunai').value
        var trnsfr = document.getElementById('transfer').value
        var harga = document.getElementById('harusbayar').innerHTML.replaceAll('.', '')
        hasiltrnsfr = harga - trnsfr
        // Math.abs(hasiltrnsfr)
        // document.getElementById('tunai').value = hasiltunai
        if (hasiltrnsfr < 0) {
            document.getElementById('tunai').value = 0
        } else {
            document.getElementById('tunai').value = Math.abs(hasiltrnsfr)
        }
    }

    function tunai__() {
        var tunai = document.getElementById('tunai').value
        var harga = document.getElementById('harusbayar').innerHTML.replaceAll('.', '')
        var trnsfr = document.getElementById('transfer').value
        hasiltrnsfr = harga - tunai
        // Math.abs(hasiltrnsfr)
        // document.getElementById('tunai').value = hasiltunai
        if (hasiltrnsfr < 0) {
            document.getElementById('transfer').value = 0
        } else {
            document.getElementById('transfer').value = Math.abs(hasiltrnsfr)
        }
    }

    function pembulatankoma(berat) {
        var num = Number(berat) // The Number() only visualizes the type and is not needed
        var roundedString = num.toFixed(2);
        var rounded = Number(roundedString);
        return rounded
    }

    function tampildata() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('tampilbuyback'); ?>",
            success: function(result) {
                // var totalharga = parseFloat(result.totalbersih.total_harga) + parseFloat(result.totalongkos.ongkos)
                // $('#datajual').html(result.data)
                // $('#totalbersih01').html(totalharga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
                // $('#totalberatbersihhtml01').html(pembulatankoma(result.totalberatbersih.berat_murni))
                // $('#totalberatkotorhtml01').html(pembulatankoma(result.totalberatkotor.berat))
                // $('#totalongkoshtml01').html(pembulatankoma(result.totalongkos.ongkos).toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))


            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }



    function Batal() {
        Swal.fire({
            title: 'Batal Penjualan ',
            text: "Apakah Ingin Batal Penjualan ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo base_url('batalpenjualan'); ?>"
            }
        })

    };

    function ScannoTrans() {
        $('#scannotransbtn').trigger('click');
    }

    $('.scannotrans').submit(function(e) {
        e.preventDefault()
        let form = $('.scannotrans')[0];
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            data: data,
            url: "<?php echo base_url('scantrans'); ?>",
            contentType: false,
            processData: false,
            cache: false,
            dataType: "json",
            success: function(result) {
                if (result.pesan_error) {
                    console.log(result)
                    $('#notrans').addClass('is-invalid')
                    $('.notransmsg').html(result.pesan_error)

                } else {
                    $('#notrans').removeClass('is-invalid')
                    $('.notransmsg').html('')
                    document.getElementById('notrans').setAttribute("onkeyup", "ScannoTrans()");
                    document.getElementById('notrans').value = ''
                    $('#datamodalbuyback').html(result.data)
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })

    })

    function tampildatabuyback() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('tampildatabuyback'); ?>",
            data: {
                iddate: document.getElementById('iddate').value
            },
            success: function(result) {
                $('#databuyback').html(result.data)
                $('#totalhargaview').html(result.totalharga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
                $('#totalberatview').html(result.totalberat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
                // var totalharga = parseFloat(result.totalbersih.total_harga) + parseFloat(result.totalongkos.ongkos)
                // $('#datajual').html(result.data)
                // $('#totalbersih01').html(totalharga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
                // $('#totalberatbersihhtml01').html(pembulatankoma(result.totalberatbersih.berat_murni))
                // $('#totalberatkotorhtml01').html(pembulatankoma(result.totalberatkotor.berat))
                // $('#totalongkoshtml01').html(pembulatankoma(result.totalongkos.ongkos).toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))


            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    $('.tambahbuyback').submit(function(e) {
        e.preventDefault()
        let form = $('.tambahbuyback')[0];
        let data = new FormData(form)
        Swal.fire({
            title: 'Tambah',
            text: "Yakin ingin Buyback Barang ini ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Tambah',
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    data: data,
                    url: "<?php echo base_url('/tambahbuyback'); ?>",
                    contentType: false,
                    processData: false,
                    cache: false,
                    dataType: "json",
                    success: function(result) {
                        if (result.error) {
                            console.log(result)
                            if (result.error.kurang) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: result.error.kurang,
                                })
                            }
                            if (result.error.nilai_tukar1) {
                                $('#nilai_tukar1').addClass('is-invalid')
                                $('.nilai_tukar1msg').html(result.error.nilai_tukar1)
                            } else {
                                $('#nilai_tukar1').removeClass('is-invalid')
                                $('.nilai_tukar1msg').html('')
                            }
                            if (result.error.berat1) {
                                $('#berat1').addClass('is-invalid')
                                $('.berat1msg').html(result.error.berat1)
                            } else {
                                $('#berat1').removeClass('is-invalid')
                                $('.berat1msg').html('')
                            }
                            if (result.error.harga_beli1) {
                                $('#harga_beli1').addClass('is-invalid')
                                $('.harga_beli1msg').html(result.error.harga_beli1)
                            } else {
                                $('#harga_beli1').removeClass('is-invalid')
                                $('.harga_beli1msg').html('')
                            }
                            if (result.error.qty1) {
                                $('#qty1').addClass('is-invalid')
                                $('.qty1msg').html(result.error.qty1)
                            } else {
                                $('#qty1').removeClass('is-invalid')
                                $('.qty1msg').html('')
                            }
                        } else {
                            $('#nilai_tukar1').removeClass('is-invalid')
                            $('.nilai_tukar1msg').html('')
                            $('#jenis').removeClass('is-invalid')
                            $('.jenismsg').html('')
                            $('#berat1').removeClass('is-invalid')
                            $('.berat1msg').html('')
                            $('#harga_beli1').removeClass('is-invalid')
                            $('.harga_beli1msg').html('')
                            $('#qty1').removeClass('is-invalid')
                            $('.qty1msg').html('')
                            console.log(result)

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Tambah',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK',
                                allowOutsideClick: false
                            }).then((choose) => {
                                if (choose.isConfirmed) {
                                    $('#modal-edit').modal('toggle');
                                    $('#modal-nota').modal('toggle');
                                    tampildatabuyback()
                                }
                            })
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                })
            }
        })
    })


    function tambah(id) {
        console.log('tambah')
        $.ajax({
            type: "get",
            dataType: "json",
            url: "<?php echo base_url('tampilbuyback'); ?>",
            data: {
                id: id,
            },
            success: function(result) {
                // console.log(result)
                if (result.data.kode.substr(0, 1) != 3) {
                    $('#qty1').attr('readonly', 'readonly')
                    console.log(result.data.kode)
                } else {
                    $('#qty1').removeAttr('readonly')
                }
                $('#modal-edit').modal('show');
                $('#qty1').val(result.data.saldo)
                $('#berat1').val(result.data.berat)
                $('#nilai_tukar1').val(result.data.nilai_tukar)
                $('#harga_beli1').val(result.data.harga_beli)
                $('#id').val(result.data.id_detail_penjualan)
                $('#kel').val(result.data.kode.substr(0, 1))
                console.log($('#id').val())
                HarusBayar()

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })



    }

    $(document).ready(function() {
        // $("#refreshtombol").load("/draftpenjualan/" + document.getElementById('dateid').value + " #refreshtombol");
        tampildata()
        tampildatabuyback()
        $('.insertcust').submit(function(e) {
            e.preventDefault()
            let form = $('.insertcust')[0];
            let data = new FormData(form)
            $.ajax({
                type: "POST",
                data: data,
                url: "<?php echo base_url('insertcustomer'); ?>",
                dataType: "json",
                contentType: false,
                processData: false,
                cache: false,
                beforeSend: function() {
                    $('.btntambah').html('<i class="fa fa-spin fa-spinner">')
                },
                complete: function() {
                    $('.btntambah').html('Tambah')
                },
                success: function(result) {
                    tampilcustomer()
                    $('#modal-lg').modal('toggle');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        })
    })

    function HarusBayar() {
        var kel = parseFloat(document.getElementById('kel').value)
        var qty = parseFloat(document.getElementById('qty1').value)
        var hargabeli = parseFloat(document.getElementById('harga_beli1').value)
        var nilaitukar = parseFloat(document.getElementById('nilai_tukar1').value)
        var berat = parseFloat(document.getElementById('berat1').value)
        const totalharga = document.getElementById('totalhargaedit')
        if (kel == 3) {
            harusbyr = berat * qty * hargabeli
        } else {
            beratmurni = berat * nilaitukar / 100
            harusbyr = hargabeli * beratmurni
        }
        // brtmurni.innerHTML = beratmurni.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        totalharga.innerHTML = harusbyr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        console.log(harusbyr)

    }

    function myPembayaran() {
        console.log('masuk')
        const carabyr = document.getElementById('pembayaran').value
        const metod1 = $('.metodebayar')
        const nmbank = $('.namabankhtml')
        const metod2 = document.getElementsByClassName('metodebayar2')
        metod1[0].innerHTML = ''
        nmbank[0].innerHTML = ''
        metod2[0].innerHTML = ''

        var NamaBank = '<label>Nama Bank Debit/CC</label><input type="text" id="namabank" name="namabank" class="form-control" placeholder="Masukan Nama Bank"><div id="validationServerUsernameFeedback" class="invalid-feedback namabankmsg"></div>'
        var Transfer = '<label>Transfer</label><input type="number" onkeyup="transfer__()" min="0" id="transfer" name="transfer" class="form-control" placeholder="Masukan transfer"><div id="validationServerUsernameFeedback" class="invalid-feedback transfermsg"></div>'
        var Tunai = '<label>Tunai</label><input type="number" onkeyup="tunai__()" min="0" id="tunai" name="tunai" class="form-control" placeholder="Masukan tunai"><div id="validationServerUsernameFeedback" class="invalid-feedback tunaimsg"></div>'
        console.log(carabyr)

        if (carabyr == 'Transfer') {
            metod1[0].innerHTML = Transfer
            nmbank[0].innerHTML = NamaBank
            document.getElementById('transfer').value = document.getElementById('harusbayar').innerHTML.replaceAll('.', '')

        }
        if (carabyr == 'Tunai') {
            metod1[0].innerHTML = Tunai
            document.getElementById('tunai').value = document.getElementById('harusbayar').innerHTML.replaceAll('.', '')

        }

        if (carabyr == 'Tunai&Transfer') {
            metod1[0].innerHTML = Transfer
            nmbank[0].innerHTML = NamaBank
            metod2[0].innerHTML = Tunai
            document.getElementById('transfer').value = document.getElementById('harusbayar').innerHTML.replaceAll('.', '')

        }
    }

    function transfer__() {
        var tunai = document.getElementById('tunai').value
        var trnsfr = document.getElementById('transfer').value
        var harga = document.getElementById('harusbayar').innerHTML.replaceAll('.', '')
        hasiltrnsfr = harga - trnsfr
        // Math.abs(hasiltrnsfr)
        // document.getElementById('tunai').value = hasiltunai
        if (hasiltrnsfr < 0) {
            document.getElementById('tunai').value = 0
        } else {
            document.getElementById('tunai').value = Math.abs(hasiltrnsfr)
        }
    }

    function tunai__() {
        var tunai = document.getElementById('tunai').value
        var harga = document.getElementById('harusbayar').innerHTML.replaceAll('.', '')
        var trnsfr = document.getElementById('transfer').value
        hasiltrnsfr = harga - tunai
        // Math.abs(hasiltrnsfr)
        // document.getElementById('tunai').value = hasiltunai
        if (hasiltrnsfr < 0) {
            document.getElementById('transfer').value = 0
        } else {
            document.getElementById('transfer').value = Math.abs(hasiltrnsfr)
        }
    }

    Webcam.set({
        width: 320,
        height: 240,
        image_format: 'jpeg',
        jpeg_quality: 100,
        flip_horiz: true,
    });

    function cameranyala() {
        if ($(".image-tag").val()) {
            document.getElementById('my_camera').innerHTML = '<img src="' + data_uri + '">'
        } else {
            Webcam.attach('#my_camera');
        }
    }

    function Ambil_foto() {
        Webcam.snap(function(data_uri) {
            $(".image-tag").val(data_uri);
            Webcam.reset()
            // Webcam.attach('#my_camera');
            // console.log($(".image-tag").val())
            document.getElementById('my_camera').innerHTML = '<img src="' + data_uri + '">'
        })
    }

    function Foto_ulang() {
        document.getElementById('my_camera').innerHTML = ''
        $(".image-tag").val('');
        Webcam.attach('#my_camera');
    }
    $(document).ready(function() {
        $(".modal").on("hidden.bs.modal", function() {
            Webcam.reset('#my_camera')
        });
    })
</script>
<?= $this->endSection(); ?>