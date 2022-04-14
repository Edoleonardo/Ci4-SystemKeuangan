<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Edit Opname</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/formeditopname" name="formeditopname" id="formeditopname" class="formeditopname" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="iddetail" value="<?= $barang['id_stock'] ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-2">
                            <!-- text input -->
                            <div class="form-group merek">
                                <label>Merek</label>
                                <select name="merek" class="form-control" id="merek">
                                    <?php foreach ($merek as $m) : ?>
                                        <option value="<?= $m['nama_merek'] ?>" <?= ($m['nama_merek'] == $barang['merek']) ? 'selected' : '' ?>><?= $m['nama_merek'] ?> </option>
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
                                        <option value="<?= $m['nama_kadar'] ?>" <?= ($m['nama_kadar'] == $barang['kadar']) ? 'selected' : '' ?>><?= $m['nama_kadar'] ?> </option>
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
                                        <option value="<?= $m['nama'] ?>" <?= ($m['nama'] == $barang['jenis']) ? 'selected' : '' ?>><?= $m['nama'] ?> </option>
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
                                <input type="Number" id="qty" name="qty" value="<?= $barang['qty'] ?>" class="form-control" placeholder="Masukan jumlah">
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
                        <div class="col-sm-2">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Ongkos</label>
                                <input type="number" value="0" name="ongkos" id="ongkos" class="form-control ongkos" value="<?= $barang['ongkos'] ?>" placeholder="Masukan Ongkos">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback ongkosmsg">
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
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btntambah">Selesai Edit</button>
            </form>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="modal-foto">
    <div class="modal-dialog modal-default">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ambil Foto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="form-group"><label>Gambar</label>
                                <div class="custom-file">
                                    <input type="file" name="gambar" class="custom-file-input" id="gambar" accept="image/*">
                                    <label style="text-align: left" class="custom-file-label" for="gambar">Pilih Gambar</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div id='my_camera'>
                            </div>
                            <button style="text-align: center;" type='button' id='ambilfoto' class='btn btn-info ambilfoto' onclick='Foto_ulang()'>
                                <i class='fa fa-trash'></i></button>
                            <button type='button' id='ambilfoto' class='btn btn-info ambilfoto' onclick='Ambil_foto()'>Foto <i class='fa fa-camera'></i>
                            </button>
                            <input type='hidden' name='gambar' id='gambar' class='image-tag'>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="Webcam.reset()" data-dismiss="modal">Done</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal-content -->


<script>
    $('.formeditopname').submit(function(e) {
        console.log('masuksubmit')
        e.preventDefault()
        let form = $('.formeditopname')[0];
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            data: data,
            url: $(this).attr('action'),
            dataType: "json",
            enctype: 'multipart/form-data',
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function() {
                $('.btntambah').html('<i class="fa fa-spin fa-spinner">')
            },
            complete: function() {
                $('.btntambah').html('Tambah')
            },
            success: function(result) {
                console.log(result)
                if (result.error) {
                    if (result.error.qty) {
                        $('#qty').addClass('is-invalid')
                        $('.qtymsg').html(result.error.qty)
                    } else {
                        $('#qty').removeClass('is-invalid')
                        $('.qtymsg').html('')
                    }
                    if (result.error.nilai_tukar) {
                        $('#nilai_tukar').addClass('is-invalid')
                        $('.nilai_tukarmsg').html(result.error.nilai_tukar)
                    } else {
                        $('#nilai_tukar').removeClass('is-invalid')
                        $('.nilai_tukarmsg').html('')
                    }
                    if (result.error.jenis) {
                        $('#jenis').addClass('is-invalid')
                        $('.jenismsg').html(result.error.jenis)
                    } else {
                        $('#jenis').removeClass('is-invalid')
                        $('.jenismsg').html('')
                    }
                    if (result.error.berat) {
                        $('#berat').addClass('is-invalid')
                        $('.beratmsg').html(result.error.berat)
                    } else {
                        $('#berat').removeClass('is-invalid')
                        $('.beratmsg').html('')
                    }
                    if (result.error.harga_beli) {
                        $('#harga_beli').addClass('is-invalid')
                        $('.harga_belimsg').html(result.error.harga_beli)
                    } else {
                        $('#harga_beli').removeClass('is-invalid')
                        $('.harga_belimsg').html('')
                    }
                    if (result.error.error) {
                        Swal.fire({
                            icon: 'warning',
                            title: result.error.error,
                        })
                    }
                } else {
                    $('#qty').removeClass('is-invalid')
                    $('.qtymsg').html('')
                    $('#nilai_tukar').removeClass('is-invalid')
                    $('.nilai_tukarmsg').html('')
                    $('#jenis').removeClass('is-invalid')
                    $('.jenismsg').html('')
                    $('#berat').removeClass('is-invalid')
                    $('.beratmsg').html('')
                    $('#harga_beli').removeClass('is-invalid')
                    $('.harga_belimsg').html('')
                    $('#modal-edit').modal('toggle')
                    $('#modal-modal').modal('toggle')
                    tampildata()
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                    })

                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    })
    $("#modal-foto").on("hidden.bs.modal", function() {
        Webcam.reset('#my_camera')
    });
</script>