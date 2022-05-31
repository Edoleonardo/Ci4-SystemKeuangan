<?php if ($kel == 1) : ?>
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Kode</th>
                <th>Qty</th>
                <th>Harga Beli</th>
                <th>Keterangan</th>
                <th>Berat</th>
                <th>Kadar</th>
                <th>Nilai Tukar</th>
                <th>Merek</th>
                <th>Total Harga</th>
                <th>Tambah</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tampildata as $row) : ?>
                <tr>
                    <td><img src='/img/<?= $row['nama_img'] ?>' class='imgg'></td>
                    <td><?= $row['kode'] ?></td>
                    <td><?= $row['saldo'] ?></td>
                    <td><?= number_format($row['harga_beli'], 2, ',', '.')  ?></td>
                    <td><?= $row['jenis'] ?> <?= $row['model'] ?> <?= $row['keterangan'] ?></td>
                    <td><?= $row['berat'] ?></td>
                    <td><?= $row['kadar'] ?></td>
                    <td><?= $row['nilai_tukar'] ?></td>
                    <td><?= $row['merek'] ?></td>
                    <td><?= number_format($row['total_harga'], 2, ',', '.') ?></td>
                    <?php if ($row['saldo'] == 0) : ?>
                        <td><i class='fas fa-check'></i></td>
                    <?php else : ?>
                        <td><button type='button' class='btn btn-block bg-gradient-primary' onclick="tambah(<?= $row['id_detail_penjualan'] ?>)"><i class='fas fa-plus'></i></button></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php elseif ($kel == 2) : ?>
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Kode</th>
                <th>Qty</th>
                <th>Harga Beli</th>
                <th>Keterangan</th>
                <th>Berat</th>
                <th>Kadar</th>
                <th>Merek</th>
                <th>Total Harga</th>
                <th>Tambah</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tampildata as $row) : ?>
                <tr>
                    <td><img src='/img/<?= $row['nama_img'] ?>' class='imgg'></td>
                    <td><?= $row['kode'] ?></td>
                    <td><?= $row['saldo'] ?></td>
                    <td><?= number_format($row['harga_beli'], 2, ',', '.')  ?></td>
                    <td><?= $row['jenis'] ?> <?= $row['model'] ?> <?= $row['keterangan'] ?></td>
                    <td><?= $row['berat'] ?></td>
                    <td><?= $row['kadar'] ?></td>
                    <td><?= $row['merek'] ?></td>
                    <td><?= number_format($row['total_harga'], 2, ',', '.') ?></td>
                    <?php if ($row['saldo'] == 0) : ?>
                        <td><i class='fas fa-check'></i></td>
                    <?php else : ?>
                        <td><button type='button' class='btn btn-block bg-gradient-primary' onclick="tambah(<?= $row['id_detail_penjualan'] ?>)"><i class='fas fa-plus'></i></button></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php elseif ($kel == 3) : ?>
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Kode</th>
                <th>Qty</th>
                <th>Harga Beli</th>
                <th>Keterangan</th>
                <th>Berat</th>
                <th>Merek</th>
                <th>Total Harga</th>
                <th>Tambah</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tampildata as $row) : ?>
                <tr>
                    <td><img src='/img/<?= $row['nama_img'] ?>' class='imgg'></td>
                    <td><?= $row['kode'] ?></td>
                    <td><?= $row['saldo'] ?></td>
                    <td><?= number_format($row['harga_beli'], 2, ',', '.')  ?></td>
                    <td><?= $row['jenis'] ?> <?= $row['model'] ?> <?= $row['keterangan'] ?></td>
                    <td><?= $row['berat'] ?></td>
                    <td><?= $row['merek'] ?></td>
                    <td><?= number_format($row['total_harga'], 2, ',', '.') ?></td>
                    <?php if ($row['saldo'] == 0) : ?>
                        <td><i class='fas fa-check'></i></td>
                    <?php else : ?>
                        <td><button type='button' class='btn btn-block bg-gradient-primary' onclick="tambah(<?= $row['id_detail_penjualan'] ?>)"><i class='fas fa-plus'></i></button></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php elseif ($kel == 4) : ?>
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Kode</th>
                <th>Qty</th>
                <th>Harga Beli</th>
                <th>Keterangan</th>
                <th>Berat</th>
                <th>Kadar</th>
                <th>Total Harga</th>
                <th>Tambah</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tampildata as $row) : ?>
                <tr>
                    <td><img src='/img/<?= $row['nama_img'] ?>' class='imgg'></td>
                    <td><?= $row['kode'] ?></td>
                    <td><?= $row['qty'] ?></td>
                    <td><?= number_format($row['harga_beli'], 2, ',', '.')  ?></td>
                    <td><?= $row['jenis'] ?> <?= $row['model'] ?> <?= $row['keterangan'] ?></td>
                    <td><?= $row['saldo'] ?></td>
                    <td><?= $row['kadar'] ?></td>
                    <td><?= number_format($row['total_harga'], 2, ',', '.') ?></td>
                    <?php if ($row['saldo'] == 0) : ?>
                        <td><i class='fas fa-check'></i></td>
                    <?php else : ?>
                        <td><button type='button' class='btn btn-block bg-gradient-primary' onclick="tambah(<?= $row['id_detail_penjualan'] ?>)"><i class='fas fa-plus'></i></button></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php elseif ($kel == 5) : ?>
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
                <th>Tambah</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tampildata as $row) : ?>
                <tr>
                    <td><img src='/img/<?= $row['nama_img'] ?>' class='imgg'></td>
                    <td><?= $row['kode'] ?></td>
                    <td><?= $row['saldo'] ?></td>
                    <td><?= number_format($row['harga_beli'], 2, ',', '.')  ?></td>
                    <td><?= $row['jenis'] ?> <?= $row['model'] ?> <?= $row['keterangan'] ?></td>
                    <td><?= $row['saldo_carat'] ?></td>
                    <td><?= number_format($row['total_harga'], 2, ',', '.') ?></td>
                    <?php if ($row['saldo'] == 0) : ?>
                        <td><i class='fas fa-check'></i></td>
                    <?php else : ?>
                        <td><button type='button' class='btn btn-block bg-gradient-primary' onclick="tambah(<?= $row['id_detail_penjualan'] ?>)"><i class='fas fa-plus'></i></button></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php elseif ($kel == 6) : ?>
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Kode</th>
                <th>Qty</th>
                <th>Harga Beli</th>
                <th>Keterangan</th>
                <th>Merek</th>
                <th>Total Harga</th>
                <th>Tambah</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tampildata as $row) : ?>
                <tr>
                    <td><img src='/img/<?= $row['nama_img'] ?>' class='imgg'></td>
                    <td><?= $row['kode'] ?></td>
                    <td><?= $row['saldo'] ?></td>
                    <td><?= number_format($row['harga_beli'], 2, ',', '.')  ?></td>
                    <td><?= $row['jenis'] ?> <?= $row['model'] ?> <?= $row['keterangan'] ?></td>
                    <td><?= $row['merek'] ?></td>
                    <td><?= number_format($row['total_harga'], 2, ',', '.') ?></td>
                    <?php if ($row['saldo'] == 0) : ?>
                        <td><i class='fas fa-check'></i></td>
                    <?php else : ?>
                        <td><button type='button' class='btn btn-block bg-gradient-primary' onclick="tambah(<?= $row['id_detail_penjualan'] ?>)"><i class='fas fa-plus'></i></button></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>