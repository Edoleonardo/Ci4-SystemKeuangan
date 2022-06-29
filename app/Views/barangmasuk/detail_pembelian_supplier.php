<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .table>* {
        vertical-align: middle;
        text-align: center;
    }

    .table>tbody>tr>* {
        vertical-align: middle;
        text-align: center;
    }

    /* th {
        vertical-align: middle;
        text-align: center;
    } */
    .modal {
        overflow: auto !important;
    }

    .imgg {
        width: 100px;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Barang Masuk Supplier</h1>
                </div><!-- /.col -->
                <!-- /.content-header -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/barangmasuk">Home</a></li>
                        <li class="breadcrumb-item"><a href="/barangmasuk">Pembelian Supplier</a></li>
                        <li class="breadcrumb-item active">Detail Barang Masuk Supplier</li>
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
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped">
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
                                    <td><?= date("d-m-Y", strtotime($datapembelian['created_at'])) ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Nota Supplier</td>
                                    <td><?= date("d-m-Y", strtotime($datapembelian['tgl_faktur'])) ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Jatuh Tempo</td>
                                    <td><?= date("d-m-Y", strtotime($datapembelian['tgl_jatuh_tempo'])) ?></td>
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
                            <!-- <form id="cancelform" action="/cancelbarang/<?= $datapembelian['id_date_pembelian'] ?>" method="POST" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="button" class="btn btn-app" onclick="return konfrimcancel()"><i class="fas fa-window-close"></i> Cancel Pembelian </button>
                            </form> -->
                            <?php if ($datapembelian['cara_pembayaran'] == 'Lunas') : ?>
                                <a class="btn btn-app bg-primary" type="button">
                                    <i class="fas fa-check"></i> Lunas
                                </a>
                            <?php else : ?>
                                <!-- <a class="btn btn-app" type="button" data-toggle="modal" data-target="#modal-xl">
                                    <i class="fas fa-redo"></i> Retur Barang
                                </a> -->
                                <a class="btn btn-app bg-danger" onclick="UbahHargaMurni()" type="button" data-toggle="modal" data-target="#modal-bayar">
                                    <i class="fas fa-money-bill"></i> Bayar
                                </a>
                            <?php endif ?>
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
                        <div class="card">
                            <!-- /.card-header -->
                            <?php if ($datapembelian['kelompok'] == 1) : ?>
                                <div class="card-body table-responsive p-0" id="datatable" style="max-height: 500px;">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th style="text-align: center;"><?= $datapembelian['total_qty'] ?></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th style="text-align: center;"><?= $datapembelian['total_berat_rill'] ?></th>
                                                <th style="text-align: center;"><?= $datapembelian['berat_murni_rill'] ?></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th style="text-align: center;"><?= number_format($datapembelian['total_bayar'], 0, '.', ',') ?></th>
                                            </tr>
                                        </thead>
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
                            <?php endif; ?>
                            <?php if ($datapembelian['kelompok'] == 2 || $datapembelian['kelompok'] == 3 || $datapembelian['kelompok'] == 4) : ?>
                                <div class="card-body table-responsive p-0" id="datatable" style="max-height: 500px;">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th style="text-align: center;"><?= $datapembelian['total_qty'] ?></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th style="text-align: center;"><?= $datapembelian['total_berat_rill'] ?></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th style="text-align: center;"><?= number_format($datapembelian['total_bayar'], 0, '.', ',') ?></th>
                                            </tr>
                                        </thead>
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
                                </div>
                            <?php endif; ?>
                            <?php if ($datapembelian['kelompok'] == 5) : ?>
                                <div class="card-body table-responsive p-0" id="datatable" style="max-height: 500px;">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th style="text-align: center;"><?= $datapembelian['total_qty'] ?></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th style="text-align: center;"><?= $datapembelian['total_carat_rill'] ?></th>
                                                <th></th>
                                                <th style="text-align: center;"><?= number_format($datapembelian['total_bayar'], 0, '.', ',') ?></th>
                                            </tr>
                                        </thead>
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
                                </div>
                            <?php endif; ?>
                            <?php if ($datapembelian['kelompok'] == 6) : ?>
                                <div class="card-body table-responsive p-0" id="datatable" style="max-height: 500px;">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th style="text-align: center;"><?= $datapembelian['total_qty'] ?></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th style="text-align: center;"><?= number_format($datapembelian['total_bayar'], 0, '.', ',') ?></th>
                                            </tr>
                                        </thead>
                                        <thead>
                                            <tr>
                                                <th>Gambar</th>
                                                <th>Kode</th>
                                                <th>Qty</th>
                                                <th>Jenis</th>
                                                <th>Model</th>
                                                <th>Keterangan</th>
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
                                                    <td><?= number_format($row['harga_beli'], 2, ",", ".") ?></td>
                                                    <td><?= number_format($row['total_harga'], 2, ",", ".") ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
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
                                    <div class="card-body p-0" id="byr11">
                                        <table class="table table-striped" id="byr22">
                                            <thead>
                                                <tr>
                                                    <th>Cara Pembayaran</th>
                                                    <th style="text-align: center;">Kode</th>
                                                    <th>Jumlah Bayar</th>
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
                                                        <td> <?= $byr['cara_pembayaran'] ?> </td>
                                                        <td><?= ($byr['no_retur']) ? $byr['no_retur'] : $byr['kode_24k'] ?></td>
                                                        <td><?= number_format($byr['jumlah_pembayaran'], 2, ',', '.') ?></td>
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
                            <?= csrf_field(); ?>
                            <input type="hidden" name="kelompok" id="kelompok" value="<?= $datapembelian['kelompok'] ?>">
                            <input type="hidden" name="dateid" id="dateid" value="<?= $datapembelian['id_date_pembelian'] ?>">
                            <input type="hidden" name="hasil" id="hasil" value="0">
                            <input type="hidden" name="berathasil" id="berathasil" value="0">
                            <div class="card-header">
                                <h4 style="text-align: center;" id="totalbayar"></h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Harga Saat ini</label><input type="number" onchange="UbahHargaMurni()" onfocus="this.select()" min="0" value="<?= $datapembelian['harga_murni'] ?>" id="harga_murni" name="harga_murni" class="form-control harga_murni" placeholder="Masukan harga">
                                            <div id="validationServerUsernameFeedback" class="invalid-feedback harga_murnimsg"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><a href="#" onclick="MasukField('pembulatan')">Pembulatan</a></label><input autocomplete="off" type="number" onchange="myDataBayar()" onfocus="this.select()" min="0" id="pembulatan" name="pembulatan" class="form-control" placeholder="Masukan pembulatan">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><a href="#" onclick="MasukField('tunai')">Tunai</a></label><input type="number" onchange="myDataBayar()" onfocus="this.select()" min="0" id="tunai" name="tunai" class="form-control" placeholder="Masukan tunai">
                                            <div id="validationServerUsernameFeedback" class="invalid-feedback tunaimsg"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><a href="#" onclick="MasukField('transfer')">Transfer</a></label><input type="number" onchange="myDataBayar()" onfocus="this.select()" min="0" id="transfer" name="transfer" class="form-control" placeholder="Masukan transfer">
                                            <div id="validationServerUsernameFeedback" class="invalid-feedback transfermsg"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Bank</label><input type="text" min="0" id="namabank" name="namabank" class="form-control" placeholder="Pilih Bank" readonly>
                                            <div id="validationServerUsernameFeedback" class="invalid-feedback namabankmsg"></div>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="row">
                                            <?php foreach ($bank as $m) : ?>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <button type="button" style="width: 200px;" onclick="pilihbank('<?= $m['nama_bank'] ?>')" class="btn btn-block btn-outline-info btn-lg"><?= $m['nama_bank'] ?></button>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($datapembelian['kelompok'] == 1) : ?>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="card">
                                                <div class="form-group">
                                                    <label><a href="#" data-toggle="modal" data-target="#modal-retur">Retur Sales</a></label>
                                                    <input type="text" onfocus="this.select()" id="no_retur" name="no_retur" class="form-control" placeholder="Masukan Nomor Retur">
                                                    <div id="validationServerUsernameFeedback" class="invalid-feedback no_returmsg">
                                                    </div>
                                                </div>
                                                <button type="button" onclick="InputRetur()" id="btnsubmitform" class="btn btn-info btn-flat btnsubmitform">Tambah Retur</button>
                                            </div>
                                        </div>
                                        <!-- <div class="col-sm-6">
                                        <div class="card">
                                            <div class="form-group">
                                                <label><a href="#" data-toggle="modal" data-target="#modal-bahan24k">Bahan 24K</a></label>
                                                <div class="input-group input-group-sm">
                                                    <input type="text" onfocus="this.select()" min="0" id="kode_bahan24k" name="kode_bahan24k" class="form-control" placeholder="Masukan kode">
                                                    <span class="input-group-append">
                                                        <button type="button" onclick="InputBahan()" id="btnsubmitform" class="btn btn-info btn-flat btnsubmitform">Ok</button>
                                                    </span>
                                                    <div id="validationServerUsernameFeedback" class="invalid-feedback kode_bahan24kmsg"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                        <div class="col-8">
                                            <div class="card">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label><a href="#" data-toggle="modal" data-target="#modal-bahan24k">Bahan 24K</a></label>
                                                            <input type="text" onfocus="this.select()" min="0" id="kode_bahan24k" name="kode_bahan24k" class="form-control" placeholder="Masukan kode">
                                                            <div id="validationServerUsernameFeedback" class="invalid-feedback kode_bahan24kmsg"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Berat Bahan</label>
                                                            <input type="text" onfocus="this.select()" min="0" id="beratbahan" name="beratbahan" class="form-control" placeholder="Masukan Berat">
                                                            <div id="validationServerUsernameFeedback" class="invalid-feedback beratbahanmsg"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" onclick="InputBahan()" id="btnsubmitform" class="btn btn-info btn-flat btnsubmitform">Tambah Bahan</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body table-responsive p-0" id="refresbayartbl">
                                                    <table class="table table-hover text-nowrap">
                                                        <thead>
                                                            <tr>
                                                                <th>Cara Pembayaran</th>
                                                                <th>Jumlah Bayar</th>
                                                                <th style="text-align: center;">Kode</th>
                                                                <th>Berat Murni</th>
                                                                <th>Hapus</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($databayar as $byr) : ?>
                                                                <tr>
                                                                    <td> <?= $byr['cara_pembayaran'] ?> </td>
                                                                    <td><?= number_format($byr['jumlah_pembayaran'], 2, ',', '.') ?></td>
                                                                    <td><?= ($byr['no_retur']) ? $byr['no_retur'] : $byr['kode_24k'] ?></td>
                                                                    <td><?= number_format($byr['berat_murni'], 2, ',', '.') ?></td>
                                                                    <td><button type='button' class='btn btn-block bg-gradient-danger' onclick="hapus(<?= $byr['id_pembayaran'] ?>)"><i class='fas fa-trash'></i></button></td>

                                                                </tr>
                                                            <?php endforeach; ?>
                                                            <!-- <tr>
                                                            <td style="background-color: lightblue;">Harga Saat ini</td>
                                                            <td style="background-color: lightblue;" id="harga_murnihtml"></td>
                                                            <td style="background-color: lightblue;">Berat Murni </td>
                                                            <td style="background-color: lightblue;" id="totalberatmurnihtml1"></td>
                                                            <td style="background-color: lightblue;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="background-color: lightblue;">Berat Murni</td>
                                                            <td style="background-color: lightblue;" id="totalberatmurnihtml"></td>
                                                            <td style="background-color: lightblue;">Harga Bayar</td>
                                                            <td style="background-color: lightblue;" id="totalbersih1"></td>
                                                            <td style="background-color: lightblue;"></td>
                                                        </tr> -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Selesai</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($datapembelian['kelompok'] == 1) : ?>
            <div class="modal fade" id="modal-bahan24k">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Pilih Barang Bahan 24K</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-body table-responsive p-0" id="bahan24k1" style="max-height: 500px;">
                                    <table id="bahan24k2" class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Kode</th>
                                                <th>Qty</th>
                                                <th>Keterangan</th>
                                                <th>Berat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($tampil24k as $row) : ?>
                                                <tr onclick="DataBahan24k(<?= $row['barcode'] ?>)">
                                                    <td><?= $row['barcode'] ?></td>
                                                    <td><?= $row['qty'] ?></td>
                                                    <td><?= $row['jenis'] ?>, <?= $row['model'] ?>, <?= $row['keterangan'] ?></td>
                                                    <td><?= $row['berat'] ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" onclick=" $('#modal-bahan24k').modal('toggle');">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <div class="modal fade" id="modal-retur">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Pilih Barang Retur Sales</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-body table-responsive p-0" id="tblretur" style="max-height: 500px;">
                                    <table id="retursales" class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nomor Retur</th>
                                                <th>keterangan</th>
                                                <th>total_berat_murni</th>
                                                <th>tanggal_retur</th>
                                                <th>jumlah_barang</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($tampilretur as $row) : ?>
                                                <tr onclick="DataReturSales('<?= $row['no_retur'] ?>')">
                                                    <td><?= $row['no_retur'] ?></td>
                                                    <td><?= $row['keterangan'] ?></td>
                                                    <td><?= $row['total_berat_murni'] ?></td>
                                                    <td><?= $row['tanggal_retur'] ?></td>
                                                    <td><?= $row['jumlah_barang'] ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" onclick=" $('#modal-retur').modal('toggle');">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        <?php endif; ?>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<!-- Main Footer -->
<footer class="main-footer">

</footer>
<script type="text/javascript">
    function InputRetur() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('inputretursales'); ?>",
            data: {
                no_retur: $('#no_retur').val(),
                dateid: document.getElementById('dateid').value,
                harga_murni: document.getElementById('harga_murni').value
            },
            success: function(result) {
                console.log(result)
                if (result.error) {
                    if (result.error.harga_murni) {
                        $('#harga_murni').addClass('is-invalid')
                        $('.harga_murnimsg').html(result.error.harga_murni)
                    } else {
                        $('#harga_murni').removeClass('is-invalid')
                        $('.harga_murni').html('')
                    }
                    if (result.error.no_retur) {
                        $('#no_retur').addClass('is-invalid')
                        $('.no_returmsg').html(result.error.no_retur)
                    } else {
                        $('#no_retur').removeClass('is-invalid')
                        $('.no_retur').html('')
                    }
                } else {
                    $('#harga_murni').removeClass('is-invalid')
                    $('.harga_murni').html('')
                    $('#no_retur').removeClass('is-invalid')
                    $('.no_retur').html('')
                    $("#refresbayartbl").load("/detailpembelian/" + document.getElementById('dateid').value + " #refresbayartbl");
                    refreshdata()
                    myDataBayar()
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function InputBahan() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('inputbahan24k'); ?>",
            data: {
                kode_bahan24k: $('#kode_bahan24k').val(),
                dateid: $('#dateid').val(),
                beratbahan: $('#beratbahan').val()
            },
            success: function(result) {
                console.log(result)
                if (result.error) {
                    if (result.error.beratbahan) {
                        $('#beratbahan').addClass('is-invalid')
                        $('.beratbahanmsg').html(result.error.beratbahan)
                    } else {
                        $('#beratbahan').removeClass('is-invalid')
                        $('.beratbahan').html('')
                    }
                    if (result.error.kode_bahan24k) {
                        $('#kode_bahan24k').addClass('is-invalid')
                        $('.kode_bahan24kmsg').html(result.error.kode_bahan24k)
                    } else {
                        $('#kode_bahan24k').removeClass('is-invalid')
                        $('.kode_bahan24k').html('')
                    }
                } else {
                    $('#beratbahan').removeClass('is-invalid')
                    $('.beratbahan').html('')
                    $('#kode_bahan24k').removeClass('is-invalid')
                    $('.kode_bahan24k').html('')
                    $("#refresbayartbl").load("/detailpembelian/" + document.getElementById('dateid').value + " #refresbayartbl");
                    $("#bahan24k1").load("/detailpembelian/" + document.getElementById('dateid').value + " #bahan24k2");
                    refreshdata()
                    myDataBayar()
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function pilihbank(nmbank) {
        $('#namabank').val(nmbank)
    }

    function UbahHargaMurni() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('ubahhargamurni'); ?>",
            data: {
                val: $('#harga_murni').val(),
                dateid: document.getElementById('dateid').value
            },
            success: function(result) {
                console.log(result)
                if (result.error) {
                    if (result.error) {
                        $('#harga_murni').addClass('is-invalid')
                        $('.harga_murnimsg').html(result.error)
                    } else {
                        $('#harga_murni').removeClass('is-invalid')
                        $('.harga_murni').html('')
                    }
                } else {
                    $('#harga_murni').removeClass('is-invalid')
                    $('.harga_murni').html('')
                    $("#refresbayartbl").load("/detailpembelian/" + document.getElementById('dateid').value + " #refresbayartbl");
                    myDataBayar()
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function hapus(id) {
        Swal.fire({
            title: 'Hapus',
            text: "Yakin ingin Hapus Pembayaran ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "<?php echo base_url('deletepembayaran'); ?>",
                    data: {
                        id: id,
                        dateid: document.getElementById('dateid').value
                    },
                    success: function(result) {
                        Swal.fire({
                            icon: 'success',
                            title: result.sukses,
                        })
                        $("#refresbayartbl").load("/detailpembelian/" + document.getElementById('dateid').value + " #refresbayartbl");
                        refreshdata()
                        myDataBayar()
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                })

            }
        })

    }

    // function SelesaiBayar() {
    //     Swal.fire({
    //         title: 'Selesai',
    //         text: "Selesai Bayar ?",
    //         icon: 'info',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Selesai',
    //     }).then((choose) => {
    //         if (choose.isConfirmed) {
    //             $.ajax({
    //                 type: "GET",
    //                 dataType: "json",
    //                 url: "<?php echo base_url('selesaipembayaran'); ?>",
    //                 data: {
    //                     dateid: document.getElementById('dateid').value
    //                 },
    //                 success: function(result) {
    //                     if (result.error) {
    //                         Swal.fire({
    //                             icon: 'warning',
    //                             title: result.error,
    //                         })
    //                     }
    //                     if (result.pesan) {
    //                         Swal.fire({
    //                             icon: 'success',
    //                             title: result.pesan,
    //                         })
    //                         $('#modal-bayar').modal('toggle');
    //                         $("#cardbayar").load("/detailpembelian/" + document.getElementById('dateid').value + " #cardbayar");
    //                         $("#byr11").load("/detailpembelian/" + document.getElementById('dateid').value + " #byr22");

    //                     }
    //                 },
    //                 error: function(xhr, ajaxOptions, thrownError) {
    //                     alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    //                 }
    //             })

    //         }
    //     })
    // }

    function DataBahan24k(id) {
        $('#kode_bahan24k').val(id)
        $('#modal-bahan24k').modal('toggle');
    }

    function DataReturSales(id) {
        $('#no_retur').val(id)
        $('#modal-retur').modal('hide');

    }

    function pembulatankoma(berat) {
        var num = Number(berat) // The Number() only visualizes the type and is not needed
        var roundedString = num.toFixed(2);
        var rounded = Number(roundedString);
        return rounded
    }

    function MasukField(jenis) {
        var hasil = $('#hasil').val()
        if (jenis == 'pembulatan') {
            $('#pembulatan').val(hasil)
        }
        if (jenis == 'tunai') {
            $('#tunai').val(hasil)
        }
        if (jenis == 'transfer') {
            $('#transfer').val(hasil)
        }
        myDataBayar()
    }

    function myDataBayar() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('ajaxdetailpembelian'); ?>",
            data: {
                dateid: '<?php echo $datapembelian['id_date_pembelian'] ?>'
            },
            success: function(result) {
                const tunai = $('#tunai').val()
                const transfer = $('#transfer').val()
                const pembulatan = $('#pembulatan').val()
                var hasil = result.totalbyr.byr_barang - tunai - transfer - pembulatan
                var hasilberat = hasil / result.totalbyr.harga_murni
                console.log(hasilberat)
                $('#hasil').val(hasil)
                if ($('#kelompok').val() == 5) {
                    $('#totalbayar').html(' Rp ' + hasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + '/ Carat : ' + pembulatankoma(hasilberat))
                } else if ($('#kelompok').val() == 6 || $('#kelompok').val() == 2) {
                    $('#totalbayar').html(' Rp ' + hasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
                } else {
                    $('#totalbayar').html(' Rp ' + hasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + '/ Berat : ' + pembulatankoma(hasilberat))

                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }



    function konfrim() {
        Swal.fire({
            title: 'Retur Barang ',
            text: "Apakah Ingin Retur Pembelian ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Retur',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("returform").submit();
            }
        })
    }

    function konfrimcancel() {
        Swal.fire({
            title: 'Cancel Pembelian',
            text: "Apakah Cancel Retur Pembelian ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Cancel Pembelian',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("cancelform").submit();
            }
        })
    }

    $('.pembayaranform').submit(function(e) {
        e.preventDefault()
        Swal.fire({
            title: 'Selesai',
            text: "Selesai Bayar ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Selesai',
        }).then((choose) => {
            if (choose.isConfirmed) {
                let form = $('.pembayaranform')[0];
                let data = new FormData(form)
                $.ajax({
                    type: "POST",
                    data: data,
                    url: "<?php echo base_url('ajaxpembayaran') ?>",
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    cache: false,
                    beforeSend: function() {
                        $('.btntambah').html('<i class="fa fa-spin fa-spinner">')
                    },
                    complete: function() {
                        $('.btntambah').html('Bayar')
                    },
                    success: function(result) {
                        console.log(result)
                        if (result != 'error') {
                            if (result.error) {
                                if (result.error.namabank) {
                                    $('#namabank').addClass('is-invalid')
                                    $('.namabankmsg').html(result.error.namabank)
                                } else {
                                    $('#namabank').removeClass('is-invalid')
                                    $('.namabank').html('')
                                }
                                if (result.error.transfer) {
                                    $('#transfer').addClass('is-invalid')
                                    $('.transfermsg').html(result.error.transfer)
                                } else {
                                    $('#transfer').removeClass('is-invalid')
                                    $('.transfer').html('')
                                }
                                if (result.error.saldo) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: result.error.saldo,
                                    })
                                }

                            } else {
                                $('#namabank').removeClass('is-invalid')
                                $('.namabank').html('')
                                $('#transfer').removeClass('is-invalid')
                                $('.transfer').html('')

                                $("#refresbayartbl").load("/detailpembelian/" + document.getElementById('dateid').value + " #refresbayartbl");
                                myDataBayar()
                                if (result.pesan_lebih) {
                                    if (result.pesan_lebih.pesan) {
                                        Swal.fire({
                                            icon: 'info',
                                            title: result.pesan_lebih.pesan,
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonText: 'OK',
                                        })
                                    }
                                }
                                if (result.berhasil) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: result.berhasil.pesan,
                                    })
                                    $('#modal-bayar').modal('toggle');
                                    $("#cardbayar").load("/detailpembelian/" + document.getElementById('dateid').value + " #cardbayar");
                                    $("#byr11").load("/detailpembelian/" + document.getElementById('dateid').value + " #byr22");

                                }
                            }
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Tidak ada Data',
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

    function refreshdata() {
        $("#tblretur").load("/detailpembelian/" + document.getElementById('dateid').value + " #retursales");
    }


    $(document).ready(function() {
        myDataBayar()

    })
</script>
<?= $this->endSection(); ?>