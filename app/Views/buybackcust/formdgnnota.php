<?php if ($kel == 1) : ?>
    <div class="row">
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Jenis</label>
                <select name="jenis1" class="form-control" id="jenis1">
                    <?php foreach ($jenis as $m) : ?>
                        <option value="<?= $m['nama'] ?>" <?= ($dataval['jenis'] == $m['nama']) ? 'selected' : '' ?>><?= $m['nama'] ?> </option>
                    <?php endforeach; ?>
                    <option value="-">-</option>
                </select>
                <!-- <input onfocus="this.select()" type="text" name="jenis" id="jenis" class="form-control" placeholder="Masukan Jenis"> -->
                <div id="validationServerUsernameFeedback" class="invalid-feedback jenis1msg">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Model</label>
                <input onfocus="this.select()" type="text" name="model1" id="model1" value="<?= $dataval['model'] ?>" class="form-control" placeholder="Masukan Model Barang">
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
                <label>Merek</label>
                <select name="merek1" class="form-control" id="merek1">
                    <?php foreach ($merek as $m) : ?>
                        <option value="<?= $m['nama_merek'] ?>" <?= ($dataval['merek'] == $m['nama_merek']) ? 'selected' : '' ?>><?= $m['nama_merek'] ?> </option>
                    <?php endforeach; ?>
                    <option value="-">-</option>
                </select>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Kadar</label>
                <select name="kadar1" class="form-control" id="kadar1">
                    <?php foreach ($kadar as $m) : ?>
                        <option value="<?= $m['nama_kadar'] ?>" <?= ($dataval['kadar'] == $m['nama_kadar']) ? 'selected' : '' ?>><?= $m['nama_kadar'] ?> </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
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
                <label>Status Barang</label>
                <select name="status_proses" class="form-control" id="status" name="status">
                    <option value="Cuci">Cuci</option>
                    <option value="Retur">Retur Sales</option>
                    <option value="Lebur">Lebur</option>
                    <option value="CancelBeli">CancelBeli</option>
                </select>
            </div>
        </div>
        <div class="col-sm-1">
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
<?php elseif ($kel == 2) : ?>
    <div class="row">
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Jenis</label>
                <select name="jenis1" class="form-control" id="jenis1">
                    <?php foreach ($jenis as $m) : ?>
                        <option value="<?= $m['nama'] ?>" <?= ($dataval['jenis'] == $m['nama']) ? 'selected' : '' ?>><?= $m['nama'] ?> </option>
                    <?php endforeach; ?>
                    <option value="-">-</option>
                </select>
                <!-- <input onfocus="this.select()" type="text" name="jenis" id="jenis" class="form-control" placeholder="Masukan Jenis"> -->
                <div id="validationServerUsernameFeedback" class="invalid-feedback jenis1msg">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Model</label>
                <input onfocus="this.select()" type="text" name="model1" id="model1" value="<?= $dataval['model'] ?>" class="form-control" placeholder="Masukan Model Barang">
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
                <label>Merek</label>
                <select name="merek1" class="form-control" id="merek1">
                    <?php foreach ($merek as $m) : ?>
                        <option value="<?= $m['nama_merek'] ?>" <?= ($dataval['merek'] == $m['nama_merek']) ? 'selected' : '' ?>><?= $m['nama_merek'] ?> </option>
                    <?php endforeach; ?>
                    <option value="-">-</option>
                </select>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Kadar</label>
                <select name="kadar1" class="form-control" id="kadar1">
                    <?php foreach ($kadar as $m) : ?>
                        <option value="<?= $m['nama_kadar'] ?>" <?= ($dataval['kadar'] == $m['nama_kadar']) ? 'selected' : '' ?>><?= $m['nama_kadar'] ?> </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
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
                <label>Status Barang</label>
                <select name="status_proses" class="form-control" id="status" name="status">
                    <option value="Cuci">Cuci</option>
                    <option value="Retur">Retur Sales</option>
                    <option value="Lebur">Lebur</option>
                    <option value="CancelBeli">CancelBeli</option>
                </select>
            </div>
        </div>
        <div class="col-sm-1">
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
<?php elseif ($kel == 3) : ?>
    <div class="row">
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Jenis</label>
                <select name="jenis1" class="form-control" id="jenis1">
                    <?php foreach ($jenis as $m) : ?>
                        <option value="<?= $m['nama'] ?>" <?= ($dataval['jenis'] == $m['nama']) ? 'selected' : '' ?>><?= $m['nama'] ?> </option>
                    <?php endforeach; ?>
                    <option value="-">-</option>
                </select>
                <!-- <input onfocus="this.select()" type="text" name="jenis" id="jenis" class="form-control" placeholder="Masukan Jenis"> -->
                <div id="validationServerUsernameFeedback" class="invalid-feedback jenis1msg">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Model</label>
                <input onfocus="this.select()" type="text" name="model1" id="model1" value="<?= $dataval['model'] ?>" class="form-control" placeholder="Masukan Model Barang">
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
                <label>Merek</label>
                <select name="merek1" class="form-control" id="merek1">
                    <?php foreach ($merek as $m) : ?>
                        <option value="<?= $m['nama_merek'] ?>" <?= ($dataval['merek'] == $m['nama_merek']) ? 'selected' : '' ?>><?= $m['nama_merek'] ?> </option>
                    <?php endforeach; ?>
                    <option value="-">-</option>
                </select>
            </div>
        </div>
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
        <div class="col-sm-1">
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
<?php elseif ($kel == 4) : ?>
    <div class="row">
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Jenis</label>
                <select name="jenis1" class="form-control" id="jenis1">
                    <?php foreach ($jenis as $m) : ?>
                        <option value="<?= $m['nama'] ?>" <?= ($dataval['jenis'] == $m['nama']) ? 'selected' : '' ?>><?= $m['nama'] ?> </option>
                    <?php endforeach; ?>
                    <option value="-">-</option>
                </select>
                <!-- <input onfocus="this.select()" type="text" name="jenis" id="jenis" class="form-control" placeholder="Masukan Jenis"> -->
                <div id="validationServerUsernameFeedback" class="invalid-feedback jenis1msg">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Model</label>
                <input onfocus="this.select()" type="text" name="model1" id="model1" value="<?= $dataval['model'] ?>" class="form-control" placeholder="Masukan Model Barang">
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
        <div class="col-sm-1">
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

