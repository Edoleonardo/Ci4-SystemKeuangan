<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Detail Barang</h1>
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
            <h3 class="d-inline-block d-sm-none"><?= $barang['jenis'] . ' ' . $barang['keterangan'] . ' ' . $barang['merek']  ?></h3>
            <div class="col-12">
              <img src="/img/<?= $barang['gambar'] ?>" class="product-image" alt="Product Image">
            </div>
            <div class="col-12 product-image-thumbs">
              <div class="product-image-thumb active"><img src="/img/<?= $barang['gambar'] ?>" alt="Product Image"></div>
              <!-- <div class="product-image-thumb"><img src="../../dist/img/prod-2.jpg" alt="Product Image"></div>
              <div class="product-image-thumb"><img src="../../dist/img/prod-3.jpg" alt="Product Image"></div>
              <div class="product-image-thumb"><img src="../../dist/img/prod-4.jpg" alt="Product Image"></div>
              <div class="product-image-thumb"><img src="../../dist/img/prod-5.jpg" alt="Product Image"></div> -->
            </div>
          </div>
          <div class="col-12 col-sm-6">
            <h3 class="my-3"><?= $barang['jenis'] . ' ' . $barang['keterangan'] . ' ' . $barang['merek'] ?></h3>
            <!--<p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</p>
            <hr>
            <h4>Berat Barang</h4>
            <div class="text" data-toggle="buttons">
              <label style="font-size: 20px;" class="text-center">Bersih : <?= $barang['berat_bersih'] ?></label> <br>
              <label style="font-size: 20px;" class="text-center">Kotor : <?= $barang['berat_bersih'] ?></label>
            </div>
            <h4>Jumlah Stock</h4>
            <div class="text-xl" data-toggle="buttons">
              <label class="text-center"><?= $barang['qty'] ?></label>
            </div>
            <h4 class="mt-3">Barcode</h4>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <div>
                <a href="/print/<?= $barang['id_stock'] ?>" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> <br> <?= $barcode ?></a>
                </h4>
              </div>
            </div>
            <div class="bg-gray py-2 px-3 mt-4">
              <h2 class="mb-0">
                Harga : Rp <?= number_format($barang['ongkos/harga']) ?>
              </h2> -->
            <!-- <h4 class="mt-0">
                <small>Ex Tax: $80.00 </small>
              </h4> -->
            <!-- </div> -->
            <!-- /.card-header -->
            <div class="card">

              <div class="card-body p-0">
                <table class="table table-striped">
                  <tbody>
                    <tr>
                      <td>Satus</td>
                      <td>
                        <?= $barang['status'] ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Tanggal Faktur</td>
                      <td>
                        <?= $barang['tgl_faktur'] ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Tanggal Input</td>
                      <td>
                        <?= $barang['created_at'] ?>
                      </td>
                    </tr>
                    <tr>
                      <td>No faktur</td>
                      <td>
                        <?= $barang['no_faktur'] ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Qty</td>
                      <td>
                        <?= $barang['qty'] ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Jenis Barang</td>
                      <td>
                        <?= $barang['jenis'] ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Model Barang</td>
                      <td>
                        <?= $barang['model'] ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Keterangan Barang</td>
                      <td>
                        <?= $barang['keterangan'] ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Merek Barang</td>
                      <td>
                        <?= $barang['merek'] ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Kadar Barang</td>
                      <td>
                        <?= $barang['kadar'] ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Berat Bersih</td>
                      <td>
                        <?= $barang['berat_bersih'] ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Berat Kotor</td>
                      <td>
                        <?= $barang['berat_kotor'] ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Nilai Tukar</td>
                      <td>
                        <?= $barang['nilai_tukar'] ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Ongkos / Harga</td>
                      <td>
                        <?= $barang['ongkos/harga'] ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Kode Beli</td>
                      <td>
                        <?= $barang['kode_beli'] ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Barcode</td>
                      <td>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                          <div>
                            <a href="/print/<?= $barang['id_stock'] ?>" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> <br> <?= $barcode ?></a>
                            </h4>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
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

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer">

</footer>
<?= $this->endSection(); ?>