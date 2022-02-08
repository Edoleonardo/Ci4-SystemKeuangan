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
                                        <div class="form-group">
                                            <label>Nama Customer</label>
                                            <select name="customer" id="customer" class="form-control select2" style="width: 100%;">
                                                <?php foreach ($datacust as $m) : ?>
                                                    <option value="<?= $m['id_customer'] ?>" <?= (isset($datapenjualan['nama_customer']) == $m['nama']) ? ($datapenjualan['nama_customer'] == $m['nama']) ? 'selected' : '' : ''; ?>><?= $m['nama'] ?> </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label>Kode Barang</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control" id="kodebarang" onkeyup="ScanBarcode()" name="kodebarang" placeholder="Masukan Nomor Nota Supplier">
                                                <span class="input-group-append">
                                                    <button type="submit" id="btnsubmitform" class="btn btn-info btn-flat btnsubmitform">Ok</button>
                                                </span>
                                            </div>
                                        </div>
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
                        <a class="btn btn-app" data-toggle="modal" data-target="#modal-lg">
                            <i class="fas fa-users"></i> Tambah Customer
                        </a>
                        <a type="button" onclick="Batal()" class="btn btn-app">
                            <i class="fas fa-window-close"></i> Batal Jual
                        </a>
                        <?php if (isset($datapenjualan)) : ?>
                            <?php if ($datapenjualan['pembayaran'] == 'Bayar Nanti') : ?>
                                <a class="btn btn-app bg-danger" type="button" data-toggle="modal" data-target="#modal-bayar">
                                    <i class="fas fa-money-bill"></i> Bayar
                                </a>
                            <?php else : ?>
                                <a class="btn btn-app" target="_blank" href="/printinvoice/<?= $datapenjualan['id_date_penjualan'] ?>" target="_blank">
                                    <i class="fas fa-print"></i> Print Invoce
                                </a>
                                <a class="btn btn-app bg-primary" type="button" data-toggle="modal" data-target="#modal-bayar">
                                    <i class="fas fa-check"></i> Lunas
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
                $('#datajual').html(result.data)
                $('#totalbersih01').html(result.totalbersih.total_harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
                $('#totalberatbersihhtml01').html(pembulatankoma(result.totalberatbersih.berat_bersih))
                $('#totalberatkotorhtml01').html(pembulatankoma(result.totalberatkotor.berat_kotor))

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function myDataBayar() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('ajaxdetailpenjualan'); ?>",
            data: {
                dateid: '<?= (isset($datapenjualan['id_date_penjualan'])) ? $datapenjualan['id_date_penjualan'] : ''; ?>'
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

    $('.pembayaranform').submit(function(e) {
        e.preventDefault()
        let form = $('.pembayaranform')[0];
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            data: data,
            url: "<?php echo base_url('ajaxpembayaranjual') ?>",
            dataType: "json",
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function() {
                $('.btnbayar').html('<i class="fa fa-spin fa-spinner">')
            },
            complete: function() {
                $('.btnbayar').html('Bayar')
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
        const totalbersih = document.getElementById('totalbersih01').innerHTML
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

    function Batal() {
        Swal.fire({
            title: 'Batal Penjualan ',
            text: "Apakah Ingin Batal Penjualan ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo base_url('batalpenjualan'); ?>"
            }
        })

    };

    function ScanBarcode() {

        $('#btnsubmitform').trigger('click');
    }

    $('.formkodebarcode').submit(function(e) {
        e.preventDefault()
        let form = $('.formkodebarcode')[0];
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            data: data,
            url: "<?php echo base_url('kodebarang'); ?>",
            contentType: false,
            processData: false,
            cache: false,
            dataType: "json",
            success: function(result) {
                if (result.pesan == 'gagal') {
                    console.log(result)
                } else {
                    tampildata()
                    document.getElementById('kodebarang').value = ''
                }
                if (result.pesan == 'Draft') {
                    window.location.href = "draftpenjualan/" + result.id;
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })

    })



    $(document).ready(function() {
        tampildata()
        myDataBayar()
        $('.insertcust').submit(function(e) {
            e.preventDefault()
            let form = $('.insertcust')[0];
            let data = new FormData(form)
            $.ajax({
                type: "POST",
                data: data,
                url: "<?php echo base_url('insertcustomer'); ?>",
                dataType: "json",
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
                    $('#modal-lg').modal('toggle');

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        })
    })
</script>
<?= $this->endSection(); ?>