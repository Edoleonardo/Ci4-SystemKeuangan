<?php

namespace App\Controllers;

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use App\Models\ModelBarangMasuk;
use App\Models\ModelDetailMasuk;
use App\Models\ModelKadar;
use App\Models\ModelMerek;
use App\Models\ModelSupplier;
use App\Models\ModelPembelian;
use App\Models\ModelStock1;
use App\Models\ModelStock2;
use App\Models\ModelStock3;
use App\Models\ModelStock4;
use App\Models\ModelStock5;
use App\Models\ModelStock6;
use App\Models\ModelPembayaranBeli;
use App\Models\ModelKartuStock;
use App\Models\ModelKartuStock5;
use App\Models\ModelKartuStock6;
use App\Models\ModelDetailKartuStock;
use App\Models\ModelDetailKartuStock5;
use App\Models\ModelDetailKartuStock6;
use App\Models\ModelBank;
use App\Models\ModelJenis;
use App\Models\ModelRetur;
use App\Models\ModelTransaksi;
use App\Models\ModelDetailTransaksi;
use App\Models\ModelPenjualan;
use App\Models\ModelDetailPenjualan;
use App\Models\ModelBuyback;

use CodeIgniter\CLI\Console;
use CodeIgniter\Validation\Rules;
use PhpParser\Node\Expr\Isset_;

