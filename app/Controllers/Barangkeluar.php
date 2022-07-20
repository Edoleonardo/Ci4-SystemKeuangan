<?php

namespace App\Controllers;

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use App\Models\ModelPembelian;
use App\Models\ModelStock1;
use App\Models\ModelStock2;
use App\Models\ModelStock3;
use App\Models\ModelStock4;
use App\Models\ModelStock5;
use App\Models\ModelStock6;
use App\Models\ModelPenjualan;
use App\Models\ModelCustomer;
use App\Models\ModelDetailPenjualan;
use App\Models\ModelKartuStock;
use App\Models\ModelKartuStock5;
use App\Models\ModelKartuStock6;
use App\Models\ModelDetailKartuStock;
use App\Models\ModelDetailKartuStock5;
use App\Models\ModelDetailKartuStock6;
use App\Models\ModelBank;
use App\Models\ModelTransaksi;
use App\Models\ModelDetailTransaksi;
use App\Models\ModelDetailBuyback;
use CodeIgniter\I18n\Time;

use CodeIgniter\Model;
use CodeIgniter\Validation\Rules;
use Faker\Provider\ar_EG\Person;
use PhpParser\Node\Expr\Isset_;

class Barangkeluar extends BaseController
{
    public function __construct()
    {
        $this->modeldetailpenjualan =  new ModelDetailPenjualan();
        $this->barcodeG =  new BarcodeGenerator();
        $this->datapembelian = new ModelPembelian();
        $this->datastock1 = new ModelStock1();
        $this->datastock2 = new ModelStock2();
        $this->datastock3 = new ModelStock3();
        $this->datastock4 = new ModelStock4();
        $this->datastock5 = new ModelStock5();
        $this->datastock6 = new ModelStock6();
        $this->datacust = new ModelCustomer();
        $this->barcodeG =  new BarcodeGenerator();
        $this->penjualan =  new ModelPenjualan();
        $this->modelkartustock = new ModelKartuStock();
        $this->modelkartustock5 = new ModelKartuStock5();
        $this->modelkartustock6 = new ModelKartuStock6();
        $this->modeldetailkartustock = new ModelDetailKartuStock();
        $this->modeldetailkartustock5 = new ModelDetailKartuStock5();
        $this->modeldetailkartustock6 = new ModelDetailKartuStock6();
        $this->modelbank = new ModelBank();
        $this->modeldetailtransaksi = new ModelDetailTransaksi();
        $this->modeltransaksi = new ModelTransaksi();
        $this->modeldetailbuyback = new ModelDetailBuyback();
    }