<?php elseif ($kel == 5) : ?>
    <div class="row">
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Jenis</label>
                <select name="jenis1" class="form-control" id="jenis1">
                    <?php foreach ($jenis as $m) : ?>
                        <option value="<?= $m['nama'] ?>" <?= ($dataval['jenis'] == $m['nama']) ? 'selected' : '' ?>><?= $m['nama'] ?> </option>
                    <?php endforeach; ?>
                    <option value="-">-</option>
                </select>
                <!-- <input onfocus="this.select()" type="text" name="jenis" id="jenis" class="form-control" placeholder="Masukan Jenis"> -->
                <div id="validationServerUsernameFeedback" class="invalid-feedback jenis1msg">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Model</label>
                <input onfocus="this.select()" type="text" name="model1" id="model1" value="<?= $dataval['model'] ?>" class="form-control" placeholder="Masukan Model Barang">
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
        <div class="col-sm-1">
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

<?php elseif ($kel == 6) : ?>
    <div class="row">
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Jenis</label>
                <select name="jenis1" class="form-control" id="jenis1">
                    <?php foreach ($jenis as $m) : ?>
                        <option value="<?= $m['nama'] ?>" <?= ($dataval['jenis'] == $m['nama']) ? 'selected' : '' ?>><?= $m['nama'] ?> </option>
                    <?php endforeach; ?>
                    <option value="-">-</option>
                </select>
                <!-- <input onfocus="this.select()" type="text" name="jenis" id="jenis" class="form-control" placeholder="Masukan Jenis"> -->
                <div id="validationServerUsernameFeedback" class="invalid-feedback jenis1msg">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <!-- text input -->
            <div class="form-group">
                <label>Model</label>
                <input onfocus="this.select()" type="text" name="model1" id="model1" value="<?= $dataval['model'] ?>" class="form-control" placeholder="Masukan Model Barang">
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
                <label>Merek</label>
                <select name="merek1" class="form-control" id="merek1">
                    <?php foreach ($merek as $m) : ?>
                        <option value="<?= $m['nama_merek'] ?>" <?= ($dataval['merek'] == $m['nama_merek']) ? 'selected' : '' ?>><?= $m['nama_merek'] ?> </option>
                    <?php endforeach; ?>
                    <option value="-">-</option>
                </select>
            </div>
        </div>
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
        <div class="col-sm-1">
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
<?php endif; ?>
<script>
    // $(document).ready(function() {
    //     $('#btntambah').click(function() {
    //         $('#tambahbuyback').submit();
    //     });
    //     HarusBayar()
    // })
</script>