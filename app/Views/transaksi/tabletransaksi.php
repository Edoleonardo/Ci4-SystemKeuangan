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
        $tanggal = '';
        foreach ($detailtransaksi as $r) :
            if ($tanggal != substr($r['tanggal_transaksi'], 0, 10)) :
                if ($i > 0) : ?>
                    <tr id="demo-<?= $i ?>" class="collapse cell-1 row-child">
                        <td colspan="5">Total Akhir</td>
                        <td><?= number_format($totalmasuk, 0, ',', '.') ?></td>
                        <td><?= number_format($totalkeluar, 0, ',', '.') ?></td>
                        <td><?= number_format($totalmasuk - $totalkeluar, 0, ',', '.') ?></td>
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
            endif; ?>
            <tr id="demo-<?= $i ?>" class="collapse cell-1 row-child">
                <td class="text-center"><i class="fa fa-angle-up"></i></td>
                <td><?= $r['pembayaran'] ?></td>
                <td><a href="#" type="button" onclick="OpenModal('<?= $r['keterangan'] ?>')"><?= $r['keterangan'] ?></a></td>
                <td><?= $r['nama_akun'] ?></td>
                <td><?= substr($r['tanggal_transaksi'], 10, 10) ?></td>
                <td><?= number_format($r['masuk'], 0, ',', '.') ?></td>
                <td><?= number_format($r['keluar'], 0, ',', '.') ?></td>
                <td></td>
            </tr>
        <?php
            $totalmasuk = $totalmasuk + $r['masuk'];
            $totalkeluar = $totalkeluar + $r['keluar'];
            $tanggal =  substr($r['tanggal_transaksi'], 0, 10);
        endforeach; ?>
        <tr id="demo-<?= $i ?>" class="collapse cell-1 row-child">
            <td colspan="5">Total Akhir</td>
            <td><?= number_format($totalmasuk, 0, ',', '.') ?></td>
            <td><?= number_format($totalkeluar, 0, ',', '.') ?></td>
            <td><?= number_format($totalmasuk - $totalkeluar, 0, ',', '.') ?></td>
        <tr>
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