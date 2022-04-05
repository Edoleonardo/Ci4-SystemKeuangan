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
            <div class="card-body">
              <div class="row">
                <div class="col-3">
                  <div class="form-group">
                    <label>Filter Kode</label>
                    <select name="kode" onchange="TampilBarang()" class="form-control" id="kode" name="kode">
                      <option value="0" selected>Terbaru</option>
                      <option value="1">Perhiasan Mas</option>
                      <option value="2">Perhiasan Berlian</option>
                      <option value="3">Logam Mulia (Antam, UBS, HWT)</option>
                      <option value="4">Bahan Murni</option>
                      <option value="5">Loose Diamond</option>
                      <option value="6">Barang Dagang</option>
                    </select>
                  </div>
                </div>
                <div class="col-3">
                  <div class="form-group">
                    <label>Filter Stock</label>
                    <select name="stock" onchange="TampilBarang()" class="form-control" id="stock" name="stock">
                      <option value="0">Semua</option>
                      <option value="1">Belum Jual</option>
                      <option value="2">Terjual</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body table">
              <div id="datatable">
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
  function TampilBarang() {
    $.ajax({
      type: "GET",
      dataType: "json",
      url: "<?php echo base_url('tampildatabarang'); ?>",
      data: {
        kode: $('#kode').val(),
        stock: $('#stock').val(),
      },
      success: function(result) {
        $('#datatable').html(result.databarang)

      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
    })
  }

  $(document).ready(function() {
    TampilBarang()
  })
</script>
<?= $this->endSection(); ?>