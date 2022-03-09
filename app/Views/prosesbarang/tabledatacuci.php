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