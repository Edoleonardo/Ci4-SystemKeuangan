<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/js/html5-qrcode.min_.js"></script>

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
                <!-- /.card-header -->
                <form action="/kodebarcode" name="formkodebarcode" id="formkodebarcode" class="formkodebarcode" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="iddate" id="iddate" value="<?= $datapenjualan['id_date_penjualan'] ?>">
                    <div class="card">
                        <div class="form-group" style="margin: 1mm;">
                            <label>Kode Barang</label>
                            <div class="input-group input-group-sm">
                                <input autocomplete="off" type="text" onfocus="this.select()" class="form-control kodebarang" id="kodebarang" oninput="ScanBarcode()" name="kodebarang" placeholder="Masukan Kode">
                                <span class="input-group-append">
                                    <button type="submit" id="btnsubmitform" class="btn btn-info btn-flat btnsubmitform">Ok</button>
                                </span>
                                <div id="validationServerUsernameFeedback" class="invalid-feedback kodebarangmsg">
                                </div>
                            </div>
                        </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <div class="col-sm-6">
            <!-- Application buttons -->
            <div class="card">
                <div class="card-body" id="refreshtombol">
                    <!-- <a class="btn btn-app tambahcustomer" id="tambahcustomer" data-toggle="modal" data-target="#modal-tambahcust">
                        <i class="fas fa-users"></i> Tambah Customer
                    </a> -->
                    <a type="button" onclick="Batal()" class="btn btn-app">
                        <i class="fas fa-window-close"></i> Batal Jual
                    </a>
                    <a class="btn btn-app bg-danger" onclick="myDataBayar()" type="button" data-toggle="modal" data-target="#modal-bayar">
                        <i class="fas fa-money-bill"></i> Bayar
                    </a>
                    <a class="btn btn-app bg-primary" type="button" onclick="ScanCamBarcode()">
                        <i class="fas Example of barcode fa-camera"></i> Scan Barcode
                    </a>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
</div>
<div class="card" id="datajual">
    <!-- /.card-header -->

    <!-- /.card-body -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
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
                    <input type="hidden" name="kelompok" id="kelompok" value="<?= $datapenjualan['kelompok'] ?>">
                    <input type="hidden" name="dateid" id="dateid" value="<?= $datapenjualan['id_date_penjualan'] ?>">
                    <input type="hidden" name="hasil" id="hasil" value="0">
                    <input type="hidden" name="berathasil" id="berathasil" value="0">
                    <div class="card-header">
                        <h4 style="text-align: center;" id="totalbayar"></h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label><a href="#" data-toggle="modal" data-target="#modal-customer">NoHp Customer</a></label>
                                    <input autocomplete="off" type="number" onfocus="this.select()" min="0" onfocusout="checkcust()" id="nohpcust" name="nohpcust" class="form-control" placeholder="Masukan No Hp">
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback nohpcustmsg"></div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Nama Customer</label><input autocomplete="off" type="text" onfocus="this.select()" min="0" id="namacust" name="namacust" class="form-control" placeholder="Nama Custtomer" readonly>
                                </div>
                            </div>
                        </div>
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
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Tanggal Transaksi (Sementara)</label><input type="date" min="0" id="tanggaltrans" name="tanggaltrans" class="form-control" placeholder="tanggal">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Selesai</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-tambahcust">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/insertcustomer" name="insertcust" id="insertcust" class="insertcust" method="post">
                <?= csrf_field(); ?>
                <div class="row" style="margin: 10px;">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Nama Customer</label>
                            <input autocomplete="off" type="text" id="nama_cust" name="nama_cust" class="form-control nama_cust" placeholder="Masukan Nama">
                            <div id="validationServerUsernameFeedback" class="invalid-feedback nama_custmsg">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nomor Hp</label>
                            <input autocomplete="off" type="number" id="nohp" name="nohp" class="form-control nohp" placeholder="Masukan Nomor No Hp">
                            <div id="validationServerUsernameFeedback" class="invalid-feedback nohpmsg">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Masukan Alamat">
                        </div>
                        <div class="form-group">
                            <label>Kota</label>
                            <input type="text" id="kota" name="kota" class="form-control" placeholder="Masukan Kota">
                        </div>
                        <div class="form-group">
                            <label>Bank</label>
                            <input type="text" id="banku1" name="banku1" class="form-control" placeholder="Masukan bank">
                        </div>
                        <div class="form-group">
                            <label>No Rekening</label>
                            <input autocomplete="off" type="text" id="no_rek1" name="no_rek1" class="form-control" placeholder="Masukan no rekening">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btntambah">Tambah</button>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-scan">
    <div class="modal-dialog modal-l">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ScanBarcode</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div style="width:500px;" id="reader"></div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" onclick="matiinscan()">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="matiinscan()">Selesai</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
