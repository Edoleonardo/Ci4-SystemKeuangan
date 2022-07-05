<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Home</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= $totalbarang ?></h3>

              <p>Total Barang</p>
            </div>
            <div class="icon">
              <i class="fas fa-archive"></i>
            </div>
            <a href="#" class="small-box-footer" data-toggle="dropdown" aria-expanded="true">Print Statistik <i class=" fas fa-arrow-circle-right"></i></a>
            <div class="dropdown-menu" role="menu" x-placement="top-start">
              <a class="dropdown-item" href="#" onclick="ModalBarang(1)">Perhiasan Mas</a>
              <a class="dropdown-item" href="#" onclick="ModalBarang(2)">Perhiasan Berlian</a>
              <a class="dropdown-item" href="#" onclick="ModalBarang(3)">Emas LM</a>
              <a class="dropdown-item" href="#" onclick="ModalBarang(4)">Bahan Murni</a>
              <a class="dropdown-item" href="#" onclick="ModalBarang(5)">Perhiasan Berlian</a>
              <a class="dropdown-item" href="#" onclick="ModalBarang(6)">Barang Dagang</a>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?= $totalpenjualan['no_transaksi_jual'] ?></h3>

              <p>Total Penjualan</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="/barangkeluar" class="small-box-footer">Data Penjualan <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>44</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div> -->
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header border-0">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">Online Store Visitors</h3>
                <a href="javascript:void(0);">View Report</a>
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex">
                <p class="d-flex flex-column">
                  <span class="text-bold text-lg">820</span>
                  <span>Visitors Over Time</span>costumize
                </p>
                <p class="ml-auto d-flex flex-column text-right">
                  <span class="text-success">
                    <i class="fas fa-arrow-up"></i> 12.5%
                  </span>
                  <span class="text-muted">Since last week</span>
                </p>
              </div>
              <!-- /.d-flex -->

              <div class="position-relative mb-4">
                <canvas id="visitors-chart" height="200"></canvas>
              </div>

              <div class="d-flex flex-row justify-content-end">
                <span class="mr-2">
                  <i class="fas fa-square text-primary"></i> This Week
                </span>

                <span>
                  <i class="fas fa-square text-gray"></i> Last Week
                </span>
              </div>
            </div>
          </div>
          <!-- /.card -->

          <div class="card">
            <div class="card-header border-0 ">
              <h3 style="text-align: center; font-size: 20px; ">Harga Emas</h3>
            </div>
            <div class="table-responsive">
              <div id="div_widget" align="center"></div>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header border-0">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">Sales</h3>
                <a href="javascript:void(0);">View Report</a>
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex">
                <p class="d-flex flex-column">
                  <span class="text-bold text-lg">$18,230.00</span>
                  <span>Sales Over Time</span>
                </p>
                <p class="ml-auto d-flex flex-column text-right">
                  <span class="text-success">
                    <i class="fas fa-arrow-up"></i> 33.1%
                  </span>
                  <span class="text-muted">Since last month</span>
                </p>
              </div>
              <!-- /.d-flex -->

              <div class="position-relative mb-4">
                <canvas id="sales-chart" height="200"></canvas>
              </div>

              <div class="d-flex flex-row justify-content-end">
                <span class="mr-2">
                  <i class="fas fa-square text-primary"></i> This year
                </span>

                <span>
                  <i class="fas fa-square text-gray"></i> Last year
                </span>
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Main Footer -->
<footer class="main-footer">

</footer>
<div class="modal fade" id="modal-data">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Data Master Stock</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="openmodal">

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary btntambah" data-dismiss="modal">Batal</button>
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


<script src="https://harga-emas.org/widget/widget.js"></script>
<script src="/plugins/chart.js/Chart.min.js"></script>
<script src="/dist/js/pages/dashboard3.js"></script>
<script>
  v_widget_type = 'current_gold_price';
  v_width = 400;
  v_height = 215;
  he_org_show(v_widget_type, v_width, v_height, 'div_widget');

  // v_widget_type = "chart_gold_antam";
  // v_period = 90; //hari
  // v_width = 400;
  // v_height = 300;
  // he_org_show_chart(v_widget_type, v_period, v_width, v_height, 'div_chart_antam');
  function ModalBarang(kel) {
    $.ajax({
      type: "GET",
      dataType: "json",
      url: "<?php echo base_url('tampilmodalhome'); ?>",
      data: {
        kel: kel
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
      complete: function() {
        swal.close()
      },
      success: function(result) {
        $('#openmodal').html(result.modal)
        $('#modal-data').modal('toggle')
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
    })
  }
</script>
<?= $this->endSection(); ?>