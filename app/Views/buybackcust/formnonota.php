<?php if ($kel == 1) : ?>
    <input type="hidden" name="carat" value="0">
    <div class="row">
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Jenis</label>
                <select name="jenis" class="form-control" id="jenis">
                    <?php foreach ($jenis as $m) : ?>
                        <option value="<?= $m['nama'] ?>"><?= $m['nama'] ?> </option>
                    <?php endforeach; ?>
                    <option value="-">-</option>
                </select>
                <!-- <input onfocus="this.select()" type="text" name="jenis" id="jenis" class="form-control" placeholder="Masukan Jenis"> -->
                <div id="validationServerUsernameFeedback" class="invalid-feedback jenismsg">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Model</label>
                <input onfocus="this.select()" type="text" name="model" id="model" class="form-control" placeholder="Masukan Model Barang">
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Keterangan</label>
                <input onfocus="this.select()" type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Masukan Keterangan">
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Merek</label>
                <select name="merek" class="form-control" id="merek">
                    <?php foreach ($merek as $m) : ?>
                        <option value="<?= $m['nama_merek'] ?>"><?= $m['nama_merek'] ?> </option>
                    <?php endforeach; ?>
                    <option value="-">-</option>
                </select>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Kadar</label>
                <select name="kadar" class="form-control" id="kadar">
                    <?php foreach ($kadar as $m) : ?>
                        <option value="<?= $m['nama_kadar'] ?>"><?= $m['nama_kadar'] ?> </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Berat</label>
                <input onfocus="this.select()" type="number" onkeyup="totalharga()" step="0.01" id="berat" name="berat" class="form-control" placeholder="Masukan Berat">
                <div id="validationServerUsernameFeedback" class="invalid-feedback beratmsg">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Qty</label>
                <input onfocus="this.select()" type="Number" id="qty" onkeyup="totalharga()" name="qty" min="1" class="form-control" placeholder="Masukan qty">
                <div id="validationServerUsernameFeedback" class="invalid-feedback qtymsg">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Nilai Tukar</label>
                <input onfocus="this.select()" type="number" value="100" id="nilai_tukar" onkeyup="totalharga()" name="nilai_tukar" class="form-control" placeholder="Masukan Nilai Tukar">
                <div id="validationServerUsernameFeedback" class="invalid-feedback nilai_tukarmsg">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Harga Beli</label>
                <input onfocus="this.select()" type="number" name="harga_beli" onkeyup="totalharga()" id="harga_beli" class="form-control harga_beli" placeholder="Masukan Harga Beli">
                <div id="validationServerUsernameFeedback" class="invalid-feedback harga_belimsg">
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <!-- text input -->
            <div class="form-group">
                <label>Status Barang</label>
                <select name="status_proses" class="form-control" id="status" name="status">
                    <option value="Cuci">Cuci</option>
                    <option value="Retur">Retur Sales</option>
                    <option value="Lebur">Lebur</option>
                </select>
            </div>
        </div>
        <div class="col-sm-1">
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
<?php elseif ($kel == 2) : ?>
    <input type="hidden" name="carat" value="0">
    <input type="hidden" name="nilai_tukar" value="0">
    <div class="row">
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Jenis</label>
                <select name="jenis" class="form-control" id="jenis">
                    <?php foreach ($jenis as $m) : ?>
                        <option value="<?= $m['nama'] ?>"><?= $m['nama'] ?> </option>
                    <?php endforeach; ?>
                    <option value="-">-</option>
                </select>
                <!-- <input onfocus="this.select()" type="text" name="jenis" id="jenis" class="form-control" placeholder="Masukan Jenis"> -->
                <div id="validationServerUsernameFeedback" class="invalid-feedback jenismsg">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Model</label>
                <input onfocus="this.select()" type="text" name="model" id="model" class="form-control" placeholder="Masukan Model Barang">
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Keterangan</label>
                <input onfocus="this.select()" type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Masukan Keterangan">
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Merek</label>
                <select name="merek" class="form-control" id="merek">
                    <?php foreach ($merek as $m) : ?>
                        <option value="<?= $m['nama_merek'] ?>"><?= $m['nama_merek'] ?> </option>
                    <?php endforeach; ?>
                    <option value="-">-</option>
                </select>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Kadar</label>
                <select name="kadar" class="form-control" id="kadar">
                    <?php foreach ($kadar as $m) : ?>
                        <option value="<?= $m['nama_kadar'] ?>"><?= $m['nama_kadar'] ?> </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Berat</label>
                <input onfocus="this.select()" type="number" onkeyup="totalharga()" step="0.01" id="berat" name="berat" class="form-control" placeholder="Masukan Berat">
                <div id="validationServerUsernameFeedback" class="invalid-feedback beratmsg">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Qty</label>
                <input onfocus="this.select()" type="Number" id="qty" onkeyup="totalharga()" name="qty" min="1" class="form-control" placeholder="Masukan qty">
                <div id="validationServerUsernameFeedback" class="invalid-feedback qtymsg">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Harga Beli</label>
                <input onfocus="this.select()" type="number" name="harga_beli" onkeyup="totalharga()" id="harga_beli" class="form-control harga_beli" placeholder="Masukan Harga Beli">
                <div id="validationServerUsernameFeedback" class="invalid-feedback harga_belimsg">
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <!-- text input -->
            <div class="form-group">
                <label>Status Barang</label>
                <select name="status_proses" class="form-control" id="status" name="status">
                    <option value="Cuci">Cuci</option>
                    <option value="Retur">Retur Sales</option>
                    <option value="Lebur">Lebur</option>
                </select>
            </div>
        </div>
        <div class="col-sm-1">
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
<?php elseif ($kel == 3) : ?>
    <input type="hidden" name="carat" value="0">
    <input type="hidden" name="nilai_tukar" value="0">
    <input type="hidden" name="status_proses" value="Murni">
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <a href="#" onclick="ModalBarcode(3)"><label>Barcode</label></a>
                <input onfocus="this.select()" type="text" onkeyup="PilihBarcode($('#barcode').val())" id="barcode" name="barcode" class="form-control" placeholder="Masukan barcode">
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Jenis</label>
                <select name="jenis" class="form-control" id="jenis">
                    <?php foreach ($jenis as $m) : ?>
                        <option value="<?= $m['nama'] ?>"><?= $m['nama'] ?> </option>
                    <?php endforeach; ?>
                    <option value="-">-</option>
                </select>
                <!-- <input onfocus="this.select()" type="text" name="jenis" id="jenis" class="form-control" placeholder="Masukan Jenis"> -->
                <div id="validationServerUsernameFeedback" class="invalid-feedback jenismsg">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Model</label>
                <input onfocus="this.select()" type="text" name="model" id="model" class="form-control" placeholder="Masukan Model Barang">
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Keterangan</label>
                <input onfocus="this.select()" type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Masukan Keterangan">
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Merek</label>
                <select name="merek" class="form-control" id="merek">
                    <?php foreach ($merek as $m) : ?>
                        <option value="<?= $m['nama_merek'] ?>"><?= $m['nama_merek'] ?> </option>
                    <?php endforeach; ?>
                    <option value="-">-</option>
                </select>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Berat</label>
                <input onfocus="this.select()" type="number" onkeyup="totalharga()" step="0.01" id="berat" name="berat" class="form-control" placeholder="Masukan Berat">
                <div id="validationServerUsernameFeedback" class="invalid-feedback beratmsg">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Qty</label>
                <input onfocus="this.select()" type="Number" id="qty" onkeyup="totalharga()" name="qty" min="1" class="form-control" placeholder="Masukan qty">
                <div id="validationServerUsernameFeedback" class="invalid-feedback qtymsg">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Harga Beli</label>
                <input onfocus="this.select()" type="number" name="harga_beli" onkeyup="totalharga()" id="harga_beli" class="form-control harga_beli" placeholder="Masukan Harga Beli">
                <div id="validationServerUsernameFeedback" class="invalid-feedback harga_belimsg">
                </div>
            </div>
        </div>
        <div class="col-sm-1">
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
<?php elseif ($kel == 4) : ?>
    <input type="hidden" name="carat" value="0">
    <input type="hidden" name="nilai_tukar" value="0">
    <input type="hidden" name="qty" value="1">
    <input type="hidden" name="status_proses" value="Murni">
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <a href="#" onclick="ModalBarcode(4)"><label>Barcode</label></a>
                <input onfocus="this.select()" type="text" onkeyup="PilihBarcode($('#barcode').val())" id="barcode" name="barcode" class="form-control" placeholder="Masukan barcode">
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Jenis</label>
                <select name="jenis" class="form-control" id="jenis">
                    <?php foreach ($jenis as $m) : ?>
                        <option value="<?= $m['nama'] ?>"><?= $m['nama'] ?> </option>
                    <?php endforeach; ?>
                    <option value="-">-</option>
                </select>
                <!-- <input onfocus="this.select()" type="text" name="jenis" id="jenis" class="form-control" placeholder="Masukan Jenis"> -->
                <div id="validationServerUsernameFeedback" class="invalid-feedback jenismsg">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Model</label>
                <input onfocus="this.select()" type="text" name="model" id="model" class="form-control" placeholder="Masukan Model Barang">
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Keterangan</label>
                <input onfocus="this.select()" type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Masukan Keterangan">
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Berat</label>
                <input onfocus="this.select()" type="number" onkeyup="totalharga()" step="0.01" id="berat" name="berat" class="form-control" placeholder="Masukan Berat">
                <div id="validationServerUsernameFeedback" class="invalid-feedback beratmsg">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Harga Beli</label>
                <input onfocus="this.select()" type="number" name="harga_beli" onkeyup="totalharga()" id="harga_beli" class="form-control harga_beli" placeholder="Masukan Harga Beli">
                <div id="validationServerUsernameFeedback" class="invalid-feedback harga_belimsg">
                </div>
            </div>
        </div>
        <div class="col-sm-1">
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
<?php elseif ($kel == 5) : ?>
    <input type="hidden" name="berat" value="0">
    <input type="hidden" name="nilai_tukar" value="0">
    <input type="hidden" name="status_proses" value="Murni">
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <a href="#" onclick="ModalBarcode(5)"><label>Barcode</label></a>
                <input onfocus="this.select()" type=" text" onkeyup="PilihBarcode($('#barcode').val())" id="barcode" name="barcode" class="form-control" placeholder="Masukan barcode">
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Jenis</label>
                <select name="jenis" class="form-control" id="jenis">
                    <?php foreach ($jenis as $m) : ?>
                        <option value="<?= $m['nama'] ?>"><?= $m['nama'] ?> </option>
                    <?php endforeach; ?>
                    <option value="-">-</option>
                </select>
                <!-- <input onfocus="this.select()" type="text" name="jenis" id="jenis" class="form-control" placeholder="Masukan Jenis"> -->
                <div id="validationServerUsernameFeedback" class="invalid-feedback jenismsg">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Model</label>
                <input onfocus="this.select()" type="text" name="model" id="model" class="form-control" placeholder="Masukan Model Barang">
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Keterangan</label>
                <input onfocus="this.select()" type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Masukan Keterangan">
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Carat</label>
                <input onfocus="this.select()" type="number" onkeyup="totalharga()" step="0.01" id="carat" name="carat" class="form-control" placeholder="Masukan Carat">
                <div id="validationServerUsernameFeedback" class="invalid-feedback caratmsg">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Qty</label>
                <input onfocus="this.select()" type="Number" id="qty" onkeyup="totalharga()" name="qty" min="1" class="form-control" placeholder="Masukan qty">
                <div id="validationServerUsernameFeedback" class="invalid-feedback qtymsg">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Harga Beli</label>
                <input onfocus="this.select()" type="number" name="harga_beli" onkeyup="totalharga()" id="harga_beli" class="form-control harga_beli" placeholder="Masukan Harga Beli">
                <div id="validationServerUsernameFeedback" class="invalid-feedback harga_belimsg">
                </div>
            </div>
        </div>
        <div class="col-sm-1">
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
<?php elseif ($kel == 6) : ?>
    <input type="hidden" name="carat" value="0">
    <input type="hidden" name="berat" value="0">
    <input type="hidden" name="nilai_tukar" value="0">
    <input type="hidden" name="kadar" value="-">
    <input type="hidden" name="status_proses" value="Murni">
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <a href="#" onclick="ModalBarcode(6)"><label>Barcode</label></a>
                <input onfocus="this.select()" type="text" onkeyup="PilihBarcode($('#barcode').val())" id="barcode" name="barcode" class="form-control" placeholder="Masukan barcode">
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Jenis</label>
                <select name="jenis" class="form-control" id="jenis">
                    <?php foreach ($jenis as $m) : ?>
                        <option value="<?= $m['nama'] ?>"><?= $m['nama'] ?> </option>
                    <?php endforeach; ?>
                    <option value="-">-</option>
                </select>
                <!-- <input onfocus="this.select()" type="text" name="jenis" id="jenis" class="form-control" placeholder="Masukan Jenis"> -->
                <div id="validationServerUsernameFeedback" class="invalid-feedback jenismsg">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Model</label>
                <input onfocus="this.select()" type="text" name="model" id="model" class="form-control" placeholder="Masukan Model Barang">
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Keterangan</label>
                <input onfocus="this.select()" type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Masukan Keterangan">
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Merek</label>
                <select name="merek" class="form-control" id="merek">
                    <?php foreach ($merek as $m) : ?>
                        <option value="<?= $m['nama_merek'] ?>"><?= $m['nama_merek'] ?> </option>
                    <?php endforeach; ?>
                    <option value="-">-</option>
                </select>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Qty</label>
                <input onfocus="this.select()" type="Number" id="qty" onkeyup="totalharga()" name="qty" min="1" class="form-control" placeholder="Masukan qty">
                <div id="validationServerUsernameFeedback" class="invalid-feedback qtymsg">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Harga Beli</label>
                <input onfocus="this.select()" type="number" name="harga_beli" onkeyup="totalharga()" id="harga_beli" class="form-control harga_beli" placeholder="Masukan Harga Beli">
                <div id="validationServerUsernameFeedback" class="invalid-feedback harga_belimsg">
                </div>
            </div>
        </div>
        <div class="col-sm-1">
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
<?php endif; ?>