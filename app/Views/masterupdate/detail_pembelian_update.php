<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .table>* {
        vertical-align: middle;
        text-align: center;
    }

    .table>tbody>tr>* {
        vertical-align: middle;
        text-align: center;
    }

    /* th {
        vertical-align: middle;
        text-align: center;
    } */
    .modal {
        overflow: auto !important;
    }

    .imgg {
        width: 100px;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Update Detail Barang Masuk</h1>
                </div><!-- /.col -->
                <!-- /.content-header -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/barangmasuk">Home</a></li>
                        <li class="breadcrumb-item"><a href="/barangmasuk">Pembelian Supplier</a></li>
                        <li class="breadcrumb-item active">Detail Barang Masuk Supplier</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped">
                            <input type="hidden" name="dateid" id="dateid" value="<?= $datapembelian['id_date_pembelian'] ?>">
                            <tbody>
                                <tr>
                                <tr>
                                    <td>No Pembayaran</td>
                                    <td><?= $datapembelian['no_transaksi'] ?></td>
                                </tr>
                                <td>Supplier</td>
                                <td>
                                    <select name="supplier" class="form-control" id="supplier" name="supplier" onchange="UpdateData(this.value,'supplier')">
                                        <?php foreach ($supplier as $m) : ?>
                                            <option value="<?= $m['id_supplier'] ?>" <?= ($datapembelian['id_supplier'] == $m['id_supplier']) ? 'selected' : ''; ?>><?= $m['nama_supp'] ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Input</td>
                                    <td>
                                        <input type="date" id="tanggal_input" onchange="UpdateData(this.value,'tgl_input')" name="tanggal_input" class="form-control" value="<?php echo date('Y-m-d') ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Nota Supplier</td>
                                    <td>
                                        <input type="date" name="tanggal_nota_sup" onchange="UpdateData(this.value,'tgl_nota')" id="tanggal_nota_sup" class="form-control" value="<?= (isset($datapembelian['tgl_faktur'])) ? date_format(date_create(substr($datapembelian['tgl_faktur'], 0, 10)), "Y-m-d") : date('Y-m-d'); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Jatuh Tempo</td>
                                    <td>
                                        <input type="date" id="tanggal_tempo" onchange="UpdateData(this.value,'tgl_tempo')" name="tanggal_tempo" class="form-control" value="<?= (isset($datapembelian['tgl_jatuh_tempo'])) ? date_format(date_create(substr($datapembelian['tgl_jatuh_tempo'], 0, 10)), "Y-m-d") : date('Y-m-d'); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nomor Nota Supplier</td>
                                    <td>
                                        <input type="text" onfocus="this.select()" id="no_nota_supp" onchange="UpdateData(this.value,'no_nota')" name="no_nota_supp" value="<?= (isset($datapembelian['no_faktur_supp'])) ? $datapembelian['no_faktur_supp'] : ''; ?>" class="form-control" placeholder="Masukan Nomor Nota Supplier">
                                    </td>
                                </tr>
                                <?php if ($datapembelian['kelompok'] == 1) : ?>
                                    <tr>
                                        <td>Total Berat Murni</td>
                                        <td>
                                            <input type="number" onfocus="this.select()" onchange="UpdateData(this.value,'total_murni')" step="0.01" min="0" id="total_berat_m" name="total_berat_m" class="form-control" placeholder="Masukan Total Berat" value="<?= (isset($datapembelian['total_berat_murni'])) ? $datapembelian['total_berat_murni'] : ''; ?>">
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-sm-6">
                <!-- Application buttons -->
                <div id="cardbayar">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-app" href="/printbarcode/<?= $datapembelian['id_date_pembelian'] ?>" target="_blank">
                                <i class="fas fa-barcode"></i> Print Barcode
                            </a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        <div class="card ">
            <!-- /.card-header -->
            <div class="card-body">
                <br>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <?php if ($datapembelian['kelompok'] == 1) : ?>
                                <div class="card-body table-responsive p-0" id="datatable">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th style="text-align: center;"><?= $datapembelian['total_qty'] ?></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th style="text-align: center;"><?= $datapembelian['total_berat_rill'] ?></th>
                                                <th style="text-align: center;"><?= $datapembelian['berat_murni_rill'] ?></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th style="text-align: center;"><?= number_format($datapembelian['total_bayar'], 0, '.', ',') ?></th>
                                            </tr>
                                        </thead>
                                        <thead>
                                            <tr>
                                                <th>Gambar</th>
                                                <th>Kode</th>
                                                <th style="min-width: 30%;">Qty</th>
                                                <th>Jenis</th>
                                                <th>Model</th>
                                                <th>Keterangan</th>
                                                <th>Berat</th>
                                                <th>Berat Murni</th>
                                                <th>Harga Beli</th>
                                                <th>Ongkos</th>
                                                <th>Kadar</th>
                                                <th>Nilai Tukar</th>
                                                <th>Merek</th>
                                                <th>Total Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($tampildata as $row) : ?>
                                                <tr>
                                                    <td><img src='/img/<?= $row['nama_img'] ?>' class='imgg'></td>
                                                    <td><?= $row['kode'] ?></td>
                                                    <td><?= $row['qty'] ?></td>
                                                    <td><?= $row['jenis'] ?></td>
                                                    <td><?= $row['model'] ?></td>
                                                    <td><?= $row['keterangan'] ?></td>
                                                    <td><?= $row['berat'] ?></td>
                                                    <td><?= $row['berat_murni'] ?></td>
                                                    <td><?= number_format($row['harga_beli'], 2, ",", ".") ?>
                                                    <td><?= number_format($row['ongkos'], 2, ",", ".") ?></td>
                                                    <td><?= $row['kadar'] ?></td>
                                                    <td><?= $row['nilai_tukar'] ?></td>
                                                    <td><?= $row['merek'] ?>
                                                    <td><?= number_format($row['total_harga'], 2, ",", ".") ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                            <?php if ($datapembelian['kelompok'] == 2 || $datapembelian['kelompok'] == 3 || $datapembelian['kelompok'] == 4) : ?>
                                <div class="card-body table-responsive p-0" id="datatable">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th style="text-align: center;"><?= $datapembelian['total_qty'] ?></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th style="text-align: center;"><?= $datapembelian['total_berat_rill'] ?></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th style="text-align: center;"><?= number_format($datapembelian['total_bayar'], 0, '.', ',') ?></th>
                                            </tr>
                                        </thead>
                                        <thead>
                                            <tr>
                                                <th>Gambar</th>
                                                <th>Kode</th>
                                                <th>Qty</th>
                                                <th>Jenis</th>
                                                <th>Model</th>
                                                <th>Keterangan</th>
                                                <th>Berat</th>
                                                <th>Harga Beli</th>
                                                <th>Kadar</th>
                                                <th>Merek</th>
                                                <th>Total Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($tampildata as $row) : ?>
                                                <tr>
                                                    <td><img src='/img/<?= $row['nama_img'] ?>' class='imgg'></td>
                                                    <td><?= $row['kode'] ?></td>
                                                    <td><?= $row['qty'] ?></td>
                                                    <td><?= $row['jenis'] ?></td>
                                                    <td><?= $row['model'] ?></td>
                                                    <td><?= $row['keterangan'] ?></td>
                                                    <td><?= $row['berat'] ?></td>
                                                    <td><?= number_format($row['harga_beli'], 2, ",", ".") ?></td>
                                                    <td><?= $row['kadar'] ?></td>
                                                    <td><?= $row['merek'] ?></td>
                                                    <td><?= number_format($row['total_harga'], 2, ",", ".") ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                            <?php if ($datapembelian['kelompok'] == 5) : ?>
                                <div class="card-body table-responsive p-0" id="datatable">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th style="text-align: center;"><?= $datapembelian['total_qty'] ?></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th style="text-align: center;"><?= $datapembelian['total_carat_rill'] ?></th>
                                                <th></th>
                                                <th style="text-align: center;"><?= number_format($datapembelian['total_bayar'], 0, '.', ',') ?></th>
                                            </tr>
                                        </thead>
                                        <thead>
                                            <tr>
                                                <th>Gambar</th>
                                                <th>Kode</th>
                                                <th>Qty</th>
                                                <th>Jenis</th>
                                                <th>Model</th>
                                                <th>Keterangan</th>
                                                <th>Carat</th>
                                                <th>Harga Beli</th>
                                                <th>Total Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($tampildata as $row) : ?>
                                                <tr>
                                                    <td><img src='/img/<?= $row['nama_img'] ?>' class='imgg'></td>
                                                    <td><?= $row['kode'] ?></td>
                                                    <td><?= $row['qty'] ?></td>
                                                    <td><?= $row['jenis'] ?></td>
                                                    <td><?= $row['model'] ?></td>
                                                    <td><?= $row['keterangan'] ?></td>
                                                    <td><?= $row['carat'] ?></td>
                                                    <td><?= number_format($row['harga_beli'], 2, ",", ".") ?></td>
                                                    <td><?= number_format($row['total_harga'], 2, ",", ".") ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                            <?php if ($datapembelian['kelompok'] == 6) : ?>
                                <div class="card-body table-responsive p-0" id="datatable">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th style="text-align: center;"><?= $datapembelian['total_qty'] ?></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th style="text-align: center;"><?= number_format($datapembelian['total_bayar'], 0, '.', ',') ?></th>
                                            </tr>
                                        </thead>
                                        <thead>
                                            <tr>
                                                <th>Gambar</th>
                                                <th>Kode</th>
                                                <th>Qty</th>
                                                <th>Jenis</th>
                                                <th>Model</th>
                                                <th>Keterangan</th>
                                                <th>Harga Beli</th>
                                                <th>Total Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($tampildata as $row) : ?>
                                                <tr>
                                                    <td><img src='/img/<?= $row['nama_img'] ?>' class='imgg'></td>
                                                    <td><?= $row['kode'] ?></td>
                                                    <td><?= $row['qty'] ?></td>
                                                    <td><?= $row['jenis'] ?></td>
                                                    <td><?= $row['model'] ?></td>
                                                    <td><?= $row['keterangan'] ?></td>
                                                    <td><?= number_format($row['harga_beli'], 2, ",", ".") ?></td>
                                                    <td><?= number_format($row['total_harga'], 2, ",", ".") ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div id="refresharga">
                    <div class="row" id="refreshargaisi">
                        <div class="col-sm-6">
                            <div class="card">
                                <?php if ($databayar) : ?>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0" id="byr11">
                                        <table class="table table-striped" id="byr22">
                                            <thead>
                                                <tr>
                                                    <th>Cara Pembayaran</th>
                                                    <th style="text-align: center;">Kode</th>
                                                    <th>Jumlah Bayar</th>
                                                    <?php if ($datapembelian['kelompok'] == 5) : ?>
                                                        <th>Carat</th>
                                                    <?php endif; ?>
                                                    <?php if ($datapembelian['kelompok'] != 5 && $datapembelian['kelompok'] != 6) : ?>
                                                        <th>Berat</th>
                                                    <?php endif; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($databayar as $byr) : ?>
                                                    <tr>
                                                        <td> <?= $byr['cara_pembayaran'] ?> </td>
                                                        <td><?= ($byr['no_retur']) ? $byr['no_retur'] : $byr['kode_24k'] ?></td>
                                                        <td><?= number_format($byr['jumlah_pembayaran'], 2, ',', '.') ?></td>
                                                        <?php if ($datapembelian['kelompok'] != 6) : ?>
                                                            <td style="text-align: center;"><?= number_format($byr['berat_murni'], 2, '.', ',') ?></td>
                                                        <?php endif; ?>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                        <!-- /.card-body -->
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.container-fluid -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<!-- Main Footer -->
<footer class="main-footer">

</footer>
<script type="text/javascript">
    function UpdateData(val, jenis) {
        console.log(val + ' ' + jenis)
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('updatedata'); ?>",
            data: {
                value: val,
                jenis: jenis,
                iddate: $('#dateid').val()
            },
            success: function(result) {
                if (result.errors) {
                    Swal.fire({
                        icon: 'warning',
                        title: result.errors,
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil Update',
                    })
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    //--------------------------
    function InputRetur() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('inputretursales'); ?>",
            data: {
                no_retur: $('#no_retur').val(),
                dateid: document.getElementById('dateid').value,
                harga_murni: document.getElementById('harga_murni').value
            },
            success: function(result) {
                console.log(result)
                if (result.error) {
                    if (result.error.harga_murni) {
                        $('#harga_murni').addClass('is-invalid')
                        $('.harga_murnimsg').html(result.error.harga_murni)
                    } else {
                        $('#harga_murni').removeClass('is-invalid')
                        $('.harga_murni').html('')
                    }
                    if (result.error.no_retur) {
                        $('#no_retur').addClass('is-invalid')
                        $('.no_returmsg').html(result.error.no_retur)
                    } else {
                        $('#no_retur').removeClass('is-invalid')
                        $('.no_retur').html('')
                    }
                } else {
                    $('#harga_murni').removeClass('is-invalid')
                    $('.harga_murni').html('')
                    $('#no_retur').removeClass('is-invalid')
                    $('.no_retur').html('')
                    $("#refresbayartbl").load("/detailpembelian/" + document.getElementById('dateid').value + " #refresbayartbl");
                    refreshdata()
                    myDataBayar()
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function InputBahan() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('inputbahan24k'); ?>",
            data: {
                kode_bahan24k: $('#kode_bahan24k').val(),
                dateid: $('#dateid').val(),
                beratbahan: $('#beratbahan').val()
            },
            success: function(result) {
                if (result.error) {
                    if (result.error.beratbahan) {
                        $('#beratbahan').addClass('is-invalid')
                        $('.beratbahanmsg').html(result.error.beratbahan)
                    } else {
                        $('#beratbahan').removeClass('is-invalid')
                        $('.beratbahan').html('')
                    }
                    if (result.error.kode_bahan24k) {
                        $('#kode_bahan24k').addClass('is-invalid')
                        $('.kode_bahan24kmsg').html(result.error.kode_bahan24k)
                    } else {
                        $('#kode_bahan24k').removeClass('is-invalid')
                        $('.kode_bahan24k').html('')
                    }
                } else {
                    $('#beratbahan').removeClass('is-invalid')
                    $('.beratbahan').html('')
                    $('#kode_bahan24k').removeClass('is-invalid')
                    $('.kode_bahan24k').html('')
                    $("#refresbayartbl").load("/detailpembelian/" + document.getElementById('dateid').value + " #refresbayartbl");
                    $("#bahan24k1").load("/detailpembelian/" + document.getElementById('dateid').value + " #bahan24k2");
                    refreshdata()
                    myDataBayar()
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function pilihbank(nmbank) {
        $('#namabank').val(nmbank)
    }

    function UbahHargaMurni() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('ubahhargamurni'); ?>",
            data: {
                val: $('#harga_murni').val(),
                dateid: document.getElementById('dateid').value
            },
            success: function(result) {
                if (result.error) {
                    if (result.error) {
                        $('#harga_murni').addClass('is-invalid')
                        $('.harga_murnimsg').html(result.error)
                    } else {
                        $('#harga_murni').removeClass('is-invalid')
                        $('.harga_murni').html('')
                    }
                } else {
                    $('#harga_murni').removeClass('is-invalid')
                    $('.harga_murni').html('')
                    $("#refresbayartbl").load("/detailpembelian/" + document.getElementById('dateid').value + " #refresbayartbl");
                    myDataBayar()
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function hapus(id) {
        Swal.fire({
            title: 'Hapus',
            text: "Yakin ingin Hapus Pembayaran ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "<?php echo base_url('deletepembayaran'); ?>",
                    data: {
                        id: id,
                        dateid: document.getElementById('dateid').value
                    },
                    success: function(result) {
                        Swal.fire({
                            icon: 'success',
                            title: result.sukses,
                        })
                        $("#refresbayartbl").load("/detailpembelian/" + document.getElementById('dateid').value + " #refresbayartbl");
                        refreshdata()
                        myDataBayar()
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                })

            }
        })

    }


    function DataBahan24k(id) {
        $('#kode_bahan24k').val(id)
        $('#modal-bahan24k').modal('toggle');
    }

    function DataReturSales(id) {
        $('#no_retur').val(id)
        $('#modal-retur').modal('hide');

    }

    function pembulatankoma(berat) {
        var num = Number(berat) // The Number() only visualizes the type and is not needed
        var roundedString = num.toFixed(2);
        var rounded = Number(roundedString);
        return rounded
    }

    function MasukField(jenis) {
        var hasil = $('#hasil').val()
        if (jenis == 'pembulatan') {
            $('#pembulatan').val(hasil)
        }
        if (jenis == 'tunai') {
            $('#tunai').val(hasil)
        }
        if (jenis == 'transfer') {
            $('#transfer').val(hasil)
        }
        myDataBayar()
    }

    function myDataBayar() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('ajaxdetailpembelian'); ?>",
            data: {
                dateid: '<?php echo $datapembelian['id_date_pembelian'] ?>'
            },
            success: function(result) {
                const tunai = $('#tunai').val()
                const transfer = $('#transfer').val()
                const pembulatan = $('#pembulatan').val()
                var hasil = result.totalbyr.byr_barang - tunai - transfer - pembulatan
                var hasilberat = hasil / result.totalbyr.harga_murni
                $('#hasil').val(hasil)
                if ($('#kelompok').val() == 5) {
                    $('#totalbayar').html(' Rp ' + hasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + '/ Carat : ' + pembulatankoma(hasilberat))
                } else if ($('#kelompok').val() == 6 || $('#kelompok').val() == 2) {
                    $('#totalbayar').html(' Rp ' + hasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
                } else {
                    $('#totalbayar').html(' Rp ' + hasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + '/ Berat : ' + pembulatankoma(hasilberat))

                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }



    function konfrim() {
        Swal.fire({
            title: 'Retur Barang ',
            text: "Apakah Ingin Retur Pembelian ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Retur',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("returform").submit();
            }
        })
    }

    function konfrimcancel() {
        Swal.fire({
            title: 'Cancel Pembelian',
            text: "Apakah Cancel Retur Pembelian ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Cancel Pembelian',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("cancelform").submit();
            }
        })
    }

    $('.pembayaranform').submit(function(e) {
        e.preventDefault()
        Swal.fire({
            title: 'Selesai',
            text: "Selesai Bayar ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Selesai',
        }).then((choose) => {
            if (choose.isConfirmed) {
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
                                if (result.error.saldo) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: result.error.saldo,
                                    })
                                }

                            } else {
                                $('#namabank').removeClass('is-invalid')
                                $('.namabank').html('')
                                $('#transfer').removeClass('is-invalid')
                                $('.transfer').html('')

                                $("#refresbayartbl").load("/detailpembelian/" + document.getElementById('dateid').value + " #refresbayartbl");
                                myDataBayar()
                                if (result.pesan_lebih) {
                                    if (result.pesan_lebih.pesan) {
                                        Swal.fire({
                                            icon: 'info',
                                            title: result.pesan_lebih.pesan,
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonText: 'OK',
                                        })
                                    }
                                }
                                if (result.berhasil) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: result.berhasil.pesan,
                                    })
                                    $('#modal-bayar').modal('toggle');
                                    $("#cardbayar").load("/detailpembelian/" + document.getElementById('dateid').value + " #cardbayar");
                                    $("#byr11").load("/detailpembelian/" + document.getElementById('dateid').value + " #byr22");

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

            }
        })
    })

    function refreshdata() {
        $("#tblretur").load("/detailpembelian/" + document.getElementById('dateid').value + " #retursales");
    }


    $(document).ready(function() {
        myDataBayar()

    })
</script>
<?= $this->endSection(); ?>