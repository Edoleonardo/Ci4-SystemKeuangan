<div class="modal fade" id="modal-customer">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pilih Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body table-responsive p-0" id="bahan24k1" style="max-height: 500px;">
                        <table id="customer" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>No Hp</th>
                                    <th>Nama</th>
                                    <th>Point</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($datacust as $row) : ?>
                                    <tr onclick="pilihcustomer(<?= $row['nohp_cust'] ?>)">
                                        <td><?= $row['nohp_cust'] ?></td>
                                        <td><?= $row['nama'] ?></td>
                                        <td><?= $row['point'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" onclick=" $('#modal-bahan24k').modal('toggle');">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    $("#customer").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "aaSorting": []
        //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis", ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
</script>