<?php if ($kel == 1) : ?>
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Data <?= $dataval['kode'] ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/tambahbuyback" id="tambahbuyback" class="tambahbuyback" name="tambahbuyback">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Qty</label>
                                    <input onfocus="this.select()" type="number" id="qty1" value="<?= $dataval['saldo'] ?>" onkeyup="HarusBayar()" name="qty1" class="form-control" placeholder="Masukan QTY" readonly>
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback qty1msg">
                                    </div>
                                    <input type="hidden" name="id" id="id" value="<?= $dataval['id_detail_penjualan'] ?>">
                                    <input type="hidden" name="kel" id="kel" value="<?= $kel ?>">
                                    <input type="hidden" name="iddate" id="iddate" value="<?= $databuyback ?>">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Berat</label>
                                    <input onfocus="this.select()" type="number" step="0.01" value="<?= $dataval['berat'] ?>" id="berat1" onkeyup="HarusBayar()" name="berat1" class="form-control" placeholder="Masukan Berat">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback berat1msg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Nilai Tukar</label>
                                    <input onfocus="this.select()" type="number" id="nilai_tukar1" value="<?= $dataval['nilai_tukar'] ?>" onkeyup="HarusBayar()" name="nilai_tukar1" class="form-control" placeholder="Masukan Nilai Tukar">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback nilai_tukar1msg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Harga Beli</label>
                                    <input onfocus="this.select()" type="number" name="harga_beli1" value="<?= $dataval['harga_beli'] ?>" onkeyup="HarusBayar()" id="harga_beli1" class="form-control harga_beli1" placeholder="Masukan Harga Beli">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback harga_beli1msg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input onfocus="this.select()" type="text" name="keterangan1" value="<?= $dataval['keterangan'] ?>" onkeyup="HarusBayar()" id="keterangan1" class="form-control keterangan1" placeholder="Masukan Keterangan">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback keterangan1msg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Status Barang</label>
                                    <select name="status_proses" class="form-control" id="status" name="status">
                                        <option value="Cuci">Cuci</option>
                                        <option value="Retur">Retur Sales</option>
                                        <option value="Lebur">Lebur</option>
                                        <option value="CancelBeli">CancelBeli</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Total Harga</td>
                                            <td id="totalhargaedit"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btnedit" id="btntambah">Tambah</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php elseif ($kel == 2) : ?>
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Data <?= $dataval['kode'] ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/tambahbuyback" id="tambahbuyback" class="tambahbuyback" name="tambahbuyback">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Qty</label>
                                    <input onfocus="this.select()" type="number" value="<?= $dataval['saldo'] ?>" id="qty1" onkeyup="HarusBayar()" name="qty1" class="form-control" placeholder="Masukan QTY" readonly>
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback qty1msg">
                                    </div>
                                    <input type="hidden" name="id" id="id" value="<?= $dataval['id_detail_penjualan'] ?>">
                                    <input type="hidden" name="kel" id="kel" value="<?= $kel ?>">
                                    <input type="hidden" name="iddate" id="iddate" value="<?= $databuyback ?>">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Berat</label>
                                    <input onfocus="this.select()" type="number" step="0.01" value="<?= $dataval['berat'] ?>" id="berat1" onkeyup="HarusBayar()" name="berat1" class="form-control" placeholder="Masukan Berat">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback berat1msg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Harga Beli</label>
                                    <input onfocus="this.select()" type="number" value="<?= $dataval['harga_beli'] ?>" name="harga_beli1" onkeyup="HarusBayar()" id="harga_beli1" class="form-control harga_beli1" placeholder="Masukan Harga Beli">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback harga_beli1msg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input onfocus="this.select()" type="text" name="keterangan1" value="<?= $dataval['keterangan'] ?>" onkeyup="HarusBayar()" id="keterangan1" class="form-control keterangan1" placeholder="Masukan Keterangan">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback keterangan1msg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Status Barang</label>
                                    <select name="status_proses" class="form-control" id="status" name="status">
                                        <option value="Cuci">Cuci</option>
                                        <option value="Retur">Retur Sales</option>
                                        <option value="Lebur">Lebur</option>
                                        <option value="CancelBeli">CancelBeli</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Total Harga</td>
                                            <td id="totalhargaedit"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btnedit" id="btntambah">Tambah</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php elseif ($kel == 3) : ?>
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Data <?= $dataval['kode'] ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/tambahbuyback" id="tambahbuyback" class="tambahbuyback" name="tambahbuyback">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Qty</label>
                                    <input onfocus="this.select()" type="number" value="<?= $dataval['saldo'] ?>" id="qty1" onkeyup="HarusBayar()" name="qty1" class="form-control" placeholder="Masukan QTY">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback qty1msg">
                                    </div>
                                    <input type="hidden" name="id" id="id" value="<?= $dataval['id_detail_penjualan'] ?>">
                                    <input type="hidden" name="kel" id="kel" value="<?= $kel ?>">
                                    <input type="hidden" name="iddate" id="iddate" value="<?= $databuyback ?>">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Berat</label>
                                    <input onfocus="this.select()" type="number" value="<?= $dataval['berat'] ?>" step="0.01" id="berat1" onkeyup="HarusBayar()" name="berat1" class="form-control" placeholder="Masukan Berat" readonly>
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback berat1msg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Harga Beli</label>
                                    <input onfocus="this.select()" type="number" value="<?= $dataval['harga_beli'] ?>" name="harga_beli1" onkeyup="HarusBayar()" id="harga_beli1" class="form-control harga_beli1" placeholder="Masukan Harga Beli">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback harga_beli1msg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input onfocus="this.select()" type="text" name="keterangan1" value="<?= $dataval['keterangan'] ?>" onkeyup="HarusBayar()" id="keterangan1" class="form-control keterangan1" placeholder="Masukan Keterangan">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback keterangan1msg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Total Harga</td>
                                            <td id="totalhargaedit"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btnedit" id="btntambah">Tambah</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php elseif ($kel == 4) : ?>
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Data <?= $dataval['kode'] ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/tambahbuyback" id="tambahbuyback" class="tambahbuyback" name="tambahbuyback">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Qty</label>
                                    <input onfocus="this.select()" type="number" id="qty1" value="<?= $dataval['qty'] ?>" onkeyup="HarusBayar()" name="qty1" class="form-control" placeholder="Masukan QTY" readonly>
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback qty1msg">
                                    </div>
                                    <input type="hidden" name="id" id="id" value="<?= $dataval['id_detail_penjualan'] ?>">
                                    <input type="hidden" name="kel" id="kel" value="<?= $kel ?>">
                                    <input type="hidden" name="iddate" id="iddate" value="<?= $databuyback ?>">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Berat</label>
                                    <input onfocus="this.select()" type="number" value="<?= $dataval['saldo'] ?>" step="0.01" id="berat1" onkeyup="HarusBayar()" name="berat1" class="form-control" placeholder="Masukan Berat">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback berat1msg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Harga Beli</label>
                                    <input onfocus="this.select()" type="number" value="<?= $dataval['harga_beli'] ?>" name="harga_beli1" onkeyup="HarusBayar()" id="harga_beli1" class="form-control harga_beli1" placeholder="Masukan Harga Beli">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback harga_beli1msg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input onfocus="this.select()" type="text" name="keterangan1" value="<?= $dataval['keterangan'] ?>" onkeyup="HarusBayar()" id="keterangan1" class="form-control keterangan1" placeholder="Masukan Keterangan">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback keterangan1msg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Total Harga</td>
                                            <td id="totalhargaedit"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btnedit" id="btntambah">Tambah</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php elseif ($kel == 5) : ?>
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Data <?= $dataval['kode'] ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/tambahbuyback" id="tambahbuyback" class="tambahbuyback" name="tambahbuyback">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Qty</label>
                                    <input onfocus="this.select()" type="number" value="<?= $dataval['saldo'] ?>" id="qty1" onkeyup="HarusBayar()" name="qty1" class="form-control" placeholder="Masukan QTY">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback qty1msg">
                                    </div>
                                    <input type="hidden" name="id" id="id" value="<?= $dataval['id_detail_penjualan'] ?>">
                                    <input type="hidden" name="kel" id="kel" value="<?= $kel ?>">
                                    <input type="hidden" name="iddate" id="iddate" value="<?= $databuyback ?>">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Carat</label>
                                    <input onfocus="this.select()" type="number" value="<?= $dataval['saldo_carat'] ?>" step="0.01" id="carat1" onkeyup="HarusBayar()" name="carat1" class="form-control" placeholder="Masukan Carat">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback carat1msg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Harga Beli</label>
                                    <input onfocus="this.select()" type="number" value="<?= $dataval['harga_beli'] ?>" name="harga_beli1" onkeyup="HarusBayar()" id="harga_beli1" class="form-control harga_beli1" placeholder="Masukan Harga Beli">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback harga_beli1msg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input onfocus="this.select()" type="text" name="keterangan1" value="<?= $dataval['keterangan'] ?>" onkeyup="HarusBayar()" id="keterangan1" class="form-control keterangan1" placeholder="Masukan Keterangan">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback keterangan1msg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Total Harga</td>
                                            <td id="totalhargaedit"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btnedit" id="btntambah">Tambah</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php elseif ($kel == 6) : ?>
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Data <?= $dataval['kode'] ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/tambahbuyback" id="tambahbuyback" class="tambahbuyback" name="tambahbuyback">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Qty</label>
                                    <input onfocus="this.select()" value="<?= $dataval['saldo'] ?>" type="number" id="qty1" onkeyup="HarusBayar()" name="qty1" class="form-control" placeholder="Masukan QTY">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback qty1msg">
                                    </div>
                                    <input type="hidden" name="id" id="id" value="<?= $dataval['id_detail_penjualan'] ?>">
                                    <input type="hidden" name="kel" id="kel" value="<?= $kel ?>">
                                    <input type="hidden" name="iddate" id="iddate" value="<?= $databuyback ?>">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Harga Beli</label>
                                    <input onfocus="this.select()" type="number" value="<?= $dataval['harga_beli'] ?>" name="harga_beli1" onkeyup="HarusBayar()" id="harga_beli1" class="form-control harga_beli1" placeholder="Masukan Harga Beli">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback harga_beli1msg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input onfocus="this.select()" type="text" name="keterangan1" value="<?= $dataval['keterangan'] ?>" onkeyup="HarusBayar()" id="keterangan1" class="form-control keterangan1" placeholder="Masukan Keterangan">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback keterangan1msg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Total Harga</td>
                                            <td id="totalhargaedit"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btnedit" id="btntambah">Tambah</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endif; ?>
