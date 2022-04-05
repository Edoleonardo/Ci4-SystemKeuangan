<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Barang Masuk Supplier</h1>
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
              <a class="btn btn-app" href="/pembelian">
                <i class="fas fa-plus"></i> Barang Baru
              </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body table">
              <table id="example1" class="table table-bordered table-striped tableasd">
                <thead>
                  <tr>
                    <th>Tanggal Faktur</th>
                    <th>Nomor Transaksi</th>
                    <th>Tanggal Jatuh Tempo</th>
                    <th>Nomor Faktur</th>
                    <th>Total Bayar</th>
                    <th>Cara Pembayaran</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($datapembelian as $row) : ?>
                    <tr>
                      <td><?= date("d-m-Y", strtotime($row['tgl_faktur'])); ?></td>
                      <td><?= $row['no_transaksi'] ?></td>
                      <td><?= date("d-m-Y", strtotime($row['tgl_jatuh_tempo'])) ?></td>
                      <td><?= $row['no_faktur_supp'] ?></td>
                      <td><?= number_format($row['total_bayar']) ?></td>
                      <?php if ($row['cara_pembayaran'] == 'Lunas') : ?>
                        <td>
                          <?= $row['cara_pembayaran'] ?></td>
                        <td>
                        <?php elseif ($row['cara_pembayaran'] == 'Belum Selesai') : ?>
                        <td style="background-color: lightgoldenrodyellow;">
                          <?= $row['cara_pembayaran'] ?></td>
                        <td>
                        <?php else : ?>
                        <td style="background-color: lightcoral;">
                          <?= $row['cara_pembayaran'] ?></td>
                        <td>
                        <?php endif; ?>
                        <?php if ($row['status_dokumen'] == 'Draft') { ?>
                          <a type="button" href="draft/<?= $row['id_date_pembelian'] ?>" class="btn btn-block btn-outline-danger btn-sm"><?= $row['status_dokumen'] ?></a>
                        <?php } else { ?>
                          <a type="button" href="/detailpembelian/<?= $row['id_date_pembelian'] ?>" class="btn btn-block btn-outline-info btn-sm">Detail</a>
                        <?php } ?>
                        </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Tanggal Faktur</th>
                    <th>Nomor Transaksi</th>
                    <th>Tanggal Jatuh Tempo</th>
                    <th>Nomor Faktur</th>
                    <th>Total Bayar</th>
                    <th>Cara Pembayaran</th>
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
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "aaSorting": []
      //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis", ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
<?= $this->endSection(); ?>