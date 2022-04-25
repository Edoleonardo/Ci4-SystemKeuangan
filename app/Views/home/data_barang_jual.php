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
            <!-- <div class="card-header ">
              <button class="btn btn-app" data-toggle="modal" data-target="#modal-xl">
                <i class="fas fa-plus"></i> Barang Baru
              </button>
              <a class="btn btn-app">
                <i class="fas fa-print"></i> Print Barcode
              </a>
            </div> -->
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
                  <?php foreach ($barang as $r) : ?>
                    <tr>
                      <td class="imgg"><img class="imgg" src="/img/<?= $r['gambar'] ?>" alt=""></td>
                      <td><?= $r['barcode'] ?></td>
                      <td><?= $r['jenis'] ?></td>
                      <td><?= $r['model'] ?></td>
                      <td><?= $r['qty'] ?></td>
                      <td><?= $r['kadar'] ?></td>
                      <td>
                        <a type="button" href="detail/<?= $r['id_stock_1'] ?>" class="btn btn-block btn-outline-info btn-sm">Detail</a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Gambar</th>
                    <th>Id Barcode</th>
                    <th>Nama barang</th>
                    <th>Jenis Barang</th>
                    <th>Stock</th>
                    <th>Harga</th>
                    <th>Asksi</th>
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
  // let timerInterval
  // Swal.fire({
  //   title: 'Auto close alert!',
  //   html: 'I will close in <b></b> milliseconds.',
  //   timer: 2000,
  //   timerProgressBar: true,
  //   didOpen: () => {
  //     Swal.showLoading()
  //     const b = Swal.getHtmlContainer().querySelector('b')
  //     timerInterval = setInterval(() => {
  //       b.textContent = Swal.getTimerLeft()
  //     }, 100)
  //   },
  //   willClose: () => {
  //     clearInterval(timerInterval)
  //   }
  // }).then((result) => {
  //   /* Read more about handling dismissals below */
  //   if (result.dismiss === Swal.DismissReason.timer) {
  //     console.log('I was closed by the timer')
  //   }
  // })
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