<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<style>
    #tbldata {
        vertical-align: middle;
        text-align: center;
    }

    table,
    th,
    td {
        border: 1px solid;
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
                    <h1 class="m-0">Data Barang</h1>
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
                        <div class="card-header ">
                            <input type="number" placeholder="filter kode">
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table">
                            <table id="example1" class="table table-bordered table-striped tableasd">
                                <thead id="tbldata">
                                    <tr>
                                        <th>Id Barcode</th>
                                        <th>Total Masuk</th>
                                        <th>Total Keluar</th>
                                        <th>Saldo Akhir</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($kartustock as $r) :  ?>
                                        <tr>
                                            <td><?= $r['kode'] ?></td>
                                            <td><?= $r['total_masuk'] ?></td>
                                            <td><?= $r['total_keluar'] ?></td>
                                            <td><?= $r['saldo_akhir'] ?></td>
                                            <td>
                                                <a type="button" onclick="openmodal(<?= $r['kode'] ?>)" class="btn btn-block btn-outline-info btn-sm">Detail</a>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id Barcode</th>
                                        <th>Total Masuk</th>
                                        <th>Total Keluar</th>
                                        <th>Saldo Akhir</th>
                                        <th>Detail</th>
                                    </tr>
                                </tfoot>
                            </table>
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
            },
            success: function(result) {
                console.log(result)
                $('.viewmodal').html(result.modal).show();
                $('#title').html('Detail Kartu Stock ' + kode)
                $('#modal-xl').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })

    }
</script>
<?= $this->endSection(); ?>