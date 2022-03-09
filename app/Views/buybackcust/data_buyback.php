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
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Buyback Customer</h1>
                </div><!-- /.col -->
                <!-- /.content-header -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/buybackcust">Home</a></li>
                        <li class="breadcrumb-item active">Buyback Customer</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header ">
                            <a class="btn btn-app" href="/adanota">
                                <i class="fas fa-plus"></i> Dengan Nota
                            </a>
                            <a class="btn btn-app" data-toggle="modal" data-target="#modal-nota">
                                <i class="fas fa-plus"></i> Tanpa Nota
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div id="refrestbl">
                            <div class="card-body table ">
                                <table id="example1" class="table table-bordered table-striped tableasd">
                                    <thead>
                                        <tr>
                                            <th>Gambar</th>
                                            <th>Kode</th>
                                            <th>Qty</th>
                                            <th>Harga Beli</th>
                                            <th>Ongkos</th>
                                            <th>Berat Murni</th>
                                            <th>Nilai Tukar</th>
                                            <th>Jenis</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($databuyback as $row) : ?>
                                            <tr>
                                                <td><img src='/img/<?= $row['nama_img'] ?>' class='imgg'></td>
                                                <td><?= $row['kode'] ?></td>
                                                <td><?= $row['qty'] ?></td>
                                                <td><?= number_format($row['harga_beli'], 2, ',', '.') ?></td>
                                                <td><?= number_format($row['ongkos'], 2, ',', '.') ?></td>
                                                <td><?= $row['berat_murni'] ?></td>
                                                <td><?= $row['nilai_tukar'] ?></td>
                                                <td><?= $row['jenis'] ?></td>
                                                <td><a type='button' href="detailbuyback/<?= $row['id_detail_buyback'] ?>" class='btn btn-block bg-gradient-primary'>Detail</a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Gambar</th>
                                            <th>Kode</th>
                                            <th>Qty</th>
                                            <th>Harga Beli</th>
                                            <th>Ongkos</th>
                                            <th>Berat Murni</th>
                                            <th>Nilai Tukar</th>
                                            <th>Jenis</th>
                                            <th>Detail</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<div class="modal fade" id="modal-nota">
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
                                <select name="kelompok" class="form-control" id="cars" name="cars">
                                    <option value="1">Perhiasan Mas</option>
                                    <option value="2">Perhiasan Berlian</option>
                                    <option value="3">Logam Mulia (Antam, UBS, HWT)</option>
                                    <option value="4">Bahan Murni</option>
                                    <option value="5">Loose Diamond</option>
                                    <option value="9">Barang Dagang</option>
                                </select>
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
                                <input type="number" onkeyup="HarusBayar()" step="0.01" id="berat" name="berat" class="form-control" placeholder="Masukan Berat Bersih">
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
                                <input type="Number" id="qty" name="qty" min="1" class="form-control" placeholder="Masukan jumlah">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback qtymsg">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Nilai Tukar</label>
                                <input type="number" value="100" id="nilai_tukar" onkeyup="HarusBayar()" name="nilai_tukar" class="form-control" placeholder="Masukan Nilai Tukar">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback nilai_tukarmsg">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Harga Beli</label>
                                <input type="number" name="harga_beli" onkeyup="HarusBayar()" id="harga_beli" class="form-control harga_beli" placeholder="Masukan Harga Beli">
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
                                        <td>Berat Murni</td>
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
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<!-- Main Footer -->
<footer class="main-footer">

</footer>

<script>
    function HarusBayar() {
        var hargabeli = parseFloat(document.getElementById('harga_beli').value)
        var nilaitukar = parseFloat(document.getElementById('nilai_tukar').value)
        var berat = parseFloat(document.getElementById('berat').value)
        const hrsbyr = document.getElementById('harusbayar')
        const brtmurni = document.getElementById('brtmurni')
        beratmurni = berat * nilaitukar / 100
        harusbyr = hargabeli * beratmurni
        brtmurni.innerHTML = beratmurni.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        hrsbyr.innerHTML = harusbyr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
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
                            if (result.error.ongkos) {
                                $('#ongkos').addClass('is-invalid')
                                $('.ongkosmsg').html(result.error.ongkos)
                            } else {
                                $('#ongkos').removeClass('is-invalid')
                                $('.ongkosmsg').html('')
                            }
                            if (result.error.gambar) {
                                $('#ambilgbr').addClass('is-invalid')
                                $('.ambilgbrmsg').html(result.error.gambar)
                            } else {
                                $('#ambilgbr').removeClass('is-invalid')
                                $('.ambilgbrmsg').html('')
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
                            if (result.error.pembayaran) {
                                $('#pembayaran').addClass('is-invalid')
                                $('.pembayaranmsg').html(result.error.pembayaran)
                            } else {
                                $('#pembayaran').removeClass('is-invalid')
                                $('.pembayaran').html('')
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
                            $('#ambilgbr').removeClass('is-invalid')
                            $('.ambilgbrmsg').html('')
                            $('#namabank').removeClass('is-invalid')
                            $('.namabank').html('')
                            $('#transfer').removeClass('is-invalid')
                            $('.transfer').html('')
                            $('#tunai').removeClass('is-invalid')
                            $('.tunai').html('')
                            $('#pembayaran').removeClass('is-invalid')
                            $('.pembayaran').html('')

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Tambah',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK',
                                allowOutsideClick: false
                            }).then((choose) => {
                                if (choose.isConfirmed) {
                                    $('#modal-nota').modal('toggle');
                                    $("#refrestbl").load("/buybackcust #refrestbl");
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