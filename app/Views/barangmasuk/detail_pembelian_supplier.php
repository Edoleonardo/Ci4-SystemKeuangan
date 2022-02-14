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
            <div class="col-6">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Id date</td>
                                    <td><?= $datapembelian['id_date_pembelian'] ?></td>
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
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-app">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a class="btn btn-app" href="/printbarcode/<?= $datapembelian['id_date_pembelian'] ?>" target="_blank">
                            <i class="fas fa-barcode"></i> Print Barcode
                        </a>
                        <a class="btn btn-app" type="button" data-toggle="modal" data-target="#modal-xl">
                            <i class="fas fa-redo"></i> Retur Barang
                        </a>
                        <form id="cancelform" action="/cancelbarang/<?= $datapembelian['id_date_pembelian'] ?>" method="POST" class="d-inline">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="button" class="btn btn-app" onclick="return konfrimcancel()"><i class="fas fa-window-close"></i> Cancel Pembelian </button>
                        </form>
                        <?php if ($datapembelian['cara_pembayaran'] == 'Bayar Nanti') : ?>
                            <a class="btn btn-app bg-danger" type="button" data-toggle="modal" data-target="#modal-bayar">
                                <i class="fas fa-money-bill"></i> Bayar
                            </a>
                        <?php else : ?>
                            <a class="btn btn-app bg-primary" type="button" data-toggle="modal" data-target="#modal-bayar">
                                <i class="fas fa-check"></i> Lunas
                            </a>
                        <?php endif ?>
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
                            <div class="card-body table-responsive p-0" id="datatable">
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
                                            <th>Kadar</th>
                                            <th>Nilai Tukar</th>
                                            <th>Merek</th>
                                            <th>Total Harga</th>
                                            <th>Edit</th>
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
                                                <td><?= $row['harga_beli'] ?></td>
                                                <td><?= $row['kadar'] ?></td>
                                                <td><?= $row['nilai_tukar'] ?></td>
                                                <td><?= $row['merek'] ?></td>
                                                <td><?= number_format($row['total_harga'], 2, ",", ".") ?></td>
                                                <td><a class="btn btn-block bg-gradient-primary" type="button" onclick="EditData(<?= $row['kode'] ?>)">Edit</a></td>
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
                                                <td><?= number_format($totalberat['berat'], 2, ',', '.') ?></td>
                                            </tr>
                                            <tr>
                                                <td>Total Berat Murni</td>
                                                <td><?= number_format($totalberatmurni['berat_murni'], 2, ',', '.') ?></td>
                                            </tr>

                                            <tr>
                                                <td>Total Bersih</td>
                                                <td id="totalbersihconst"><?= number_format($datapembelian['total_bayar'], 2, ",", ".") ?></td>
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
                                <div class="card-body p-0">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td>Metode Pembayaran</td>
                                                <td><?= $datapembelian['cara_pembayaran'] ?></td>
                                            </tr>
                                            <?php if ($datapembelian['nama_bank']) : ?>
                                                <tr>
                                                    <td>Nama Bank</td>
                                                    <td><?= $datapembelian['nama_bank'] ?></td>
                                                </tr>
                                            <?php endif ?>
                                            <?php if ($datapembelian['pembulatan']) : ?>
                                                <tr>
                                                    <td>Pembulatan</td>
                                                    <td><?= number_format($datapembelian['pembulatan'], 2, ",", ".") ?></td>
                                                </tr>
                                            <?php endif ?>
                                            <?php if ($datapembelian['charge']) : ?>
                                                <tr>
                                                    <td>Charge</td>
                                                    <td><?= $datapembelian['charge'] ?> %</td>
                                                </tr>
                                            <?php endif ?>
                                            <?php if ($datapembelian['tunai']) : ?>
                                                <tr>
                                                    <td>Tunai</td>
                                                    <td><?= number_format($datapembelian['tunai'], 2, ',', '.') ?></td>
                                                </tr>
                                            <?php endif ?>
                                            <?php if ($datapembelian['debitcc']) : ?>
                                                <tr>
                                                    <td>Debit / CC</td>
                                                    <td><?= number_format($datapembelian['debitcc'], 2, ',', '.') ?></td>
                                                </tr>
                                            <?php endif ?>
                                            <?php if ($datapembelian['transfer']) : ?>
                                                <tr>
                                                    <td>Transfer</td>
                                                    <td><?= number_format($datapembelian['transfer'], 2, ',', '.') ?></td>
                                                </tr>
                                            <?php endif ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.container-fluid -->
        <div class="modal fade" id="modal-xl">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Retur Barang</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
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
                                            <th>Kadar</th>
                                            <th>Nilai Tukar</th>
                                            <th>Merek</th>
                                            <th>Total Harga</th>
                                            <th>Retur</th>
                                        </tr>
                                    </thead>
                                    <tbody id="databeli">
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
                                                <td><?= $row['harga_beli'] ?></td>
                                                <td><?= $row['kadar'] ?></td>
                                                <td><?= $row['nilai_tukar'] ?></td>
                                                <td><?= $row['merek'] ?></td>
                                                <td><?= number_format($row['total_harga']) ?></td>
                                                <td>
                                                    <form id="returform" action="/returbarang/<?= $row['id_detail_pembelian']; ?>" method="POST" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="dateid" value="<?= $row['id_date_pembelian'] ?>">
                                                        <button type="button" class="btn btn-danger" onclick="return konfrim()">Retur </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
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
                                <div class="col-sm-6">
                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Pembulatan</label>
                                            <input onkeyup="myPembulatan()" type="number" value="<?= (isset($datapembelian['pembulatan'])) ? $datapembelian['pembulatan'] : ''; ?>" min="0" id="pembulatan" name="pembulatan" class="form-control" placeholder="Masukan Pembulatan">
                                            <input type="hidden" name="dateid" value="<?= $datapembelian['id_date_pembelian'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <!-- ./card-header -->
                                            <div class="p-0">
                                                <!-- text input -->
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Cara Pembayaran</label>
                                                            <select onchange="myPembayaran()" name="pembayaran" class="form-control" id="pembayaran" name="pembayaran">
                                                                <option value="Bayar Nanti" selected>Bayar Nanti</option>
                                                                <option value="Debit/CC">Debit/CC</option>
                                                                <option value="Debit/CCTranfer">Debit/CC & Tranfer</option>
                                                                <option value="Transfer">Transfer</option>
                                                                <option value="Tunai">Tunai</option>
                                                                <option value="Tunai&Debit/CC">Tunai & Debit/CC</option>
                                                                <option value="Tunai&Transfer">Tunai & Transfer</option>
                                                            </select>
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
                                <div class="col-sm-6">
                                    <div class="card">
                                        <!-- /.card-header -->
                                        <div class="card-body p-0">
                                            <table class="table table-hover text-nowrap">
                                                <tbody>
                                                    <tr>
                                                        <td>Total Berat</td>
                                                        <td id="totalberathtml"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Berat Murni</td>
                                                        <td id="totalberatmurnihtml"></td>
                                                    </tr>
                                                    <tr id="tabelbank">
                                                    </tr>
                                                    <tr id="tabelbayar1">
                                                    </tr>
                                                    <tr id="tabelbayar2">
                                                    </tr>
                                                    <tr id="tabelbayar3">
                                                    </tr>
                                                    <tr>
                                                        <td>Pembulatan</td>
                                                        <td id="pembulatanhtml"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Bersih</td>
                                                        <td id="totalbersih"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Harus Bayar</td>
                                                        <td id="totalbersih1"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btntambah">Bayar</button>
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
                        <h4 class="modal-title">Edit</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/editdataform" id="editdataform" class="editdataform" name="editdataform">
                            <div class="row">
                                <div class="col-sm-2">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Merek</label>
                                        <select name="merek" class="form-control" id="merek">
                                            <?php foreach ($merek as $m) : ?>
                                                <option value="<?= $m['nama_merek'] ?>"><?= $m['nama_merek'] ?> </option>
                                            <?php endforeach; ?>
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
                                        <input type="number" step="0.01" id="berat" name="berat" class="form-control" placeholder="Masukan Berat Bersih">
                                        <div id="validationServerUsernameFeedback" class="invalid-feedback beratmsg">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Qty</label>
                                        <input type="Number" id="qty" name="qty" min="1" class="form-control" placeholder="Masukan jumlah">
                                        <div id="validationServerUsernameFeedback" class="invalid-feedback qtymsg">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Model</label>
                                        <input type="text" name="model" id="model" class="form-control" placeholder="Masukan Model Barang">
                                    </div>
                                </div>
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
                                        <label>Nilai Tukar</label>
                                        <input type="number" id="nilai_tukar" name="nilai_tukar" class="form-control" placeholder="Masukan Nilai Tukar">
                                        <div id="validationServerUsernameFeedback" class="invalid-feedback nilai_tukarmsg">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Harga Beli</label>
                                        <input type="number" name="harga_beli" id="harga_beli" class="form-control harga_beli" placeholder="Masukan Harga Beli">
                                        <div id="validationServerUsernameFeedback" class="invalid-feedback harga_belimsg">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Ongkos</label>
                                        <input type="number" value="0" name="ongkos" id="ongkos" class="form-control ongkos" placeholder="Masukan Ongkos">
                                        <div id="validationServerUsernameFeedback" class="invalid-feedback ongkosmsg">
                                        </div>
                                        <input type="hidden" id="kode" name="kode">
                                        <input type="hidden" id="dateid" name="dateid" value="<?= $datapembelian['id_date_pembelian'] ?>">

                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btnedit">Edit</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
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
    function EditData(id) {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('editdetail'); ?>",
            data: {
                kode: id
            },
            success: function(result) {
                console.log(result.data.jenis)
                $('#modal-edit').modal('show');
                $('#merek').val(result.data.merek)
                $('#kadar').val(result.data.kadar)
                $('#berat').val(result.data.berat)
                $('#qty').val(result.data.qty)
                $('#model').val(result.data.model)
                $('#keterangan').val(result.data.keterangan)
                $('#nilai_tukar').val(result.data.nilai_tukar)
                $('#harga_beli').val(result.data.harga_beli)
                $('#ongkos').val(result.data.ongkos)
                $('#jenis').val(result.data.jenis)
                $('#kode').val(result.data.kode)
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function loaddata() {

    }
    $('.editdataform').submit(function(e) {
        e.preventDefault()
        let form = $('.editdataform')[0];
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            data: data,
            url: "<?php echo base_url('editdataform') ?>",
            dataType: "json",
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function() {
                $('.btnedit').html('<i class="fa fa-spin fa-spinner">')
            },
            complete: function() {
                $('.btnedit').html('Edit')
            },
            success: function(result) {
                if (result != 'error') {
                    if (result.error) {
                        console.log(result)
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
                        if (result.error.ongkos) {
                            $('#ongkos').addClass('is-invalid')
                            $('.ongkosmsg').html(result.error.ongkos)
                        } else {
                            $('#ongkos').removeClass('is-invalid')
                            $('.ongkosmsg').html('')
                        }
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
                        $('#ongkos').removeClass('is-invalid')
                        $('.ongkosmsg').html('')

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil Edit',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK',
                            allowOutsideClick: false
                        }).then((choose) => {
                            if (choose.isConfirmed) {
                                $('#modal-edit').modal('toggle');
                                $("#datatable").load("/detailpembelian/" + document.getElementById('dateid').value + " #datatable");
                                $("#refresharga").load("/detailpembelian/" + document.getElementById('dateid').value + " #refresharga");
                                myDataBayar()
                            }
                        })
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
    })

    function pembulatankoma(berat) {
        var num = Number(berat) // The Number() only visualizes the type and is not needed
        var roundedString = num.toFixed(2);
        var rounded = Number(roundedString);
        return rounded
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
                $('#totalberatmurnihtml').html(pembulatankoma(result.totalberatmurni.berat_murni))
                $('#totalberathtml').html(pembulatankoma(result.totalberat.berat))


                document.getElementById('totalbersih1').innerHTML = pembulatankoma(result.totalbersih.total_harga).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                document.getElementById('totalbersih').innerHTML = pembulatankoma(result.totalbersih.total_harga).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                document.getElementById('pembulatanhtml').innerHTML = ''
                document.getElementById('pembulatan').value = ''

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
            title: 'Cancel Pembelian ',
            text: "Apakah Ingin Retur Pembelian ?",
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
                if (result != 'error') {
                    if (result.error) {
                        if (result.error.debitcc) {
                            $('#debitcc').addClass('is-invalid')
                            $('.debitccmsg').html(result.error.debitcc)
                        } else {
                            $('#debitcc').removeClass('is-invalid')
                            $('.debitccmsg').html('')
                        }
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
                        if (result.error.tunai) {
                            $('#tunai').addClass('is-invalid')
                            $('.tunaimsg').html(result.error.tunai)
                        } else {
                            $('#tunai').removeClass('is-invalid')
                            $('.tunai').html('')
                        }
                    } else {
                        $('#debitcc').removeClass('is-invalid')
                        $('.debitccmsg').html('')
                        $('#namabank').removeClass('is-invalid')
                        $('.namabank').html('')
                        $('#transfer').removeClass('is-invalid')
                        $('.transfer').html('')
                        $('#tunai').removeClass('is-invalid')
                        $('.tunai').html('')

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil Bayar',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK',
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#modal-bayar').modal('toggle');
                                window.location.reload();

                            }
                        })



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
    })


    function myPembayaran() {
        console.log('masuk')
        const carabyr = document.getElementById('pembayaran').value
        const metod1 = $('.metodebayar')
        const nmbank = $('.namabankhtml')
        const charge = $('.chargehtml')
        const table1 = $('#tabelbayar1')
        const table2 = $('#tabelbayar2')
        const table3 = $('#tabelbayar3')
        const bank = $('#tabelbank')
        const metod2 = document.getElementsByClassName('metodebayar2')
        metod1[0].innerHTML = ''
        nmbank[0].innerHTML = ''
        charge[0].innerHTML = ''
        metod2[0].innerHTML = ''
        table1[0].innerHTML = ''
        table2[0].innerHTML = ''
        table3[0].innerHTML = ''
        bank[0].innerHTML = ''

        var DebitCC = '<label>Debit/CC</label><input type="number" onkeyup = "byrdebitcc()" min="0" id="debitcc" name="debitcc" class="form-control" placeholder="Masukan debit/cc"><div id="validationServerUsernameFeedback" class="invalid-feedback debitccmsg"></div>'
        var NamaBank = '<label>Nama Bank Debit/CC</label><input onkeyup = "byrnamabank()" type="text" id="namabank" name="namabank" class="form-control" placeholder="Masukan Nama Bank"><div id="validationServerUsernameFeedback" class="invalid-feedback namabankmsg"></div>'
        var Charge = '<label>Charge %</label><input type="number" onkeyup = "brycas()" min="0" id="charge" name="charge" class="form-control" placeholder="Masukan Charge"><div id="validationServerUsernameFeedback" class="invalid-feedback chargemsg"></div>'
        var Transfer = '<label>Transfer</label><input type="number" onkeyup = "byrtransfer()" min="0" id="transfer" name="transfer" class="form-control" placeholder="Masukan transfer"><div id="validationServerUsernameFeedback" class="invalid-feedback transfermsg"></div>'
        var Tunai = '<label>Tunai</label><input type="number" onkeyup = "byrtunai()" min="0" id="tunai" name="tunai" class="form-control" placeholder="Masukan tunai"><div id="validationServerUsernameFeedback" class="invalid-feedback tunaimsg"></div>'

        if (carabyr == 'Bayar Nanti') {
            myDataBayar()
            metod1[0].innerHTML = ''
            nmbank[0].innerHTML = ''
            charge[0].innerHTML = ''
            metod2[0].innerHTML = ''
            table1[0].innerHTML = ''
            table2[0].innerHTML = ''
            table3[0].innerHTML = ''
            bank[0].innerHTML = ''
        }
        if (carabyr == 'Debit/CC') {
            myDataBayar()
            metod1[0].innerHTML = DebitCC
            nmbank[0].innerHTML = NamaBank
            charge[0].innerHTML = Charge
            bank[0].innerHTML = '<td>Nama Bank</td><td id="bankbyr"></td>'
            table1[0].innerHTML = '<td>Charge</td><td id="chargebyr"></td>'
            table2[0].innerHTML = '<td>Debit/CC</td><td id="debitccbyr"></td>'
        }
        if (carabyr == 'Debit/CCTranfer') {
            myDataBayar()
            metod1[0].innerHTML = DebitCC
            nmbank[0].innerHTML = NamaBank
            charge[0].innerHTML = Charge
            metod2[0].innerHTML = Transfer
            bank[0].innerHTML = '<td>Nama Bank</td><td id="bankbyr"></td>'
            table1[0].innerHTML = '<td>Charge</td><td id="chargebyr"></td>'
            table2[0].innerHTML = '<td>Debit/CC</td><td id="debitccbyr"></td>'
            table3[0].innerHTML = '<td>Tranfer</td><td id="transferbyr"></td>'
        }
        if (carabyr == 'Transfer') {
            myDataBayar()
            metod1[0].innerHTML = Transfer
            nmbank[0].innerHTML = NamaBank
            bank[0].innerHTML = '<td>Nama Bank</td><td id="bankbyr"></td>'
            table2[0].innerHTML = '<td>Tranfer</td><td id="transferbyr"></td>'

        }
        if (carabyr == 'Tunai') {
            myDataBayar()
            metod1[0].innerHTML = Tunai
            table1[0].innerHTML = '<td>Tunai</td><td id="tunaibyr"></td>'

        }
        if (carabyr == 'Tunai&Debit/CC') {
            myDataBayar()
            metod1[0].innerHTML = DebitCC
            nmbank[0].innerHTML = NamaBank
            charge[0].innerHTML = Charge
            metod2[0].innerHTML = Tunai
            bank[0].innerHTML = '<td>Nama Bank</td><td id="bankbyr"></td>'
            table1[0].innerHTML = '<td>Charge</td><td id="chargebyr"></td>'
            table2[0].innerHTML = '<td>Debit/CC</td><td id="debitccbyr"></td>'
            table3[0].innerHTML = '<td>Tunai</td><td id="tunaibyr"></td>'
        }

        if (carabyr == 'Tunai&Transfer') {
            myDataBayar()
            metod1[0].innerHTML = Transfer
            nmbank[0].innerHTML = NamaBank
            metod2[0].innerHTML = Tunai
            bank[0].innerHTML = '<td>Nama Bank</td><td id="bankbyr"></td>'
            table3[0].innerHTML = '<td>Tunai</td><td id="tunaibyr"></td>'
            table2[0].innerHTML = '<td>Tranfer</td><td id="transferbyr"></td>'

        }
        console.log(carabyr)
    }

    function byrnamabank() {
        const totalbersih = document.getElementById('totalbersih').innerHTML
        totalbersihval = parseFloat(totalbersih.replaceAll('.', ''))
        var bank = document.getElementById('namabank').value
        document.getElementById('bankbyr').innerHTML = bank
    }

    function myPembulatan() {
        if (document.getElementById('pembulatan')) {
            bulat = (isNaN(parseFloat(document.getElementById('pembulatan').value))) ? 0 : parseFloat(document.getElementById('pembulatan').value)
        } else {
            bulat = 0
        }
        if (document.getElementById('debitcc')) {
            debitcc = (isNaN(parseFloat(document.getElementById('debitcc').value))) ? 0 : parseFloat(document.getElementById('debitcc').value)
        } else {
            debitcc = 0
        }
        if (document.getElementById('transfer')) {
            transfer = (isNaN(parseFloat(document.getElementById('transfer').value))) ? 0 : parseFloat(document.getElementById('transfer').value)
        } else {
            transfer = 0
        }
        if (document.getElementById('tunai')) {
            tunai = (isNaN(parseFloat(document.getElementById('tunai').value))) ? 0 : parseFloat(document.getElementById('tunai').value)
        } else {
            tunai = 0
        }

        const totalbersih = document.getElementById('totalbersih').innerHTML
        totalbersihval = parseFloat(totalbersih.replaceAll('.', ''))
        var hasil = totalbersihval - (bulat + debitcc + transfer + tunai)
        document.getElementById('totalbersih1').innerHTML = hasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        document.getElementById('pembulatanhtml').innerHTML = bulat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }

    function brycas() {
        var val = document.getElementById('charge').value
        const totalbersih = document.getElementById('totalbersihconst').innerHTML
        totalbersihval = parseFloat(totalbersih.replaceAll('.', ''))
        hasil = totalbersihval + (val * (totalbersihval / 100))
        document.getElementById('totalbersih').innerHTML = hasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        document.getElementById('totalbersih1').innerHTML = hasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        document.getElementById('chargebyr').innerHTML = val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + '%'
        myPembulatan()
        byrdebitcc()
        byrtransfer()
        byrtunai()
    }

    function byrdebitcc() {
        if (document.getElementById('pembulatan')) {
            bulat = (isNaN(parseFloat(document.getElementById('pembulatan').value))) ? 0 : parseFloat(document.getElementById('pembulatan').value)
        } else {
            bulat = 0
        }
        if (document.getElementById('debitcc')) {
            debitcc = (isNaN(parseFloat(document.getElementById('debitcc').value))) ? 0 : parseFloat(document.getElementById('debitcc').value)
        } else {
            debitcc = 0
        }
        if (document.getElementById('transfer')) {
            transfer = (isNaN(parseFloat(document.getElementById('transfer').value))) ? 0 : parseFloat(document.getElementById('transfer').value)
        } else {
            transfer = 0
        }
        if (document.getElementById('tunai')) {
            tunai = (isNaN(parseFloat(document.getElementById('tunai').value))) ? 0 : parseFloat(document.getElementById('tunai').value)
        } else {
            tunai = 0
        }
        const totalbersih = document.getElementById('totalbersih').innerHTML
        totalbersihval = parseFloat(totalbersih.replaceAll('.', ''))
        hasil = totalbersihval - (debitcc + bulat + tunai + transfer)
        document.getElementById('debitccbyr').innerHTML = debitcc.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        document.getElementById('totalbersih1').innerHTML = hasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")

    }

    function byrtransfer() {
        if (document.getElementById('pembulatan')) {
            bulat = (isNaN(parseFloat(document.getElementById('pembulatan').value))) ? 0 : parseFloat(document.getElementById('pembulatan').value)
        } else {
            bulat = 0
        }
        if (document.getElementById('debitcc')) {
            debitcc = (isNaN(parseFloat(document.getElementById('debitcc').value))) ? 0 : parseFloat(document.getElementById('debitcc').value)
        } else {
            debitcc = 0
        }
        if (document.getElementById('transfer')) {
            transfer = (isNaN(parseFloat(document.getElementById('transfer').value))) ? 0 : parseFloat(document.getElementById('transfer').value)
        } else {
            transfer = 0
        }
        if (document.getElementById('tunai')) {
            tunai = (isNaN(parseFloat(document.getElementById('tunai').value))) ? 0 : parseFloat(document.getElementById('tunai').value)
        } else {
            tunai = 0
        }
        const totalbersih = document.getElementById('totalbersih').innerHTML
        totalbersihval = parseFloat(totalbersih.replaceAll('.', ''))
        hasil = totalbersihval - (debitcc + bulat + tunai + transfer)
        document.getElementById('transferbyr').innerHTML = transfer.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        document.getElementById('totalbersih1').innerHTML = hasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }

    function byrtunai() {
        if (document.getElementById('pembulatan')) {
            bulat = (isNaN(parseFloat(document.getElementById('pembulatan').value))) ? 0 : parseFloat(document.getElementById('pembulatan').value)
        } else {
            bulat = 0
        }
        if (document.getElementById('debitcc')) {
            debitcc = (isNaN(parseFloat(document.getElementById('debitcc').value))) ? 0 : parseFloat(document.getElementById('debitcc').value)
        } else {
            debitcc = 0
        }
        if (document.getElementById('transfer')) {
            transfer = (isNaN(parseFloat(document.getElementById('transfer').value))) ? 0 : parseFloat(document.getElementById('transfer').value)
        } else {
            transfer = 0
        }
        if (document.getElementById('tunai')) {
            tunai = (isNaN(parseFloat(document.getElementById('tunai').value))) ? 0 : parseFloat(document.getElementById('tunai').value)
        } else {
            tunai = 0
        }
        const totalbersih = document.getElementById('totalbersih').innerHTML
        totalbersihval = parseFloat(totalbersih.replaceAll('.', ''))
        hasil = totalbersihval - (debitcc + bulat + tunai + transfer)
        document.getElementById('tunaibyr').innerHTML = tunai.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        document.getElementById('totalbersih1').innerHTML = hasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")

    }


    $(document).ready(function() {
        myDataBayar()
    })
</script>
<?= $this->endSection(); ?>