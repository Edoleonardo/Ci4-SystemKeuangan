    <tr>
        <td class="imgg"><img class="imgg" src="/img/<?= $datadetail['nama_img'] ?>"></td>
        <td><?= $datadetail['kode'] ?></td>
        <td><?= $datadetail['jenis'] ?></td>
        <td><?= $datadetail['keterangan'] ?></td>
        <td><?= $datadetail['model'] ?></td>
        <td><?= $datadetail['merek'] ?></td>
        <td><?= $datadetail['berat'] ?></td>
        <td><?= $datadetail['qty'] ?></td>
        <td><?= number_format($datadetail['harga_beli'], 0, ',', '.') ?></td>
        <td><?= $datadetail['kadar'] ?></td>
        <td><?= $datadetail['nilai_tukar'] ?></td>
        <td><?= number_format($datadetail['total_harga'], 0, ',', '.') ?></td>
    </tr>