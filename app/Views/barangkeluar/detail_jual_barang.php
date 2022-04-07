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
                        <tbody>
                            <tr>
                                <td>
                                    Nomor Jual : <?= $datapenjualan['no_transaksi_jual'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Nama Customer : <?= $datacust['nama'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    No Hp : <?= $datacust['nohp_cust'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Cara Pembayaran : <?= $datapenjualan['pembayaran'] ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-6">
                <!-- Application buttons -->
                <div class="card" id="card1">
                    <div class="card-body" id="card2">
                        <?php if ($datapenjualan['status_dokumen'] == 'Retur') : ?>
                            <a class="btn btn-app bg-danger" type="button" data-toggle="modal" data-target="#modal-bayar">
                                <i class="fas fa-money-bill"></i> Bayar Retur
                            </a>
                        <?php else : ?>
                            <a class="btn btn-app" target="_blank" href="/printinvoice/<?= $datapenjualan['id_date_penjualan'] ?>" target="_blank">
                                <i class="fas fa-print"></i> Print Invoce
                            </a>
                            <a class="btn btn-app bg-primary" type="button">
                                <i class="fas fa-check"></i> Lunas
                            </a>
                        <?php endif; ?>
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
                            <div class="card-body table-responsive p-0" id="refrshtbl1">
                                <table class="table table-hover text-nowrap" id="refrshtbl2">
                                    <thead>
                                        <tr>
                                            <th>Gambar</th>
                                            <th>Kode</th>
                                            <th>Qty</th>
                                            <th>Harga Jual</th>
                                            <th>Ongkos</th>
                                            <th>Jenis</th>
                                            <th>Model</th>
                                            <th>Keterangan</th>
                                            <th>Berat</th>
                                            <th>Berat Murni</th>
                                            <th>Kadar</th>
                                            <th>Nilai Tukar</th>
                                            <th>Merek</th>
                                            <th>Total Harga</th>
                                            <th>Retur</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($tampildata as $row) : ?>
                                            <tr>
                                                <td><img src='/img/<?= $row['nama_img'] ?>' class='imgg'></td>
                                                <td><?= $row['kode'] ?></td>
                                                <td><?= $row['qty'] ?></td>
                                                <td><?= number_format($row['harga_beli'], 2, ',', '.') ?></td>
                                                <td><?= number_format($row['ongkos'], 2, ',', '.') ?></td>
                                                <td><?= $row['jenis'] ?></td>
                                                <td><?= $row['model'] ?></td>
                                                <td><?= $row['keterangan'] ?></td>
                                                <td><?= $row['berat'] ?></td>
                                                <td><?= $row['berat_murni'] ?></td>
                                                <td><?= $row['kadar'] ?></td>
                                                <td><?= $row['nilai_tukar'] ?></td>
                                                <td><?= $row['merek'] ?></td>
                                                <td><?= number_format($row['total_harga'], 2, ',', '.') ?></td>
                                                <td><button type='button' class='btn btn-block bg-gradient-danger' onclick="ReturCust(<?= $row['id_detail_penjualan'] ?>,<?= $row['id_date_penjualan'] ?>)">Retur</button></td>
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
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body p-0" id="total1">
                                <table class="table table-striped" id="total2">
                                    <tbody>
                                        <tr>
                                            <td>Total Berat</td>
                                            <td><?= number_format($totalberat, 0, ',', '.') ?></td>
                                        </tr>
                                        <?php if ($datapenjualan['status_dokumen'] == 'Retur') : ?>
                                            <tr>
                                                <td>Total Harga Lama</td>
                                                <td><?= number_format($datapenjualan['total_harga'], 0, ',', '.') ?></td>
                                            </tr>
                                            <tr>
                                                <td>Total Harga Baru</td>
                                                <td><?= number_format($hargabaru, 0, ',', '.') ?></td>
                                            </tr>
                                        <?php else : ?>
                                            <tr>
                                                <td>Total Harga</td>
                                                <td><?= number_format($datapenjualan['total_harga'], 0, ',', '.') ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body p-0" id="card11">
                                <table class="table table-striped" id="card22">
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

<!-- /.modal-dialog -->
</div>
<!-- Control Sidebar -->
<div class="modal fade" id="modal-retur">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tukar Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/kodebarcode" name="formkodebarcode" id="formkodebarcode" class="formkodebarcode" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="iddate" id="iddate" value="<?= $datapenjualan['id_date_penjualan'] ?>">
                <input type="hidden" name="iddetail" id="iddetail" value="">
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="form-group" style="margin: 1mm;">
                                <label>Masukan Kode Barang</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control kodebarang" id="kodebarang" onkeyup="ScanBarcode()" name="kodebarang" placeholder="Masukan Barcode">
                                    <span class="input-group-append">
                                        <button type="submit" id="btnsubmitform" class="btn btn-info btn-flat btnsubmitform">Ok</button>
                                    </span>
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback kodebarangmsg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
                                        <th>Ongkos</th>
                                        <th>Keterangan</th>
                                        <th>Berat</th>
                                        <th>Berat Murni</th>
                                        <th>Kadar</th>
                                        <th>Nilai Tukar</th>
                                        <th>Merek</th>
                                        <th>Total Harga</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
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
                            <input type="hidden" name="hiddenharga" id="hiddenharga">
                            <table class="table table-hover text-nowrap">
                                <tbody>
                                    <tr>
                                        <td>Harga Barang Lama</td>
                                        <td id="totalbersih01retur"></td>
                                    </tr>
                                    <tr>
                                        <td>Sisah Bayar</td>
                                        <td id="totalbersihretur"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <form action="/gantiretur" name="gantiretur" id="gantiretur" class="gantiretur" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="iddate1" id="iddate1" value="<?= $datapenjualan['id_date_penjualan'] ?>">
                <input type="hidden" name="iddetail1" id="iddetail1">
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btntambah">Retur</button>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
</div>

<div class="modal fade" id="modal-bayar">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bayar Retur</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/bayarretur" name="bayarretur" id="bayarretur" class="bayarretur" method="post">
                <?= csrf_field(); ?>
                <div id="rfs1">
                    <div id="rfs2">
                        <input type="hidden" name="hargalama" id="hargalama" value="<?= $datapenjualan['total_harga']; ?>">
                        <input type="hidden" name="hargabaru" id="hargabaru" value="<?= $hargabaru; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Pembulatan</label>
                                <input onkeyup="myPembulatan()" type="number" value="<?= (isset($datapenjualan['pembulatan'])) ? $datapenjualan['pembulatan'] : ''; ?>" min="0" id="pembulatan" name="pembulatan" class="form-control" placeholder="Masukan Pembulatan">
                                <input type="hidden" id="dateid" name="dateid" value="<?= (isset($datapenjualan['id_date_penjualan'])) ? $datapenjualan['id_date_penjualan'] : ''; ?>">
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
                                <input type="hidden" name="hiddenharga" id="hiddenharga">
                                <table class="table table-hover text-nowrap" id="tblbyr11">
                                    <tbody id="tblbyr22">
                                        <tr>
                                            <td>Harga Lama</td>
                                            <td id="totalbersih01"></td>
                                        </tr>
                                        <tr>
                                            <td>Harga Baru</td>
                                            <td id="totalbersih01"><?= number_format($hargabaru, 0, ',', '.'); ?></td>
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
                                            <td>Sisah Bayar</td>
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
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btntambah">Retur</button>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
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
    function ReturCust(id, iddate) {
        $('#modal-retur').modal('show')
        $('#iddetail').val(id)
        $('#iddetail1').val(id)
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {
                dateid: iddate,
                iddetail: id,
            },
            url: "<?php echo base_url('datadetailretur'); ?>",
            success: function(result) {
                $('#datajual').html(result.data)
                var totalharga = parseFloat(result.totalhargalama.total_harga)
                var sisabayar = parseFloat(result.totalhargabaru.total_harga) - parseFloat(result.totalhargalama.total_harga)
                document.getElementById('totalbersih01retur').innerHTML = pembulatankoma(totalharga).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                // $('#hiddenharga').val(sisabayar)
                document.getElementById('totalbersihretur').innerHTML = pembulatankoma(sisabayar).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })

    }

    function myDataBayar() {
        var totalharga = parseFloat($('#hargalama').val())
        var sisabayar = parseFloat($('#hargabaru').val()) - totalharga
        document.getElementById('totalbersih01').innerHTML = pembulatankoma(totalharga).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        $('#hiddenharga').val(sisabayar)
        document.getElementById('totalbersih1').innerHTML = pembulatankoma(sisabayar).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        document.getElementById('totalbersih').innerHTML = pembulatankoma(sisabayar).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        document.getElementById('pembulatanhtml').innerHTML = ''
        document.getElementById('pembulatan').value = ''
    }

    function ScanBarcode() {
        // checkcust()
        $('#btnsubmitform').trigger('click');
    }
    $('.formkodebarcode').submit(function(e) {
        // checkcust()
        e.preventDefault()
        let form = $('.formkodebarcode')[0];
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            data: data,
            url: "<?php echo base_url('returcust'); ?>",
            contentType: false,
            processData: false,
            cache: false,
            dataType: "json",
            success: function(result) {
                console.log(result)
                if (result.error) {
                    if (result.error.kodebarang) {
                        $('#kodebarang').addClass('is-invalid')
                        $('.kodebarangmsg').html(result.error.kodebarang)
                    } else {
                        $('#kodebarang').removeClass('is-invalid')
                        $('.kodebarangmsg').html('')
                    }
                } else {
                    if (result.pesan == 'gagal') {
                        document.getElementById('kodebarang').removeAttribute("onkeyup");

                    } else {
                        // $('#datajual').html(result.data)
                        $('#kodebarang').removeClass('is-invalid')
                        $('.kodebarangmsg').html('')
                        // tampildataretur()
                        document.getElementById('kodebarang').setAttribute("onkeyup", "ScanBarcode()");
                        document.getElementById('kodebarang').value = ''
                        ReturCust($('#iddetail').val(), $('#iddate').val())
                    }
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })

    })

    $('.gantiretur').submit(function(e) {
        // checkcust()
        e.preventDefault()
        console.log($('#iddetail').val())
        Swal.fire({
            title: 'Retur',
            text: "Yakin ingin Retur Data ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Retur',
        }).then((choose) => {
            if (choose.isConfirmed) {
                let form = $('.gantiretur')[0];
                let data = new FormData(form)
                $.ajax({
                    type: "POST",
                    data: data,
                    url: "<?php echo base_url('gantiretur'); ?>",
                    contentType: false,
                    processData: false,
                    cache: false,
                    dataType: "json",
                    success: function(result) {
                        console.log($('#iddetail').val())
                        console.log(result)
                        if (result == 'kurang') {
                            Swal.fire({
                                icon: 'info',
                                title: 'Stock Kurang',
                            })

                        }
                        if (result == 'sama') {
                            Swal.fire({
                                icon: 'info',
                                title: 'Data Sama',
                            })
                        }
                        if (result == 'rendah') {
                            Swal.fire({
                                icon: 'info',
                                title: 'Harga Lebih Rendah',
                            })

                        }
                        if (result == 'sukses') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Di Retur',
                            })
                            $('#modal-retur').modal('hide')
                            $("#refrshtbl1").load("/detailpenjualan/" + document.getElementById('iddate1').value + " #refrshtbl2");
                            $("#rfs1").load("/detailpenjualan/" + document.getElementById('iddate1').value + " #rfs2");
                            $("#card1").load("/detailpenjualan/" + document.getElementById('iddate1').value + " #card2");
                            $("#total1").load("/detailpenjualan/" + document.getElementById('iddate1').value + " #total2");
                            $("#tblbyr11").load("/detailpenjualan/" + document.getElementById('iddate1').value + " #tblbyr22");
                            document.getElementById('pembayaran').value = 'Bayar Nanti'
                            myPembayaran()
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                })

            }
        })

    })

    $('.bayarretur').submit(function(e) {
        e.preventDefault()
        let form = $('.bayarretur')[0];
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            data: data,
            url: "<?php echo base_url('bayarretur') ?>",
            dataType: "json",
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function() {
                $('.btnbayar').html('<i class="fa fa-spin fa-spinner">')
                $('.btnbayar').attr('type', 'button')
            },
            complete: function() {
                $('.btnbayar').html('Bayar')
                $('.btnbayar').attr('type', 'submit')
            },
            success: function(result) {
                console.log(result)
                if (result != 'error') {
                    if (result.error) {
                        if (result.error.debitcc) {
                            $('#debitcc').addClass('is-invalid')
                            $('.debitccmsg').html(result.error.debitcc)
                        } else {
                            $('#debitcc').removeClass('is-invalid')
                            $('.debitccmsg').html('')
                        }
                        if (result.error.namabank) {
                            $('#namabank').addClass('is-invalid')
                            $('.namabankmsg').html(result.error.namabank)
                        } else {
                            $('#namabank').removeClass('is-invalid')
                            $('.namabankmsg').html('')
                        }
                        if (result.error.transfer) {
                            $('#transfer').addClass('is-invalid')
                            $('.transfermsg').html(result.error.transfer)
                        } else {
                            $('#transfer').removeClass('is-invalid')
                            $('.transfermsg').html('')
                        }
                        if (result.error.tunai) {
                            $('#tunai').addClass('is-invalid')
                            $('.tunaimsg').html(result.error.tunai)
                        } else {
                            $('#tunai').removeClass('is-invalid')
                            $('.tunaimsg').html('')
                        }
                        if (result.error.inputcustomer) {
                            $('#inputcustomer').addClass('is-invalid')
                            $('.inputcustomermsg').html(result.error.inputcustomer)
                        } else {
                            $('#inputcustomer').removeClass('is-invalid')
                            $('.inputcustomermsg').html('')
                        }
                        if (result.error.kurang) {
                            Swal.fire({
                                icon: 'warning',
                                title: result.error.kurang,
                            })
                        }
                    } else {
                        $('#debitcc').removeClass('is-invalid')
                        $('.debitccmsg').html('')
                        $('#namabank').removeClass('is-invalid')
                        $('.namabankmsg').html('')
                        $('#transfer').removeClass('is-invalid')
                        $('.transfermsg').html('')
                        $('#tunai').removeClass('is-invalid')
                        $('.tunaimsg').html('')
                        $('#inputcustomer').removeClass('is-invalid')
                        $('.inputcustomermsg').html('')

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil Bayar',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK',
                            allowOutsideClick: false
                        }).then((choose) => {
                            if (choose.isConfirmed) {

                                $('#modal-bayar').modal('toggle');
                                refreshtbl()
                                // window.location.href = "/detailpenjualan/" + document.getElementById('dateid').value
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

    function refreshtbl() {
        $("#refrshtbl1").load("/detailpenjualan/" + document.getElementById('iddate1').value + " #refrshtbl2");
        $("#card1").load("/detailpenjualan/" + document.getElementById('iddate1').value + " #card2");
        $("#card11").load("/detailpenjualan/" + document.getElementById('iddate1').value + " #card22");
        $("#total1").load("/detailpenjualan/" + document.getElementById('iddate1').value + " #total2");
        // document.getElementById('pembayaran').value = 'Bayar Nanti'
    }

    function myPembayaran() {
        const carabyr = document.getElementById('pembayaran').value
        const metod1 = $('.metodebayar')
        const nmbank = $('.namabankhtml')
        const charge = $('.chargehtml')
        const table1 = $('#tabelbayar1')
        const table2 = $('#tabelbayar2')
        const table3 = $('#tabelbayar3')
        const bank = $('#tabelbank')
        const metod2 = document.getElementsByClassName('metodebayar2')
        metod1[0].innerHTML = ''
        nmbank[0].innerHTML = ''
        charge[0].innerHTML = ''
        metod2[0].innerHTML = ''
        table1[0].innerHTML = ''
        table2[0].innerHTML = ''
        table3[0].innerHTML = ''
        bank[0].innerHTML = ''

        var DebitCC = '<label>Debit/CC</label><input type="number" onkeyup = "byrdebitcc()" min="0" id="debitcc" name="debitcc" class="form-control" placeholder="Masukan debit/cc"><div id="validationServerUsernameFeedback" class="invalid-feedback debitccmsg"></div>'
        var NamaBank = '<label>Nama Bank Debit/CC</label><select onchange = "byrnamabank()" type="text" id="namabank" name="namabank" class="form-control" placeholder="Masukan Nama Bank"><?php foreach ($bank as $m) : ?><option value="<?= $m['nama_bank'] ?>"><?= $m['nama_bank'] ?> </option><?php endforeach; ?></select><div id="validationServerUsernameFeedback" class="invalid-feedback namabankmsg"></div>'
        var Charge = '<label>Charge %</label><input type="number" onkeyup = "brycas()" min="0" id="charge" name="charge" class="form-control" placeholder="Masukan Charge"><div id="validationServerUsernameFeedback" class="invalid-feedback chargemsg"></div>'
        var Transfer = '<label>Transfer</label><input type="number" onkeyup = "byrtransfer()" min="0" id="transfer" name="transfer" class="form-control" placeholder="Masukan transfer"><div id="validationServerUsernameFeedback" class="invalid-feedback transfermsg"></div>'
        var Tunai = '<label>Tunai</label><input type="number" onkeyup = "byrtunai()" min="0" id="tunai" name="tunai" class="form-control" placeholder="Masukan tunai"><div id="validationServerUsernameFeedback" class="invalid-feedback tunaimsg"></div>'

        if (carabyr == 'Bayar Nanti') {
            myDataBayar()
            metod1[0].innerHTML = ''
            nmbank[0].innerHTML = ''
            charge[0].innerHTML = ''
            metod2[0].innerHTML = ''
            table1[0].innerHTML = ''
            table2[0].innerHTML = ''
            table3[0].innerHTML = ''
            bank[0].innerHTML = ''
        }
        if (carabyr == 'Debit/CC') {
            myDataBayar()
            metod1[0].innerHTML = DebitCC
            nmbank[0].innerHTML = NamaBank
            charge[0].innerHTML = Charge
            bank[0].innerHTML = '<td>Nama Bank</td><td id="bankbyr"></td>'
            table1[0].innerHTML = '<td>Charge</td><td id="chargebyr"></td>'
            table2[0].innerHTML = '<td>Debit/CC</td><td id="debitccbyr"></td>'
            byrnamabank()
        }
        if (carabyr == 'Debit/CCTranfer') {
            myDataBayar()
            metod1[0].innerHTML = DebitCC
            nmbank[0].innerHTML = NamaBank
            charge[0].innerHTML = Charge
            metod2[0].innerHTML = Transfer
            bank[0].innerHTML = '<td>Nama Bank</td><td id="bankbyr"></td>'
            table1[0].innerHTML = '<td>Charge</td><td id="chargebyr"></td>'
            table2[0].innerHTML = '<td>Debit/CC</td><td id="debitccbyr"></td>'
            table3[0].innerHTML = '<td>Tranfer</td><td id="transferbyr"></td>'
            byrnamabank()
        }
        if (carabyr == 'Transfer') {
            myDataBayar()
            metod1[0].innerHTML = Transfer
            nmbank[0].innerHTML = NamaBank
            bank[0].innerHTML = '<td>Nama Bank</td><td id="bankbyr"></td>'
            table2[0].innerHTML = '<td>Tranfer</td><td id="transferbyr"></td>'
            byrnamabank()
        }
        if (carabyr == 'Tunai') {
            myDataBayar()
            metod1[0].innerHTML = Tunai
            table1[0].innerHTML = '<td>Tunai</td><td id="tunaibyr"></td>'

        }
        if (carabyr == 'Tunai&Debit/CC') {
            myDataBayar()
            metod1[0].innerHTML = DebitCC
            nmbank[0].innerHTML = NamaBank
            charge[0].innerHTML = Charge
            metod2[0].innerHTML = Tunai
            bank[0].innerHTML = '<td>Nama Bank</td><td id="bankbyr"></td>'
            table1[0].innerHTML = '<td>Charge</td><td id="chargebyr"></td>'
            table2[0].innerHTML = '<td>Debit/CC</td><td id="debitccbyr"></td>'
            table3[0].innerHTML = '<td>Tunai</td><td id="tunaibyr"></td>'
            byrnamabank()
        }

        if (carabyr == 'Tunai&Transfer') {
            myDataBayar()
            metod1[0].innerHTML = Transfer
            nmbank[0].innerHTML = NamaBank
            metod2[0].innerHTML = Tunai
            bank[0].innerHTML = '<td>Nama Bank</td><td id="bankbyr"></td>'
            table3[0].innerHTML = '<td>Tunai</td><td id="tunaibyr"></td>'
            table2[0].innerHTML = '<td>Tranfer</td><td id="transferbyr"></td>'
            byrnamabank()
        }
    }


    function byrnamabank() {
        var bank = document.getElementById('namabank').value
        document.getElementById('bankbyr').innerHTML = bank
    }

    function myPembulatan() {
        if (document.getElementById('pembulatan')) {
            bulat = (isNaN(parseFloat(document.getElementById('pembulatan').value))) ? 0 : parseFloat(document.getElementById('pembulatan').value)
        } else {
            bulat = 0
        }
        if (document.getElementById('debitcc')) {
            debitcc = (isNaN(parseFloat(document.getElementById('debitcc').value))) ? 0 : parseFloat(document.getElementById('debitcc').value)
        } else {
            debitcc = 0
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

        const totalbersih = document.getElementById('totalbersih').innerHTML
        totalbersihval = parseFloat(totalbersih.replaceAll('.', ''))
        var hasil = totalbersihval - (bulat + debitcc + transfer + tunai)
        document.getElementById('totalbersih1').innerHTML = hasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        document.getElementById('pembulatanhtml').innerHTML = bulat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }

    function brycas() {
        var val = document.getElementById('charge').value
        const totalbersih = document.getElementById('hiddenharga').value
        totalbersihval = parseFloat(totalbersih.replaceAll('.', ''))
        hasil = totalbersihval + (val * (totalbersihval / 100))
        document.getElementById('totalbersih').innerHTML = hasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        document.getElementById('totalbersih1').innerHTML = hasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        document.getElementById('chargebyr').innerHTML = val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + '%'
        byrdebitcc()
        byrtransfer()
        byrtunai()

    }

    function byrdebitcc() {
        if (document.getElementById('pembulatan')) {
            bulat = (isNaN(parseFloat(document.getElementById('pembulatan').value))) ? 0 : parseFloat(document.getElementById('pembulatan').value)
        } else {
            bulat = 0
        }
        if (document.getElementById('debitcc')) {
            debitcc = (isNaN(parseFloat(document.getElementById('debitcc').value))) ? 0 : parseFloat(document.getElementById('debitcc').value)
        } else {
            debitcc = 0
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
        const totalbersih = document.getElementById('totalbersih').innerHTML
        totalbersihval = parseFloat(totalbersih.replaceAll('.', ''))
        hasil = totalbersihval - (debitcc + bulat + tunai + transfer)
        document.getElementById('debitccbyr').innerHTML = Math.round(debitcc).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        document.getElementById('totalbersih1').innerHTML = Math.round(hasil).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")

    }

    function byrtransfer() {
        if (document.getElementById('pembulatan')) {
            bulat = (isNaN(parseFloat(document.getElementById('pembulatan').value))) ? 0 : parseFloat(document.getElementById('pembulatan').value)
        } else {
            bulat = 0
        }
        if (document.getElementById('debitcc')) {
            debitcc = (isNaN(parseFloat(document.getElementById('debitcc').value))) ? 0 : parseFloat(document.getElementById('debitcc').value)
        } else {
            debitcc = 0
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
        const totalbersih = document.getElementById('totalbersih').innerHTML
        totalbersihval = parseFloat(totalbersih.replaceAll('.', ''))
        hasil = totalbersihval - (debitcc + bulat + tunai + transfer)
        document.getElementById('transferbyr').innerHTML = Math.round(transfer).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        document.getElementById('totalbersih1').innerHTML = Math.round(hasil).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }

    function byrtunai() {
        if (document.getElementById('pembulatan')) {
            bulat = (isNaN(parseFloat(document.getElementById('pembulatan').value))) ? 0 : parseFloat(document.getElementById('pembulatan').value)
        } else {
            bulat = 0
        }
        if (document.getElementById('debitcc')) {
            debitcc = (isNaN(parseFloat(document.getElementById('debitcc').value))) ? 0 : parseFloat(document.getElementById('debitcc').value)
        } else {
            debitcc = 0
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
        const totalbersih = document.getElementById('totalbersih').innerHTML
        totalbersihval = parseFloat(totalbersih.replaceAll('.', ''))
        hasil = totalbersihval - (debitcc + bulat + tunai + transfer)
        document.getElementById('tunaibyr').innerHTML = Math.round(tunai).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        document.getElementById('totalbersih1').innerHTML = Math.round(hasil).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")

    }

    function pembulatankoma(berat) {
        var num = Number(berat) // The Number() only visualizes the type and is not needed
        var roundedString = num.toFixed(2);
        var rounded = Number(roundedString);
        return rounded
    }
    $(document).ready(function() {
        myDataBayar()
        // tampildataretur()
    })
</script>
<?= $this->endSection(); ?>