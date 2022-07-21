<div class="card">
    <!-- /.card-header -->
    <div class="card-body">
        <br>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Gambar</th>
                                    <th>Kode</th>
                                    <th>Qty</th>
                                    <th>Harga Beli</th>
                                    <th>Keterangan</th>
                                    <th>Carat</th>
                                    <th>Total Harga</th>
                                    <?php if ($databuyback['status_dokumen'] == 'Draft') : ?>
                                        <th>Delete</th>
                                    <?php endif ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tampildata as $row) : ?>
                                    <tr>
                                        <td><img src='/img/<?= $row['nama_img'] ?>' class='imgg'></td>
                                        <td><?= $row['kode'] ?></td>
                                        <td><?= $row['qty'] ?></td>
                                        <td><?= number_format($row['harga_beli'], 2, ',', '.')  ?></td>
                                        <td><?= $row['jenis'] ?> <?= $row['model'] ?> <?= $row['keterangan'] ?> (<?= $row['no_nota'] ?>, <?= $row['status_proses'] ?>)</td>
                                        <td><?= $row['carat'] ?></td>
                                        <td><?= number_format($row['total_harga'], 2, ',', '.') ?></td>
                                        <?php if ($databuyback['status_dokumen'] == 'Draft') : ?>
                                            <td><button type='button' class='btn btn-block bg-gradient-danger' onclick="hapus(<?= $row['id_detail_buyback'] ?>,<?= $row['id_date_buyback'] ?>)"><i class='fas fa-trash'></i></button></td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Total Carat</td>
                                    <td><?= number_format($totalcarat['carat'], 2, '.', ',') ?></td>
                                </tr>
                                <tr>
                                    <td>Total Harga</td>
                                    <td><?= number_format($totalharga['total_harga'], 0, ',', '.') ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body p-0" id="refreshpembayaran" <?= ($session->get('role') == 'owner') ? 'ondblclick="OpenEditBayar()"' : '' ?>>

                        <table class="table table-striped">
                            <tbody>
                                <?php if (isset($databuyback)) : ?>
                                    <tr>
                                        <td>Pembayaran</td>
                                        <td><?= $databuyback['pembayaran'] ?></td>
                                    </tr>
                                    <?php if ($databuyback['nama_bank']) : ?>
                                        <tr>
                                            <td>Nama Bank</td>
                                            <td><?= $databuyback['nama_bank'] ?></td>
                                        </tr>
                                    <?php endif ?>
                                    <?php if ($databuyback['tunai']) : ?>
                                        <tr>
                                            <td>Tunai</td>
                                            <td><?= number_format($databuyback['tunai'], 2, ',', '.') ?></td>
                                        </tr>
                                    <?php endif ?>
                                    <?php if ($databuyback['transfer']) : ?>
                                        <tr>
                                            <td>Transfer</td>
                                            <td><?= number_format($databuyback['transfer'], 2, ',', '.') ?></td>
                                        </tr>
                                    <?php endif ?>
                                <?php endif ?>

                            </tbody>
                        </table>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /.card-body -->
</div>

<script>
    function hapus(id, iddate) {
        Swal.fire({
            title: 'Hapus',
            text: "Yakin ingin Hapus Data ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "get",
                    dataType: "json",
                    url: "<?php echo base_url('deletedetailbuyback'); ?>",
                    data: {
                        id: id,
                        iddate: iddate,
                    },
                    success: function(result) {
                        tampildatabuyback()
                        Swal.fire({
                            icon: 'success',
                            title: 'Data Berhasil Dihapus',
                        })

                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                })

            }
        })

    }
</script>