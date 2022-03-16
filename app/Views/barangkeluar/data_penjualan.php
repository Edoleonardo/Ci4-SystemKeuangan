<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
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
                                        <th>Nomor Penjualan</th>
                                        <th>Tanggal Terjual</th>
                                        <th>Nomor Hp Customer</th>
                                        <th>Total Harga</th>
                                        <th>Pembayaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($datapenjualan as $row) : ?>
                                        <tr>
                                            <td><?= $row['no_transaksi_jual'] ?></td>
                                            <td><?= date("d-m-Y", strtotime($row['created_at'])); ?></td>
                                            <td><?= $row['nohp_cust'] ?></td>
                                            <td><?= number_format($row['total_harga']) ?></td>
                                            <td><?= $row['pembayaran'] ?></td>
                                            <td>
                                                <?php if ($row['status_dokumen'] == 'Draft') { ?>
                                                    <a type="button" href="draftpenjualan/<?= $row['id_date_penjualan'] ?>" class="btn btn-block btn-outline-danger btn-sm"><?= $row['status_dokumen'] ?></a>
                                                <?php } else { ?>
                                                    <a type="button" href="/detailpenjualan/<?= $row['id_date_penjualan'] ?>" class="btn btn-block btn-outline-info btn-sm">Detail</a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nomor Penjualan</th>
                                        <th>Tanggal Terjual</th>
                                        <th>Customer</th>
                                        <th>Total Harga</th>
                                        <th>Pembayaran</th>
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