<script>
    $('#tambahbuyback').submit(function(e) {
        e.preventDefault()
        let form = $('.tambahbuyback')[0];
        let data = new FormData(form)
        Swal.fire({
            title: 'Tambah',
            text: "Yakin ingin Buyback Barang ini ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Tambah',
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    data: data,
                    url: "<?php echo base_url('/tambahbuyback'); ?>",
                    contentType: false,
                    processData: false,
                    cache: false,
                    dataType: "json",
                    success: function(result) {
                        if (result.error) {
                            if (result.error.kurang) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: result.error.kurang,
                                })
                            }
                            if (result.error.nilai_tukar1) {
                                $('#nilai_tukar1').addClass('is-invalid')
                                $('.nilai_tukar1msg').html(result.error.nilai_tukar1)
                            } else {
                                $('#nilai_tukar1').removeClass('is-invalid')
                                $('.nilai_tukar1msg').html('')
                            }
                            if (result.error.berat1) {
                                $('#berat1').addClass('is-invalid')
                                $('.berat1msg').html(result.error.berat1)
                            } else {
                                $('#berat1').removeClass('is-invalid')
                                $('.berat1msg').html('')
                            }
                            if (result.error.harga_beli1) {
                                $('#harga_beli1').addClass('is-invalid')
                                $('.harga_beli1msg').html(result.error.harga_beli1)
                            } else {
                                $('#harga_beli1').removeClass('is-invalid')
                                $('.harga_beli1msg').html('')
                            }
                            if (result.error.qty1) {
                                $('#qty1').addClass('is-invalid')
                                $('.qty1msg').html(result.error.qty1)
                            } else {
                                $('#qty1').removeClass('is-invalid')
                                $('.qty1msg').html('')
                            }
                            if (result.error.carat1) {
                                $('#carat1').addClass('is-invalid')
                                $('.carat1msg').html(result.error.carat1)
                            } else {
                                $('#carat1').removeClass('is-invalid')
                                $('.carat1msg').html('')
                            }
                        } else {
                            $('#nilai_tukar1').removeClass('is-invalid')
                            $('.nilai_tukar1msg').html('')
                            $('#jenis').removeClass('is-invalid')
                            $('.jenismsg').html('')
                            $('#berat1').removeClass('is-invalid')
                            $('.berat1msg').html('')
                            $('#harga_beli1').removeClass('is-invalid')
                            $('.harga_beli1msg').html('')
                            $('#qty1').removeClass('is-invalid')
                            $('.qty1msg').html('')
                            $('#carat1').removeClass('is-invalid')
                            $('.carat1msg').html('')
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Tambah',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK',
                                allowOutsideClick: false
                            }).then((choose) => {
                                if (choose.isConfirmed) {
                                    $('#modal-edit').modal('toggle');
                                    $('#modal-nota').modal('toggle');
                                    tampildatabuyback()
                                }
                            })
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                })
            }
        })
    })
    $(document).ready(function() {
        $('#btntambah').click(function() {
            $('#tambahbuyback').submit();
        });
        HarusBayar()
    })
</script>