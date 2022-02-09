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
use App\Models\ModelPenjualan;
use App\Models\ModelCustomer;
use App\Models\ModelDetailPenjualan;

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
        $this->detailbeli = new ModelDetailMasuk();
        $this->barangmasuk = new ModelBarangMasuk();
        $this->datasupplier = new ModelSupplier();
        $this->datakadar = new ModelKadar();
        $this->datamerek = new ModelMerek();
        $this->datapembelian = new ModelPembelian();
        $this->datastock = new ModelHome();
        $this->datacust = new ModelCustomer();
        $this->barcodeG =  new BarcodeGenerator();
        $this->penjualan =  new ModelPenjualan();
    }

    public function DataPenjualan()
    {
        // dd($this->modeldetailpenjualan->SumBeratKotorDetailjual('080222023605'));
        $data = [
            'datapenjualan' => $this->penjualan->getDataPenjualan()
        ];

        return view('barangkeluar/data_penjualan', $data);
    }
    public function PenjualanBarang()
    {
        $session = session();
        $session->remove('date_id_penjualan');
        //-------------------------------------------------------------
        $dateidjual = date('dmyhis');
        $session->set('date_id_penjualan', $dateidjual);
        $this->penjualan->save([
            // 'created_at' => date("y-m-d"),
            'id_date_penjualan' => $session->get('date_id_penjualan'),
            'nama_supplier' => '-',
            'no_transaksi_jual' => $this->NoTransaksiGenerateJual(),
            'id_customer' => '',
            'id_karyawan' => '1',
            'nama_customer' => '',
            'jumlah' => '1',
            'onkos' => '0',
            'pembulatan/diskon' => '0',
            'total_harga' => '0',
            'pembayaran' => 'Bayar Nanti',
            'tunai' => '-',
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
                'point_penjualan' => '0',

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
            $data = $this->datacust->getDataCustomerone($this->request->getVar('nama_cust'));
            if ($data) {
                $msg = 'sukses';
            } else {
                $msg = 'gagal';
            }
            echo json_encode($msg);
        }
    }
    public function InsertJual()
    {
        if ($this->request->isAJAX()) {
            $session = session();
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
                    // if ($session->get('date_id_penjualan')) {
                    // if ($this->request->getVar('pembulatan') != 0) {
                    //     $pembulatan = $this->request->getVar('pembulatan');
                    // } else {
                    //     $pembulatan = 0;
                    // }
                    $data = $this->penjualan->getDataPenjualan($session->get('date_id_penjualan'));
                    $this->modeldetailpenjualan->save([
                        'id_date_penjualan' => $session->get('date_id_penjualan'),
                        'nama_img' => $databarang['gambar'],
                        'kode' =>  $databarang['barcode'],
                        'qty' => $databarang['qty'],
                        'jenis' =>  $databarang['jenis'],
                        'model' =>  $databarang['model'],
                        'keterangan' =>  $databarang['keterangan'],
                        'berat_kotor' =>  $databarang['berat_kotor'],
                        'berat_bersih' =>  $databarang['berat_bersih'],
                        'harga_beli' =>  $databarang['total_harga'],
                        'kadar' =>   $databarang['kadar'],
                        'nilai_tukar' =>   $databarang['nilai_tukar'],
                        'merek' =>  $databarang['merek'],
                        'total_harga' => $databarang['total_harga'],
                    ]);

                    $this->penjualan->save([
                        'id_penjualan' =>  $data['id_penjualan'],
                        'nama_supplier' => $this->request->getVar('supplier'),
                        'id_customer' => $this->datacust->getDataCustomerone($this->request->getVar('inputcustomer'))['id_customer'],
                        'id_karyawan' => '1',
                        'nama_customer' => $this->request->getVar('inputcustomer'),
                        'jumlah' => '1',
                        'onkos' => '0',
                        'pembulatan/diskon' => '0',
                        'total_harga' => $this->modeldetailpenjualan->SumDataDetailJual($session->get('date_id_penjualan')),
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
                    // } else {
                    //     $dateidjual = date('dmyhis');
                    //     $session->set('date_id_penjualan', $dateidjual);
                    //     if ($this->request->getVar('pembulatan') != 0) {
                    //         $pembulatan = $this->request->getVar('pembulatan');
                    //     } else {
                    //         $pembulatan = 0;
                    //     }
                    //     $this->penjualan->save([
                    //         // 'created_at' => date("y-m-d"),
                    //         'id_date_penjualan' => $session->get('date_id_penjualan'),
                    //         'nama_supplier' => $this->request->getVar('supplier'),
                    //         'no_transaksi_jual' => $this->NoTransaksiGenerateJual(),
                    //         'id_customer' => $this->datacust->getDataCustomerone($this->request->getVar('inputcustomer'))['id_customer'],
                    //         'id_karyawan' => '1',
                    //         'nama_customer' => $this->request->getVar('inputcustomer'),
                    //         'jumlah' => '1',
                    //         'onkos' => '0',
                    //         'pembulatan/diskon' => $pembulatan,
                    //         'total_harga' => '0',
                    //         'pembayaran' => 'Bayar Nanti',
                    //         'tunai' => '-',
                    //         'debitcc' => '0',
                    //         'transfer' => '0',
                    //         'status_dokumen' => 'Draft'
                    //     ]);

                    //     $this->modeldetailpenjualan->save([
                    //         'id_date_penjualan' => $session->get('date_id_penjualan'),
                    //         'nama_img' => $databarang['gambar'],
                    //         'kode' =>  $databarang['barcode'],
                    //         'qty' => $databarang['qty'],
                    //         'jenis' =>  $databarang['jenis'],
                    //         'model' =>  $databarang['model'],
                    //         'keterangan' =>  $databarang['keterangan'],
                    //         'berat_kotor' =>  $databarang['berat_kotor'],
                    //         'berat_bersih' =>  $databarang['berat_bersih'],
                    //         'harga_beli' =>  $databarang['total_harga'],
                    //         'kadar' =>   $databarang['kadar'],
                    //         'nilai_tukar' =>   '0',
                    //         'merek' =>  $databarang['merek'],
                    //         'total_harga' => $databarang['total_harga'],
                    //     ]);

                    //     $this->datastock->save([
                    //         'id_stock' => $databarang['id_stock'],
                    //         'qty' => '0'
                    //     ]);

                    //     $idmsg = $session->get('date_id_penjualan');
                    // }
                    $msg = [
                        'pesan' => 'Berhasil',
                        // 'idmsg' => (isset($idmsg)) ? $idmsg : null
                    ];
                } else {
                    $msg = [
                        'pesan' => 'gagal',
                        'errormsg' => 'Stock Data Tidak ada'
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
            $this->modeldetailpenjualan->save([
                'id_detail_penjualan' =>  $id,
                'total_harga' => $this->request->getVar('hargabaru')
            ]);
            $msg = 'berhasil';
            echo json_encode($msg);
        }
    }

    public function DeleteDetailjual()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $datapenjualan = $this->penjualan->getDataPenjualan($session->get('date_id_penjualan'));
            //$datastock = $this->datastock->CheckData(1);
            $id = $this->request->getVar('id');
            $data = $this->modeldetailpenjualan->getDetailoneJual($id);
            $databarang = $this->datastock->getBarangkode($data['kode']);

            $this->penjualan->save([
                'id_penjualan' =>  $datapenjualan['id_penjualan'],
                'total_harga' =>  $datapenjualan['total_harga'] - $data['total_harga'],
            ]);
            $this->datastock->save([
                'id_stock' => $databarang['id_stock'],
                'qty' => $data['qty']
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
            'tampildata' => $this->modeldetailpenjualan->getDetailAllJual($id)
        ];

        return view('barangkeluar/detail_jual_barang', $datapenjualan);
    }

    public function PrintInvoice($id)
    {
        $data = [
            'datajual' => $this->penjualan->getDataPenjualan($id),
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
            $data = [
                'tampildata' => $this->modeldetailpenjualan->getDetailAlljual($session->get('date_id_penjualan')),
            ];
            $msg = [
                'data' => view('barangkeluar/detailtablejual', $data),
                'totalbersih' => $this->modeldetailpenjualan->SumDataDetailJual($session->get('date_id_penjualan')),
                'totalberatkotor' => $this->modeldetailpenjualan->SumBeratKotorDetailjual($session->get('date_id_penjualan')),
                'totalberatbersih' => $this->modeldetailpenjualan->SumBeratBersihDetailjual($session->get('date_id_penjualan')),
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
            $this->detailbeli->query('DELETE FROM tbl_detail_penjualan WHERE id_date_penjualan =' . $session->get('date_id_penjualan') . ';');
            $this->datapembelian->query('DELETE FROM tbl_penjualan WHERE id_date_penjualan =' . $session->get('date_id_penjualan') . ';');

            return redirect()->to('/barangkeluar');
        } else {
            return redirect()->to('/barangkeluar');
        }
    }

    public function penjualan_detail_read()
    {
        $session = session();
        if ($this->request->isAJAX()) {

            $msg = [
                'totalbersih' => $this->modeldetailpenjualan->SumDataDetailJual($this->request->getVar('dateid')),
                'totalberatkotor' => $this->modeldetailpenjualan->SumBeratKotorDetailjual($this->request->getVar('dateid')),
                'totalberatbersih' => $this->modeldetailpenjualan->SumBeratBersihDetailjual($this->request->getVar('dateid')),
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
