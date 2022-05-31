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
                                <th>Harga Jual</th>
                                <th>Jenis</th>
                                <th>Keterangan</th>
                                <th>Berat</th>
                                <th>Total Harga</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($tampildata as $row) : ?>
                                <tr>
                                    <td><img src='/img/<?= $row['nama_img'] ?>' class='imgg'></td>
                                    <td><?= $row['kode'] ?></td>
                                    <td><input onfocus="this.select()" style="width: 100px;" id="harganow <?= $row['id_detail_penjualan'] ?>" class="form-control harganow" onchange="UbahHarga(<?= $row['id_detail_penjualan'] ?>,<?= $row['id_date_penjualan'] ?>,<?= substr($row['kode'], 0, 1) ?>,<?= $row['qty'] ?>,<?= $row['berat'] ?>)" type="number" class="form-control" value="<?= $row['harga_beli'] ?>"></td>
                                    <td><?= $row['jenis'] ?> <?= $row['model'] ?></td>
                                    <td><input onfocus="this.select()" style="width: 100px;" id="keterangan <?= $row['id_detail_penjualan'] ?>" onchange="UbahKet(<?= $row['id_detail_penjualan'] ?>,this)" type="text" class="form-control" value="<?= $row['keterangan'] ?>"></td>
                                    <td><input onfocus="this.select()" style="width: 100px;" id="berat <?= $row['id_detail_penjualan'] ?>" onchange="UbahHarga(<?= $row['id_detail_penjualan'] ?>,<?= $row['id_date_penjualan'] ?>,<?= substr($row['kode'], 0, 1) ?>,<?= $row['qty'] ?>,<?= $row['berat'] ?>)" type="number" class="form-control" value="<?= $row['berat'] ?>"></td>
                                    <td><?= number_format($row['total_harga'], 0, '.', ',') ?></td>
                                    <td><button type='button' class='btn btn-block bg-gradient-danger' onclick="hapus(<?= $row['id_detail_penjualan'] ?>,<?= $row['id_date_penjualan'] ?>)"><i class='fas fa-trash'></i></button></td>
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
                                <td>Total Berat</td>
                                <td><?= $totalberat ?></td>
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
    </div>
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
                    url: "<?php echo base_url('deletedetailjual'); ?>",
                    data: {
                        id: id,
                        iddate: iddate,
                    },
                    success: function(result) {
                        console.log(result)
                        tampildata()
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

    function UbahHarga(id, iddate, kode, qty, berat) {
        var berat = document.getElementById('berat ' + id).value
        var hargabaru = document.getElementById('harganow ' + id).value
        $.ajax({
            type: "post",
            dataType: "json",
            url: "<?php echo base_url('ubahharga'); ?>",
            data: {
                id: id,
                iddate: iddate,
                qty: qty,
                berat: berat,
                hargabaru: hargabaru

            },
            success: function(result) {
                console.log(result)
                tampildata()
                myDataBayar()
                if (result == 'habis') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Stock Kurang',
                    })
                }
                if (result == 'kecil') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tidak Boleh 0',
                    })
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }
</script>