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
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <a class="btn btn-app" href="#" data-toggle="modal" data-target="#modal-lg">
                                            <i class="fas fa-plus"></i> Retur Barang
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Filter Data</label>
                                        <select name="tampil" onchange="TampilRetur()" class="form-control" id="tampil" name="tampil">
                                            <option value="10" selected>10 Data</option>
                                            <option value="100">100 Data</option>
                                            <option value="1000">1000 Data</option>
                                            <option value="semua">Semua Data</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Search NoTrans</label>
                                        <input name="notrans" onfocus="this.select()" oninput="TampilRetur()" class="form-control" id="notrans" name="notrans" placeholder="Masukan Nomor Transaksi">
                                        <div id="validationServerUsernameFeedback" class="invalid-feedback notransmsg">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <a type="button" href="#" onclick="TampilRetur()"><i class="fa fa-undo"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body table" id="tampildataretur">
                        </div>
                    </div>
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
                                            <th>Total Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($datapembelian as $row) : ?>
                                            <tr class="masukretur" onclick="MasukRetur(<?= $row['id_pembelian'] ?>)">
                                                <td><?= $row['no_transaksi'] ?></td>
                                                <td><?= $row['nama_supp'] ?></td>
                                                <td><?= substr($row['tgl_faktur'], 0, 10) ?></td>
                                                <td><?= substr($row['tgl_jatuh_tempo'], 0, 10) ?></td>
                                                <td><?= number_format($row['byr_barang'], 0, ',', '.') ?></td>
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
    function TampilRetur() {
        $.ajax({
            type: "get",
            url: "<?php echo base_url('tampildataretur'); ?>",
            dataType: "json",
            data: {
                tmpildata: $('#tampil').val(),
                status: $('#status').val(),
                kelompok: $('#kelompok').val(),
                notrans: $('#notrans').val(),
            },
            success: function(result) {
                $('#tampildataretur').html(result.tampildata)

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    $(function() {
        TampilRetur()
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