<div class="modal fade" id="modal-bayar">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pembayaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/pembayaranform" id="pembayaranform" class="pembayaranform" name="pembayaranform">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="kelompok" id="kelompok" value="<?= $datapembelian['kelompok'] ?>">
                    <div class="card-header mx-auto">
                        <h3 class="card-title" style=" padding-left: 500px; font-weight: bold;" id="totalbersih"></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Harga Saat ini</label><input type="number" onchange="UbahHargaMurni(this)" min="0" value="<?= $datapembelian['harga_murni'] ?>" id="harga_murni" name="harga_murni" onkeyup="Harganow()" class="form-control harga_murni" placeholder="Masukan harga">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback pembulatanmsg"></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Pembulatan</label><input type="number" onkeyup="byrtunai()" min="0" id="pembulatan" name="pembulatan" class="form-control" placeholder="Masukan pembulatan">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback pembulatanmsg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tunai</label><input type="number" onkeyup="byrtunai()" min="0" id="tunai" name="tunai" class="form-control" placeholder="Masukan tunai">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback tunaimsg"></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Transfer</label><input type="number" onkeyup="byrtransfer()" min="0" id="transfer" name="transfer" class="form-control" placeholder="Masukan transfer">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback transfermsg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Bank</label><input type="text" onkeyup="byrtransfer()" min="0" id="namabank" name="namabank" class="form-control" placeholder="Pilih Bank" readonly>
                            <div id="validationServerUsernameFeedback" class="invalid-feedback namabankmsg"></div>
                        </div>
                        <div class="row">
                            <?php foreach ($bank as $m) : ?>
                                <div class="col">
                                    <div class="form-group">
                                        <button type="button" style="width: 200px;" onclick="pilihbank('<?= $m['nama_bank'] ?>')" class="btn btn-block btn-outline-info btn-lg"><?= $m['nama_bank'] ?></button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="row">
                            <div class="col-9">
                                <div class="form-group">
                                    <label>Retur Sales</label><input type="text" onkeyup="byrtransfer()" min="0" id="namabank" name="namabank" class="form-control" placeholder="Pilih Bank" readonly>
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback namabankmsg"></div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Bank</label><input type="text" onkeyup="byrtransfer()" min="0" id="namabank" name="namabank" class="form-control" placeholder="Pilih Bank" readonly>
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback namabankmsg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-9">
                                <div class="form-group">
                                    <label>Bahan 24K</label><input type="text" onkeyup="byrtransfer()" min="0" id="namabank" name="namabank" class="form-control" placeholder="Pilih Bank" readonly>
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback namabankmsg"></div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Bank</label><input type="text" onkeyup="byrtransfer()" min="0" id="namabank" name="namabank" class="form-control" placeholder="Pilih Bank" readonly>
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback namabankmsg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-head-fixed text-nowrap">
                                            <tbody>
                                                <tr>
                                                    <td>Total Berat Kotor</td>
                                                    <td id="totalberatkotorhtml"></td>
                                                    <td>Total Berat Bersih</td>
                                                    <td id="totalberatbersihhtml"></td>
                                                </tr>
                                                <tr>
                                                    <td>Total Ongkos</td>
                                                    <td id="totalongkoshtml"></td>
                                                    <td>Pembulatan</td>
                                                    <td id="pembulatanhtml"></td>
                                                </tr>
                                                <tr>
                                                    <td>Total Bersih</td>
                                                    <td id="totalbersih"></td>
                                                    <td>Harus Bayar</td>
                                                    <td id="totalbersih1"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="SelesaiBayar()">Selesai</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function pilihbank(nmbank) {
        $('#namabank').val(nmbank)
    }
    $('.pembayaranform').submit(function(e) {
        e.preventDefault()
        let form = $('.pembayaranform')[0];
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            data: data,
            url: "<?php echo base_url('ajaxpembayaran') ?>",
            dataType: "json",
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function() {
                $('.btntambah').html('<i class="fa fa-spin fa-spinner">')
            },
            complete: function() {
                $('.btntambah').html('Bayar')
            },
            success: function(result) {
                if (result != 'error') {
                    if (result.error) {
                        if (result.error.namabank) {
                            $('#namabank').addClass('is-invalid')
                            $('.namabankmsg').html(result.error.namabank)
                        } else {
                            $('#namabank').removeClass('is-invalid')
                            $('.namabank').html('')
                        }
                        if (result.error.transfer) {
                            $('#transfer').addClass('is-invalid')
                            $('.transfermsg').html(result.error.transfer)
                        } else {
                            $('#transfer').removeClass('is-invalid')
                            $('.transfer').html('')
                        }
                        if (result.error.tunai) {
                            $('#tunai').addClass('is-invalid')
                            $('.tunaimsg').html(result.error.tunai)
                        } else {
                            $('#tunai').removeClass('is-invalid')
                            $('.tunai').html('')
                        }
                        if (result.error.harga_murni) {
                            $('#harga_murni').addClass('is-invalid')
                            $('.harga_murnimsg').html(result.error.harga_murni)
                        } else {
                            $('#harga_murni').removeClass('is-invalid')
                            $('.harga_murni').html('')
                        }
                        if (result.error.kode_bahan24k) {
                            $('#kode_bahan24k').addClass('is-invalid')
                            $('.kode_bahan24kmsg').html(result.error.kode_bahan24k)
                        } else {
                            $('#kode_bahan24k').removeClass('is-invalid')
                            $('.kode_bahan24k').html('')
                        }
                        if (result.error.beratbahan) {
                            $('#beratbahan').addClass('is-invalid')
                            $('.beratbahanmsg').html(result.error.beratbahan)
                        } else {
                            $('#beratbahan').removeClass('is-invalid')
                            $('.beratbahan').html('')
                        }
                        if (result.error.no_retur) {
                            $('#no_retur').addClass('is-invalid')
                            $('.no_returmsg').html(result.error.no_retur)
                        } else {
                            $('#no_retur').removeClass('is-invalid')
                            $('.no_retur').html('')
                        }
                    } else {
                        $('#namabank').removeClass('is-invalid')
                        $('.namabank').html('')
                        $('#transfer').removeClass('is-invalid')
                        $('.transfer').html('')
                        $('#tunai').removeClass('is-invalid')
                        $('.tunai').html('')
                        $('#harga_murni').removeClass('is-invalid')
                        $('.harga_murni').html('')
                        $('#kode_bahan24k').removeClass('is-invalid')
                        $('.kode_bahan24k').html('')
                        $('#beratbahan').removeClass('is-invalid')
                        $('.beratbahan').html('')
                        $('#no_retur').removeClass('is-invalid')
                        $('.no_retur').html('')

                        // $("#refresbayartbl").load("/detailpembelian/" + document.getElementById('dateid').value + " #refresbayartbl");
                        myDataBayar()
                        if (result.pesan_lebih) {
                            if (result.pesan_lebih.pesan) {
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Lebih Bayar',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK',
                                })
                            }
                        }
                    }
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tidak ada Data',
                    })
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    })
</script>