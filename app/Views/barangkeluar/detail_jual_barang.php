<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<script type="text/javascript" src="/js/jquery.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .table>tbody>tr>* {
        vertical-align: middle;
        text-align: center;
    }

    .imgg {
        width: 100px;
    }

    .modal {
        overflow: auto !important;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Form Penjualan Barang</h1>
                </div><!-- /.col -->
                <!-- /.content-header -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/barangkeluar">Home</a></li>
                        <li class="breadcrumb-item"><a href="/barangkeluar">Penjualan Barang</a></li>
                        <li class="breadcrumb-item active">Form Penjualan</li>
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
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>
                                    Nomor Jual : <?= $datapenjualan['no_transaksi_jual'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Nama Customer : <?= (isset($datacust['nama'])) ? $datacust['nama'] : ' ' ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    No Hp : <?= (isset($datacust['nohp_cust'])) ? $datacust['nohp_cust'] : '' ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tanggal Jual : <?= substr($datapenjualan['created_at'], 0, 10) ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-sm-6">
                <!-- Application buttons -->
                <div class="card" id="card1">
                    <div class="card-body" id="card2">
                        <a class="btn btn-app" target="_blank" onclick="pindahtempat('/printinvoice/<?= $datapenjualan['id_date_penjualan'] ?>')" target="_blank">
                            <i class="fas fa-print"></i> Print Invoce
                        </a>
                        <a class="btn btn-app bg-primary" type="button">
                            <i class="fas fa-check"></i> Lunas
                        </a>
                    </div>
                    <!-- /.card-body -->
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
                            <div class="card-body table-responsive p-0" id="refrshtbl1">
                                <?php if ($datapenjualan['kelompok'] == 1) : ?>
                                    <table class="table table-hover text-nowrap" id="refrshtbl2">
                                        <thead>
                                            <tr>
                                                <th>Gambar</th>
                                                <th>Kode</th>
                                                <th>Qty</th>
                                                <th>Harga Jual</th>
                                                <th>Ongkos</th>
                                                <th>Jenis</th>
                                                <th>Model</th>
                                                <th>Keterangan</th>
                                                <th>Berat</th>
                                                <th>Berat Murni</th>
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
                                                    <td><?= number_format($row['harga_beli'], 2, ',', '.') ?></td>
                                                    <td><?= number_format($row['ongkos'], 2, ',', '.') ?></td>
                                                    <td><?= $row['jenis'] ?></td>
                                                    <td><?= $row['model'] ?></td>
                                                    <td><?= $row['keterangan'] ?></td>
                                                    <td><?= $row['berat'] ?></td>
                                                    <td><?= $row['berat_murni'] ?></td>
                                                    <td><?= $row['kadar'] ?></td>
                                                    <td><?= $row['nilai_tukar'] ?></td>
                                                    <td><?= $row['merek'] ?></td>
                                                    <td><?= number_format($row['total_harga'], 2, ',', '.') ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php elseif ($datapenjualan['kelompok'] == 2) : ?>
                                    <table class="table table-hover text-nowrap" id="refrshtbl2">
                                        <thead>
                                            <tr>
                                                <th>Gambar</th>
                                                <th>Kode</th>
                                                <th>Qty</th>
                                                <th>Harga Jual</th>
                                                <th>Jenis</th>
                                                <th>Model</th>
                                                <th>Keterangan</th>
                                                <th>Berat</th>
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
                                                    <td><?= number_format($row['harga_beli'], 2, ',', '.') ?></td>
                                                    <td><?= $row['jenis'] ?></td>
                                                    <td><?= $row['model'] ?></td>
                                                    <td><?= $row['keterangan'] ?></td>
                                                    <td><?= $row['berat'] ?></td>
                                                    <td><?= $row['kadar'] ?></td>
                                                    <td><?= $row['merek'] ?></td>
                                                    <td><?= number_format($row['total_harga'], 2, ',', '.') ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php elseif ($datapenjualan['kelompok'] == 3) : ?>
                                    <table class="table table-hover text-nowrap" id="refrshtbl2">
                                        <thead>
                                            <tr>
                                                <th>Gambar</th>
                                                <th>Kode</th>
                                                <th>Qty</th>
                                                <th>Harga Jual</th>
                                                <th>Ongkos</th>
                                                <th>Jenis</th>
                                                <th>Model</th>
                                                <th>Keterangan</th>
                                                <th>Berat</th>
                                                <th>Berat Murni</th>
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
                                                    <td><?= number_format($row['harga_beli'], 2, ',', '.') ?></td>
                                                    <td><?= number_format($row['ongkos'], 2, ',', '.') ?></td>
                                                    <td><?= $row['jenis'] ?></td>
                                                    <td><?= $row['model'] ?></td>
                                                    <td><?= $row['keterangan'] ?></td>
                                                    <td><?= $row['berat'] ?></td>
                                                    <td><?= $row['berat_murni'] ?></td>
                                                    <td><?= $row['kadar'] ?></td>
                                                    <td><?= $row['nilai_tukar'] ?></td>
                                                    <td><?= $row['merek'] ?></td>
                                                    <td><?= number_format($row['total_harga'], 2, ',', '.') ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php elseif ($datapenjualan['kelompok'] == 4) : ?>
                                    <table class="table table-hover text-nowrap" id="refrshtbl2">
                                        <thead>
                                            <tr>
                                                <th>Gambar</th>
                                                <th>Kode</th>
                                                <th>Qty</th>
                                                <th>Harga Jual</th>
                                                <th>Jenis</th>
                                                <th>Model</th>
                                                <th>Keterangan</th>
                                                <th>Berat</th>
                                                <th>Kadar</th>
                                                <th>Total Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($tampildata as $row) : ?>
                                                <tr>
                                                    <td><img src='/img/<?= $row['nama_img'] ?>' class='imgg'></td>
                                                    <td><?= $row['kode'] ?></td>
                                                    <td><?= $row['qty'] ?></td>
                                                    <td><?= number_format($row['harga_beli'], 2, ',', '.') ?></td>
                                                    <td><?= $row['jenis'] ?></td>
                                                    <td><?= $row['model'] ?></td>
                                                    <td><?= $row['keterangan'] ?></td>
                                                    <td><?= $row['berat'] ?></td>
                                                    <td><?= $row['kadar'] ?></td>
                                                    <td><?= number_format($row['total_harga'], 2, ',', '.') ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php elseif ($datapenjualan['kelompok'] == 5) : ?>
                                    <table class="table table-hover text-nowrap" id="refrshtbl2">
                                        <thead>
                                            <tr>
                                                <th>Gambar</th>
                                                <th>Kode</th>
                                                <th>Qty</th>
                                                <th>Harga Jual</th>
                                                <th>Jenis</th>
                                                <th>Model</th>
                                                <th>Keterangan</th>
                                                <th>Carat</th>
                                                <th>Total Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($tampildata as $row) : ?>
                                                <tr>
                                                    <td><img src='/img/<?= $row['nama_img'] ?>' class='imgg'></td>
                                                    <td><?= $row['kode'] ?></td>
                                                    <td><?= $row['qty'] ?></td>
                                                    <td><?= number_format($row['harga_beli'], 2, ',', '.') ?></td>
                                                    <td><?= $row['jenis'] ?></td>
                                                    <td><?= $row['model'] ?></td>
                                                    <td><?= $row['keterangan'] ?></td>
                                                    <td><?= $row['carat'] ?></td>
                                                    <td><?= number_format($row['total_harga'], 2, ',', '.') ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php elseif ($datapenjualan['kelompok'] == 6) : ?>
                                    <table class="table table-hover text-nowrap" id="refrshtbl2">
                                        <thead>
                                            <tr>
                                                <th>Gambar</th>
                                                <th>Kode</th>
                                                <th>Qty</th>
                                                <th>Harga Jual</th>
                                                <th>Jenis</th>
                                                <th>Model</th>
                                                <th>Keterangan</th>
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
                                                    <td><?= number_format($row['harga_beli'], 2, ',', '.') ?></td>
                                                    <td><?= $row['jenis'] ?></td>
                                                    <td><?= $row['model'] ?></td>
                                                    <td><?= $row['keterangan'] ?></td>
                                                    <td><?= $row['merek'] ?></td>
                                                    <td><?= number_format($row['total_harga'], 2, ',', '.') ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php endif; ?>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body p-0" id="total1">
                                <table class="table table-striped" id="total2">
                                    <tbody>
                                        <?php if ($datapenjualan['kelompok'] == 1 || $datapenjualan['kelompok'] == 2 || $datapenjualan['kelompok'] == 3 || $datapenjualan['kelompok'] == 4) : ?>
                                            <tr>
                                                <td>Total Berat</td>
                                                <td><?= number_format($totalberat, 2, ',', '.') ?></td>
                                            </tr>
                                        <?php elseif ($datapenjualan['kelompok'] == 5) : ?>
                                            <tr>
                                                <td>Total Carat</td>
                                                <td><?= $totalcarat ?></td>
                                            </tr>
                                        <?php elseif ($datapenjualan['kelompok'] == 6) : ?>
                                            <tr>
                                                <td>Total Qty</td>
                                                <td><?= $totalqty ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <tr>
                                            <td>Total Harga</td>
                                            <td><?= number_format($datapenjualan['total_harga'], 0, ',', '.') ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body p-0" id="card11">
                                <table class="table table-striped" id="card22" ondblclick="OpenEditBayar()">
                                    <tbody>
                                        <?php if (isset($datapenjualan)) : ?>
                                            <?php if ($datapenjualan['pembulatan']) : ?>
                                                <tr>
                                                    <td>Pembulatan</td>
                                                    <td><?= number_format($datapenjualan['pembulatan'], 2, ",", ".") ?></td>
                                                </tr>
                                            <?php endif ?>
                                            <?php if ($datapenjualan['tunai']) : ?>
                                                <tr>
                                                    <td>Tunai</td>
                                                    <td><?= number_format($datapenjualan['tunai'], 2, ',', '.') ?></td>
                                                </tr>
                                            <?php endif ?>
                                            <?php if ($datapenjualan['debitcc']) : ?>
                                                <tr>
                                                    <td>Debit / CC <?= ($datapenjualan['charge']) ? '(' . $datapenjualan['charge'] . ')' : '' ?> </td>
                                                    <td><?= number_format($datapenjualan['debitcc'], 2, ',', '.') ?> (<?= $datapenjualan['bank_debitcc'] ?>)</td>
                                                </tr>
                                            <?php endif ?>
                                            <?php if ($datapenjualan['transfer']) : ?>
                                                <tr>
                                                    <td>Transfer</td>
                                                    <td><?= number_format($datapenjualan['transfer'], 2, ',', '.') ?> (<?= $datapenjualan['bank_transfer'] ?>)</td>
                                                </tr>
                                            <?php endif ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                                <!-- /.card-body -->
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

<!-- /.modal-dialog -->
</div>
<!-- Control Sidebar -->

<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<!-- Main Footer -->
<footer class="main-footer">

</footer>
<div class="modal fade" id="edit-bayar">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Pembayaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/editpembayaranform" id="editpembayaranform" class="editpembayaranform" name="editpembayaranform">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="kelompok" id="kelompok" value="<?= $datapenjualan['kelompok'] ?>">
                    <input type="hidden" name="dateid" id="dateid" value="<?= $datapenjualan['id_date_penjualan'] ?>">
                    <input type="hidden" name="hasil" id="hasil" value="0">
                    <input type="hidden" name="berathasil" id="berathasil" value="0">
                    <div class="card-header">
                        <h4 style="text-align: center;" id="totalbayar"></h4>
                    </div>
                    <div class="card-body">
                        <!-- <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label><a href="#" data-toggle="modal" data-target="#modal-customer">NoHp Customer</a></label>
                                    <input autocomplete="off" type="text" onfocus="this.select()" min="0" onfocusout="checkcust()" id="nohpcust" name="nohpcust" class="form-control" placeholder="Masukan No Hp">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback nohpcustmsg"></div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Nama Customer</label><input autocomplete="off" type="text" onfocus="this.select()" min="0" id="namacust" name="namacust" class="form-control" placeholder="Nama Custtomer" readonly>
                                </div>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label><a href="#" onclick="MasukField('pembulatan')">Pembulatan</a></label><input autocomplete="off" type="number" onchange="myDataBayar()" onfocus="this.select()" min="0" id="pembulatan" name="pembulatan" class="form-control" placeholder="Masukan pembulatan">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label><a href="#" onclick="MasukField('tunai')">Tunai</a></label><input type="number" onchange="myDataBayar()" onfocus="this.select()" min="0" id="tunai" name="tunai" class="form-control" placeholder="Masukan tunai">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback tunaimsg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label><a href="#" onclick="MasukField('transfer')">Transfer</a></label><input type="number" onchange="myDataBayar()" onfocus="this.select()" min="0" id="transfer" name="transfer" class="form-control" placeholder="Masukan transfer">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback transfermsg"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Bank Transfer</label><input type="text" min="0" id="banktransfer" name="banktransfer" class="form-control" placeholder="Pilih Bank" readonly>
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback banktransfermsg"></div>
                                </div>
                            </div>
                            <div class="row">
                                <?php foreach ($bank as $m) : ?>
                                    <div class="col">
                                        <div class="form-group">
                                            <button type="button" style="width: 200px;" onclick="pilihbank('<?= $m['nama_bank'] ?>','banktransfer')" class="btn btn-block btn-outline-info btn-lg"><?= $m['nama_bank'] ?></button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label><a href="#" onclick="MasukField('debitcc')">Debit/CC</a></label><input type="number" onchange="myDataBayar()" onfocus="this.select()" min="0" id="debitcc" name="debitcc" class="form-control" placeholder="Masukan Debit/CC">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback debitccmsg"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Charge</label><input type="number" onchange="myDataBayar()" min="0" step="0.01" id="charge" name="charge" class="form-control" placeholder="Charge">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label><a href="#" onclick="MasukField('byrcharge')">Bayar Charge</a></label><input type="number" onchange="myDataBayar()" min="0" step="0.01" id="byrcharge" name="byrcharge" class="form-control" placeholder="Bayar Charge">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Bank Debit/CC</label><input type="text" min="0" id="bankdebitcc" name="bankdebitcc" class="form-control" placeholder="Bank Debit/CC" readonly>
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback bankdebitccmsg"></div>
                                </div>
                            </div>
                            <div class="row">
                                <?php foreach ($bank as $m) : ?>
                                    <div class="col">
                                        <div class="form-group">
                                            <button type="button" style="width: 200px;" onclick="pilihbank('<?= $m['nama_bank'] ?>','bankdebitcc')" class="btn btn-block btn-outline-primary btn-lg"><?= $m['nama_bank'] ?></button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function OpenEditBayar() {
        $('#edit-bayar').modal('toggle')
        myDataBayar()
    }
    $('.editpembayaranform').submit(function(e) {
        e.preventDefault()
        Swal.fire({
            title: 'Edit Bayar',
            text: "Selesai Edit Bayar ?",
            icon: 'info',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Selesai',
        }).then((choose) => {
            if (choose.isConfirmed) {
                let form = $('.editpembayaranform')[0];
                let data = new FormData(form)
                $.ajax({
                    type: "POST",
                    data: data,
                    url: "<?php echo base_url('editpembayaranform') ?>",
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    cache: false,
                    beforeSend: function() {
                        $('.btnbayar').html('<i class="fa fa-spin fa-spinner">')
                        $('.btnbayar').attr('type', 'button')
                    },
                    complete: function() {
                        $('.btnbayar').html('Edit')
                        $('.btnbayar').attr('type', 'submit')
                    },
                    success: function(result) {
                        console.log(result)
                        if (result != 'error') {
                            if (result.error) {
                                if (result.error.debitcc) {
                                    $('#debitcc').addClass('is-invalid')
                                    $('.debitccmsg').html(result.error.debitcc)
                                } else {
                                    $('#debitcc').removeClass('is-invalid')
                                    $('.debitccmsg').html('')
                                }
                                if (result.error.banktransfer) {
                                    $('#banktransfer').addClass('is-invalid')
                                    $('.banktransfermsg').html(result.error.banktransfer)
                                } else {
                                    $('#banktransfer').removeClass('is-invalid')
                                    $('.banktransfermsg').html('')
                                }
                                if (result.error.bankdebitcc) {
                                    $('#bankdebitcc').addClass('is-invalid')
                                    $('.bankdebitccmsg').html(result.error.bankdebitcc)
                                } else {
                                    $('#bankdebitcc').removeClass('is-invalid')
                                    $('.bankdebitccmsg').html('')
                                }
                                if (result.error.transfer) {
                                    $('#transfer').addClass('is-invalid')
                                    $('.transfermsg').html(result.error.transfer)
                                } else {
                                    $('#transfer').removeClass('is-invalid')
                                    $('.transfermsg').html('')
                                }
                                // if (result.error.nohpcust) {
                                //     $('#nohpcust').addClass('is-invalid')
                                //     $('.nohpcustmsg').html(result.error.nohpcust)
                                // } else {
                                //     $('#nohpcust').removeClass('is-invalid')
                                //     $('.nohpcustmsg').html('')
                                // }
                                if (result.error.kurang) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: result.error.kurang,
                                    })
                                }
                            } else {
                                $('#debitcc').removeClass('is-invalid')
                                $('.debitccmsg').html('')
                                $('#banktransfer').removeClass('is-invalid')
                                $('.banktransfermsg').html('')
                                $('#bankdebitcc').removeClass('is-invalid')
                                $('.bankdebitccmsg').html('')
                                $('#transfer').removeClass('is-invalid')
                                $('.transfermsg').html('')
                                // $('#nohpcust').removeClass('is-invalid')
                                // $('.nohpcustmsg').html('')
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil Edit Pembayaran',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK',
                                    allowOutsideClick: false
                                }).then((choose) => {
                                    if (choose.isConfirmed) {
                                        // $('#modal-bayar').modal('toggle');
                                        // $("#refreshpembayaran").load("/draftpenjualan/" + document.getElementById('dateid').value + " #refreshpembayaran");
                                        // $("#refreshtombol").load("/draftpenjualan/" + document.getElementById('dateid').value + " #refreshtombol");

                                        window.location.href = "/detailpenjualan/" + document.getElementById('dateid').value
                                    }
                                })
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

    function MasukField(jenis) {
        var hasil = $('#hasil').val()
        if (jenis == 'pembulatan') {
            $('#pembulatan').val(hasil)
        } else if (jenis == 'tunai') {
            $('#tunai').val(hasil)
        } else if (jenis == 'transfer') {
            $('#transfer').val(hasil)
        } else if (jenis == 'debitcc') {
            $('#debitcc').val(hasil)
        } else if (jenis == 'byrcharge') {
            $('#byrcharge').val(hasil)
        }
        myDataBayar()
    }

    function myDataBayar() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('ajaxdetailpenjualan'); ?>",
            data: {
                dateid: '<?= (isset($datapenjualan['id_date_penjualan'])) ? $datapenjualan['id_date_penjualan'] : ''; ?>'
            },
            success: function(result) {
                const tunai = $('#tunai').val()
                const transfer = $('#transfer').val()
                const pembulatan = $('#pembulatan').val()
                const debitcc = $('#debitcc').val()
                const charge = $('#charge').val()
                const byrcharge = $('#byrcharge').val()

                if (charge) {
                    var totaldebit = debitcc * charge
                } else {
                    var totaldebit = 0
                }
                var hasil = (parseFloat(result.totalbersih.total_harga) + totaldebit) - tunai - transfer - pembulatan - debitcc - byrcharge
                $('#hasil').val(hasil)
                $('#totalbayar').html(' Rp ' + hasil.toLocaleString('en-US'))
                $('#totalberatkotorhtml01').html(result.totalberatkotor.berat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
                $('#totalbersih01').html(result.totalbersih.total_harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function refreshtbl() {
        $("#refrshtbl1").load("/detailpenjualan/" + document.getElementById('iddate1').value + " #refrshtbl2");
        $("#card1").load("/detailpenjualan/" + document.getElementById('iddate1').value + " #card2");
        $("#card11").load("/detailpenjualan/" + document.getElementById('iddate1').value + " #card22");
        $("#total1").load("/detailpenjualan/" + document.getElementById('iddate1').value + " #total2");
        // document.getElementById('pembayaran').value = 'Bayar Nanti'
    }

    function pilihbank(nmbank, jenis) {
        if (jenis == 'banktransfer') {
            $('#banktransfer').val(nmbank)
        } else {
            $('#bankdebitcc').val(nmbank)
        }
    }

    function pindahtempat(url) {
        window.open(url);
        window.location.href = '/barangkeluar'
    }
    $(document).ready(function() {
        // tampildataretur()

    })
</script>
<?= $this->endSection(); ?>