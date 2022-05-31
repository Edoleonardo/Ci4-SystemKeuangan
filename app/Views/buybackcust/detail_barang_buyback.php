<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Detail Barang Buyback</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/databarang">Data barang</a></li>
            <li class="breadcrumb-item active">Detail barang</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card card-solid">
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-sm-6">
            <div class="col-12">
              <img src="/img/<?= $barang['nama_img'] ?>" class="product-image" alt="Product Image">
            </div>
            <div class="col-12 product-image-thumbs">
              <div class="product-image-thumb active"><img src="/img/<?= $barang['nama_img'] ?>" alt="Product Image">
              </div>
              <!-- <div class="product-image-thumb"><img src="../../dist/img/prod-2.jpg" alt="Product Image"></div>
              <div class="product-image-thumb"><img src="../../dist/img/prod-3.jpg" alt="Product Image"></div>
              <div class="product-image-thumb"><img src="../../dist/img/prod-4.jpg" alt="Product Image"></div>
              <div class="product-image-thumb"><img src="../../dist/img/prod-5.jpg" alt="Product Image"></div> -->
            </div>
            <table class="table table-striped">
              <tbody>
                <tr>
                  <td>Pembayaran</td>
                  <td><?= $barang['cara_pembayaran'] ?></td>
                </tr>
                <?php if ($barang['nama_bank']) : ?>
                  <tr>
                    <td>Nama Bank</td>
                    <td><?= $barang['nama_bank'] ?></td>
                  </tr>
                <?php endif ?>
                <?php if ($barang['tunai']) : ?>
                  <tr>
                    <td>Tunai</td>
                    <td><?= number_format($barang['tunai'], 2, ',', '.') ?></td>
                  </tr>
                <?php endif ?>
                <?php if ($barang['transfer']) : ?>
                  <tr>
                    <td>Transfer</td>
                    <td><?= number_format($barang['transfer'], 2, ',', '.') ?></td>
                  </tr>
                <?php endif ?>
              </tbody>
            </table>
          </div>
          <div class="col-12 col-sm-6">
            <h3 class="my-3"><?= $barang['jenis'] . ' ' . $barang['model'] . ' ' . $barang['keterangan'] . ' ' . $barang['merek'] ?></h3>
            <div class="card">
              <div class="card-body table-responsive p-0">
                <table class="table text-nowrap">
                  <tr>
                    <td>Tanggal Input :</td>
                    <td>
                      <?= $barang['created_at'] ?>
                    </td>
                    <td>Qty :</td>
                    <td>
                      <?= $barang['qty'] ?>
                    </td>
                  </tr>
                  <tr>
                    <td>Jenis Barang :</td>
                    <td>
                      <?= $barang['jenis'] ?>
                    </td>
                    <td>Satus :</td>
                    <td style="background-color: lightblue;">
                      <?= $barang['status_proses'] ?> <?= ($barang['no_nota_jual']) ? $barang['no_nota_jual'] : '' ?>
                    </td>
                  </tr>
                  <tr>
                    <td>Model Barang :</td>
                    <td>
                      <?= $barang['model'] ?>
                    </td>
                    <td>Keterangan Barang :</td>
                    <td>
                      <?= $barang['keterangan'] ?>
                    </td>
                  </tr>
                  <tr>
                    <td>Merek Barang :</td>
                    <td>
                      <?= $barang['merek'] ?>
                    </td>
                    <td>Kadar Barang :</td>
                    <td>
                      <?= $barang['kadar'] ?>
                    </td>
                  </tr>
                  <tr>
                    <td>Berat :</td>
                    <td>
                      <?= $barang['berat'] ?>
                    </td>
                    <td>Berat Murni :</td>
                    <td>
                      <?= $barang['berat_murni'] ?>
                    </td>
                  </tr>
                  <tr>
                    <td>Nilai Tukar :</td>
                    <td>
                      <?= $barang['nilai_tukar'] ?> %
                    </td>
                    <td>Ongkos :</td>
                    <td>
                      <?= number_format($barang['ongkos'], 2, ',', '.') ?>
                    </td>
                  </tr>
                  <tr>
                    <td>Harga Beli :</td>
                    <td>
                      <?= number_format($barang['harga_beli'], 2, ',', '.') ?>
                    </td>
                    <td>Total Harga Murni :</td>
                    <td>
                      <?= number_format($barang['total_harga'], 2, ',', '.') ?>
                    </td>
                  </tr>
                  <tr>
                    <td>Barcode :</td>
                    <td>
                      <div>
                        <a href="/print/<?= $barang['id_detail_buyback'] ?>" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> <br> <?= $barcode ?></a>
                        </h4>
                      </div>
                    </td>
                    <td>Nomor Nota</td>
                    <td><?= ($barang['no_nota_jual']) ? $barang['no_nota_jual'] : 'Tanpa Nota' ?></td>
                  </tr>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <div class="mt-4">
              <div class="btn btn-primary btn-lg btn-flat">
                <i class="fas fa-edit fa-lg mr-2"></i>
                Edit Barang
              </div>
              <div class="btn btn-default btn-lg btn-flat">
                <i class="fas fa-trash fa-lg mr-2"></i>
                Delete Barang
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="row mt-4">
          <nav class="w-100">
            <div class="nav nav-tabs" id="product-tab" role="tablist">
              <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
              <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Comments</a>
              <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Rating</a>
            </div>
          </nav>
          <div class="tab-content p-3" id="nav-tabContent">
            <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus. Duis varius finibus purus sed venenatis. Vivamus varius metus quam, id dapibus velit mattis eu. Praesent et semper risus. Vestibulum erat erat, condimentum at elit at, bibendum placerat orci. Nullam gravida velit mauris, in pellentesque urna pellentesque viverra. Nullam non pellentesque justo, et ultricies neque. Praesent vel metus rutrum, tempus erat a, rutrum ante. Quisque interdum efficitur nunc vitae consectetur. Suspendisse venenatis, tortor non convallis interdum, urna mi molestie eros, vel tempor justo lacus ac justo. Fusce id enim a erat fringilla sollicitudin ultrices vel metus. </div>
            <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum. </div>
            <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab"> Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. Donec varius massa at semper posuere. Integer finibus orci vitae vehicula placerat. </div>
          </div>
        </div> -->
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- Main Footer -->
<footer class="main-footer">

</footer>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<?= $this->endSection(); ?>