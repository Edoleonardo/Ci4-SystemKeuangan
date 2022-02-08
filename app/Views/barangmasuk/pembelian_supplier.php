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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- ./card-header -->
                    <div class="card-body p-0">
                        <table class="table table-hover">
                            <tbody>
                                <tr data-widget="expandable-table" aria-expanded="false">
                                    <td>
                                        Input Data Master
                                    </td>
                                </tr>
                                <tr class="expandable-body">
                                    <td>
                                        <div class="p-0" style="margin: 10px;">
                                            <form action="/ajaxinsert" name="ajaxform" id="ajaxform" class="ajaxform" method="post" enctype="multipart/form-data">
                                                <?= csrf_field(); ?>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Tanggal Input Barang</label>
                                                            <input type="date" name="tanggal_input" class="form-control" value="<?php echo date('Y-m-d') ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Tanggal Nota Supplier</label>
                                                            <input type="date" name="tanggal_nota_sup" id="tanggal_nota_sup" class="form-control" value="<?= (isset($datapembelian['tgl_faktur'])) ? $datapembelian['tgl_faktur'] : date('Y-m-d'); ?>">
                                                            <div id="validationServerUsernameFeedback" class="invalid-feedback tanggal_nota_supmsg">
                                                            </div>
                                                        </div>
                                                        <!-- <input type="text" name="kelompok" class="form-control" placeholder="Masukan Kelompok"> -->
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Tanggal Jatuh Tempo </label>
                                                            <input type="date" name="tanggal_tempo" class="form-control" value="<?= (isset($datapembelian['tgl_jatuh_tempo'])) ? $datapembelian['tgl_jatuh_tempo'] : date('Y-m-d'); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>No Nota Supplier</label>
                                                            <input type="text" id="no_nota_supp" name="no_nota_supp" value="<?= (isset($datapembelian['no_faktur_supp'])) ? $datapembelian['no_faktur_supp'] : ''; ?>" class="form-control" placeholder="Masukan Nomor Nota Supplier">
                                                            <div id="validationServerUsernameFeedback" class="invalid-feedback no_nota_suppmsg"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Nama Supplier</label>
                                                            <select name="supplier" class="form-control" id="supplier" name="supplier">
                                                                <?php foreach ($supplier as $m) : ?>
                                                                    <option value="<?= $m['nama_supp'] ?>" <?= (isset($datapembelian['nama_supplier']) == $m['nama_supp']) ? ($datapembelian['nama_supplier'] == $m['nama_supp']) ? 'selected' : '' : ''; ?>><?= $m['nama_supp'] ?> </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Total Berat Murni (Gr)</label>
                                                            <input type="number" step="0.01" id="total_berat_m" name="total_berat_m" class="form-control" placeholder="Masukan Total Berat Murni" value="<?= (isset($datapembelian['total_berat_murni'])) ? $datapembelian['total_berat_murni'] : ''; ?>">
                                                            <div id="validationServerUsernameFeedback" class="invalid-feedback total_berat_mmsg">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr data-widget="expandable-table" aria-expanded="false">
                                    <td>
                                        Input Data Berulang
                                    </td>
                                </tr>
                                <tr class="expandable-body">
                                    <td>
                                        <div class="p-0" style="margin: 10px;">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Kelompok</label>
                                                        <select name="kelompok" class="form-control" id="cars" name="cars">
                                                            <option value="1">Perhiasan Mas</option>
                                                            <option value="2">Perhiasan Berlian</option>
                                                            <option value="3">Logam Mulia (Antam, UBS, HWT)</option>
                                                            <option value="4">Bahan Murni</option>
                                                            <option value="5">Loose Diamond</option>
                                                            <option value="6">Barang Dagang</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Merek</label>
                                                        <select name="merek" class="form-control" id="cars" name="cars">
                                                            <?php foreach ($merek as $m) : ?>
                                                                <option value="<?= $m['nama_merek'] ?>"><?= $m['nama_merek'] ?> </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Kadar</label>
                                                        <select name="kadar" class="form-control" id="cars" name="cars">
                                                            <?php foreach ($kadar as $m) : ?>
                                                                <option value="<?= $m['nama_kadar'] ?>"><?= $m['nama_kadar'] ?> </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Jenis</label>
                                                        <input type="text" name="jenis" id="jenis" class="form-control" placeholder="Masukan Jenis">
                                                        <div id="validationServerUsernameFeedback" class="invalid-feedback jenismsg">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Model</label>
                                                        <input type="text" name="model" class="form-control" placeholder="Masukan Model Barang">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Keterangan</label>
                                                        <input type="text" name="keterangan" class="form-control" placeholder="Masukan Keterangan">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Berat Kotor</label>
                                                        <input type="number" step="0.01" id="berat_kotor" name="berat_kotor" class="form-control" placeholder="Masukan Berat Bersih">
                                                        <div id="validationServerUsernameFeedback" class="invalid-feedback berat_kotormsg">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Qty</label>
                                                        <input type="Number" id="qty" name="qty" min="1" class="form-control" placeholder="Masukan jumlah">
                                                        <div id="validationServerUsernameFeedback" class="invalid-feedback qtymsg">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Nilai Tukar</label>
                                                        <input type="number" id="nilai_tukar" name="nilai_tukar" class="form-control" placeholder="Masukan Nilai Tukar">
                                                        <div id="validationServerUsernameFeedback" class="invalid-feedback nilai_tukarmsg">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Harga Beli</label>
                                                        <input type="number" name="harga_beli" class="form-control" placeholder="Masukan Harga Beli">
                                                    </div>
                                                </div>
                                                <div class="col-sm-8">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Gambar</label>
                                                        <div class="custom-file">
                                                            <input type="file" name="gambar" class="custom-file-input" id="gambar" accept="image/*">
                                                            <label style="text-align: left" class="custom-file-label" for="gambar">Pilih Gambar</label>
                                                            <div id="validationServerUsernameFeedback" class="invalid-feedback gambarmsg">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-danger" onclick="hapussemua()">Hapus Semua</button>
                                                <button type="submit" id="send_form" class="btn btn-info btntambah"></i>Tambah</button>
                                            </div>
                                            <!-- </form> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
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
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="databeli">
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
                        <!-- <form action=""> -->
                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Pembulatan</label>
                                <input onkeyup="myPembulatan()" type="number" value="<?= (isset($datapembelian['pembulatan'])) ? $datapembelian['pembulatan'] : ''; ?>" min="0" id="pembulatan" name="pembulatan" class="form-control" placeholder="Masukan Pembulatan">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="card">
                                <!-- ./card-header -->
                                <div class="card-body p-0">
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                <td>
                                                    Pembayaran
                                                </td>
                                            </tr>
                                            <tr class="expandable-body">
                                                <td>
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
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-hover text-nowrap">
                                    <tbody>
                                        <tr>
                                            <td>Total Berat Bersih</td>
                                            <td id="totalberatbersihhtml"></td>
                                        </tr>
                                        <tr>
                                            <td>Total Berat Kotor</td>
                                            <td id="totalberatkotorhtml"></td>
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
                                            <td>Total Harga Bersih</td>
                                            <td id="totalbersih"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col - text-center">
                                <a type="button" onclick="Batal()" class="btn btn-danger">Batal</a>
                                <a type="button" onclick="Selesai()" id="selesai" class="btn btn-info "></i>Selesai</a>
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
<script type="text/javascript">
    // $('#gambar').change(function(e) {
    //     var fileName = e.target.files[0].name;
    //     $('.custom-file-label').html(fileName)
    // });
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
                window.location.href = "<?php echo base_url('batalpembelian'); ?>"
            }
        })

    };

    function Selesai() {
        //   console.log((document.getElementById('debit/cc').value) ? document.getElementById('debit/cc').value : 0)
        var pembulatan = (document.getElementById('pembulatan')) ? document.getElementById('pembulatan').value : 0
        var debitcc = (document.getElementById('debit/cc')) ? document.getElementById('debit/cc').value : 0
        var namabank = (document.getElementById('namabank')) ? document.getElementById('namabank').value : 0
        var charge = (document.getElementById('charge')) ? document.getElementById('charge').value : 0
        var transfer = (document.getElementById('transfer')) ? document.getElementById('transfer').value : 0
        var tunai = (document.getElementById('tunai')) ? document.getElementById('pembulatan').value : 0
        var carabayar = (document.getElementById('pembayaran')) ? document.getElementById('pembayaran').value : 0

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
                    url: "<?php echo base_url('stockdata'); ?>",
                    data: {
                        carabayar: carabayar,
                        debitcc: debitcc,
                        namabank: namabank,
                        charge: charge,
                        transfer: transfer,
                        tunai: tunai

                    },
                    success: function(result) {
                        console.log(result)

                        if (result.pesan == 'error') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Tidak ada data',
                            })
                        } else {
                            Swal.fire({
                                icon: 'info',
                                title: 'Data Berhasil DI masukan',
                            })
                            window.location.href = "<?php echo base_url('barangmasuk'); ?>";
                        }

                    }
                })

            }
        })
    }

    function myPembulatan() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('ajaxpembelian'); ?>",
            success: function(result) {
                $('#databeli').html(result.data)
                $('#totalberatbersihhtml').html(pembulatankoma(result.totalberatbersih.berat_bersih))
                $('#totalberatkotorhtml').html(pembulatankoma(result.totalberatkotor.berat_kotor))

                var bulat = document.getElementById('pembulatan').value
                var hasil = result.totalbersih.total_harga - bulat
                document.getElementById('totalbersih').innerHTML = pembulatankoma(hasil).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                document.getElementById('pembulatanhtml').innerHTML = bulat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")


            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function namabank() {
        var bank = document.getElementById('namabank').value
        document.getElementById('bankbyr').innerHTML = bank
    }

    function brycas() {
        var val = document.getElementById('charge').value
        document.getElementById('chargebyr').innerHTML = val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }

    function debitcc() {
        var val = document.getElementById('debit/cc').value
        document.getElementById('debitccbyr').innerHTML = val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }

    function transfer() {
        var val = document.getElementById('transfer').value
        document.getElementById('transferbyr').innerHTML = val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }

    function tunai() {
        var val = document.getElementById('tunai').value
        document.getElementById('tunaibyr').innerHTML = val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
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

        var DebitCC = '<label>Debit/CC</label><input type="number" onkeyup = "debitcc()" min="0" id="debit/cc" name="debit/cc" class="form-control" placeholder="Masukan debit/cc">'
        var NamaBank = '<label>Nama Bank Debit/CC</label><input onkeyup = "namabank()" type="text" id="namabank" name="namabank" class="form-control" placeholder="Masukan Nama Bank">'
        var Charge = '<label>Charge %</label><input type="number" onkeyup = "brycas()" min="0" id="charge" name="charge" class="form-control" placeholder="Masukan Charge">'
        var Transfer = '<label>Transfer</label><input type="number" onkeyup = "transfer()" min="0" id="transfer" name="transfer" class="form-control" placeholder="Masukan transfer">'
        var Tunai = '<label>Tunai</label><input type="number" onkeyup = "tunai()" min="0" id="tunai" name="tunai" class="form-control" placeholder="Masukan tunai">'

        if (carabyr == 'Bayar Nanti') {
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
            metod1[0].innerHTML = DebitCC
            nmbank[0].innerHTML = NamaBank
            charge[0].innerHTML = Charge
            bank[0].innerHTML = '<td>Nama Bank</td><td id="bankbyr"></td>'
            table1[0].innerHTML = '<td>Charge</td><td id="chargebyr"></td>'
            table2[0].innerHTML = '<td>Debit/CC</td><td id="debitccbyr"></td>'
        }
        if (carabyr == 'Debit/CCTranfer') {
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
            metod1[0].innerHTML = Transfer
            nmbank[0].innerHTML = NamaBank
            bank[0].innerHTML = '<td>Nama Bank</td><td id="bankbyr"></td>'
            table2[0].innerHTML = '<td>Tranfer</td><td id="transferbyr"></td>'

        }
        if (carabyr == 'Tunai') {
            metod1[0].innerHTML = Tunai
            table1[0].innerHTML = '<td>Tunai</td><td id="tunaibyr"></td>'

        }
        if (carabyr == 'Tunai&Debit/CC') {
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
            metod1[0].innerHTML = Transfer
            nmbank[0].innerHTML = NamaBank
            metod2[0].innerHTML = Tunai
            bank[0].innerHTML = '<td>Nama Bank</td><td id="bankbyr"></td>'
            table3[0].innerHTML = '<td>Tunai</td><td id="tunaibyr"></td>'
            table2[0].innerHTML = '<td>Tranfer</td><td id="transferbyr"></td>'

        }
        console.log(carabyr)
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
            console.log('asd')
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "<?php echo base_url('deletedetailsemua'); ?>",
                    success: function(result) {
                        console.log(result)
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

    function tampildata() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('ajaxpembelian'); ?>",
            success: function(result) {
                $('#databeli').html(result.data)
                $('#totalbersih').html(result.totalbersih.total_harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
                $('#totalberatbersihhtml').html(pembulatankoma(result.totalberatbersih.berat_bersih))
                $('#totalberatkotorhtml').html(pembulatankoma(result.totalberatkotor.berat_kotor))

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    $(document).ready(function() {
        tampildata()
        myPembulatan()
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
                        if (result.error.total_qty) {
                            $('#total_qty').addClass('is-invalid')
                            $('.total_qtymsg').html(result.error.total_qty)
                        } else {
                            $('#total_qty').removeClass('is-invalid')
                            $('.total_qtymsg').html('')
                        }
                        if (result.error.jenis) {
                            $('#jenis').addClass('is-invalid')
                            $('.jenismsg').html(result.error.jenis)
                        } else {
                            $('#jenis').removeClass('is-invalid')
                            $('.jenismsg').html('')
                        }
                        if (result.error.berat_kotor) {
                            $('#berat_kotor').addClass('is-invalid')
                            $('.berat_kotormsg').html(result.error.berat_kotor)
                        } else {
                            $('#berat_kotor').removeClass('is-invalid')
                            $('.berat_kotormsg').html('')
                        }
                        if (result.error.gambar) {
                            $('#gambar').addClass('is-invalid')
                            $('.gambarmsg').html(result.error.gambar)
                        } else {
                            $('#gambar').removeClass('is-invalid')
                            $('.gambarmsg').html('')
                        }
                        if (result.error.no_nota_supp) {
                            $('#no_nota_supp').addClass('is-invalid')
                            $('.no_nota_suppmsg').html(result.error.no_nota_supp)
                        } else {
                            $('#no_nota_supp').removeClass('is-invalid')
                            $('.no_nota_suppmsg').html('')
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
                        $('#total_qty').removeClass('is-invalid')
                        $('.total_qtymsg').html('')
                        $('#jenis').removeClass('is-invalid')
                        $('.jenismsg').html('')
                        $('#berat_kotor').removeClass('is-invalid')
                        $('.berat_kotormsg').html('')
                        $('#gambar').removeClass('is-invalid')
                        $('.gambarmsg').html('')
                        $('#no_nota_supp').removeClass('is-invalid')
                        $('.no_nota_suppmsg').html('')
                        window.scrollTo(0, 10000);
                        tampildata()
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        })


    })
</script>
<?= $this->endSection(); ?>