<?php if ($kel == 1) : ?>
    <div class="modal-body">
        <input type="hidden" name="iddetail" id="iddetail" value="<?= $barang['id_stock_1'] ?>">
        <input type="hidden" name="kel" id="kel" value="<?= $kel ?>">
        <div class="row">
            <div class="col-sm-2">
                <!-- text input -->
                <div class="form-group merek">
                    <label>Merek</label>
                    <select name="merek" class="form-control" id="merek">
                        <?php foreach ($merek as $m) : ?>
                            <option value="<?= $m['nama_merek'] ?>" <?= ($barang['merek'] == $m['nama_merek']) ? 'Selected' : '' ?>><?= $m['nama_merek'] ?></option>
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
                            <option value="<?= $m['nama_kadar'] ?>" <?= ($barang['kadar'] == $m['nama_kadar']) ? 'Selected' : '' ?>><?= $m['nama_kadar'] ?></option>
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
                            <option value="<?= $m['nama'] ?>" <?= ($barang['jenis'] == $m['nama']) ? 'Selected' : '' ?>><?= $m['nama'] ?></option>
                        <?php endforeach; ?>
                        <option value="-">-</option>
                    </select>
                    <!-- <input onfocus="this.select()" type="text" name="jenis" id="jenis" class="form-control" placeholder="Masukan Jenis"> -->
                    <div id="validationServerUsernameFeedback" class="invalid-feedback jenismsg">
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <!-- text input -->
                <div class="form-group">
                    <label>Berat</label>
                    <input onfocus="this.select()" type="number" value="<?= $barang['berat'] ?>" step="0.01" id="berat" name="berat" class="form-control" placeholder="Masukan Berat Bersih">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback beratmsg">
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label>Model</label>
                    <input onfocus="this.select()" type="text" value="<?= $barang['model'] ?>" name="model" id="model" class="form-control" placeholder="Masukan Model Barang">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Keterangan</label>
                    <input onfocus="this.select()" type="text" value="<?= $barang['keterangan'] ?>" name="keterangan" id="keterangan" class="form-control" placeholder="Masukan Keterangan">
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Qty</label>
                    <input onfocus="this.select()" type="Number" value="<?= $barang['qty'] ?>" id="qty" name="qty" class="form-control" placeholder="Masukan jumlah">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback qtymsg">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Nilai Tukar</label>
                    <input onfocus="this.select()" type="number" value="<?= $barang['nilai_tukar'] ?>" id="nilai_tukar" name="nilai_tukar" class="form-control" placeholder="Masukan Nilai Tukar">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback nilai_tukarmsg">
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <!-- text input -->
                <div class="form-group">
                    <label>Ongkos</label>
                    <input onfocus="this.select()" type="number" value="<?= $barang['ongkos'] ?>" value="0" name="ongkos" id="ongkos" class="form-control ongkos" placeholder="Masukan Ongkos">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback ongkosmsg">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Harga Beli</label>
                    <input onfocus="this.select()" type="number" value="<?= $barang['harga_beli'] ?>" name="harga_beli" id="harga_beli" class="form-control harga_beli" placeholder="Masukan Harga Beli">
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
<?php elseif ($kel == 2) : ?>
    <input type="hidden" name="iddetail" id="iddetail" value="<?= $barang['id_stock_2'] ?>">
    <input type="hidden" name="kel" id="kel" value="<?= $kel ?>">
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-2">
                <!-- text input -->
                <div class="form-group merek">
                    <label>Merek</label>
                    <select name="merek" class="form-control" id="merek">
                        <?php foreach ($merek as $m) : ?>
                            <option value="<?= $m['nama_merek'] ?>" <?= ($barang['merek'] == $m['nama_merek']) ? 'Selected' : '' ?>><?= $m['nama_merek'] ?></option>
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
                            <option value="<?= $m['nama_kadar'] ?>" <?= ($barang['kadar'] == $m['nama_kadar']) ? 'Selected' : '' ?>><?= $m['nama_kadar'] ?></option>
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
                            <option value="<?= $m['nama'] ?>" <?= ($barang['jenis'] == $m['nama']) ? 'Selected' : '' ?>><?= $m['nama'] ?></option>
                        <?php endforeach; ?>
                        <option value="-">-</option>
                    </select>
                    <!-- <input onfocus="this.select()" type="text" name="jenis" id="jenis" class="form-control" placeholder="Masukan Jenis"> -->
                    <div id="validationServerUsernameFeedback" class="invalid-feedback jenismsg">
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <!-- text input -->
                <div class="form-group">
                    <label>Berat</label>
                    <input onfocus="this.select()" type="number" value="<?= $barang['berat'] ?>" step="0.01" id="berat" name="berat" class="form-control" placeholder="Masukan Berat Bersih">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback beratmsg">
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label>Model</label>
                    <input onfocus="this.select()" type="text" value="<?= $barang['model'] ?>" name="model" id="model" class="form-control" placeholder="Masukan Model Barang">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Keterangan</label>
                    <input onfocus="this.select()" type="text" value="<?= $barang['keterangan'] ?>" name="keterangan" id="keterangan" class="form-control" placeholder="Masukan Keterangan">
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Qty</label>
                    <input onfocus="this.select()" type="Number" value="<?= $barang['qty'] ?>" id="qty" name="qty" class="form-control" placeholder="Masukan jumlah">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback qtymsg">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Harga Beli</label>
                    <input onfocus="this.select()" type="number" value="<?= $barang['harga_beli'] ?>" name="harga_beli" id="harga_beli" class="form-control harga_beli" placeholder="Masukan Harga Beli">
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
<?php elseif ($kel == 3) : ?>
    <input type="hidden" name="iddetail" id="iddetail" value="<?= $barang['id_stock_3'] ?>">
    <input type="hidden" name="kel" id="kel" value="<?= $kel ?>">
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-2">
                <!-- text input -->
                <div class="form-group merek">
                    <label>Merek</label>
                    <select name="merek" class="form-control" id="merek">
                        <?php foreach ($merek as $m) : ?>
                            <option value="<?= $m['nama_merek'] ?>" <?= ($barang['merek'] == $m['nama_merek']) ? 'Selected' : '' ?>><?= $m['nama_merek'] ?></option>
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
                            <option value="<?= $m['nama_kadar'] ?>" <?= ($barang['kadar'] == $m['nama_kadar']) ? 'Selected' : '' ?>><?= $m['nama_kadar'] ?></option>
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
                            <option value="<?= $m['nama'] ?>" <?= ($barang['jenis'] == $m['nama']) ? 'Selected' : '' ?>><?= $m['nama'] ?></option>
                        <?php endforeach; ?>
                        <option value="-">-</option>
                    </select>
                    <!-- <input onfocus="this.select()" type="text" name="jenis" id="jenis" class="form-control" placeholder="Masukan Jenis"> -->
                    <div id="validationServerUsernameFeedback" class="invalid-feedback jenismsg">
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <!-- text input -->
                <div class="form-group">
                    <label>Berat</label>
                    <input onfocus="this.select()" type="number" value="<?= $barang['berat'] ?>" step="0.01" id="berat" name="berat" class="form-control" placeholder="Masukan Berat Bersih">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback beratmsg">
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label>Model</label>
                    <input onfocus="this.select()" type="text" value="<?= $barang['model'] ?>" name="model" id="model" class="form-control" placeholder="Masukan Model Barang">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Keterangan</label>
                    <input onfocus="this.select()" type="text" value="<?= $barang['keterangan'] ?>" name="keterangan" id="keterangan" class="form-control" placeholder="Masukan Keterangan">
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Qty</label>
                    <input onfocus="this.select()" type="Number" value="<?= $barang['qty'] ?>" id="qty" name="qty" class="form-control" placeholder="Masukan jumlah">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback qtymsg">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Harga Beli</label>
                    <input onfocus="this.select()" type="number" value="<?= $barang['harga_beli'] ?>" name="harga_beli" id="harga_beli" class="form-control harga_beli" placeholder="Masukan Harga Beli">
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
<?php elseif ($kel == 4) : ?>
    <input type="hidden" name="iddetail" id="iddetail" value="<?= $barang['id_stock_4'] ?>">
    <input type="hidden" name="kel" id="kel" value="<?= $kel ?>">
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-2">
                <!-- text input -->
                <div class="form-group">
                    <label>Kadar</label>
                    <select name="kadar" class="form-control" id="kadar">
                        <?php foreach ($kadar as $m) : ?>
                            <option value="<?= $m['nama_kadar'] ?>" <?= ($barang['kadar'] == $m['nama_kadar']) ? 'Selected' : '' ?>><?= $m['nama_kadar'] ?></option>
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
                            <option value="<?= $m['nama'] ?>" <?= ($barang['jenis'] == $m['nama']) ? 'Selected' : '' ?>><?= $m['nama'] ?></option>
                        <?php endforeach; ?>
                        <option value="-">-</option>
                    </select>
                    <!-- <input onfocus="this.select()" type="text" name="jenis" id="jenis" class="form-control" placeholder="Masukan Jenis"> -->
                    <div id="validationServerUsernameFeedback" class="invalid-feedback jenismsg">
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <!-- text input -->
                <div class="form-group">
                    <label>Berat</label>
                    <input onfocus="this.select()" type="number" value="<?= $barang['berat'] ?>" step="0.01" id="berat" name="berat" class="form-control" placeholder="Masukan Berat Bersih">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback beratmsg">
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label>Model</label>
                    <input onfocus="this.select()" type="text" value="<?= $barang['model'] ?>" name="model" id="model" class="form-control" placeholder="Masukan Model Barang">
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Keterangan</label>
                    <input onfocus="this.select()" type="text" value="<?= $barang['keterangan'] ?>" name="keterangan" id="keterangan" class="form-control" placeholder="Masukan Keterangan">
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Qty</label>
                    <input onfocus="this.select()" type="Number" value="<?= $barang['qty'] ?>" id="qty" name="qty" class="form-control" placeholder="Masukan jumlah">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback qtymsg">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Harga Beli</label>
                    <input onfocus="this.select()" type="number" value="<?= $barang['harga_beli'] ?>" name="harga_beli" id="harga_beli" class="form-control harga_beli" placeholder="Masukan Harga Beli">
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
<?php elseif ($kel == 5) : ?>
    <input type="hidden" name="iddetail" id="iddetail" value="<?= $barang['id_stock_5'] ?>">
    <input type="hidden" name="kel" id="kel" value="<?= $kel ?>">
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-2">
                <!-- text input -->
                <div class="form-group">
                    <label>Jenis</label>
                    <select name="jenis" class="form-control" id="jenis">
                        <?php foreach ($jenis as $m) : ?>
                            <option value="<?= $m['nama'] ?>" <?= ($barang['jenis'] == $m['nama']) ? 'Selected' : '' ?>><?= $m['nama'] ?></option>
                        <?php endforeach; ?>
                        <option value="-">-</option>
                    </select>
                    <!-- <input onfocus="this.select()" type="text" name="jenis" id="jenis" class="form-control" placeholder="Masukan Jenis"> -->
                    <div id="validationServerUsernameFeedback" class="invalid-feedback jenismsg">
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <!-- text input -->
                <div class="form-group">
                    <label>Carat</label>
                    <input onfocus="this.select()" type="number" value="<?= $barang['carat'] ?>" step="0.01" id="carat" name="carat" class="form-control" placeholder="Masukan Carat Bersih">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback caratmsg">
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label>Model</label>
                    <input onfocus="this.select()" type="text" value="<?= $barang['model'] ?>" name="model" id="model" class="form-control" placeholder="Masukan Model Barang">
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Keterangan</label>
                    <input onfocus="this.select()" type="text" value="<?= $barang['keterangan'] ?>" name="keterangan" id="keterangan" class="form-control" placeholder="Masukan Keterangan">
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Qty</label>
                    <input onfocus="this.select()" type="Number" value="<?= $barang['qty'] ?>" id="qty" name="qty" class="form-control" placeholder="Masukan jumlah">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback qtymsg">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Harga Beli</label>
                    <input onfocus="this.select()" type="number" value="<?= $barang['harga_beli'] ?>" name="harga_beli" id="harga_beli" class="form-control harga_beli" placeholder="Masukan Harga Beli">
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
<?php elseif ($kel == 6) : ?>
    <input type="hidden" name="iddetail" id="iddetail" value="<?= $barang['id_stock_6'] ?>">
    <input type="hidden" name="kel" id="kel" value="<?= $kel ?>">
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-2">
                <!-- text input -->
                <div class="form-group merek">
                    <label>Merek</label>
                    <select name="merek" class="form-control" id="merek">
                        <?php foreach ($merek as $m) : ?>
                            <option value="<?= $m['nama_merek'] ?>" <?= ($barang['merek'] == $m['nama_merek']) ? 'Selected' : '' ?>><?= $m['nama_merek'] ?></option>
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
                            <option value="<?= $m['nama'] ?>" <?= ($barang['jenis'] == $m['nama']) ? 'Selected' : '' ?>><?= $m['nama'] ?></option>
                        <?php endforeach; ?>
                        <option value="-">-</option>
                    </select>
                    <!-- <input onfocus="this.select()" type="text" name="jenis" id="jenis" class="form-control" placeholder="Masukan Jenis"> -->
                    <div id="validationServerUsernameFeedback" class="invalid-feedback jenismsg">
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label>Model</label>
                    <input onfocus="this.select()" type="text" value="<?= $barang['model'] ?>" name="model" id="model" class="form-control" placeholder="Masukan Model Barang">
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Keterangan</label>
                    <input onfocus="this.select()" type="text" value="<?= $barang['keterangan'] ?>" name="keterangan" id="keterangan" class="form-control" placeholder="Masukan Keterangan">
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Qty</label>
                    <input onfocus="this.select()" type="Number" value="<?= $barang['qty'] ?>" id="qty" name="qty" class="form-control" placeholder="Masukan jumlah">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback qtymsg">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Harga Beli</label>
                    <input onfocus="this.select()" type="number" value="<?= $barang['harga_beli'] ?>" name="harga_beli" id="harga_beli" class="form-control harga_beli" placeholder="Masukan Harga Beli">
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
<?php endif; ?>