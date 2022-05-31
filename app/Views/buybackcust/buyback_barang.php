<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
<style>
    .table>tbody>tr>* {
        vertical-align: middle;
        text-align: center;
    }

    .table>* {
        vertical-align: middle;
        text-align: center;
    }

    .modal {
        overflow: auto !important;
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
                    <h1 class="m-0">Form Buyback Barang</h1>
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
            <div class="col-6">
                <div class="card">
                    <?php if ($databuyback['status_dokumen'] == 'Draft') : ?>
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
                    <?php else : ?>
                        <div class="card-body p-0" id="refreshpembayaran">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>No Buyback</td>
                                        <td><?= $databuyback['no_transaksi_buyback'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Input</td>
                                        <td><?= $databuyback['created_at'] ?></td>
                                    </tr>


                                </tbody>
                            </table>
                            <!-- /.card-body -->
                        </div>
                    <?php endif ?>
                </div>
            </div>
            <div class="col-6">
                <!-- Application buttons -->
                <div class="card">
                    <div class="card-body" id="refreshtombol">
                        <!-- <a type="button" onclick="BatalBuyback()" class="btn btn-app">
                            <i class="fas fa-window-close"></i> Batal Buyback
                        </a> -->
                        <?php if ($databuyback['status_dokumen'] == 'Draft') : ?>
                            <a type="button" onclick="BatalBuyback()" class="btn btn-app">
                                <i class="fas fa-window-close"></i> Batal Buyback
                            </a>
                        <?php endif; ?>
                        <?php if (isset($databuyback)) : ?>
                            <?php if ($databuyback['pembayaran'] == 'Bayar Nanti') : ?>
                                <a class="btn btn-app bg-danger" onclick="myDataBayar()" type="button" data-toggle="modal" data-target="#modal-bayar">
                                    <i class="fas fa-money-bill"></i> Bayar
                                </a>
                            <?php else : ?>
                                <a class="btn btn-app bg-primary" type="button">
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
        <div class="container-fluid" id="databuyback">

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
                            <?= csrf_field(); ?>
                            <div class="form-group" style="margin: 1mm;">
                                <label>Masukan No Invoce (Nota)</label>
                                <div class="input-group input-group-sm">
                                    <input autocomplete="off" onfocus="this.select()" type="text" class="form-control notrans" id="notrans" onkeyup="ScannoTrans()" name="notrans" placeholder="Masukan Nomor Nota">
                                    <span class="input-group-append">
                                        <button type="submit" id="scannotransbtn" class="btn btn-info btn-flat scannotransbtn">Ok</button>
                                    </span>
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback notransmsg">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-6">
                        <form action="/scanbarcode" name="scanbarcode" id="scanbarcode" class="scanbarcode" method="post">
                            <?= csrf_field(); ?>
                            <div class="form-group" style="margin: 1mm;">
                                <label>Masukan Barcode</label>
                                <div class="input-group input-group-sm">
                                    <input autocomplete="off" onfocus="this.select()" type="text" class="form-control nobarcode" id="nobarcode" onkeyup="Scanbarcode()" name="nobarcode" placeholder="Masukan Barcode">
                                    <span class="input-group-append">
                                        <button type="submit" id="scanbarcodebtn" class="btn btn-info btn-flat scanbarcodebtn">Ok</button>
                                    </span>
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback barcodemsg">
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
                            <div class="card-body table-responsive p-0" id="datamodalbuyback">

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
<div id="modaldgnnota">
</div>
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
                    <?= csrf_field(); ?>
                    <div class="row">
                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Kelompok</label>
                                <select name="kelompok" onchange="FormNonota()" class="form-control" id="kelompok">
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
                    </div>
                    <div id="formnonotaa"></div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Total Harga</td>
                                        <td id="totalbayar1"></td>
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
                            <button type="button" class="close" onclick="$('#modal-foto').modal('toggle')" aria-label="Close">
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
                                <button type="button" class="btn btn-default" onclick="$('#modal-foto').modal('toggle')">Close</button>
                                <button type="button" class="btn btn-primary" onclick="$('#modal-foto').modal('toggle')">Done</button>
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
                    <?= csrf_field(); ?>
                    <input type="hidden" name="kelompok" id="kelompok" value="<?= $databuyback['kelompok'] ?>">
                    <input type="hidden" name="iddate" id="iddate" value="<?= $databuyback['id_date_buyback'] ?>">
                    <input type="hidden" name="hasil" id="hasil" value="0">
                    <div class="card-header">
                        <h4 style="text-align: center;" id="totalbayar"></h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label><a href="#" data-toggle="modal" data-target="#modal-customer">NoHp Customer</a></label>
                                    <input autocomplete="off" type="number" onfocus="this.select()" min="0" onfocusout="checkcust()" id="nohpcust" name="nohpcust" class="form-control" placeholder="Masukan No Hp">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback nohpcustmsg"></div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Nama Customer</label><input autocomplete="off" type="text" onfocus="this.select()" min="0" id="namacust" name="namacust" class="form-control" placeholder="Nama Custtomer" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label><a href="#" onclick="MasukField('tunai')">Tunai</a></label><input type="number" onchange="myDataBayar()" onfocus="this.select()" min="0" id="tunai" name="tunai" class="form-control" placeholder="Masukan tunai">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback tunaimsg"></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label><a href="#" onclick="MasukField('transfer')">Transfer</a></label><input type="number" onchange="myDataBayar()" onfocus="this.select()" min="0" id="transfer" name="transfer" class="form-control" placeholder="Masukan transfer">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback transfermsg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Bank Transfer</label><input type="text" min="0" id="namabank" name="namabank" class="form-control" placeholder="Pilih Bank" readonly>
                            <div id="validationServerUsernameFeedback" class="invalid-feedback namabankmsg"></div>
                        </div>
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
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Selesai</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal-dialog -->
</div>
<div id="barcodeview">
</div>
<div id="modalcust"></div>
<div class="modal fade" id="modal-tambahcust">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/insertcustomer" name="insertcust" id="insertcust" class="insertcust" method="post">
                <?= csrf_field(); ?>
                <div class="row" style="margin: 10px;">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Nama Customer</label>
                            <input autocomplete="off" type="text" id="nama_cust" name="nama_cust" class="form-control nama_cust" placeholder="Masukan Nama">
                            <div id="validationServerUsernameFeedback" class="invalid-feedback nama_custmsg">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nomor Hp</label>
                            <input autocomplete="off" type="number" id="nohp" name="nohp" class="form-control nohp" placeholder="Masukan Nomor No Hp">
                            <div id="validationServerUsernameFeedback" class="invalid-feedback nohpmsg">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Masukan Alamat">
                        </div>
                        <div class="form-group">
                            <label>Kota</label>
                            <input type="text" id="kota" name="kota" class="form-control" placeholder="Masukan Kota">
                        </div>
                        <div class="form-group">
                            <label>Bank</label>
                            <input type="text" id="banku1" name="banku1" class="form-control" placeholder="Masukan bank">
                        </div>
                        <div class="form-group">
                            <label>No Rekening</label>
                            <input autocomplete="off" type="text" id="no_rek1" name="no_rek1" class="form-control" placeholder="Masukan no rekening">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btntambah">Tambah</button>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<script type="text/javascript">
    function checkcust() {
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {
                nohp_cust: document.getElementById('inputcustomer').value
            },
            url: "<?php echo base_url('checkcust'); ?>",
            success: function(result) {
                if (result == 'gagal') {
                    isicust = document.getElementById('inputcustomer').value
                    document.getElementById("nohp").value = isicust
                    $('#tambahcustomer').trigger('click');
                } else {
                    return result;
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function PilihBarcode(kode) {
        document.getElementById('barcode').value = kode
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {
                kode: kode
            },
            url: "<?php echo base_url('detailbarcode') ?>",
            success: function(result) {
                if (result.datadetail != null) {
                    $('#merek').val(result.datadetail.merek)
                    $('#kadar').val(result.datadetail.kadar)
                    $('#jenis').val(result.datadetail.jenis)
                    $('#model').val(result.datadetail.model)
                    $('#berat').val(result.datadetail.berat)
                    $('#carat').val(result.datadetail.carat)
                    $('#keterangan').val(result.datadetail.keterangan)
                    $('#qty').val(result.datadetail.qty)
                    $('#nilai_tukar').val(result.datadetail.nilai_tukar)
                    $('#harga_beli').val(result.datadetail.harga_beli)
                    $('#ongkos').val(result.datadetail.ongkos)
                }
                totalharga()
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);

            }
        })
        $('#modal-xl').modal('hide');
    }

    function ModalBarcode(kel) {
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {
                kel: kel
            },
            url: "<?php echo base_url('modalbarcodebb') ?>",
            success: function(result) {
                $('#barcodeview').html(result.modalbarcode)
                $('#modal-xl').modal('toggle');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);

            }
        })
    }

    function FormNonota() {
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {
                kel: $('#kelompok').val()
            },
            url: "<?php echo base_url('formnonota') ?>",
            success: function(result) {
                $('#formnonotaa').html(result.form)
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);

            }
        })
    }
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
                            if (result.error.carat) {
                                $('#carat').addClass('is-invalid')
                                $('.caratmsg').html(result.error.carat)
                            } else {
                                $('#carat').removeClass('is-invalid')
                                $('.caratmsg').html('')
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
                            $('#carat').removeClass('is-invalid')
                            $('.caratmsg').html('')
                            if (result.gagal) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: result.gagal,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK',
                                    allowOutsideClick: false
                                }).then((choose) => {
                                    if (choose.isConfirmed) {
                                        tampildatabuyback()
                                    }
                                })
                            } else if (result.berhasil) {
                                Swal.fire({
                                    icon: 'success',
                                    title: result.berhasil,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK',
                                    allowOutsideClick: false
                                }).then((choose) => {
                                    if (choose.isConfirmed) {
                                        $('#modal-nonota').modal('toggle');
                                        tampildatabuyback()
                                    }
                                })
                            }
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                })
            }
        })
    })

    $('.pembayaranform').submit(function(e) {
        e.preventDefault()
        let form = $('.pembayaranform')[0];
        let data = new FormData(form)
        Swal.fire({
            title: 'Bayar',
            text: "Pembayaran Sudah Selesai ?",
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
                    url: "<?php echo base_url('/pembayaranform'); ?>",
                    contentType: false,
                    processData: false,
                    cache: false,
                    dataType: "json",
                    success: function(result) {
                        console.log(result)
                        if (result.error) {
                            if (result.error.namabank) {
                                $('#namabank').addClass('is-invalid')
                                $('.namabankmsg').html(result.error.namabank)
                            } else {
                                $('#namabank').removeClass('is-invalid')
                                $('.namabank').html('')
                            }
                            if (result.error.nohpcust) {
                                $('#nohpcust').addClass('is-invalid')
                                $('.nohpcustmsg').html(result.error.nohpcust)
                            } else {
                                $('#nohpcust').removeClass('is-invalid')
                                $('.nohpcust').html('')
                            }
                            if (result.error.transfer) {
                                $('#transfer').addClass('is-invalid')
                                $('.transfermsg').html(result.error.transfer)
                            } else {
                                $('#transfer').removeClass('is-invalid')
                                $('.transfermsg').html('')
                            }
                            if (result.error.bayar) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: result.error.bayar,
                                })
                            }
                        } else {
                            $('#namabank').removeClass('is-invalid')
                            $('.namabankmsg').html('')
                            $('#nohpcust').removeClass('is-invalid')
                            $('.nohpcustmsg').html('')
                            $('#transfer').removeClass('is-invalid')
                            $('.transfermsg').html('')
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Bayar',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK',
                                allowOutsideClick: false
                            }).then((choose) => {
                                if (choose.isConfirmed) {
                                    location.reload();
                                    // $('#modal-nonota').modal('toggle');
                                    // $("#refrestbl").load("/buybackcust #refrestbl");
                                    // tampildatabuyback()
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
        var kode = parseFloat(document.getElementById('kelompok').value)
        const totalbayar = document.getElementById('totalbayar1')
        if (kode == 1) {
            var berat = parseFloat(document.getElementById('berat').value)
            var hargabeli = parseFloat(document.getElementById('harga_beli').value)
            var nilaitukar = parseFloat(document.getElementById('nilai_tukar').value)
            beratmurni = berat * nilaitukar / 100
            harusbyr = (beratmurni * hargabeli);
        } else if (kode == 2) {
            var hargabeli = parseFloat(document.getElementById('harga_beli').value)
            harusbyr = hargabeli
        } else if (kode == 3) {
            var qty = parseFloat(document.getElementById('qty').value)
            var berat = parseFloat(document.getElementById('berat').value)
            var hargabeli = parseFloat(document.getElementById('harga_beli').value)
            harusbyr = berat * hargabeli * qty;
        } else if (kode == 4) {
            var berat = parseFloat(document.getElementById('berat').value)
            var hargabeli = parseFloat(document.getElementById('harga_beli').value)
            harusbyr = berat * hargabeli;
        } else if (kode == 5) {
            var carat = parseFloat(document.getElementById('carat').value)
            var hargabeli = parseFloat(document.getElementById('harga_beli').value)
            harusbyr = carat * hargabeli;
        } else if (kode == 6) {
            var hargabeli = parseFloat(document.getElementById('harga_beli').value)
            var qty = parseFloat(document.getElementById('qty').value)
            harusbyr = hargabeli * qty;
        }
        totalbayar.innerHTML = harusbyr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }

    function myDataBayar() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('databayarbuyback'); ?>",
            data: {
                dateid: $("#iddate").val()
            },
            success: function(result) {
                const tunai = $('#tunai').val()
                const transfer = $('#transfer').val()
                var hasil = (parseFloat(result.total_harga)) - tunai - transfer
                $('#hasil').val(hasil)
                $('#totalbayar').html(' Rp ' + hasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
                console.log(result)
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function pembulatankoma(berat) {
        var num = Number(berat) // The Number() only visualizes the type and is not needed
        var roundedString = num.toFixed(2);
        var rounded = Number(roundedString);
        return rounded
    }

    function BatalBuyback() {
        Swal.fire({
            title: 'Batal Buyback ',
            text: "Apakah Ingin Batal Buyback ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo base_url('batalbuyback') . '/' . $databuyback['id_date_buyback']; ?>"
            }
        })

    };

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

    function ScannoTrans() {
        $('#scannotransbtn').trigger('click');
    }

    function Scanbarcode() {
        $('#scanbarcodebtn').trigger('click');
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
                console.log(result.asd)
                if (result.pesan_error) {
                    $('#notrans').addClass('is-invalid')
                    $('.notransmsg').html(result.pesan_error)
                } else {
                    $('#notrans').removeClass('is-invalid')
                    $('.notransmsg').html('')
                    document.getElementById('notrans').setAttribute("onkeyup", "ScannoTrans()");
                    document.getElementById('notrans').value = ''
                    $('#nohpcust').val(result.datacust)
                    $('#datamodalbuyback').html(result.data)
                    checkcust()
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })

    })

    $('.scanbarcode').submit(function(e) {
        e.preventDefault()
        let form = $('.scanbarcode')[0];
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            data: data,
            url: "<?php echo base_url('scanbarcode'); ?>",
            contentType: false,
            processData: false,
            cache: false,
            dataType: "json",
            success: function(result) {
                if (result.pesan_error) {
                    $('#nobarcode').addClass('is-invalid')
                    $('.barcodemsg').html(result.pesan_error)

                } else {
                    $('#nobarcode').removeClass('is-invalid')
                    $('.barcodemsg').html('')
                    document.getElementById('nobarcode').setAttribute("onkeyup", "Scanbarcode()");
                    document.getElementById('nobarcode').value = ''
                    $('#nohpcust').val(result.datacust)
                    $('#datamodalbuyback').html(result.data)
                    checkcust()
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


                // $('#totalhargaview').html(result.totalharga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
                // $('#totalberatview').html((Math.round(result.totalberat * 100) / 100).toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
                // $('#harusbayar').html(result.totalharga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
                // $('#brtmurni').html((Math.round(result.totalberat * 100) / 100).toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))

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

    function tambah(id) {
        $.ajax({
            type: "get",
            dataType: "json",
            url: "<?php echo base_url('tampilbuyback'); ?>",
            data: {
                id: id,
                iddate: $('#iddate').val()
            },
            success: function(result) {
                $('#modaldgnnota').html(result.tampilform)
                $('#modal-edit').modal('toggle');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })

    }


    function tampilcustomer() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('tampilcust'); ?>",
            success: function(result) {
                // console.log(result)
                $('#modalcust').html(result.tampilcust)
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function pilihbank(nmbank) {
        $('#namabank').val(nmbank)
    }

    function pilihcustomer(nohp) {
        $('#nohpcust').val(nohp)
        $('#modal-customer').modal('hide')
        checkcust()
    }

    function checkcust() {
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {
                nohp_cust: document.getElementById('nohpcust').value
            },
            url: "<?php echo base_url('checkcust'); ?>",
            success: function(result) {
                console.log('asd')
                if (result == 'gagal') {
                    isicust = document.getElementById('nohpcust').value
                    document.getElementById("nohp").value = isicust
                    $('#modal-tambahcust').modal('show');
                } else {
                    console.log(result)
                    $('#namacust').val(result.nama);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function HarusBayar() {
        var kel = parseFloat(document.getElementById('kel').value)
        const totalharga = document.getElementById('totalhargaedit')
        if (kel == 1) {
            var berat = parseFloat(document.getElementById('berat1').value)
            var nilaitukar = parseFloat(document.getElementById('nilai_tukar1').value)
            var hargabeli = parseFloat(document.getElementById('harga_beli1').value)
            beratmurni = berat * nilaitukar / 100
            harusbyr = hargabeli * beratmurni
        } else if (kel == 2) {
            var hargabeli = parseFloat(document.getElementById('harga_beli1').value)
            harusbyr = hargabeli
        } else if (kel == 3) {
            var hargabeli = parseFloat(document.getElementById('harga_beli1').value)
            var berat = parseFloat(document.getElementById('berat1').value)
            var qty = parseFloat(document.getElementById('qty1').value)
            harusbyr = (qty * berat) * hargabeli

        } else if (kel == 4) {
            var hargabeli = parseFloat(document.getElementById('harga_beli1').value)
            var berat = parseFloat(document.getElementById('berat1').value)
            harusbyr = berat * hargabeli

        } else if (kel == 5) {
            var hargabeli = parseFloat(document.getElementById('harga_beli1').value)
            var carat = parseFloat(document.getElementById('carat1').value)
            harusbyr = hargabeli * carat
        } else if (kel == 6) {
            var hargabeli = parseFloat(document.getElementById('harga_beli1').value)
            var qty = parseFloat(document.getElementById('qty1').value)
            harusbyr = hargabeli * qty
        }
        // brtmurni.innerHTML = beratmurni.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        totalharga.innerHTML = Math.round(harusbyr).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")

    }

    Webcam.set({
        width: 320,
        height: 240,
        dest_width: 320,
        dest_height: 240,
        crop_width: 320,
        crop_height: 240,
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
            document.getElementById('my_camera').innerHTML = '<img src="' + data_uri + '">'
        })
    }

    function Foto_ulang() {
        document.getElementById('my_camera').innerHTML = ''
        $(".image-tag").val('');
        Webcam.attach('#my_camera');
    }
    $(document).ready(function() {
        FormNonota()
        tampilcustomer()
        // ModalBarcode()
        tampildatabuyback()
        $("#modal-foto").on("hidden.bs.modal", function() {
            Webcam.reset()
        });
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
                    if (result.error) {
                        if (result.error.nohp_cust) {
                            $('#nohp').addClass('is-invalid')
                            $('.nohpmsg').html(result.error.nohp_cust)
                        } else {
                            $('#nohp').removeClass('is-invalid')
                            $('.nohpmsg').html('')
                        }
                        if (result.error.nama_cust) {
                            $('#nama_cust').addClass('is-invalid')
                            $('.nama_custmsg').html(result.error.nama_cust)
                        } else {
                            $('#nama_cust').removeClass('is-invalid')
                            $('.nama_custmsg').html('')
                        }
                    } else {
                        $('#nohp').removeClass('is-invalid')
                        $('.nohpmsg').html('')
                        $('#nama_cust').removeClass('is-invalid')
                        $('.nama_custmsg').html('')
                        $('#modal-tambahcust').modal('toggle');
                        $('#nohpcust').removeClass('is-invalid')
                        $('.nohpcustmsg').html('')
                        tampilcustomer()
                        checkcust()
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil Tambah',
                        })
                    }

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        })
    })
</script>
<?= $this->endSection(); ?>