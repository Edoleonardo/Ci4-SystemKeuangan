<div class="card-body table-responsive p-0" style="max-height: 500px;">
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th id="theadqty" style="text-align: center;"></th>
                <th></th>
                <th></th>
                <th></th>
                <th id="theadberat" style="text-align: center;"></th>
                <th id="theadhargabeli" style="text-align: center;"></th>
                <th></th>
                <th></th>
                <th></th>
                <th id="theadtotalharga" style="text-align: center;"></th>
                <th></th>
            </tr>
            <tr>
                <th>Gambar</th>
                <th>Kode</th>
                <th>Qty</th>
                <th>Jenis</th>
                <th>Model</th>
                <th>Keterangan</th>
                <th>Berat</th>
                <th>Harga Beli</th>
                <th>Ongkos</th>
                <th>Kadar</th>
                <th>Merek</th>
                <th>Total Harga</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tampildata as $row) : ?>
                <tr>
                    <td><img src='/img/<?= $row['nama_img'] ?>' class='imgg'></td>
                    <td><?= $row['kode'] ?></td>
                    <td><?= $row['qty'] ?></td>
                    <td><?= $row['jenis'] ?></td>
                    <td><?= $row['model'] ?></td>
                    <td><?= $row['keterangan'] ?></td>
                    <td><?= $row['berat'] ?></td>
                    <td><?= number_format($row['harga_beli']) ?></td>
                    <td><?= number_format($row['ongkos']) ?></td>
                    <td><?= $row['kadar'] ?></td>
                    <td><?= $row['merek'] ?></td>
                    <td><?= number_format($row['total_harga']) ?></td>
                    <td><button type='button' class='btn btn-block bg-gradient-danger' onclick="hapus(<?= $row['id_detail_pembelian'] ?>)"><i class='fas fa-trash'></i></button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<script>
    $(document).ready(function() {

    })

    function hapus(id) {
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
                    type: "GET",
                    dataType: "json",
                    url: "<?php echo base_url('deletedetail'); ?>",
                    data: {
                        id: id,
                        date_id: $('#date_id').val()
                    },
                    success: function(result) {

                        tampildata()
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