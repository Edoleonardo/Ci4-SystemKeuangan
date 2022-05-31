<?php if ($kel == 1) : ?>
    <table id="example1" class="table table-bordered table-striped tableasd">
        <thead>
            <tr>
                <th>Id Barcode</th>
                <th>Keterangan</th>
                <th>qty</th>
                <th>Berat</th>
                <th>kadar</th>
                <th>Harga Beli</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataopname as $r) : ?>
                <tr>
                    <td>
                        <?php if ($stat == 'blm') : ?>
                            <a type="button" class="btn btn-block btn-outline-info btn-sm" href="#" onclick="OpenModal(<?= (isset($r['barcode'])) ? $r['barcode'] : '' ?>,<?= $kel ?>)"><?= (isset($r['barcode'])) ? $r['barcode'] : '' ?></a>
                        <?php else : ?>
                            <a type="button" class="btn btn-block btn-outline-danger btn-sm" href="#" onclick="DeleteOpname(<?= (isset($r['id_stock_opname'])) ? $r['id_stock_opname'] : '' ?>)"><?= $r['barcode'] ?></a>
                        <?php endif; ?>
                    </td>
                    <td><?= $r['jenis'] ?> <?= $r['keterangan'] ?> <?= $r['model'] ?></td>
                    <td><?= $r['qty'] ?></td>
                    <td><?= $r['berat'] ?></td>
                    <td><?= $r['kadar'] ?></td>
                    <td><?= number_format($r['harga_beli'], 0, ',', '.') ?></td>
                    <td><?= number_format($r['total_harga'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Id Barcode</th>
                <th>Keterangan</th>
                <th>qty</th>
                <th>Berat</th>
                <th>kadar</th>
                <th>Harga Beli</th>
                <th>Total Harga</th>
            </tr>
        </tfoot>
    </table>
<?php elseif ($kel == 2) : ?>
    <table id="example1" class="table table-bordered table-striped tableasd">
        <thead>
            <tr>
                <th>Id Barcode</th>
                <th>Keterangan</th>
                <th>qty</th>
                <th>Berat</th>
                <th>kadar</th>
                <th>Harga Beli</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataopname as $r) : ?>
                <tr>
                    <td>
                        <?php if ($stat == 'blm') : ?>
                            <a type="button" class="btn btn-block btn-outline-info btn-sm" href="#" onclick="OpenModal(<?= $r['barcode'] ?>,<?= $kel ?>)"><?= $r['barcode'] ?></a>
                        <?php else : ?>
                            <a type="button" class="btn btn-block btn-outline-danger btn-sm" href="#" onclick="DeleteOpname(<?= (isset($r['id_stock_opname'])) ? $r['id_stock_opname'] : '' ?>)"><?= $r['barcode'] ?></a>
                        <?php endif; ?>
                    </td>
                    <td><?= $r['jenis'] ?> <?= $r['keterangan'] ?> <?= $r['model'] ?></td>
                    <td><?= $r['qty'] ?></td>
                    <td><?= $r['berat'] ?></td>
                    <td><?= $r['kadar'] ?></td>
                    <td><?= number_format($r['harga_beli'], 0, ',', '.') ?></td>
                    <td><?= number_format($r['total_harga'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Id Barcode</th>
                <th>Keterangan</th>
                <th>qty</th>
                <th>Berat</th>
                <th>kadar</th>
                <th>Harga Beli</th>
                <th>Total Harga</th>
            </tr>
        </tfoot>
    </table>
<?php elseif ($kel == 3) : ?>
    <table id="example1" class="table table-bordered table-striped tableasd">
        <thead>
            <tr>
                <th>Id Barcode</th>
                <th>Keterangan</th>
                <th>qty</th>
                <th>Berat</th>
                <th>Harga Beli</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataopname as $r) : ?>
                <tr>
                    <td>
                        <?php if ($stat == 'blm') : ?>
                            <a type="button" class="btn btn-block btn-outline-info btn-sm" href="#" onclick="OpenModal(<?= $r['barcode'] ?>,<?= $kel ?>)"><?= $r['barcode'] ?></a>
                        <?php else : ?>
                            <a type="button" class="btn btn-block btn-outline-danger btn-sm" href="#" onclick="DeleteOpname(<?= (isset($r['id_stock_opname'])) ? $r['id_stock_opname'] : '' ?>)"><?= $r['barcode'] ?></a>
                        <?php endif; ?>
                    </td>
                    <td><?= $r['jenis'] ?> <?= $r['keterangan'] ?> <?= $r['model'] ?></td>
                    <td><?= $r['qty'] ?></td>
                    <td><?= $r['berat'] ?></td>
                    <td><?= number_format($r['harga_beli'], 0, ',', '.') ?></td>
                    <td><?= number_format($r['total_harga'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Id Barcode</th>
                <th>Keterangan</th>
                <th>qty</th>
                <th>Berat</th>
                <th>Harga Beli</th>
                <th>Total Harga</th>
            </tr>
        </tfoot>
    </table>
<?php elseif ($kel == 4) : ?>
    <table id="example1" class="table table-bordered table-striped tableasd">
        <thead>
            <tr>
                <th>Id Barcode</th>
                <th>Keterangan</th>
                <th>qty</th>
                <th>Berat</th>
                <th>Harga Beli</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataopname as $r) : ?>
                <tr>
                    <td>
                        <?php if ($stat == 'blm') : ?>
                            <a type="button" class="btn btn-block btn-outline-info btn-sm" href="#" onclick="OpenModal(<?= $r['barcode'] ?>,<?= $kel ?>)"><?= $r['barcode'] ?></a>
                        <?php else : ?>
                            <a type="button" class="btn btn-block btn-outline-danger btn-sm" href="#" onclick="DeleteOpname(<?= (isset($r['id_stock_opname'])) ? $r['id_stock_opname'] : '' ?>)"><?= $r['barcode'] ?></a>
                        <?php endif; ?>
                    </td>
                    <td><?= $r['jenis'] ?> <?= $r['keterangan'] ?> <?= $r['model'] ?></td>
                    <td><?= $r['qty'] ?></td>
                    <td><?= $r['berat'] ?></td>
                    <td><?= number_format($r['harga_beli'], 0, ',', '.') ?></td>
                    <td><?= number_format($r['total_harga'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Id Barcode</th>
                <th>Keterangan</th>
                <th>qty</th>
                <th>Berat</th>
                <th>Harga Beli</th>
                <th>Total Harga</th>
            </tr>
        </tfoot>
    </table>
<?php elseif ($kel == 5) : ?>
    <table id="example1" class="table table-bordered table-striped tableasd">
        <thead>
            <tr>
                <th>Id Barcode</th>
                <th>Keterangan</th>
                <th>qty</th>
                <th>Carat</th>
                <th>Harga Beli</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataopname as $r) : ?>
                <tr>
                    <td>
                        <?php if ($stat == 'blm') : ?>
                            <a type="button" class="btn btn-block btn-outline-info btn-sm" href="#" onclick="OpenModal(<?= $r['barcode'] ?>,<?= $kel ?>)"><?= $r['barcode'] ?></a>
                        <?php else : ?>
                            <a type="button" class="btn btn-block btn-outline-danger btn-sm" href="#" onclick="DeleteOpname(<?= (isset($r['id_stock_opname'])) ? $r['id_stock_opname'] : '' ?>)"><?= $r['barcode'] ?></a>
                        <?php endif; ?>
                    </td>
                    <td><?= $r['jenis'] ?> <?= $r['keterangan'] ?> <?= $r['model'] ?></td>
                    <td><?= $r['qty'] ?></td>
                    <td><?= $r['carat'] ?></td>
                    <td><?= number_format($r['harga_beli'], 0, ',', '.') ?></td>
                    <td><?= number_format($r['total_harga'], 0, ',', '.') ?></td>

                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Id Barcode</th>
                <th>Keterangan</th>
                <th>qty</th>
                <th>Carat</th>
                <th>Harga Beli</th>
                <th>Total Harga</th>
            </tr>
        </tfoot>
    </table>
<?php elseif ($kel == 6) : ?>
    <table id="example1" class="table table-bordered table-striped tableasd">
        <thead>
            <tr>
                <th>Id Barcode</th>
                <th>Keterangan</th>
                <th>qty</th>
                <th>Harga Beli</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataopname as $r) : ?>
                <tr>
                    <td>
                        <?php if ($stat == 'blm') : ?>
                            <a type="button" class="btn btn-block btn-outline-info btn-sm" href="#" onclick="OpenModal(<?= $r['barcode'] ?>,<?= $kel ?>)"><?= $r['barcode'] ?></a>
                        <?php else : ?>
                            <a type="button" class="btn btn-block btn-outline-danger btn-sm" href="#" onclick="DeleteOpname(<?= (isset($r['id_stock_opname'])) ? $r['id_stock_opname'] : '' ?>)"><?= $r['barcode'] ?></a>
                        <?php endif; ?>
                    </td>
                    <td><?= $r['jenis'] ?> <?= $r['keterangan'] ?> <?= $r['model'] ?></td>
                    <td><?= $r['qty'] ?></td>
                    <td><?= number_format($r['harga_beli'], 0, ',', '.') ?></td>
                    <td><?= number_format($r['total_harga'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Id Barcode</th>
                <th>Keterangan</th>
                <th>qty</th>
                <th>Harga Beli</th>
                <th>Total Harga</th>
            </tr>
        </tfoot>
    </table>
<?php endif; ?>

<script>
    function OpenModal(no_id, kel) {
        $.ajax({
            type: "get",
            url: "<?php echo base_url('modaldetailopname'); ?>",
            dataType: "json",
            data: {
                barcode: no_id,
                kel: kel
            },
            success: function(result) {
                if (result.error) {
                    console.log(result.error);
                } else {
                    $('#openmodaldetail').html(result.tampilmodal)
                    $('#modal-modal').modal('toggle')
                }


            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function DeleteOpname(id) {
        $.ajax({
            type: "get",
            url: "<?php echo base_url('hapusopname'); ?>",
            dataType: "json",
            data: {
                iddetail: id
            },
            success: function(result) {
                tampildata()
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil Di Hapus',
                })
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "aaSorting": []
            //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis", ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>