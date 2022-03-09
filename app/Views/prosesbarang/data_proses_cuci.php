<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<script type="text/javascript" src="/js/jquery.js"></script>
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
                    <h1 class="m-0">Data Barang Cuci</h1>
                </div><!-- /.col -->
                <!-- /.content-header -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Barang Cuci</li>
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
                        <!-- /.card-header -->
                        <div class="card-body table">
                            <!-- <div id="refreshtbl"> -->
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
                                    <?php foreach ($datacuci as $row) : ?>
                                        <tr id='tr'>
                                            <td class="imgg"><img class="imgg" src="/img/<?= $row['nama_img'] ?>"></td>
                                            <td><?= $row['kode'] ?></td>
                                            <td><?= $row['jenis'] ?></td>
                                            <td><?= $row['model'] ?></td>
                                            <td><?= $row['qty'] ?></td>
                                            <td><?= $row['kadar'] ?></td>
                                            <td>
                                                <a type="button" href="detailbuyback/<?= $row['id_detail_buyback'] ?>" class="btn btn-block btn-outline-info btn-sm">Detail</a>
                                                <a type="button" onclick="editcuci(<?= $row['id_detail_buyback'] ?>)" class="btn btn-block btn-outline-danger btn-sm">Selesai Cuci</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Id Barcode</th>
                                        <th>Jenis</th>
                                        <th>model</th>
                                        <th>qty</th>
                                        <th>kadar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- </div> -->
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
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/updatecuci" id="updatecuci" class="updatecuci" name="updatecuci">
                    <?= csrf_field(); ?>
                    <div class="row">
                        <div class="col-sm-5">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Berat</label>
                                <input type="number" step="0.01" id="berat" name="berat" class="form-control" placeholder="Masukan Berat Bersih">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback beratmsg">
                                </div>
                                <input type="hidden" name="id" id="id" value="">
                                <input type="hidden" name="kode" id="kode" value="">
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Nilai Tukar</label>
                                <input type="number" id="nilai_tukar" name="nilai_tukar" class="form-control" placeholder="Masukan Nilai Tukar">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback nilai_tukarmsg">
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btnedit">Update</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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
    function editcuci(id) {
        console.log('tambah')
        console.log(id)
        $.ajax({
            type: "get",
            dataType: "json",
            url: "<?php echo base_url('tampilcuci'); ?>",
            data: {
                id: id,
            },
            success: function(result) {
                console.log(result)
                $('#modal-edit').modal('show');
                $('#berat').val(result.data.berat)
                $('#nilai_tukar').val(result.data.nilai_tukar)
                $('#harga_beli').val(result.data.harga_beli)
                $('#id').val(result.data.id_detail_buyback)
                $('#kode').val(result.data.kode)

                console.log($('#id').val())

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    $('.updatecuci').submit(function(e) {
        e.preventDefault()
        Swal.fire({
            title: 'Selesai Cuci ',
            text: "Data akan di masukan ke master stock ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Selesai',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                let form = $('.updatecuci')[0];
                let data = new FormData(form)
                $.ajax({
                    type: "POST",
                    data: data,
                    url: "<?php echo base_url('updatecuci'); ?>",
                    contentType: false,
                    processData: false,
                    cache: false,
                    dataType: "json",
                    success: function(result) {
                        if (result.error) {
                            console.log(result)
                            if (result.error.nilai_tukar) {
                                $('#nilai_tukar').addClass('is-invalid')
                                $('.nilai_tukarmsg').html(result.error.nilai_tukar)
                            } else {
                                $('#nilai_tukar').removeClass('is-invalid')
                                $('.nilai_tukarmsg').html('')
                            }
                            if (result.error.berat) {
                                $('#berat').addClass('is-invalid')
                                $('.beratmsg').html(result.error.berat)
                            } else {
                                $('#berat').removeClass('is-invalid')
                                $('.beratmsg').html('')
                            }
                        } else {
                            $('#nilai_tukar').removeClass('is-invalid')
                            $('.nilai_tukarmsg').html('')
                            $('#berat').removeClass('is-invalid')
                            $('.beratmsg').html('')
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Di Cuci',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK',
                                allowOutsideClick: false
                            }).then((choose) => {
                                if (choose.isConfirmed) {
                                    $('#modal-edit').modal('toggle');
                                    window.location.href = '/datacuci'
                                    // document.getElementById('refreshtbl').innerHTML = ''
                                    // $("#refresconten").load("/datacuci #refreshtbl");
                                    // $('#example1').data.reload();
                                }
                            })
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                })
            }
        })

    })
</script>
<?= $this->endSection(); ?>