    public function DataPenjualan()
    {
        $data = [
            'datapenjualan' => $this->penjualan->getDataPenjualan(),
            'datacust' => $this->datacust->getDataCustomer()
        ];

        return view('barangkeluar/data_penjualan', $data);
    }
    public function PenjualanBarang()
    {
        $session = session();
        $notrans = $this->NoTransaksiGenerateJual();
        $dateidjual = date('ymdhis') . substr($notrans, 6, 4);
        $this->penjualan->save([
            // 'created_at' => date("y-m-d"),
            'id_date_penjualan' => $dateidjual,
            'no_transaksi_jual' => $notrans,
            'id_customer' => '',
            'id_karyawan' => $session->get('id_user'),
            'kelompok' => 0,
            'nohp_cust' => '',
            'jumlah' => '0',
            'pembulatan' => '0',
            'total_harga' => '0',
            'pembayaran' => 'Bayar Nanti',
            'tunai' => '0',
            'debitcc' => '0',
            'transfer' => '0',
            'status_dokumen' => 'Draft'
        ]);
        //---------------------------------------------------
        return redirect()->to('/draftpenjualan/' . $dateidjual);
    }
    public function InsertCust()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            if (!$this->validate([
                'nohp' => [
                    'rules' => 'required|is_unique[tbl_customer.nohp_cust]',
                    'errors' => [
                        'required' => 'NpHp Harus di isi',
                        'is_unique' => 'NoHp Sudah Ada'
                    ]
                ],
                'nama_cust' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Harus di isi',
                    ]
                ],
            ])) {
                $msg = [
                    'error' => [
                        // 'inputcustomer' => $validation->getError('inputcustomer'),
                        'nohp_cust' => $validation->getError('nohp'),
                        'nama_cust' => $validation->getError('nama_cust'),
                    ]
                ];
            } else {
                $session = session();
                $this->datacust->save([
                    'nama' => $this->request->getVar('nama_cust'),
                    'id_karyawan' => $session->get('id_user'),
                    'nohp_cust' => $this->request->getVar('nohp'),
                    'alamat_cust' => $this->request->getVar('alamat'),
                    'kota_cust' => $this->request->getVar('kota'),
                    'sales_cust' => '-',
                    'no_rekening' => $this->request->getVar('no_rek1'),
                    'bank' => $this->request->getVar('banku1'),
                    'point' => '0',

                ]);
                $msg = [
                    'pesan' => 'Berahasil'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function TampilCustomer()
    {
        if ($this->request->isAJAX()) {
            $data = $this->datacust->getDataCustomer();

            $data1 = ['datacust' => $data];
            $msg = [
                'tampilcust' => view('barangkeluar/modalcustomer', $data1)
            ];
            echo json_encode($msg);
        }
    }

    public function CheckCustomer()
    {
        if ($this->request->isAJAX()) {
            $data = $this->datacust->getDataCustomerone($this->request->getVar('nohp_cust'));
            if ($data) {
                $msg = $data;
            } else {
                $msg = 'gagal';
            }
            echo json_encode($msg);
        }
    }
    public function InsertJual()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            if (!$this->validate([
                'kodebarang' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kode Harus di isi',
                    ]
                ]
            ])) {
                $msg = [
                    'error' => [
                        'kodebarang' => $validation->getError('kodebarang'),
                    ]
                ];
            } else {
                $session = session();
                $kode = $this->request->getVar('kodebarang');
                $kell = substr($kode, 0, 1);
                $databarang = $this->DataBarangBase($kode);
                $checkkelompok = $this->penjualan->getDataPenjualan($this->request->getVar('iddate'));
                if ($checkkelompok['kelompok'] == $kell || $checkkelompok['kelompok'] == 0) {
                    if ($databarang && $databarang['qty'] > 0) {
                        $checkdata = $this->modeldetailpenjualan->getDetailCheckJual($databarang['barcode'], $this->request->getVar('iddate'));
                        if (!$checkdata) {
                            $qty = $databarang['qty'];
                            $harga = $databarang['harga_beli'];
                            $berat = (isset($databarang['berat'])) ? $databarang['berat'] : 0;
                            $carat = (isset($databarang['carat'])) ? $databarang['carat'] : 0;
                            $nilaitukar = (isset($databarang['nilai_tukar'])) ? $databarang['nilai_tukar'] : 0;
                            $beratmurni = round($berat * ($nilaitukar / 100), 2);
                            if ($kell == 1) {
                                $totalharga =  $beratmurni *  $harga + $databarang['ongkos'];
                            } elseif ($kell == 2) {
                                $totalharga = $harga;
                            } elseif ($kell == 3) {
                                $totalharga =  $berat *  $harga * $qty;
                            } elseif ($kell == 4) {
                                $totalharga = $berat * $harga;
                            } elseif ($kell == 5) {
                                $totalharga = $carat * $harga;
                            } elseif ($kell == 6) {
                                $totalharga = $harga * $qty;
                            }
                            $this->modeldetailpenjualan->save([
                                'id_date_penjualan' => $this->request->getVar('iddate'),
                                'id_karyawan' => $session->get('id_user'),
                                'nama_img' => $databarang['gambar'],
                                'status' => $databarang['status'],
                                'kode' =>  $databarang['barcode'],
                                'qty' => $databarang['qty'],
                                'saldo' => $databarang['qty'],
                                'saldo_carat' => (isset($databarang['carat'])) ? $databarang['carat'] : 0,
                                'jenis' =>  $databarang['jenis'],
                                'model' =>  $databarang['model'],
                                'keterangan' =>  $databarang['keterangan'],
                                'berat' => (isset($databarang['berat'])) ? $databarang['berat'] : 0,
                                'carat' => (isset($databarang['carat'])) ? $databarang['carat'] : 0,
                                'berat_murni' => (isset($databarang['berat_murni'])) ? $databarang['berat_murni'] : 0,
                                'harga_beli' => $databarang['harga_beli'],
                                'ongkos' => (isset($databarang['ongkos'])) ? $databarang['ongkos'] : 0,
                                'kadar' => (isset($databarang['kadar'])) ? $databarang['kadar'] : '-',
                                'nilai_tukar' => (isset($databarang['nilai_tukar'])) ? $databarang['nilai_tukar'] : 0,
                                'merek' =>  $databarang['merek'],
                                'total_harga' => $totalharga,
                            ]);
                            if ($checkkelompok['kelompok'] == 0) {
                                $this->penjualan->save([
                                    'id_penjualan' => $checkkelompok['id_penjualan'],
                                    'id_karyawan' => $session->get('id_user'),
                                    'kelompok' => $kell
                                ]);
                            }
                            if ($kell == 1) {
                                $this->datastock1->save([
                                    'id_stock_1' => $databarang['id_stock_1'],
                                    'id_karyawan' => $session->get('id_user'),
                                    'qty' => '0'
                                ]);
                            } elseif ($kell == 2) {
                                $this->datastock2->save([
                                    'id_stock_2' => $databarang['id_stock_2'],
                                    'id_karyawan' => $session->get('id_user'),
                                    'qty' => '0'
                                ]);
                            } elseif ($kell == 3) {
                                $this->datastock3->save([
                                    'id_stock_3' => $databarang['id_stock_3'],
                                    'id_karyawan' => $session->get('id_user'),
                                    'qty' => '0'
                                ]);
                            } elseif ($kell == 4) {
                                $this->datastock4->save([
                                    'id_stock_4' => $databarang['id_stock_4'],
                                    'id_karyawan' => $session->get('id_user'),
                                    'qty' => '0',
                                    'berat' => '0'
                                ]);
                            } elseif ($kell == 5) {
                                $this->datastock5->save([
                                    'id_stock_5' => $databarang['id_stock_5'],
                                    'id_karyawan' => $session->get('id_user'),
                                    'qty' => '0',
                                    'carat' => '0'
                                ]);
                            } elseif ($kell == 6) {
                                $this->datastock6->save([
                                    'id_stock_6' => $databarang['id_stock_6'],
                                    'id_karyawan' => $session->get('id_user'),
                                    'qty' => '0'
                                ]);
                            }

                            $this->TotalHargaJual($this->request->getVar('iddate'), $session);


                            $msg = [
                                'pesan' => 'Berhasil',
                            ];
                        } else {
                            $msg = [
                                'error' => [
                                    'kodebarang' => 'Barang Sudah Masuk / Draft lain',
                                ]
                            ];
                        }
                    } else {
                        $msg = [
                            'error' => [
                                'kodebarang' => 'Stock Habis',
                            ]
                        ];
                    }
                } else {
                    $msg = [
                        'error' => [
                            'kodebarang' => 'Kelompok Barang Tidak Sama',
                        ]
                    ];
                }
            }
            echo json_encode($msg);
        } else {
            exit('Anda Hacker Sejati');
        }
    }

    public function UbahHarga()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $id = $this->request->getVar('id');
            $data = $this->modeldetailpenjualan->getDetailoneJual($id);
            if (substr($data['kode'], 0, 1) == 4) {
                $datakartu = $this->modelkartustock->getKartuStockkode($data['kode']);
                $check = $this->request->getVar('berat');
                $checksaldo = $this->request->getVar('berat');
                $saldocarat = $checksaldo;
            } elseif (substr($data['kode'], 0, 1) == 5) {
                $datakartu = $this->modelkartustock5->getKartuStockkode($data['kode']);
                $check = $this->request->getVar('qty');
                $checksaldo = $this->request->getVar('carat');
                $saldocarat = $datakartu['saldo_carat'];
            } elseif (substr($data['kode'], 0, 1) == 6) {
                $datakartu = $this->modelkartustock6->getKartuStockkode($data['kode']);
                $check = $this->request->getVar('qty');
                $checksaldo = 1;
                $saldocarat = $checksaldo;
            } else {
                $datakartu = $this->modelkartustock->getKartuStockkode($data['kode']);
                $check = $this->request->getVar('qty');
                $checksaldo = $this->request->getVar('berat');
                $saldocarat = $checksaldo;
            }
            if ($this->request->getVar('qty') > 0 && $this->request->getVar('hargabaru') > 0 && $checksaldo > 0) {
                if ($check <= $datakartu['saldo_akhir'] && $checksaldo <= $saldocarat) {
                    if (substr($data['kode'], 0, 1) == 1) {
                        $totalharga = $this->request->getVar('hargabaru') * $data['berat'] + $data['ongkos'];
                        $saldo = $this->request->getVar('qty');
                    } elseif (substr($data['kode'], 0, 1) == 2) {
                        $totalharga = $this->request->getVar('hargabaru');
                        $saldo = $this->request->getVar('qty');
                    } elseif (substr($data['kode'], 0, 1) == 3) {
                        $databarang = $this->datastock3->getBarangkode($data['kode']);
                        $selisihqty = $datakartu['saldo_akhir'] - $this->request->getVar('qty');
                        $totalharga = $this->request->getVar('hargabaru') * $data['berat'] * $this->request->getVar('qty');
                        $this->datastock3->save([
                            'id_stock_3' => $databarang['id_stock_3'],
                            'id_karyawan' => $session->get('id_user'),
                            'qty' => $selisihqty
                        ]);
                        $saldo = $this->request->getVar('qty');
                    } elseif (substr($data['kode'], 0, 1) == 4) {
                        $databarang = $this->datastock4->getBarangkode($data['kode']);
                        $selisihberat = $datakartu['saldo_akhir'] - $this->request->getVar('berat');
                        $totalharga = $this->request->getVar('hargabaru') * $this->request->getVar('berat');
                        if ($selisihberat == 0) {
                            $qty = 0;
                        } else {
                            $qty = 1;
                        }
                        $this->datastock4->save([
                            'id_stock_4' => $databarang['id_stock_4'],
                            'id_karyawan' => $session->get('id_user'),
                            'berat' => $selisihberat,
                            'qty' => $qty
                        ]);
                        $saldo = $this->request->getVar('berat');
                    } elseif (substr($data['kode'], 0, 1) == 5) {
                        $databarang = $this->datastock5->getBarangkode($data['kode']);
                        $totalharga = $this->request->getVar('hargabaru') * $this->request->getVar('carat');
                        if ($datakartu['saldo_carat'] == $this->request->getVar('carat')) {
                            $qty = 0;
                            $selisihcarat = 0;
                            $qtyreal = $datakartu['saldo_akhir'];
                        } else {
                            if ($datakartu['saldo_akhir'] == $this->request->getVar('qty')) {
                                $qtyreal = $datakartu['saldo_akhir'] - 1;
                                $qty = 1;
                            } else {
                                $qtyreal = $this->request->getVar('qty');
                                $qty = $datakartu['saldo_akhir'] - $this->request->getVar('qty');
                            }
                            $selisihcarat = $datakartu['saldo_carat'] - $this->request->getVar('carat');
                        }
                        $this->datastock5->save([
                            'id_stock_5' => $databarang['id_stock_5'],
                            'id_karyawan' => $session->get('id_user'),
                            'carat' => $selisihcarat,
                            'qty' => $qty
                        ]);
                        $saldo = $qtyreal;
                    } elseif (substr($data['kode'], 0, 1) == 6) {
                        $databarang = $this->datastock6->getBarangkode($data['kode']);
                        $selisihqty = $datakartu['saldo_akhir'] - $this->request->getVar('qty');
                        $totalharga = $this->request->getVar('hargabaru') * $this->request->getVar('qty');
                        $this->datastock6->save([
                            'id_stock_6' => $databarang['id_stock_6'],
                            'id_karyawan' => $session->get('id_user'),
                            'qty' => $selisihqty
                        ]);
                        $saldo = $this->request->getVar('qty');
                    }

                    $this->modeldetailpenjualan->save([
                        'id_detail_penjualan' =>  $data['id_detail_penjualan'],
                        'id_karyawan' => $session->get('id_user'),
                        'harga_beli' => $this->request->getVar('hargabaru'),
                        'berat' => ($this->request->getVar('berat')) ? $this->request->getVar('berat') : 0,
                        'carat' => ($this->request->getVar('carat')) ? $this->request->getVar('carat') : 0,
                        'qty' => (isset($qtyreal)) ? $qtyreal : $this->request->getVar('qty'),
                        'saldo_carat' => ($this->request->getVar('carat')) ? $this->request->getVar('carat') : 0,
                        'saldo' => $saldo,
                        'total_harga' => $totalharga
                    ]);
                    $this->TotalHargaJual($data['id_date_penjualan'], $session);

                    $msg = 'sukses';
                } else {
                    $msg = 'habis';
                }
            } else {
                $msg = 'kecil';
            }
            echo json_encode($msg);
        }
    }

    public function DeleteDetailjual()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $datapenjualan = $this->penjualan->getDataPenjualan($this->request->getVar('iddate'));
            //$datastock = $this->datastock->CheckData(1);
            $id = $this->request->getVar('id');
            $data = $this->modeldetailpenjualan->getDetailoneJual($id);
            $databarang = $this->DataBarangBase($data['kode']);
            if (substr($data['kode'], 0, 1) == 1) {
                $datakartu = $this->modelkartustock->getKartuStockkode($data['kode']);
                $this->datastock1->save([
                    'id_stock_1' => $databarang['id_stock_1'],
                    'id_karyawan' => $session->get('id_user'),
                    'qty' => $datakartu['saldo_akhir']
                ]);
            } elseif (substr($data['kode'], 0, 1) == 2) {
                $datakartu = $this->modelkartustock->getKartuStockkode($data['kode']);
                $this->datastock2->save([
                    'id_stock_2' => $databarang['id_stock_2'],
                    'id_karyawan' => $session->get('id_user'),
                    'qty' => $datakartu['saldo_akhir']
                ]);
            } elseif (substr($data['kode'], 0, 1) == 3) {
                $datakartu = $this->modelkartustock->getKartuStockkode($data['kode']);
                $this->datastock3->save([
                    'id_stock_3' => $databarang['id_stock_3'],
                    'id_karyawan' => $session->get('id_user'),
                    'qty' => $datakartu['saldo_akhir']
                ]);
            } elseif (substr($data['kode'], 0, 1) == 4) {
                $datakartu = $this->modelkartustock->getKartuStockkode($data['kode']);
                $this->datastock4->save([
                    'id_stock_4' => $databarang['id_stock_4'],
                    'id_karyawan' => $session->get('id_user'),
                    'berat' => $datakartu['saldo_akhir'],
                    'qty' => '1'
                ]);
            } elseif (substr($data['kode'], 0, 1) == 5) {
                $datakartu = $this->modelkartustock5->getKartuStockkode($data['kode']);
                $this->datastock5->save([
                    'id_stock_5' => $databarang['id_stock_5'],
                    'id_karyawan' => $session->get('id_user'),
                    'carat' => $datakartu['saldo_carat'],
                    'qty' => $datakartu['saldo_akhir']
                ]);
            } elseif (substr($data['kode'], 0, 1) == 6) {
                $datakartu = $this->modelkartustock6->getKartuStockkode($data['kode']);
                $this->datastock6->save([
                    'id_stock_6' => $databarang['id_stock_6'],
                    'id_karyawan' => $session->get('id_user'),
                    'qty' => $datakartu['saldo_akhir']
                ]);
            }
            $this->modeldetailpenjualan->delete($id);
            $jumlahdata = $this->modeldetailpenjualan->JumlahData($this->request->getVar('iddate'))['jumlah'];
            if ($jumlahdata == 0) { //jika 1 dihapus maka data habis
                $this->penjualan->save([
                    'id_penjualan' =>  $datapenjualan['id_penjualan'],
                    'id_karyawan' => $session->get('id_user'),
                    'kelompok' => 0,
                    'total_harga' =>  $this->modeldetailpenjualan->SumDataDetailJual($this->request->getVar('iddate'))['total_harga'],
                ]);
            } else {
                $this->penjualan->save([
                    'id_penjualan' =>  $datapenjualan['id_penjualan'],
                    'id_karyawan' => $session->get('id_user'),
                    'total_harga' =>  $this->modeldetailpenjualan->SumDataDetailJual($this->request->getVar('iddate'))['total_harga'],
                ]);
            }
            $msg = [
                'sukses' => 'Berhasil'
            ];
            echo json_encode($jumlahdata);
        }
    }

    public function DraftPenjualan($id)
    {
        $data = $this->penjualan->getDataPenjualan($id);
        if ($data['status_dokumen'] == 'Draft') {
            $datapenjualan = [
                'datapenjualan' => $data,
                'datacust' => $this->datacust->getDataCustomer(),
                'bank' => $this->modelbank->getBank(),
            ];
            return view('barangkeluar/jual_barang', $datapenjualan);
        } else {
            return redirect()->to('/detailpenjualan/' . $data['id_date_penjualan']);
        }
    }
    public function DetailDataPenjualan($id)
    {

        $data = $this->penjualan->getDataPenjualan($id);
        $databerat = $this->modeldetailpenjualan->getDetailAllJual($id);
        $totalberat = 0;
        $totalcarat = 0;
        $totalqty = 0;
        foreach ($databerat as $row) {
            if (substr($row['kode'], 0, 1) == 3) {
                $totalberat = $totalberat + ($row['qty'] * $row['berat']);
            } elseif (substr($row['kode'], 0, 1) == 5) {
                $totalcarat = $totalcarat + $row['carat'];
            } elseif (substr($row['kode'], 0, 1) == 6) {
                $totalqty = $totalqty + $row['qty'];
            } else {
                $totalberat = $totalberat + $row['berat'];
            }
        }
        // dd($totalcarat);
        $datapenjualan = [
            'datacust' => $this->datacust->getDataCustomer(),
            'bank' => $this->modelbank->getBank(),
            'datapenjualan' => $data,
            'totalcarat' => $totalcarat,
            'totalberat' => $totalberat,
            'totalqty' => $totalqty,
            'session' => session(),
            'hargabaru' =>  $this->modeldetailpenjualan->SumDataDetailJual($data['id_date_penjualan'])['total_harga'],
            'datacust' => $this->datacust->getDataCustomerone($data['nohp_cust']),
            'tampildata' => $this->modeldetailpenjualan->getDetailAllJual($id),
        ];
        if ($data['status_dokumen'] == 'Draft') {
            return redirect()->to('/draftpenjualan/' . $data['id_date_penjualan']);
        } else {
            return view('barangkeluar/detail_jual_barang', $datapenjualan);
        }
    }

    public function PrintInvoice($id)
    {
        $datajual = $this->penjualan->getDataPenjualan($id);
        $data = [
            'datacust' => $this->datacust->getDataCustomerone($datajual['nohp_cust']),
            'datajual' => $datajual,
            'datadetailjual' => $this->modeldetailpenjualan->getDetailAllJual($id),
        ];

        return view('barangkeluar/print_invoice', $data);
    }

    public function Pembayaran_jual()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $session = session();
            $valid = $this->validate([
                'nohpcust' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'NoHp Harus di isi',
                    ]
                ],
            ]);

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
                $datacust = $this->datacust->getDataCustomerone($this->request->getVar('nohpcust'));
                if ($datacust) {
                    if ($hasil <= 0) {
                        if ($datapenjualan['kelompok'] == 5) {
                            $tambahpoint = $this->modeldetailpenjualan->SumCarattDetailJual($this->request->getVar('dateid'))['carat'];
                        } else {
                            $tambahpoint = $this->modeldetailpenjualan->SumBeratKotorDetailjual($this->request->getVar('dateid'))['berat'];
                        }
                        $this->datacust->save([
                            'id_customer' => $datacust['id_customer'],
                            'point' => round($datacust['point'] + $tambahpoint),
                        ]);
                        $this->penjualan->save([
                            'id_penjualan' =>  $datapenjualan['id_penjualan'],
                            'id_karyawan' => $session->get('id_user'),
                            'nohp_cust' => $this->request->getVar('nohpcust'),
                            'bank_transfer' => ($this->request->getVar('transfer')) ? $this->request->getVar('banktransfer') : null,
                            'bank_debitcc' => ($this->request->getVar('debitcc')) ? $this->request->getVar('bankdebitcc') : null,
                            'pembayaran' => 'Lunas',
                            'tunai' =>  $tunai,
                            'debitcc' =>  $debitcc + $byrcharge,
                            'transfer' =>  $transfer,
                            'charge' =>   $charge,
                            'pembulatan' => $pembulatan,
                            'jumlah' => $this->modeldetailpenjualan->JumlahData($datapenjualan['id_date_penjualan'])['jumlah'],
                            'status_dokumen' => 'Selesai',
                            'created_at' => $this->request->getVar('tanggaltrans'), //sementara
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
                } else {
                    $msg = [
                        'error' => [
                            'kurang' => 'Data Customer Tidak ada'
                        ]
                    ];
                }
                if (isset($status)) {
                    $datadetailpenjualan = $this->modeldetailpenjualan->getDetailAllJual($datapenjualan['id_date_penjualan']);
                    foreach ($datadetailpenjualan as $row) {
                        if (substr($row['kode'], 0, 1) == 1 || substr($row['kode'], 0, 1) == 2 || substr($row['kode'], 0, 1) == 3 || substr($row['kode'], 0, 1) == 4) {
                            $datakartu = $this->modelkartustock->getKartuStockkode($row['kode']);
                            $saldoakhir = (substr($row['kode'], 0, 1) == 4) ? $datakartu['saldo_akhir'] - $row['berat'] : $datakartu['saldo_akhir'] - $row['qty'];
                            $this->modeldetailkartustock->save([
                                // 'id_detail_kartustock' => $datadetailkartu['id_detail_kartustock'],
                                'barcode' => $row['kode'],
                                'status' => 'Keluar',
                                'id_karyawan' => $session->get('id_user'),
                                'no_faktur' => $datapenjualan['no_transaksi_jual'],
                                'tgl_faktur' => $datapenjualan['created_at'],
                                'nama_customer' => $this->request->getVar('nohpcust'),
                                'saldo' => $saldoakhir,
                                'masuk' => 0,
                                'keluar' => (substr($row['kode'], 0, 1) == 4) ? $row['berat'] : $row['qty'],
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
                                'created_at' => $this->request->getVar('tanggaltrans'), //sementara
                                'updated_at' => $this->request->getVar('tanggaltrans') //sementara
                            ]);
                            $this->KartuStockMaster($row['kode'], $session);
                        } elseif (substr($row['kode'], 0, 1) == 5) {
                            $datakartu = $this->modelkartustock5->getKartuStockkode($row['kode']);
                            $saldoakhir =  $datakartu['saldo_akhir'] - $row['qty'];
                            $saldokarat = $datakartu['saldo_carat'] - $row['carat'];
                            $this->modeldetailkartustock5->save([
                                // 'id_detail_kartustock' => $datadetailkartu['id_detail_kartustock'],
                                'barcode' => $row['kode'],
                                'status' => 'Keluar',
                                'id_karyawan' => $session->get('id_user'),
                                'no_faktur' => $datapenjualan['no_transaksi_jual'],
                                'tgl_faktur' => $datapenjualan['created_at'],
                                'nama_customer' => $this->request->getVar('nohpcust'),
                                'saldo' => $saldoakhir,
                                'saldo_carat' => $saldokarat,
                                'masuk' => 0,
                                'keluar' => $row['qty'],
                                'jenis' => $row['jenis'],
                                'model' => $row['model'],
                                'keterangan' => $row['keterangan'],
                                'merek' => $row['merek'],
                                'kadar' => $row['kadar'],
                                'carat' => $row['carat'],
                                'nilai_tukar' =>  $row['nilai_tukar'],
                                'harga_beli' => $row['harga_beli'],
                                'total_harga' => $row['total_harga'],
                                'gambar' =>  $row['nama_img'],
                                'created_at' => $this->request->getVar('tanggaltrans'), //sementara
                                'updated_at' => $this->request->getVar('tanggaltrans') //sementara
                            ]);
                            $this->KartuStockMaster5($row['kode'], $session, 'noopname');
                        } elseif (substr($row['kode'], 0, 1) == 6) {
                            $datakartu = $this->modelkartustock6->getKartuStockkode($row['kode']);
                            $saldoakhir =  $datakartu['saldo_akhir'] - $row['qty'];
                            $this->modeldetailkartustock6->save([
                                // 'id_detail_kartustock' => $datadetailkartu['id_detail_kartustock'],
                                'barcode' => $row['kode'],
                                'status' => 'Keluar',
                                'id_karyawan' => $session->get('id_user'),
                                'no_faktur' => $datapenjualan['no_transaksi_jual'],
                                'tgl_faktur' => $datapenjualan['created_at'],
                                'nama_customer' => $this->request->getVar('nohpcust'),
                                'saldo' => $saldoakhir,
                                'masuk' => 0,
                                'keluar' => $row['qty'],
                                'jenis' => $row['jenis'],
                                'model' => $row['model'],
                                'keterangan' => $row['keterangan'],
                                'merek' => $row['merek'],
                                'harga_beli' => $row['harga_beli'],
                                'total_harga' => $row['total_harga'],
                                'gambar' =>  $row['nama_img'],
                                'created_at' => $this->request->getVar('tanggaltrans'), //sementara
                                'updated_at' => $this->request->getVar('tanggaltrans') //sementara
                            ]);
                            $this->KartuStockMaster6($row['kode'], $session);
                        }
                    }

                    $saldobiaya = $this->modeltransaksi->getTransaksi();
                    if ($this->request->getVar('tunai')) {
                        $this->modeldetailtransaksi->save([
                            //'tanggal_transaksi' => date("Y-m-d H:i:s"),
                            'tanggal_transaksi' => $this->request->getVar('tanggaltrans'),
                            'id_karyawan' => $session->get('id_user'),
                            'pembayaran' => 'Tunai',
                            'keterangan' => $datapenjualan['no_transaksi_jual'],
                            'id_akun_biaya' => 26,
                            'masuk' => $this->request->getVar('tunai'),
                            'keluar' =>  0,
                            'nama_bank' => ($this->request->getVar('namabank')) ? $this->request->getVar('namabank') : null,
                        ]);
                    }
                    // if ($this->request->getVar('pembulatan')) {
                    //     if ($this->request->getVar('tunai') > $this->request->getVar('transfer')) {
                    //         $byr = 'Tunai';
                    //     } else {
                    //         $byr = 'Transfer';
                    //     }
                    //     $this->modeldetailtransaksi->save([
                    //         //'tanggal_transaksi' => date("Y-m-d H:i:s"),
                    //         'tanggal_transaksi' => $this->request->getVar('tanggaltrans'),
                    //         'id_karyawan' => $session->get('id_user'),
                    //         'pembayaran' => $byr,
                    //         'keterangan' => $datapenjualan['no_transaksi_jual'],
                    //         'id_akun_biaya' => 26,
                    //         'masuk' => 0,
                    //         'keluar' =>  $this->request->getVar('pembulatan'),
                    //         'nama_bank' => ($this->request->getVar('namabank')) ? $this->request->getVar('namabank') : null,
                    //     ]);
                    // }
                    if ($this->request->getVar('transfer')) {
                        $this->modeldetailtransaksi->save([
                            //'tanggal_transaksi' => date("Y-m-d H:i:s"), //sementara
                            'tanggal_transaksi' => $this->request->getVar('tanggaltrans'),
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
                            'tanggal_transaksi' => $this->request->getVar('tanggaltrans'),
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

    // public function Pembayaran_Retur()
    // {
    //     $validation = \Config\Services::validation();
    //     if ($this->request->isAJAX()) {
    //         $session = session();
    //         if ($this->request->getVar('pembayaran') != 'Bayar Nanti') {
    //             if ($this->request->getVar('pembayaran') == 'Debit/CC') {
    //                 $valid = $this->validate([
    //                     'debitcc' => [
    //                         'rules' => 'required',
    //                         'errors' => [
    //                             'required' => 'Debit CC Harus di isi',
    //                         ]
    //                     ],
    //                     'namabank' => [
    //                         'rules' => 'required',
    //                         'errors' => [
    //                             'required' => 'Nama Bank Harus di isi',
    //                         ]
    //                     ]
    //                 ]);
    //             }
    //             if ($this->request->getVar('pembayaran') == 'Debit/CCTranfer') {
    //                 $valid = $this->validate([
    //                     'debitcc' => [
    //                         'rules' => 'required',
    //                         'errors' => [
    //                             'required' => 'Debit CC Harus di isi',
    //                         ]
    //                     ],
    //                     'namabank' => [
    //                         'rules' => 'required',
    //                         'errors' => [
    //                             'required' => 'Nama Bank Harus di isi',
    //                         ]
    //                     ],
    //                     'transfer' => [
    //                         'rules' => 'required',
    //                         'errors' => [
    //                             'required' => 'Transfer Harus di isi',
    //                         ]
    //                     ]
    //                 ]);
    //             }
    //             if ($this->request->getVar('pembayaran') == 'Transfer') {
    //                 $valid = $this->validate([
    //                     'transfer' => [
    //                         'rules' => 'required',
    //                         'errors' => [
    //                             'required' => 'Transfer Harus di isi',
    //                         ]
    //                     ],
    //                     'namabank' => [
    //                         'rules' => 'required',
    //                         'errors' => [
    //                             'required' => 'Nama Bank Harus di isi',
    //                         ]
    //                     ]
    //                 ]);
    //             }
    //             if ($this->request->getVar('pembayaran') == 'Tunai') {
    //                 $valid = $this->validate([
    //                     'tunai' => [
    //                         'rules' => 'required',
    //                         'errors' => [
    //                             'required' => 'Tunai Harus di isi',
    //                         ]
    //                     ]
    //                 ]);
    //             }
    //             if ($this->request->getVar('pembayaran') == 'Tunai&Debit/CC') {
    //                 $valid = $this->validate([
    //                     'tunai' => [
    //                         'rules' => 'required',
    //                         'errors' => [
    //                             'required' => 'Tunai Harus di isi',
    //                         ]
    //                     ],
    //                     'debitcc' => [
    //                         'rules' => 'required',
    //                         'errors' => [
    //                             'required' => 'Debit CC Harus di isi',
    //                         ]
    //                     ],
    //                     'namabank' => [
    //                         'rules' => 'required',
    //                         'errors' => [
    //                             'required' => 'Nama Bank Harus di isi',
    //                         ]
    //                     ]
    //                 ]);
    //             }
    //             if ($this->request->getVar('pembayaran') == 'Tunai&Transfer') {
    //                 $valid = $this->validate([
    //                     'tunai' => [
    //                         'rules' => 'required',
    //                         'errors' => [
    //                             'required' => 'Tunai Harus di isi',
    //                         ]
    //                     ],
    //                     'transfer' => [
    //                         'rules' => 'required',
    //                         'errors' => [
    //                             'required' => 'Transfer Harus di isi',
    //                         ]
    //                     ],
    //                     'namabank' => [
    //                         'rules' => 'required',
    //                         'errors' => [
    //                             'required' => 'Nama Bank Harus di isi',
    //                         ]
    //                     ]
    //                 ]);
    //             }
    //             if (!$valid) {
    //                 $msg = [
    //                     'error' => [
    //                         'inputcustomer' => $validation->getError('inputcustomer'),
    //                         'tunai' => $validation->getError('tunai'),
    //                         'transfer' => $validation->getError('transfer'),
    //                         'namabank' => $validation->getError('namabank'),
    //                         'debitcc' => $validation->getError('debitcc'),
    //                     ]
    //                 ];
    //             } else {
    //                 $datapenjualan2 = $this->penjualan->getDataPenjualan($this->request->getVar('dateid'));
    //                 $datapenjualan =  $this->request->getVar('hargabaru') - $datapenjualan2['total_harga'];
    //                 if ($this->request->getVar('pembayaran') == 'Tunai&Transfer') {
    //                     $blt = ($this->request->getVar('pembulatan') != null) ? $this->request->getVar('pembulatan') : 0;
    //                     $hasil = $datapenjualan - ($this->request->getVar('transfer') + $this->request->getVar('tunai') + $blt);
    //                 }
    //                 if ($this->request->getVar('pembayaran') == 'Tunai&Debit/CC') {
    //                     $cas = ($this->request->getVar('charge') != null) ? $this->request->getVar('charge') : 0;
    //                     $blt = ($this->request->getVar('pembulatan') != null) ? $this->request->getVar('pembulatan') : 0;
    //                     $totalbayar = $datapenjualan + ($cas * ($datapenjualan / 100));
    //                     $hasil = $totalbayar - ($this->request->getVar('debitcc') + $this->request->getVar('tunai') + $blt);
    //                 }
    //                 if ($this->request->getVar('pembayaran') == 'Tunai') {
    //                     $blt = ($this->request->getVar('pembulatan') != null) ? $this->request->getVar('pembulatan') : 0;
    //                     $hasil = $datapenjualan - ($this->request->getVar('tunai') + $blt);
    //                 }
    //                 if ($this->request->getVar('pembayaran') == 'Transfer') {
    //                     $blt = ($this->request->getVar('pembulatan') != null) ? $this->request->getVar('pembulatan') : 0;
    //                     $hasil = $datapenjualan - ($this->request->getVar('transfer') + $blt);
    //                 }
    //                 if ($this->request->getVar('pembayaran') == 'Debit/CCTranfer') {
    //                     $cas = ($this->request->getVar('charge') != null) ? $this->request->getVar('charge') : 0;
    //                     $blt = ($this->request->getVar('pembulatan') != null) ? $this->request->getVar('pembulatan') : 0;
    //                     $totalbayar = $datapenjualan + ($cas * ($datapenjualan / 100));
    //                     $hasil = $totalbayar - ($this->request->getVar('debitcc') + $this->request->getVar('transfer') + $blt);
    //                 }
    //                 if ($this->request->getVar('pembayaran') == 'Debit/CC') {
    //                     $cas = ($this->request->getVar('charge') != null) ? $this->request->getVar('charge') : 0;
    //                     $blt = ($this->request->getVar('pembulatan') != null) ? $this->request->getVar('pembulatan') : 0;
    //                     $totalbayar = $datapenjualan + ($cas * ($datapenjualan / 100));
    //                     $hasil = $totalbayar - ($this->request->getVar('debitcc') + $blt);
    //                 }
    //                 if ($hasil == 0) {
    //                     $tunai = ($this->request->getVar('tunai')) ? $this->request->getVar('tunai') : 0;
    //                     $transfer = ($this->request->getVar('transfer')) ? $this->request->getVar('transfer') : 0;
    //                     $debitcc = ($this->request->getVar('debitcc')) ? $this->request->getVar('debitcc') : 0;
    //                     $pembulatan = ($this->request->getVar('pembulatan')) ? $this->request->getVar('pembulatan') : 0;
    //                     // $datacust = $this->datacust->getDataCustomerone($this->request->getVar('inputcustomer'));
    //                     // $this->datacust->save([
    //                     //     'id_customer' => $datacust['id_customer'],
    //                     //     'point' => round($datacust['point'] + $this->modeldetailpenjualan->SumBeratKotorDetailjual($this->request->getVar('dateid'))['berat']),
    //                     // ]);

    //                     $this->penjualan->save([
    //                         'id_penjualan' =>  $datapenjualan2['id_penjualan'],
    //                         'id_karyawan' => $session->get('id_user'),
    //                         'pembayaran_retur' => $this->request->getVar('pembayaran'),
    //                         'nama_bank' => $this->request->getVar('namabank'),
    //                         'tunai' => $datapenjualan2['tunai'] + $tunai,
    //                         'debitcc' => $datapenjualan2['debitcc'] + $debitcc,
    //                         'transfer' => $datapenjualan2['transfer'] + $transfer,
    //                         'charge' =>   $this->request->getVar('charge'),
    //                         'pembulatan' => $datapenjualan2['pembulatan'] + $pembulatan,
    //                         'total_harga' => $this->request->getVar('hargabaru'),
    //                         'status_dokumen' => 'Selesai',
    //                     ]);
    //                     $msg = [
    //                         'pesan' => [
    //                             'pesan' => 'berhasil'
    //                         ]
    //                     ];
    //                     $status = true;
    //                 } else {
    //                     $msg = [
    //                         'error' => [
    //                             'kurang' => 'Bayar Kurang / lebih'
    //                         ]
    //                     ];
    //                 }
    //             }
    //             if (isset($status) && $hasil == 0 && $datapenjualan2['status_dokumen'] != 'Selesai') {
    //                 $saldobiaya = $this->modeltransaksi->getTransaksi();
    //                 if ($this->request->getVar('tunai')) {
    //                     $this->modeldetailtransaksi->save([
    //                         'tanggal_transaksi' => date("Y-m-d H:i:s"),
    //                         'id_karyawan' => $session->get('id_user'),
    //                         'pembayaran' => 'Tunai',
    //                         'keterangan' => $datapenjualan2['no_transaksi_jual'],
    //                         'id_akun_biaya' => 38,
    //                         'masuk' => $this->request->getVar('tunai'),
    //                         'keluar' =>  0,
    //                         'nama_bank' => ($this->request->getVar('namabank')) ? $this->request->getVar('namabank') : null,
    //                     ]);
    //                 }
    //                 if ($this->request->getVar('transfer')) {
    //                     $this->modeldetailtransaksi->save([
    //                         'tanggal_transaksi' => date("Y-m-d H:i:s"),
    //                         'id_karyawan' => $session->get('id_user'),
    //                         'pembayaran' => 'Transfer',
    //                         'keterangan' => $datapenjualan2['no_transaksi_jual'],
    //                         'id_akun_biaya' => 38,
    //                         'masuk' => $this->request->getVar('transfer'),
    //                         'keluar' =>  0,
    //                         'nama_bank' => ($this->request->getVar('namabank')) ? $this->request->getVar('namabank') : null,
    //                     ]);
    //                 }
    //                 if ($this->request->getVar('debitcc')) {
    //                     $this->modeldetailtransaksi->save([
    //                         'tanggal_transaksi' => date("Y-m-d H:i:s"),
    //                         'id_karyawan' => $session->get('id_user'),
    //                         'pembayaran' => 'Debitcc',
    //                         'keterangan' => $datapenjualan2['no_transaksi_jual'],
    //                         'id_akun_biaya' => 38,
    //                         'masuk' => $this->request->getVar('debitcc'),
    //                         'keluar' =>  0,
    //                         'nama_bank' => ($this->request->getVar('namabank')) ? $this->request->getVar('namabank') : null,
    //                     ]);
    //                 }
    //                 $this->BiayaHarianMaster($saldobiaya['id_transaksi'], $session);
    //             }
    //         } else {
    //             $msg = 'error';
    //         }
    //         echo json_encode($msg);
    //     }
    // }
    public function penjualan_read()
    {
        $session = session();
        if ($this->request->isAJAX()) {
            $databerat = $this->modeldetailpenjualan->getDetailAllJual($this->request->getVar('dateid'));
            $datapenjualan = $this->penjualan->getDataPenjualan($this->request->getVar('dateid'));
            $totalberat = 0;
            $totalcarat = 0;
            $totalqty = 0;
            foreach ($databerat as $row) {
                if (substr($row['kode'], 0, 1) == 3) {
                    $totalberat = $totalberat + ($row['qty'] * $row['berat']);
                } elseif (substr($row['kode'], 0, 1) == 5) {
                    $totalcarat = $totalcarat + $row['carat'];
                } elseif (substr($row['kode'], 0, 1) == 6) {
                    $totalqty = $totalqty + $row['qty'];
                } else {
                    $totalberat = $totalberat + $row['berat'];
                }
            }
            if ($datapenjualan['kelompok'] == 1) {
                $data = [
                    'tampildata' => $this->modeldetailpenjualan->getDetailAlljual($this->request->getVar('dateid')),
                    'totalberat' => $totalberat,
                    'totalharga' =>  $this->modeldetailpenjualan->SumDataDetailJual($this->request->getVar('dateid'))
                ];
                $view = view('barangkeluar/detailtablejual', $data);
            } elseif ($datapenjualan['kelompok'] == 2) {
                $data = [
                    'tampildata' => $this->modeldetailpenjualan->getDetailAlljual($this->request->getVar('dateid')),
                    'totalberat' => $totalberat,
                    'totalharga' =>  $this->modeldetailpenjualan->SumDataDetailJual($this->request->getVar('dateid'))
                ];
                $view = view('barangkeluar/detailtablejual2', $data);
            } elseif ($datapenjualan['kelompok'] == 3) {
                $data = [
                    'tampildata' => $this->modeldetailpenjualan->getDetailAlljual($this->request->getVar('dateid')),
                    'totalberat' => $totalberat,
                    'totalharga' =>  $this->modeldetailpenjualan->SumDataDetailJual($this->request->getVar('dateid'))
                ];
                $view = view('barangkeluar/detailtablejual3', $data);
            } elseif ($datapenjualan['kelompok'] == 4) {
                $data = [
                    'tampildata' => $this->modeldetailpenjualan->getDetailAlljual($this->request->getVar('dateid')),
                    'totalberat' => $totalberat,
                    'totalharga' =>  $this->modeldetailpenjualan->SumDataDetailJual($this->request->getVar('dateid'))
                ];
                $view = view('barangkeluar/detailtablejual4', $data);
            } elseif ($datapenjualan['kelompok'] == 5) {
                $data = [
                    'tampildata' => $this->modeldetailpenjualan->getDetailAlljual($this->request->getVar('dateid')),
                    'totalcarat' => $totalcarat,
                    'totalharga' =>  $this->modeldetailpenjualan->SumDataDetailJual($this->request->getVar('dateid'))
                ];
                $view = view('barangkeluar/detailtablejual5', $data);
            } elseif ($datapenjualan['kelompok'] == 6) {
                $data = [
                    'tampildata' => $this->modeldetailpenjualan->getDetailAlljual($this->request->getVar('dateid')),
                    'totalqty' => $totalqty,
                    'totalharga' =>  $this->modeldetailpenjualan->SumDataDetailJual($this->request->getVar('dateid'))
                ];
                $view = view('barangkeluar/detailtablejual6', $data);
            } else {
                $view = null;
            }
            $msg = [
                'data' =>  $view,
                'totalbersih' => $this->modeldetailpenjualan->SumDataDetailJual($this->request->getVar('dateid')),
                'totalberatkotor' => $totalberat,
                'totalberatbersih' => $this->modeldetailpenjualan->SumBeratBersihDetailjual($this->request->getVar('dateid')),
                'kelompok' => $datapenjualan['kelompok']
            ];
            echo json_encode($msg);
        }
    }
    public function DeleteDetailjualRetur()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $id = $this->request->getVar('id');
            if ($id != $this->request->getVar('idrill')) {
                $this->modeldetailpenjualan->delete($id);
                $msg = [
                    'sukses' => 'Berhasil'
                ];
            } else {
                $msg = [
                    'error' => 'Gagal'
                ];
            }

            echo json_encode($msg);
        }
    }

    public function GantiBarangRetur()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $idretur = $this->request->getVar('iddate1') . $this->request->getVar('iddetail1');
            $datapenjualan = $this->penjualan->getDataPenjualan($this->request->getVar('iddate1'));
            $dataretur = $this->modeldetailpenjualan->getDetailRetur($idretur);
            $datadetailpenjualan = $this->modeldetailpenjualan->getDetailoneJual($this->request->getVar('iddetail1'));
            if ($datadetailpenjualan['kode'] != $dataretur['kode']) {
                if ($dataretur['total_harga'] >= $datadetailpenjualan['total_harga']) {
                    $databarang = $this->datastock->getBarangkode($dataretur['kode']);
                    $datakartu = $this->modelkartustock->getKartuStockkode($dataretur['kode']);
                    if (substr($dataretur['kode'], 0, 1) == 4) {
                        $check = $dataretur['berat'];
                    } else {
                        $check = $dataretur['qty'];
                    }
                    if ($check <= $datakartu['saldo_akhir']) {
                        $saldoakhir = (substr($dataretur['kode'], 0, 1) == 4) ? $datakartu['saldo_akhir'] - $dataretur['berat'] : $datakartu['saldo_akhir'] - $dataretur['qty'];
                        if (substr($dataretur['kode'], 0, 1) == 4) {
                            $selisihberat = $datakartu['saldo_akhir'] - $dataretur['berat'];
                            if ($selisihberat == 0) {
                                $qty = 0;
                            } else {
                                $qty = 1;
                            }
                            $this->datastock->save([
                                'id_stock_1' => $databarang['id_stock_1'],
                                'id_karyawan' => $session->get('id_user'),
                                'berat' => $selisihberat,
                                'qty' => $qty
                            ]);
                            $this->modeldetailkartustock->save([
                                'barcode' => $dataretur['kode'],
                                'status' => 'Keluar',
                                'id_karyawan' => $session->get('id_user'),
                                'no_faktur' => $datapenjualan['no_transaksi_jual'],
                                'tgl_faktur' => $datapenjualan['created_at'],
                                'nama_customer' => $datapenjualan['nohp_cust'],
                                'saldo' => $saldoakhir,
                                'masuk' => 0,
                                'keluar' => (substr($dataretur['kode'], 0, 1) == 4) ? $dataretur['berat'] : $dataretur['qty'],
                                'jenis' => $dataretur['jenis'],
                                'model' => $dataretur['model'],
                                'keterangan' => 'Retur Customer',
                                'merek' => $dataretur['merek'],
                                'kadar' => $dataretur['kadar'],
                                'berat' => $dataretur['berat'],
                                'nilai_tukar' =>  $dataretur['nilai_tukar'],
                                'harga_beli' => $dataretur['harga_beli'],
                                'total_harga' => $dataretur['total_harga'],
                                'gambar' =>  $dataretur['nama_img'],
                            ]);
                            $this->KartuStockMaster($dataretur['kode'], $session);
                        } else {
                            $selisihqty = $datakartu['saldo_akhir'] - $dataretur['qty'];
                            $this->datastock->save([
                                'id_stock_1' => $databarang['id_stock_1'],
                                'id_karyawan' => $session->get('id_user'),
                                'qty' => $selisihqty
                            ]);
                            $this->modeldetailkartustock->save([
                                'barcode' => $dataretur['kode'],
                                'status' => 'Keluar',
                                'id_karyawan' => $session->get('id_user'),
                                'no_faktur' => $datapenjualan['no_transaksi_jual'],
                                'tgl_faktur' => $datapenjualan['created_at'],
                                'nama_customer' => $datapenjualan['nohp_cust'],
                                'saldo' => $saldoakhir,
                                'masuk' => 0,
                                'keluar' => (substr($dataretur['kode'], 0, 1) == 4) ? $dataretur['berat'] : $dataretur['qty'],
                                'jenis' => $dataretur['jenis'],
                                'model' => $dataretur['model'],
                                'keterangan' => 'Retur Customer',
                                'merek' => $dataretur['merek'],
                                'kadar' => $dataretur['kadar'],
                                'berat' => $dataretur['berat'],
                                'nilai_tukar' =>  $dataretur['nilai_tukar'],
                                'harga_beli' => $dataretur['harga_beli'],
                                'total_harga' => $dataretur['total_harga'],
                                'gambar' =>  $dataretur['nama_img'],
                            ]);
                            $this->KartuStockMaster($dataretur['kode'], $session);
                        }

                        $datakartunew = $this->modelkartustock->getKartuStockkode($datadetailpenjualan['kode']);
                        $saldoakhirnew = (substr($datadetailpenjualan['kode'], 0, 1) == 4) ? $datakartunew['saldo_akhir'] + $datadetailpenjualan['berat'] : $datakartunew['saldo_akhir'] + $datadetailpenjualan['qty'];
                        $databarangnew = $this->datastock->getBarangkode($datadetailpenjualan['kode']);
                        $this->modeldetailkartustock->save([
                            'barcode' => $datadetailpenjualan['kode'],
                            'status' => 'Masuk',
                            'id_karyawan' => $session->get('id_user'),
                            'no_faktur' => $datapenjualan['no_transaksi_jual'],
                            'tgl_faktur' => $datapenjualan['created_at'],
                            'nama_customer' => $datapenjualan['nohp_cust'],
                            'saldo' => $saldoakhirnew,
                            'masuk' => (substr($datadetailpenjualan['kode'], 0, 1) == 4) ? $datadetailpenjualan['berat'] : $datadetailpenjualan['qty'],
                            'keluar' => 0,
                            'jenis' => $datadetailpenjualan['jenis'],
                            'model' => $datadetailpenjualan['model'],
                            'keterangan' => 'Retur Customer',
                            'merek' => $datadetailpenjualan['merek'],
                            'kadar' => $datadetailpenjualan['kadar'],
                            'berat' => $datadetailpenjualan['berat'],
                            'nilai_tukar' =>  $datadetailpenjualan['nilai_tukar'],
                            'harga_beli' => $datadetailpenjualan['harga_beli'],
                            'total_harga' => $datadetailpenjualan['total_harga'],
                            'gambar' =>  $datadetailpenjualan['nama_img'],
                        ]);
                        $this->KartuStockMaster($datadetailpenjualan['kode'], $session);

                        if (substr($datadetailpenjualan['kode'], 0, 1) == 4) {
                            $this->datastock->save([
                                'id_stock_1' => $databarangnew['id_stock_1'],
                                'id_karyawan' => $session->get('id_user'),
                                'berat' => $saldoakhirnew
                            ]);
                        } else {
                            $this->datastock->save([
                                'id_stock_1' => $databarangnew['id_stock_1'],
                                'id_karyawan' => $session->get('id_user'),
                                'qty' => $saldoakhirnew
                            ]);
                        }

                        if ($dataretur['total_harga'] != $datadetailpenjualan['total_harga']) {
                            $this->modeldetailpenjualan->save([
                                'id_detail_penjualan' => $dataretur['id_detail_penjualan'],
                                'id_date_penjualan' => $datadetailpenjualan['id_date_penjualan']
                            ]);
                            $this->modeldetailpenjualan->delete($datadetailpenjualan['id_detail_penjualan']);

                            $this->penjualan->save([
                                'id_penjualan' =>  $datapenjualan['id_penjualan'],
                                'id_karyawan' => $session->get('id_user'),
                                'status_dokumen' => 'Retur',
                                // 'total_harga' => $this->modeldetailpenjualan->SumDataDetailJual($this->request->getVar('iddate1'))['total_harga'],
                            ]);
                        } else {
                            $this->modeldetailpenjualan->save([
                                'id_detail_penjualan' => $dataretur['id_detail_penjualan'],
                                'id_date_penjualan' => $datadetailpenjualan['id_date_penjualan']
                            ]);
                            $this->modeldetailpenjualan->delete($datadetailpenjualan['id_detail_penjualan']);
                        }
                        $msg = 'sukses';
                    } else {
                        $msg = 'kurang';
                    }
                } else {
                    $msg = 'rendah';
                }
            } else {
                $msg = 'sama';
            }
            echo json_encode($msg);
        }
    }

    function DataDetailRetur()
    {
        if ($this->request->isAJAX()) {
            $iddateretur = $this->request->getVar('dateid') . $this->request->getVar('iddetail');
            $checkdata2 = $this->modeldetailpenjualan->getDetailRetur($iddateretur);
            if (!$checkdata2) {
                $checkdata2 = 0;
                $data = [
                    'tampildata' => $this->modeldetailpenjualan->getDetailoneJual($this->request->getVar('iddetail')),
                    'idrill' => $this->request->getVar('iddetail'),
                ];
            } else {
                $data = [
                    'tampildata' => $checkdata2,
                    'idrill' => $this->request->getVar('iddetail'),
                ];
            }
            $msg = [
                'data' => view('barangkeluar/detailretur', $data),
                'totalhargalama' => $this->modeldetailpenjualan->getDetailoneJual($this->request->getVar('iddetail')),
                'totalhargabaru' => $checkdata2,
            ];
            echo json_encode($msg);
        }
    }

    public function UbahHargaRetur()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $id = $this->request->getVar('id');
            $data = $this->modeldetailpenjualan->getDetailoneJual($id);
            $databarang = $this->datastock->getBarangkode($data['kode']);
            $datakartu = $this->modelkartustock->getKartuStockkode($data['kode']);
            if (substr($data['kode'], 0, 1) == 4) {
                $check = $this->request->getVar('berat');
            } else {
                $check = $this->request->getVar('qty');
            }
            if ($this->request->getVar('qty') > 0 && $this->request->getVar('hargabaru') > 0 && $this->request->getVar('berat') > 0) {
                if ($check <= $datakartu['saldo_akhir']) {
                    if (substr($data['kode'], 0, 1) == 3) {
                        $selisihqty = $datakartu['saldo_akhir'] - $this->request->getVar('qty');
                        $totalharga = $this->request->getVar('hargabaru') * $data['berat'] * $this->request->getVar('qty');
                        // $this->datastock->save([
                        //     'id_stock_1' => $databarang['id_stock_1'],
                        //     'id_karyawan' => $session->get('id_user'),
                        //     'qty' => $selisihqty
                        // ]);
                        $saldo = $this->request->getVar('qty');
                    } elseif (substr($data['kode'], 0, 1) == 4) {
                        $selisihberat = $datakartu['saldo_akhir'] - $this->request->getVar('berat');
                        $totalharga = $this->request->getVar('hargabaru') * $this->request->getVar('berat');
                        if ($selisihberat == 0) {
                            $qty = 0;
                        } else {
                            $qty = 1;
                        }
                        // $this->datastock->save([
                        //     'id_stock_1' => $databarang['id_stock_1'],
                        //     'id_karyawan' => $session->get('id_user'),
                        //     'berat' => $selisihberat,
                        //     'qty' => $qty
                        // ]);
                        $saldo = $this->request->getVar('berat');
                    } elseif (substr($data['kode'], 0, 1) == 2) {
                        $totalharga = $this->request->getVar('hargabaru');
                        $saldo = $this->request->getVar('qty');
                    } else {
                        $totalharga = $this->request->getVar('hargabaru') * $data['berat'];
                        $saldo = $this->request->getVar('qty');
                    }
                    $this->modeldetailpenjualan->save([
                        'id_detail_penjualan' =>  $data['id_detail_penjualan'],
                        'id_karyawan' => $session->get('id_user'),
                        'harga_beli' => $this->request->getVar('hargabaru'),
                        'berat' => $this->request->getVar('berat'),
                        'qty' => $this->request->getVar('qty'),
                        'saldo_carat' => 0,
                        'saldo' => $saldo,
                        'total_harga' => $totalharga + $data['ongkos']
                    ]);

                    $msg = 'sukses';
                } else {
                    $msg = 'habis';
                }
            } else {
                $msg = 'kecil';
            }
            echo json_encode($msg);
        }
    }
    public function ReturCust()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            if (!$this->validate([
                'kodebarang' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kode Harus di isi',
                    ]
                ]
            ])) {
                $msg = [
                    'error' => [
                        'kodebarang' => $validation->getError('kodebarang'),
                    ]
                ];
            } else {
                $session = session();
                $kode = $this->request->getVar('kodebarang');
                $databarang = $this->datastock->getBarangkode($kode);
                if (!$this->modeldetailbuyback->getCheckReturCust($this->request->getVar('iddetail'))) {
                    if ($databarang && $databarang['qty'] > 0) {
                        if (substr($databarang['barcode'], 0, 1) == 3) {
                            $totalharga = $databarang['harga_beli'] * $databarang['berat'] * $databarang['qty'];
                        }
                        if (substr($databarang['barcode'], 0, 1) == 2) {
                            $totalharga = $databarang['harga_beli'];
                        }
                        if (substr($databarang['barcode'], 0, 1) == 1 || substr($databarang['barcode'], 0, 1) == 4 || substr($databarang['barcode'], 0, 1) == 5) {
                            $totalharga = $databarang['harga_beli'] * $databarang['berat'];
                        }
                        if (substr($databarang['barcode'], 0, 1) == 6) {
                            $totalharga = $databarang['harga_beli'] * $databarang['qty'];
                        }
                        $checkdata = $this->modeldetailpenjualan->getDetailCheckJual($databarang['barcode'], $this->request->getVar('iddate'));
                        if (!$checkdata) {
                            $iddateretur = $this->request->getVar('iddate') . $this->request->getVar('iddetail');
                            $checkdata2 = $this->modeldetailpenjualan->getDetailRetur($iddateretur);
                            if (!$checkdata2) {

                                $this->modeldetailpenjualan->save([
                                    'id_date_penjualan' => $iddateretur,
                                    'id_karyawan' => $session->get('id_user'),
                                    'nama_img' => $databarang['gambar'],
                                    'status' => $databarang['status'],
                                    'kode' =>  $databarang['barcode'],
                                    'qty' => $databarang['qty'],
                                    'saldo' => $databarang['qty'],
                                    'saldo_carat' => $databarang['carat'],
                                    'jenis' =>  $databarang['jenis'],
                                    'model' =>  $databarang['model'],
                                    'keterangan' =>  $databarang['keterangan'],
                                    'berat' =>  $databarang['berat'],
                                    'berat_murni' =>  $databarang['berat_murni'],
                                    'harga_beli' =>  $databarang['harga_beli'],
                                    'ongkos' => $databarang['ongkos'],
                                    'kadar' =>   $databarang['kadar'],
                                    'nilai_tukar' =>   $databarang['nilai_tukar'],
                                    'merek' =>  $databarang['merek'],
                                    'total_harga' => $totalharga,
                                ]);
                            } else {

                                if ($checkdata2['kode'] != $this->request->getVar('kodebarang')) {
                                    $this->modeldetailpenjualan->delete($checkdata2['id_detail_penjualan']);
                                    $this->modeldetailpenjualan->save([
                                        'id_date_penjualan' => $iddateretur,
                                        'id_karyawan' => $session->get('id_user'),
                                        'nama_img' => $databarang['gambar'],
                                        'status' => $databarang['status'],
                                        'kode' =>  $databarang['barcode'],
                                        'qty' => $databarang['qty'],
                                        'saldo' => $databarang['qty'],
                                        'saldo_carat' => $databarang['carat'],
                                        'jenis' =>  $databarang['jenis'],
                                        'model' =>  $databarang['model'],
                                        'keterangan' =>  $databarang['keterangan'],
                                        'berat' =>  $databarang['berat'],
                                        'berat_murni' =>  $databarang['berat_murni'],
                                        'harga_beli' =>  $databarang['harga_beli'],
                                        'ongkos' => $databarang['ongkos'],
                                        'kadar' =>   $databarang['kadar'],
                                        'nilai_tukar' =>   $databarang['nilai_tukar'],
                                        'merek' =>  $databarang['merek'],
                                        'total_harga' => $totalharga,
                                    ]);
                                }
                            }
                            $msg = 'sukses';
                        } else {
                            $msg = [
                                'error' => [
                                    'kodebarang' => 'Barang Sudah Masuk / Draft lain',
                                ]
                            ];
                        }
                    } else {
                        $msg = [
                            'error' => [
                                'kodebarang' => 'Tidak ada Stock',
                            ]
                        ];
                    }
                } else {
                    $msg = [
                        'error' => [
                            'kodebarang' => 'Barang Sudah Di Buyback',
                        ]
                    ];
                }
            }
            echo json_encode($msg);
        } else {
            exit('Anda Hacker Sejati');
        }
    }
    public function BatalPenjualan($id)
    {
        $session = session();
        $data = $this->modeldetailpenjualan->getDetailAllJual($id);
        foreach ($data as $row) {
            if (substr($row['kode'], 0, 1) == 1) {
                $databarang = $this->datastock1->getBarangkode($row['kode']);
                $datakartu = $this->modelkartustock->getKartuStockkode($row['kode']);
                $this->datastock1->save([
                    'id_stock_1' => $databarang['id_stock_1'],
                    'id_karyawan' => $session->get('id_user'),
                    'qty' => $datakartu['saldo_akhir']
                ]);
            } elseif (substr($row['kode'], 0, 1) == 2) {
                $databarang = $this->datastock2->getBarangkode($row['kode']);
                $datakartu = $this->modelkartustock->getKartuStockkode($row['kode']);
                $this->datastock2->save([
                    'id_stock_2' => $databarang['id_stock_2'],
                    'id_karyawan' => $session->get('id_user'),
                    'qty' => $datakartu['saldo_akhir']
                ]);
            } elseif (substr($row['kode'], 0, 1) == 3) {
                $databarang = $this->datastock3->getBarangkode($row['kode']);
                $datakartu = $this->modelkartustock->getKartuStockkode($row['kode']);
                $this->datastock3->save([
                    'id_stock_3' => $databarang['id_stock_3'],
                    'id_karyawan' => $session->get('id_user'),
                    'qty' => $datakartu['saldo_akhir']
                ]);
            } elseif (substr($row['kode'], 0, 1) == 4) {
                $databarang = $this->datastock4->getBarangkode($row['kode']);
                $datakartu = $this->modelkartustock->getKartuStockkode($row['kode']);
                $this->datastock4->save([
                    'id_stock_4' => $databarang['id_stock_4'],
                    'id_karyawan' => $session->get('id_user'),
                    'berat' => $datakartu['saldo_akhir']
                ]);
            } elseif (substr($row['kode'], 0, 1) == 5) {
                $databarang = $this->datastock5->getBarangkode($row['kode']);
                $datakartu = $this->modelkartustock5->getKartuStockkode($row['kode']);
                $this->datastock5->save([
                    'id_stock_5' => $databarang['id_stock_5'],
                    'id_karyawan' => $session->get('id_user'),
                    'qty' => $datakartu['saldo_akhir'],
                    'carat' => $datakartu['saldo_carat'],
                ]);
            } elseif (substr($row['kode'], 0, 1) == 6) {
                $databarang = $this->datastock6->getBarangkode($row['kode']);
                $datakartu = $this->modelkartustock6->getKartuStockkode($row['kode']);
                $this->datastock6->save([
                    'id_stock_5' => $databarang['id_stock_5'],
                    'id_karyawan' => $session->get('id_user'),
                    'qty' => $datakartu['saldo_akhir'],

                ]);
            }
        }
        $this->modeldetailpenjualan->query('DELETE FROM tbl_detail_penjualan WHERE id_date_penjualan =' . $id . ';');
        $this->penjualan->query('DELETE FROM tbl_penjualan WHERE id_date_penjualan =' . $id . ';');

        return redirect()->to('/barangkeluar');
    }

    public function penjualan_detail_read()
    {
        if ($this->request->isAJAX()) {

            $msg = [
                'totalbersih' => $this->modeldetailpenjualan->SumDataDetailJual($this->request->getVar('dateid')),
                'totalberatkotor' => $this->modeldetailpenjualan->SumBeratKotorDetailjual($this->request->getVar('dateid')),
            ];
            echo json_encode($msg);
        }
        // return view('barangmasuk/pembelian_supplier');
    }
    public function NoTransaksiGenerateJual()
    {
        $data = $this->penjualan->getNoTrans();
        if ($this->penjualan->getNoTrans()) {
            if (substr($data['no_transaksi_jual'], 0, 2) == date('y')) {
                $valnotransaksi = substr($data['no_transaksi_jual'], 4, 10) + 1;
                $notransaksi = 'S-' . date('ym') . str_pad($valnotransaksi, 4, '0', STR_PAD_LEFT);

                return $notransaksi;
            } else {
                $notransaksi = 'S-' . date('ym') . str_pad(1, 4, '0', STR_PAD_LEFT);

                return $notransaksi;
            }
        } else {
            $notransaksi = 'S-' . date('ym') . str_pad(1, 4, '0', STR_PAD_LEFT);

            return $notransaksi;
        }
    }

    public function UbahKeterangan()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $this->modeldetailpenjualan->save([
                'id_detail_penjualan' => $this->request->getVar('id'),
                'id_karyawan' => $session->get('id_user'),
                'keterangan' => $this->request->getVar('value')
            ]);
            echo json_encode('sukses');
        }
    }
    public function TampilPenjualan()
    {
        if ($this->request->isAJAX()) {
            $data = $this->penjualan->DataFilterPenjualan($this->request->getVar('tmpildata'), $this->request->getVar('kelompok'), $this->request->getVar('status'),  $this->request->getVar('notrans'));
            $view = [
                'datapenjualan' => $data,
                'datacust' => new ModelCustomer()
            ];
            $msg = [
                'tampildata' => view('barangkeluar/tampilpenjualan', $view),
            ];

            echo json_encode($msg);
        }
    }

    public function UpdateTanggalJual()
    {
        if ($this->request->isAJAX()) {
            $time = Time::createFromFormat('Y-m-d H:i:s', $this->request->getVar('tanggal') . ' ' . date('H:i:s'));
            $this->penjualan->updatetanggal($this->request->getVar('notransedit'), $time);
            $msg = [
                'msg' => 'sukses',
            ];

            echo json_encode($msg);
        }
    }
}
