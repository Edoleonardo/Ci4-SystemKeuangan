<?php foreach ($tampildata as $row) : ?>
    <tr>
        <td><img src='/img/<?= $row['nama_img'] ?>' class='imgg'></td>
        <td><?= $row['kode'] ?></td>
        <td><?= $row['qty_akhir'] ?></td>
        <td><?= number_format($row['harga_beli'], 2, ',', '.')  ?></td>
        <td><?= $row['jenis'] ?> <?= $row['model'] ?> <?= $row['keterangan'] ?></td>
        <td><?= $row['berat'] ?></td>
        <td><?= $row['kadar'] ?></td>
        <td><?= $row['nilai_tukar'] ?></td>
        <td><?= $row['merek'] ?></td>
        <td><?= number_format($row['total_harga'], 2, ',', '.') ?></td>
        <?php if ($row['qty_akhir'] == 0) : ?>
            <td><i class='fas fa-check'></i></td>
        <?php else : ?>
            <td><button type='button' class='btn btn-block bg-gradient-primary' onclick="tambah(<?= $row['id_detail_penjualan'] ?>)"><i class='fas fa-plus'></i></button></td>
        <?php endif; ?>
    </tr>
<?php endforeach; ?>