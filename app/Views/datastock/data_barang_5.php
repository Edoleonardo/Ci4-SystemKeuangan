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
          <h1 class="m-0">Data Barang Loose Diamond</h1>
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
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Tampil Data</label>
                    <select name="tmpildata" onchange="TampilBarang()" class="form-control" id="tmpildata" name="tmpildata">
                      <option value="10" selected>10</option>
                      <option value="100">100</option>
                      <option value="1000">1000</option>
                      <option value="semua">Semua</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Filter Stock</label>
                    <select name="stock" onchange="TampilBarang()" class="form-control" id="stock" name="stock">
                      <option value="0">Semua</option>
                      <option value="1">Belum Jual</option>
                      <option value="2">Terjual</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Search Kode</label>
                    <input name="searchkode" onfocus="this.select()" oninput="TampilBarang()" class="form-control" id="searchkode" name="searchkode" placeholder="Masukan Kode Barang">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback searchkodemsg">
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <a type="button" href="#" onclick="TampilBarang()"><i class="fa fa-undo"></i></a>
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
        tmpildata: $('#tmpildata').val(),
        stock: $('#stock').val(),
        searchkode: $('#searchkode').val(),
        kel: 5
      },
      beforeSend: function() {
        Swal.fire({

          html: 'Please wait...',
          allowEscapeKey: false,
          allowOutsideClick: false,
          didOpen: () => {
            Swal.showLoading()
          }
        });
      },
      success: function(result) {
        $('#datatable').html(result.databarang)
        $(document).ready(function() {
          swal.close()
        })
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