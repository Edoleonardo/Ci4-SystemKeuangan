<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Edit Opname</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/kodebarcode" name="formkodebarcode" id="formkodebarcode" class="formkodebarcode" method="post">
                    <?= csrf_field(); ?>
                    <div class="p-0" style="margin: 10px;">
                        <div class="row">
                            <div class="col-sm-2">
                                <!-- text input -->
                                <div class="form-group merek">
                                    <label>Merek</label>
                                    <select name="merek" class="form-control" id="merek">
                                        <?php foreach ($merek as $m) : ?>
                                            <option value="<?= $m['nama_merek'] ?>"><?= $m['nama_merek'] ?> </option>
                                        <?php endforeach; ?>
                                        <option value="-">-</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Kadar</label>
                                    <select name="kadar" class="form-control" id="kadar">
                                        <?php foreach ($kadar as $m) : ?>
                                            <option value="<?= $m['nama_kadar'] ?>"><?= $m['nama_kadar'] ?> </option>
                                        <?php endforeach; ?>
                                        <option value="-">-</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Jenis</label>
                                    <select name="jenis" class="form-control" id="jenis">
                                        <?php foreach ($jenis as $m) : ?>
                                            <option value="<?= $m['nama'] ?>"><?= $m['nama'] ?> </option>
                                        <?php endforeach; ?>
                                        <option value="-">-</option>
                                    </select>
                                    <!-- <input type="text" name="jenis" id="jenis" class="form-control" placeholder="Masukan Jenis"> -->
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback jenismsg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Berat</label>
                                    <input type="number" step="0.01" id="berat" value="<?= $barang['berat'] ?>" name="berat" class="form-control" placeholder="Masukan Berat Bersih">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback beratmsg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Model</label>
                                    <input type="text" name="model" value="<?= $barang['model'] ?>" id="model" class="form-control" placeholder="Masukan Model Barang">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" name="keterangan" value="<?= $barang['keterangan'] ?>" id="keterangan" class="form-control" placeholder="Masukan Keterangan">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Qty</label>
                                    <input type="Number" id="qty" name="qty" value="<?= $barang['qty'] ?>" min="1" class="form-control" placeholder="Masukan jumlah">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback qtymsg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Nilai Tukar</label>
                                    <input type="number" id="nilai_tukar" name="nilai_tukar" value="<?= $barang['nilai_tukar'] ?>" class="form-control" placeholder="Masukan Nilai Tukar">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback nilai_tukarmsg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Harga Beli</label>
                                    <input type="number" name="harga_beli" id="harga_beli" value="<?= $barang['harga_beli'] ?>" class="form-control harga_beli" placeholder="Masukan Harga Beli">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback harga_belimsg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Foto</label><br>
                                    <button type="button" id="ambilgbr" class="btn btn-primary" data-toggle="modal" data-target="#modal-foto" onclick="cameranyala()">
                                        <i class="fa fa-camera"></i>
                                    </button>
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback ambilgbrmsg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary btntambah">Selesai Edit</button>
            </div>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>