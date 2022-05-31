<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
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
                    <h1 class="m-0">Data Barang Cuci</h1>
                </div><!-- /.col -->
                <!-- /.content-header -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Barang Cuci</li>
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
                                <div class="col-2">
                                    <div class="form-group">
                                        <a class="btn btn-app" href="/cucibarang">
                                            <i class="fas fa-plus"></i> Cuci Barang
                                        </a>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>Filter Data</label>
                                        <select name="tampil" onchange="TampilCuci()" class="form-control" id="tampil" name="tampil">
                                            <option value="10" selected>10 Data</option>
                                            <option value="100">100 Data</option>
                                            <option value="1000">1000 Data</option>
                                            <option value="semua">Semua Data</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>Search NoTrans</label>
                                        <input name="notrans" onfocus="this.select()" oninput="TampilCuci()" class="form-control" id="notrans" name="notrans" placeholder="Masukan Nomor Transaksi">
                                        <div id="validationServerUsernameFeedback" class="invalid-feedback notransmsg">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <a type="button" href="#" onclick="TampilCuci()"><i class="fa fa-undo"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body table" id="tampildatacuci">

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
<script>
    function TampilCuci() {
        $.ajax({
            type: "get",
            url: "<?php echo base_url('tampildatacuci'); ?>",
            dataType: "json",
            data: {
                tmpildata: $('#tampil').val(),
                status: $('#status').val(),
                kelompok: $('#kelompok').val(),
                notrans: $('#notrans').val(),
            },
            success: function(result) {
                $('#tampildatacuci').html(result.tampildata)
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }
    $(function() {
        TampilCuci()
    });
</script>
<?= $this->endSection(); ?>