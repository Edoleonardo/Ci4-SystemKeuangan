<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
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
              <button class="btn btn-app" data-toggle="modal" data-target="#modal-xl">
                <i class="fas fa-plus"></i> Barang Baru
              </button>
              <a class="btn btn-app">
                <i class="fas fa-print"></i> Print Barcode
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
                  <?php foreach ($barang as $r) : ?>
                    <tr>
                      <td><img src="/img/<?= $r['gambar'] ?>" style="width : 100px" alt=""></td>
                      <td><?= $r['barcode'] ?></td>
                      <td><?= $r['jenis'] ?></td>
                      <td><?= $r['model'] ?></td>
                      <td><?= $r['qty'] ?></td>
                      <td><?= $r['kadar'] ?></td>
                      <td>
                        <a type="button" href="detail/<?= $r['id_stock'] ?>" class="btn btn-block btn-outline-info btn-sm">Detail</a>
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

<!-- modall -->
<div class="modal fade" id="modal-xl">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 style="text-align: center;">Form Barang Baru</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- form -->
        <!-- /.card-header -->
        <!-- form start -->
        <form action="/home/save" method="POST" enctype="multipart/form-data">
          <?= csrf_field(); ?>
          <div class="card-body">
            <div class="form-group">
              <label for="NamaBarang">Nama Barang</label>
              <input type="text" class="form-control" id="namabarang" name="namabarang" value="<?= old('namabarang'); ?>" placeholder="Masukan Barang">
            </div>
            <div class="form-group">
              <label for="idbarcode">Id Barcode</label>
              <input type="text" class="form-control" id="idbarcode" name="idbarcode" value="<?= old('idbarcode'); ?>" placeholder="Masukan ID Barcode">
            </div>
            <div class="form-group">
              <label for="jenisbarang">Jenis Barang</label>
              <input type="text" class="form-control" id="jenisbarang" name="jenisbarang" value="<?= old('jenisbarang'); ?>" placeholder="Masukan Jenis Barang">
            </div>
            <div class="form-group">
              <label for="jumlahbarang">Jumlah Barang</label>
              <input type="number" class="form-control" id="jumlahbarang" name="jumlahbarang" value="<?= old('jumlahbarang'); ?>" placeholder="Masukan Jumlah Barang">
            </div>
            <div class="form-group">
              <label for="beratbarang">Berat Barang / gram</label>
              <input type="number" class="form-control" id="beratbarang" name="beratbarang" value="<?= old('beratbarang'); ?>" placeholder="Masukan Berat Barang">
            </div>
            <div class="form-group">
              <label for="hargabarang">Harga Barang</label>
              <input type="number" class="form-control" id="hargabarang" name="hargabarang" value="<?= old('hargabarang'); ?>" placeholder="Masukan Harga Barang">
            </div>
            <div class="form-group">
              <label for="gambar">Masukan Foto</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="gambar" id="gambar">
                  <label class="custom-file-label" for="gambar">Masukan Foto</label>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- tutup modal -->

<!-- Main Footer -->
<footer class="main-footer">

</footer>
<?= $this->endSection(); ?>