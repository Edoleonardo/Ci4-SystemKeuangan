<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    <h1 class="m-0">Form Stock Opname</h1>
                </div><!-- /.col -->
                <!-- /.content-header -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Stock Opname</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-6">
                <!-- /.card-header -->
                <div class="card">
                    <div class="form-group" style="margin: 1mm;">
                        <label>Kode Barang</label>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control kodebarang" id="kodebarang" name="kodebarang" placeholder="Masukan Barcode">
                            <span class="input-group-append">
                                <button type="button" onclick="OpenBarcode()" id="btnsubmitform" class="btn btn-info btn-flat btnsubmitform">Ok</button>
                            </span>
                            <div id="validationServerUsernameFeedback" class="invalid-feedback kodebarangmsg">
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin: 1mm;">
                        <label>Ubah Data</label>
                        <div class="input-group input-group-sm">
                            <select name="pilihan" onchange="tampildata()" class="form-control" id="pilihan" name="pilihan">
                                <option value="belum" selected>Belum Opname</option>
                                <option value="sudah">Sudah Opname</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <div class="col-6">
                <!-- Application buttons -->
                <div class="card">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <tbody>
                                <tr>
                                    <td>Total Barang</td>
                                    <td id="totalbarang"></td>
                                </tr>
                                <tr>
                                    <td>Belum Opname</td>
                                    <td id="sisaopname"></td>
                                </tr>
                                <tr>
                                    <td>Sudah Opname</td>
                                    <td id="sudahopname"></td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        <div class="card ">
            <!-- /.card-header -->
            <div class="card-body">
                <br>
                <div class="row">
                    <div class="col-12">
                        <div class="card" id="dataopname">
                            <!-- /.card-header -->

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->
<!-- /.modal-dialog -->
<div id="openmodaldetail">
</div>
<div id="openmodaledit">
</div>
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<!-- Main Footer -->
<footer class="main-footer">

</footer>
<script type="text/javascript">
    function OpenBarcode() {
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {
                barcode: $('#kodebarang').val()
            },
            url: "<?php echo base_url('caribarcodeopname'); ?>",
            success: function(result) {
                console.log(result)
                if (result.error) {
                    $('#kodebarang').addClass('is-invalid')
                    $('.kodebarangmsg').html(result.error)
                } else {
                    $('#kodebarang').removeClass('is-invalid')
                    $('.kodebarangmsg').html('')
                    OpenModal(result.id)
                    $('#kodebarang').val('')
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function PilihBarang(id) {
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {
                iddetail: id
            },
            url: "<?php echo base_url('pilihbarangopname'); ?>",
            success: function(result) {
                console.log(result)
                if (result.error) {
                    Swal.fire({
                        icon: 'warning',
                        title: result.error,
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: result,
                    })
                    tampildata()
                    $('#modal-modal').modal('toggle')

                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function tampildata() {
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {
                pilihan: $('#pilihan').val()
            },
            url: "<?php echo base_url('tampilopname'); ?>",
            success: function(result) {
                $('#dataopname').html(result.tampildata)
                $('#totalbarang').html(result.jumlah_barang)
                $('#sisaopname').html(result.belum_opname)
                $('#sudahopname').html(result.sisa_opname)
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function ModalEdit(iddetail) {
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {
                iddetail: iddetail
            },
            url: "<?php echo base_url('editopname'); ?>",
            success: function(result) {
                console.log(result)
                $('#openmodaledit').html(result.tampilmodaledit)
                $('#modal-edit').modal('toggle')
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }
    $(document).ready(function() {
        tampildata()
    })
</script>
<?= $this->endSection(); ?>