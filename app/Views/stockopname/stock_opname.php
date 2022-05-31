<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
<script src="/js/html5-qrcode.min_.js"></script>
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

    .modal {
        overflow: auto !important;
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
                            <input onfocus="this.select()" type="text" class="form-control kodebarang" id="kodebarang" name="kodebarang" placeholder="Masukan Barcode">
                            <span class="input-group-append">
                                <button type="button" onclick="OpenBarcode()" id="btnsubmitform" class="btn btn-info btn-flat btnsubmitform">Ok</button>
                            </span>
                            <div id="validationServerUsernameFeedback" class="invalid-feedback kodebarangmsg">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group" style="margin: 1mm;">
                                <label>Kelompok Barang</label>
                                <div class="input-group input-group-sm">
                                    <select name="pilihan" onchange="tampildata()" class="form-control" id="pilihan" name="pilihan">
                                        <option value="1" selected>Perhiasan Emas</option>
                                        <option value="2">Perhiasan Berlian</option>
                                        <option value="3">Emas Lm</option>
                                        <option value="4">Bahan Murni</option>
                                        <option value="5">Loose Diamond</option>
                                        <option value="6">Barang Dagang</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group" style="margin: 1mm;">
                                <label>Sudah Opname</label>
                                <div class="input-group input-group-sm">
                                    <select name="status" onchange="tampildata()" class="form-control" id="status" name="status">
                                        <option value="blm" selected>Belum Opname</option>
                                        <option value="sdh">Sudah Opname</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin: 1mm;">
                        <a class="btn btn-app bg-primary" type="button" onclick="SelesaiOpname()">
                            <i class="fas fa-check"></i> Selesai
                        </a>
                        <a class="btn btn-app bg-primary" type="button" onclick="ScanBarcode()">
                            <i class="fas Example of barcode fa-camera"></i> Scan Barcode
                        </a>
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
                <div id="openmodaledit">

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
                                                    <input onfocus="this.select()" type="file" name="gambar" class="custom-file-input browse" id="gambar" accept="image/*">
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
                                            <input onfocus="this.select()" type='hidden' name='gambar' id='gambar' class='image-tag'>
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
<script type="text/javascript">
    var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", {
            fps: 50,
            qrbox: 50,
        });

    function matiinscan() {
        html5QrcodeScanner.clear();
        $('#modal-scan').modal('toggle')
    }

    function ScanBarcode() {
        $('#modal-scan').modal('toggle')

        function onScanSuccess(decodedText, decodedResult) {
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
                    $('#carat').removeClass('is-invalid')
                    $('.caratmsg').html('')
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

    function PilihBarang(id, kel) {
        console.log(kel)
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {
                iddetail: id,
                kel: kel
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

    function tampildata(stat) {
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {
                kel: $('#pilihan').val(),
                status: $('#status').val()
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

    function ModalEdit(iddetail, kel) {
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {
                iddetail: iddetail,
                kel: kel
            },
            url: "<?php echo base_url('editopname'); ?>",
            success: function(result) {
                console.log(result)
                $('#openmodaledit').html(result.tampildata)
                // $('#openmodaledit').html(result.tampilmodaledit) 
                $('#modal-edit').modal('toggle')
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
</script>
<?= $this->endSection(); ?>