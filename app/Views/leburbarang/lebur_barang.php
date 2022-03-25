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
                    <h1 class="m-0">Form Lebur Barang</h1>
                </div><!-- /.col -->
                <!-- /.content-header -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/datalebur">Home</a></li>
                        <li class="breadcrumb-item"><a href="/datalebur">Lebur Barang</a></li>
                        <li class="breadcrumb-item active">Form Lebur</li>
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

                    <div id="refreshtitle">
                        <table class="table text-nowrap" id="titletr">

                            <?php if ($datamasterlebur['status_dokumen'] == 'Selesai') : ?>
                                <tr>
                                    <td> No Lebur :</td>
                                    <td>
                                        <?= $datamasterlebur['no_lebur'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td> Barcode :</td>
                                    <td>
                                        <?= $datamasterlebur['kode'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Gambar :</td>
                                    <td>
                                        <img class="imgg" src="/img/<?= $datamasterlebur['nama_img'] ?>">
                                    </td>
                                </tr>
                            <?php endif ?>
                            <tr>
                                <td> Total Berat Murni :</td>
                                <td>
                                    <?= $datamasterlebur['berat_murni'] ?> g
                                </td>
                            </tr>
                            <tr>
                                <td> Total Berat Kotor :</td>
                                <td>
                                    <?= $datamasterlebur['total_berat'] ?> g
                                </td>
                            </tr>
                            <tr>
                                <td>Total Barang :</td>
                                <td>
                                    <?= $datamasterlebur['jumlah_barang'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Total Harga :</td>
                                <td>
                                    <?= number_format($datamasterlebur['total_harga_bahan'], 0, ',', '.') ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <div class="col-6">
                <!-- Application buttons -->
                <div class="card">
                    <div class="card-body" id="refreshtombol">

                        <?php if (isset($datamasterlebur)) : ?>
                            <?php if ($datamasterlebur['status_dokumen'] == 'Selesai') : ?>
                                <a class="btn btn-app bg-primary" type="button">
                                    <i class="fas fa-check"></i> Selesai Lebur
                                </a>
                                <a type="button" class="btn btn-app bg-default" onclick="ModalPrintLebur(2,<?= $datamasterlebur['id_date_lebur'] ?>)">
                                    <i class="fas fa-print"></i>Print
                                </a>

                            <?php else : ?>
                                <a type="button" onclick="Batal()" class="btn btn-app">
                                    <i class="fas fa-window-close"></i> Batal Lebur
                                </a>
                                <a class="btn btn-app bg-danger" type="button" data-toggle="modal" data-target="#modal-lg">
                                    <i class="fas fa-money-bill"></i> Selesai Lebur
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
                    <?php if (isset($datamasterlebur)) : ?>
                        <?php if ($datamasterlebur['status_dokumen'] != 'Selesai') : ?>
                            <div class="col-6">
                                <label>Pilih Barang Lebur</label>
                                <div class="card">
                                    <!-- /.card-header -->
                                    <button type="button" class="btn btn-block btn-outline-info btn-sm" onclick="ModalPrintLebur(1,<?= $datamasterlebur['id_date_lebur'] ?>)"> <i class="fas fa-print"></i></button>
                                    <div class="card-body table-responsive p-0" style="max-height: 500px;">
                                        <table class="table table-head-fixed text-nowrap">
                                            <thead>
                                                <tr>
                                                    <!-- <th>Gambar</th> -->
                                                    <th>Kode</th>
                                                    <th>Jenis</th>
                                                    <th>Status</th>
                                                    <th>Kadar</th>
                                                    <th>Berat</th>
                                                    <th>Pilih</th>
                                                </tr>
                                            </thead>
                                            <tbody id="refreshtbl1">
                                                <?php foreach ($datalebur as $row) : ?>
                                                    <tr id="datalebur">
                                                        <!-- <td class="imgg"><img class="imgg" src="/img/<?= $row['nama_img'] ?>"></td> -->
                                                        <td><a href="#" onclick="openmodaldetail(<?= $row['id_detail_buyback'] ?>)"><?= $row['kode'] ?></a></td>
                                                        <td><?= $row['jenis'] ?></td>
                                                        <td> <select name="status_proses" onchange="EditData(<?= $row['id_detail_buyback'] ?>,this)" class="form-control" id="status" name="status">
                                                                <option value="Cuci">Cuci</option>
                                                                <option value="Retur">Retur</option>
                                                                <option selected value="Lebur">Lebur</option>
                                                            </select></td>
                                                        <td><?= $row['kadar'] ?></td>
                                                        <td><?= $row['berat'] ?></td>
                                                        <td>
                                                            <a type="button" onclick="tambahbaranglebur(<?= $row['id_detail_buyback'] ?>)" class="btn btn-block btn-outline-info btn-sm">Lebur</a>
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
                                <label>Barang Lebur</label>
                                <button type="button" class="btn btn-block btn-outline-info btn-sm" onclick="ModalPrintLebur(2,<?= $datamasterlebur['id_date_lebur'] ?>)"> <i class="fas fa-print"></i></button>
                                <div class="card">
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
                                                <?php foreach ($dataakanlebur as $row) : ?>
                                                    <tr id="akanlebur">
                                                        <!-- <td class="imgg"><img class="imgg" src="/img/<?= $row['nama_img'] ?>"></td> -->
                                                        <td><?= $row['kode'] ?></td>
                                                        <td><?= $row['jenis'] ?> <?= $row['model'] ?></td>
                                                        <td><?= $row['berat'] ?></td>
                                                        <td>
                                                            <button type='button' class='btn btn-block bg-gradient-danger' onclick="hapus(<?= $row['id_detail_lebur'] ?>)"><i class='fas fa-trash'></i></button>
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
                                <label>Barang Lebur</label>
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
                                                </tr>
                                            </thead>
                                            <tbody id="refreshtbl">
                                                <?php foreach ($dataakanlebur as $row) : ?>
                                                    <tr id="akanlebur">
                                                        <td class="imgg"><img class="imgg" src="/img/<?= $row['nama_img'] ?>"></td>
                                                        <td><?= $row['kode'] ?></td>
                                                        <td><?= $row['jenis'] ?></td>
                                                        <td><?= $row['model'] ?></td>
                                                        <td><?= $row['berat_murni'] ?></td>
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
                <h4 class="modal-title">Tambah Data Lebur</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/selesailebur" name="selesailebur" id="selesailebur" class="selesailebur" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="dateidlebur" id="dateidlebur" value="<?= $datamasterlebur['id_date_lebur'] ?>">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Tanggal Lebur</label>
                                <input type="date" id="tanggallebur" name="tanggallebur" class="form-control" placeholder="Masukan tanggallebur" value="<?= date_format(date_create($datamasterlebur['tanggal_lebur']), "Y-m-d") ?>">

                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <a href="#" id="tampilmodal" data-toggle="modal" data-target="#modal-barcode"><label>Barcode</label></a>
                                <input type="text" onkeyup="PilihBarcode($('#barcode').val())" id="barcode" name="barcode" class="form-control" placeholder="Masukan barcode">
                            </div>
                        </div>
                        <div class="col-sm-3">
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
                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Berat</label>
                                <input type="number" step="0.01" id="berat" name="berat" class="form-control" placeholder="Masukan Berat Bersih" value="<?= $datamasterlebur['berat_murni'] ?>">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback beratmsg">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
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
                        <div class="col-1">
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
                    <div class="modal fade" id="modal-foto">
                        <div class="modal-dialog modal-default">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Ambil Foto</h4>
                                    <button type="button" class="close" onclick="$('#modal-foto').modal('toggle');" aria-label="Close">
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
                                        <button type="button" class="btn btn-default" onclick="$('#modal-foto').modal('toggle');">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="Webcam.reset()" data-dismiss="modal">Done</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
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
<div class="modal fade" id="modal-barcode">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pilih Barcode</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Barcode</th>
                                <th style="text-align: center;">Keterangan</th>
                                <th style="text-align: center;">Kadar</th>
                                <th style="text-align: center;">Berat</th>
                                <th style="text-align: center;">No Faktur</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($databarcode as $row) : ?>
                                <tr onclick="PilihBarcode(<?= $row['barcode'] ?>)">
                                    <td><?= $row['barcode'] ?></td>
                                    <td><?= $row['jenis'] ?> <?= $row['model'] ?> <?= $row['keterangan'] ?></td>
                                    <td><?= $row['kadar'] ?></td>
                                    <td><?= $row['berat'] ?></td>
                                    <td><?= $row['no_faktur'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="text-align: center;">Barcode</th>
                                <th style="text-align: center;">Keterangan</th>
                                <th style="text-align: center;">Kadar</th>
                                <th style="text-align: center;">Berat</th>
                                <th style="text-align: center;">No Faktur</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
            </div>
        </div>
    </div>
</div>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<!-- Main Footer -->
<footer class="main-footer">

</footer>


<div id="modallebur">

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
                $('#kelompok').val(($('#barcode').val()) ? $('#barcode').val().substr(0, 1) : $('#kelompok').val())
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);

            }
        })
        $('#modal-barcode').modal('hide');
    }

    function ModalPrintLebur(id, dateid) {
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {
                id: id,
                dateid: dateid
            },
            url: "<?php echo base_url('modalprintlebur') ?>",
            success: function(result) {
                $('#modallebur').html(result.tampilmodal)
                $('#modal-lebur').modal('toggle')
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
        console.log(id)
        $.ajax({
            type: "get",
            dataType: "json",
            url: "<?php echo base_url('hapuslebur'); ?>",
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
        console.log(id)
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
                console.log(hasil)
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
            title: 'Batal Lebur ',
            text: "Apakah Ingin Batal Lebur ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo base_url('batallebur/' . $datamasterlebur['id_date_lebur']); ?>"
            }
        })

    };

    function tambahbaranglebur(kode) {
        console.log(kode)
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('tambahlebur'); ?>",
            data: {
                kode: kode,
                iddate: <?= $datamasterlebur['id_date_lebur'] ?>
            },
            success: function(result) {
                refreshtbl()
                console.log(result)
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
        $("#refreshtbl").load("/draftlebur/" + <?= $datamasterlebur['id_date_lebur'] ?> + " #akanlebur");
        $("#refreshtbl1").load("/draftlebur/" + <?= $datamasterlebur['id_date_lebur'] ?> + " #datalebur");
        $("#refreshtitle").load("/draftlebur/" + <?= $datamasterlebur['id_date_lebur'] ?> + " #titletr");
    }

    $(document).ready(function() {
        // ModalPrintLebur()
        $('.selesailebur').submit(function(e) {
            e.preventDefault()
            Swal.fire({
                title: 'Selesai Lebur ',
                text: "Apakah Yakin Selesai Lebur ?",
                icon: 'info',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Selesai',
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = $('.selesailebur')[0];
                    let data = new FormData(form)
                    $.ajax({
                        type: "POST",
                        data: data,
                        url: "<?php echo base_url('selesailebur'); ?>",
                        dataType: "json",
                        contentType: false,
                        processData: false,
                        cache: false,
                        success: function(hasil) {
                            if (hasil.error) {
                                if (hasil.error.nilai_tukar) {
                                    $('#nilai_tukar').addClass('is-invalid')
                                    $('.nilai_tukarmsg').html(hasil.error.nilai_tukar)
                                } else {
                                    $('#nilai_tukar').removeClass('is-invalid')
                                    $('.nilai_tukarmsg').html('')
                                }
                                if (hasil.error.jenis) {
                                    $('#jenis').addClass('is-invalid')
                                    $('.jenismsg').html(hasil.error.jenis)
                                } else {
                                    $('#jenis').removeClass('is-invalid')
                                    $('.jenismsg').html('')
                                }
                                if (hasil.error.berat) {
                                    $('#berat').addClass('is-invalid')
                                    $('.beratmsg').html(hasil.error.berat)
                                } else {
                                    $('#berat').removeClass('is-invalid')
                                    $('.beratmsg').html('')
                                }
                                if (hasil.error.harga_beli) {
                                    $('#harga_beli').addClass('is-invalid')
                                    $('.harga_belimsg').html(hasil.error.harga_beli)
                                } else {
                                    $('#harga_beli').removeClass('is-invalid')
                                    $('.harga_belimsg').html('')
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
                                console.log(hasil)
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
                                window.location.href = "<?php echo base_url('draftlebur/' . $datamasterlebur['id_date_lebur']); ?>"
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        }
                    })
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