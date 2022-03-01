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
                        <li class="breadcrumb-item"><a href="/buybackcust">Home</a></li>
                        <li class="breadcrumb-item"><a href="/buybackcust">Buyback Customer</a></li>
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
                <form action="/scantrans" name="scannotrans" id="scannotrans" class="scannotrans" method="post">
                    <div class="card">
                        <div class="form-group" style="margin: 1mm;">
                            <label>Masukan No Invoce</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control notrans" id="notrans" onkeyup="ScannoTrans()" name="notrans" placeholder="Masukan Nomor Nota">
                                <span class="input-group-append">
                                    <button type="submit" id="scannotransbtn" class="btn btn-info btn-flat scannotransbtn">Ok</button>
                                </span>
                                <div id="validationServerUsernameFeedback" class="invalid-feedback notransmsg">
                                </div>
                            </div>
                        </div>
                </form>

            </div>
            <!-- /.card -->
        </div>
        <div class="container-fluid">
            <div class="card">
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
                                                <th>Harga Beli</th>
                                                <th>Ongkos</th>
                                                <th>Jenis</th>
                                                <th>Model</th>
                                                <th>Keterangan</th>
                                                <th>Berat</th>
                                                <th>Berat Murni</th>
                                                <th>Kadar</th>
                                                <th>Nilai Tukar</th>
                                                <th>Merek</th>
                                                <th>Buyback</th>
                                            </tr>
                                        </thead>
                                        <tbody id="databuyback">
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
                                <div class="card-body p-0" id="refreshpembayaran">

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
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content-wrapper -->
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/tambahbuyback" id="tambahbuyback" class="tambahbuyback" name="tambahbuyback">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Berat</label>
                                    <input type="number" step="0.01" id="berat" onkeyup="HarusBayar()" name="berat" class="form-control" placeholder="Masukan Berat Bersih">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback beratmsg">
                                        <input type="hidden" name="id" id="id" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Nilai Tukar</label>
                                    <input type="number" id="nilai_tukar" onkeyup="HarusBayar()" name="nilai_tukar" class="form-control" placeholder="Masukan Nilai Tukar">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback nilai_tukarmsg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Harga Beli</label>
                                    <input type="number" name="harga_beli" onkeyup="HarusBayar()" id="harga_beli" class="form-control harga_beli" placeholder="Masukan Harga Beli">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback harga_belimsg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Status Barang</label>
                                    <select name="status_proses" class="form-control" id="status" name="status">
                                        <option value="Cuci">Cuci</option>
                                        <option value="Retur">Retur Sales</option>
                                        <option value="Lebur">Lebur</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <!-- ./card-header -->
                                    <div class="p-0">
                                        <!-- text input -->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Cara Pembayaran</label>
                                                    <select onchange="myPembayaran()" onclick="myPembayaran()" name="pembayaran" class="form-control pembayaran" id="pembayaran">
                                                        <option value="Transfer">Transfer</option>
                                                        <option value="Tunai">Tunai</option>
                                                        <option value="Tunai&Transfer">Tunai & Transfer</option>
                                                    </select>
                                                    <div id="validationServerUsernameFeedback" class="invalid-feedback pembayaranmsg">
                                                    </div>
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
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Berat Murni</td>
                                            <td id="brtmurni"></td>
                                        </tr>
                                        <tr>
                                            <td>Harus Dibayar</td>
                                            <td id="harusbayar"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btnedit">Tambah</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Main Footer -->
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<footer class="main-footer">

