<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<script type="text/javascript" src="/js/jquery.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
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
                    <h1 class="m-0">Data Buyback Customer</h1>
                </div><!-- /.col -->
                <!-- /.content-header -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/buybackcust">Home</a></li>
                        <li class="breadcrumb-item active">Buyback Customer</li>
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
                            <a class="btn btn-app" href="/halamanbuyback">
                                <i class="fas fa-plus"></i> Tambah Buyback
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div id="refrestbl">
                            <div class="card-body table ">
                                <table id="example1" class="table table-bordered table-striped tableasd">
                                    <thead>
                                        <tr>
                                            <th>Nomor Buyback</th>
                                            <th>Tanggal Buyback</th>
                                            <th>Total Berat</th>
                                            <th>Total Harga</th>
                                            <th>Pembayaran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($databuyback as $row) : ?>
                                            <tr>
                                                <td><?= $row['no_transaksi_buyback'] ?></td>
                                                <td><?= date("d-m-Y", strtotime($row['created_at'])); ?></td>
                                                <td><?= $row['total_berat'] ?></td>
                                                <td><?= number_format($row['total_harga']) ?></td>
                                                <td><?= $row['pembayaran'] ?></td>
                                                <td>
                                                    <?php if ($row['status_dokumen'] == 'Draft') { ?>
                                                        <a type="button" href="draftbuyback/<?= $row['id_date_buyback'] ?>" class="btn btn-block btn-outline-danger btn-sm"><?= $row['status_dokumen'] ?></a>
                                                    <?php } else { ?>
                                                        <a type="button" href="/detailbuyback/<?= $row['id_date_buyback'] ?>" class="btn btn-block btn-outline-info btn-sm">Detail</a>
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
</script>
<?= $this->endSection(); ?>