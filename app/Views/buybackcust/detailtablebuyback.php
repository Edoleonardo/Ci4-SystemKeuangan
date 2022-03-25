<?php foreach ($tampildata as $row) : ?>
    <tr>
        <td><img src='/img/<?= $row['nama_img'] ?>' class='imgg'></td>
        <td><?= $row['kode'] ?></td>
        <td><?= $row['qty'] ?></td>
        <td><?= number_format($row['harga_beli'], 2, ',', '.')  ?></td>
        <td><?= $row['jenis'] ?> <?= $row['model'] ?> <?= $row['keterangan'] ?> (<?= $row['no_nota'] ?>, <?= $row['status'] ?>)</td>
        <td><?= $row['berat'] ?></td>
        <td><?= $row['kadar'] ?></td>
        <td><?= $row['nilai_tukar'] ?></td>
        <td><?= $row['merek'] ?></td>
        <td><?= number_format($row['total_harga'], 2, ',', '.') ?></td>
        <?php if ($databuyback['status_dokumen'] == 'Draft') : ?>
            <td><button type='button' class='btn btn-block bg-gradient-danger' onclick="hapus(<?= $row['id_detail_buyback'] ?>,<?= $row['id_date_buyback'] ?>)"><i class='fas fa-trash'></i></button></td>
        <?php endif; ?>
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