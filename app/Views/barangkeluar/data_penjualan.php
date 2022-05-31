<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
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
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Penjualan</h1>
                </div><!-- /.col -->
                <!-- /.content-header -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Pembelian Supplier</li>
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
                                        <a class="btn btn-app" href="/jualbarang">
                                            <i class="fas fa-plus"></i> Jual Barang
                                        </a>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>Filter Data</label>
                                        <select name="tampil" onchange="TampilBarang()" class="form-control" id="tampil" name="tampil">
                                            <option value="10" selected>10 Data</option>
                                            <option value="100">100 Data</option>
                                            <option value="1000">1000 Data</option>
                                            <option value="semua">Semua Data</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>Filter Kelompok</label>
                                        <select name="kelompok" onchange="TampilBarang()" class="form-control" id="kelompok" name="kelompok">
                                            <option value="semua">Semua Data</option>
                                            <option value="1">Perhiasan Emas</option>
                                            <option value="2">Perhiasan Berlian</option>
                                            <option value="3">Emas LM</option>
                                            <option value="4">Bahan Murni</option>
                                            <option value="5">Loose Diamond</option>
                                            <option value="6">Barang Dagang</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>Filter Status</label>
                                        <select name="status" onchange="TampilBarang()" class="form-control" id="status" name="status">
                                            <option value="semua">Semua Data</option>
                                            <option value="Bayar Nanti">Bayar Nanti</option>
                                            <option value="Lunas">Lunas</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>Search NoTrans</label>
                                        <input name="notrans" onfocus="this.select()" oninput="TampilBarang()" class="form-control" id="notrans" name="notrans" placeholder="Masukan Nomor Transaksi">
                                        <div id="validationServerUsernameFeedback" class="invalid-feedback notransmsg">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <a type="button" href="#" onclick="TampilBarang()"><i class="fa fa-undo"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body table" id="tampildata">

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
<div id="openmodaldetail"></div>
<script>
    function TampilBarang() {
        $.ajax({
            type: "get",
            url: "<?php echo base_url('tampilpenjualan'); ?>",
            dataType: "json",
            data: {
                tmpildata: $('#tampil').val(),
                status: $('#status').val(),
                kelompok: $('#kelompok').val(),
                notrans: $('#notrans').val(),
            },
            success: function(result) {
                console.log(result)
                $('#tampildata').html(result.tampildata)

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function OpenModalDetail(no_id) {
        $.ajax({
            type: "get",
            url: "<?php echo base_url('modaldetail'); ?>",
            dataType: "json",
            data: {
                no_id: no_id
            },
            success: function(result) {
                if (result.error) {
                    console.log(result.error);
                } else {
                    $('#openmodaldetail').html(result.modaldetail)
                    $('#modal-modal').modal('toggle')
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }
    $(document).ready(function() {
        TampilBarang()
    })
</script>
<?= $this->endSection(); ?>