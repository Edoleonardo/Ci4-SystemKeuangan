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

    .cell-1 {
        border-collapse: separate;
        border-spacing: 0 4em;
        background: #ffffff;
        border-bottom: 5px solid transparent;
        background-clip: padding-box;
        cursor: pointer
    }

    /* #fixedasd {
        z-index: 99999999;
        position: fixed;
    } */
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Transaksi Harian</h1>
                </div><!-- /.col -->
                <!-- /.content-header -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Transaksi Harian</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="table-responsive" id="refreshtitle">
                            <table class="table text-nowrap" id="titletr">
                                <tr>
                                    <td style="text-align: center;" colspan="6">Total Detail</td>
                                </tr>
                                <tr>
                                    <td>Masuk Tunai :</td>
                                    <td>
                                        <?= number_format($datatransaksi['total_masuk_tunai'], 0, ',', '.') ?>
                                    </td>
                                    <td>Masuk Transfer :</td>
                                    <td>
                                        <?= number_format($datatransaksi['total_masuk_transfer'], 0, ',', '.') ?>
                                    </td>
                                    <td>Masuk Debit/CC :</td>
                                    <td>
                                        <?= number_format($datatransaksi['total_masuk_debitcc'], 0, ',', '.') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Keluar Tunai:</td>
                                    <td>
                                        <?= number_format($datatransaksi['total_keluar_tunai'], 0, ',', '.') ?>
                                    </td>
                                    <td>Keluar Transfer:</td>
                                    <td>
                                        <?= number_format($datatransaksi['total_keluar_transfer'], 0, ',', '.') ?>
                                    </td>
                                    <td>Keluar Debit/CC:</td>
                                    <td>
                                        <?= number_format($datatransaksi['total_keluar_debitcc'], 0, ',', '.') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Saldo Tunai:</td>
                                    <td>
                                        <?= number_format($datatransaksi['total_akhir_tunai'], 0, ',', '.') ?>
                                    </td>
                                    <td>Saldo Transfer:</td>
                                    <td>
                                        <?= number_format($datatransaksi['total_akhir_transfer'], 0, ',', '.') ?>
                                    </td>
                                    <td>Saldo Debit/CC:</td>
                                    <td>
                                        <?= number_format($datatransaksi['total_akhir_debitcc'], 0, ',', '.') ?>
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
                        <div class="card-body">
                            <div class="row">
                                <a class="btn btn-app bg-primary" type="button" data-toggle="modal" data-target="#modal-input">
                                    <i class="fas fa-plus"></i>Tambah Biaya
                                </a>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Filter Dari Tanggal</label>
                                        <input type="date" onchange="TampilTrans()" id="daritgl" name="daritgl" class="form-control" placeholder="Masukan daritgl" value="<?= date("Y-m-d") ?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Sampai Dari Tanggal</label>
                                        <input type="date" onchange="TampilTrans()" id="sampaitgl" name="sampaitgl" class="form-control" placeholder="Masukan sampaitgl" value="<?= date("Y-m-d", strtotime("-10 days")) ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Transaksi Harian</h3>
                        </div>
                        <!-- ./card-header -->
                        <div class="table-responsive" id="refreshtbl">
                            <!-- ------------------------------------------------------------------- -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<div class="modal fade" id="modal-input">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Transaksi Harian</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/tambahinput" name="tambahinput" id="tambahinput" class="tambahinput" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_transaksi" id="id_transaksi" value="<?= $datatransaksi['id_transaksi'] ?>">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Tanggal Transaksi</label>
                                <input type="date" id="tangalinput" name="tangalinput" class="form-control" placeholder="Masukan tangalinput" value="<?= date("Y-m-d") ?>">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="kategori" id="kategori" class="form-control kategori" placeholder="Masukan Harga Beli">
                                    <option value="masuk">Masuk</option>
                                    <option value="keluar">Keluar</option>
                                </select>
                                <div id="validationServerUsernameFeedback" class="invalid-feedback kategorimsg">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Akun Biaya</label>
                                <select name="nama_akun" id="nama_akun" class="form-control nama_akun" placeholder="Masukan Harga Beli">
                                    <?php foreach ($dataakun as $row) : ?>
                                        <option value="<?= $row['id_akun_biaya'] ?>"><?= $row['nama_akun'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div id="validationServerUsernameFeedback" class="invalid-feedback nama_akunmsg">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Masukan Keterangan">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback keteranganmsg">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Pembayaran</label>
                                <select onchange=" myPembayaran()" name="pembayaran" id="pembayaran" class="form-control pembayaran" placeholder="Masukan Harga Beli">
                                    <option value="Tunai">Tunai</option>
                                    <option value="Transfer">Transfer</option>
                                    <option value="Debitcc">Debit/CC</option>
                                </select>
                                <div id="validationServerUsernameFeedback" class="invalid-feedback pembayaranmsg">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="number" name="amount" id="amount" class="form-control" placeholder="Masukan amount">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback amountmsg">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group namabankhtml">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary btntambah">Tambah</button>
            </div>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- Control Sidebar -->
<div id="openmodaldetail">
</div>
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer">

</footer>

<script>
    function myPembayaran() {
        const carabyr = document.getElementById('pembayaran').value
        const nmbank = $('.namabankhtml')
        nmbank[0].innerHTML = ''
        var NamaBank = '<label>Nama Bank Debit/CC</label><select type="text" id="namabank" name="namabank" class="form-control" placeholder="Masukan Nama Bank"><?php foreach ($bank as $m) : ?><option value="<?= $m['nama_bank'] ?>"><?= $m['nama_bank'] ?> </option><?php endforeach; ?></select><div id="validationServerUsernameFeedback" class="invalid-feedback namabankmsg"></div>'
        if (carabyr == 'Transfer' || carabyr == 'Debitcc') {
            nmbank[0].innerHTML = NamaBank
        }
    }
    $('.tambahinput').submit(function(e) {
        e.preventDefault()
        Swal.fire({
            title: 'Tambah',
            text: "Apakah Yakin Selesai Input ?",
            icon: 'info',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Selesai',
        }).then((choose) => {
            if (choose.isConfirmed) {
                let form = $('.tambahinput')[0];
                let data = new FormData(form)
                $.ajax({
                    type: "POST",
                    data: data,
                    url: "<?php echo base_url('tambahinput'); ?>",
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(result) {
                        if (result.error) {
                            if (result.error.kategori) {
                                $('#kategori').addClass('is-invalid')
                                $('.nilai_tukarmsg').html(result.error.kategori)
                            } else {
                                $('#kategori').removeClass('is-invalid')
                                $('.nilai_tukarmsg').html('')
                            }
                            if (result.error.keterangan) {
                                $('#keterangan').addClass('is-invalid')
                                $('.keteranganmsg').html(result.error.keterangan)
                            } else {
                                $('#keterangan').removeClass('is-invalid')
                                $('.keteranganmsg').html('')
                            }
                            if (result.error.tangalinput) {
                                $('#tangalinput').addClass('is-invalid')
                                $('.tangalinputmsg').html(result.error.tangalinput)
                            } else {
                                $('#tangalinput').removeClass('is-invalid')
                                $('.tangalinputmsg').html('')
                            }
                            if (result.error.amount) {
                                $('#amount').addClass('is-invalid')
                                $('.amountmsg').html(result.error.amount)
                            } else {
                                $('#amount').removeClass('is-invalid')
                                $('.amountmsg').html('')
                            }
                            if (result.error.nama_akun) {
                                $('#nama_akun').addClass('is-invalid')
                                $('.nama_akunmsg').html(result.error.nama_akun)
                            } else {
                                $('#nama_akun').removeClass('is-invalid')
                                $('.nama_akunmsg').html('')
                            }
                            if (result.error.saldo) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: result.error.saldo,
                                })
                            }
                        } else {
                            $('#total_tangalinput').removeClass('is-invalid')
                            $('.total_tangalinputmsg').html('')
                            $('#kategori').removeClass('is-invalid')
                            $('.nilai_tukarmsg').html('')
                            $('#keterangan').removeClass('is-invalid')
                            $('.keteranganmsg').html('')
                            $('#tangalinput').removeClass('is-invalid')
                            $('.tangalinputmsg').html('')
                            $('#amount').removeClass('is-invalid')
                            $('.amountmsg').html('')
                            $('#nama_akun').removeClass('is-invalid')
                            $('.nama_akunmsg').html('')
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Di Tambah',
                            })
                            $("#refreshtitle").load("/transaksiharian/ #titletr");
                            $('#modal-input').modal('toggle')
                            TampilTrans()
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                })
            } else {
                $("#refreshtitle").load("/transaksiharian/ #titletr");
                TampilTrans()
            }
        })

    })

    function TampilTrans() {
        $.ajax({
            type: "get",
            url: "<?php echo base_url('tampiltrans'); ?>",
            dataType: "json",
            data: {
                dari: $('#daritgl').val(),
                sampai: $('#sampaitgl').val(),
            },
            success: function(result) {
                if (result.error) {
                    Swal.fire({
                        icon: 'warning',
                        title: result.error,
                    })
                }
                $('#refreshtbl').html(result.tampiltrans)
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "aaSorting": []
            //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis", ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

    $(document).ready(function() {
        TampilTrans()
    })
</script>
<?= $this->endSection(); ?>