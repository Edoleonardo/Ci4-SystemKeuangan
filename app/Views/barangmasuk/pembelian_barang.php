<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<script type="text/javascript" src="/js/jquery.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
<style>
    .table>* {
        vertical-align: middle;
        text-align: center;
    }

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
        <input type="hidden" name="date_id" id="date_id" value="<?= $dateid ?>">
        <form action="/ajaxinsert" name="ajaxform" id="ajaxform" class="ajaxform" method="post" enctype="multipart/form-data">
            <div id="forminput"></div>
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
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </form>
        <div class="card ">
            <!-- /.card-header -->
            <div class="card-body">
                <br>
                <div class="row">
                    <div class="col-12">
                        <div class="card" id="databeli">
                            <!-- /.card-header -->

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="row">
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
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Edit Pembelian</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/editpembelian" name="editpembelian" id="editpembelian" class="editpembelian" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div id="openmodaledit">
                </div>
                <div class="modal fade" id="modal-foto1">
                    <div class="modal-dialog modal-default">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Ambil Foto Edit</h4>
                                <button type="button" class="close" onclick="$('#modal-foto1').modal('toggle')" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="form-group"><label>Gambar</label>
                                                <div class="custom-file">
                                                    <input onfocus="this.select()" type="file" name="gambar1" class="custom-file-input browse" id="gambar1" accept="image/*">
                                                    <label style="text-align: left" class="custom-file-label" for="gambar1">Pilih Gambar</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <div id='my_camera1'>
                                            </div>
                                            <button style="text-align: center;" type='button' id='ambilfoto1' class='btn btn-info ambilfoto1' onclick='Foto_ulang1()'>
                                                <i class='fa fa-trash'></i></button>
                                            <button type='button' id='ambilfoto1' class='btn btn-info ambilfoto1' onclick='Ambil_foto1()'>Foto <i class='fa fa-camera'></i>
                                            </button>
                                            <input onfocus="this.select()" type='hidden' name='gambar1' id='gambar1' class='image-tag1'>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" onclick="$('#modal-foto1').modal('toggle')">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="$('#modal-foto1').modal('toggle')">Done</button>
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
<script type="text/javascript">
    function PilihBarcode(kode) {
        document.getElementById('barcode').value = kode
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {
                kode: kode,
            },
            url: "<?php echo base_url('detailbarcode') ?>",
            success: function(result) {
                console.log(result)
                if (result) {
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
                    $('#merek').val(result.datadetail.merek)
                    $('#kelompok').val($('#barcode').val().substr(0, 1))
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);

            }
        })
        $('#modal-xl').modal('hide');
    }

    function ModalBarcode(kel) {
        document.getElementById('barcode').value = ''
        // var kel = document.getElementById('kelompok').value
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {
                kel: kel
            },
            url: "<?php echo base_url('modalbarcode') ?>",
            success: function(result) {
                $('#barcodeview').html(result.modalbarcode)
                $('#modal-xl').modal('toggle');
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
                var dateid = document.getElementById('date_id').value
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

        if (document.getElementById('tanggal_nota_sup')) {
            var tanggal_input = document.getElementById('tanggal_input').value
            var supplier = document.getElementById('supplier').value
            var no_nota_supp = document.getElementById('no_nota_supp').value
            var tanggal_nota_sup = document.getElementById('tanggal_nota_sup').value
            var total_berat_m = document.getElementById('total_berat_m').value
            var tanggal_tempo = document.getElementById('tanggal_tempo').value
            var dateid = document.getElementById('date_id').value
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
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Tidak ada data',
            })
        }

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
                    data: {
                        date_id: $('#date_id').val()
                    },
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

    function tampilform() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('tampilform'); ?>",
            data: {
                date_id: $('#date_id').val()
            },
            success: function(result) {
                $('#forminput').html(result.form)
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function tampildata() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('ajaxpembelian'); ?>",
            data: {
                date_id: $('#date_id').val()
            },
            success: function(result) {

                $('#forminput').html(result.form)
                $('#databeli').html(result.data)
                if (result.totalbersih.total_harga) {
                    $('#theadtotalharga').html(result.totalbersih.total_harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
                }
                $('#theadmurni').html(pembulatankoma(result.totalberatmurni.berat_murni))
                $('#theadberat').html(pembulatankoma(result.totalberat.berat))
                $('#theadcarat').html(pembulatankoma(result.totalcarat.carat))

                $('#theadqty').html(result.totalqty.qty)


            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function ModalEdit_D(id, kel, jenis) {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('dataupdatedetailpembelian'); ?>",
            data: {
                id: id,
                kel: kel,
                jenis: jenis,
            },
            success: function(result) {
                $('#openmodaledit').html(result.tampilupdate)
                $('#modal-edit').modal('toggle')

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    $('.editpembelian').submit(function(e) {
        e.preventDefault()
        let form = $('.editpembelian')[0];
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
                $('.btntambah').html('Selesai Edit')
            },
            success: function(result) {
                tampildata()
                $('#modal-edit').modal('toggle')
                $("#editpembelian")[0].reset();
                $(".image-tag1").val('');
                //console.log(result)
                // if (result.error) {
                //     if (result.error.qty) {
                //         $('#qty').addClass('is-invalid')
                //         $('.qtymsg').html(result.error.qty)
                //     } else {
                //         $('#qty').removeClass('is-invalid')
                //         $('.qtymsg').html('')
                //     }
                //     if (result.error.total_berat) {
                //         $('#total_berat').addClass('is-invalid')
                //         $('.total_beratmsg').html(result.error.total_berat)
                //     } else {
                //         $('#total_berat').removeClass('is-invalid')
                //         $('.total_beratmsg').html('')
                //     }
                //     if (result.error.total_berat_m) {
                //         $('#total_berat_m').addClass('is-invalid')
                //         $('.total_berat_mmsg').html(result.error.total_berat_m)
                //     } else {
                //         $('#total_berat_m').removeClass('is-invalid')
                //         $('.total_berat_mmsg').html('')
                //     }
                //     if (result.error.nilai_tukar) {
                //         $('#nilai_tukar').addClass('is-invalid')
                //         $('.nilai_tukarmsg').html(result.error.nilai_tukar)
                //     } else {
                //         $('#nilai_tukar').removeClass('is-invalid')
                //         $('.nilai_tukarmsg').html('')
                //     }
                //     if (result.error.jenis) {
                //         $('#jenis').addClass('is-invalid')
                //         $('.jenismsg').html(result.error.jenis)
                //     } else {
                //         $('#jenis').removeClass('is-invalid')
                //         $('.jenismsg').html('')
                //     }
                //     if (result.error.berat) {
                //         $('#berat').addClass('is-invalid')
                //         $('.beratmsg').html(result.error.berat)
                //     } else {
                //         $('#berat').removeClass('is-invalid')
                //         $('.beratmsg').html('')
                //     }
                //     if (result.error.gambar) {
                //         $('#ambilgbr').addClass('is-invalid')
                //         $('.ambilgbrmsg').html(result.error.gambar)
                //     } else {
                //         $('#ambilgbr').removeClass('is-invalid')
                //         $('.ambilgbrmsg').html('')
                //     }
                //     if (result.error.no_nota_supp) {
                //         $('#no_nota_supp').addClass('is-invalid')
                //         $('.no_nota_suppmsg').html(result.error.no_nota_supp)
                //     } else {
                //         $('#no_nota_supp').removeClass('is-invalid')
                //         $('.no_nota_suppmsg').html('')
                //     }
                //     if (result.error.harga_beli) {
                //         $('#harga_beli').addClass('is-invalid')
                //         $('.harga_belimsg').html(result.error.harga_beli)
                //     } else {
                //         $('#harga_beli').removeClass('is-invalid')
                //         $('.harga_belimsg').html('')
                //     }
                //     if (result.error.ongkos) {
                //         $('#ongkos').addClass('is-invalid')
                //         $('.ongkosmsg').html(result.error.ongkos)
                //     } else {
                //         $('#ongkos').removeClass('is-invalid')
                //         $('.ongkosmsg').html('')
                //     }
                //     if (result.error.merek) {
                //         $('#merek').addClass('is-invalid')
                //         $('.merekmsg').html(result.error.merek)
                //     } else {
                //         $('#merek').removeClass('is-invalid')
                //         $('.merekmsg').html('')
                //     }
                //     if (result.error.carat) {
                //         $('#carat').addClass('is-invalid')
                //         $('.caratmsg').html(result.error.carat)
                //     } else {
                //         $('#carat').removeClass('is-invalid')
                //         $('.caratmsg').html('')
                //     }
                // } else {
                //     $('#qty').removeClass('is-invalid')
                //     $('.qtymsg').html('')
                //     $('#total_berat').removeClass('is-invalid')
                //     $('.total_beratmsg').html('')
                //     $('#total_berat_m').removeClass('is-invalid')
                //     $('.total_berat_mmsg').html('')
                //     $('#nilai_tukar').removeClass('is-invalid')
                //     $('.nilai_tukarmsg').html('')
                //     $('#jenis').removeClass('is-invalid')
                //     $('.jenismsg').html('')
                //     $('#berat').removeClass('is-invalid')
                //     $('.beratmsg').html('')
                //     $('#ambilgbr').removeClass('is-invalid')
                //     $('.ambilgbrmsg').html('')
                //     $('#no_nota_supp').removeClass('is-invalid')
                //     $('.no_nota_suppmsg').html('')
                //     $('#harga_beli').removeClass('is-invalid')
                //     $('.harga_belimsg').html('')
                //     $('#ongkos').removeClass('is-invalid')
                //     $('.ongkosmsg').html('')
                //     $('#merek').removeClass('is-invalid')
                //     $('.merekmsg').html('')
                //     $('#carat').removeClass('is-invalid')
                //     $('.caratmsg').html('')
                //     tampildata()
                // }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    })

    $(document).ready(function() {
        tampilform()
        // ModalBarcode()
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
                    console.log(result)
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
                        if (result.error.merek) {
                            $('#merek').addClass('is-invalid')
                            $('.merekmsg').html(result.error.merek)
                        } else {
                            $('#merek').removeClass('is-invalid')
                            $('.merekmsg').html('')
                        }
                        if (result.error.carat) {
                            $('#carat').addClass('is-invalid')
                            $('.caratmsg').html(result.error.carat)
                        } else {
                            $('#carat').removeClass('is-invalid')
                            $('.caratmsg').html('')
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
                        $('#merek').removeClass('is-invalid')
                        $('.merekmsg').html('')
                        $('#carat').removeClass('is-invalid')
                        $('.caratmsg').html('')
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
        $(".modal-edit").on("hidden.bs.modal", function() {
            Webcam.reset('#my_camera1')
        });
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


    /////////////////////////////////////////////FOTO RILL//////////////////////////////////////////////////////

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
    /////////////////////////////////////////////////FOTO EDIT//////////////////////////////////////////////////////////
    function cameranyala1() {
        if ($(".image-tag1").val()) {
            document.getElementById('my_camera1').innerHTML = '<img src="' + data_uri + '">'
        } else {
            Webcam.attach('#my_camera1');

        }
    }

    function Ambil_foto1() {
        Webcam.snap(function(data_uri) {
            $(".image-tag1").val(data_uri);
            Webcam.reset()
            // Webcam.attach('#my_camera');
            document.getElementById('my_camera1').innerHTML = '<img src="' + data_uri + '">'
        })
    }

    function Foto_ulang1() {
        document.getElementById('my_camera1').innerHTML = ''
        $(".image-tag1").val('');
        Webcam.attach('#my_camera1');
    }
</script>

<?= $this->endSection(); ?>