<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<style>
    .table {
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
                        <li class="breadcrumb-item active">Barang Retur</li>
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
                            <a class="btn btn-app" href="#" data-toggle="modal" data-target="#modal-lg">
                                <i class="fas fa-plus"></i> Retur Barang
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table">
                            <table id="example1" class="table table-bordered table-striped tableasd">
                                <thead>
                                    <tr>
                                        <th>Nomor Retur</th>
                                        <th>Jumlah Barang</th>
                                        <th>Berat Murni</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dataretur as $row) : ?>
                                        <tr>
                                            <td><?= $row['no_retur'] ?></td>
                                            <td><?= $row['jumlah_barang'] ?></td>
                                            <td><?= $row['total_berat'] ?></td>
                                            <td>
                                                <?php if ($row['status_dokumen'] == 'Draft') : ?>
                                                    <a type="button" href="draftretur/<?= $row['id_date_retur'] ?>" class="btn btn-block btn-outline-danger btn-sm">Draft</a>
                                                <?php else : ?>
                                                    <a type="button" href="draftretur/<?= $row['id_date_retur'] ?>" class="btn btn-block btn-outline-info btn-sm">Detail</a>
                                                <?php endif ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Jumlah Barang</th>
                                        <th>Berat Murni</th>
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
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pilih Data Pembelian</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table id="pembelian1" class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No Transaksi</th>
                                            <th>Supplier</th>
                                            <th>Tanggal Faktur</th>
                                            <th>Jatuh Tempo</th>
                                            <th>Bayar Berat Murni</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($datapembelian as $row) : ?>
                                            <tr class="masukretur" onclick="MasukRetur(<?= $row['id_pembelian'] ?>)">
                                                <td><?= $row['no_transaksi'] ?></td>
                                                <td><?= $row['nama_supp'] ?></td>
                                                <td><?= substr($row['tgl_faktur'], 0, 10) ?></td>
                                                <td><?= substr($row['tgl_jatuh_tempo'], 0, 10) ?></td>
                                                <td><?= $row['byr_berat_murni'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <!-- <button type="submit" class="btn btn-primary btntambah">Selesai</button> -->
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<!-- Main Footer -->
<footer class="main-footer">

</footer>
<script>
    function MasukRetur(id) {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('returbarang'); ?>",
            data: {
                idbeli: id,
            },
            beforeSend: function() {
                $(".masukretur").attr('onclick', ' ')
            },
            // complete: function() {
            //     $('.btntambah').html('Tambah')
            // },
            success: function(result) {
                if (result.success) {
                    window.location.href = "/draftretur/" + result.dateid
                }
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

        $("#pembelian1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "aaSorting": []
            //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis", ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
<?= $this->endSection(); ?>