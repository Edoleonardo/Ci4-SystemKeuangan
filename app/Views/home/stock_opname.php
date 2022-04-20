<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
<!-- <script src="/js/html5-qrcode.min_.js"></script> -->
<style>
    /* .table>tbody>tr>* {
        vertical-align: middle;
        text-align: center;
    } */

    .imgg {
        width: 100px;
    }

    .row {
        display: flex;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Form Stock Opname</h1>
                </div><!-- /.col -->
                <!-- /.content-header -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Stock Opname</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-6">
                <!-- /.card-header -->
                <div class="card">
                    <div class="form-group" style="margin: 1mm;">
                        <label>Kode Barang</label>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control kodebarang" id="kodebarang" name="kodebarang" placeholder="Masukan Barcode">
                            <span class="input-group-append">
                                <button type="button" onclick="OpenBarcode()" id="btnsubmitform" class="btn btn-info btn-flat btnsubmitform">Ok</button>
                            </span>
                            <div id="validationServerUsernameFeedback" class="invalid-feedback kodebarangmsg">
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin: 1mm;">
                        <label>Ubah Data</label>
                        <div class="input-group input-group-sm">
                            <select name="pilihan" onchange="tampildata()" class="form-control" id="pilihan" name="pilihan">
                                <option value="belum" selected>Belum Opname</option>
                                <option value="sudah">Sudah Opname</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" style="margin: 1mm;">
                        <a class="btn btn-app bg-primary" type="button" onclick="SelesaiOpname()">
                            <i class="fas fa-check"></i> Selesai Stock Opname
                        </a>
                        <a class="btn btn-app bg-primary" type="button" onclick="ScanBarcode()">
                            <i class="fas Example of barcode fa-camera"></i> Scan Barcode1
                        </a>
                        <!-- <a class="btn btn-app bg-primary" type="button" onclick="ScanBarcode2()">
                            <i class="fas Example of barcode fa-camera"></i> Scan Barcode2
                        </a> -->
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <div class="col-6">
                <!-- Application buttons -->
                <div class="card">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <tbody>
                                <tr>
                                    <td>Total Barang</td>
                                    <td id="totalbarang"></td>
                                </tr>
                                <tr>
                                    <td>Belum Opname</td>
                                    <td id="sisaopname"></td>
                                </tr>
                                <tr>
                                    <td>Sudah Opname</td>
                                    <td id="sudahopname"></td>
                                </tr>
                            </tbody>
                        </table>
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
                        <div class="card" id="dataopname">
                            <!-- /.card-header -->

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
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->
<!-- /.modal-dialog -->

<div class="modal fade" id="modal-scan">
    <div class="modal-dialog modal-l">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ScanBarcode</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div style="width:500px;" id="reader"></div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" onclick="matiinscan()">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="matiinscan()">Selesai</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
<!-- <div class="modal fade" id="modal-scan2">
    <div class="modal-dialog modal-l">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ScanBarcode2</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="max-height: 500px;" id="reader2"></div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" onclick="matiinscan2()">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="matiinscan2()">Selesai</button>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div id="openmodaldetail">
</div>
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Edit Opname</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/formeditopname" name="formeditopname" id="formeditopname" class="formeditopname" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="iddetail" id="iddetail" value="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-2">
                            <!-- text input -->
                            <div class="form-group merek">
                                <label>Merek</label>
                                <select name="merek" class="form-control" id="merek">
                                    <?php foreach ($merek as $m) : ?>
                                        <option value="<?= $m['nama_merek'] ?>"><?= $m['nama_merek'] ?></option>
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
                                        <option value="<?= $m['nama_kadar'] ?>"><?= $m['nama_kadar'] ?></option>
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
                                        <option value="<?= $m['nama'] ?>"><?= $m['nama'] ?></option>
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
                        <div class="col-sm-4">
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
                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Qty</label>
                                <input type="Number" id="qty" name="qty" class="form-control" placeholder="Masukan jumlah">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback qtymsg">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
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
                                <label>Ongkos</label>
                                <input type="number" value="0" name="ongkos" id="ongkos" class="form-control ongkos" placeholder="Masukan Ongkos">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback ongkosmsg">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Harga Beli</label>
                                <input type="number" name="harga_beli" id="harga_beli" class="form-control harga_beli" placeholder="Masukan Harga Beli">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback harga_belimsg">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
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
                                                    <input type="file" name="gambar" class="custom-file-input browse" id="gambar" accept="image/*">
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
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btntambah">Selesai Edit</button>
            </form>
        </div>
    </div>
</div>
</div>

<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<!-- Main Footer -->
<footer class="main-footer">

</footer>
<script src="/js/quagga.min.js"></script>
<script type="text/javascript">
    //----------------------------------------------------------------------------------------
    // function ScanBarcode2() {
    //     $('#modal-scan2').modal('toggle')
    //     Quagga.init({
    //             inputStream: {
    //                 name: "Live",
    //                 type: "LiveStream",
    //                 constraints: {
    //                     width: 350,
    //                     height: 350,
    //                     facingMode: "environment",
    //                 },
    //                 target: document.querySelector('#reader2') // Or '#yourElement' (optional)
    //             },
    //             decoder: {
    //                 // readers: ["code_128_reader", "ean_reader", "ean_8_reader", "code_39_reader", "code_39_vin_reader", "codabar_reader", "upc_reader", "upc_e_reader", "i2of5_reader", "2of5_reader", "code_93_reader", ]
    //                 readers: ["code_128_reader", "code_39_reader"]

    //             }
    //         },
    //         function(err) {
    //             if (err) {
    //                 console.log(err);
    //                 return
    //             }
    //             console.log("Initialization finished. Ready to start");
    //             Quagga.start();
    //         });
    // }
    // Quagga.onDetected(function(data) {
    //     // alert(data.codeResult.code + ' ' + data.codeResult.format)
    //     $('#kodebarang').val(data.codeResult.code)
    //     OpenBarcode()
    //     Quagga.stop()
    //     $('#modal-scan2').modal('toggle')
    // })

    // function matiinscan2() {
    //     Quagga.stop()
    //     $('#modal-scan2').modal('toggle')
    // }
    //----------------------------------------------------------------------------------------
    var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", {
            fps: 10,
            qrbox: 150
        });

    function matiinscan() {
        html5QrcodeScanner.clear();
        $('#modal-scan').modal('toggle')
    }

    function ScanBarcode() {
        $('#modal-scan').modal('toggle')

        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            console.log(decodedText)
            $('#modal-scan').modal('toggle')
            html5QrcodeScanner.clear();
            $('#kodebarang').val(decodedText)
            // OpenBarcode()

        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            // console.warn(`Code scan error = ${error}`);
        }


        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    }
    $('.formeditopname').submit(function(e) {
        console.log('masuksubmit')
        e.preventDefault()
        let form = $('.formeditopname')[0];
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
                    if (result.error.error) {
                        Swal.fire({
                            icon: 'warning',
                            title: result.error.error,
                        })
                    }
                } else {
                    $('#qty').removeClass('is-invalid')
                    $('.qtymsg').html('')
                    $('#nilai_tukar').removeClass('is-invalid')
                    $('.nilai_tukarmsg').html('')
                    $('#jenis').removeClass('is-invalid')
                    $('.jenismsg').html('')
                    $('#berat').removeClass('is-invalid')
                    $('.beratmsg').html('')
                    $('#harga_beli').removeClass('is-invalid')
                    $('.harga_belimsg').html('')
                    $('#modal-edit').modal('toggle')
                    $('#modal-modal').modal('toggle')
                    $(".image-tag").val('');
                    $(".browse").val('');
                    tampildata()
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                    })

                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    })

    function OpenBarcode() {
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {
                barcode: $('#kodebarang').val()
            },
            url: "<?php echo base_url('caribarcodeopname'); ?>",
            success: function(result) {
                if (result.error) {
                    $('#kodebarang').addClass('is-invalid')
                    $('.kodebarangmsg').html(result.error)
                    Swal.fire({
                        icon: 'warning',
                        title: result.error,
                    })
                } else {
                    console.log(result)
                    $('#kodebarang').removeClass('is-invalid')
                    $('.kodebarangmsg').html('')
                    $('#kodebarang').val('')
                    // ModalEdit(result.id, nyala)
                    $('#openmodaldetail').html(result.tampildetail)
                    $('#modal-modal').modal('toggle')

                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function PilihBarang(id) {
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {
                iddetail: id
            },
            url: "<?php echo base_url('pilihbarangopname'); ?>",
            success: function(result) {
                if (result.error) {
                    Swal.fire({
                        icon: 'warning',
                        title: result.error,
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: result,
                    })
                    tampildata()
                    $('#modal-modal').modal('toggle')

                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function SelesaiOpname() {
        Swal.fire({
            title: 'Stock Opname',
            text: "Selesai Stock Opname ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Selesai',
        }).then((choose) => {
            if (choose.isConfirmed) {
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "<?php echo base_url('selesaiopname'); ?>",
                    success: function(result) {
                        console.log(result);
                        if (result.error) {
                            Swal.fire({
                                icon: 'warning',
                                title: result.error,
                            })
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Stock Opname',
                            })
                            tampildata()
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                })
            }
        })
    }

    function tampildata() {
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {
                pilihan: $('#pilihan').val()
            },
            url: "<?php echo base_url('tampilopname'); ?>",
            success: function(result) {
                $('#dataopname').html(result.tampildata)
                $('#totalbarang').html(result.jumlah_barang)
                $('#sisaopname').html(result.belum_opname)
                $('#sudahopname').html(result.sisa_opname)
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function ModalEdit(iddetail) {
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {
                iddetail: iddetail
            },
            url: "<?php echo base_url('editopname'); ?>",
            success: function(result) {
                // $('#openmodaledit').html(result.tampilmodaledit) 
                $('#modal-edit').modal('toggle')
                $('#iddetail').val(result.barang.id_stock)
                $('#merek').val(result.barang.merek)
                $('#kadar').val(result.barang.kadar)
                $('#jenis').val(result.barang.jenis)
                $('#berat').val(result.barang.berat)
                $('#model').val(result.barang.model)
                $('#keterangan').val(result.barang.keterangan)
                $('#qty').val(result.barang.qty)
                $('#nilai_tukar').val(result.barang.nilai_tukar)
                $('#ongkos').val(result.barang.ongkos)
                $('#harga_beli').val(result.barang.harga_beli)

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }
    $(document).ready(function() {
        $("#modal-foto").on("hidden.bs.modal", function() {
            if (!$(".image-tag").val()) {
                Webcam.reset('#my_camera')
            }
        });
        tampildata()
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