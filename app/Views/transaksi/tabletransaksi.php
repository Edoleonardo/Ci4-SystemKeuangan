<table class="table table-bordered table-hover" id="tbldata">
    <thead>
        <tr>
            <th colspan="5">Total Akhir</th>
            <th><?= number_format($datatransaksi['total_masuk'], 0, ',', '.') ?></th>
            <th><?= number_format($datatransaksi['total_keluar'], 0, ',', '.') ?></th>
            <th><?= number_format($datatransaksi['saldo_akhir'], 0, ',', '.') ?></th>
        </tr>
        <tr>
            <th class="text-center">No</th>
            <th>Pembayaran</th>
            <th>Keterangan</th>
            <th>Akun Biaya</th>
            <th>Jam</th>
            <th>Masuk</th>
            <th>Keluar</th>
            <th>Total Saldo Akhir</th>
        </tr>
    </thead>
    <tbody class="table-body">
        <?php $i = 0;
        $saldoakhir = 0;
        $totalmasuk = 0;
        $totalkeluar = 0;
        $totaltunaimasuk = 0;
        $totaltransfermasuk = 0;
        $totaldebitccmasuk = 0;
        $totaltunaikeluar = 0;
        $totaltransferkeluar = 0;
        $totaldebitcckeluar = 0;
        $totaltunaiakhir = 0;
        $totaltransferakhir = 0;
        $totaldebitccakhir = 0;
        foreach ($datatime as $r) :
            if ($i > 0) : ?>
                <tr id="demo-<?= $i ?>" class="collapse cell-1 row-child">
                    <td colspan="5">Total Akhir</td>
                    <td><?= number_format($totalmasuk, 0, ',', '.') ?></td>
                    <td><?= number_format($totalkeluar, 0, ',', '.') ?></td>
                    <td><?= number_format($totalmasuk - $totalkeluar, 0, ',', '.') ?></td>
                </tr>
                <tr id="demo-<?= $i ?>" class="collapse cell-1 row-child">
                    <td colspan="5">Tunai</td>
                    <td><?= number_format($totaltunaimasuk, 0, ',', '.') ?></td>
                    <td><?= number_format($totaltunaikeluar, 0, ',', '.') ?></td>
                    <td><?= number_format($totaltunaimasuk - $totaltunaikeluar, 0, ',', '.') ?></td>
                </tr>
                <tr id="demo-<?= $i ?>" class="collapse cell-1 row-child">
                    <td colspan="5">Transfer</td>
                    <td><?= number_format($totaltransfermasuk, 0, ',', '.') ?></td>
                    <td><?= number_format($totaltransferkeluar, 0, ',', '.') ?></td>
                    <td><?= number_format($totaltransfermasuk - $totaltransferkeluar, 0, ',', '.') ?></td>
                </tr>
                <tr id="demo-<?= $i ?>" class="collapse cell-1 row-child">
                    <td colspan="5">DebitCC</td>
                    <td><?= number_format($totaldebitccmasuk, 0, ',', '.') ?></td>
                    <td><?= number_format($totaldebitcckeluar, 0, ',', '.') ?></td>
                    <td><?= number_format($totaldebitccmasuk - $totaldebitcckeluar, 0, ',', '.') ?></td>
                </tr>
            <?php endif;
            $i++; ?>
            <tr class="cell-1" data-toggle="collapse" data-target="#demo-<?= $i ?>">
                <td class="text-center"><?= $i ?></td>
                <td colspan="7"><?= substr($r['tanggal_transaksi'], 0, 10) ?></td>
            </tr>
            <?php $saldoakhir = 0;
            $totalmasuk = 0;
            $totalkeluar = 0;
            $totaltunaimasuk = 0;
            $totaltransfermasuk = 0;
            $totaldebitccmasuk = 0;
            $totaltunaikeluar = 0;
            $totaltransferkeluar = 0;
            $totaldebitcckeluar = 0;
            $totaltunaiakhir = 0;
            $totaltransferakhir = 0;
            $totaldebitccakhir = 0;
            ?>
            <?php
            $datadetail = $modeltransaksi->getDataDate($r['tanggal_transaksi']);
            foreach ($datadetail as $key) :
            ?>
                <tr id="demo-<?= $i ?>" <?= ($session->get('role') == 'owner') ? 'ondblclick="ModalEdit(' . $key["id_detail_transaksi"] . ')"' : '' ?> class="collapse cell-1 row-child" <?= ($key['pembayaran']) == 'Tunai' ? 'style="background-color: #defcff;"' : '' ?> <?= ($key['pembayaran']) == 'Transfer' ? 'style="background-color: #ffffe3;"' : '' ?><?= ($key['pembayaran']) == 'Debitcc' ? 'style="background-color: #ffeae8;"' : '' ?>>
                    <td class="text-center"><i class="fa fa-angle-up"></i></td>
                    <td><?= $key['pembayaran'] ?></td>
                    <td><a href="#" type="button" onclick="OpenModal('<?= $key['keterangan'] ?>')"><?= $key['keterangan'] ?></a></td>
                    <td><?= $key['nama_akun'] ?></td>
                    <td><?= substr($key['tanggal_transaksi'], 10, 10) ?></td>
                    <td><?= number_format($key['masuk'], 0, ',', '.') ?></td>
                    <td><?= number_format($key['keluar'], 0, ',', '.') ?></td>
                    <td></td>
                </tr>

            <?php $totalmasuk = $totalmasuk + $key['masuk'];
                $totalkeluar = $totalkeluar + $key['keluar'];
                if ($key['pembayaran'] == 'Tunai') {
                    $totaltunaimasuk = $totaltunaimasuk + $key['masuk'];
                    $totaltunaikeluar = $totaltunaikeluar + $key['keluar'];
                    $totaltunaiakhir = $totaltunaiakhir + 0;
                } else  if ($key['pembayaran'] == 'Transfer') {
                    $totaltransfermasuk = $totaltransfermasuk + $key['masuk'];
                    $totaltransferkeluar = $totaltransferkeluar + $key['keluar'];
                    $totaltransferakhir = $totaltransferakhir + 0;
                }
                if ($key['pembayaran'] == 'Debitcc') {
                    $totaldebitccmasuk = $totaldebitccmasuk + $key['masuk'];
                    $totaldebitcckeluar = $totaldebitcckeluar + $key['keluar'];
                    $totaldebitccakhir = $totaldebitccakhir + 0;
                }
            endforeach; ?>
        <?php
        endforeach; ?>
        <tr id="demo-<?= $i ?>" class="collapse cell-1 row-child">
            <td colspan="5">Total Akhir</td>
            <td><?= number_format($totalmasuk, 0, ',', '.') ?></td>
            <td><?= number_format($totalkeluar, 0, ',', '.') ?></td>
            <td><?= number_format($totalmasuk - $totalkeluar, 0, ',', '.') ?></td>
        </tr>
        <tr id="demo-<?= $i ?>" class="collapse cell-1 row-child">
            <td colspan="5">Tunai</td>
            <td><?= number_format($totaltunaimasuk, 0, ',', '.') ?></td>
            <td><?= number_format($totaltunaikeluar, 0, ',', '.') ?></td>
            <td><?= number_format($totaltunaimasuk - $totaltunaikeluar, 0, ',', '.') ?></td>
        </tr>
        <tr id="demo-<?= $i ?>" class="collapse cell-1 row-child">
            <td colspan="5">Transfer</td>
            <td><?= number_format($totaltransfermasuk, 0, ',', '.') ?></td>
            <td><?= number_format($totaltransferkeluar, 0, ',', '.') ?></td>
            <td><?= number_format($totaltransfermasuk - $totaltransferkeluar, 0, ',', '.') ?></td>
        </tr>
        <tr id="demo-<?= $i ?>" class="collapse cell-1 row-child">
            <td colspan="5">DebitCC</td>
            <td><?= number_format($totaldebitccmasuk, 0, ',', '.') ?></td>
            <td><?= number_format($totaldebitcckeluar, 0, ',', '.') ?></td>
            <td><?= number_format($totaldebitccmasuk - $totaldebitcckeluar, 0, ',', '.') ?></td>
        </tr>
    </tbody>
</table>
<script>
    function OpenModal(no_id) {
        $.ajax({
            type: "get",
            url: "<?php echo base_url('modaldetail'); ?>",
            dataType: "json",
            data: {
                no_id: no_id
            },
            success: function(result) {
                // console.log(result.modaldetail);
                if (result.error) {
                    console.log(result.error);
                } else {
                    $('#openmodaldetail').html(result.modaldetail)
                    $('#modal-modal').modal('toggle')
                }


            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }
</script>