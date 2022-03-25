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
                    <h1 class="m-0">Form Cuci Barang</h1>
                </div><!-- /.col -->
                <!-- /.content-header -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/datacuci">Home</a></li>
                        <li class="breadcrumb-item"><a href="/datacuci">Cuci Barang</a></li>
                        <li class="breadcrumb-item active">Form Cuci</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-6">
                <div class="card" id="tblcard">
                    <!-- /.card-header -->
                    <table class="table text-nowrap" id="tblheader">
                        <tr>
                            <td>Tanggal Cuci :</td>
                            <td>
                                <?= $datamastercuci['tanggal_cuci'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td> Total Berat cuci :</td>
                            <td>
                                <?= $datamastercuci['total_berat'] ?> g
                            </td>
                        </tr>
                        <tr>
                            <td>Jumlah Barang :</td>
                            <td>
                                <?= $datamastercuci['jumlah_barang'] ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- /.card -->
            </div>
            <div class="col-6">
                <!-- Application buttons -->
                <div class="card">
                    <div class="card-body" id="refreshtombol">

                        <?php if (isset($datamastercuci)) : ?>
                            <?php if ($datamastercuci['status_dokumen'] == 'Selesai') : ?>
                                <a class="btn btn-app bg-primary" type="button">
                                    <i class="fas fa-check"></i> Proses Cuci
                                </a>
                                <a class="btn btn-app" href="/printbarcodecuci/<?= $datamastercuci['id_date_cuci'] ?>" target="_blank">
                                    <i class="fas fa-barcode"></i> Print Barcode
                                </a>
                                <a href="/printnotacuci/<?= $datamastercuci['id_date_cuci'] ?>" target="_blank" class="btn btn-app">
                                    <i class="fas fa-print"></i> Print Nota
                                </a>

                            <?php else : ?>
                                <a type="button" onclick="Batal()" class="btn btn-app">
                                    <i class="fas fa-window-close"></i> Batal Cuci
                                </a>
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
                    <?php if (isset($datamastercuci)) : ?>
                        <?php if ($datamastercuci['status_dokumen'] != 'Selesai') : ?>
                            <div class="col-6">
                                <label>Pilih Barang Cuci</label>
                                <div class="card">
                                    <!-- /.card-header -->
                                    <button type="button" class="btn btn-block btn-outline-info btn-sm" onclick="ModalPrintCuci(1,<?= $datamastercuci['id_date_cuci'] ?>)"> <i class="fas fa-print"></i></button>
                                    <div class="card-body table-responsive p-0" style="max-height: 500px;">
                                        <table class="table table-head-fixed text-nowrap">
                                            <thead>
                                                <tr>
                                                    <!-- <th>Gambar</th> -->
                                                    <th>Kode</th>
                                                    <th>Keterangan</th>
                                                    <th>Status</th>
                                                    <th>Berat</th>
                                                    <th>Pilih</th>
                                                </tr>
                                            </thead>
                                            <tbody id="refreshtbl1">
                                                <?php foreach ($datacuci as $row) : ?>
                                                    <tr id="datacuci">
                                                        <!-- <td class="imgg"><img class="imgg" src="/img/<?= $row['nama_img'] ?>"></td> -->
                                                        <td><a href="#" onclick="openmodaldetail(<?= $row['id_detail_buyback'] ?>)"><?= $row['kode'] ?></a></td>
                                                        <td><?= $row['jenis'] ?> <?= $row['model'] ?></td>
                                                        <td> <select name="status_proses" onchange="EditDataCuci(<?= $row['id_detail_buyback'] ?>,this)" class="form-control" id="status" name="status">
                                                                <option selected value="Cuci">Cuci</option>
                                                                <option value="Retur">Retur</option>
                                                                <option value="Lebur">Lebur</option>
                                                            </select></td>
                                                        <td><?= $row['berat'] ?></td>
                                                        <td>
                                                            <a type="button" onclick="tambahbarangcuci(<?= $row['id_detail_buyback'] ?>)" class="btn btn-block btn-outline-info btn-sm">Cuci</a>
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
                                <label>Barang Cuci</label>
                                <div class="card">
                                    <button type="button" class="btn btn-block btn-outline-info btn-sm" onclick="ModalPrintCuci(2,<?= $datamastercuci['id_date_cuci'] ?>)"> <i class="fas fa-print"></i></button>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0" style="max-height: 500px;">
                                        <table class="table table-head-fixed text-nowrap">
                                            <thead>
                                                <tr>
                                                    <!-- <th>Gambar</th> -->
                                                    <th>Kode</th>
                                                    <th>Keterangan</th>
                                                    <th>Berat</th>
                                                    <th>Hapus</th>
                                                </tr>
                                            </thead>
                                            <tbody id="refreshtbl">
                                                <?php foreach ($dataakancuci as $row) : ?>
                                                    <tr id="akancuci">
                                                        <!-- <td class="imgg"><img class="imgg" src="/img/<?= $row['nama_img'] ?>"></td> -->
                                                        <td><?= $row['kode'] ?></td>
                                                        <td><?= $row['jenis'] ?> <?= $row['model'] ?></td>
                                                        <td><?= $row['berat'] ?></td>
                                                        <td>
                                                            <button type='button' class='btn btn-block bg-gradient-danger' onclick="hapus(<?= $row['id_detail_cuci'] ?>)"><i class='fas fa-trash'></i></button>
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
                                <label>Barang Cuci</label>
                                <div class="card">
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0" style="max-height: 500px;" id="tblselesaicuci">
                                        <table class="table table-head-fixed text-nowrap" id="trselesaicuci">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center;">Gambar</th>
                                                    <th style="text-align: center;">Kode</th>
                                                    <th style="text-align: center;">Jenis</th>
                                                    <th style="text-align: center;">Model</th>
                                                    <th style="text-align: center;">Berat</th>
                                                    <th style="text-align: center;">Status</th>
                                                    <th style="text-align: center;">Cuci</th>
                                                </tr>
                                            </thead>
                                            <tbody id="selesaicuci">
                                                <?php foreach ($dataakancuci as $row) : ?>
                                                    <tr id="sudahcuci">
                                                        <td class="imgg"><img class="imgg" src="/img/<?= $row['nama_img'] ?>"></td>
                                                        <td><?= $row['kode'] ?></td>
                                                        <td><?= $row['jenis'] ?></td>
                                                        <td><?= $row['model'] ?></td>
                                                        <td><?= $row['berat'] ?></td>
                                                        <td> <select name="status_proses" onchange="EditLanjutProses(<?= $row['id_detail_cuci'] ?>,this)" class="form-control" id="status" name="status">
                                                                <option selected value="Cuci">Cuci</option>
                                                                <option value="Retur">Retur</option>
                                                                <option value="Lebur">Lebur</option>
                                                            </select></td>
                                                        <td>
                                                            <a type="button" href="/detailbarang/<?= $row['kode'] ?>" class="btn btn-block btn-outline-info btn-sm">Detail</a>
                                                            <?php if ($row['status_proses'] != 'SelesaiCuci') : ?>
                                                                <a type="button" onclick="editcuci(<?= $row['id_detail_cuci'] ?>)" class="btn btn-block btn-outline-danger btn-sm">Selesai Cuci</a>
                                                            <?php endif; ?>
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
</div>
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Cuci</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/selesaicuci" name="selesaicuci" id="selesaicuci" class="selesaicuci" method="post">
                    <?= csrf_field(); ?>
                    <div class="row">
                        <div class="col-3">
                            <input type="hidden" name="dateidcuci" id="dateidcuci" value="<?= $datamastercuci['id_date_cuci'] ?>">
                            <div class="form-group" style="margin: 1mm;">
                                <label>Tanggal Cuci</label>
                                <input type="date" class="form-control tanggalcuci" id="tanggalcuci" name="tanggalcuci" value="<?= (isset($datamastercuci['tanggal_cuci'])) ? date_format(date_create($datamastercuci['tanggal_cuci']), "Y-m-d") : '' ?>" placeholder="Masukan Tanggal Cuci">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback tanggalcucimsg">
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group" style="margin: 1mm;">
                                <label>Keterangan</label>
                                <input type="text" class="form-control keterangan" id="keterangan" name="keterangan" placeholder="Masukan Keterangan">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback keteranganmsg">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Nama Tukang</label>
                                <select name="nama_tukang" id="nama_tukang" class="form-control nama_tukang" placeholder="Masukan Harga Beli">
                                    <?php foreach ($datatukang as $row) : ?>
                                        <option value="<?= $row['nama_tukang'] ?>"><?= $row['nama_tukang'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div id="validationServerUsernameFeedback" class="invalid-feedback nama_tukangmsg">
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Ongkos</label>
                                <input type="number" id="harga_cuci" name="harga_cuci" class="form-control" placeholder="Masukan Nomor Harga Cuci">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback harga_cucimsg">
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
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/updatecuci" id="updatecuci" class="updatecuci" name="updatecuci">
                    <?= csrf_field(); ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Berat</label>
                                <input type="number" step="0.01" id="berat" name="berat" class="form-control" placeholder="Masukan Berat Bersih">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback beratmsg">
                                </div>
                                <input type="hidden" name="id" id="id" value="">
                                <input type="hidden" name="kode" id="kode" value="">
                            </div>
                        </div>
                        <!-- <div class="col-sm-5">
                            <div class="form-group">
                                <label>Nilai Tukar</label>
                                <input type="number" id="nilai_tukar" name="nilai_tukar" class="form-control" placeholder="Masukan Nilai Tukar">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback nilai_tukarmsg">
                                </div>
                            </div>
                        </div> -->
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btnedit">Update</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div id="modalcuci">
</div>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<!-- Main Footer -->
<footer class="main-footer">

</footer>
<script type="text/javascript">
    $('.updatecuci').submit(function(e) {
        e.preventDefault()
        Swal.fire({
            title: 'Selesai Cuci ',
            text: "Data akan di masukan ke master stock ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Selesai',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                let form = $('.updatecuci')[0];
                let data = new FormData(form)
                $.ajax({
                    type: "POST",
                    data: data,
                    url: "<?php echo base_url('updatecuci'); ?>",
                    contentType: false,
                    processData: false,
                    cache: false,
                    dataType: "json",
                    success: function(result) {
                        if (result.error) {
                            if (result.error.nilai_tukar) {
                                $('#nilai_tukar').addClass('is-invalid')
                                $('.nilai_tukarmsg').html(result.error.nilai_tukar)
                            } else {
                                $('#nilai_tukar').removeClass('is-invalid')
                                $('.nilai_tukarmsg').html('')
                            }
                            if (result.error.berat) {
                                $('#berat').addClass('is-invalid')
                                $('.beratmsg').html(result.error.berat)
                            } else {
                                $('#berat').removeClass('is-invalid')
                                $('.beratmsg').html('')
                            }
                        } else {
                            $('#nilai_tukar').removeClass('is-invalid')
                            $('.nilai_tukarmsg').html('')
                            $('#berat').removeClass('is-invalid')
                            $('.beratmsg').html('')
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Di Cuci',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK',
                                allowOutsideClick: false
                            }).then((choose) => {
                                if (choose.isConfirmed) {
                                    console.log(result)
                                    $('#modal-edit').modal('toggle');
                                    $("#selesaicuci").load("/draftcuci/" + <?= $datamastercuci['id_date_cuci'] ?> + " #sudahcuci");

                                    // window.location.href = '/datacuci'
                                    // document.getElementById('refreshtbl').innerHTML = ''
                                    // $("#refresconten").load("/datacuci #refreshtbl");
                                    // $('#example1').data.reload();
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

    function editcuci(id) {
        $.ajax({
            type: "get",
            dataType: "json",
            url: "<?php echo base_url('tampilcuci'); ?>",
            data: {
                id: id,
            },
            success: function(result) {
                $('#modal-edit').modal('show');
                $('#berat').val(result.data.berat)
                $('#nilai_tukar').val(result.data.nilai_tukar)
                $('#harga_beli').val(result.data.harga_beli)
                $('#id').val(result.data.id_detail_cuci)
                $('#kode').val(result.data.kode)
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function ModalPrintCuci(id, dateid) {
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {
                id: id,
                dateid: dateid
            },
            url: "<?php echo base_url('modalprintcuci') ?>",
            success: function(result) {
                $('#modalcuci').html(result.tampilmodal)
                $('#modal-cuci').modal('toggle')
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);

            }
        })
    }

    function EditDataCuci(id, val) {
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
                    url: "<?php echo base_url('ubahstatuslanjut'); ?>",
                    data: {
                        id: id,
                        status: val.value,
                    },
                    success: function(hasil) {
                        // refreshtbl()
                        $("#tblselesaicuci").load("/draftcuci/" + <?= $datamastercuci['id_date_cuci'] ?> + " #trselesaicuci");
                        $("#tblcard").load("/draftcuci/" + <?= $datamastercuci['id_date_cuci'] ?> + " #tblheader");
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
                $("#tblselesaicuci").load("/draftcuci/" + <?= $datamastercuci['id_date_cuci'] ?> + " #trselesaicuci");
            }
        })

    }

    function hapus(id) {
        $.ajax({
            type: "get",
            dataType: "json",
            url: "<?php echo base_url('hapuscuci'); ?>",
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
            title: 'Batal Cuci ',
            text: "Apakah Ingin Batal Cuci ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo base_url('batalcuci/' . $datamastercuci['id_date_cuci']); ?>"
            }
        })

    };



    function tambahbarangcuci(kode) {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('tambahcuci'); ?>",
            data: {
                kode: kode,
                iddate: <?= $datamastercuci['id_date_cuci'] ?>
            },
            success: function(result) {
                refreshtbl()
                if (result == 'gagal') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Data Sudah Di masukan',
                    })
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })

    }

    function refreshtbl() {
        $("#refreshtbl").load("/draftcuci/" + <?= $datamastercuci['id_date_cuci'] ?> + " #akancuci");
        $("#refreshtbl1").load("/draftcuci/" + <?= $datamastercuci['id_date_cuci'] ?> + " #datacuci");
        $("#tblcard").load("/draftcuci/" + <?= $datamastercuci['id_date_cuci'] ?> + " #tblheader");

    }

    $(document).ready(function() {
        $('.selesaicuci').submit(function(e) {
            e.preventDefault()
            Swal.fire({
                title: 'Selesai Cuci ',
                text: "Apakah Yakin Selesai Cuci ?",
                icon: 'info',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Selesai',
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = $('.selesaicuci')[0];
                    let data = new FormData(form)
                    $.ajax({
                        type: "POST",
                        data: data,
                        url: "<?php echo base_url('selesaicuci'); ?>",
                        dataType: "json",
                        contentType: false,
                        processData: false,
                        cache: false,
                        success: function(hasil) {
                            if (hasil.error) {
                                if (hasil.error.qty) {
                                    $('#qty').addClass('is-invalid')
                                    $('.qtymsg').html(hasil.error.qty)
                                } else {
                                    $('#qty').removeClass('is-invalid')
                                    $('.qtymsg').html('')
                                }
                                if (hasil.error.berat_murni) {
                                    $('#berat_murni').addClass('is-invalid')
                                    $('.berat_murnimsg').html(hasil.error.berat_murni)
                                } else {
                                    $('#berat_murni').removeClass('is-invalid')
                                    $('.berat_murnimsg').html('')
                                }
                                if (hasil.error.gambar) {
                                    $('#ambilgbr').addClass('is-invalid')
                                    $('.ambilgbrmsg').html(hasil.error.gambar)
                                } else {
                                    $('#ambilgbr').removeClass('is-invalid')
                                    $('.ambilgbrmsg').html('')
                                }
                                if (hasil.error.data) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Tidak ada data',
                                    })
                                }
                            } else {
                                $('#qty').removeClass('is-invalid')
                                $('.qtymsg').html('')
                                $('#berat_murni').removeClass('is-invalid')
                                $('.berat_murnimsg').html('')
                                $('#ambilgbr').removeClass('is-invalid')
                                $('.ambilgbrmsg').html('')



                                window.location.href = "<?php echo base_url('draftcuci/' . $datamastercuci['id_date_cuci']); ?>"
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