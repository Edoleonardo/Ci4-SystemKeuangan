<?= csrf_field(); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <!-- ./card-header -->
            <div class="card-body p-0">
                <table class="table table-hover">
                    <tbody>
                        <tr data-widget="expandable-table" aria-expanded="true">
                            <td>
                                Input Data (Kelompok <?= $datapembelian['kelompok'] ?>)
                            </td>
                        </tr>
                        <tr class="expandable-body">
                            <td>
                                <div class="p-0" style="margin: 10px;">
                                    <!-- <input type="hidden" name="kelompok" id="kelompok" > -->
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Tanggal Input Barang</label>
                                                <input type="date" id="tanggal_input" name="tanggal_input" class="form-control" value="<?php echo date('Y-m-d') ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Tanggal Nota Supplier</label>
                                                <input type="date" name="tanggal_nota_sup" id="tanggal_nota_sup" class="form-control" value="<?= (isset($datapembelian['tgl_faktur'])) ? date_format(date_create(substr($datapembelian['tgl_faktur'], 0, 10)), "Y-m-d") : date('Y-m-d'); ?>">
                                                <input type="hidden" name="dateid" id="dateid" value="<?= $datapembelian['id_date_pembelian'] ?>">
                                                <div id="validationServerUsernameFeedback" class="invalid-feedback tanggal_nota_supmsg">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Tanggal Jatuh Tempo </label>
                                                <input type="date" id="tanggal_tempo" name="tanggal_tempo" class="form-control" value="<?= (isset($datapembelian['tgl_jatuh_tempo'])) ? date_format(date_create(substr($datapembelian['tgl_jatuh_tempo'], 0, 10)), "Y-m-d") : date('Y-m-d'); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>No Nota Supplier</label>
                                                <input type="text" onfocus="this.select()" id="no_nota_supp" name="no_nota_supp" value="<?= (isset($datapembelian['no_faktur_supp'])) ? $datapembelian['no_faktur_supp'] : ''; ?>" class="form-control" placeholder="Masukan Nomor Nota Supplier">
                                                <div id="validationServerUsernameFeedback" class="invalid-feedback no_nota_suppmsg"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Nama Supplier</label>
                                                <select name="supplier" class="form-control" id="supplier" name="supplier">
                                                    <?php foreach ($supplier as $m) : ?>
                                                        <option value="<?= $m['id_supplier'] ?>" <?= (isset($datapembelian['id_supplier']) == $m['nama_supp']) ? ($datapembelian['id_supplier'] == $m['nama_supp']) ? 'selected' : '' : ''; ?>><?= $m['nama_supp'] ?> </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php if ($datapembelian['kelompok'] == 1) : ?>
                                            <div class="col-sm-2">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Total Berat Murni</label>
                                                    <input type="number" onfocus="this.select()" step="0.01" min="0" id="total_berat_m" name="total_berat_m" class="form-control" placeholder="Masukan Total Berat Murni" value="<?= (isset($datapembelian['total_berat_murni'])) ? $datapembelian['total_berat_murni'] : ''; ?>">
                                                    <div id="validationServerUsernameFeedback" class="invalid-feedback total_berat_mmsg">
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($datapembelian['kelompok'] == 2) : ?>
                                            <input type="hidden" onfocus="this.select()" step="0.01" id="total_berat_m" name="total_berat_m" value="0">
                                        <?php endif; ?>
                                        <?php if ($datapembelian['kelompok'] == 3 || $datapembelian['kelompok'] == 4) : ?>
                                            <div class="col-sm-2">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Total Berat</label>
                                                    <input type="number" onfocus="this.select()" step="0.01" min="0" id="total_berat_m" name="total_berat_m" class="form-control" placeholder="Masukan Total Berat" value="<?= (isset($datapembelian['total_berat_murni'])) ? $datapembelian['total_berat_murni'] : ''; ?>">
                                                    <div id="validationServerUsernameFeedback" class="invalid-feedback total_berat_mmsg">
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr data-widget="expandable-table" aria-expanded="true">
                            <td>
                                Input Data Berulang (Kelompok <?= $datapembelian['kelompok'] ?>)
                            </td>
                        </tr>
                        <tr class="expandable-body">
                            <td>
                                <div class="p-0" style="margin: 10px;">
                                    <div class="row">
                                        <?php if ($datapembelian['kelompok'] != 1 && $datapembelian['kelompok'] != 2) : ?>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <a href="#" onclick="ModalBarcode(<?= $datapembelian['kelompok'] ?>)"><label>Barcode</label></a>
                                                    <input type="text" autocomplete="off" onfocus="this.select()" oninput="PilihBarcode(this.value)" id="barcode" name="barcode" class="form-control" placeholder="Masukan barcode">
                                                </div>
                                            </div>
                                        <?php endif; ?>
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
                                                <!-- <input type="text" onfocus="this.select()" name="jenis" id="jenis" class="form-control" placeholder="Masukan Jenis"> -->
                                                <div id="validationServerUsernameFeedback" class="invalid-feedback jenismsg">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Model</label>
                                                <input type="text" onfocus="this.select()" name="model" id="model" class="form-control" placeholder="Masukan Model Barang">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <input type="text" onfocus="this.select()" name="keterangan" id="keterangan" class="form-control" placeholder="Masukan Keterangan">
                                            </div>
                                        </div>
                                        <input type="hidden" name="carat" value="0">
                                        <?php if ($datapembelian['kelompok'] != 4) : ?>
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
                                                    <div id="validationServerUsernameFeedback" class="invalid-feedback merekmsg">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Qty</label>
                                                    <input type="Number" onfocus="this.select()" id="qty" name="qty" min="1" class="form-control" placeholder="Masukan jumlah">
                                                    <div id="validationServerUsernameFeedback" class="invalid-feedback qtymsg">
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else : ?>
                                            <input type="hidden" name="merek" value="-">
                                            <input type="hidden" name="qty" value="1">
                                        <?php endif; ?>
                                        <?php if ($datapembelian['kelompok'] == 1 || $datapembelian['kelompok'] == 2) : ?>
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
                                            <?php if ($datapembelian['kelompok'] == 1) : ?>
                                                <div class="col-sm-2">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Nilai Tukar</label>
                                                        <input type="number" onfocus="this.select()" id="nilai_tukar" name="nilai_tukar" class="form-control" placeholder="Masukan Nilai Tukar">
                                                        <div id="validationServerUsernameFeedback" class="invalid-feedback nilai_tukarmsg">
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php else : ?>
                                                <input type="hidden" id="nilai_tukar" name="nilai_tukar" value="0">
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <input type="hidden" name="kadar" value="24K">
                                            <input type="hidden" name="nilai_tukar" value="0">
                                        <?php endif; ?>
                                        <div class="col-sm-2">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Berat</label>
                                                <input type="number" onfocus="this.select()" step="0.01" id="berat" name="berat" class="form-control" placeholder="Masukan Berat">
                                                <div id="validationServerUsernameFeedback" class="invalid-feedback beratmsg">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Harga Beli</label>
                                                <input type="number" onfocus="this.select()" name="harga_beli" id="harga_beli" class="form-control harga_beli" placeholder="Masukan Harga Beli">
                                                <div id="validationServerUsernameFeedback" class="invalid-feedback harga_belimsg">
                                                </div>
                                            </div>
                                        </div>
                                        <?php if ($datapembelian['kelompok'] == 1) : ?>
                                            <div class="col-sm-2">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Ongkos</label>
                                                    <input type="number" onfocus="this.select()" value="0" name="ongkos" id="ongkos" class="form-control ongkos" placeholder="Masukan Ongkos">
                                                    <div id="validationServerUsernameFeedback" class="invalid-feedback ongkosmsg">
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else : ?>
                                            <input type="hidden" name="ongkos" value="0">
                                        <?php endif; ?>
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
                                </div>
                                <div>
                                    <button type="button" class="btn btn-danger" onclick="hapussemua()">Hapus Semua</button>
                                    <button type="submit" id="send_form" class="btn btn-info btntambah">Tambah</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>