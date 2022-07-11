<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<style>
    .table>tbody>tr>* {
        vertical-align: middle;
        text-align: center;
    }

    /* table,
    th,
    td {
        border: 1px solid;
    } */

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
                    <h1 class="m-0">Data Kartu Stock Barang Dagang</h1>
                </div><!-- /.col -->
                <!-- /.content-header -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Data barang</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Filter Kode</label>
                                        <select name="kode" onchange="TampilKartu()" class="form-control" id="kode" name="kode">
                                            <option value="0" selected>10 Terbaru</option>
                                            <option value="6">Semua Data</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Filter Stock</label>
                                        <select name="stock" onchange="TampilKartu()" class="form-control" id="stock" name="stock">
                                            <option value="0">Semua</option>
                                            <option value="1">Belum Jual</option>
                                            <option value="2">Terjual</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Search Kode</label>
                                        <input name="searchkode" onfocus="this.select()" oninput="TampilKartu()" class="form-control" id="searchkode" name="searchkode" placeholder="Masukan Kode Barang">
                                        <div id="validationServerUsernameFeedback" class="invalid-feedback searchkodemsg">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <a type="button" href="#" onclick="TampilKartu()"><i class="fa fa-undo"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header ">
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table" id="tablekartu">
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
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
<div class="viewmodal" style="display: none;"></div>
<script>
    function openmodal(kode) {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('modaldetailkartustock'); ?>",
            data: {
                kode: kode,
                kel: 6
            },
            beforeSend: function() {
                Swal.fire({
                    html: 'Please wait...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });
            },
            success: function(result) {
                $('.viewmodal').html(result.modal).show();
                $('#title').html('Detail Kartu Stock ' + kode)
                $('#modal-xl').modal('show');
                $(document).ready(function() {
                    swal.close()
                })
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })

    }

    function TampilKartu() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('tampildatakartu'); ?>",
            data: {
                kode: $('#kode').val(),
                stock: $('#stock').val(),
                barcode: $('#searchkode').val(),
                kel: 6
            },
            beforeSend: function() {
                Swal.fire({
                    html: 'Please wait...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });
            },
            success: function(result) {
                $('#tablekartu').html(result.datakartu)
                $(document).ready(function() {
                    swal.close()
                })
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    $(document).ready(function() {
        TampilKartu()
    })
</script>
<?= $this->endSection(); ?>