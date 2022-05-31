<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .table {
        vertical-align: middle;
        text-align: center;
    }

    .imgg {
        width: 100px;
    }


    .autocomplete {
        position: relative;
        display: inline-block;
    }

    input {
        border: 1px solid transparent;
        background-color: #f1f1f1;
        padding: 10px;
        font-size: 16px;
    }

    input[type=text] {
        background-color: #f1f1f1;
        width: 100%;
    }

    input[type=number] {
        background-color: #f1f1f1;
        width: 100%;
    }

    input[type=submit] {
        background-color: DodgerBlue;
        color: #fff;
        cursor: pointer;
    }

    .autocomplete-items {
        position: absolute;
        border: 1px solid #d4d4d4;
        border-bottom: none;
        border-top: none;
        z-index: 99;
        /*position the autocomplete items to be the same width as the container:*/
        top: 100%;
        left: 0;
        right: 0;
    }

    .autocomplete-items div {
        padding: 10px;
        cursor: pointer;
        background-color: #fff;
        border-bottom: 1px solid #d4d4d4;
    }

    /*when hovering an item:*/
    .autocomplete-items div:hover {
        background-color: #e9e9e9;
    }

    /*when navigating through the items using the arrow keys:*/
    .autocomplete-active {
        background-color: DodgerBlue !important;
        color: #ffffff;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Form Retur Barang</h1>
                </div><!-- /.col -->
                <!-- /.content-header -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dataretur">Home</a></li>
                        <li class="breadcrumb-item"><a href="/dataretur">Retur Barang</a></li>
                        <li class="breadcrumb-item active">Form Retur</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-8">
                <div class="card" id="card1">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" id="card2">
                        <table class="table table-head-fixed text-nowrap">
                            <tr>
                                <td>No Retur :</td>
                                <td>
                                    <?= $datamasterretur['no_retur'] ?>
                                </td>
                                <td>No Transaksi :</td>
                                <td>
                                    <?= $datamasterretur['no_transaksi'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Retur :</td>
                                <td>
                                    <?= substr($datamasterretur['tanggal_retur'], 0, 10) ?>
                                </td>
                                <td>Tanggal Jatuh Tempo :</td>
                                <td>
                                    <?= substr($datamasterretur['tgl_jatuh_tempo'], 0, 10) ?>
                                </td>
                            </tr>
                            <tr style="background-color: #d7f2f3;">
                                <td> Total Berat :</td>
                                <td>
                                    <?= $datamasterretur['total_berat_murni'] ?> g
                                </td>
                                <td> Bayar Berat:</td>
                                <td>
                                    <?= $datamasterretur['murnibeli'] ?> g
                                </td>
                            </tr>
                            <tr>
                                <td>Jumlah Barang :</td>
                                <td>
                                    <?= $datamasterretur['jumlah_barang'] ?>
                                </td>
                                <td>No Faktur :</td>
                                <td>
                                    <?= $datamasterretur['no_faktur_supp'] ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <div class="col-4">
                <!-- Application buttons -->
                <div class="card">
                    <div class="card-body" id="refreshtombol">
                        <a type="button" onclick="Batal()" class="btn btn-app">
                            <i class="fas fa-window-close"></i> Batal Retur
                        </a>
                        <?php if (isset($datamasterretur)) : ?>
                            <?php if ($datamasterretur['status_dokumen'] == 'Selesai') : ?>
                                <a class="btn btn-app bg-primary" type="button">
                                    <i class="fas fa-check"></i> Proses Retur
                                </a>
                                <a href="/printnotaretur/<?= $datamasterretur['id_date_retur'] ?>" target="_blank" class="btn btn-app">
                                    <i class="fas fa-print"></i> Print Nota
                                </a>
                            <?php else : ?>
                                <a class="btn btn-app bg-danger" type="button" data-toggle="modal" data-target="#modal-lg">
                                    <i class="fas fa-money-bill"></i> Lanjut Proses
                                </a>
                            <?php endif ?>
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
                    <?php if (isset($datamasterretur)) : ?>
                        <?php if ($datamasterretur['status_dokumen'] != 'Selesai') : ?>
                            <div class="col-6">
                                <label>Pilih Barang Retur</label>
                                <div class="card">
                                    <!-- /.card-header -->
                                    <button type="button" class="btn btn-block btn-outline-info btn-sm" onclick="ModalPrintRetur(1,<?= $datamasterretur['id_date_retur'] ?>)"> <i class="fas fa-print"></i></button>
                                    <div class="card-body table-responsive p-0" style="max-height: 500px;">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <!-- <th>Gambar</th> -->
                                                    <th>Kode</th>
                                                    <th>Keterangan</th>
                                                    <th>Status</th>
                                                    <th>Berat</th>
                                                    <th>Murni</th>
                                                    <th>Pilih</th>
                                                </tr>
                                            </thead>
                                            <tbody id="refreshtbl1">
                                                <?php foreach ($dataretur as $row) : ?>
                                                    <tr id="dataretur">
                                                        <!-- <td class="imgg"><img class="imgg" src="/img/<?= $row['nama_img'] ?>"></td> -->
                                                        <td><a href="#" onclick="openmodaldetail(<?= $row['id_detail_buyback'] ?>)"><?= $row['kode'] ?></a></td>
                                                        <td><input type="text" onchange="UbahKet(this,<?= $row['id_detail_buyback'] ?>)" id="ubahketerangan" name="ubahketerangan" value="<?= $row['keterangan'] ?>"></td>
                                                        <td><select name="status_proses" style="width: 150%;" onchange="EditData(<?= $row['id_detail_buyback'] ?>,this)" class="form-control" id="status" name="status">
                                                                <option value="Cuci">Cuci</option>
                                                                <option selected value="Retur">Retur</option>
                                                                <option value="Lebur">Lebur</option>
                                                            </select></td>
                                                        <td><input onchange="UbahBerat(this,<?= $row['id_detail_buyback'] ?>)" style="max-width: 50%;" type="number" id="ubahberat" name="ubahberat" value="<?= $row['berat'] ?>"></td>
                                                        <td><?= $row['berat_murni'] ?></td>
                                                        <td>
                                                            <a type="button" onclick="tambahbarangretur(<?= $row['id_detail_buyback'] ?>)" class="btn btn-block btn-outline-info btn-sm">Retur</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <div class="col-6">
                                <label>Barang Retur</label>
                                <div class="card">
                                    <!-- /.card-header -->
                                    <button type="button" class="btn btn-block btn-outline-info btn-sm" onclick="ModalPrintRetur(2,<?= $datamasterretur['id_date_retur'] ?>)"> <i class="fas fa-print"></i></button>

                                    <div class="card-body table-responsive p-0" style="max-height: 500px;">
                                        <table class="table table-head-fixed text-nowrap">
                                            <thead>
                                                <tr>
                                                    <!-- <th>Gambar</th> -->
                                                    <th>Kode</th>
                                                    <th>Keterangan</th>
                                                    <th>Berat</th>
                                                    <th>Berat Murni</th>
                                                    <th>Hapus</th>
                                                </tr>
                                            </thead>
                                            <tbody id="refreshtbl">
                                                <?php foreach ($dataakanretur as $row) : ?>
                                                    <tr id="akanretur">
                                                        <!-- <td class="imgg"><img class="imgg" src="/img/<?= $row['nama_img'] ?>"></td> -->
                                                        <td><?= $row['kode'] ?></td>
                                                        <td><?= $row['keterangan'] ?></td>
                                                        <td><?= $row['berat'] ?></td>
                                                        <td><?= $row['berat_murni'] ?></td>
                                                        <td>
                                                            <button type='button' class='btn btn-block bg-gradient-danger' onclick="hapus(<?= $row['id_detail_retur'] ?>)"><i class='fas fa-trash'></i></button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        <?php else : ?>
                            <div class="col-12">
                                <label>Barang Retur</label>
                                <div class="card">
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0" style="max-height: 500px;">
                                        <table class="table table-head-fixed text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center;">Gambar</th>
                                                    <th style="text-align: center;">Kode</th>
                                                    <th style="text-align: center;">Jenis</th>
                                                    <th style="text-align: center;">Model</th>
                                                    <th style="text-align: center;">Berat Murni</th>
                                                    <th style="text-align: center;">Status</th>

                                                    <!-- <th>detail</th> -->
                                                </tr>
                                            </thead>
                                            <tbody id="tblselesairetur">
                                                <?php foreach ($dataakanretur as $row) : ?>
                                                    <tr id="trselesairetur">
                                                        <td class="imgg"><img class="imgg" src="/img/<?= $row['nama_img'] ?>"></td>
                                                        <td><?= $row['kode'] ?></td>
                                                        <td><?= $row['jenis'] ?></td>
                                                        <td><?= $row['model'] ?></td>
                                                        <td><?= $row['berat_murni'] ?></td>
                                                        <td> <select name="status_proses" onchange="EditLanjutProses(<?= $row['id_detail_retur'] ?>,this)" class="form-control" id="status" name="status">
                                                                <option selected value="Retur">Retur</option>
                                                                <option value="Cuci">Cuci</option>
                                                                <option value="Lebur">Lebur</option>
                                                            </select></td>
                                                        <td>
                                                            <!-- <td> <a type="button" href="/detailbarang/<?= $row['kode'] ?>" class="btn btn-block btn-outline-info btn-sm">Detail</a>
                                                        </td> -->
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        <?php endif ?>
                    <?php endif ?>

                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Retur</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/selesairetur" name="selesairetur" id="selesairetur" class="selesairetur" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="iddate" id="iddate" value="<?= $datamasterretur['id_date_retur'] ?>">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group" style="margin: 1mm;">
                                <label>Tanggal Retur</label>
                                <input type="date" class="form-control tanggalretur" id="tanggalretur" name="tanggalretur" value="<?= (isset($datamasterretur['tanggal_retur'])) ? date_format(date_create($datamasterretur['tanggal_retur']), "Y-m-d") : '' ?>">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback tanggalreturmsg">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group" style="margin: 1mm;">
                                <label>Keterangan</label>
                                <input type="text" class="form-control keterangan" id="keterangan" name="keterangan" placeholder="Masukan Keterangan">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback keteranganmsg">
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary btntambah">Selesai</button>
            </div>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
<div class="modal fade" id="modal-detail">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body table-responsive p-0" style="max-height: 500px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Kode</th>
                                <th>jenis</th>
                                <th>Keterangan</th>
                                <th>Model</th>
                                <th>Merek</th>
                                <th>Berat</th>
                                <th>Qty</th>
                                <th>Harga Beli</th>
                                <th>Kadar</th>
                                <th>Nilai Tukar</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody id="detailmodelbarang">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Selesai</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div id="modalretur">
</div>
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<!-- Main Footer -->
<footer class="main-footer">

</footer>
<script type="text/javascript">
    function UbahBerat(val, id) {
        $.ajax({
            type: "get",
            dataType: "json",
            url: "<?php echo base_url('ubahberat'); ?>",
            data: {
                id: id,
                val: val.value
            },
            success: function(hasil) {
                refreshtbl()
                // $('#detailmodelbarang').html(hasil.data)
                if (hasil.error) {
                    if (hasil.error.val) {
                        Swal.fire({
                            icon: 'warning',
                            title: hasil.error.val,
                        })
                    }
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function UbahKet(val, id) {
        $.ajax({
            type: "get",
            dataType: "json",
            url: "<?php echo base_url('ubahket'); ?>",
            data: {
                id: id,
                val: val.value
            },
            success: function(hasil) {
                // $('#detailmodelbarang').html(hasil.data)
                if (hasil.error) {
                    if (hasil.error.val) {
                        Swal.fire({
                            icon: 'warning',
                            title: hasil.error.val,
                        })
                    }
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);

            }
        })
    }

    function EditLanjutProses(id, val) {
        Swal.fire({
            title: 'Ubah Status ' + val.value,
            text: "Data akan di masukan ke " + val.value + " ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Selesai',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "get",
                    dataType: "json",
                    url: "<?php echo base_url('ubahstatuslanjutretur'); ?>",
                    data: {
                        id: id,
                        status: val.value,
                    },
                    success: function(hasil) {
                        console.log(hasil)
                        // refreshtbl()
                        $("#tblselesairetur").load("/draftretur/" + <?= $datamasterretur['id_date_retur'] ?> + " #trselesairetur");
                        $("#card1").load("/draftretur/" + <?= $datamasterretur['id_date_retur'] ?> + " #card2");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        // Swal.fire({
                        //     icon: 'warning',
                        //     title: 'Tidak ada data',
                        // })
                    }
                })
            } else {
                $("#tblselesairetur").load("/draftretur/" + <?= $datamasterretur['id_date_retur'] ?> + " #trselesairetur");
            }
        })

    }


    function ModalPrintRetur(id, dateid) {
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {
                id: id,
                dateid: dateid
            },
            url: "<?php echo base_url('modalprintretur') ?>",
            success: function(result) {
                $('#modalretur').html(result.tampilmodal)
                $('#modal-retur').modal('toggle')
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);

            }
        })
    }

    function EditData(id, val) {
        $.ajax({
            type: "get",
            dataType: "json",
            url: "<?php echo base_url('ubahstatus'); ?>",
            data: {
                id: id,
                status: val.value,
            },
            success: function(hasil) {
                refreshtbl()
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                // Swal.fire({
                //     icon: 'warning',
                //     title: 'Tidak ada data',
                // })
            }
        })
    }

    function hapus(id) {
        $.ajax({
            type: "get",
            dataType: "json",
            url: "<?php echo base_url('hapusretur'); ?>",
            data: {
                id: id,
            },
            success: function(hasil) {
                refreshtbl()
            },
            error: function(xhr, ajaxOptions, thrownError) {
                // alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                Swal.fire({
                    icon: 'warning',
                    title: 'Tidak ada data',
                })
            }
        })

    }

    function openmodaldetail(id) {
        $('#modal-detail').modal('toggle');
        detailbarang(id)
    }

    function detailbarang(id) {
        $.ajax({
            type: "get",
            dataType: "json",
            url: "<?php echo base_url('detailbarang'); ?>",
            data: {
                id: id,
            },
            success: function(hasil) {
                $('#detailmodelbarang').html(hasil.data)
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                // Swal.fire({
                //     icon: 'warning',
                //     title: 'Tidak ada data',
                // })
            }
        })

    }

    function Batal() {
        Swal.fire({
            title: 'Batal Retur ',
            text: "Apakah Ingin Batal Retur ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo base_url('batalretur/' . $datamasterretur['id_date_retur']); ?>"
            }
        })

    };

    function tambahbarangretur(kode) {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('tambahretur'); ?>",
            data: {
                kode: kode,
                iddate: <?= $datamasterretur['id_date_retur'] ?>
            },
            success: function(result) {
                refreshtbl()
                if (result.error) {
                    Swal.fire({
                        icon: 'warning',
                        title: result.error,
                    })
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })

    }

    function refreshtbl() {
        $("#refreshtbl").load("/draftretur/" + <?= $datamasterretur['id_date_retur'] ?> + " #akanretur");
        $("#refreshtbl1").load("/draftretur/" + <?= $datamasterretur['id_date_retur'] ?> + " #dataretur");
        $("#card1").load("/draftretur/" + <?= $datamasterretur['id_date_retur'] ?> + " #card2");

    }

    $(document).ready(function() {
        $('.selesairetur').submit(function(e) {
            e.preventDefault()
            Swal.fire({
                title: 'Lanjut Proses ',
                text: "Lanjut Proses Retur ?",
                icon: 'info',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Selesai',
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = $('.selesairetur')[0];
                    let data = new FormData(form)
                    $.ajax({
                        type: "POST",
                        data: data,
                        url: "<?php echo base_url('selesairetur'); ?>",
                        dataType: "json",
                        contentType: false,
                        processData: false,
                        cache: false,
                        success: function(hasil) {
                            if (hasil.error) {
                                if (hasil.error.harga_murni) {
                                    $('#harga_murni').addClass('is-invalid')
                                    $('.harga_murnimsg').html(hasil.error.harga_murni)
                                } else {
                                    $('#harga_murni').removeClass('is-invalid')
                                    $('.harga_murnimsg').html('')
                                }
                                if (hasil.error.data) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Tidak ada data',
                                    })
                                }

                            } else {
                                $('#harga_murni').removeClass('is-invalid')
                                $('.harga_murnimsg').html('')
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil Retur',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK',
                                    allowOutsideClick: false
                                }).then((choose) => {
                                    if (choose.isConfirmed) {
                                        location.reload();
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
    })
</script>
<?= $this->endSection(); ?>