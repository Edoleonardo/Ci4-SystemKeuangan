<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
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
                                    <td>Supplier</td>
                                    <td><?= $datapembelian['nama_supp'] ?></td>
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
                <div id="cardbayar">
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
                            <?php if ($datapembelian['byr_berat_murni'] > 0) : ?>
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
                                            <th>Ongkos</th>
                                            <th>Kadar</th>
                                            <th>Nilai Tukar</th>
                                            <th>Merek</th>
                                            <th>Total Harga</th>
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
                                                <td><?= number_format($row['harga_beli'], 2, ",", ".") ?></td>
                                                <td><?= number_format($row['ongkos'], 2, ",", ".") ?></td>
                                                <td><?= $row['kadar'] ?></td>
                                                <td><?= $row['nilai_tukar'] ?></td>
                                                <td><?= $row['merek'] ?></td>
                                                <td><?= number_format($row['total_harga'], 2, ",", ".") ?></td>
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
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <!-- /.card-header -->

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
                                            <th>ongkos</th>
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
                                                <td><?= number_format($row['harga_beli'], 2, ",", ".") ?></td>
                                                <td><?= number_format($row['ongkos'], 2, ",", ".") ?></td>
                                                <td><?= $row['kadar'] ?></td>
                                                <td><?= $row['nilai_tukar'] ?></td>
                                                <td><?= $row['merek'] ?></td>
                                                <td><?= number_format($row['total_harga'], 2, ",", ".") ?></td>
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
                            <?= csrf_field(); ?>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Harga Murni Saat Ini </label>
                                            <input type="number" min="0" value="<?= $datapembelian['harga_murni'] ?>" id="harga_murni" name="harga_murni" onkeyup="Harganow()" class="form-control harga_murni" placeholder="Masukan harga murni">
                                            <div id="validationServerUsernameFeedback" class="invalid-feedback harga_murnimsg">
                                            </div>
                                            <input type="hidden" id="dateid" name="dateid" value="<?= $datapembelian['id_date_pembelian'] ?>">

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
                                                            <select onclick="myPembayaran()" onchange="myPembayaran()" name="pembayaran" class="form-control" id="pembayaran" name="pembayaran">
                                                                <option value="Tunai">Tunai</option>
                                                                <option value="Transfer">Transfer</option>
                                                                <option value="Bahan24K">Bahan 24K</option>
                                                                <option value="ReturSales">Retur Sales</option>
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
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group returhtml">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                            <button type="submit" class="btn btn-primary btnadd">Add</button>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="card">
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive p-0" id="refresbayartbl">
                                            <table class="table table-hover text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>Cara Pembayaran</th>
                                                        <th>Jumlah Bayar</th>
                                                        <th style="text-align: center;">Kode</th>
                                                        <th>Berat Murni</th>
                                                        <th>Hapus</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($databayar as $byr) : ?>
                                                        <tr>
                                                            <td> <?= $byr['cara_pembayaran'] ?> </td>
                                                            <td><?= number_format($byr['jumlah_pembayaran'], 2, ',', '.') ?></td>
                                                            <td><?= ($byr['kode_retur']) ? $byr['kode_retur'] : $byr['kode_24k'] ?></td>
                                                            <td><?= $byr['berat_murni'] ?></td>
                                                            <td><button type='button' class='btn btn-block bg-gradient-danger' onclick="hapus(<?= $byr['id_pembayaran'] ?>)"><i class='fas fa-trash'></i></button></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    <tr>
                                                        <td style="background-color: lightblue;">Harga Saat ini</td>
                                                        <td style="background-color: lightblue;" id="harga_murnihtml"></td>
                                                        <td style="background-color: lightblue;">Bayar Berat Murni</td>
                                                        <td style="background-color: lightblue;" id="totalberatmurnihtml1"></td>
                                                        <td style="background-color: lightblue;"></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="background-color: lightblue;">Berat Murni</td>
                                                        <td style="background-color: lightblue;" id="totalberatmurnihtml"></td>
                                                        <td style="background-color: lightblue;">Harga Bayar</td>
                                                        <td style="background-color: lightblue;" id="totalbersih1"></td>
                                                        <td style="background-color: lightblue;"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="card-body p-0">
                                                <table class="table table-hover text-nowrap">
                                                    <tbody>
                                                        <tr id="tabelbank">
                                                        </tr>
                                                        <tr id="tabelbayar1">
                                                        </tr>
                                                        <tr id="tabelbayar2">
                                                        </tr>
                                                        <tr id="tabelbayar3">
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
                                <button type="button" class="btn btn-primary" onclick="SelesaiBayar()">Selesai</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal fade" id="modal-bahan24k">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Pilih Barang Bahan 24K</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-header">
                                    <h3 class="card-title" id="titletable"></h3>

                                </div>
                                <div class="card-body table-responsive p-0">
                                    <table id="bahan24k" class="table table-bordered table-striped">
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
                                                <th>ongkos</th>
                                                <th>Kadar</th>
                                                <th>Nilai Tukar</th>
                                                <th>Merek</th>
                                                <th>Total Harga</th>
                                                <th>Tambah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($tampil24k as $row) : ?>
                                                <tr>
                                                    <td><img src='/img/<?= $row['gambar'] ?>' class='imgg'></td>
                                                    <td><?= $row['barcode'] ?></td>
                                                    <td><?= $row['qty'] ?></td>
                                                    <td><?= $row['jenis'] ?></td>
                                                    <td><?= $row['model'] ?></td>
                                                    <td><?= $row['keterangan'] ?></td>
                                                    <td><?= $row['berat'] ?></td>
                                                    <td><?= $row['berat_murni'] ?></td>
                                                    <td><?= number_format($row['harga_beli'], 2, ",", ".") ?></td>
                                                    <td><?= number_format($row['ongkos'], 2, ",", ".") ?></td>
                                                    <td><?= $row['kadar'] ?></td>
                                                    <td><?= $row['nilai_tukar'] ?></td>
                                                    <td><?= $row['merek'] ?></td>
                                                    <td><?= number_format($row['total_harga'], 2, ",", ".") ?></td>
                                                    <td>
                                                        <button type="button" onclick="DataBahan24k(<?= $row['barcode'] ?>)" class="btn btn-primary">Pilih </button>
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
                            <button type="button" class="btn btn-default" onclick=" $('#modal-bahan24k').modal('toggle');">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <div class="modal fade" id="modal-retur">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Pilih Barang Retur Sales</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-header">
                                    <h3 class="card-title" id="titletable"></h3>

                                </div>
                                <div class="card-body table-responsive p-0">
                                    <table id="retursales" class="table table-bordered table-striped">
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
                                                <th>ongkos</th>
                                                <th>Kadar</th>
                                                <th>Nilai Tukar</th>
                                                <th>Merek</th>
                                                <th>Total Harga</th>
                                                <th>Tambah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($tampilretur as $row) : ?>
                                                <tr>
                                                    <td><img src='/img/<?= $row['nama_img'] ?>' class='imgg'></td>
                                                    <td><?= $row['kode'] ?></td>
                                                    <td><?= $row['qty'] ?></td>
                                                    <td><?= $row['jenis'] ?></td>
                                                    <td><?= $row['model'] ?></td>
                                                    <td><?= $row['keterangan'] ?></td>
                                                    <td><?= $row['berat'] ?></td>
                                                    <td><?= $row['berat_murni'] ?></td>
                                                    <td><?= number_format($row['harga_beli'], 2, ",", ".") ?></td>
                                                    <td><?= number_format($row['ongkos'], 2, ",", ".") ?></td>
                                                    <td><?= $row['kadar'] ?></td>
                                                    <td><?= $row['nilai_tukar'] ?></td>
                                                    <td><?= $row['merek'] ?></td>
                                                    <td><?= number_format($row['total_harga'], 2, ",", ".") ?></td>
                                                    <td>
                                                        <button type="button" onclick="DataReturSales(<?= $row['kode'] ?>)" class="btn btn-primary">Pilih </button>
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
                            <button type="button" class="btn btn-default" onclick=" $('#modal-retur').modal('toggle');">Close</button>
                        </div>
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
    function hapus(id) {
        Swal.fire({
            title: 'Hapus',
            text: "Yakin ingin Hapus Pembayaran ini ?",
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
                    url: "<?php echo base_url('deletepembayaran'); ?>",
                    data: {
                        id: id,
                        dateid: document.getElementById('dateid').value
                    },
                    success: function(result) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Data Berhasil Dihapus',
                        })
                        $("#refresbayartbl").load("/detailpembelian/" + document.getElementById('dateid').value + " #refresbayartbl");

                        myDataBayar()
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                })

            }
        })

    }

    function SelesaiBayar() {
        console.log('selesai')
        $('#modal-bayar').modal('toggle');
        $("#cardbayar").load("/detailpembelian/" + document.getElementById('dateid').value + " #cardbayar");

    }

    function DataBahan24k(id) {
        console.log(id)
        $('#kode_bahan24k').val(id)
        $('#modal-bahan24k').modal('toggle');
    }

    function DataReturSales(id) {
        $('#kode_retur').val(id)
        $('#modal-retur').modal('toggle');
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
                $('#totalberatmurnihtml').html(pembulatankoma(result.totalberatmurni.total_berat_murni))

                document.getElementById('totalberatmurnihtml1').innerHTML = pembulatankoma(result.totalberatmurni.byr_berat_murni)
                // document.getElementById('totalbersih').innerHTML = pembulatankoma(result.totalbersih.total_harga).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                document.getElementById('harga_murnihtml').innerHTML = ''
                // document.getElementById('harga_murni').value = ''
                Harganow()

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

    function tampilbarangbayar() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('ajaxdetailpembelian'); ?>",
            data: {
                dateid: '<?php echo $datapembelian['id_date_pembelian'] ?>'
            },
            success: function(result) {
                $('#totalberatmurnihtml').html(pembulatankoma(result.totalberatmurni.total_berat_murni))

                document.getElementById('totalberatmurnihtml1').innerHTML = pembulatankoma(result.totalberatmurni.byr_berat_murni)
                // document.getElementById('totalbersih').innerHTML = pembulatankoma(result.totalbersih.total_harga).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                document.getElementById('harga_murnihtml').innerHTML = ''
                // document.getElementById('harga_murni').value = ''
                Harganow()

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
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
                        if (result.error.harga_murni) {
                            $('#harga_murni').addClass('is-invalid')
                            $('.harga_murnimsg').html(result.error.harga_murni)
                        } else {
                            $('#harga_murni').removeClass('is-invalid')
                            $('.harga_murni').html('')
                        }
                        if (result.error.kode_bahan24k) {
                            $('#kode_bahan24k').addClass('is-invalid')
                            $('.kode_bahan24kmsg').html(result.error.kode_bahan24k)
                        } else {
                            $('#kode_bahan24k').removeClass('is-invalid')
                            $('.kode_bahan24k').html('')
                        }
                        if (result.error.kode_retur) {
                            $('#kode_retur').addClass('is-invalid')
                            $('.kode_returmsg').html(result.error.kode_retur)
                        } else {
                            $('#kode_retur').removeClass('is-invalid')
                            $('.kode_retur').html('')
                        }
                    } else {
                        $('#namabank').removeClass('is-invalid')
                        $('.namabank').html('')
                        $('#transfer').removeClass('is-invalid')
                        $('.transfer').html('')
                        $('#tunai').removeClass('is-invalid')
                        $('.tunai').html('')
                        $('#harga_murni').removeClass('is-invalid')
                        $('.harga_murni').html('')
                        $('#kode_bahan24k').removeClass('is-invalid')
                        $('.kode_bahan24k').html('')
                        $('#kode_retur').removeClass('is-invalid')
                        $('.kode_retur').html('')

                        $("#refresbayartbl").load("/detailpembelian/" + document.getElementById('dateid').value + " #refresbayartbl");

                        myDataBayar()

                        if (result.pesan_lebih.pesan) {
                            Swal.fire({
                                icon: 'info',
                                title: 'Lebih Bayar',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK',
                            })
                        }
                        // Swal.fire({
                        //     icon: 'success',
                        //     title: 'Berhasil Bayar',
                        //     confirmButtonColor: '#3085d6',
                        //     confirmButtonText: 'OK',
                        //     allowOutsideClick: false
                        // }).then((result) => {
                        //     if (result.isConfirmed) {
                        //         $('#modal-bayar').modal('toggle');
                        //         window.location.reload();

                        //     }
                        // })



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
        const title = document.getElementById('titletable')
        const bank = $('#tabelbank')
        const metod2 = document.getElementsByClassName('metodebayar2')
        metod1[0].innerHTML = ''
        nmbank[0].innerHTML = ''
        metod2[0].innerHTML = ''
        bank[0].innerHTML = ''

        var NamaBank = '<label>Nama Bank Debit/CC</label><select  type="text" id="namabank" name="namabank" class="form-control" placeholder="Masukan Nama Bank"><?php foreach ($bank as $m) : ?><option value="<?= $m['nama_bank'] ?>"><?= $m['nama_bank'] ?> </option><?php endforeach; ?></select><div id="validationServerUsernameFeedback" class="invalid-feedback namabankmsg"></div>'
        var retur = '<label>retur %</label><input type="number"  min="0" id="retur" name="retur" class="form-control" placeholder="Masukan retur"><div id="validationServerUsernameFeedback" class="invalid-feedback returmsg"></div>'
        var Transfer = '<label>Transfer</label><input type="number"  min="0" id="transfer" name="transfer" class="form-control" placeholder="Masukan transfer"><div id="validationServerUsernameFeedback" class="invalid-feedback transfermsg"></div>'
        var Tunai = '<label>Tunai</label><input type="number" min="0" id="tunai" name="tunai" class="form-control" placeholder="Masukan tunai"><div id="validationServerUsernameFeedback" class="invalid-feedback tunaimsg"></div>'
        var Bahan24k = '<label>Masukan Kode Bahan 24K</label><input type="number" min="0" id="kode_bahan24k" name="kode_bahan24k" class="form-control" placeholder="Masukan kode Bahan"><div id="validationServerUsernameFeedback" class="invalid-feedback kode_bahan24kmsg"></div>'
        var Retursales = '<label>Masukan Kode Barang Retur</label><input type="number"  min="0" id="kode_retur" name="kode_retur" class="form-control" placeholder="Masukan kode"><div id="validationServerUsernameFeedback" class="invalid-feedback kode_returmsg"></div>'
        var modalpilihr24k = '<label>Pilih Barang 24K</label><a class="form-control btn bg-green" type="button" data-toggle="modal" data-target="#modal-bahan24k"><i class="fas fa-plus"></i></a>'
        var modalpilihretur = '<label>Pilih Barang Retur</label><a class="form-control btn bg-green" type="button" data-toggle="modal" data-target="#modal-retur"><i class="fas fa-plus"></i></a>'
        if (carabyr == 'Bayar Nanti') {
            myDataBayar()
            metod1[0].innerHTML = ''
            nmbank[0].innerHTML = ''
            retur[0].innerHTML = ''
            metod2[0].innerHTML = ''
            bank[0].innerHTML = ''
        }
        if (carabyr == 'Transfer') {
            myDataBayar()
            metod1[0].innerHTML = Transfer
            nmbank[0].innerHTML = NamaBank

        }
        if (carabyr == 'Tunai') {
            myDataBayar()
            metod1[0].innerHTML = Tunai

        }
        if (carabyr == 'Bahan24K') {
            myDataBayar()
            metod1[0].innerHTML = Bahan24k
            metod2[0].innerHTML = modalpilihr24k

        }
        if (carabyr == 'ReturSales') {
            myDataBayar()
            metod1[0].innerHTML = Retursales
            metod2[0].innerHTML = modalpilihretur

        }
        console.log(carabyr)
    }


    function Harganow() {
        if (document.getElementById('harga_murni')) {
            harga_murni = (isNaN(parseFloat(document.getElementById('harga_murni').value))) ? 0 : parseFloat(document.getElementById('harga_murni').value)
        } else {
            harga_murni = 0
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

        const beratmurni = document.getElementById('totalberatmurnihtml1').innerHTML
        beratmurnival = parseFloat(beratmurni)
        var hasil = (beratmurnival * harga_murni)
        document.getElementById('totalbersih1').innerHTML = hasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        document.getElementById('harga_murnihtml').innerHTML = harga_murni.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")

    }

    // function brycas() {
    //     var val = document.getElementById('retur').value
    //     const totalbersih = document.getElementById('totalbersihconst').innerHTML
    //     totalbersihval = parseFloat(totalbersih.replaceAll('.', ''))
    //     hasil = totalbersihval + (val * (totalbersihval / 100))
    //     document.getElementById('totalbersih').innerHTML = hasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    //     document.getElementById('totalbersih1').innerHTML = hasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    //     document.getElementById('returbyr').innerHTML = val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + '%'
    //     Harganow()
    //     byrtransfer()
    //     byrtunai()
    // }

    // function byrtransfer() {
    //     if (document.getElementById('harga_murni')) {
    //         bulat = (isNaN(parseFloat(document.getElementById('harga_murni').value))) ? 0 : parseFloat(document.getElementById('harga_murni').value)
    //     } else {
    //         bulat = 0
    //     }
    //     if (document.getElementById('transfer')) {
    //         transfer = (isNaN(parseFloat(document.getElementById('transfer').value))) ? 0 : parseFloat(document.getElementById('transfer').value)
    //     } else {
    //         transfer = 0
    //     }
    //     if (document.getElementById('tunai')) {
    //         tunai = (isNaN(parseFloat(document.getElementById('tunai').value))) ? 0 : parseFloat(document.getElementById('tunai').value)
    //     } else {
    //         tunai = 0
    //     }
    //     const totalbersih = document.getElementById('totalbersih').innerHTML
    //     totalbersihval = parseFloat(totalbersih.replaceAll('.', ''))
    //     hasil = totalbersihval - (bulat + tunai + transfer)
    //     document.getElementById('transferbyr').innerHTML = transfer.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    //     document.getElementById('totalbersih1').innerHTML = hasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    // }

    // function byrtunai() {
    //     if (document.getElementById('harga_murni')) {
    //         bulat = (isNaN(parseFloat(document.getElementById('harga_murni').value))) ? 0 : parseFloat(document.getElementById('harga_murni').value)
    //     } else {
    //         bulat = 0
    //     }
    //     if (document.getElementById('transfer')) {
    //         transfer = (isNaN(parseFloat(document.getElementById('transfer').value))) ? 0 : parseFloat(document.getElementById('transfer').value)
    //     } else {
    //         transfer = 0
    //     }
    //     if (document.getElementById('tunai')) {
    //         tunai = (isNaN(parseFloat(document.getElementById('tunai').value))) ? 0 : parseFloat(document.getElementById('tunai').value)
    //     } else {
    //         tunai = 0
    //     }
    //     const totalbersih = document.getElementById('totalbersih').innerHTML
    //     totalbersihval = parseFloat(totalbersih.replaceAll('.', ''))
    //     hasil = totalbersihval - (bulat + tunai + transfer)
    //     document.getElementById('tunaibyr').innerHTML = tunai.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    //     document.getElementById('totalbersih1').innerHTML = hasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")

    // }


    $(document).ready(function() {
        myDataBayar()
        $("#bahan24k").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "aaSorting": []
            //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis", ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $("#retursales").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "aaSorting": []
            //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis", ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    })
</script>
<?= $this->endSection(); ?>