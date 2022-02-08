<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<script type="text/javascript" src="/js/jquery.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    <h1 class="m-0">Form Penjualan Barang</h1>
                </div><!-- /.col -->
                <!-- /.content-header -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/barangkeluar">Home</a></li>
                        <li class="breadcrumb-item"><a href="/barangkeluar">Penjualan Barang</a></li>
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
                    <!-- /.card-header -->
                    <table class="table table-striped">
                        <form action="/kodebarcode" name="formkodebarcode" id="formkodebarcode" class="formkodebarcode" method="post">
                            <tbody>
                                <tr>
                                    <td>
                                        Nama Customer : <?= $datapenjualan['nama_customer'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Cara Pembayaran : <?= $datapenjualan['pembayaran'] ?>
                                    </td>
                                </tr>
                            </tbody>
                        </form>
                    </table>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-6">
                <!-- Application buttons -->
                <div class="card">
                    <div class="card-body">

                        <a class="btn btn-app" target="_blank" href="/printinvoice/<?= $datapenjualan['id_date_penjualan'] ?>" target="_blank">
                            <i class="fas fa-print"></i> Print Invoce
                        </a>
                        <a class="btn btn-app bg-primary" type="button">
                            <i class="fas fa-check"></i> Lunas
                        </a>

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
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Gambar</th>
                                            <th>Kode</th>
                                            <th>Qty</th>
                                            <th>Harga Jual</th>
                                            <th>Jenis</th>
                                            <th>Model</th>
                                            <th>Keterangan</th>
                                            <th>Berat Kotor</th>
                                            <th>Berat Bersih</th>
                                            <th>Kadar</th>
                                            <th>Nilai Tukar</th>
                                            <th>Merek</th>
                                        </tr>
                                    </thead>
                                    <?php foreach ($tampildata as $row) : ?>
                                        <tr>
                                            <td><img src='/img/<?= $row['nama_img'] ?>' class='imgg'></td>
                                            <td><?= $row['kode'] ?></td>
                                            <td><?= $row['qty'] ?></td>
                                            <td><?= $row['total_harga'] ?></td>
                                            <td><?= $row['jenis'] ?></td>
                                            <td><?= $row['model'] ?></td>
                                            <td><?= $row['keterangan'] ?></td>
                                            <td><?= $row['berat_kotor'] ?></td>
                                            <td><?= $row['berat_bersih'] ?></td>
                                            <td><?= $row['kadar'] ?></td>
                                            <td><?= $row['nilai_tukar'] ?></td>
                                            <td><?= $row['merek'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tbody id="datajual">
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
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Total Berat Bersih</td>
                                            <td id="totalberatbersihhtml01"></td>
                                        </tr>
                                        <tr>
                                            <td>Total Berat Kotor</td>
                                            <td id="totalberatkotorhtml01"></td>
                                        </tr>
                                        <tr>
                                            <td>Total Harga Bersih</td>
                                            <td id="totalbersih01"></td>
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
                            <div class="card-body p-0">

                                <table class="table table-striped">
                                    <tbody>
                                        <?php if (isset($datapenjualan)) : ?>
                                            <tr>
                                                <td>Metode Pembayaran</td>
                                                <td><?= $datapenjualan['pembayaran'] ?></td>
                                            </tr>
                                            <?php if ($datapenjualan['nama_bank']) : ?>
                                                <tr>
                                                    <td>Nama Bank</td>
                                                    <td><?= $datapenjualan['nama_bank'] ?></td>
                                                </tr>
                                            <?php endif ?>
                                            <?php if ($datapenjualan['pembulatan']) : ?>
                                                <tr>
                                                    <td>Pembulatan</td>
                                                    <td><?= number_format($datapenjualan['pembulatan'], 2, ",", ".") ?></td>
                                                </tr>
                                            <?php endif ?>
                                            <?php if ($datapenjualan['charge']) : ?>
                                                <tr>
                                                    <td>Charge</td>
                                                    <td><?= $datapenjualan['charge'] ?> %</td>
                                                </tr>
                                            <?php endif ?>
                                            <?php if ($datapenjualan['tunai']) : ?>
                                                <tr>
                                                    <td>Tunai</td>
                                                    <td><?= number_format($datapenjualan['tunai'], 2, ',', '.') ?></td>
                                                </tr>
                                            <?php endif ?>
                                            <?php if ($datapenjualan['debitcc']) : ?>
                                                <tr>
                                                    <td>Debit / CC</td>
                                                    <td><?= number_format($datapenjualan['debitcc'], 2, ',', '.') ?></td>
                                                </tr>
                                            <?php endif ?>
                                            <?php if ($datapenjualan['transfer']) : ?>
                                                <tr>
                                                    <td>Transfer</td>
                                                    <td><?= number_format($datapenjualan['transfer'], 2, ',', '.') ?></td>
                                                </tr>
                                            <?php endif ?>
                                        <?php endif ?>

                                    </tbody>
                                </table>
                                <!-- /.card-body -->
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
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/insertcustomer" name="insertcust" id="insertcust" class="insertcust" method="post">
                <div class="row" style="margin: 10px;">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Nama Customer</label>
                            <input type="text" id="nama_cust" name="nama_cust" class="form-control" placeholder="Masukan Nomor Nota Supplier">
                        </div>
                        <div class="form-group">
                            <label>Nomor Hp</label>
                            <input type="number" id="nohp" name="nohp" class="form-control" placeholder="Masukan Nomor Nota Supplier">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Masukan Nomor Nota Supplier">
                        </div>
                        <div class="form-group">
                            <label>Kota</label>
                            <input type="text" id="kota" name="kota" class="form-control" placeholder="Masukan Nomor Nota Supplier">
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
<!-- /.modal-dialog -->
</div>
<!-- Control Sidebar -->
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
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="col-sm-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Pembulatan</label>
                                    <input onkeyup="myPembulatan()" type="number" value="<?= (isset($datapenjualan['pembulatan'])) ? $datapenjualan['pembulatan'] : ''; ?>" min="0" id="pembulatan" name="pembulatan" class="form-control" placeholder="Masukan Pembulatan">
                                    <input type="hidden" name="dateid" value="<?= (isset($datapenjualan['id_date_penjualan'])) ? $datapenjualan['id_date_penjualan'] : ''; ?>">
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
                                                    <select onchange="myPembayaran()" name="pembayaran" class="form-control" id="pembayaran" name="pembayaran">
                                                        <option value="Bayar Nanti" selected>Bayar Nanti</option>
                                                        <option value="Debit/CC">Debit/CC</option>
                                                        <option value="Debit/CCTranfer">Debit/CC & Tranfer</option>
                                                        <option value="Transfer">Transfer</option>
                                                        <option value="Tunai">Tunai</option>
                                                        <option value="Tunai&Debit/CC">Tunai & Debit/CC</option>
                                                        <option value="Tunai&Transfer">Tunai & Transfer</option>
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
                        <div class="col-sm-6">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <table class="table table-hover text-nowrap">
                                        <tbody>
                                            <tr>
                                                <td>Total Berat Kotor</td>
                                                <td id="totalberatkotorhtml"></td>
                                            </tr>
                                            <tr>
                                                <td>Total Berat Bersih</td>
                                                <td id="totalberatbersihhtml"></td>
                                            </tr>
                                            <tr id="tabelbank">
                                            </tr>
                                            <tr id="tabelbayar1">
                                            </tr>
                                            <tr id="tabelbayar2">
                                            </tr>
                                            <tr id="tabelbayar3">
                                            </tr>
                                            <tr>
                                                <td>Pembulatan</td>
                                                <td id="pembulatanhtml"></td>
                                            </tr>
                                            <tr>
                                                <td>Total Bersih</td>
                                                <td id="totalbersih"></td>
                                            </tr>
                                            <tr>
                                                <td>Harus Bayar</td>
                                                <td id="totalbersih1"></td>
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
                <button type="submit" class="btn btn-primary btnbayar">Bayar</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<!-- Main Footer -->
<footer class="main-footer">

</footer>
<script type="text/javascript">
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
            url: "<?php echo base_url('tampilpenjualan'); ?>",
            success: function(result) {
                $('#totalbersih01').html(result.totalbersih.total_harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
                $('#totalberatbersihhtml01').html(pembulatankoma(result.totalberatbersih.berat_bersih))
                $('#totalberatkotorhtml01').html(pembulatankoma(result.totalberatkotor.berat_kotor))

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }




    $(document).ready(function() {
        tampildata()
    })
</script>
<?= $this->endSection(); ?>