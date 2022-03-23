<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<script type="text/javascript" src="/js/jquery.js"></script>
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
                    <h1 class="m-0">Form Barang Masuk Supplier</h1>
                </div><!-- /.col -->
                <!-- /.content-header -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/barangmasuk">Home</a></li>
                        <li class="breadcrumb-item"><a href="/barangmasuk">Pembelian Supplier</a></li>
                        <li class="breadcrumb-item active">Form Pembeliaan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- ./card-header -->
                    <div class="card-body p-0">
                        <table class="table table-hover">
                            <tbody>
                                <tr data-widget="expandable-table" aria-expanded="true">
                                    <td>
                                        Input Data Master
                                    </td>
                                </tr>
                                <tr class="expandable-body">
                                    <td>
                                        <div class="p-0" style="margin: 10px;">
                                            <form action="/ajaxinsert" name="ajaxform" id="ajaxform" class="ajaxform" method="post" enctype="multipart/form-data">
                                                <?= csrf_field(); ?>
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Tanggal Input Barang</label>
                                                            <input type="date" id="tanggal_input" name="tanggal_input" class="form-control" value="<?php echo date('Y-m-d') ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Tanggal Nota Supplier</label>
                                                            <input type="date" name="tanggal_nota_sup" id="tanggal_nota_sup" class="form-control" value="<?= (isset($datapembelian['tgl_faktur'])) ? date_format(date_create(substr($datapembelian['tgl_faktur'], 0, 10)), "Y-m-d") : date('Y-m-d'); ?>">
                                                            <input type="hidden" name="dateid" id="dateid" value="<?= $datapembelian['id_date_pembelian'] ?>">
                                                            <div id="validationServerUsernameFeedback" class="invalid-feedback tanggal_nota_supmsg">
                                                            </div>
                                                        </div>
                                                        <!-- <input type="text" name="kelompok" class="form-control" placeholder="Masukan Kelompok"> -->
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Tanggal Jatuh Tempo </label>
                                                            <input type="date" id="tanggal_tempo" name="tanggal_tempo" class="form-control" value="<?= (isset($datapembelian['tgl_jatuh_tempo'])) ? date_format(date_create(substr($datapembelian['tgl_jatuh_tempo'], 0, 10)), "Y-m-d") : date('Y-m-d'); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>No Nota Supplier</label>
                                                            <input type="text" id="no_nota_supp" name="no_nota_supp" value="<?= (isset($datapembelian['no_faktur_supp'])) ? $datapembelian['no_faktur_supp'] : ''; ?>" class="form-control" placeholder="Masukan Nomor Nota Supplier">
                                                            <div id="validationServerUsernameFeedback" class="invalid-feedback no_nota_suppmsg"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Nama Supplier</label>
                                                            <select name="supplier" class="form-control" id="supplier" name="supplier">
                                                                <?php foreach ($supplier as $m) : ?>
                                                                    <option value="<?= $m['nama_supp'] ?>" <?= (isset($datapembelian['nama_supplier']) == $m['nama_supp']) ? ($datapembelian['nama_supplier'] == $m['nama_supp']) ? 'selected' : '' : ''; ?>><?= $m['nama_supp'] ?> </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Total Berat Murni (Gr)</label>
                                                            <input type="number" step="0.01" min="0" id="total_berat_m" name="total_berat_m" class="form-control" placeholder="Masukan Total Berat Murni" value="<?= (isset($datapembelian['total_berat_murni'])) ? $datapembelian['total_berat_murni'] : ''; ?>">
                                                            <div id="validationServerUsernameFeedback" class="invalid-feedback total_berat_mmsg">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr data-widget="expandable-table" aria-expanded="true">
                                    <td>
                                        Input Data Berulang
                                    </td>
                                </tr>
                                <tr class="expandable-body">
                                    <td>
                                        <div class="p-0" style="margin: 10px;">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Kelompok</label>
                                                        <select name="kelompok" onchange="ModalBarcode()" class="form-control" id="kelompok" name="kelompok">
                                                            <option value="1">Perhiasan Mas</option>
                                                            <option value="2">Perhiasan Berlian</option>
                                                            <option value="3">Logam Mulia (Antam, UBS, HWT)</option>
                                                            <option value="4">Bahan Murni</option>
                                                            <option value="5">Loose Diamond</option>
                                                            <option value="6">Barang Dagang</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <a href="#" data-toggle="modal" data-target="#modal-xl"><label>Barcode</label></a>
                                                        <input type="text" onkeyup="PilihBarcode($('#barcode').val())" id="barcode" name="barcode" class="form-control" placeholder="Masukan barcode">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <!-- text input -->
                                                    <div class="form-group merek">
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
                                                            <option value="-">-</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Jenis</label>
                                                        <select name="jenis" class="form-control" id="jenis">
                                                            <?php foreach ($jenis as $m) : ?>
                                                                <option value="<?= $m['nama'] ?>"><?= $m['nama'] ?> </option>
                                                            <?php endforeach; ?>
                                                            <option value="-">-</option>
                                                        </select>
                                                        <!-- <input type="text" name="jenis" id="jenis" class="form-control" placeholder="Masukan Jenis"> -->
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
                                                <div class="col-sm-1">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Qty</label>
                                                        <input type="Number" id="qty" name="qty" min="1" class="form-control" placeholder="Masukan jumlah">
                                                        <div id="validationServerUsernameFeedback" class="invalid-feedback qtymsg">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-1">
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
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-danger" onclick="hapussemua()">Hapus Semua</button>
                                            <button type="submit" id="send_form" class="btn btn-info btntambah">Tambah</button>
                                        </div>
                                        <!-- </form> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
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
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th id="theadqty" style="text-align: center;"></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th id="theadberat" style="text-align: center;"></th>
                                            <th id="theadmurni" style="text-align: center;"></th>
                                            <th id="theadhargabeli" style="text-align: center;"></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th id="theadtotalharga" style="text-align: center;"></th>
                                            <th></th>
                                        </tr>
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
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="databeli">
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
                    <div class="col-sm-6">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-hover text-nowrap">
                                    <tbody>
                                        <tr>
                                            <td>Total Berat Murni</td>
                                            <td id="totalberatmurnihtml"></td>
                                        </tr>
                                        <tr>
                                            <td>Total Berat</td>
                                            <td id="totalberathtml"></td>
                                        </tr>
                                        <tr>
                                            <td>Total Harga Murni</td>
                                            <td id="totalbersih"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col - text-center">
                                <a type="button" onclick="Batal()" class="btn btn-danger">Batal</a>
                                <a type="button" onclick="Selesai()" id="selesai" class="btn btn-info ">Selesai</a>
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

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<!-- Main Footer -->
<footer class="main-footer">

