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
            'id_date_penjualan' => $session->get('date_id_penjualan'),
            'no_transaksi_jual' => $this->NoTransaksiGenerateJual(),
            'id_customer' => '',
            'id_karyawan' => '1',
            'nohp_cust' => '',
            'jumlah' => '1',
            'pembulatan' => '0',
            'total_harga' => '0',
            'pembayaran' => 'Bayar Nanti',
            'tunai' => '0',
            'debitcc' => '0',
            'transfer' => '0',
            'status_dokumen' => 'Draft'
        ]);
        //---------------------------------------------------
        return redirect()->to('/draftpenjualan/' . $session->get('date_id_penjualan'));
    }
    public function InsertCust()
    {
        if ($this->request->isAJAX()) {
            $this->datacust->save([
                'nama' => $this->request->getVar('nama_cust'),
                'nohp_cust' => $this->request->getVar('nohp'),
                'alamat_cust' => $this->request->getVar('alamat'),
                'kota_cust' => $this->request->getVar('kota'),
                'sales_cust' => '-',
                'point' => '0',

            ]);
            $msg = [
                'pesan' => 'Berahasil'
            ];
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
                'inputcustomer' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Customer Harus di isi',
                    ]
                ],
                'kodebarang' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kode Harus di isi',
                    ]
                ]
            ])) {
                $msg = [
                    'error' => [
                        'inputcustomer' => $validation->getError('inputcustomer'),
                        'kodebarang' => $validation->getError('kodebarang'),
                    ]
                ];
            } else {
                if ($databarang && $databarang['qty'] > 0) {
                    $data = $this->penjualan->getDataPenjualan($this->request->getVar('iddate'));
                    if (substr($databarang['barcode'], 0, 1) == 3) {
                        $totalharga = $databarang['harga_beli'] * $databarang['berat'] * $databarang['qty'];
                    } else {
                        $totalharga = $databarang['harga_beli'] * $databarang['berat'];
                    }
                    $checkdata = $this->modeldetailpenjualan->getDetailCheckJual($databarang['barcode']);
                    if (!$checkdata) {
                        $this->modeldetailpenjualan->save([
                            'id_date_penjualan' => $this->request->getVar('iddate'),
                            'nama_img' => $databarang['gambar'],
                            'kode' =>  $databarang['barcode'],
                            'qty' => $databarang['qty'],
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
                            'id_customer' => $this->datacust->getDataCustomerone($this->request->getVar('inputcustomer'))['id_customer'],
                            'id_karyawan' => '1',
                            'nohp_cust' => $this->request->getVar('inputcustomer'),
                            'jumlah' => 1 + $data['jumlah'],
                            'pembulatan' => '0',
                            'total_harga' => $this->modeldetailpenjualan->SumDataOngkosJual($this->request->getVar('iddate'))['ongkos'] + $this->modeldetailpenjualan->SumDataDetailBeliJual($this->request->getVar('iddate'))['harga_beli'],
                            'pembayaran' => 'Bayar Nanti',
                            'tunai' => '-',
                            'debitcc' => '0',
                            'transfer' => '0',
                            'status_dokumen' => 'Draft'
                        ]);
                        $this->datastock->save([
                            'id_stock' => $databarang['id_stock'],
                            'qty' => '0'
                        ]);

                        $msg = [
                            'pesan' => 'Berhasil',
                        ];
                    } else {
                        $msg = [
                            'error' => [
                                'kodebarang' => 'Barang Sudah Masuk',
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

            $id = $this->request->getVar('id');
            $jualan = $this->penjualan->getDataPenjualan($this->request->getVar('iddate'));
            $data = $this->modeldetailpenjualan->getDetailoneJual($id);
            $databarang = $this->datastock->getBarangkode($data['kode']);
            $datakartu = $this->modelkartustock->getKartuStockkode($data['kode']);
            if ($this->request->getVar('qty') > 0 && $this->request->getVar('hargabaru') > 0) {
                if ($this->request->getVar('qty') <= $datakartu['saldo_akhir'] || substr($data['kode'], 0, 1) != 3) {
                    if (substr($data['kode'], 0, 1) == 3) {
                        $selisihqty = $datakartu['saldo_akhir'] - $this->request->getVar('qty');
                        $totalharga = $this->request->getVar('hargabaru') * $data['berat'] * $this->request->getVar('qty');
                        $this->datastock->save([
                            'id_stock' => $databarang['id_stock'],
                            'qty' => $selisihqty
                        ]);
                    } else {
                        $totalharga = $this->request->getVar('hargabaru') * $data['berat'];
                    }
                    $this->modeldetailpenjualan->save([
                        'id_detail_penjualan' =>  $data['id_detail_penjualan'],
                        'harga_beli' => $this->request->getVar('hargabaru'),
                        'qty' => $this->request->getVar('qty'),
                        'total_harga' => $totalharga
                    ]);
                    $this->penjualan->save([
                        'id_penjualan' =>  $jualan['id_penjualan'],
                        'total_harga' => $this->modeldetailpenjualan->SumDataOngkosJual($this->request->getVar('iddate'))['ongkos'] + $this->modeldetailpenjualan->SumDataDetailJual($this->request->getVar('iddate'))['total_harga'],
                    ]);

                    $msg = 'Sukses';
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
            // $session = session();
            $datapenjualan = $this->penjualan->getDataPenjualan($this->request->getVar('iddate'));
            $totalharga = $this->modeldetailpenjualan->SumDataOngkosJual($this->request->getVar('iddate'))['ongkos'] + $this->modeldetailpenjualan->SumDataDetailBeliJual($this->request->getVar('iddate'))['harga_beli'];
            if ($totalharga != null) {
                $totalharga = 0;
            }
            //$datastock = $this->datastock->CheckData(1);
            $id = $this->request->getVar('id');
            $data = $this->modeldetailpenjualan->getDetailoneJual($id);
            $databarang = $this->datastock->getBarangkode($data['kode']);
            $datakartu = $this->modelkartustock->getKartuStockkode($data['kode']);

            $this->penjualan->save([
                'id_penjualan' =>  $datapenjualan['id_penjualan'],
                'total_harga' =>  $totalharga,
            ]);
            $this->datastock->save([
                'id_stock' => $databarang['id_stock'],
                'qty' => $datakartu['saldo_akhir']
            ]);
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
        $datapenjualan = [
            'datapenjualan' => $data,
            'datacust' => $this->datacust->getDataCustomer(),
        ];

        return view('barangkeluar/jual_barang', $datapenjualan);
    }
    public function DetailDataPenjualan($id)
    {
        $session = session();
        $session->set('date_id_penjualan', $id);
        $data = $this->penjualan->getDataPenjualan($id);
        $datapenjualan = [
            'datapenjualan' => $data,
            'datacust' => $this->datacust->getDataCustomer($data['id_customer']),
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
                if ($this->request->getVar('pembayaran') == 'Debit/CC') {
                    if (!$this->validate([
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
                                'debitcc' => $validation->getError('debitcc'),
                                'namabank' => $validation->getError('namabank'),
                            ]
                        ];
                    } else {
                        $datapenjualan = $this->penjualan->getDataPenjualan($this->request->getVar('dateid'));
                        $this->penjualan->save([
                            'id_penjualan' =>  $datapenjualan['id_penjualan'],
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
                    }
                }
                if ($this->request->getVar('pembayaran') == 'Debit/CCTranfer') {
                    if (!$this->validate([
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
                                'debitcc' => $validation->getError('debitcc'),
                                'namabank' => $validation->getError('namabank'),
                                'transfer' => $validation->getError('transfer'),
                            ]
                        ];
                    } else {
                        $datapenjualan = $this->penjualan->getDataPenjualan($this->request->getVar('dateid'));
                        $this->penjualan->save([
                            'id_penjualan' =>  $datapenjualan['id_penjualan'],
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
                    }
                }
                if ($this->request->getVar('pembayaran') == 'Transfer') {
                    if (!$this->validate([
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
                                'transfer' => $validation->getError('transfer'),
                                'namabank' => $validation->getError('namabank'),
                            ]
                        ];
                    } else {
                        $datapenjualan = $this->penjualan->getDataPenjualan($this->request->getVar('dateid'));
                        $this->penjualan->save([
                            'id_penjualan' =>  $datapenjualan['id_penjualan'],
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
                    }
                }
                if ($this->request->getVar('pembayaran') == 'Tunai') {
                    if (!$this->validate([
                        'tunai' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Tunai Harus di isi',
                            ]
                        ]
                    ])) {
                        $msg = [
                            'error' => [
                                'tunai' => $validation->getError('tunai'),
                            ]
                        ];
                    } else {
                        $datapenjualan = $this->penjualan->getDataPenjualan($this->request->getVar('dateid'));
                        $this->penjualan->save([
                            'id_penjualan' =>  $datapenjualan['id_penjualan'],
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
                    }
                }
                if ($this->request->getVar('pembayaran') == 'Tunai&Debit/CC') {
                    if (!$this->validate([
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
                                'debitcc' => $validation->getError('debitcc'),
                                'tunai' => $validation->getError('tunai'),
                                'namabank' => $validation->getError('namabank'),
                            ]
                        ];
                    } else {
                        $datapenjualan = $this->penjualan->getDataPenjualan($this->request->getVar('dateid'));
                        $this->penjualan->save([
                            'id_penjualan' =>  $datapenjualan['id_penjualan'],
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
                    }
                }
                if ($this->request->getVar('pembayaran') == 'Tunai&Transfer') {
                    if (!$this->validate([
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
                                'tunai' => $validation->getError('tunai'),
                                'transfer' => $validation->getError('transfer'),
                                'namabank' => $validation->getError('namabank'),
                            ]
                        ];
                    } else {
                        $datapenjualan = $this->penjualan->getDataPenjualan($this->request->getVar('dateid'));
                        $this->penjualan->save([
                            'id_penjualan' =>  $datapenjualan['id_penjualan'],
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
                $this->datastock->save([
                    'id_stock' => $databarang['id_stock'],
                    'qty' => $row['qty']
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
