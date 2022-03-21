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
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Master Input</h1>
                </div><!-- /.col -->
                <!-- /.content-header -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Master Input</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Customer</h3>
                        </div>
                        <!-- /.card-header -->
                        <a class="btn btn-app tambahcustomer" id="tambahcustomer" data-toggle="modal" data-target="#modal-lg">
                            <i class="fas fa-plus"></i> Tambah Customer
                        </a>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Customer</th>
                                        <th>No Hp</th>
                                        <th>Alamat</th>
                                        <th>Kota</th>
                                        <th>Point</th>
                                    </tr>
                                </thead>
                                <tbody id="tblcustomer">
                                    <?php foreach ($datacust as $row) : ?>
                                        <tr id="isicustomer" onclick="Updatedata(<?= $row['id_customer'] ?>, 'customer')">
                                            <td><?= $row['nama'] ?></td>
                                            <td><?= $row['nohp_cust'] ?></td>
                                            <td><?= $row['alamat_cust'] ?></td>
                                            <td><?= $row['kota_cust'] ?></td>
                                            <td><?= $row['point'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nama Customer</th>
                                        <th>No Hp</th>
                                        <th>Alamat</th>
                                        <th>Kota</th>
                                        <th>Point</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Supplier</h3>
                        </div>
                        <!-- /.card-header -->
                        <a class="btn btn-app tambahsupplier" id="tambahsupplier" onclick="OpenModalData('supplier')">
                            <i class="fas fa-plus"></i> Tambah Supplier
                        </a>
                        <div class="card-body">
                            <table id="supplier" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Supplier</th>
                                        <th>Alamat</th>
                                        <th>Kota</th>
                                        <th>Nama Sales</th>
                                        <th>No Hp</th>
                                        <th>No Kantor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($datasup as $row) : ?>
                                        <tr onclick="Updatedata(<?= $row['id_supplier'] ?>, 'supplier')">
                                            <td><?= $row['nama_supp'] ?></td>
                                            <td><?= $row['alamat_supp'] ?></td>
                                            <td><?= $row['kota_supp'] ?></td>
                                            <td><?= $row['sales_supp'] ?></td>
                                            <td><?= $row['no_hp'] ?></td>
                                            <td><?= $row['no_ktr'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nama Supplier</th>
                                        <th>Alamat</th>
                                        <th>Kota</th>
                                        <th>Nama Sales</th>
                                        <th>No Hp</th>
                                        <th>No Kantor</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Kadar</h3>
                        </div>
                        <a class="btn btn-app tambahkadar" id="tambahkadar" onclick="OpenModalData('kadar')">
                            <i class="fas fa-plus"></i> Tambah Kadar
                        </a>
                        <div class="card-body">
                            <table id="kadar" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Kadar</th>
                                        <th>Nilai Kadar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($datakadar as $row) : ?>
                                        <tr onclick="Updatedata(<?= $row['id_kadar'] ?>, 'kadar')">
                                            <td><?= $row['nama_kadar'] ?></td>
                                            <td><?= $row['nilai_kadar'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nama Kadar</th>
                                        <th>Nilai Kadar</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class=" col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Merek</h3>
                        </div>
                        <!-- /.card-header -->
                        <a class="btn btn-app tambahmerek" id="tambahmerek" onclick="OpenModalData('merek')">
                            <i class="fas fa-plus"></i> Tambah Merek
                        </a>
                        <div class="card-body">
                            <table id="merek" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Merek</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($datamerek as $row) : ?>
                                        <tr onclick="Updatedata(<?= $row['id_merek'] ?>, 'merek')">
                                            <td><?= $row['nama_merek'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nama Merek</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Pembayaran Bank</h3>
                        </div>
                        <!-- /.card-header -->
                        <a class="btn btn-app tambahcustomer" id="tambahcustomer" onclick="OpenModalData('bank')">
                            <i class="fas fa-plus"></i> Tambah Bank
                        </a>
                        <div class="card-body">
                            <table id="bank" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Bank</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($databank as $row) : ?>
                                        <tr onclick="Updatedata(<?= $row['id_bank'] ?>, 'bank')">
                                            <td><?= $row['nama_bank'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Pembayaran Bank</th>
                                    </tr>
                                </tfoot>
                            </table>
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
                <?= csrf_field(); ?>
                <div class="row" style="margin: 10px;">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Nama Customer</label>
                            <input type="text" id="nama_cust" name="nama_cust" class="form-control nama_cust" placeholder="Masukan Nomor Nota Supplier">
                            <div id="validationServerUsernameFeedback" class="invalid-feedback nama_custmsg">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nomor Hp</label>
                            <input type="number" id="nohp" name="nohp" class="form-control nohp" placeholder="Masukan Nomor Nota Supplier">
                            <div id="validationServerUsernameFeedback" class="invalid-feedback nohpmsg">
                            </div>
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
</div>
</div>
<div class="modal fade" id="modal-supplier">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titlesupp">Tambah Data Supplier</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/insertsupp" name="insertsupp" id="insertsupp" class="insertsupp" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_supp" id="id_supp" value="">
                <div class="row" style="margin: 10px;">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Nama Supplier</label>
                            <input type="text" id="nama_supp" name="nama_supp" class="form-control nama_supp" placeholder="Masukan Nomor Nama Supplier">
                            <div id="validationServerUsernameFeedback" class="invalid-feedback nama_suppmsg">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Sales</label>
                            <input type="text" id="nama_sales" name="nama_sales" class="form-control nama_sales" placeholder="Masukan Nomor Hp">
                            <div id="validationServerUsernameFeedback" class="invalid-feedback nama_salesmsg">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nomor Hp Sales</label>
                            <input type="number" id="no_hp" name="no_hp" class="form-control no_hp" placeholder="Masukan Nomor Hp">
                            <div id="validationServerUsernameFeedback" class="invalid-feedback no_hpmsg">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nomor Hp Kantor</label>
                            <input type="number" id="no_ktr" name="no_ktr" class="form-control no_ktr" placeholder="Masukan Nomor Hp">
                            <div id="validationServerUsernameFeedback" class="invalid-feedback no_ktrmsg">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" id="alamat1" name="alamat1" class="form-control alamat1" placeholder="Masukan Nomor Alamat Supplier">
                            <div id="validationServerUsernameFeedback" class="invalid-feedback alamat1msg">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Kota</label>
                            <input type="text" id="kota1" name="kota1" class="form-control kota1" placeholder="Masukan Nomor Kota Supplier">
                            <div id="validationServerUsernameFeedback" class="invalid-feedback kota1msg">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btntambah" id="buttonsupp">Tambah</button>
            </form>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="modal-kadar">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titlekadar">Tambah Data Kadar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/insertkadar" name="insertkadar" id="insertkadar" class="insertkadar" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" id="id_kadar" name="id_kadar" value="">
                <div class="row" style="margin: 10px;">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Nama Kadar</label>
                            <input type="text" id="nama_kadar" name="nama_kadar" class="form-control nama_kadar" placeholder="Masukan Nomor Nama Supplier">
                            <div id="validationServerUsernameFeedback" class="invalid-feedback nama_kadarmsg">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nilai Kadar</label>
                            <input type="number" id="nilai_kadar" name="nilai_kadar" class="form-control nilai_kadar" placeholder="Masukan Nomor Hp">
                            <div id="validationServerUsernameFeedback" class="invalid-feedback nilai_kadarmsg">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btntambah" id="buttonkadar">Tambah</button>
            </form>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="modal-merek">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titlemerek">Tambah Data Merek</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/insertmerek" name="insertmerek" id="insertmerek" class="insertmerek" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" id="id_merek" name="id_merek" value="">
                <div class="row" style="margin: 10px;">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Nama Merek</label>
                            <input type="text" id="nama_merek" name="nama_merek" class="form-control nama_merek" placeholder="Masukan Nama Merek">
                            <div id="validationServerUsernameFeedback" class="invalid-feedback nama_merekmsg">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btntambah" id="buttonmerek">Tambah</button>
            </form>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="modal-bank">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titlebank">Tambah Data Merek</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/insertbank" name="insertbank" id="insertbank" class="insertbank" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_bank" id="id_bank" value="">
                <div class="row" style="margin: 10px;">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Nama Bank</label>
                            <input type="text" id="nama_bank" name="nama_bank" class="form-control nama_bank" placeholder="Masukan Nama Merek">
                            <div id="validationServerUsernameFeedback" class="invalid-feedback nama_bankmsg">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btntambah" id="buttonbank">Tambah</button>
            </form>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="modal-updatelg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Data Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/updatecust" name="updatecust" id="updatecust" class="updatecust" method="post">
                <?= csrf_field(); ?>
                <div class="row" style="margin: 10px;">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="hidden" id="id_cust" name="id_cust" value="">
                            <label>Nama Customer</label>
                            <input type="text" id="nama_custu" name="nama_custu" class="form-control nama_custu" placeholder="Masukan Nama Customer">
                            <div id="validationServerUsernameFeedback" class="invalid-feedback nama_custumsg">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nomor Hp</label>
                            <input type="number" id="nohpu" name="nohpu" class="form-control nohpu" placeholder="Masukan Nomor Hp" readonly>
                            <div id="validationServerUsernameFeedback" class="invalid-feedback nohpumsg">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" id="alamatu" name="alamatu" class="form-control" placeholder="Masukan Alamat">
                        </div>
                        <div class="form-group">
                            <label>Kota</label>
                            <input type="text" id="kotau" name="kotau" class="form-control" placeholder="Masukan Kota">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <!-- <button type="button" onclick="deletedata($('#id_cust').val(),'customer')" class="btn btn-danger btntambah">Hapus</button> -->
                    <button type="submit" class="btn btn-primary btntambah">Edit</button>
            </form>
        </div>
    </div>
</div>
</div>
<!-- /.modal-content -->
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<!-- Main Footer -->
<footer class="main-footer">

</footer>

<script>
    $('.insertsupp').submit(function(e) {
        e.preventDefault()
        let form = $('.insertsupp')[0];
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            data: data,
            url: "<?php echo base_url('insertsupp'); ?>",
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
                if (result.error) {
                    if (result.error.nama_supp) {
                        $('#nama_supp').addClass('is-invalid')
                        $('.nama_suppmsg').html(result.error.nama_supp)
                    } else {
                        $('#nama_supp').removeClass('is-invalid')
                        $('.nama_suppmsg').html('')
                    }
                    if (result.error.alamat) {
                        $('#alamat1').addClass('is-invalid')
                        $('.alamat1msg').html(result.error.alamat)
                    } else {
                        $('#alamat1').removeClass('is-invalid')
                        $('.alamat1msg').html('')
                    }
                    if (result.error.kota) {
                        $('#kota1').addClass('is-invalid')
                        $('.kota1msg').html(result.error.kota)
                    } else {
                        $('#nohp').removeClass('is-invalid')
                        $('.nohpmsg').html('')
                    }
                    if (result.error.nama_sales) {
                        $('#nama_sales').addClass('is-invalid')
                        $('.nama_salesmsg').html(result.error.nama_sales)
                    } else {
                        $('#nama_sales').removeClass('is-invalid')
                        $('.nama_salesmsg').html('')
                    }
                    if (result.error.no_hp) {
                        $('#no_hp').addClass('is-invalid')
                        $('.no_hpmsg').html(result.error.no_hp)
                    } else {
                        $('#nohp').removeClass('is-invalid')
                        $('.nohpmsg').html('')
                    }
                    if (result.error.no_ktr) {
                        $('#no_ktr').addClass('is-invalid')
                        $('.no_ktrmsg').html(result.error.no_ktr)
                    } else {
                        $('#no_ktr').removeClass('is-invalid')
                        $('.no_ktrmsg').html('')
                    }
                } else {
                    $('#nama_supp').removeClass('is-invalid')
                    $('.nama_suppmsg').html('')
                    $('#alamat1').removeClass('is-invalid')
                    $('.alamat1msg').html('')
                    $('#kota1').removeClass('is-invalid')
                    $('.kota1msg').html('')
                    $('#nama_sales').removeClass('is-invalid')
                    $('.nama_salesmsg').html('')
                    $('#no_hp').removeClass('is-invalid')
                    $('.no_hpmsg').html('')
                    $('#no_ktr').removeClass('is-invalid')
                    $('.no_ktrmsg').html('')

                    $('#modal-supplier').modal('toggle');
                    Swal.fire({
                        title: 'Berhasil',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok',
                    }).then((result) => {
                        location.reload();
                    })
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    })
    $('.insertkadar').submit(function(e) {
        e.preventDefault()
        let form = $('.insertkadar')[0];
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            data: data,
            url: "<?php echo base_url('insertkadar'); ?>",
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
                if (result.error) {
                    if (result.error.nilai_kadar) {
                        $('#nilai_kadar').addClass('is-invalid')
                        $('.nilai_kadarmsg').html(result.error.nilai_kadar)
                    } else {
                        $('#nilai_kadar').removeClass('is-invalid')
                        $('.nilai_kadarmsg').html('')
                    }
                    if (result.error.nama_kadar) {
                        $('#nama_kadar').addClass('is-invalid')
                        $('.nama_kadarmsg').html(result.error.nama_kadar)
                    } else {
                        $('#nama_kadar').removeClass('is-invalid')
                        $('.nama_kadarmsg').html('')
                    }
                } else {
                    $('#nilai_kadar').removeClass('is-invalid')
                    $('.nilai_kadarmsg').html('')
                    $('#nama_kadar').removeClass('is-invalid')
                    $('.nama_kadarmsg').html('')

                    $('#modal-kadar').modal('toggle');
                    Swal.fire({
                        title: 'Berhasil',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok',
                    }).then((result) => {
                        location.reload();
                    })
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    })
    $('.insertmerek').submit(function(e) {
        e.preventDefault()
        let form = $('.insertmerek')[0];
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            data: data,
            url: "<?php echo base_url('insertmerek'); ?>",
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
                if (result.error) {
                    if (result.error.nama_merek) {
                        $('#nama_merek').addClass('is-invalid')
                        $('.nama_merekmsg').html(result.error.nama_merek)
                    } else {
                        $('#nama_merek').removeClass('is-invalid')
                        $('.nama_merekmsg').html('')
                    }

                } else {
                    $('#nama_merek').removeClass('is-invalid')
                    $('.nama_merekmsg').html('')

                    $('#modal-merek').modal('toggle');
                    Swal.fire({
                        title: 'Berhasil',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok',
                    }).then((result) => {
                        location.reload();
                    })
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    })
    $('.insertbank').submit(function(e) {
        e.preventDefault()
        let form = $('.insertbank')[0];
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            data: data,
            url: "<?php echo base_url('insertbank'); ?>",
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
                if (result.error) {
                    if (result.error.nama_bank) {
                        $('#nama_bank').addClass('is-invalid')
                        $('.nama_bankmsg').html(result.error.nama_bank)
                    } else {
                        $('#nama_bank').removeClass('is-invalid')
                        $('.nama_bankmsg').html('')
                    }

                } else {
                    $('#nama_bank').removeClass('is-invalid')
                    $('.nama_bankmsg').html('')
                    Swal.fire({
                        title: 'Berhasil',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok',
                    }).then((result) => {
                        location.reload();
                    })
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    })
    $('.updatecust').submit(function(e) {
        e.preventDefault()
        let form = $('.updatecust')[0];
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            data: data,
            url: "<?php echo base_url('updatecust'); ?>",
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
                if (result.error) {
                    if (result.error.nohp) {
                        $('#nohpu').addClass('is-invalid')
                        $('.nohpumsg').html(result.error.nohp)
                    } else {
                        $('#nohpu').removeClass('is-invalid')
                        $('.nohpumsg').html('')
                    }
                    if (result.error.nama_cust) {
                        $('#nama_custu').addClass('is-invalid')
                        $('.nama_custumsg').html(result.error.nama_cust)
                    } else {
                        $('#nama_custu').removeClass('is-invalid')
                        $('.nama_custumsg').html('')
                    }
                } else {
                    $('#nohpu').removeClass('is-invalid')
                    $('.nohpumsg').html('')
                    $('#nama_custu').removeClass('is-invalid')
                    $('.nama_custumsg').html('')
                    Swal.fire({
                        title: 'Berhasil Edit',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok',
                    }).then((result) => {
                        location.reload();
                    })
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    })

    function OpenModalData(jenis) {
        if (jenis == 'supplier') {
            $('#titlesupp').html('Tambah Data Supplier')
            $('#buttonsupp').html('Tambah')
            $('#modal-supplier').modal('toggle')
        }
        if (jenis == 'kadar') {
            $('#titlekadar').html('Tambah Data Kadar')
            $('#buttonkadar').html('Tambah')
            $('#modal-kadar').modal('toggle')
        }
        if (jenis == 'merek') {
            $('#titlemerek').html('Tambah Data Merek')
            $('#buttonmerek').html('Tambah')
            $('#modal-merek').modal('toggle')
        }
        if (jenis == 'bank') {
            $('#titlebank').html('Tambah Data Bank')
            $('#buttonbank').html('Tambah')
            $('#modal-bank').modal('toggle')
        }
    }

    function Updatedata(id, jenis) {
        console.log(jenis)
        $.ajax({
            type: "get",
            data: {
                id: id,
                jenis: jenis,
            },
            url: "<?php echo base_url('isidata'); ?>",
            dataType: "json",
            success: function(result) {
                console.log(result)
                if (jenis == 'customer') {
                    $('#nama_custu').val(result.nama);
                    $('#alamatu').val(result.alamat_cust);
                    $('#nohpu').val(result.nohp_cust);
                    $('#kotau').val(result.kota_cust);
                    $('#id_cust').val(id);
                    $('#modal-updatelg').modal('toggle');
                }
                if (jenis == 'supplier') {
                    $('#nama_supp').val(result.nama_supp);
                    $('#nama_sales').val(result.sales_supp);
                    $('#no_hp').val(result.no_hp);
                    $('#no_ktr').val(result.no_ktr);
                    $('#alamat1').val(result.alamat_supp);
                    $('#kota1').val(result.kota_supp);
                    $('#id_supp').val(id);
                    $('#titlesupp').html('Update Data Supplier')
                    $('#buttonsupp').html('Update')
                    $('#modal-supplier').modal('toggle');
                }
                if (jenis == 'kadar') {
                    $('#nama_kadar').val(result.nama_kadar);
                    $('#nilai_kadar').val(result.nilai_kadar);
                    $('#id_kadar').val(id);
                    $('#titlekadar').html('Update Data Kadar')
                    $('#buttonkadar').html('Update')
                    $('#modal-kadar').modal('toggle');
                }
                if (jenis == 'merek') {
                    $('#nama_merek').val(result.nama_merek);
                    $('#id_merek').val(id);
                    $('#titlemerek').html('Update Data Merek')
                    $('#buttonmerek').html('Update')
                    $('#modal-merek').modal('toggle')
                }
                if (jenis == 'bank') {
                    $('#nama_bank').val(result.nama_bank);
                    $('#id_bank').val(id);
                    $('#titlebank').html('Update Data Bank')
                    $('#buttonbank').html('Update')
                    $('#modal-bank').modal('toggle')
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    $(document).ready(function() {
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
                    if (result.error) {
                        if (result.error.nohp_cust) {
                            $('#nohp').addClass('is-invalid')
                            $('.nohpmsg').html(result.error.nohp_cust)
                        } else {
                            $('#nohp').removeClass('is-invalid')
                            $('.nohpmsg').html('')
                        }
                        if (result.error.nama_cust) {
                            $('#nama_cust').addClass('is-invalid')
                            $('.nama_custmsg').html(result.error.nama_cust)
                        } else {
                            $('#nama_cust').removeClass('is-invalid')
                            $('.nama_custmsg').html('')
                        }
                    } else {
                        $('#nohp').removeClass('is-invalid')
                        $('.nohpmsg').html('')
                        $('#nama_cust').removeClass('is-invalid')
                        $('.nama_custmsg').html('')
                        $('#modal-lg').modal('toggle');
                        Swal.fire({
                            title: 'Berhasil',
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok',
                        }).then((result) => {
                            location.reload();
                        })
                    }

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        })
    })
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "aaSorting": []
            //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis", ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

    $("#merek").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "aaSorting": []
        //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis", ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $("#bank").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "aaSorting": []
        //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis", ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $("#kadar").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "aaSorting": []
        //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis", ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $("#supplier").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "aaSorting": []
        //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis", ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
</script>
<?= $this->endSection(); ?>