<div id="modalcust"></div>
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<!-- Main Footer -->
<footer class="main-footer">

</footer>
<script type="text/javascript">
    var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", {
            fps: 10,
            qrbox: 100
        });

    function matiinscan() {
        html5QrcodeScanner.clear();
        $('#modal-scan').modal('toggle')
    }

    function ScanCamBarcode() {
        $('#modal-scan').modal('toggle')

        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            $('#kodebarang').val(decodedText)
            ScanBarcode()
            $('#modal-scan').modal('toggle')
            html5QrcodeScanner.clear();
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            // console.warn(`Code scan error = ${error}`);
        }
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    }

    function UbahKet(id, value) {
        $.ajax({
            type: "get",
            dataType: "json",
            url: "<?php echo base_url('ubahketjual'); ?>",
            data: {
                id: id,
                value: value.value,
            },
            success: function(result) {
                tampildata()
                myDataBayar()
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function isivalue() {
        var jenisbayar = $('#pembayaran').val();
        var harusbayar = $('#totalbersih').html().replaceAll('.', '');
        if (jenisbayar == 'Transfer') {
            $('#transfer').val(harusbayar);
            byrtransfer()
        }
        if (jenisbayar == 'Tunai') {
            $('#tunai').val(harusbayar);
            byrtunai()
        }
        if (jenisbayar == 'Debit/CC') {
            $('#debitcc').val(harusbayar);
            byrdebitcc()
        }
    }

    function tampilcustomer() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo base_url('tampilcust'); ?>",
            success: function(result) {
                // console.log(result)
                $('#modalcust').html(result.tampilcust)
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function checkcust() {
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {
                nohp_cust: document.getElementById('nohpcust').value
            },
            url: "<?php echo base_url('checkcust'); ?>",
            success: function(result) {
                console.log('asd')
                if (result == 'gagal') {
                    isicust = document.getElementById('nohpcust').value
                    document.getElementById("nohp").value = isicust
                    $('#modal-tambahcust').modal('show');
                } else {
                    console.log(result)
                    $('#namacust').val(result.nama);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
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

    function pilihbank(nmbank, jenis) {
        if (jenis == 'banktransfer') {
            $('#banktransfer').val(nmbank)
        } else {
            $('#bankdebitcc').val(nmbank)
        }
    }

    function pilihcustomer(nohp) {
        $('#nohpcust').val(nohp)
        $('#modal-customer').modal('hide')
        checkcust()
    }

    function tampildata() {
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {
                dateid: document.getElementById('iddate').value
            },
            url: "<?php echo base_url('tampildetailpenjualan'); ?>",
            success: function(result) {
                var totalharga = parseFloat(result.totalbersih.total_harga)
                $('#kelompok').val(result.kelompok)
                $('#datajual').html(result.data)

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
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
                $('#totalbayar').html(' Rp ' + hasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
                $('#totalberatkotorhtml01').html(result.totalberatkotor.berat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
                $('#totalbersih01').html(result.totalbersih.total_harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    $('.pembayaranform').submit(function(e) {
        console.log('asdas')
        e.preventDefault()
        Swal.fire({
            title: 'Bayar',
            text: "Selesai Bayar ?",
            icon: 'info',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Selesai',
        }).then((choose) => {
            if (choose.isConfirmed) {
                let form = $('.pembayaranform')[0];
                let data = new FormData(form)
                $.ajax({
                    type: "POST",
                    data: data,
                    url: "<?php echo base_url('ajaxpembayaranjual') ?>",
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    cache: false,
                    beforeSend: function() {
                        $('.btnbayar').html('<i class="fa fa-spin fa-spinner">')
                        $('.btnbayar').attr('type', 'button')
                    },
                    complete: function() {
                        $('.btnbayar').html('Bayar')
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
                                if (result.error.nohpcust) {
                                    $('#nohpcust').addClass('is-invalid')
                                    $('.nohpcustmsg').html(result.error.nohpcust)
                                } else {
                                    $('#nohpcust').removeClass('is-invalid')
                                    $('.nohpcustmsg').html('')
                                }
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
                                $('#nohpcust').removeClass('is-invalid')
                                $('.nohpcustmsg').html('')

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil Bayar',
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

    function Batal() {
        Swal.fire({
            title: 'Batal Penjualan ',
            text: "Apakah Ingin Batal Penjualan ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo base_url('batalpenjualan'); ?>"
            }
        })

    };

    function ScanBarcode() {
        // checkcust()
        $('#btnsubmitform').trigger('click');
    }

    $('.formkodebarcode').submit(function(e) {
        // checkcust()
        e.preventDefault()
        let form = $('.formkodebarcode')[0];
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            data: data,
            url: "<?php echo base_url('kodebarang'); ?>",
            contentType: false,
            processData: false,
            cache: false,
            dataType: "json",
            success: function(result) {
                if (result.error) {
                    if (result.error.kodebarang) {
                        $('#kodebarang').addClass('is-invalid')
                        $('.kodebarangmsg').html(result.error.kodebarang)
                    } else {
                        $('#kodebarang').removeClass('is-invalid')
                        $('.kodebarangmsg').html('')
                    }
                } else {
                    if (result.pesan == 'gagal') {
                        document.getElementById('kodebarang').removeAttribute("onkeyup");
                    } else {
                        $('#kodebarang').removeClass('is-invalid')
                        $('.kodebarangmsg').html('')
                        document.getElementById('kodebarang').setAttribute("onkeyup", "ScanBarcode()");
                        document.getElementById('kodebarang').value = ''
                        tampildata()
                    }
                    if (result.idmsg) {
                        window.location.href = "draftpenjualan/" + result.idmsg;
                    }
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })

    })

    $(document).ready(function() {
        tampildata()
        myDataBayar()
        tampilcustomer()
        $('.insertcust').submit(function(e) {
            e.preventDefault()
            let form = $('.insertcust')[0];
            let data = new FormData(form)
            $.ajax({
                type: "POST",
                data: data,
                url: "<?php echo base_url('insertcustomer'); ?>",
                dataType: "json",
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
                    if (result.error) {
                        if (result.error.nohp_cust) {
                            $('#nohp').addClass('is-invalid')
                            $('.nohpmsg').html(result.error.nohp_cust)
                        } else {
                            $('#nohp').removeClass('is-invalid')
                            $('.nohpmsg').html('')
                        }
                        if (result.error.nama_cust) {
                            $('#nama_cust').addClass('is-invalid')
                            $('.nama_custmsg').html(result.error.nama_cust)
                        } else {
                            $('#nama_cust').removeClass('is-invalid')
                            $('.nama_custmsg').html('')
                        }
                    } else {
                        $('#nohp').removeClass('is-invalid')
                        $('.nohpmsg').html('')
                        $('#nama_cust').removeClass('is-invalid')
                        $('.nama_custmsg').html('')
                        $('#modal-tambahcust').modal('toggle');
                        $('#nohpcust').removeClass('is-invalid')
                        $('.nohpcustmsg').html('')
                        tampilcustomer()
                        checkcust()
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil Tambah',
                        })
                    }

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        })
    })
</script>
<?= $this->endSection(); ?>