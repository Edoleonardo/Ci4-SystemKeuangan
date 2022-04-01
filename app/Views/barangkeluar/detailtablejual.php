<?php foreach ($tampildata as $row) : ?>
    <tr>
        <td><img src='/img/<?= $row['nama_img'] ?>' class='imgg'></td>
        <td><?= $row['kode'] ?></td>
        <?php if (substr($row['kode'], 0, 1) == 3) : ?>
            <td><input style="width: 100px;" id="qty <?= $row['id_detail_penjualan'] ?>" onchange="UbahHarga(<?= $row['id_detail_penjualan'] ?>,<?= $row['id_date_penjualan'] ?>,<?= substr($row['kode'], 0, 1) ?>,<?= $row['qty'] ?>,<?= $row['berat'] ?>)" type="number" class="form-control" value="<?= $row['qty'] ?>"></td>
        <?php else : ?>
            <td><?= $row['qty'] ?></td>
        <?php endif; ?>
        <td><input style="width: 100px;" id="harganow <?= $row['id_detail_penjualan'] ?>" class="harganow" onchange="UbahHarga(<?= $row['id_detail_penjualan'] ?>,<?= $row['id_date_penjualan'] ?>,<?= substr($row['kode'], 0, 1) ?>,<?= $row['qty'] ?>,<?= $row['berat'] ?>)" type="number" class="form-control" value="<?= $row['harga_beli'] ?>"></td>
        <td><?= number_format($row['ongkos'], 2, ',', '.') ?></td>
        <td><?= $row['jenis'] ?> <?= $row['model'] ?> <?= $row['keterangan'] ?></td>
        <?php if (substr($row['kode'], 0, 1) == 4) : ?>
            <td><input style="width: 100px;" id="berat <?= $row['id_detail_penjualan'] ?>" onchange="UbahHarga(<?= $row['id_detail_penjualan'] ?>,<?= $row['id_date_penjualan'] ?>,<?= substr($row['kode'], 0, 1) ?>,<?= $row['qty'] ?>,<?= $row['berat'] ?>)" type="number" class="form-control" value="<?= $row['berat'] ?>"></td>
        <?php else : ?>
            <td><?= $row['berat'] ?></td>
        <?php endif; ?>
        <td><?= $row['berat_murni'] ?></td>
        <td><?= $row['kadar'] ?></td>
        <td><?= $row['nilai_tukar'] ?></td>
        <td><?= $row['merek'] ?></td>
        <td><?= number_format($row['total_harga'], 0, '.', ',') ?></td>
        <td><button type='button' class='btn btn-block bg-gradient-danger' onclick="hapus(<?= $row['id_detail_penjualan'] ?>,<?= $row['id_date_penjualan'] ?>)"><i class='fas fa-trash'></i></button></td>
    </tr>
<?php endforeach; ?>

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
        if (kode == 3) {
            var qty = document.getElementById('qty ' + id).value
            var hargabaru = document.getElementById('harganow ' + id).value
        } else {
            var hargabaru = document.getElementById('harganow ' + id).value
            var qty = qty
        }
        if (kode == 4) {
            var berat = document.getElementById('berat ' + id).value
            var hargabaru = document.getElementById('harganow ' + id).value
        } else {
            var hargabaru = document.getElementById('harganow ' + id).value
            var berat = berat
        }
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