</footer>
<div id="barcodeview">

</div>

<script type="text/javascript">
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
                console.log(result.datadetail.merek)
                $('#merek').val(result.datadetail.merek)
                $('#kadar').val(result.datadetail.kadar)
                $('#jenis').val(result.datadetail.jenis)
                $('#model').val(result.datadetail.model)
                $('#berat').val(result.datadetail.berat)
                $('#keterangan').val(result.datadetail.keterangan)
                $('#qty').val(result.datadetail.qty)
                $('#nilai_tukar').val(result.datadetail.nilai_tukar)
                $('#harga_beli').val(result.datadetail.harga_beli)
                $('#ongkos').val(result.datadetail.ongkos)
                $('#kelompok').val($('#barcode').val().substr(0, 1))

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);

            }
        })
        $('#modal-xl').modal('hide');
    }

    function ModalBarcode() {
        document.getElementById('barcode').value = ''
        var kel = document.getElementById('kelompok').value
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {
                kel: kel
            },
            url: "<?php echo base_url('modalbarcode') ?>",
            success: function(result) {
                $('#barcodeview').html(result.modalbarcode)
                // $('#modal-xl').modal('toggle');
                // console.log(result)
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);

            }
        })
    }

    function Batal() {
        Swal.fire({
            title: 'Batal Input ',
            text: "Apakah Ingin Batal Pembelian ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                var dateid = document.getElementById('dateid').value
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    data: {
                        dateid: dateid
                    },
                    url: "<?php echo base_url('batalpembelian'); ?>",
                    success: function(result) {
                        window.location.href = '/barangmasuk'
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                })
            }
        })

    };

    function Selesai() {
        var tanggal_input = document.getElementById('tanggal_input').value
        var supplier = document.getElementById('supplier').value
        var no_nota_supp = document.getElementById('no_nota_supp').value
        var tanggal_nota_sup = document.getElementById('tanggal_nota_sup').value
        var total_berat_m = document.getElementById('total_berat_m').value
        var tanggal_tempo = document.getElementById('tanggal_tempo').value
        var dateid = document.getElementById('dateid').value

        Swal.fire({
            title: 'Sudah Selesai ',
            text: "Apakah sudah selesai ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Selesai',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    data: {
                        tanggal_input: tanggal_input,
                        supplier: supplier,
                        no_nota_supp: no_nota_supp,
                        tanggal_nota_sup: tanggal_nota_sup,
                        total_berat_m: total_berat_m,
                        tanggal_tempo: tanggal_tempo,
                        dateid: dateid
                    },
                    url: "<?php echo base_url('stockdata'); ?>",
                    success: function(result) {
                        console.log(result)
                        if (result.error) {

                            if (result.error.total_berat_m) {
                                $('#total_berat_m').addClass('is-invalid')
                                $('.total_berat_mmsg').html(result.error.total_berat_m)
                            } else {
                                $('#total_berat_m').removeClass('is-invalid')
                                $('.total_berat_mmsg').html('')
                            }
                            if (result.error.no_nota_supp) {
                                $('#no_nota_supp').addClass('is-invalid')
                                $('.no_nota_suppmsg').html(result.error.no_nota_supp)
                            } else {
                                $('#no_nota_supp').removeClass('is-invalid')
                                $('.no_nota_suppmsg').html('')
                            }
                        } else {
                            $('#total_berat_m').removeClass('is-invalid')
                            $('.total_berat_mmsg').html('')
                            $('#no_nota_supp').removeClass('is-invalid')
                            $('.no_nota_suppmsg').html('')
                            if (result.pesan == 'error') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Tidak ada data',
                                })
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data Berhasil dimasukan ke stock master',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK',
                                    allowOutsideClick: false
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "<?php echo base_url('barangmasuk'); ?>";

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
    }

    function hapussemua() {
        Swal.fire({
            title: 'Hapus Semua Data',
            text: "Yakin ingin Hapus Semua Data ini ?",
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
                    url: "<?php echo base_url('deletedetailsemua'); ?>",
                    success: function(result) {
                        tampildata()
                        Swal.fire({
                            icon: 'success',
                            title: 'Semua Data Berhasil Dihapus',
                        })

                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        // alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        Swal.fire({
                            icon: 'success',
                            title: 'Semua Data Berhasil Dihapus',
                        })
                    }
                })

            }
        })
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
            url: "<?php echo base_url('ajaxpembelian'); ?>",
            success: function(result) {
                $('#databeli').html(result.data)
                $('#totalbersih').html(result.totalbersih.total_harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
                $('#totalberatmurnihtml').html(pembulatankoma(result.totalberatmurni.berat_murni))
                $('#totalberathtml').html(pembulatankoma(result.totalberat.berat))
                $('#theadmurni').html(pembulatankoma(result.totalberatmurni.berat_murni))
                $('#theadberat').html(pembulatankoma(result.totalberat.berat))
                $('#theadqty').html(result.totalqty.qty)
                $('#theadtotalharga').html(result.totalbersih.total_harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))



            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    $(document).ready(function() {
        ModalBarcode()
        tampildata()
        $('.ajaxform').submit(function(e) {
            e.preventDefault()
            let form = $('.ajaxform')[0];
            let data = new FormData(form)
            $.ajax({
                type: "POST",
                data: data,
                url: $(this).attr('action'),
                dataType: "json",
                enctype: 'multipart/form-data',
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
                        if (result.error.qty) {
                            $('#qty').addClass('is-invalid')
                            $('.qtymsg').html(result.error.qty)
                        } else {
                            $('#qty').removeClass('is-invalid')
                            $('.qtymsg').html('')
                        }
                        if (result.error.total_berat) {
                            $('#total_berat').addClass('is-invalid')
                            $('.total_beratmsg').html(result.error.total_berat)
                        } else {
                            $('#total_berat').removeClass('is-invalid')
                            $('.total_beratmsg').html('')
                        }
                        if (result.error.total_berat_m) {
                            $('#total_berat_m').addClass('is-invalid')
                            $('.total_berat_mmsg').html(result.error.total_berat_m)
                        } else {
                            $('#total_berat_m').removeClass('is-invalid')
                            $('.total_berat_mmsg').html('')
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
                        if (result.error.gambar) {
                            $('#ambilgbr').addClass('is-invalid')
                            $('.ambilgbrmsg').html(result.error.gambar)
                        } else {
                            $('#ambilgbr').removeClass('is-invalid')
                            $('.ambilgbrmsg').html('')
                        }
                        if (result.error.no_nota_supp) {
                            $('#no_nota_supp').addClass('is-invalid')
                            $('.no_nota_suppmsg').html(result.error.no_nota_supp)
                        } else {
                            $('#no_nota_supp').removeClass('is-invalid')
                            $('.no_nota_suppmsg').html('')
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
                        $('#total_berat_m').removeClass('is-invalid')
                        $('.total_berat_mmsg').html('')
                        $('#nilai_tukar').removeClass('is-invalid')
                        $('.nilai_tukarmsg').html('')
                        $('#jenis').removeClass('is-invalid')
                        $('.jenismsg').html('')
                        $('#berat').removeClass('is-invalid')
                        $('.beratmsg').html('')
                        $('#ambilgbr').removeClass('is-invalid')
                        $('.ambilgbrmsg').html('')
                        $('#no_nota_supp').removeClass('is-invalid')
                        $('.no_nota_suppmsg').html('')
                        $('#harga_beli').removeClass('is-invalid')
                        $('.harga_belimsg').html('')
                        $('#ongkos').removeClass('is-invalid')
                        $('.ongkosmsg').html('')
                        tampildata()
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        })

        $(".modal").on("hidden.bs.modal", function() {
            Webcam.reset('#my_camera')
        });
    })
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
</script>

<?= $this->endSection(); ?>