class MasterUpdate extends BaseController
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
        $this->datastock1 = new ModelStock1();
        $this->datastock2 = new ModelStock2();
        $this->datastock3 = new ModelStock3();
        $this->datastock4 = new ModelStock4();
        $this->datastock5 = new ModelStock5();
        $this->datastock6 = new ModelStock6();
        $this->barcodeG =  new BarcodeGenerator();
        $this->modelpembayaran =  new ModelPembayaranBeli();
        $this->modelkartustock = new ModelKartuStock();
        $this->modelkartustock5 = new ModelKartuStock5();
        $this->modelkartustock6 = new ModelKartuStock6();
        $this->modeldetailkartustock = new ModelDetailKartuStock();
        $this->modeldetailkartustock5 = new ModelDetailKartuStock5();
        $this->modeldetailkartustock6 = new ModelDetailKartuStock6();
        $this->modelbank = new ModelBank();
        $this->modelretur = new ModelRetur();
        $this->modeltransaksi = new ModelTransaksi();
        $this->modeldetailtransaksi = new ModelDetailTransaksi();
        $this->penjualan = new ModelPenjualan();
        $this->modeldetailpenjualan = new ModelDetailPenjualan();
        $this->modelbuyback = new ModelBuyback();
    }

    public function UpdatePembelian()
    {
        return  view('masterupdate/pembelian');
    }

    //------------------------------------UpdatePembelian-----------------------------------------
    public function TampilPembelian()
    {
        if ($this->request->isAJAX()) {
            $data = $this->datapembelian->DataFilterPembelian($this->request->getVar('tmpildata'), $this->request->getVar('kelompok'), $this->request->getVar('status'),  $this->request->getVar('notrans'));
            $view = ['datapembelian' => $data];
            $msg = ['tampildata' => view('masterupdate/tampilpembelian_u', $view)];

            echo json_encode($msg);
        }
    }
    public function DetailPembelianSupp($id)
    {

        $data = [
            'datapembelian' => $this->datapembelian->getPembelianSupplierJoin($id),
            'tampildata' =>  $this->detailbeli->getDetailAll($id),
            'tampil24k' =>  $this->datastock4->getKodeBahan24k(),
            'tampilretur' =>  $this->modelretur->getDataReturBayar(),
            'databarang' => $this->detailbeli->getDetailAll($id),
            'totalberat' => $this->detailbeli->GetDataTotalBerat($id),
            'totalberatmurni' => $this->detailbeli->SumBeratMurniDetail($id),
            'merek' => $this->datamerek->getMerek(),
            'kadar' => $this->datakadar->getKadar(),
            'bank' => $this->modelbank->getBank(),
            'jenis' => $this->datajenis->getJenis(),
            'supplier' => $this->datasupplier->getSupplier(),
            'databayar' => $this->modelpembayaran->getPembayaran($id),


        ];
        return view('masterupdate/detail_pembelian_update', $data);
    }
    public function DataUpdateDetailPembelian()
    {
        if ($this->request->isAJAX()) {
            $kel = $this->request->getVar('kel');
            $iddetail = $this->request->getVar('id');
            $jenis_u = $this->request->getVar('jenis');
            if ($kel == 1 && $jenis_u == 'pembelian') {
                $data = [
                    'barang' =>  $this->detailbeli->getDetailone($iddetail),
                    'merek' => $this->datamerek->getMerek(),
                    'kadar' => $this->datakadar->getKadar(),
                    'jenis' => $this->datajenis->getJenis(),
                    'kel' => $kel,
                    'jenis_u' => $jenis_u
                ];
                $msg = [
                    'tampilupdate' => view('masterupdate/modalupdatedatapembelian', $data)
                ];
            }
            echo json_encode($msg);
        }
    }
    public function EditPembelian()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $kel = $this->request->getVar('kel1');
            $iddetail = $this->request->getVar('iddetail1');
            $jenis_u = $this->request->getVar('jenis_u');

            if ($kel == 1 && $jenis_u == 'pembelian') {
                $filesampul = $this->request->getFile('gambar1');
                if ($this->request->getPost('gambar1')) {
                    $image = $this->request->getPost('gambar1');
                    $image = str_replace('data:image/jpeg;base64,', '', $image);
                    $image = base64_decode($image, true);
                    $micro_date = microtime();
                    $date_array = explode(" ", $micro_date);
                    $date = date("ymdis", $date_array[1]);
                    $namafile = $date . $date_array[0] . '.jpg';
                    file_put_contents(FCPATH . '/img/' . $namafile, $image);
                    unlink('img/' . $this->request->getVar('nm_img'));
                } else if ($filesampul->getError() != 4) {
                    // $namafile = $filesampul->getRandomName(); // pake nama random
                    // $namafile = $filesampul->getName(); // ini pake nama asli di foto
                    $micro_date = microtime();
                    $date_array = explode(" ", $micro_date);
                    $date = date("ymdis", $date_array[1]);
                    $namafile = $date . $date_array[0] . '.jpg';
                    $filesampul->move('img', $namafile);
                    unlink('img/' . $this->request->getVar('nm_img'));
                } else {
                    $namafile = $this->request->getVar('nm_img');
                }

                $harga = $this->request->getVar('harga_beli1');
                $berat = $this->request->getVar('berat1');
                $beratmurni = round($berat * ($this->request->getVar('nilai_tukar1') / 100), 2);
                $totalharga =  $beratmurni *  $harga + $this->request->getVar('ongkos1');
                $this->detailbeli->save([
                    'id_detail_pembelian' => $iddetail,
                    'id_karyawan' => $session->get('id_user'),
                    'nama_img' => $namafile,
                    'qty' => $this->request->getVar('qty1'),
                    'jenis' => $this->request->getVar('jenis1'),
                    'model' => $this->request->getVar('model1'),
                    'keterangan' => $this->request->getVar('keterangan1'),
                    'berat' => $this->request->getVar('berat1'),
                    'ongkos' => $this->request->getVar('ongkos1'),
                    'berat_murni' => $beratmurni,
                    'harga_beli' => $this->request->getVar('harga_beli1'),
                    'kadar' =>  $this->request->getVar('kadar1'),
                    'nilai_tukar' =>  $this->request->getVar('nilai_tukar1'),
                    'merek' => $this->request->getVar('merek1'),
                    'total_harga' => $totalharga,
                ]);
                $msg = 'sukses';
            }
            echo json_encode($msg);
        }
    }
    public function UpdateData()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $value = $this->request->getVar('value');
            $jenis = $this->request->getVar('jenis');
            $dataupdate = $this->datapembelian->getPembelianSupplier($this->request->getVar('iddate'));
            $datadetailbeli = $this->detailbeli->getDetailAll($this->request->getVar('iddate'));

            if ($value || $value != 0) {
                if ($jenis == 'supplier') {
                    $this->datapembelian->save([
                        'id_pembelian' => $dataupdate['id_pembelian'],
                        'id_karyawan' => $session->get('id_user'),
                        'id_supplier' => $value
                    ]);
                    foreach ($datadetailbeli as $detail) {
                        $datamaster = $this->DataBarangBase($detail['kode']);
                        $namasup = $this->datasupplier->getSupplier($value);
                        $this->UpdateStock($dataupdate['kelompok'], $namasup['nama_supp'], $datamaster, 'nama_supplier');
                    }
                } else if ($jenis == 'tgl_input') {
                    $this->datapembelian->save([
                        'id_pembelian' => $dataupdate['id_pembelian'],
                        'id_karyawan' => $session->get('id_user'),
                        'created_at' => $value . ' ' . date("H:i:s")
                    ]);
                } else if ($jenis == 'tgl_nota') {
                    $this->datapembelian->save([
                        'id_pembelian' => $dataupdate['id_pembelian'],
                        'id_karyawan' => $session->get('id_user'),
                        'tgl_faktur' => $value . ' ' . date("H:i:s")
                    ]);
                    foreach ($datadetailbeli as $detail) {
                        $datamaster = $this->DataBarangBase($detail['kode']);
                        $this->UpdateStock($dataupdate['kelompok'], $value . ' ' . date("H:i:s"), $datamaster, 'tgl_faktur');
                    }
                } else if ($jenis == 'no_nota') {
                    $this->datapembelian->save([
                        'id_pembelian' => $dataupdate['id_pembelian'],
                        'id_karyawan' => $session->get('id_user'),
                        'no_faktur_supp' => $value
                    ]);
                    foreach ($datadetailbeli as $detail) {
                        $datamaster = $this->DataBarangBase($detail['kode']);
                        $this->UpdateStock($dataupdate['kelompok'], $value, $datamaster, 'no_faktur');
                    }
                } else if ($jenis == 'tgl_tempo') {
                    $this->datapembelian->save([
                        'id_pembelian' => $dataupdate['id_pembelian'],
                        'id_karyawan' => $session->get('id_user'),
                        'tgl_jatuh_tempo' => $value . ' ' . date("H:i:s")
                    ]);
                } else if ($jenis == 'total_murni') {
                    $this->datapembelian->save([
                        'id_pembelian' => $dataupdate['id_pembelian'],
                        'id_karyawan' => $session->get('id_user'),
                        'total_berat_murni' => $value
                    ]);
                }
                $msg = 'sukses';
            } else {
                $msg = ['errors' => 'Tidak Boleh Kosong'];
            }
            echo json_encode($msg);
        }
    }
    public function UpdateStock($kel, $val, $data, $jnis)
    {
        $session = session();
        if ($kel == '1') {
            $this->datastock1->save([
                'id_stock_1' => $data['id_stock_1'],
                'id_karyawan' => $session->get('id_user'),
                $jnis => $val
            ]);
        } elseif ($kel == '2') {
            $this->datastock2->save([
                'id_stock_2' => $data['id_stock_2'],
                'id_karyawan' => $session->get('id_user'),
                $jnis => $val
            ]);
        } elseif ($kel == '3') {
            $this->datastock3->save([
                'id_stock_3' => $data['id_stock_3'],
                'id_karyawan' => $session->get('id_user'),
                $jnis => $val
            ]);
        } elseif ($kel == '4') {
            $this->datastock4->save([
                'id_stock_4' => $data['id_stock_4'],
                'id_karyawan' => $session->get('id_user'),
                $jnis => $val
            ]);
        } elseif ($kel == '5') {
            $this->datastock5->save([
                'id_stock_5' => $data['id_stock_5'],
                'id_karyawan' => $session->get('id_user'),
                $jnis => $val
            ]);
        } elseif ($kel == '6') {
            $this->datastock6->save([
                'id_stock_6' => $data['id_stock_6'],
                'id_karyawan' => $session->get('id_user'),
                $jnis => $val
            ]);
        }
    }
    //------------------------------------------------Update Penjualan-----------------------------------------------------
    public function EditPembayaranForm()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $session = session();
            $valid = true;

            if ($this->request->getVar('transfer')) {
                $valid = $this->validate([
                    'transfer' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Transfer Harus di isi',
                        ]
                    ],
                    'banktransfer' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Bank Harus Dipilih',
                        ]
                    ]
                ]);
            }
            if ($this->request->getVar('debitcc')) {
                $valid = $this->validate([
                    'debitcc' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Transfer Harus di isi',
                        ]
                    ],
                    'bankdebitcc' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Bank Harus Dipilih',
                        ]
                    ]
                ]);
            }
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nohpcust' => $validation->getError('nohpcust'),
                        'transfer' => $validation->getError('transfer'),
                        'banktransfer' => $validation->getError('banktransfer'),
                        'bankdebitcc' => $validation->getError('bankdebitcc'),
                        'debitcc' => $validation->getError('debitcc'),
                    ]
                ];
            } else {
                $datapenjualan = $this->penjualan->getDataPenjualan($this->request->getVar('dateid'));
                $transfer = ($this->request->getVar('transfer')) ? $this->request->getVar('transfer') : 0;
                $debitcc = ($this->request->getVar('debitcc')) ? $this->request->getVar('debitcc') : 0;
                $tunai = ($this->request->getVar('tunai')) ? $this->request->getVar('tunai') : 0;
                $pembulatan = ($this->request->getVar('pembulatan')) ? $this->request->getVar('pembulatan') : 0;
                $byrcharge = ($this->request->getVar('byrcharge')) ? $this->request->getVar('byrcharge') : 0;
                $charge = ($this->request->getVar('charge')) ? $this->request->getVar('charge') : 0;
                if ($this->request->getVar('charge')) {
                    $hasilcharge = $debitcc * $charge;
                } else {
                    $hasilcharge = 0;
                }
                $hasil = ($datapenjualan['total_harga'] + $hasilcharge) - $transfer - $tunai - ($debitcc + $byrcharge) - $pembulatan;

                if ($hasil <= 0) {
                    $this->penjualan->save([
                        'id_penjualan' =>  $datapenjualan['id_penjualan'],
                        'id_karyawan' => $session->get('id_user'),
                        'bank_transfer' => ($this->request->getVar('transfer')) ? $this->request->getVar('banktransfer') : null,
                        'bank_debitcc' => ($this->request->getVar('debitcc')) ? $this->request->getVar('bankdebitcc') : null,
                        'pembayaran' => 'Lunas',
                        'tunai' =>  $tunai,
                        'debitcc' =>  $debitcc + $byrcharge,
                        'transfer' =>  $transfer,
                        'charge' =>   $charge,
                        'pembulatan' => $pembulatan,
                        'jumlah' => $this->modeldetailpenjualan->JumlahData($datapenjualan['id_date_penjualan'])['jumlah'],
                    ]);
                    $msg = [
                        'pesan' => [
                            'pesan' => 'berhasil'
                        ]
                    ];
                    $status = true;
                } else {
                    $msg = [
                        'error' => [
                            'kurang' => 'Pembayaran Kurang ' . number_format($hasil, 0, ',', '.')
                        ]
                    ];
                    // $msg = $hasil;
                }
                if (isset($status)) {
                    $saldobiaya = $this->modeltransaksi->getTransaksi();
                    $this->modeldetailtransaksi->DeleteTransaksi($datapenjualan['no_transaksi_jual']);
                    if ($this->request->getVar('tunai')) {
                        $this->modeldetailtransaksi->save([
                            //'tanggal_transaksi' => date("Y-m-d H:i:s"),
                            'tanggal_transaksi' => $datapenjualan['created_at'],
                            'id_karyawan' => $session->get('id_user'),
                            'pembayaran' => 'Tunai',
                            'keterangan' => $datapenjualan['no_transaksi_jual'],
                            'id_akun_biaya' => 26,
                            'masuk' => $this->request->getVar('tunai'),
                            'keluar' =>  0,
                            'nama_bank' => ($this->request->getVar('namabank')) ? $this->request->getVar('namabank') : null,
                        ]);
                    }
                    if ($this->request->getVar('transfer')) {
                        $this->modeldetailtransaksi->save([
                            //'tanggal_transaksi' => date("Y-m-d H:i:s"), //sementara
                            'tanggal_transaksi' => $datapenjualan['created_at'],
                            'id_karyawan' => $session->get('id_user'),
                            'pembayaran' => 'Transfer',
                            'keterangan' => $datapenjualan['no_transaksi_jual'],
                            'id_akun_biaya' => 26,
                            'masuk' => $this->request->getVar('transfer'),
                            'keluar' =>  0,
                            'nama_bank' => ($this->request->getVar('namabank')) ? $this->request->getVar('namabank') : null,
                        ]);
                    }
                    if ($this->request->getVar('debitcc')) {
                        $this->modeldetailtransaksi->save([
                            //'tanggal_transaksi' => date("Y-m-d H:i:s"), //sementara
                            'tanggal_transaksi' => $datapenjualan['created_at'],
                            'id_karyawan' => $session->get('id_user'),
                            'pembayaran' => 'Debitcc',
                            'keterangan' => $datapenjualan['no_transaksi_jual'],
                            'id_akun_biaya' => 26,
                            'masuk' => $this->request->getVar('debitcc') + $byrcharge,
                            'keluar' =>  0,
                            'nama_bank' => ($this->request->getVar('namabank')) ? $this->request->getVar('namabank') : null,
                        ]);
                    }

                    $this->BiayaHarianMaster($saldobiaya['id_transaksi'], $session);
                }
            }
            echo json_encode($msg);
        }
    }

    //---------------------------------------------------Transaksi Harian------------------------------------------------------------

    public function TampilEdit()
    {
        if ($this->request->isAJAX()) {
            $msg = $this->modeldetailtransaksi->getDetailTransaksi($this->request->getVar('id'));
            echo json_encode($msg);
        }
    }
    public function EditTransaksi()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'kategori1' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'kategori Harus di isi',
                    ]
                ],
                'keterangan1' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Keterangan Harus di isi',

                    ]
                ],
                'tangalinput1' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'tangal input Harus di isi',

                    ]
                ],
                'amount1' => [
                    'rules' => 'required|greater_than[0]',
                    'errors' => [
                        'required' => 'amount Harus di isi',
                        'greater_than' => 'harus lebih besar dari 0'

                    ]
                ],
                'nama_akun1' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Akun Harus di isi',

                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'kategori' => $validation->getError('kategori'),
                        'keterangan1' => $validation->getError('keterangan1'),
                        'tangalinput1' => $validation->getError('tangalinput1'),
                        'amount1' => $validation->getError('amount1'),
                        'nama_akun1' => $validation->getError('nama_akun1'),
                    ]
                ];
                echo json_encode($msg);
            } else {
                $session = session();
                $datatransaksi = $this->modeltransaksi->getTransaksi($this->request->getVar('id_transaksi1'));
                if ($this->request->getVar('kategori1') == 'keluar') { //--------------------------------Kategori Masuk
                    if ($datatransaksi['total_akhir_tunai'] >= $this->request->getVar('amount1') && $this->request->getVar('pembayaran1') == 'Tunai') {
                        $keluar = $this->request->getVar('amount');
                        $masuk = 0;
                        $sukses = true;
                    }
                    // if ($datatransaksi['total_akhir_transfer'] >= $this->request->getVar('amount1') && $this->request->getVar('pembayaran1') == 'Transfer') {
                    //     $keluar = $this->request->getVar('amount1');
                    //     $masuk = 0;
                    //     $sukses = true;
                    // }
                    elseif ($this->request->getVar('pembayaran1') == 'Transfer') {
                        $keluar = $this->request->getVar('amount1');
                        $masuk = 0;
                        $sukses = true;
                    } elseif ($datatransaksi['total_akhir_debitcc'] >= $this->request->getVar('amount1') && $this->request->getVar('pembayaran1') == 'Debitcc') {
                        $keluar = $this->request->getVar('amount1');
                        $masuk = 0;
                        $sukses = true;
                    } elseif (!isset($sukses)) {
                        $msg = [
                            'error' => [
                                'saldo' => 'Saldo Kurang',
                            ]
                        ];
                    }
                } else {
                    $keluar = 0;
                    $masuk = $this->request->getVar('amount1');
                    $sukses = true;
                }
                if (isset($sukses)) {
                    $datedetail = $this->modeldetailtransaksi->getDetailTransaksi($this->request->getVar('iddetailtrans'));
                    $this->modeldetailtransaksi->save([
                        'id_detail_transaksi' => $datedetail['id_detail_transaksi'],
                        'tanggal_transaksi' => $this->request->getVar('tangalinput1') . ' ' . date("H:i:s"),
                        'id_karyawan' => $session->get('id_user'),
                        'pembayaran' => $this->request->getVar('pembayaran1'),
                        'keterangan' => $this->request->getVar('keterangan1'),
                        'id_akun_biaya' => $this->request->getVar('nama_akun1'),
                        'keluar' => $keluar,
                        'masuk' => $masuk,
                        'nama_bank' => ($this->request->getVar('namabank1')) ? $this->request->getVar('namabank1') : null,
                    ]);

                    $this->BiayaHarianMaster($datatransaksi['id_transaksi'], $session);
                    $msg = 'berhasil';
                }
                echo json_encode($msg);
            }
        }
    }
    //-----------------------------------------------Transaksi Buyback--------------------------------------------------------
    public function EditBayarBuyback()
    {
        if ($this->request->isAJAX()) {
            $saldobiaya = $this->modeltransaksi->getTransaksi();
            $validation = \Config\Services::validation();
            $valid = true;
            if ($this->request->getVar('transferedit')) {
                $valid = $this->validate([
                    'transferedit' => [
                        'rules' => 'required|numeric',
                        'errors' => [
                            'required' => 'Transfer Harus di isi',
                            'numeric' => 'Harus Angka',
                        ]
                    ],
                    'namabankedit' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Nama Bank Harus di isi',
                        ]
                    ]

                ]);
            }
            if ($this->request->getVar('tunaiedit')) {
                $valid = $this->validate([
                    'tunaiedit' => [
                        'rules' => 'numeric',
                        'errors' => [
                            'numeric' => 'Harus Angka',
                        ]
                    ],
                ]);
            }

            if (!$valid) {
                $msg = [
                    'error' => [
                        'transferedit' => $validation->getError('transferedit'),
                        'namabankedit' => $validation->getError('namabankedit'),
                        'tunaiedit' => $validation->getError('tunaiedit'),
                    ]
                ];
                echo json_encode($msg);
            } else {
                $session = session();
                $tunai = ($this->request->getVar('tunaiedit')) ? $this->request->getVar('tunaiedit') : 0;
                $transfer = ($this->request->getVar('transferedit')) ? $this->request->getVar('transferedit') : 0;
                $pembulatan = ($this->request->getVar('pembulatanedit')) ? $this->request->getVar('pembulatanedit') : 0;
                $totalvar = $tunai + $transfer;
                $databuyback = $this->modelbuyback->getDataBuyback($this->request->getVar('iddate'));
                $hasilbayar = ($databuyback['total_harga'] - $totalvar) - $pembulatan;
                if ($saldobiaya['total_akhir_tunai'] >= $this->request->getVar('tunaiedit') && !$this->request->getVar('transferedit')) {
                    $sukses = true;
                } elseif ($this->request->getVar('transferedit') && !$this->request->getVar('tunaiedit')) {
                    $sukses = true;
                } elseif ($saldobiaya['total_akhir_tunai'] >= $this->request->getVar('tunaiedit') && $this->request->getVar('transferedit')) {
                    $sukses = true;
                } else {
                    $sukses = false;
                }
                if ($this->request->getVar('pembulatanedit') != $databuyback['total_harga']) {
                    if ($sukses) {
                        if ($hasilbayar <= 0 && $databuyback['total_harga'] != 0) {
                            $this->modeldetailtransaksi->DeleteTransaksi($databuyback['no_transaksi_buyback']);
                            $namabank = ($this->request->getVar('transferedit')) ? $this->request->getVar('namabankedit') : null;
                            $this->modelbuyback->save([
                                'id_buyback' => $databuyback['id_buyback'],
                                'id_karyawan' => $session->get('id_user'),
                                'nohp_cust' => $this->request->getVar('nohpcust'),
                                'tunai' => $this->request->getVar('tunaiedit'),
                                'transfer' => $this->request->getVar('transferedit'),
                                'nama_bank' => $namabank,
                                //'tgl_selesai' => date("Y-m-d H:i:s"),
                            ]);

                            if ($this->request->getVar('tunaiedit')) {
                                $this->modeldetailtransaksi->save([
                                    //'tanggal_transaksi' => date("Y-m-d H:i:s"),sementara
                                    'tanggal_transaksi' => ($databuyback['tgl_selesai']) ? $databuyback['tgl_selesai'] : date("Y-m-d H:i:s"),
                                    'id_karyawan' => $session->get('id_user'),
                                    'pembayaran' => 'Tunai',
                                    'keterangan' => $databuyback['no_transaksi_buyback'],
                                    'id_akun_biaya' => 8,
                                    'masuk' => 0,
                                    'keluar' =>  $this->request->getVar('tunaiedit'),
                                    'nama_bank' => ($this->request->getVar('namabankedit')) ? $this->request->getVar('namabankedit') : null,
                                ]);
                            }
                            if ($this->request->getVar('transferedit')) {
                                $this->modeldetailtransaksi->save([
                                    //'tanggal_transaksi' => date("Y-m-d H:i:s"),sementara
                                    'tanggal_transaksi' => ($databuyback['tgl_selesai']) ? $databuyback['tgl_selesai'] : date("Y-m-d H:i:s"),
                                    'id_karyawan' => $session->get('id_user'),
                                    'pembayaran' => 'Transfer',
                                    'keterangan' => $databuyback['no_transaksi_buyback'],
                                    'id_akun_biaya' => 8,
                                    'masuk' => 0,
                                    'keluar' => $this->request->getVar('transferedit'),
                                    'nama_bank' => ($this->request->getVar('namabankedit')) ? $this->request->getVar('namabankedit') : null,
                                ]);
                            }
                            $this->BiayaHarianMaster($saldobiaya['id_transaksi'], $session);
                            $msg = 'sukses';
                        } else {
                            $msg = [
                                'error' => [
                                    'bayar' => 'Bayar Kurang ' . $hasilbayar,
                                ]
                            ];
                        }
                    } else {
                        $msg = [
                            'error' => [
                                'bayar' => 'Saldo Biaya Kurang',
                            ]
                        ];
                    }
                } else {
                    $msg = [
                        'error' => [
                            'bayar' => 'Tidak Boleh Pembulatan Semua',
                        ]
                    ];
                }
                echo json_encode($msg);
            }
        }
    }
}
