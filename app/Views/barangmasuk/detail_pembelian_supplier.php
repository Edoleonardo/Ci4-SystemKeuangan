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
                        <?php if ($datapembelian['cara_pembayaran'] == 'Bayar Nanti') : ?>
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
                                            <th>Jenis</th>
                                            <th>Model</th>
                                            <th>Keterangan</th>
                                            <th>Berat Kotor</th>
                                            <th>Berat Bersih</th>
                                            <th>Harga Beli</th>
                                            <th>Kadar</th>
                                            <th>Nilai Tukar</th>
                                            <th>Merek</th>
                                            <th>Total Harga</th>
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
                                                <td><?= $row['berat_kotor'] ?></td>
                                                <td><?= $row['berat_bersih'] ?></td>
                                                <td><?= $row['harga_beli'] ?></td>
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
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Total Berat Kotor</td>
                                            <td><?= number_format($totalberatkotor['berat_kotor'], 2, ',', '.') ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total Berat Bersih</td>
                                            <td><?= number_format($totalberatbersih['berat_bersih'], 2, ',', '.') ?></td>
                                        </tr>

                                        <tr>
                                            <td>Total Bersih</td>
                                            <td id="totalbersihconst"><?= number_format($datapembelian['total_bayar'], 2, ",", ".") ?></td>
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
                                        <tr>
                                            <td>Metode Pembayaran</td>
                                            <td><?= $datapembelian['cara_pembayaran'] ?></td>
                                        </tr>
                                        <?php if ($datapembelian['nama_bank']) : ?>
                                            <tr>
                                                <td>Nama Bank</td>
                                                <td><?= $datapembelian['nama_bank'] ?></td>
                                            </tr>
                                        <?php endif ?>
                                        <?php if ($datapembelian['pembulatan']) : ?>
                                            <tr>
                                                <td>Pembulatan</td>
                                                <td><?= number_format($datapembelian['pembulatan'], 2, ",", ".") ?></td>
                                            </tr>
                                        <?php endif ?>
                                        <?php if ($datapembelian['charge']) : ?>
                                            <tr>
                                                <td>Charge</td>
                                                <td><?= $datapembelian['charge'] ?> %</td>
                                            </tr>
                                        <?php endif ?>
                                        <?php if ($datapembelian['tunai']) : ?>
                                            <tr>
                                                <td>Tunai</td>
                                                <td><?= number_format($datapembelian['tunai'], 2, ',', '.') ?></td>
                                            </tr>
                                        <?php endif ?>
                                        <?php if ($datapembelian['debitcc']) : ?>
                                            <tr>
                                                <td>Debit / CC</td>
                                                <td><?= number_format($datapembelian['debitcc'], 2, ',', '.') ?></td>
                                            </tr>
                                        <?php endif ?>
                                        <?php if ($datapembelian['transfer']) : ?>
                                            <tr>
                                                <td>Transfer</td>
                                                <td><?= number_format($datapembelian['transfer'], 2, ',', '.') ?></td>
                                            </tr>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
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
                                            <th>Berat Kotor</th>
                                            <th>Berat Bersih</th>
                                            <th>Harga Beli</th>
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
                                                <td><?= $row['berat_kotor'] ?></td>
                                                <td><?= $row['berat_bersih'] ?></td>
                                                <td><?= $row['harga_beli'] ?></td>
                                                <td><?= $row['kadar'] ?></td>
                                                <td><?= $row['nilai_tukar'] ?></td>
                                                <td><?= $row['merek'] ?></td>
                                                <td><?= number_format($row['total_harga']) ?></td>
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
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Pembulatan</label>
                                            <input onkeyup="myPembulatan()" type="number" value="<?= (isset($datapembelian['pembulatan'])) ? $datapembelian['pembulatan'] : ''; ?>" min="0" id="pembulatan" name="pembulatan" class="form-control" placeholder="Masukan Pembulatan">
                                            <input type="hidden" name="dateid" value="<?= $datapembelian['id_date_pembelian'] ?>">
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
                        <button type="submit" class="btn btn-primary btntambah">Bayar</button>
                    </div>
                    </form>
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
                $('#totalberatbersihhtml').html(pembulatankoma(result.totalberatbersih.berat_bersih))
                $('#totalberatkotorhtml').html(pembulatankoma(result.totalberatkotor.berat_kotor))


                document.getElementById('totalbersih1').innerHTML = pembulatankoma(result.totalbersih.total_harga).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                document.getElementById('totalbersih').innerHTML = pembulatankoma(result.totalbersih.total_harga).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                document.getElementById('pembulatanhtml').innerHTML = ''
                document.getElementById('pembulatan').value = ''

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
                    } else {
                        $('#debitcc').removeClass('is-invalid')
                        $('.debitccmsg').html('')
                        $('#namabank').removeClass('is-invalid')
                        $('.namabank').html('')
                        $('#transfer').removeClass('is-invalid')
                        $('.transfer').html('')
                        $('#tunai').removeClass('is-invalid')
                        $('.tunai').html('')

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil Bayar',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK',
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#modal-bayar').modal('toggle');
                                window.location.reload();

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


    function myPembayaran() {
        console.log('masuk')
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
        var NamaBank = '<label>Nama Bank Debit/CC</label><input onkeyup = "byrnamabank()" type="text" id="namabank" name="namabank" class="form-control" placeholder="Masukan Nama Bank"><div id="validationServerUsernameFeedback" class="invalid-feedback namabankmsg"></div>'
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
        }
        if (carabyr == 'Transfer') {
            myDataBayar()
            metod1[0].innerHTML = Transfer
            nmbank[0].innerHTML = NamaBank
            bank[0].innerHTML = '<td>Nama Bank</td><td id="bankbyr"></td>'
            table2[0].innerHTML = '<td>Tranfer</td><td id="transferbyr"></td>'

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
        }

        if (carabyr == 'Tunai&Transfer') {
            myDataBayar()
            metod1[0].innerHTML = Transfer
            nmbank[0].innerHTML = NamaBank
            metod2[0].innerHTML = Tunai
            bank[0].innerHTML = '<td>Nama Bank</td><td id="bankbyr"></td>'
            table3[0].innerHTML = '<td>Tunai</td><td id="tunaibyr"></td>'
            table2[0].innerHTML = '<td>Tranfer</td><td id="transferbyr"></td>'

        }
        console.log(carabyr)
    }

    function byrnamabank() {
        const totalbersih = document.getElementById('totalbersih').innerHTML
        totalbersihval = parseFloat(totalbersih.replace('.', ''))
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
        totalbersihval = parseFloat(totalbersih.replace('.', ''))
        var hasil = totalbersihval - (bulat + debitcc + transfer + tunai)
        document.getElementById('totalbersih1').innerHTML = hasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        document.getElementById('pembulatanhtml').innerHTML = bulat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }

    function brycas() {
        var val = document.getElementById('charge').value
        const totalbersih = document.getElementById('totalbersihconst').innerHTML
        totalbersihval = parseFloat(totalbersih.replace('.', ''))
        hasil = totalbersihval + (val * (totalbersihval / 100))
        document.getElementById('totalbersih').innerHTML = hasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        document.getElementById('totalbersih1').innerHTML = hasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        document.getElementById('chargebyr').innerHTML = val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + '%'
        myPembulatan()
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
        totalbersihval = parseFloat(totalbersih.replace('.', ''))
        hasil = totalbersihval - (debitcc + bulat + tunai + transfer)
        document.getElementById('debitccbyr').innerHTML = debitcc.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        document.getElementById('totalbersih1').innerHTML = hasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")

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
        totalbersihval = parseFloat(totalbersih.replace('.', ''))
        hasil = totalbersihval - (debitcc + bulat + tunai + transfer)
        document.getElementById('transferbyr').innerHTML = transfer.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        document.getElementById('totalbersih1').innerHTML = hasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
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
        totalbersihval = parseFloat(totalbersih.replace('.', ''))
        hasil = totalbersihval - (debitcc + bulat + tunai + transfer)
        document.getElementById('tunaibyr').innerHTML = tunai.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        document.getElementById('totalbersih1').innerHTML = hasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")

    }


    $(document).ready(function() {
        myDataBayar()
    })
</script>
<?= $this->endSection(); ?>