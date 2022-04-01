<tr>
    <td><img src='/img/<?= $tampildata['nama_img'] ?>' class='imgg'></td>
    <td><?= $tampildata['kode'] ?></td>
    <?php if (substr($tampildata['kode'], 0, 1) == 3 && $idrill != $tampildata['id_detail_penjualan']) : ?>
        <td><input style="width: 100px;" id="qty <?= $tampildata['id_detail_penjualan'] ?>" onchange="UbahHarga(<?= $tampildata['id_detail_penjualan'] ?>,<?= $tampildata['id_date_penjualan'] ?>,<?= substr($tampildata['kode'], 0, 1) ?>,<?= $tampildata['qty'] ?>,<?= $tampildata['berat'] ?>)" type="number" class="form-control" value="<?= $tampildata['qty'] ?>"></td>
    <?php else : ?>
        <td><?= $tampildata['qty'] ?></td>
    <?php endif; ?>
    <?php if ($idrill != $tampildata['id_detail_penjualan']) : ?>
        <td><input style="width: 100px;" id="harganow <?= $tampildata['id_detail_penjualan'] ?>" class="harganow" onchange="UbahHarga(<?= $tampildata['id_detail_penjualan'] ?>,<?= $tampildata['id_date_penjualan'] ?>,<?= substr($tampildata['kode'], 0, 1) ?>,<?= $tampildata['qty'] ?>,<?= $tampildata['berat'] ?>)" type="number" class="form-control" value="<?= $tampildata['harga_beli'] ?>"></td>
    <?php else : ?>
        <td><?= $tampildata['harga_beli'] ?></td>
    <?php endif; ?>
    <td><?= number_format($tampildata['ongkos'], 2, ',', '.') ?></td>
    <td><?= $tampildata['jenis'] ?> <?= $tampildata['model'] ?> <?= $tampildata['keterangan'] ?></td>
    <?php if (substr($tampildata['kode'], 0, 1) == 4 && $idrill != $tampildata['id_detail_penjualan']) : ?>
        <td><input style="width: 100px;" id="berat <?= $tampildata['id_detail_penjualan'] ?>" onchange="UbahHarga(<?= $tampildata['id_detail_penjualan'] ?>,<?= $tampildata['id_date_penjualan'] ?>,<?= substr($tampildata['kode'], 0, 1) ?>,<?= $tampildata['qty'] ?>,<?= $tampildata['berat'] ?>)" type="number" class="form-control" value="<?= $tampildata['berat'] ?>"></td>
    <?php else : ?>
        <td><?= $tampildata['berat'] ?></td>
    <?php endif; ?>
    <td><?= $tampildata['berat_murni'] ?></td>
    <td><?= $tampildata['kadar'] ?></td>
    <td><?= $tampildata['nilai_tukar'] ?></td>
    <td><?= $tampildata['merek'] ?></td>
    <td><?= number_format($tampildata['total_harga'], 0, ',', '.') ?></td>
    <td><button type='button' class='btn btn-block bg-gradient-danger' onclick="hapus(<?= $tampildata['id_detail_penjualan'] ?>,<?= $tampildata['id_date_penjualan'] ?>)"><i class='fas fa-trash'></i></button></td>
</tr>


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
                    url: "<?php echo base_url('deletedetailjualretur'); ?>",
                    data: {
                        id: id,
                        idrill: $('#iddetail').val(),
                    },
                    success: function(result) {
                        if (result.error) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Data Asli Tidak dapat dihapus',
                            })
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Retur Berhasil Dihapus',
                            })
                        }
                        ReturCust($('#iddetail').val(), $('#iddate').val())
                    },
                    error: function(xhr, ajaxOptions, thtampildatanError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thtampildatanError);
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
            url: "<?php echo base_url('ubahhargaretur'); ?>",
            data: {
                // idlama: $('#iddetail').val(),
                id: id,
                iddate: iddate,
                qty: qty,
                berat: berat,
                hargabaru: hargabaru

            },
            success: function(result) {
                // console.log(result)
                // tampildataretur()
                // console.log(id)
                // console.log($('#iddetail').val() + 'ubahharga')

                ReturCust($('#iddetail').val(), $('#iddate').val())
                // myDataBayar()
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
            error: function(xhr, ajaxOptions, thtampildatanError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thtampildatanError);
            }
        })
    }
</script>