<?php if ($kel == 1) : ?>
    <div class="modal-body">
        <input type="hidden" name="iddetail1" id="iddetail1" value="<?= $barang['id_detail_pembelian'] ?>">
        <input type="hidden" name="kel1" id="kel1" value="<?= $kel ?>">
        <input type="hidden" name="jenis_u" id="jenis_u" value="<?= $jenis_u ?>">
        <input type="hidden" name="nm_img" id="nm_img" value="<?= $barang['nama_img'] ?>">
        <div class="row">
            <div class="col-sm-2">
                <!-- text input -->
                <div class="form-group merek1">
                    <label>Merek</label>
                    <select name="merek1" class="form-control" id="merek1">
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
                    <select name="kadar1" class="form-control" id="kadar1">
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
                    <select name="jenis1" class="form-control" id="jenis1">
                        <?php foreach ($jenis as $m) : ?>
                            <option value="<?= $m['nama'] ?>" <?= ($barang['jenis'] == $m['nama']) ? 'Selected' : '' ?>><?= $m['nama'] ?></option>
                        <?php endforeach; ?>
                        <option value="-">-</option>
                    </select>
                    <!-- <input onfocus="this.select()" type="text" name="jenis1" id="jenis1" class="form-control" placeholder="Masukan Jenis"> -->
                    <div id="validationServerUsernameFeedback" class="invalid-feedback jenismsg">
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <!-- text input -->
                <div class="form-group">
                    <label>Berat</label>
                    <input onfocus="this.select()" type="number" value="<?= $barang['berat'] ?>" step="0.01" id="berat1" name="berat1" class="form-control" placeholder="Masukan Berat Bersih">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback berat1msg">
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label>Model</label>
                    <input onfocus="this.select()" type="text" value="<?= $barang['model'] ?>" name="model1" id="model1" class="form-control" placeholder="Masukan Model Barang">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Keterangan</label>
                    <input onfocus="this.select()" type="text" value="<?= $barang['keterangan'] ?>" name="keterangan1" id="keterangan1" class="form-control" placeholder="Masukan Keterangan">
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Qty</label>
                    <input onfocus="this.select()" type="Number" value="<?= $barang['qty'] ?>" id="qty1" name="qty1" class="form-control" placeholder="Masukan jumlah">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback qty1msg">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Nilai Tukar</label>
                    <input onfocus="this.select()" type="number" value="<?= $barang['nilai_tukar'] ?>" id="nilai_tukar1" name="nilai_tukar1" class="form-control" placeholder="Masukan Nilai Tukar">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback nilai_tukar1msg">
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <!-- text input -->
                <div class="form-group">
                    <label>Ongkos</label>
                    <input onfocus="this.select()" type="number" value="<?= $barang['ongkos'] ?>" value="0" name="ongkos1" id="ongkos1" class="form-control ongkos" placeholder="Masukan Ongkos">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback ongkos1msg">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Harga Beli</label>
                    <input onfocus="this.select()" type="number" value="<?= $barang['harga_beli'] ?>" name="harga_beli1" id="harga_beli1" class="form-control harga_beli" placeholder="Masukan Harga Beli">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback harga_beli1msg">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Foto</label><br>
                    <button type="button" id="ambilgbr1" class="btn btn-primary" data-toggle="modal" data-target="#modal-foto1" onclick="cameranyala1()">
                        <i class="fa fa-camera"></i>
                    </button>
                    <div id="validationServerUsernameFeedback" class="invalid-feedback ambilgbr1msg"></div>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($kel == 2) : ?>
    <input type="hidden" name="iddetail1" id="iddetail1" value="<?= $barang['id_detail_pembelian'] ?>">
    <input type="hidden" name="kel1" id="kel1" value="<?= $kel ?>">
    <input type="hidden" name="jenis_u" id="jenis_u" value="<?= $jenis_u ?>">
    <input type="hidden" name="nm_img" id="nm_img" value="<?= $barang['nama_img'] ?>">
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-2">
                <!-- text input -->
                <div class="form-group merek1">
                    <label>Merek</label>
                    <select name="merek1" class="form-control" id="merek1">
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
                    <select name="kadar1" class="form-control" id="kadar1">
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
                    <select name="jenis1" class="form-control" id="jenis1">
                        <?php foreach ($jenis as $m) : ?>
                            <option value="<?= $m['nama'] ?>" <?= ($barang['jenis'] == $m['nama']) ? 'Selected' : '' ?>><?= $m['nama'] ?></option>
                        <?php endforeach; ?>
                        <option value="-">-</option>
                    </select>
                    <!-- <input onfocus="this.select()" type="text" name="jenis1" id="jenis1" class="form-control" placeholder="Masukan Jenis"> -->
                    <div id="validationServerUsernameFeedback" class="invalid-feedback jenismsg">
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <!-- text input -->
                <div class="form-group">
                    <label>Berat</label>
                    <input onfocus="this.select()" type="number" value="<?= $barang['berat'] ?>" step="0.01" id="berat1" name="berat1" class="form-control" placeholder="Masukan Berat Bersih">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback berat1msg">
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label>Model</label>
                    <input onfocus="this.select()" type="text" value="<?= $barang['model'] ?>" name="model1" id="model1" class="form-control" placeholder="Masukan Model Barang">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Keterangan</label>
                    <input onfocus="this.select()" type="text" value="<?= $barang['keterangan'] ?>" name="keterangan1" id="keterangan1" class="form-control" placeholder="Masukan Keterangan">
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Qty</label>
                    <input onfocus="this.select()" type="Number" value="<?= $barang['qty'] ?>" id="qty1" name="qty1" class="form-control" placeholder="Masukan jumlah">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback qty1msg">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Harga Beli</label>
                    <input onfocus="this.select()" type="number" value="<?= $barang['harga_beli'] ?>" name="harga_beli1" id="harga_beli1" class="form-control harga_beli" placeholder="Masukan Harga Beli">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback harga_beli1msg">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Foto</label><br>
                    <button type="button" id="ambilgbr1" class="btn btn-primary" data-toggle="modal" data-target="#modal-foto1" onclick="cameranyala()">
                        <i class="fa fa-camera"></i>
                    </button>
                    <div id="validationServerUsernameFeedback" class="invalid-feedback ambilgbr1msg"></div>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($kel == 3) : ?>
    <input type="hidden" name="iddetail1" id="iddetail1" value="<?= $barang['id_detail_pembelian'] ?>">
    <input type="hidden" name="kel1" id="kel1" value="<?= $kel ?>">
    <input type="hidden" name="jenis_u" id="jenis_u" value="<?= $jenis_u ?>">
    <input type="hidden" name="nm_img" id="nm_img" value="<?= $barang['nama_img'] ?>">
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-2">
                <!-- text input -->
                <div class="form-group merek1">
                    <label>Merek</label>
                    <select name="merek1" class="form-control" id="merek1">
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
                    <select name="kadar1" class="form-control" id="kadar1">
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
                    <select name="jenis1" class="form-control" id="jenis1">
                        <?php foreach ($jenis as $m) : ?>
                            <option value="<?= $m['nama'] ?>" <?= ($barang['jenis'] == $m['nama']) ? 'Selected' : '' ?>><?= $m['nama'] ?></option>
                        <?php endforeach; ?>
                        <option value="-">-</option>
                    </select>
                    <!-- <input onfocus="this.select()" type="text" name="jenis1" id="jenis1" class="form-control" placeholder="Masukan Jenis"> -->
                    <div id="validationServerUsernameFeedback" class="invalid-feedback jenismsg">
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <!-- text input -->
                <div class="form-group">
                    <label>Berat</label>
                    <input onfocus="this.select()" type="number" value="<?= $barang['berat'] ?>" step="0.01" id="berat1" name="berat1" class="form-control" placeholder="Masukan Berat Bersih">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback berat1msg">
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label>Model</label>
                    <input onfocus="this.select()" type="text" value="<?= $barang['model'] ?>" name="model1" id="model1" class="form-control" placeholder="Masukan Model Barang">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Keterangan</label>
                    <input onfocus="this.select()" type="text" value="<?= $barang['keterangan'] ?>" name="keterangan1" id="keterangan1" class="form-control" placeholder="Masukan Keterangan">
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Qty</label>
                    <input onfocus="this.select()" type="Number" value="<?= $barang['qty'] ?>" id="qty1" name="qty1" class="form-control" placeholder="Masukan jumlah">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback qty1msg">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Harga Beli</label>
                    <input onfocus="this.select()" type="number" value="<?= $barang['harga_beli'] ?>" name="harga_beli1" id="harga_beli1" class="form-control harga_beli" placeholder="Masukan Harga Beli">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback harga_beli1msg">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Foto</label><br>
                    <button type="button" id="ambilgbr1" class="btn btn-primary" data-toggle="modal" data-target="#modal-foto1" onclick="cameranyala()">
                        <i class="fa fa-camera"></i>
                    </button>
                    <div id="validationServerUsernameFeedback" class="invalid-feedback ambilgbr1msg"></div>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($kel == 4) : ?>
    <input type="hidden" name="iddetail1" id="iddetail1" value="<?= $barang['id_detail_pembelian'] ?>">
    <input type="hidden" name="kel1" id="kel1" value="<?= $kel ?>">
    <input type="hidden" name="jenis_u" id="jenis_u" value="<?= $jenis_u ?>">
    <input type="hidden" name="nm_img" id="nm_img" value="<?= $barang['nama_img'] ?>">
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-2">
                <!-- text input -->
                <div class="form-group">
                    <label>Kadar</label>
                    <select name="kadar1" class="form-control" id="kadar1">
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
                    <select name="jenis1" class="form-control" id="jenis1">
                        <?php foreach ($jenis as $m) : ?>
                            <option value="<?= $m['nama'] ?>" <?= ($barang['jenis'] == $m['nama']) ? 'Selected' : '' ?>><?= $m['nama'] ?></option>
                        <?php endforeach; ?>
                        <option value="-">-</option>
                    </select>
                    <!-- <input onfocus="this.select()" type="text" name="jenis1" id="jenis1" class="form-control" placeholder="Masukan Jenis"> -->
                    <div id="validationServerUsernameFeedback" class="invalid-feedback jenismsg">
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <!-- text input -->
                <div class="form-group">
                    <label>Berat</label>
                    <input onfocus="this.select()" type="number" value="<?= $barang['berat'] ?>" step="0.01" id="berat1" name="berat1" class="form-control" placeholder="Masukan Berat Bersih">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback berat1msg">
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label>Model</label>
                    <input onfocus="this.select()" type="text" value="<?= $barang['model'] ?>" name="model1" id="model1" class="form-control" placeholder="Masukan Model Barang">
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Keterangan</label>
                    <input onfocus="this.select()" type="text" value="<?= $barang['keterangan'] ?>" name="keterangan1" id="keterangan1" class="form-control" placeholder="Masukan Keterangan">
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Qty</label>
                    <input onfocus="this.select()" type="Number" value="<?= $barang['qty'] ?>" id="qty1" name="qty1" class="form-control" placeholder="Masukan jumlah">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback qty1msg">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Harga Beli</label>
                    <input onfocus="this.select()" type="number" value="<?= $barang['harga_beli'] ?>" name="harga_beli1" id="harga_beli1" class="form-control harga_beli" placeholder="Masukan Harga Beli">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback harga_beli1msg">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Foto</label><br>
                    <button type="button" id="ambilgbr1" class="btn btn-primary" data-toggle="modal" data-target="#modal-foto1" onclick="cameranyala()">
                        <i class="fa fa-camera"></i>
                    </button>
                    <div id="validationServerUsernameFeedback" class="invalid-feedback ambilgbr1msg"></div>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($kel == 5) : ?>
    <input type="hidden" name="iddetail1" id="iddetail1" value="<?= $barang['id_detail_pembelian'] ?>">
    <input type="hidden" name="kel1" id="kel1" value="<?= $kel ?>">
    <input type="hidden" name="jenis_u" id="jenis_u" value="<?= $jenis_u ?>">
    <input type="hidden" name="nm_img" id="nm_img" value="<?= $barang['nama_img'] ?>">
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-2">
                <!-- text input -->
                <div class="form-group">
                    <label>Jenis</label>
                    <select name="jenis1" class="form-control" id="jenis1">
                        <?php foreach ($jenis as $m) : ?>
                            <option value="<?= $m['nama'] ?>" <?= ($barang['jenis'] == $m['nama']) ? 'Selected' : '' ?>><?= $m['nama'] ?></option>
                        <?php endforeach; ?>
                        <option value="-">-</option>
                    </select>
                    <!-- <input onfocus="this.select()" type="text" name="jenis1" id="jenis1" class="form-control" placeholder="Masukan Jenis"> -->
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
                    <input onfocus="this.select()" type="text" value="<?= $barang['model'] ?>" name="model1" id="model1" class="form-control" placeholder="Masukan Model Barang">
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Keterangan</label>
                    <input onfocus="this.select()" type="text" value="<?= $barang['keterangan'] ?>" name="keterangan1" id="keterangan1" class="form-control" placeholder="Masukan Keterangan">
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Qty</label>
                    <input onfocus="this.select()" type="Number" value="<?= $barang['qty'] ?>" id="qty1" name="qty1" class="form-control" placeholder="Masukan jumlah">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback qty1msg">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Harga Beli</label>
                    <input onfocus="this.select()" type="number" value="<?= $barang['harga_beli'] ?>" name="harga_beli1" id="harga_beli1" class="form-control harga_beli" placeholder="Masukan Harga Beli">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback harga_beli1msg">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Foto</label><br>
                    <button type="button" id="ambilgbr1" class="btn btn-primary" data-toggle="modal" data-target="#modal-foto1" onclick="cameranyala()">
                        <i class="fa fa-camera"></i>
                    </button>
                    <div id="validationServerUsernameFeedback" class="invalid-feedback ambilgbr1msg"></div>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($kel == 6) : ?>
    <input type="hidden" name="iddetail1" id="iddetail1" value="<?= $barang['id_detail_pembelian'] ?>">
    <input type="hidden" name="kel1" id="kel1" value="<?= $kel ?>">
    <input type="hidden" name="jenis_u" id="jenis_u" value="<?= $jenis_u ?>">
    <input type="hidden" name="nm_img" id="nm_img" value="<?= $barang['nama_img'] ?>">
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-2">
                <!-- text input -->
                <div class="form-group merek1">
                    <label>Merek</label>
                    <select name="merek1" class="form-control" id="merek1">
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
                    <select name="jenis1" class="form-control" id="jenis1">
                        <?php foreach ($jenis as $m) : ?>
                            <option value="<?= $m['nama'] ?>" <?= ($barang['jenis'] == $m['nama']) ? 'Selected' : '' ?>><?= $m['nama'] ?></option>
                        <?php endforeach; ?>
                        <option value="-">-</option>
                    </select>
                    <!-- <input onfocus="this.select()" type="text" name="jenis1" id="jenis1" class="form-control" placeholder="Masukan Jenis"> -->
                    <div id="validationServerUsernameFeedback" class="invalid-feedback jenismsg">
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label>Model</label>
                    <input onfocus="this.select()" type="text" value="<?= $barang['model'] ?>" name="model1" id="model1" class="form-control" placeholder="Masukan Model Barang">
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Keterangan</label>
                    <input onfocus="this.select()" type="text" value="<?= $barang['keterangan'] ?>" name="keterangan1" id="keterangan1" class="form-control" placeholder="Masukan Keterangan">
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Qty</label>
                    <input onfocus="this.select()" type="Number" value="<?= $barang['qty'] ?>" id="qty1" name="qty1" class="form-control" placeholder="Masukan jumlah">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback qty1msg">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Harga Beli</label>
                    <input onfocus="this.select()" type="number" value="<?= $barang['harga_beli'] ?>" name="harga_beli1" id="harga_beli1" class="form-control harga_beli" placeholder="Masukan Harga Beli">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback harga_beli1msg">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                    <label>Foto</label><br>
                    <button type="button" id="ambilgbr1" class="btn btn-primary" data-toggle="modal" data-target="#modal-foto1" onclick="cameranyala()">
                        <i class="fa fa-camera"></i>
                    </button>
                    <div id="validationServerUsernameFeedback" class="invalid-feedback ambilgbr1msg"></div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>