</footer>
<script type="text/javascript">
    function HarusBayar() {
        var hargabeli = parseFloat(document.getElementById('harga_beli').value)
        var nilaitukar = parseFloat(document.getElementById('nilai_tukar').value)
        var berat = parseFloat(document.getElementById('berat').value)
        const hrsbyr = document.getElementById('harusbayar')
        const brtmurni = document.getElementById('brtmurni')
        beratmurni = berat * nilaitukar / 100
        harusbyr = (beratmurni * hargabeli);
        brtmurni.innerHTML = beratmurni.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        hrsbyr.innerHTML = harusbyr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        console.log(harusbyr)

    }

    function myPembayaran() {
        console.log('masuk')
        const carabyr = document.getElementById('pembayaran').value
        const metod1 = $('.metodebayar')
        const nmbank = $('.namabankhtml')
        const metod2 = document.getElementsByClassName('metodebayar2')
        metod1[0].innerHTML = ''
        nmbank[0].innerHTML = ''
        metod2[0].innerHTML = ''

        var NamaBank = '<label>Nama Bank Debit/CC</label><input type="text" id="namabank" name="namabank" class="form-control" placeholder="Masukan Nama Bank"><div id="validationServerUsernameFeedback" class="invalid-feedback namabankmsg"></div>'
        var Transfer = '<label>Transfer</label><input type="number" onkeyup="transfer__()" min="0" id="transfer" name="transfer" class="form-control" placeholder="Masukan transfer"><div id="validationServerUsernameFeedback" class="invalid-feedback transfermsg"></div>'
        var Tunai = '<label>Tunai</label><input type="number"  onkeyup="tunai__()" min="0" id="tunai" name="tunai" class="form-control" placeholder="Masukan tunai"><div id="validationServerUsernameFeedback" class="invalid-feedback tunaimsg"></div>'
        console.log(carabyr)

        if (carabyr == 'Transfer') {
            metod1[0].innerHTML = Transfer
            nmbank[0].innerHTML = NamaBank
            document.getElementById('transfer').value = document.getElementById('harusbayar').innerHTML.replaceAll('.', '')

        }
        if (carabyr == 'Tunai') {
            metod1[0].innerHTML = Tunai
            document.getElementById('tunai').value = document.getElementById('harusbayar').innerHTML.replaceAll('.', '')

        }

        if (carabyr == 'Tunai&Transfer') {
            metod1[0].innerHTML = Transfer
            nmbank[0].innerHTML = NamaBank
            metod2[0].innerHTML = Tunai
            document.getElementById('transfer').value = document.getElementById('harusbayar').innerHTML.replaceAll('.', '')
        }
    }

    function transfer__() {
        var tunai = document.getElementById('tunai').value
        var trnsfr = document.getElementById('transfer').value
        var harga = document.getElementById('harusbayar').innerHTML.replaceAll('.', '')
        hasiltrnsfr = harga - trnsfr
        // Math.abs(hasiltrnsfr)
        // document.getElementById('tunai').value = hasiltunai
        if (hasiltrnsfr < 0) {
            document.getElementById('tunai').value = 0
        } else {
            document.getElementById('tunai').value = Math.abs(hasiltrnsfr)
        }
    }

    function tunai__() {
        var tunai = document.getElementById('tunai').value
        var harga = document.getElementById('harusbayar').innerHTML.replaceAll('.', '')
        var trnsfr = document.getElementById('transfer').value
        hasiltrnsfr = harga - tunai
        // Math.abs(hasiltrnsfr)
        // document.getElementById('tunai').value = hasiltunai
        if (hasiltrnsfr < 0) {
            document.getElementById('transfer').value = 0
        } else {
            document.getElementById('transfer').value = Math.abs(hasiltrnsfr)
        }
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
            url: "<?php echo base_url('tampilpenjualan'); ?>",
            success: function(result) {
                var totalharga = parseFloat(result.totalbersih.total_harga) + parseFloat(result.totalongkos.ongkos)
                $('#datajual').html(result.data)
                $('#totalbersih01').html(totalharga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
                $('#totalberatbersihhtml01').html(pembulatankoma(result.totalberatbersih.berat_murni))
                $('#totalberatkotorhtml01').html(pembulatankoma(result.totalberatkotor.berat))
                $('#totalongkoshtml01').html(pembulatankoma(result.totalongkos.ongkos).toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))


            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
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

    function ScannoTrans() {
        $('#scannotransbtn').trigger('click');
    }

    $('.scannotrans').submit(function(e) {
        e.preventDefault()
        let form = $('.scannotrans')[0];
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            data: data,
            url: "<?php echo base_url('scantrans'); ?>",
            contentType: false,
            processData: false,
            cache: false,
            dataType: "json",
            success: function(result) {
                if (result.pesan_error) {
                    console.log(result)
                    $('#notrans').addClass('is-invalid')
                    $('.notransmsg').html(result.pesan_error)

                } else {
                    $('#notrans').removeClass('is-invalid')
                    $('.notransmsg').html('')
                    document.getElementById('notrans').setAttribute("onkeyup", "ScannoTrans()");
                    document.getElementById('notrans').value = ''
                    $('#databuyback').html(result.data)
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })

    })

    $('.tambahbuyback').submit(function(e) {
        e.preventDefault()
        let form = $('.tambahbuyback')[0];
        let data = new FormData(form)
        Swal.fire({
            title: 'Tambah',
            text: "Yakin ingin Buyback Barang ini ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Tambah',
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    data: data,
                    url: "<?php echo base_url('/tambahbuyback'); ?>",
                    contentType: false,
                    processData: false,
                    cache: false,
                    dataType: "json",
                    success: function(result) {
                        if (result.error) {
                            console.log(result)
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
                            if (result.error.harga_beli) {
                                $('#harga_beli').addClass('is-invalid')
                                $('.harga_belimsg').html(result.error.harga_beli)
                            } else {
                                $('#harga_beli').removeClass('is-invalid')
                                $('.harga_belimsg').html('')
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
                            if (result.error.pembayaran) {
                                $('#pembayaran').addClass('is-invalid')
                                $('.pembayaranmsg').html(result.error.pembayaran)
                            } else {
                                $('#pembayaran').removeClass('is-invalid')
                                $('.pembayaran').html('')
                            }
                        } else {
                            $('#nilai_tukar').removeClass('is-invalid')
                            $('.nilai_tukarmsg').html('')
                            $('#jenis').removeClass('is-invalid')
                            $('.jenismsg').html('')
                            $('#berat').removeClass('is-invalid')
                            $('.beratmsg').html('')
                            $('#harga_beli').removeClass('is-invalid')
                            $('.harga_belimsg').html('')
                            $('#namabank').removeClass('is-invalid')
                            $('.namabank').html('')
                            $('#transfer').removeClass('is-invalid')
                            $('.transfer').html('')
                            $('#tunai').removeClass('is-invalid')
                            $('.tunai').html('')
                            $('#pembayaran').removeClass('is-invalid')
                            $('.pembayaran').html('')

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Tambah',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK',
                                allowOutsideClick: false
                            }).then((choose) => {
                                if (choose.isConfirmed) {
                                    $('#modal-edit').modal('toggle');
                                    window.location.href = '/buybackcust'
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


    function tambah(id) {
        console.log('tambah')
        $.ajax({
            type: "get",
            dataType: "json",
            url: "<?php echo base_url('tampilbuyback'); ?>",
            data: {
                id: id,
            },
            success: function(result) {
                // console.log(result)
                $('#modal-edit').modal('show');
                $('#merek').val(result.data.merek)
                $('#kadar').val(result.data.kadar)
                $('#berat').val(result.data.berat)
                $('#qty').val(result.data.qty)
                $('#model').val(result.data.model)
                $('#keterangan').val(result.data.keterangan)
                $('#nilai_tukar').val(result.data.nilai_tukar)
                $('#harga_beli').val(result.data.harga_beli)
                $('#ongkos').val(result.data.ongkos)
                $('#jenis').val(result.data.jenis)
                $('#kode').val(result.data.kode)
                $('#id').val(result.data.id_detail_penjualan)
                console.log($('#id').val())
                HarusBayar()

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })



    }

    $(document).ready(function() {
        // $("#refreshtombol").load("/draftpenjualan/" + document.getElementById('dateid').value + " #refreshtombol");
        tampildata()

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
                    tampilcustomer()
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