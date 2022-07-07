<style>
    .table {
        text-align: center;
    }
</style>
<table id="example1" class="table table-bordered table-striped tableasd">
    <thead>
        <tr>
            <th rowspan="3" style="vertical-align: middle;text-align: center;  background-color: yellow;">Kadar</th>
            <th colspan="<?= $cjenis['jenis'] ?>" style="text-align: center; background-color: bisque;">Jenis</th>
        </tr>
        <tr>
            <?php foreach ($hkadar as $r) : ?>
                <th colspan="2" style=" background-color: bisque;"><?= $r['kadar'] ?></th>
            <?php endforeach; ?>
        </tr>
        <tr>
            <?php $i = 0;
            foreach ($hkadar as $r) : ?>
                <th>Qty</th>
                <th>Berat</th>
            <?php $i += 1;
            endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($bjenis as $r) : ?>
            <tr>
                <td style=" background-color: yellow;"><?= $r['jenis'] ?></td>
                <?php foreach ($hkadar as $k) : ?>
                    <td><?= ($funct->SumDataHomeQty($k['kadar'], $r['jenis'])[0]['qty']) ? number_format($funct->SumDataHomeQty($k['kadar'], $r['jenis'])[0]['qty'], 0, ',', '.') : 0; ?></td>
                    <td><?= ($funct->SumDataHomeBrt($k['kadar'], $r['jenis'])[0]['berat']) ? number_format($funct->SumDataHomeBrt($k['kadar'], $r['jenis'])[0]['berat'], 2, ',', '.') : 0; ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
        <tr style="background-color: lightblue;">
            <td>Total</td>
            <?php foreach ($hkadar as $k) : ?>
                <td><?= ($funct->SumDataTotalQty($k['kadar'])[0]['qty']) ? number_format($funct->SumDataTotalQty($k['kadar'])[0]['qty'], 0, ',', '.') : 0; ?></td>
                <td><?= ($funct->SumDataTotalBrt($k['kadar'])[0]['berat']) ? number_format($funct->SumDataTotalBrt($k['kadar'])[0]['berat'], 2, ',', '.') : 0; ?></td>
            <?php endforeach; ?>
        </tr>
        <tr style="background-color: lightblue;">
            <td>Grand Total</td>
            <td><?= ($funct->SumDataGrandTotalQty()[0]['qty']) ? number_format($funct->SumDataGrandTotalQty()[0]['qty'], 0, ',', '.') : 0; ?></td>
            <td><?= ($funct->SumDataGrandTotalBrt()[0]['berat']) ? number_format($funct->SumDataGrandTotalBrt()[0]['berat'], 2, ',', '.') : 0; ?></td>
            <?php for ($temp = 2; $temp < ($i * 2); $temp++) { ?>
                <td></td>
            <?php } ?>
    </tbody>
</table>


<script>
    // $(function() {
    //     $("#example1").DataTable({
    //         paging: false,
    //         "responsive": true,
    //         "lengthChange": false,
    //         "autoWidth": false,
    //         "aaSorting": [],
    //         "buttons": ["excel"]

    //         //"buttons": ["copy", "csv", "excel", "pdf", "print", ]
    //     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    // });
</script>