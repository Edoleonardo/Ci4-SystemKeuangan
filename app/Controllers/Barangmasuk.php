<?php

namespace App\Controllers;

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use App\Models\ModelBarangMasuk;
use App\Models\ModelDetailMasuk;
use App\Models\ModelKadar;
use App\Models\ModelMerek;
use App\Models\ModelSupplier;
use App\Models\ModelPembelian;
use App\Models\ModelHome;
use App\Models\ModelPembayaranBeli;
use App\Models\ModelKartuStock;
use App\Models\ModelDetailKartuStock;
use App\Models\ModelBank;
use App\Models\ModelJenis;
use App\Models\ModelRetur;
use App\Models\ModelTransaksi;
use App\Models\ModelDetailTransaksi;

use CodeIgniter\CLI\Console;
use CodeIgniter\Validation\Rules;
use PhpParser\Node\Expr\Isset_;

class Barangmasuk extends BaseController
{
    public function __construct()
    {

        $this->barcodeG =  new BarcodeGenerator();
        $this->detailbeli = new ModelDetailMasuk();
        $this->barangmasuk = new ModelBarangMasuk();
        $this->datasupplier = new ModelSupplier();
        $this->datakadar = new ModelKadar();
        $this->datamerek = new ModelMerek();
        $this->datajenis = new ModelJenis();
        $this->datapembelian = new ModelPembelian();
        $this->datastock = new ModelHome();
        $this->barcodeG =  new BarcodeGenerator();
        $this->modelpembayaran =  new ModelPembayaranBeli();
        $this->modelkartustock = new ModelKartuStock();
        $this->modeldetailkartustock = new ModelDetailKartuStock();
        $this->modelbank = new ModelBank();
        $this->modelretur = new ModelRetur();
        $this->modeltransaksi = new ModelTransaksi();
        $this->modeldetailtransaksi = new ModelDetailTransaksi();
    }
    public function supplier()
    {
        $data = [
            'datapembelian' => $this->datapembelian->getPembelianSupplier()
        ];
        return view('barangmasuk/barang_supplier', $data);
    }
    public function Pembayaran_beli()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            if ($this->request->getVar('pembayaran') != 'Bayar Nanti') {
                if ($this->request->getVar('pembayaran') == 'Transfer') {
                    $valid = $this->validate([
                        'transfer' => [
                            'rules' => 'required|greater_than[0]',
                            'errors' => [
                                'required' => 'Transfer Harus di isi',
                                'greater_than' => 'Tidak Boleh 0'
                            ]
                        ],
                        'namabank' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Nama Bank Harus di isi',
                            ]
                        ],
                        'harga_murni' => [
                            'rules' => 'required|greater_than[0]',
                            'errors' => [
                                'required' => 'Harga Murni Harus di isi',
                                'greater_than' => 'Tidak Boleh 0'
                            ]
                        ]
                    ]);
                }
                if ($this->request->getVar('pembayaran') == 'Tunai') {
                    $valid = $this->validate([
                        'tunai' => [
                            'rules' => 'required|greater_than[0]',
                            'errors' => [
                                'required' => 'Tunai Harus di isi',
                                'greater_than' => 'Tidak Boleh 0'
                            ]
                        ],
                        'harga_murni' => [
                            'rules' => 'required|greater_than[0]',
                            'errors' => [
                                'required' => 'Harga Murni Harus di isi',
                                'greater_than' => 'Tidak Boleh 0'
                            ]
                        ]
                    ]);
                }
                if ($this->request->getVar('pembayaran') == 'Bahan24K') {
                    $valid = $this->validate([
                        'kode_bahan24k' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Kode Harus di isi',
                            ]
                        ],
                        'harga_murni' => [
                            'rules' => 'required|greater_than[0]',
                            'errors' => [
                                'required' => 'Harga Murni Harus di isi',
                                'greater_than' => 'Tidak Boleh 0'
                            ]
                        ],
                        'beratbahan' => [
                            'rules' => 'required|greater_than[0]',
                            'errors' => [
                                'required' => 'Berat Harus di isi',
                                'greater_than' => 'Tidak Boleh 0'
                            ]
                        ]
                    ]);
                }
                if ($this->request->getVar('pembayaran') == 'ReturSales') {
                    $valid = $this->validate([
                        'no_retur' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Nomor Retur Harus di isi',
                            ]
                        ],
                        'harga_murni' => [
                            'rules' => 'required|greater_than[0]',
                            'errors' => [
                                'required' => 'Harga Murni Harus di isi',
                                'greater_than' => 'Tidak Boleh 0'
                            ]
                        ]
                    ]);
                }
                if (!$valid) {
                    $msg = [
                        'error' => [
                            'tunai' => $validation->getError('tunai'),
                            'harga_murni' => $validation->getError('harga_murni'),
                            'transfer' => $validation->getError('transfer'),
                            'namabank' => $validation->getError('namabank'),
                            'kode_bahan24k' => $validation->getError('kode_bahan24k'),
                            'no_retur' => $validation->getError('no_retur'),
                            'beratbahan' => $validation->getError('beratbahan'),

                        ]
                    ];
                    echo json_encode($msg);
                } else {
                    $session = session();
                    date_default_timezone_set('Asia/Jakarta');
                    $datapembelian = $this->datapembelian->getPembelianSupplier($this->request->getVar('dateid'));
                    // if ($datapembelian['harga_murni'] != $this->request->getVar('harga_murni')) { // harga murni kalo berubah
                    //     $selisihbyr = $datapembelian['total_berat_murni'] -  $datapembelian['byr_berat_murni'];
                    //     $dibayarberat = $selisihbyr * $datapembelian['byr_berat_murni'];
                    //     $dibayaruang =  $dibayarberat * $datapembelian['harga_murni'];
                    //     $beratbaru = $dibayaruang /  $this->request->getVar('harga_murni');
                    //     $this->datapembelian->save([
                    //         'id_pembelian' =>  $datapembelian['id_pembelian'],
                    //         'id_karyawan' => $session->get('id_user'),
                    //         'cara_pembayaran' => 'Belum Selesai',
                    //         'tanggal_bayar' => date("y-m-d h:m:s"),
                    //         'byr_berat_murni' =>  $beratbaru,
                    //         'harga_murni' => $this->request->getVar('harga_murni'),
                    //     ]);
                    // }
                    if ($datapembelian['byr_berat_murni'] > 0) {
                        if ($this->request->getVar('pembayaran') == 'Bahan24K') {
                            $databahan24k = $this->datastock->CheckData($this->request->getVar('kode_bahan24k'));
                            $databayar = $this->modelpembayaran->getCheckKode24k($this->request->getVar('kode_bahan24k'));
                            if ($databahan24k != null && $databahan24k['qty'] != 0 && $databayar == null) {
                                if ($databahan24k['berat'] >= $this->request->getVar('beratbahan')) {
                                    $byrberatmurni = $datapembelian['byr_berat_murni'] - $this->request->getVar('beratbahan');
                                    $jmlbyr = $this->request->getVar('harga_murni') * $this->request->getVar('beratbahan');
                                    $this->datapembelian->save([
                                        'id_pembelian' =>  $datapembelian['id_pembelian'],
                                        'id_karyawan' => $session->get('id_user'),
                                        'cara_pembayaran' => 'Belum Selesai',
                                        'tanggal_bayar' => date("y-m-d h:m:s"),
                                        'byr_berat_murni' =>  $byrberatmurni,
                                        'harga_murni' => $this->request->getVar('harga_murni'),
                                    ]);
                                    $this->modelpembayaran->save([
                                        'id_date_pembelian' =>  $datapembelian['id_date_pembelian'],
                                        'id_karyawan' => $session->get('id_user'),
                                        'nama_bank' => $this->request->getVar('namabank'),
                                        'cara_pembayaran' => $this->request->getVar('pembayaran'),
                                        'jumlah_pembayaran' => $jmlbyr,
                                        'qty' => 1,
                                        'no_retur' => null,
                                        'kode_24k' => $this->request->getVar('kode_bahan24k'),
                                        'harga_murni' => $this->request->getVar('harga_murni'),
                                        'berat_murni' => $this->request->getVar('beratbahan'),
                                    ]);

                                    $datakartu = $this->modelkartustock->getKartuStockkode($this->request->getVar('kode_bahan24k'));
                                    $saldoakhir = $datakartu['saldo_akhir'] - $this->request->getVar('beratbahan');
                                    if ($saldoakhir == 0) {
                                        $qty = 0;
                                    } else {
                                        $qty = 1;
                                    }
                                    $this->datastock->save([
                                        'id_stock' => $databahan24k['id_stock'],
                                        'id_karyawan' => $session->get('id_user'),
                                        'berat' => $saldoakhir,
                                        'qty' => $qty,
                                    ]);
                                    $namasup = $this->datasupplier->getSupplier($datapembelian['id_supplier']);
                                    $this->modeldetailkartustock->save([
                                        // 'id_detail_kartustock' => $datadetailkartu['id_detail_kartustock'],
                                        'barcode' => $this->request->getVar('kode_bahan24k'),
                                        'status' => 'Keluar',
                                        'id_karyawan' => $session->get('id_user'),
                                        'no_faktur' => $datapembelian['no_transaksi'],
                                        'tgl_faktur' => $datapembelian['tgl_faktur'],
                                        'nama_customer' => $namasup['nama_supp'],
                                        'saldo' => $saldoakhir,
                                        'masuk' => 0,
                                        'keluar' => $this->request->getVar('beratbahan'),
                                        'jenis' => $databahan24k['jenis'],
                                        'model' => $databahan24k['model'],
                                        'keterangan' => 'Bayar Supplier',
                                        'merek' => $databahan24k['merek'],
                                        'kadar' => $databahan24k['kadar'],
                                        'berat' => $databahan24k['berat'],
                                        'nilai_tukar' =>  $databahan24k['nilai_tukar'],
                                        'harga_beli' => $databahan24k['harga_beli'],
                                        'total_harga' => $databahan24k['total_harga'],
                                        'gambar' =>  $databahan24k['gambar'],
                                    ]);
                                    $this->KartuStockMaster($this->request->getVar('kode_bahan24k'), $session);
                                    $msg = [
                                        'pesan' => [
                                            'pesan' => 'berhasil'
                                        ]
                                    ];
                                } else {
                                    $msg = [
                                        'error' => [
                                            'beratbahan' => 'Stock Kurang'
                                        ]
                                    ];
                                }
                            } else {
                                $msg = [
                                    'error' => [
                                        'kode_bahan24k' => 'Data Tidak ada / Sudah Masuk'
                                    ]
                                ];
                            }
                        }
                        if ($this->request->getVar('pembayaran') == 'ReturSales') {
                            $dataretur = $this->modelretur->getBarangNomor($this->request->getVar('no_retur'));
                            if ($dataretur != null && $dataretur['no_transaksi'] == null) {
                                $byrberatmurni = $datapembelian['byr_berat_murni'] - $dataretur['total_berat_murni'];
                                $jmlbyr = $this->request->getVar('harga_murni') * $dataretur['total_berat_murni'];
                                if ($byrberatmurni < 0) {
                                    $byrberatmurni = 0;
                                }
                                $this->datapembelian->save([
                                    'id_pembelian' =>  $datapembelian['id_pembelian'],
                                    'id_karyawan' => $session->get('id_user'),
                                    'cara_pembayaran' => 'Belum Selesai',
                                    'tanggal_bayar' => date("y-m-d h:m:s"),
                                    'byr_berat_murni' =>  $byrberatmurni,
                                    'harga_murni' => $this->request->getVar('harga_murni'),
                                ]);
                                $this->modelpembayaran->save([
                                    'id_date_pembelian' =>  $datapembelian['id_date_pembelian'],
                                    'id_karyawan' => $session->get('id_user'),
                                    'nama_bank' => $this->request->getVar('namabank'),
                                    'cara_pembayaran' => $this->request->getVar('pembayaran'),
                                    'jumlah_pembayaran' => $jmlbyr,
                                    'qty' => $dataretur['jumlah_barang'],
                                    'no_retur' => $this->request->getVar('no_retur'),
                                    'kode_24k' => null,
                                    'harga_murni' => $this->request->getVar('harga_murni'),
                                    'berat_murni' => $dataretur['total_berat_murni'],
                                ]);
                                $this->modelretur->save([
                                    'id_retur' => $dataretur['id_retur'],
                                    'id_karyawan' => $session->get('id_user'),
                                    'no_transaksi' => $datapembelian['no_transaksi'],
                                ]);
                                $msg = [
                                    'pesan' => [
                                        'pesan' => 'berhasil'
                                    ]
                                ];
                            } else {
                                $msg = [
                                    'error' => [
                                        'no_retur' => 'Data Tidak ada / Sudah Masuk'
                                    ]
                                ];
                            }
                        }
                        if ($this->request->getVar('pembayaran') == 'Transfer' || $this->request->getVar('pembayaran') == 'Tunai') {
                            if ($this->request->getVar('transfer')) {
                                $jumlah_pembayaran = $this->request->getVar('transfer');
                            } else {
                                $jumlah_pembayaran = $this->request->getVar('tunai');
                            }
                            $datatransaksi = $this->modeltransaksi->getTransaksi();
                            $harga = $datapembelian['byr_berat_murni'] * $this->request->getVar('harga_murni');
                            if ($jumlah_pembayaran <= $harga) {
                                if ($datatransaksi['total_akhir_tunai'] >= $jumlah_pembayaran && $this->request->getVar('pembayaran') == 'Tunai') {
                                    $sukses = true;
                                }
                                if ($datatransaksi['total_akhir_transfer'] >= $jumlah_pembayaran && $this->request->getVar('pembayaran') == 'Transfer') {
                                    $sukses = true;
                                }
                                if ($datatransaksi['total_akhir_debitcc'] >= $jumlah_pembayaran && $this->request->getVar('pembayaran') == 'Debitcc') {
                                    $sukses = true;
                                }
                                if (!isset($sukses)) {
                                    $msg = [
                                        'error' => [
                                            strtolower($this->request->getVar('pembayaran')) => 'Saldo Kurang'
                                        ]
                                    ];
                                }
                                if (isset($sukses)) {
                                    $beratmurni = round($jumlah_pembayaran / $this->request->getVar('harga_murni'), 2);
                                    $byrberatmurni = round($datapembelian['byr_berat_murni'] - $beratmurni, 2);
                                    $this->datapembelian->save([
                                        'id_pembelian' =>  $datapembelian['id_pembelian'],
                                        'id_karyawan' => $session->get('id_user'),
                                        'cara_pembayaran' => 'Belum Selesai',
                                        'tanggal_bayar' => date("y-m-d h:m:s"),
                                        'byr_berat_murni' =>  $byrberatmurni,
                                        'harga_murni' => $this->request->getVar('harga_murni'),
                                    ]);
                                    $this->modelpembayaran->save([
                                        'id_date_pembelian' =>  $datapembelian['id_date_pembelian'],
                                        'id_karyawan' => $session->get('id_user'),
                                        'nama_bank' => $this->request->getVar('namabank'),
                                        'cara_pembayaran' => $this->request->getVar('pembayaran'),
                                        'jumlah_pembayaran' => $jumlah_pembayaran,
                                        'no_retur' => '-',
                                        'kode_24k' => '-',
                                        'harga_murni' => $this->request->getVar('harga_murni'),
                                        'berat_murni' => $beratmurni,
                                    ]);
                                    $this->modeldetailtransaksi->save([
                                        'tanggal_transaksi' => date("Y-m-d H:i:s"),
                                        'id_karyawan' => $session->get('id_user'),
                                        'pembayaran' => $this->request->getVar('pembayaran'),
                                        'keterangan' => $datapembelian['no_transaksi'],
                                        'id_akun_biaya' => 24,
                                        'masuk' => 0,
                                        'keluar' => $jumlah_pembayaran,
                                        'nama_bank' => ($this->request->getVar('namabank')) ? $this->request->getVar('namabank') : null,
                                    ]);
                                    $this->BiayaHarianMaster($datatransaksi['id_transaksi'], $session);

                                    $msg = [
                                        'pesan' => [
                                            'pesan' => 'berhasil'
                                        ]
                                    ];
                                }
                            } else {
                                $msg = [
                                    'pesan_lebih' => [
                                        'pesan' => 'Kelebihan Bayar'
                                    ]
                                ];
                            }
                        }
                        echo json_encode($msg);
                    } else {
                        $msg = [
                            'pesan_lebih' => [
                                'pesan' => 'Kelebihan Bayar'
                            ]
                        ];
                        echo json_encode($msg);
                    }
                }
            }
        } else {
            echo json_encode('error');
        }
    }
    public function DeletePembayaran()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $id = $this->request->getVar('id');
            $databayar = $this->modelpembayaran->getDetailPembayaran($id);
            $datapembelian = $this->datapembelian->getPembelianSupplier($databayar['id_date_pembelian']);
            if ($databayar['cara_pembayaran'] == 'Bahan24K') {
                $databahan24k = $this->datastock->CheckData($databayar['kode_24k']);
                $datadetailkartu = $this->modeldetailkartustock->GetDataDelete($databayar['kode_24k'], $datapembelian['no_transaksi']);
                $this->modeldetailkartustock->delete($datadetailkartu['id_detail_kartustock']);
                $this->KartuStockMaster($databayar['kode_24k'], $session);
                $datakartu = $this->modelkartustock->getKartuStockkode($databayar['kode_24k']);
                $this->datastock->save([
                    'id_stock' => $databahan24k['id_stock'],
                    'id_karyawan' => $session->get('id_user'),
                    'berat' => $datakartu['saldo_akhir'],
                    'qty' => 1,
                ]);
            }
            if ($databayar['cara_pembayaran'] == 'Tunai' || $databayar['cara_pembayaran'] == 'Transfer') {
                $datatransaksi = $this->modeltransaksi->getTransaksi(); //hanya 1 data
                $datadetailtrans = $this->modeldetailtransaksi->getDataDeleteTrans($datapembelian['no_transaksi'], $databayar['cara_pembayaran']);
                $this->modeldetailtransaksi->delete($datadetailtrans['id_detail_transaksi']);
                $this->BiayaHarianMaster($datatransaksi['id_transaksi'], $session);
            }
            // if ($databayar['cara_pembayaran'] == 'ReturSales') {
            //     $dataretur = $this->modelretur->getBarangNomor($databayar['no_retur']);
            //     $this->modelretur->save([
            //         'id_retur' => $dataretur['id_retur'],
            //         'id_karyawan' => $session->get('id_user'),
            //         'no_transaksi' => null,
            //     ]);
            // }

            $byrberatmurni = $datapembelian['byr_berat_murni'] + $databayar['berat_murni'];
            $this->datapembelian->save([
                'id_pembelian' =>  $datapembelian['id_pembelian'],
                'id_karyawan' => $session->get('id_user'),
                'byr_berat_murni' =>  $byrberatmurni,
            ]);
            $this->modelpembayaran->delete($id);
            $msg = [
                'sukses' => 'Berhasil'
            ];
            echo json_encode($msg);
        }
    }

    public function detail_pembelian()
    {
        $session = session();
        $dateid = date("ymdhis");
        $notransaksi = $this->NoTransaksiGenerate();
        $this->datapembelian->save([
            'id_date_pembelian' => $dateid,
            'kelompok' => null,
            'id_supplier' => '-',
            'id_karyawan' => $session->get('id_user'),
            // 'no_faktur_supp' => '-',
            'no_transaksi' => $notransaksi,
            'tgl_faktur' => date('Y-m-d H:i:s'),
            // 'total_berat_murni' => 0,
            'byr_berat_murni' => 0,
            'tgl_jatuh_tempo' => date('Y-m-d H:i:s'),
            'cara_pembayaran' => 'Bayar Nanti',
            'total_bayar' => 0,
            'status_dokumen' => 'Draft'
        ]);
        return redirect()->to('/draft/' . $dateid);
    }
    public function TampilForm()
    {
        if ($this->request->isAJAX()) {
            $databeli = $this->datapembelian->getPembelianSupplier($this->request->getVar('date_id'));
            $data = [
                'iddate' => $this->request->getVar('date_id'),
                'datapembelian' => $databeli,
                'merek' => $this->datamerek->getMerek(),
                'jenis' => $this->datajenis->getJenis(),
                'kadar' => $this->datakadar->getKadar(),
                'supplier' => $this->datasupplier->getSupplier(),
            ];
            if ($databeli['kelompok']) {
                if ($databeli['kelompok'] == 1 || $databeli['kelompok'] == 2 || $databeli['kelompok'] == 3 || $databeli['kelompok'] == 4) {
                    $view =  view('barangmasuk/forminput1234', $data);
                }
                if ($databeli['kelompok'] == 5) {
                    $view =  view('barangmasuk/forminput5', $data);
                }
                if ($databeli['kelompok'] == 6) {
                    $view =  view('barangmasuk/forminput6', $data);
                }
            } else {
                $view = view('barangmasuk/formpilihkel', $data);
            }
            $msg = [
                'form' => $view,
            ];
            echo json_encode($msg);
        }
    }
    public function pembelian_read()
    {
        $session = session();
        if ($this->request->isAJAX()) {
            if ($this->request->getVar('date_id')) {
                $data = [
                    'tampildata' => $this->detailbeli->getDetailAll($this->request->getVar('date_id'))
                ];

                $msg = [
                    'data' => view('barangmasuk/detailtable', $data),
                    'totalbersih' => $this->detailbeli->SumDataDetail($this->request->getVar('date_id')),
                    'totalberat' => $this->detailbeli->SumBeratDetail($this->request->getVar('date_id')),
                    'totalberatmurni' => $this->detailbeli->SumBeratMurniDetail($this->request->getVar('date_id')),
                    'totalqty' => $this->detailbeli->SumQty($this->request->getVar('date_id'))
                ];
                echo json_encode($msg);
            } else {
                echo json_encode(0);
            }
        }
        // return view('barangmasuk/pembelian_supplier');
    }
    public function pembelian_detail_read()
    {
        if ($this->request->isAJAX()) {

            $msg = [
                'totalbersih' => $this->detailbeli->SumDataDetail($this->request->getVar('dateid')),
                'totalberat' => $this->detailbeli->SumBeratDetail($this->request->getVar('dateid')),
                'totalberatmurni' => $this->datapembelian->getPembelianSupplier($this->request->getVar('dateid')),
                'totalqty' => $this->detailbeli->SumQty($this->request->getVar('dateid'))
            ];
            echo json_encode($msg);
        }
        // return view('barangmasuk/pembelian_supplier');
    }
    public function pembelian_insert()
    {
        if ($this->request->isAJAX()) {
            date_default_timezone_set('Asia/Jakarta');
            $validation = \Config\Services::validation();
            $filesampul = $this->request->getFile('gambar');
            $valid = $this->validate([
                'nilai_tukar' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nilai Tukar Harus di isi',
                    ]
                ],
                'qty' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Qty Harus di isi',
                    ]
                ],
                'no_nota_supp' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nomor Nota Harus di isi',
                    ]
                ],
                'total_berat_m' => [
                    'rules' => 'required|greater_than[0]',
                    'errors' => [
                        'required' => 'Total Harus di isi',
                        'greater_than' => 'tidak boleh 0'
                    ]
                ],
                'jenis' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Harus di isi',
                    ]
                ],
                'merek' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'merek Harus di isi',
                    ]
                ],
                'berat' => [
                    'rules' => 'required|greater_than[0]',
                    'errors' => [
                        'required' => 'Harus di isi',
                        'greater_than' => 'tidak boleh 0'
                    ]
                ],
                'harga_beli' => [
                    'rules' => 'required|greater_than[0]',
                    'errors' => [
                        'required' => 'Berat Bersih Harus di isi',
                        'greater_than' => 'tidak boleh 0'
                    ]
                ],
                'ongkos' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Ongkos Harus di isi',
                    ]
                ],
                'gambar' => [
                    'rules' => 'is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'mime_in' => 'extention tidak cocok',
                        'is_image' => 'Bukan Gambar',

                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'no_nota_supp' => $validation->getError('no_nota_supp'),
                        'qty' => $validation->getError('qty'),
                        'total_berat_m' => $validation->getError('total_berat_m'),
                        'nilai_tukar' => $validation->getError('nilai_tukar'),
                        'jenis' => $validation->getError('jenis'),
                        'merek' => $validation->getError('merek'),
                        'berat' => $validation->getError('berat'),
                        'harga_beli' => $validation->getError('harga_beli'),
                        'ongkos' => $validation->getError('ongkos'),
                        'gambar' => $validation->getError('gambar'),
                    ]
                ];
                echo json_encode($msg);
            } else {
                $session = session();
                $datapembelian1 = $this->datapembelian->getPembelianSupplier($this->request->getVar('dateid'));
                if ($this->request->getVar('barcode')) {
                    $barcode = $this->request->getVar('barcode');
                    $kode = substr($this->request->getVar('barcode'), 0, 1);
                    $datareal = $this->datastock->getBarangBarcode($this->request->getVar('barcode'));
                } else {
                    $kode = $datapembelian1['kelompok'];
                    $barcode = $this->KodeDatailGenerate($kode);
                }
                if ($this->request->getPost('gambar')) {
                    $image = $this->request->getPost('gambar');
                    $image = str_replace('data:image/jpeg;base64,', '', $image);
                    $image = base64_decode($image, true);
                    $micro_date = microtime();
                    $date_array = explode(" ", $micro_date);
                    $date = date("ymdis", $date_array[1]);
                    $namafile = $date . $date_array[0] . '.jpg';
                    file_put_contents(FCPATH . '/img/' . $namafile, $image);
                } else {
                    $filesampul = $this->request->getFile('gambar');
                    if ($filesampul->getError() == 4) {
                        if (isset($datareal)) {
                            $namafile = $datareal['gambar'];
                        } else {
                            $namafile = 'default.jpg';
                        }
                    } else {
                        // $namafile = $filesampul->getRandomName(); // pake nama random
                        // $namafile = $filesampul->getName(); // ini pake nama asli di foto
                        $micro_date = microtime();
                        $date_array = explode(" ", $micro_date);
                        $date = date("ymdis", $date_array[1]);
                        $namafile = $date . $date_array[0] . '.jpg';
                        $filesampul->move('img', $namafile);
                    }
                }
                $datasupp = $this->datasupplier->getSupplier($this->request->getVar('supplier'));
                $qty = $this->request->getVar('qty');
                $harga = $this->request->getVar('harga_beli');
                $berat = $this->request->getVar('berat');
                $beratmurni = round($berat * ($this->request->getVar('nilai_tukar') / 100), 2);
                if ($kode == 1 || $kode == 4 || $kode == 5) {
                    $totalharga =  $beratmurni *  $harga;
                }
                if ($kode == 2) {
                    $totalharga = $harga;
                }
                if ($kode == 3) {
                    $totalharga =  $beratmurni *  $harga * $qty;
                }
                if ($kode == 6) {
                    $totalharga = $harga * $qty;
                }

                $this->detailbeli->save([
                    'created_at' => $this->request->getVar('tanggal_input'),
                    'id_karyawan' => $session->get('id_user'),
                    'id_date_pembelian' => $this->request->getVar('dateid'),
                    'nama_img' => $namafile,
                    'kode' =>   $barcode,
                    'qty' => $this->request->getVar('qty'),
                    'jenis' => $this->request->getVar('jenis'),
                    'model' => $this->request->getVar('model'),
                    'keterangan' => $this->request->getVar('keterangan'),
                    'berat' => $this->request->getVar('berat'),
                    'berat_murni' => $beratmurni,
                    'ongkos' => $this->request->getVar('ongkos'),
                    'harga_beli' => $this->request->getVar('harga_beli'),
                    'kadar' =>  $this->request->getVar('kadar'),
                    'nilai_tukar' =>  $this->request->getVar('nilai_tukar'),
                    'merek' => $this->request->getVar('merek'),
                    'total_harga' => $totalharga + $this->request->getVar('ongkos'),
                ]);

                $this->datapembelian->save([
                    'id_pembelian' =>  $datapembelian1['id_pembelian'],
                    'id_karyawan' => $session->get('id_user'),
                    'created_at' => $this->request->getVar('tanggal_input'),
                    'id_date_pembelian' => $this->request->getVar('dateid'),
                    'id_supplier' => $this->request->getVar('supplier'),
                    'harga_murni' => $this->request->getVar('harga_beli'),
                    'no_faktur_supp' => $datasupp['inisial'] . '-' . $this->request->getVar('no_nota_supp'),
                    'no_transaksi' => $datapembelian1['no_transaksi'],
                    'tgl_faktur' => $this->request->getVar('tanggal_nota_sup') . ' ' . date('H:i:s'),
                    'total_berat_murni' => $this->request->getVar('total_berat_m'),
                    'byr_berat_murni' => $this->request->getVar('total_berat_m'),
                    'tgl_jatuh_tempo' => $this->request->getVar('tanggal_tempo') . ' ' . date('H:i:s'),
                    'cara_pembayaran' => 'Bayar Nanti',
                    'total_bayar' => $this->detailbeli->SumDataDetail($this->request->getVar('dateid')),
                    'status_dokumen' => 'Draft'
                ]);
                $msg = [
                    'sukses' => 'berhasil'
                ];
                echo json_encode($msg);
            }
        } else {
            exit('TIdak bisa masuk');
        }
        // return view('barangmasuk/pembelian_supplier');
    }
    public function NoTransaksiGenerate()
    {
        $data = $this->datapembelian->getNoTrans();
        if ($this->datapembelian->getNoTrans()) {
            if (substr($data['no_transaksi'], 0, 2) == date('y')) {
                $valnotransaksi = substr($data['no_transaksi'], 4, 10) + 1;
                $notransaksi = 'M-' . date('ym') . str_pad($valnotransaksi, 4, '0', STR_PAD_LEFT);

                return $notransaksi;
            } else {
                $notransaksi = 'M-' . date('ym') . str_pad(1, 4, '0', STR_PAD_LEFT);

                return $notransaksi;
            }
        } else {
            $notransaksi = 'M-' . date('ym') . str_pad(1, 4, '0', STR_PAD_LEFT);

            return $notransaksi;
        }
    }
    public function KodeDatailGenerate($id)
    {
        $kodestock = $this->datastock->getKodeStock($id);
        $kodedetail = $this->detailbeli->getKode($id);

        if ($this->datastock->getKodeStock($id) || $this->detailbeli->getKode($id)) {
            if ($kodestock['kode'] >= $kodedetail['kode']) {
                if (substr($kodestock['kode'], 0, 2) == date('y')) {
                    $valkode = substr($kodestock['kode'], 2, 5) + 1;
                    $notransaksi = $id . date('y') . str_pad($valkode, 5, '0', STR_PAD_LEFT);

                    return $notransaksi;
                } else {
                    $kode = $id . date('y') . str_pad(1, 5, '0', STR_PAD_LEFT);

                    return $kode;
                }
            } else {
                if (substr($kodedetail['kode'], 0, 2) == date('y')) {
                    $valkode = substr($kodedetail['kode'], 2, 5) + 1;
                    $notransaksi = $id . date('y') . str_pad($valkode, 5, '0', STR_PAD_LEFT);

                    return $notransaksi;
                } else {
                    $kode = $id . date('y') . str_pad(1, 5, '0', STR_PAD_LEFT);

                    return $kode;
                }
            }
        } else {
            $kode = $id . date('y') . str_pad(1, 5, '0', STR_PAD_LEFT);

            return $kode;
        }
    }
    public function DeleteDetail()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $datapembelian = $this->datapembelian->getPembelianSupplier($this->request->getVar('date_id'));
            //$datastock = $this->datastock->CheckData(1);
            $id = $this->request->getVar('id');
            $data = $this->detailbeli->getDetailone($id);
            $this->datapembelian->save([
                'id_pembelian' =>  $datapembelian['id_pembelian'],
                'id_karyawan' => $session->get('id_user'),
                'total_berat_rill' => round($this->detailbeli->SumBeratDetail($this->request->getVar('date_id'))['berat'], 2),
                'berat_murni_rill' => round($this->detailbeli->SumBeratMurniDetail($this->request->getVar('date_id'))['berat_murni'], 2),
                'total_bayar' =>  $this->detailbeli->SumDataDetail($this->request->getVar('dateid')),
            ]);
            if ($data['nama_img'] != 'default.jpg') {
                $datareal = $this->datastock->getBarangBarcode($data['kode']);
                if ($datareal) {
                    if ($datareal['gambar'] != $data['nama_img']) {
                        unlink('img/' . $data['nama_img']); //untuk hapus file
                    }
                } else {
                    unlink('img/' . $data['nama_img']); //untuk hapus file
                }
            }


            $this->detailbeli->delete($id);

            $msg = [
                'sukses' => 'Berhasil'
            ];
            echo json_encode($msg);
        }
    }


    public function GetDataDetail()
    {
        if ($this->request->isAJAX()) {
            $data = $this->detailbeli->getDetailKode($this->request->getVar('kode'));
            $msg = [
                'data' => $data
            ];

            echo json_encode($msg);
        }
    }

    public function DeleteDetailsemua()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $data = $this->detailbeli->getDetailAll($this->request->getVar('date_id'));
            $datapembelian = $this->datapembelian->getPembelianSupplier($this->request->getVar('date_id'));
            $this->datapembelian->save([
                'id_pembelian' =>  $datapembelian['id_pembelian'],
                'id_karyawan' => $session->get('id_user'),
                'total_berat_rill' => round($this->detailbeli->SumBeratDetail($this->request->getVar('date_id'))['berat'], 2),
                'berat_murni_rill' => round($this->detailbeli->SumBeratMurniDetail($this->request->getVar('date_id'))['berat_murni'], 2),
                'total_bayar' =>  0,
            ]);
            foreach ($data as $row) {
                if ($row['nama_img'] != 'default.jpg') {
                    $datareal = $this->datastock->getBarangBarcode($row['kode']);
                    if ($datareal) {
                        if ($datareal['gambar'] != $row['nama_img']) {
                            unlink('img/' . $row['nama_img']); //untuk hapus file
                        }
                    } else {
                        unlink('img/' . $row['nama_img']); //untuk hapus file
                    } //untuk hapus file
                }
            }
            $this->detailbeli->query('DELETE FROM tbl_detail_pembelian WHERE id_date_pembelian =' . $this->request->getVar('date_id') . ';');

            $msg = [
                'sukses' => 'Berhasil hapus semua'
            ];
            echo json_encode($msg);
        }
    }

    function MasukDraft($id)
    {
        $data = $this->datapembelian->getPembelianSupplier($id);
        // dd($data['id_pembelian']);
        $datapembelian = [
            'datapembelian' => $data,
            'merek' => $this->datamerek->getMerek(),
            'jenis' => $this->datajenis->getJenis(),
            'kadar' => $this->datakadar->getKadar(),
            'supplier' => $this->datasupplier->getSupplier(),
            'dateid' => $id
            // 'databarcode' => $this->datastock->getBarcode()

        ];

        return view('barangmasuk/pembelian_supplier', $datapembelian);
    }

    function DetailPembelianSupp($id)
    {

        $data = [
            'datapembelian' => $this->datapembelian->getPembelianSupplierJoin($id),
            'tampildata' =>  $this->detailbeli->getDetailAll($id),
            'tampil24k' =>  $this->datastock->getKodeBahan24k(),
            'tampilretur' =>  $this->modelretur->getDataReturBayar(),
            'databarang' => $this->detailbeli->getDetailAll($id),
            'totalberat' => $this->detailbeli->SumBeratDetail($id),
            'totalberatmurni' => $this->detailbeli->SumBeratMurniDetail($id),
            'merek' => $this->datamerek->getMerek(),
            'kadar' => $this->datakadar->getKadar(),
            'bank' => $this->modelbank->getBank(),
            'supplier' => $this->datasupplier->getSupplier(),
            'databayar' => $this->modelpembayaran->getPembayaran($id),


        ];
        return view('barangmasuk/detail_pembelian_supplier', $data);
    }
    function ModalBarcode()
    {
        if ($this->request->isAJAX()) {
            $databarcode = $this->datastock->getBarcode($this->request->getVar('kel'));
            $databar = [
                'databarcode' => $databarcode,
            ];
            $data = [
                'modalbarcode' => view('barangmasuk/modalbarcode',  $databar),
            ];
            echo json_encode($data);
        }
    }
    function StockDataMasuk()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'no_nota_supp' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nomor Nota Harus di isi',
                    ]
                ],
                'total_berat_m' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Total Berat Murni Harus di isi',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'no_nota_supp' => $validation->getError('no_nota_supp'),
                        'total_berat_m' => $validation->getError('total_berat_m'),
                    ]
                ];
                echo json_encode($msg);
            } else {
                $session = session();
                $datadetailbeli = $this->detailbeli->getDetailAll($this->request->getVar('dateid'));
                if ($datadetailbeli) {
                    $totalbersih = $this->detailbeli->SumDataDetail($this->request->getVar('dateid'));
                    $totalharga = $totalbersih['total_harga'];
                    $datapembelian = $this->datapembelian->getPembelianSupplier($this->request->getVar('dateid'));
                    $datasupp = $this->datasupplier->getSupplier($this->request->getVar('supplier'));
                    //$datastock = $this->datastock->CheckData(1);
                    $this->datapembelian->save([
                        'id_pembelian' =>  $datapembelian['id_pembelian'],
                        'created_at' => $this->request->getVar('tanggal_input'),
                        'id_supplier' => $this->request->getVar('supplier'),
                        'id_karyawan' => $session->get('id_user'),
                        'no_faktur_supp' =>  $datasupp['inisial'] . '-' . $this->request->getVar('no_nota_supp'),
                        'no_transaksi' => $datapembelian['no_transaksi'],
                        'tgl_faktur' => $this->request->getVar('tanggal_nota_sup') . ' ' . date('H:i:s'),
                        'total_berat_murni' => $this->request->getVar('total_berat_m'),
                        'byr_berat_murni' => $this->request->getVar('total_berat_m'),
                        'tgl_jatuh_tempo' => $this->request->getVar('tanggal_tempo'),
                        'total_berat_rill' => round($this->detailbeli->SumBeratDetail($this->request->getVar('dateid'))['berat'], 2),
                        'berat_murni_rill' => round($this->detailbeli->SumBeratMurniDetail($this->request->getVar('dateid'))['berat_murni'], 2),
                        'total_qty' => $this->detailbeli->SumQty($this->request->getVar('dateid'))['qty'],
                        'total_bayar' =>  $totalharga,
                        'status_dokumen' => 'Selesai'
                    ]);
                    foreach ($datadetailbeli as $row) {
                        $kodesub = substr($row['kode'], 0, 1);
                        $datacheck = $this->datastock->getBarangBarcode($row['kode']);
                        if ($datacheck) {
                            // $datadetailkartu = $this->modeldetailkartustock->getKartuDetailStockKode($row['kode']);
                            $datakartu = $this->modelkartustock->getKartuStockkode($row['kode']);
                            $saldoakhir = ($kodesub == 4) ? $row['berat'] + $datakartu['saldo_akhir'] : $row['qty'] + $datakartu['saldo_akhir'];

                            $this->modeldetailkartustock->save([
                                // 'id_detail_kartustock' => $datadetailkartu['id_detail_kartustock'],
                                'barcode' => $row['kode'],
                                'status' => 'Masuk',
                                'id_karyawan' => $session->get('id_user'),
                                'no_faktur' => $datapembelian['no_transaksi'],
                                'tgl_faktur' => $datapembelian['tgl_faktur'],
                                'nama_customer' => $datapembelian['id_supplier'],
                                'saldo' => $saldoakhir,
                                'masuk' => ($kodesub == 4) ? $row['berat'] : $row['qty'],
                                'keluar' => 0,
                                'jenis' => $row['jenis'],
                                'model' => $row['model'],
                                'keterangan' => $row['keterangan'],
                                'merek' => $row['merek'],
                                'kadar' => $row['kadar'],
                                'berat' => $row['berat'],
                                'nilai_tukar' =>  $row['nilai_tukar'],
                                'harga_beli' => $row['harga_beli'],
                                'total_harga' => $row['total_harga'],
                                'gambar' =>  $row['nama_img'],
                            ]);
                            $this->KartuStockMaster($row['kode'], $session);
                            $datakartu = $this->modelkartustock->getKartuStockkode($row['kode']);

                            if ($kodesub == 4) {
                                $totalhargastock = $datakartu['saldo_akhir'] * $row['harga_beli'];
                            } else {
                                $totalhargastock = $datakartu['saldo_akhir'] * $row['harga_beli'] * $row['berat'];
                            }
                            if ($kodesub == 5) {
                                $saldoberat = $this->SaldoBerat5($row['kode']);
                            }
                            if ($kodesub == 4) {
                                $saldoberat = $datakartu['saldo_akhir'];
                            }
                            if ($kodesub == 1 || $kodesub == 2 || $kodesub == 3 || $kodesub == 6) {
                                $saldoberat = $row['berat'];
                            }
                            $this->datastock->save([
                                'id_stock' => $datacheck['id_stock'],
                                'id_karyawan' => $session->get('id_user'),
                                'status' => $this->StatusBarang($kodesub),
                                'no_faktur' => $datapembelian['no_faktur_supp'],
                                'tgl_faktur' => $datapembelian['tgl_faktur'],
                                'nama_supplier' => $this->datasupplier->getSupplier($datapembelian['id_supplier'])['nama_supp'],
                                'qty' => ($kodesub == 4) ? 1 : $datakartu['saldo_akhir'],
                                'jenis' => $row['jenis'],
                                'model' => $row['model'],
                                'keterangan' => $row['keterangan'],
                                'merek' => $row['merek'],
                                'kadar' => $row['kadar'],
                                'berat_murni' => $saldoberat,
                                'berat' => $saldoberat,
                                'nilai_tukar' =>  $row['nilai_tukar'],
                                'ongkos' => $row['ongkos'],
                                'harga_beli' => $row['harga_beli'],
                                'total_harga' => $totalhargastock,
                                'gambar' =>  $row['nama_img'],
                            ]);
                        } else {
                            $this->datastock->save([
                                'barcode' => $row['kode'],
                                'id_karyawan' => $session->get('id_user'),
                                'status' => $this->StatusBarang($kodesub),
                                'no_faktur' => $datapembelian['no_faktur_supp'],
                                'tgl_faktur' => $datapembelian['tgl_faktur'],
                                'nama_supplier' => $this->datasupplier->getSupplier($datapembelian['id_supplier'])['nama_supp'],
                                'qty' => $row['qty'],
                                'jenis' => $row['jenis'],
                                'model' => $row['model'],
                                'keterangan' => $row['keterangan'],
                                'merek' => $row['merek'],
                                'kadar' => $row['kadar'],
                                'berat_murni' => $row['berat_murni'],
                                'berat' => $row['berat'],
                                'nilai_tukar' =>  $row['nilai_tukar'],
                                'ongkos' => $row['ongkos'],
                                'harga_beli' => $row['harga_beli'],
                                'total_harga' => $row['total_harga'],
                                'kode_beli' =>  'JN',
                                'gambar' =>  $row['nama_img'],
                            ]);
                            $this->modeldetailkartustock->save([
                                'barcode' => $row['kode'],
                                'id_karyawan' => $session->get('id_user'),
                                'status' => 'Masuk',
                                'no_faktur' => $datapembelian['no_transaksi'],
                                'tgl_faktur' => $datapembelian['tgl_faktur'],
                                'nama_customer' => $datapembelian['id_supplier'],
                                'saldo' => ($kodesub == 4) ? $row['berat'] : $row['qty'],
                                'masuk' => ($kodesub == 4) ? $row['berat'] : $row['qty'],
                                'keluar' => 0,
                                'jenis' => $row['jenis'],
                                'model' => $row['model'],
                                'keterangan' => $row['keterangan'],
                                'merek' => $row['merek'],
                                'kadar' => $row['kadar'],
                                'berat' => $row['berat'],
                                'nilai_tukar' =>  $row['nilai_tukar'],
                                'harga_beli' => $row['harga_beli'],
                                'total_harga' => $row['total_harga'],
                                'gambar' =>  $row['nama_img'],
                            ]);
                            $this->KartuStockMaster($row['kode'], $session);
                        }
                    }
                    $msg = [
                        'pesan' => 'berhasil'
                    ];
                } else {
                    $msg = [
                        'pesan' => 'error'
                    ];
                }
                echo json_encode($msg);
            }
        }
    }

    public function DetailBarcode()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'datadetail' => $this->datastock->getBarangkode($this->request->getVar('kode'))
            ];
            echo json_encode($data);
        }
    }
    public function StatusBarang($id)
    {
        if ($id == 1) {
            return 'B';
        }
        if ($id == 2) {
            return 'D';
        }
        if ($id == 3 || $id == 4) {
            return '24K';
        }
        if ($id == 5 || 6) {
            return 'A';
        }
    }

    public function BarcodeGenerate($id)
    {
        $data1 = [
            'databarcode' => $this->detailbeli->getDetailAll($id),
            'datapembelian' => $this->datapembelian->getPembelianSupplier($id),
            // 'img' => $this->barangmodel->getImg($id)
        ];

        return view('barangmasuk/print_barcode', $data1);
    }

    public function BatalPembelian()
    {
        $session = session();
        if ($this->request->isAJAX()) {
            $data = $this->detailbeli->getDetailAll($this->request->getVar('dateid'));
            foreach ($data as $row) {
                if ($row['nama_img'] != 'default.jpg') {
                    $datareal = $this->datastock->getBarangBarcode($row['kode']);
                    if ($datareal) {
                        if ($datareal['gambar'] != $row['nama_img']) {
                            unlink('img/' . $row['nama_img']); //untuk hapus file
                        }
                    } else {
                        unlink('img/' . $row['nama_img']); //untuk hapus file
                    }
                }
            }
            $this->detailbeli->query('DELETE FROM tbl_detail_pembelian WHERE id_date_pembelian =' . $this->request->getVar('dateid') . ';');
            $this->datapembelian->query('DELETE FROM tbl_pembelian WHERE id_date_pembelian =' . $this->request->getVar('dateid') . ';');
            echo json_encode($this->request->getVar('dateid'));
        }
    }
    public function ReturBarang($id)
    {
        $session = session();
        $datapembelian = $this->datapembelian->getPembelianSupplier($this->request->getVar('dateid'));
        //$datastock = $this->datastock->CheckData(1);
        $data = $this->detailbeli->getDetailone($id);
        $this->datapembelian->save([
            'id_pembelian' =>  $datapembelian['id_pembelian'],
            'id_karyawan' => $session->get('id_user'),
            'total_berat_rill' => round($this->detailbeli->SumBeratDetail($this->request->getVar('dateid'))['berat'], 2),
            'berat_murni_rill' => round($this->detailbeli->SumBeratMurniDetail($this->request->getVar('dateid'))['berat_murni'], 2),
            'total_qty' => $this->detailbeli->SumQty($this->request->getVar('dateid'))['qty'],
            'total_bayar' =>  $this->detailbeli->SumDataDetail($this->request->getVar('dateid'))['total_harga'],
        ]);

        // if ($data['nama_img'] != 'default.jpg') {
        //     unlink('img/' . $data['nama_img']); //untuk hapus file
        // }
        $this->modelretur->save([
            'kode' => $data['kode'],
            'id_karyawan' => $session->get('id_user'),
            'id_date_pembelian' => $this->request->getVar('dateid'),
            'qty' => $data['qty'],
            'jenis' => $data['jenis'],
            'model' => $data['model'],
            'keterangan' => $data['keterangan'],
            'merek' => $data['merek'],
            'kadar' => $data['kadar'],
            'berat_murni' => $data['berat_murni'],
            'berat' => $data['berat'],
            'nilai_tukar' =>  $data['nilai_tukar'],
            'ongkos' => $data['ongkos'],
            'harga_beli' => $data['harga_beli'],
            'total_harga' => $data['total_harga'],
            'nama_img' =>  $data['nama_img'],
            'status_proses' => 'Pending',
        ]);
        $datakartu = $this->modelkartustock->getDetailKartuStock($data['kode']);
        $datadetailkartu = $this->modeldetailkartustock->getKartuStockkode($data['kode']);
        $this->modelkartustock->returdelete($datakartu['id_kartustock']);
        $this->modeldetailkartustock->returdelete($datadetailkartu['id_detail_kartustock']);
        $this->datastock->returdelete($data['kode']);
        $this->detailbeli->delete($id);

        return  redirect()->to('/detailpembelian/' . $this->request->getVar('dateid'));
    }

    public function CancelBarang($id)
    {
        $data = $this->detailbeli->getDetailAll($id);
        foreach ($data as $row) {
            $this->datastock->returdelete($row['kode']);
            if ($row['nama_img'] != 'default.jpg') {
                unlink('img/' . $row['nama_img']); //untuk hapus file
            }
        }
        $this->detailbeli->query('DELETE FROM tbl_detail_pembelian WHERE id_date_pembelian =' . $id . ';');
        $this->datapembelian->query('DELETE FROM tbl_pembelian WHERE id_date_pembelian =' . $id . ';');

        return  redirect()->to('/barangmasuk');
    }

    public function SelesaiPembayaran()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $datapembelian = $this->datapembelian->getPembelianSupplier($this->request->getVar('dateid'));
            $datadetailbeli = $this->detailbeli->getDetailAll($this->request->getVar('dateid'));
            if ($datapembelian['byr_berat_murni'] <= 0) {
                foreach ($datadetailbeli as $row) {
                    $qty = $row['qty'];
                    $harga = $datapembelian['harga_murni'];
                    $berat = $row['berat'];
                    $beratmurni = round($berat * ($row['nilai_tukar'] / 100), 2);
                    $kode = substr($row['kode'], 0, 1);
                    if ($kode == 1 || $kode == 4 || $kode == 5) {
                        $totalharga =  $beratmurni *  $harga;
                    }
                    if ($kode == 2) {
                        $totalharga = $harga;
                    }
                    if ($kode == 3) {
                        $totalharga =  $beratmurni *  $harga * $qty;
                    }
                    if ($kode == 6) {
                        $totalharga = $harga * $qty;
                    }

                    $this->detailbeli->save([
                        'id_detail_pembelian' => $row['id_detail_pembelian'],
                        'id_karyawan' => $session->get('id_user'),
                        'berat_murni' => $beratmurni,
                        'ongkos' => $row['ongkos'],
                        'harga_beli' => $harga,
                        'total_harga' => $totalharga + $row['ongkos'],
                    ]);
                }
                $this->datapembelian->save([
                    'id_pembelian' =>  $datapembelian['id_pembelian'],
                    'id_karyawan' => $session->get('id_user'),
                    'cara_pembayaran' => 'Lunas',
                    'total_bayar' => $this->detailbeli->SumDataDetail($this->request->getVar('dateid'))['total_harga'],
                ]);

                $msg = [
                    'pesan' => 'Pembayaran Berhasil'
                ];
            } else {
                $msg = [
                    'error' => 'Pembayaran Kurang'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function UbahHargaMurni()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $datapembelian = $this->datapembelian->getPembelianSupplier($this->request->getVar('dateid'));
            $databayar = $this->modelpembayaran->getPembayaran($this->request->getVar('dateid'));
            if ($databayar) {
                foreach ($databayar as $row) {
                    if ($row['cara_pembayaran'] == 'Tunai' || $row['cara_pembayaran'] == 'Transfer') {
                        $beratmurnitunai = round($row['jumlah_pembayaran'] / $this->request->getVar('val'), 2);
                        $this->modelpembayaran->save([
                            'id_pembayaran' => $row['id_pembayaran'],
                            'id_karyawan' => $session->get('id_user'),
                            'harga_murni' => $this->request->getVar('val'),
                            'berat_murni' => $beratmurnitunai,
                        ]);
                    }
                    if ($row['cara_pembayaran'] == 'Bahan24K' || $row['cara_pembayaran'] == 'ReturSales') {
                        $jumlahharga = $row['berat_murni'] * $this->request->getVar('val');
                        $this->modelpembayaran->save([
                            'id_pembayaran' => $row['id_pembayaran'],
                            'id_karyawan' => $session->get('id_user'),
                            'harga_murni' => $this->request->getVar('val'),
                            'jumlah_pembayaran' => $jumlahharga,
                        ]);
                    }
                }
                $totalbyar = $this->modelpembayaran->SumTotalBayar($this->request->getVar('dateid'))['berat_murni'];

                $this->datapembelian->save([
                    'id_pembelian' =>  $datapembelian['id_pembelian'],
                    'id_karyawan' => $session->get('id_user'),
                    'harga_murni' => $this->request->getVar('val'),
                    'byr_berat_murni' => abs($totalbyar - $datapembelian['total_berat_murni'])
                ]);
                $msg = 'berhasil';
            } else {
                $msg = 'kosong';
            }
            echo json_encode($msg);
        }
    }

    public function PilihKelompok()
    {
        $session = session();
        if ($this->request->isAJAX()) {
            $databeli = $this->datapembelian->getPembelianSupplier($this->request->getVar('iddate'));
            $this->datapembelian->save([
                'id_pembelian' => $databeli['id_pembelian'],
                'kelompok' => $this->request->getVar('kelompok'),
                'id_karyawan' => $session->get('id_user'),
            ]);
            $msg = 'sukses';

            echo json_encode($msg);
        }
    }
}
