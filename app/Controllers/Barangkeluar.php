<?php

namespace App\Controllers;

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use App\Models\ModelPembelian;
use App\Models\ModelHome;
use App\Models\ModelPenjualan;
use App\Models\ModelCustomer;
use App\Models\ModelDetailPenjualan;
use App\Models\ModelKartuStock;
use App\Models\ModelDetailKartuStock;
use App\Models\ModelBank;

use CodeIgniter\Model;
use CodeIgniter\Validation\Rules;
use Faker\Provider\ar_EG\Person;
use PhpParser\Node\Expr\Isset_;

class Barangkeluar extends BaseController
{
    protected $detailbeli;
    protected $databarangmasuk;
    protected $datamerek;
    protected $datakadar;
    protected $datasupplier;
    protected $datapembelian;
    protected $datastock;
    protected $barcodeG;
    protected $penjualan;
    protected $datacust;

    public function __construct()
    {
        $this->modeldetailpenjualan =  new ModelDetailPenjualan();
        $this->barcodeG =  new BarcodeGenerator();
        $this->datapembelian = new ModelPembelian();
        $this->datastock = new ModelHome();
        $this->datacust = new ModelCustomer();
        $this->barcodeG =  new BarcodeGenerator();
        $this->penjualan =  new ModelPenjualan();
        $this->modelkartustock = new ModelKartuStock();
        $this->modeldetailkartustock = new ModelDetailKartuStock();
        $this->modelbank = new ModelBank();
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
        $session->remove('date_id_penjualan');
        //-------------------------------------------------------------
        $dateidjual = date('ymdhis');
        $session->set('date_id_penjualan', $dateidjual);
        $this->penjualan->save([
            // 'created_at' => date("y-m-d"),
            'id_date_penjualan' => $dateidjual,
            'no_transaksi_jual' => $this->NoTransaksiGenerateJual(),
            'id_customer' => '',
            'id_karyawan' => $session->get('id_user'),
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
            echo json_encode($data);
        }
    }

    public function CheckCustomer()
    {
        if ($this->request->isAJAX()) {
            $data = $this->datacust->getDataCustomerone($this->request->getVar('nohp_cust'));
            if ($data) {
                $msg = 'sukses customer';
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
            $kode = $this->request->getVar('kodebarang');
            $databarang = $this->datastock->getBarangkode($kode);

            if (!$this->validate([
                // 'inputcustomer' => [
                //     'rules' => 'required',
                //     'errors' => [
                //         'required' => 'Customer Harus di isi',
                //     ]
                // ],
                'kodebarang' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kode Harus di isi',
                    ]
                ]
            ])) {
                $msg = [
                    'error' => [
                        // 'inputcustomer' => $validation->getError('inputcustomer'),
                        'kodebarang' => $validation->getError('kodebarang'),
                    ]
                ];
            } else {
                $session = session();
                if ($databarang && $databarang['qty'] > 0) {
                    $data = $this->penjualan->getDataPenjualan($this->request->getVar('iddate'));
                    if (substr($databarang['barcode'], 0, 1) == 3) {
                        $totalharga = $databarang['harga_beli'] * $databarang['berat'] * $databarang['qty'];
                    } else {
                        $totalharga = $databarang['harga_beli'] * $databarang['berat'];
                    }
                    $checkdata = $this->modeldetailpenjualan->getDetailCheckJual($databarang['barcode'], $this->request->getVar('iddate'));
                    if (!$checkdata) {
                        $this->modeldetailpenjualan->save([
                            'id_date_penjualan' => $this->request->getVar('iddate'),
                            'id_karyawan' => $session->get('id_user'),
                            'nama_img' => $databarang['gambar'],
                            'kode' =>  $databarang['barcode'],
                            'qty' => $databarang['qty'],
                            'saldo' => $databarang['qty'],
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


                        $this->penjualan->save([
                            'id_penjualan' =>  $data['id_penjualan'],
                            'id_karyawan' => $session->get('id_user'),
                            // 'nohp_cust' => $this->request->getVar('inputcustomer'),
                            'jumlah' => $this->modeldetailpenjualan->JumlahData($this->request->getVar('iddate'))['jumlah'],
                            'pembulatan' => '0',
                            'total_harga' => $this->modeldetailpenjualan->SumDataOngkosJual($this->request->getVar('iddate'))['ongkos'] + $this->modeldetailpenjualan->SumDataDetailJual($this->request->getVar('iddate'))['total_harga'],
                            'pembayaran' => 'Bayar Nanti',
                            'tunai' => '-',
                            'debitcc' => '0',
                            'transfer' => '0',
                            'status_dokumen' => 'Draft'
                        ]);
                        $this->datastock->save([
                            'id_stock' => $databarang['id_stock'],
                            'id_karyawan' => $session->get('id_user'),
                            'qty' => '0'
                        ]);

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
                            'kodebarang' => 'Tidak ada Stock',
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
            $jualan = $this->penjualan->getDataPenjualan($this->request->getVar('iddate'));
            $data = $this->modeldetailpenjualan->getDetailoneJual($id);
            $databarang = $this->datastock->getBarangkode($data['kode']);
            $datakartu = $this->modelkartustock->getKartuStockkode($data['kode']);
            if (substr($data['kode'], 0, 1) == 4) {
                $check = $this->request->getVar('berat');
            } else {
                $check = $this->request->getVar('qty');
            }
            if ($this->request->getVar('qty') > 0 && $this->request->getVar('hargabaru') > 0 && $this->request->getVar('berat') > 0) {
                if ($check <= $datakartu['saldo_akhir'] || substr($data['kode'], 0, 1) != 3) {
                    if (substr($data['kode'], 0, 1) == 3) {
                        $selisihqty = $datakartu['saldo_akhir'] - $this->request->getVar('qty');
                        $totalharga = $this->request->getVar('hargabaru') * $data['berat'] * $this->request->getVar('qty');
                        $this->datastock->save([
                            'id_stock' => $databarang['id_stock'],
                            'id_karyawan' => $session->get('id_user'),
                            'qty' => $selisihqty
                        ]);
                        $saldo = $this->request->getVar('qty');
                    } elseif (substr($data['kode'], 0, 1) == 4) {
                        $selisihberat = $datakartu['saldo_akhir'] - $this->request->getVar('berat');
                        $totalharga = $this->request->getVar('hargabaru') * $this->request->getVar('berat');
                        if ($selisihberat == 0) {
                            $qty = 0;
                        } else {
                            $qty = 1;
                        }
                        $this->datastock->save([
                            'id_stock' => $databarang['id_stock'],
                            'id_karyawan' => $session->get('id_user'),
                            'berat' => $selisihberat,
                            'qty' => $qty
                        ]);
                        $saldo = $this->request->getVar('berat');
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
                        'saldo' => $saldo,
                        'total_harga' => $totalharga
                    ]);
                    $this->penjualan->save([
                        'id_penjualan' =>  $jualan['id_penjualan'],
                        'id_karyawan' => $session->get('id_user'),
                        'total_harga' => $this->modeldetailpenjualan->SumDataOngkosJual($this->request->getVar('iddate'))['ongkos'] + $this->modeldetailpenjualan->SumDataDetailJual($this->request->getVar('iddate'))['total_harga'],
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

    public function DeleteDetailjual()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $datapenjualan = $this->penjualan->getDataPenjualan($this->request->getVar('iddate'));
            $totalharga = $this->modeldetailpenjualan->SumDataOngkosJual($this->request->getVar('iddate'))['ongkos'] + $this->modeldetailpenjualan->SumDataDetailBeliJual($this->request->getVar('iddate'))['harga_beli'];
            if ($totalharga == null) {
                $totalharga = 0;
            }
            //$datastock = $this->datastock->CheckData(1);
            $id = $this->request->getVar('id');
            $data = $this->modeldetailpenjualan->getDetailoneJual($id);
            $databarang = $this->datastock->getBarangkode($data['kode']);
            $datakartu = $this->modelkartustock->getKartuStockkode($data['kode']);

            $this->penjualan->save([
                'id_penjualan' =>  $datapenjualan['id_penjualan'],
                'id_karyawan' => $session->get('id_user'),
                'total_harga' =>  $totalharga,
            ]);
            if (substr($data['kode'], 0, 1) == 4) {
                $this->datastock->save([
                    'id_stock' => $databarang['id_stock'],
                    'id_karyawan' => $session->get('id_user'),
                    'berat' => $datakartu['saldo_akhir'],
                    'qty' => '1'
                ]);
            } else {
                $this->datastock->save([
                    'id_stock' => $databarang['id_stock'],
                    'id_karyawan' => $session->get('id_user'),
                    'qty' => $datakartu['saldo_akhir']
                ]);
            }
            $this->modeldetailpenjualan->delete($id);

            $msg = [
                'sukses' => 'Berhasil'
            ];
            echo json_encode($msg);
        }
    }

    public function DraftPenjualan($id)
    {
        $session = session();
        $session->set('date_id_penjualan', $id);
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
        foreach ($databerat as $row) {
            if (substr($row['kode'], 0, 1) == 3) {
                $totalberat = $totalberat + ($row['qty'] * $row['berat']);
            } else {
                $totalberat = $totalberat + $row['berat'];
            }
        }
        $datapenjualan = [
            'datapenjualan' => $data,
            'totalberat' => $totalberat,
            'datacust' => $this->datacust->getDataCustomerone($data['nohp_cust']),
            'tampildata' => $this->modeldetailpenjualan->getDetailAllJual($id),
        ];

        return view('barangkeluar/detail_jual_barang', $datapenjualan);
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
            if ($this->request->getVar('pembayaran') != 'Bayar Nanti') {
                $datapenjualan = $this->penjualan->getDataPenjualan($this->request->getVar('dateid'));
                if ($this->request->getVar('pembayaran') == 'Debit/CC') {
                    if (!$this->validate([
                        'inputcustomer' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Customer Harus di isi',
                            ]
                        ],
                        'debitcc' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Debit CC Harus di isi',
                            ]
                        ],
                        'namabank' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Nama Bank Harus di isi',
                            ]
                        ]
                    ])) {
                        $msg = [
                            'error' => [
                                'inputcustomer' => $validation->getError('inputcustomer'),
                                'debitcc' => $validation->getError('debitcc'),
                                'namabank' => $validation->getError('namabank'),
                            ]
                        ];
                    } else {
                        $session = session();
                        $cas = ($this->request->getVar('charge') != null) ? $this->request->getVar('charge') : 0;
                        $blt = ($this->request->getVar('pembulatan') != null) ? $this->request->getVar('pembulatan') : 0;
                        $totalbayar = $datapenjualan['total_harga'] + ($cas * ($datapenjualan['total_harga'] / 100));
                        $hasil = $totalbayar - ($this->request->getVar('debitcc') + $blt);
                        if ($hasil == 0) {
                            $this->penjualan->save([
                                'id_penjualan' =>  $datapenjualan['id_penjualan'],
                                'id_karyawan' => $session->get('id_user'),
                                'nohp_cust' => $this->request->getVar('inputcustomer'),
                                'pembayaran' => $this->request->getVar('pembayaran'),
                                'nama_bank' => $this->request->getVar('namabank'),
                                'tunai' =>  $this->request->getVar('tunai'),
                                'debitcc' =>  $this->request->getVar('debitcc'),
                                'transfer' =>  $this->request->getVar('transfer'),
                                'charge' =>   $this->request->getVar('charge'),
                                'pembulatan' => $this->request->getVar('pembulatan'),
                                'status_dokumen' => 'Selesai',
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
                                    'kurang' => 'Bayar Kurang / lebih'
                                ]
                            ];
                        }
                    }
                }
                if ($this->request->getVar('pembayaran') == 'Debit/CCTranfer') {
                    if (!$this->validate([
                        'inputcustomer' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Customer Harus di isi',
                            ]
                        ],
                        'debitcc' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Debit CC Harus di isi',
                            ]
                        ],
                        'namabank' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Nama Bank Harus di isi',
                            ]
                        ],
                        'transfer' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Transfer Harus di isi',
                            ]
                        ]
                    ])) {
                        $msg = [
                            'error' => [
                                'inputcustomer' => $validation->getError('inputcustomer'),
                                'debitcc' => $validation->getError('debitcc'),
                                'namabank' => $validation->getError('namabank'),
                                'transfer' => $validation->getError('transfer'),
                            ]
                        ];
                    } else {
                        $cas = ($this->request->getVar('charge') != null) ? $this->request->getVar('charge') : 0;
                        $blt = ($this->request->getVar('pembulatan') != null) ? $this->request->getVar('pembulatan') : 0;
                        $totalbayar = $datapenjualan['total_harga'] + ($cas * ($datapenjualan['total_harga'] / 100));
                        $hasil = $totalbayar - ($this->request->getVar('debitcc') + $this->request->getVar('transfer') + $blt);
                        if ($hasil == 0) {
                            $this->penjualan->save([
                                'id_penjualan' =>  $datapenjualan['id_penjualan'],
                                'id_karyawan' => $session->get('id_user'),
                                'nohp_cust' => $this->request->getVar('inputcustomer'),
                                'pembayaran' => $this->request->getVar('pembayaran'),
                                'nama_bank' => $this->request->getVar('namabank'),
                                'tunai' =>  $this->request->getVar('tunai'),
                                'debitcc' =>  $this->request->getVar('debitcc'),
                                'transfer' =>  $this->request->getVar('transfer'),
                                'charge' =>   $this->request->getVar('charge'),
                                'pembulatan' => $this->request->getVar('pembulatan'),
                                'status_dokumen' => 'Selesai',
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
                                    'kurang' => 'Bayar Kurang / lebih'
                                ]
                            ];
                        }
                        // $msg = $asd;
                    }
                }
                if ($this->request->getVar('pembayaran') == 'Transfer') {
                    if (!$this->validate([
                        'inputcustomer' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Customer Harus di isi',
                            ]
                        ],
                        'transfer' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Transfer Harus di isi',
                            ]
                        ],
                        'namabank' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Nama Bank Harus di isi',
                            ]
                        ]
                    ])) {
                        $msg = [
                            'error' => [
                                'inputcustomer' => $validation->getError('inputcustomer'),
                                'transfer' => $validation->getError('transfer'),
                                'namabank' => $validation->getError('namabank'),
                            ]
                        ];
                    } else {
                        $blt = ($this->request->getVar('pembulatan') != null) ? $this->request->getVar('pembulatan') : 0;
                        $hasil = $datapenjualan['total_harga'] - ($this->request->getVar('transfer') + $blt);
                        if ($hasil == 0) {
                            $this->penjualan->save([
                                'id_penjualan' =>  $datapenjualan['id_penjualan'],
                                'id_karyawan' => $session->get('id_user'),
                                'nohp_cust' => $this->request->getVar('inputcustomer'),
                                'pembayaran' => $this->request->getVar('pembayaran'),
                                'nama_bank' => $this->request->getVar('namabank'),
                                'tunai' =>  $this->request->getVar('tunai'),
                                'debitcc' =>  $this->request->getVar('debitcc'),
                                'transfer' =>  $this->request->getVar('transfer'),
                                'charge' =>   $this->request->getVar('charge'),
                                'pembulatan' => $this->request->getVar('pembulatan'),
                                'status_dokumen' => 'Selesai',
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
                                    'kurang' => 'Bayar Kurang / lebih'
                                ]
                            ];
                        }
                    }
                }
                if ($this->request->getVar('pembayaran') == 'Tunai') {
                    if (!$this->validate([
                        'inputcustomer' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Customer Harus di isi',
                            ]
                        ],
                        'tunai' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Tunai Harus di isi',
                            ]
                        ]
                    ])) {
                        $msg = [
                            'error' => [
                                'inputcustomer' => $validation->getError('inputcustomer'),
                                'tunai' => $validation->getError('tunai'),
                            ]
                        ];
                    } else {
                        $blt = ($this->request->getVar('pembulatan') != null) ? $this->request->getVar('pembulatan') : 0;
                        $hasil = $datapenjualan['total_harga'] - ($this->request->getVar('tunai') + $blt);
                        if ($hasil == 0) {
                            $this->penjualan->save([
                                'id_penjualan' =>  $datapenjualan['id_penjualan'],
                                'id_karyawan' => $session->get('id_user'),
                                'nohp_cust' => $this->request->getVar('inputcustomer'),
                                'pembayaran' => $this->request->getVar('pembayaran'),
                                'nama_bank' => $this->request->getVar('namabank'),
                                'tunai' =>  $this->request->getVar('tunai'),
                                'debitcc' =>  $this->request->getVar('debitcc'),
                                'transfer' =>  $this->request->getVar('transfer'),
                                'charge' =>   $this->request->getVar('charge'),
                                'pembulatan' => $this->request->getVar('pembulatan'),
                                'status_dokumen' => 'Selesai',
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
                                    'kurang' => 'Bayar Kurang / lebih'
                                ]
                            ];
                            // $msg = $hasil;
                        }
                    }
                }
                if ($this->request->getVar('pembayaran') == 'Tunai&Debit/CC') {
                    if (!$this->validate([
                        'inputcustomer' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Customer Harus di isi',
                            ]
                        ],
                        'tunai' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Tunai Harus di isi',
                            ]
                        ],
                        'debitcc' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Debit CC Harus di isi',
                            ]
                        ],
                        'namabank' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Nama Bank Harus di isi',
                            ]
                        ]
                    ])) {
                        $msg = [
                            'error' => [
                                'inputcustomer' => $validation->getError('inputcustomer'),
                                'debitcc' => $validation->getError('debitcc'),
                                'tunai' => $validation->getError('tunai'),
                                'namabank' => $validation->getError('namabank'),
                            ]
                        ];
                    } else {
                        $cas = ($this->request->getVar('charge') != null) ? $this->request->getVar('charge') : 0;
                        $blt = ($this->request->getVar('pembulatan') != null) ? $this->request->getVar('pembulatan') : 0;
                        $totalbayar = $datapenjualan['total_harga'] + ($cas * ($datapenjualan['total_harga'] / 100));
                        $hasil = $totalbayar - ($this->request->getVar('debitcc') + $this->request->getVar('tunai') + $blt);
                        if ($hasil == 0) {
                            $this->penjualan->save([
                                'id_penjualan' =>  $datapenjualan['id_penjualan'],
                                'id_karyawan' => $session->get('id_user'),
                                'nohp_cust' => $this->request->getVar('inputcustomer'),
                                'pembayaran' => $this->request->getVar('pembayaran'),
                                'nama_bank' => $this->request->getVar('namabank'),
                                'tunai' =>  $this->request->getVar('tunai'),
                                'debitcc' =>  $this->request->getVar('debitcc'),
                                'transfer' =>  $this->request->getVar('transfer'),
                                'charge' =>   $this->request->getVar('charge'),
                                'pembulatan' => $this->request->getVar('pembulatan'),
                                'status_dokumen' => 'Selesai',
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
                                    'kurang' => 'Bayar Kurang / lebih'
                                ]
                            ];
                        }
                    }
                }
                if ($this->request->getVar('pembayaran') == 'Tunai&Transfer') {
                    if (!$this->validate([
                        'inputcustomer' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Customer Harus di isi',
                            ]
                        ],
                        'tunai' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Tunai Harus di isi',
                            ]
                        ],
                        'transfer' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Transfer Harus di isi',
                            ]
                        ],
                        'namabank' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Nama Bank Harus di isi',
                            ]
                        ]
                    ])) {
                        $msg = [
                            'error' => [
                                'inputcustomer' => $validation->getError('inputcustomer'),
                                'tunai' => $validation->getError('tunai'),
                                'transfer' => $validation->getError('transfer'),
                                'namabank' => $validation->getError('namabank'),
                            ]
                        ];
                    } else {
                        $blt = ($this->request->getVar('pembulatan') != null) ? $this->request->getVar('pembulatan') : 0;
                        $hasil = $datapenjualan['total_harga'] - ($this->request->getVar('transfer') + $this->request->getVar('tunai') + $blt);
                        if ($hasil == 0) {
                            $this->penjualan->save([
                                'id_penjualan' =>  $datapenjualan['id_penjualan'],
                                'id_karyawan' => $session->get('id_user'),
                                'nohp_cust' => $this->request->getVar('inputcustomer'),
                                'pembayaran' => $this->request->getVar('pembayaran'),
                                'nama_bank' => $this->request->getVar('namabank'),
                                'tunai' =>  $this->request->getVar('tunai'),
                                'debitcc' =>  $this->request->getVar('debitcc'),
                                'transfer' =>  $this->request->getVar('transfer'),
                                'charge' =>   $this->request->getVar('charge'),
                                'pembulatan' => $this->request->getVar('pembulatan'),
                                'status_dokumen' => 'Selesai',
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
                                    'kurang' => 'Bayar Kurang / lebih'
                                ]
                            ];
                        }
                    }
                }
                if (isset($status)) {
                    $datadetailpenjualan = $this->modeldetailpenjualan->getDetailAllJual($datapenjualan['id_date_penjualan']);
                    foreach ($datadetailpenjualan as $row) {
                        $datakartu = $this->modelkartustock->getKartuStockkode($row['kode']);
                        $saldoakhir = (substr($row['kode'], 0, 1) == 4) ? $datakartu['saldo_akhir'] - $row['berat'] : $datakartu['saldo_akhir'] - $row['qty'];
                        $this->modeldetailkartustock->save([
                            // 'id_detail_kartustock' => $datadetailkartu['id_detail_kartustock'],
                            'barcode' => $row['kode'],
                            'status' => 'Keluar',
                            'id_karyawan' => $session->get('id_user'),
                            'no_faktur' => $datapenjualan['no_transaksi_jual'],
                            'tgl_faktur' => $datapenjualan['created_at'],
                            'nama_customer' => $this->request->getVar('inputcustomer'),
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
                        ]);

                        $this->modelkartustock->save([
                            'id_kartustock' => $datakartu['id_kartustock'],
                            'id_karyawan' => $session->get('id_user'),
                            'total_masuk' => $this->modeldetailkartustock->SumMasukKartu($row['kode']),
                            'total_keluar' => $this->modeldetailkartustock->SumKeluarKartu($row['kode']),
                            'saldo_akhir' => $saldoakhir,
                        ]);
                    }
                }

                echo json_encode($msg);
            } else {
                echo json_encode('error');
            }
        }
    }
    public function penjualan_read()
    {
        $session = session();
        if ($this->request->isAJAX()) {
            $databerat = $this->modeldetailpenjualan->getDetailAllJual($this->request->getVar('dateid'));
            $totalberat = 0;
            foreach ($databerat as $row) {
                if (substr($row['kode'], 0, 1) == 3) {
                    $totalberat = $totalberat + ($row['qty'] * $row['berat']);
                } else {
                    $totalberat = $totalberat + $row['berat'];
                }
            }
            $data = [
                'tampildata' => $this->modeldetailpenjualan->getDetailAlljual($this->request->getVar('dateid')),
            ];
            $msg = [
                'data' => view('barangkeluar/detailtablejual', $data),
                'totalbersih' => $this->modeldetailpenjualan->SumDataDetailJual($this->request->getVar('dateid')),
                'totalongkos' => $this->modeldetailpenjualan->SumDataOngkosJual($this->request->getVar('dateid')),
                // 'totalberatkotor' => $this->modeldetailpenjualan->SumBeratKotorDetailjual($this->request->getVar('dateid')),
                'totalberatkotor' => $totalberat,
                'totalberatbersih' => $this->modeldetailpenjualan->SumBeratBersihDetailjual($this->request->getVar('dateid')),
            ];
            echo json_encode($msg);
        }
        // return view('barangmasuk/pembelian_supplier');
    }

    public function BatalPenjualan()
    {
        $session = session();
        if ($session->get('date_id_penjualan')) {
            $data = $this->modeldetailpenjualan->getDetailAllJual($session->get('date_id_penjualan'));

            foreach ($data as $row) {

                $databarang = $this->datastock->getBarangkode($row['kode']);
                $datakartu = $this->modelkartustock->getKartuStockkode($row['kode']);
                $this->datastock->save([
                    'id_stock' => $databarang['id_stock'],
                    'id_karyawan' => $session->get('id_user'),
                    'qty' => $datakartu['saldo_akhir']
                ]);
            }
            $this->modeldetailpenjualan->query('DELETE FROM tbl_detail_penjualan WHERE id_date_penjualan =' . $session->get('date_id_penjualan') . ';');
            $this->penjualan->query('DELETE FROM tbl_penjualan WHERE id_date_penjualan =' . $session->get('date_id_penjualan') . ';');

            return redirect()->to('/barangkeluar');
        } else {
            return redirect()->to('/barangkeluar');
        }
    }

    public function penjualan_detail_read()
    {
        if ($this->request->isAJAX()) {

            $msg = [
                'totalbersih' => $this->modeldetailpenjualan->SumDataDetailJual($this->request->getVar('dateid')),
                'totalberatkotor' => $this->modeldetailpenjualan->SumBeratKotorDetailjual($this->request->getVar('dateid')),
                'totalberatbersih' => $this->modeldetailpenjualan->SumBeratBersihDetailjual($this->request->getVar('dateid')),
                'totalongkos' => $this->modeldetailpenjualan->SumDataOngkosJual($this->request->getVar('dateid')),

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
}
