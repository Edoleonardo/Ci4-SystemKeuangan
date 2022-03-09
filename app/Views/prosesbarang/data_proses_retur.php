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
                    <h1 class="m-0">Data Barang Retur</h1>
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
                        <div class="card-header ">
                            <a class="btn btn-app" href="/jualbarang">
                                <i class="fas fa-plus"></i> Jual Barang
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table">
                            <table id="example1" class="table table-bordered table-striped tableasd">
                                <thead>
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Id Barcode</th>
                                        <th>Jenis</th>
                                        <th>model</th>
                                        <th>qty</th>
                                        <th>kadar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dataretur as $row) : ?>
                                        <tr>
                                            <td class="imgg"><img class="imgg" src="/img/<?= $row['nama_img'] ?>"></td>
                                            <td><?= $row['kode'] ?></td>
                                            <td><?= $row['jenis'] ?></td>
                                            <td><?= $row['model'] ?></td>
                                            <td><?= $row['qty'] ?></td>
                                            <td><?= $row['kadar'] ?></td>
                                            <td>
                                                <a type="button" href="detailbuyback/<?= $row['id_detail_buyback'] ?>" class="btn btn-block btn-outline-info btn-sm">Detail</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Id Barcode</th>
                                        <th>Jenis</th>
                                        <th>model</th>
                                        <th>qty</th>
                                        <th>kadar</th>
                                        <th>Aksi</th>
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
<?= $this->endSection(); ?>