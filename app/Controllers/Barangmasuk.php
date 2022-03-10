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
use App\Models\ModelReturSales;
use App\Models\ModelDetailBuyback;
use App\Models\ModelKartuStock;
use App\Models\ModelDetailKartuStock;

use CodeIgniter\CLI\Console;
use CodeIgniter\Validation\Rules;
use PhpParser\Node\Expr\Isset_;

class Barangmasuk extends BaseController
{
    protected $detailbeli;
    protected $databarangmasuk;
    protected $datamerek;
    protected $datakadar;
    protected $datasupplier;
    protected $datapembelian;
    protected $datastock;
    protected $barcodeG;

    public function __construct()
    {

        $this->barcodeG =  new BarcodeGenerator();
        $this->detailbeli = new ModelDetailMasuk();
        $this->barangmasuk = new ModelBarangMasuk();
        $this->datasupplier = new ModelSupplier();
        $this->datakadar = new ModelKadar();
        $this->datamerek = new ModelMerek();
        $this->datapembelian = new ModelPembelian();
        $this->datastock = new ModelHome();
        $this->barcodeG =  new BarcodeGenerator();
        $this->modelpembayaran =  new ModelPembayaranBeli();
        $this->modelretur =  new ModelReturSales();
        $this->modelbuyback =  new ModelDetailBuyback();
        $this->modelkartustock = new ModelKartuStock();
        $this->modeldetailkartustock = new ModelDetailKartuStock();
    }
    public function supplier()
    {
        // dd($this->modelbuyback->getDataDetailRongsok(12200017));
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
                        ],
                        'harga_murni' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Harga Murni Harus di isi',
                            ]
                        ]
                    ]);
                }
                if ($this->request->getVar('pembayaran') == 'Tunai') {
                    $valid = $this->validate([
                        'tunai' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Tunai Harus di isi',
                            ]
                        ],
                        'harga_murni' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Harga Murni Harus di isi',
                            ]
                        ]
                    ]);
                }
                if ($this->request->getVar('pembayaran') == 'Rongsok') {
                    $valid = $this->validate([
                        'kode_rongsok' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Kode Harus di isi',
                            ]
                        ],
                        'harga_murni' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Harga Murni Harus di isi',
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
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Harga Murni Harus di isi',
                            ]
                        ]
                    ]);
                }
                if ($this->request->getVar('pembayaran') == 'ReturSales') {
                    $valid = $this->validate([
                        'kode_retur' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Kode Harus di isi',
                            ]
                        ],
                        'harga_murni' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Harga Murni Harus di isi',
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
                            'kode_rongsok' => $validation->getError('kode_rongsok'),
                            'kode_bahan24k' => $validation->getError('kode_bahan24k'),
                            'kode_retur' => $validation->getError('kode_retur'),

                        ]
                    ];
                    echo json_encode($msg);
                } else {
                    date_default_timezone_set('Asia/Jakarta');
                    $datapembelian = $this->datapembelian->getPembelianSupplier($this->request->getVar('dateid'));
                    if ($datapembelian['byr_berat_murni'] > 0) {
                        if ($this->request->getVar('pembayaran') == 'Rongsok') {
                            $datarongsok = $this->modelbuyback->getDataDetailRetur($this->request->getVar('kode_rongsok'));
                            if ($datarongsok != null && $datarongsok['status_proses'] == 'Pending') {
                                $byrberatmurni = $datapembelian['byr_berat_murni'] - $datarongsok['berat_murni'];
                                $jmlbyr = $this->request->getVar('harga_murni') * $datarongsok['berat_murni'];
                                $this->datapembelian->save([
                                    'id_pembelian' =>  $datapembelian['id_pembelian'],
                                    'cara_pembayaran' => 'Belum Selesai',
                                    'tanggal_bayar' => date("y-m-d h:m:s"),
                                    'byr_berat_murni' =>  $byrberatmurni,
                                    'harga_murni' => $this->request->getVar('harga_murni'),
                                ]);
                                $this->modelpembayaran->save([
                                    'id_date_pembelian' =>  $datapembelian['id_date_pembelian'],
                                    'nama_bank' => $this->request->getVar('namabank'),
                                    'cara_pembayaran' => $this->request->getVar('pembayaran'),
                                    'jumlah_pembayaran' => $jmlbyr,
                                    'qty' => $datarongsok['qty'],
                                    'kode_rongsok' => $this->request->getVar('kode_rongsok'),
                                    'kode_retur' => null,
                                    'kode_24k' => null,
                                    'harga_murni' => $this->request->getVar('harga_murni'),
                                    'berat_murni' => $datarongsok['berat_murni'],
                                ]);
                                $this->modelbuyback->save([
                                    'id_detail_buyback' => $datarongsok['id_detail_buyback'],
                                    'status_proses' => 'BayarRongsok'
                                ]);
                                $msg = [
                                    'pesan' => [
                                        'pesan' => 'berhasil'
                                    ]
                                ];
                            } else {
                                $msg = [
                                    'error' => [
                                        'kode_rongsok' => 'Data Tidak ada / Sudah Masuk'
                                    ]
                                ];
                            }
                        }
                        if ($this->request->getVar('pembayaran') == 'Bahan24K') {
                            $databahan24k = $this->datastock->CheckData($this->request->getVar('kode_bahan24k'));
                            if ($databahan24k != null && $databahan24k['qty'] != 0) {
                                $byrberatmurni = $datapembelian['byr_berat_murni'] - $databahan24k['berat_murni'];
                                $jmlbyr = $this->request->getVar('harga_murni') * $databahan24k['berat_murni'];
                                $this->datapembelian->save([
                                    'id_pembelian' =>  $datapembelian['id_pembelian'],
                                    'cara_pembayaran' => 'Belum Selesai',
                                    'tanggal_bayar' => date("y-m-d h:m:s"),
                                    'byr_berat_murni' =>  $byrberatmurni,
                                    'harga_murni' => $this->request->getVar('harga_murni'),
                                ]);
                                $this->modelpembayaran->save([
                                    'id_date_pembelian' =>  $datapembelian['id_date_pembelian'],
                                    'nama_bank' => $this->request->getVar('namabank'),
                                    'cara_pembayaran' => $this->request->getVar('pembayaran'),
                                    'jumlah_pembayaran' => $jmlbyr,
                                    'qty' => $databahan24k['qty'],
                                    'kode_rongsok' => null,
                                    'kode_retur' => null,
                                    'kode_24k' => $this->request->getVar('kode_bahan24k'),
                                    'harga_murni' => $this->request->getVar('harga_murni'),
                                    'berat_murni' => $databahan24k['berat_murni'],
                                ]);
                                $this->datastock->save([
                                    'id_stock' => $databahan24k['id_stock'],
                                    'qty' => 0
                                ]);
                                $msg = [
                                    'pesan' => [
                                        'pesan' => 'berhasil'
                                    ]
                                ];
                            } else {
                                $msg = [
                                    'error' => [
                                        'kode_bahan24k' => 'Data Tidak ada / Sudah Masuk'
                                    ]
                                ];
                            }
                        }
                        if ($this->request->getVar('pembayaran') == 'ReturSales') {
                            $dataretur = $this->modelbuyback->getDataDetailRetur($this->request->getVar('kode_retur'));
                            if ($dataretur != null && $dataretur['status_proses'] == 'Retur') {
                                $byrberatmurni = $datapembelian['byr_berat_murni'] - $dataretur['berat_murni'];
                                $jmlbyr = $this->request->getVar('harga_murni') * $dataretur['berat_murni'];
                                $this->datapembelian->save([
                                    'id_pembelian' =>  $datapembelian['id_pembelian'],
                                    'cara_pembayaran' => 'Belum Selesai',
                                    'tanggal_bayar' => date("y-m-d h:m:s"),
                                    'byr_berat_murni' =>  $byrberatmurni,
                                    'harga_murni' => $this->request->getVar('harga_murni'),
                                ]);
                                $this->modelpembayaran->save([
                                    'id_date_pembelian' =>  $datapembelian['id_date_pembelian'],
                                    'nama_bank' => $this->request->getVar('namabank'),
                                    'cara_pembayaran' => $this->request->getVar('pembayaran'),
                                    'jumlah_pembayaran' => $jmlbyr,
                                    'qty' => $dataretur['qty'],
                                    'kode_rongsok' => null,
                                    'kode_retur' => $this->request->getVar('kode_retur'),
                                    'kode_24k' => null,
                                    'harga_murni' => $this->request->getVar('harga_murni'),
                                    'berat_murni' => $dataretur['berat_murni'],
                                ]);
                                $this->modelbuyback->save([
                                    'id_detail_buyback' => $dataretur['id_detail_buyback'],
                                    'status_proses' => 'BayarRetur',
                                    'no_nota_jual' => $datapembelian['no_transaksi']
                                ]);
                                $msg = [
                                    'pesan' => [
                                        'pesan' => 'berhasil'
                                    ]
                                ];
                            } else {
                                $msg = [
                                    'error' => [
                                        'kode_retur' => 'Data Tidak ada / Sudah Masuk'
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

                            $beratmurni = round($jumlah_pembayaran / $this->request->getVar('harga_murni'), 2);
                            $byrberatmurni = round($datapembelian['byr_berat_murni'] - $beratmurni, 2);
                            $this->datapembelian->save([
                                'id_pembelian' =>  $datapembelian['id_pembelian'],
                                'cara_pembayaran' => 'Belum Selesai',
                                'tanggal_bayar' => date("y-m-d h:m:s"),
                                'byr_berat_murni' =>  $byrberatmurni,
                                'harga_murni' => $this->request->getVar('harga_murni'),
                            ]);
                            $this->modelpembayaran->save([
                                'id_date_pembelian' =>  $datapembelian['id_date_pembelian'],
                                'nama_bank' => $this->request->getVar('namabank'),
                                'cara_pembayaran' => $this->request->getVar('pembayaran'),
                                'jumlah_pembayaran' => $jumlah_pembayaran,
                                'kode_rongsok' => '-',
                                'kode_retur' => '-',
                                'kode_24k' => '-',
                                'harga_murni' => $this->request->getVar('harga_murni'),
                                'berat_murni' => $beratmurni,
                            ]);
                            $msg = [
                                'pesan' => [
                                    'pesan' => 'berhasil'
                                ]
                            ];
                        }
                        echo json_encode($msg);
                    } else {
                        $this->datapembelian->save([
                            'id_pembelian' =>  $datapembelian['id_pembelian'],
                            'cara_pembayaran' => 'Lunas',
                        ]);
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

    public function EditDataPost()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
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
                'jenis' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Harus di isi',
                    ]
                ],
                'berat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Berat Harus di isi',
                    ]
                ],
                'harga_beli' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Berat Bersih Harus di isi',
                    ]
                ],
                'ongkos' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Ongkos Harus di isi',
                    ]
                ],

            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'qty' => $validation->getError('qty'),
                        'nilai_tukar' => $validation->getError('nilai_tukar'),
                        'jenis' => $validation->getError('jenis'),
                        'berat' => $validation->getError('berat'),
                        'harga_beli' => $validation->getError('harga_beli'),
                        'ongkos' => $validation->getError('ongkos'),
                    ]
                ];
                echo json_encode($msg);
            } else {

                $databeli = $this->detailbeli->getDetailKode($this->request->getVar('kode'));
                $kode = substr($this->request->getVar('kode'), 0, 1);
                $qty = $this->request->getVar('qty');
                $harga = $this->request->getVar('harga_beli');
                $berat = $this->request->getVar('berat');
                $beratmurni = $berat * ($this->request->getVar('nilai_tukar') / 100);
                if ($kode == 1 || 4 || 5) {
                    $totalharga =  $beratmurni *  $harga;
                }
                if ($kode == 2) {
                    $totalharga = $harga;
                }
                if ($kode == 3) {
                    $totalharga =  $beratmurni *  $harga * $qty;
                }

                $this->detailbeli->save([
                    'id_detail_pembelian' => $databeli['id_detail_pembelian'],
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

                $databeli = $this->datapembelian->getPembelianSupplier($this->request->getVar('dateid'));
                $this->datapembelian->save([
                    'id_pembelian' =>  $databeli['id_pembelian'],
                    'total_bayar' => $this->detailbeli->SumDataDetail($this->request->getVar('dateid')),

                ]);

                $msg = $databeli['id_date_pembelian'];
                echo json_encode($msg);
            }
        }
    }
    public function detail_pembelian()
    {
        $session = session();
        $dateid = date("ymdhis");
        $session->set('date_id', $dateid);
        $notransaksi = $this->NoTransaksiGenerate();
        $this->datapembelian->save([
            'id_date_pembelian' => $session->get('date_id'),
            'nama_supplier' => '-',
            'id_karyawan' => '2',
            // 'no_faktur_supp' => '-',
            'no_transaksi' => $notransaksi,
            'tgl_faktur' => date('Y-m-d h:i:s'),
            // 'total_berat_murni' => 0,
            'byr_berat_murni' => 0,
            'tgl_jatuh_tempo' => date('Y-m-d h:i:s'),
            'cara_pembayaran' => 'Bayar Nanti',
            'total_bayar' => 0,
            'status_dokumen' => 'Draft'
        ]);
        return redirect()->to('/draft/' . $dateid);
    }
    public function pembelian_read()
    {
        $session = session();
        if ($this->request->isAJAX()) {
            if ($session->get('date_id')) {
                $data = [
                    'tampildata' => $this->detailbeli->getDetailAll($session->get('date_id'))
                ];

                $msg = [
                    'data' => view('barangmasuk/detailtable', $data),
                    'totalbersih' => $this->detailbeli->SumDataDetail($session->get('date_id')),
                    'totalberat' => $this->detailbeli->SumBeratDetail($session->get('date_id')),
                    'totalberatmurni' => $this->detailbeli->SumBeratMurniDetail($session->get('date_id')),
                    'totalqty' => $this->detailbeli->SumQty($session->get('date_id'))
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
            if ($filesampul->getError() != 4 || $this->request->getPost('gambar')) {
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
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Total Berat Murni Harus di isi',
                        ]
                    ],
                    'jenis' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Jenis Harus di isi',
                        ]
                    ],
                    'berat' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Berat Harus di isi',
                        ]
                    ],
                    'harga_beli' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Berat Bersih Harus di isi',
                        ]
                    ],
                    'ongkos' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Ongkos Harus di isi',
                        ]
                    ],
                ]);
            } else {
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
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Total Berat Murni Harus di isi',
                        ]
                    ],
                    'jenis' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Jenis Harus di isi',
                        ]
                    ],
                    'berat' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Berat Harus di isi',
                        ]
                    ],
                    'harga_beli' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Berat Bersih Harus di isi',
                        ]
                    ],
                    'ongkos' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Ongkos Harus di isi',
                        ]
                    ],
                    'gambar' => [
                        'rules' => 'uploaded[gambar]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                        'errors' => [
                            'uploaded' => 'gambar harus diisi',
                            'mime_in' => 'extention tidak cocok',
                            'is_image' => 'Bukan Gambar',

                        ]
                    ]
                ]);
            }
            if (!$valid) {
                $msg = [
                    'error' => [
                        'no_nota_supp' => $validation->getError('no_nota_supp'),
                        'qty' => $validation->getError('qty'),
                        'total_berat_m' => $validation->getError('total_berat_m'),
                        'nilai_tukar' => $validation->getError('nilai_tukar'),
                        'jenis' => $validation->getError('jenis'),
                        'berat' => $validation->getError('berat'),
                        'harga_beli' => $validation->getError('harga_beli'),
                        'ongkos' => $validation->getError('ongkos'),
                        'gambar' => $validation->getError('gambar'),
                    ]
                ];
                echo json_encode($msg);
            } else {
                $session = session();
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
                        $namafile = 'default.jpg';
                    } else {
                        $namafile = $filesampul->getRandomName(); // pake nama random
                        // $namafile = $filesampul->getName(); // ini pake nama asli di foto
                        $filesampul->move('img', $namafile);
                    }
                }
                // $dateid = $session->get('date_id');
                $datapembelian1 = $this->datapembelian->getPembelianSupplier($session->get('date_id'));
                $kode = $this->request->getVar('kelompok');
                $qty = $this->request->getVar('qty');
                $harga = $this->request->getVar('harga_beli');
                $berat = $this->request->getVar('berat');
                $beratmurni = $berat * ($this->request->getVar('nilai_tukar') / 100);
                if ($kode == 1 || 4 || 5) {
                    $totalharga =  $beratmurni *  $harga;
                }
                if ($kode == 2) {
                    $totalharga = $harga;
                }
                if ($kode == 3) {
                    $totalharga =  $beratmurni *  $harga * $qty;
                }
                if ($this->request->getVar('barcode')) {
                    $barcode = $this->request->getVar('barcode');
                } else {
                    $barcode = $this->KodeDatailGenerate($kode);
                }
                $this->detailbeli->save([
                    'created_at' => $this->request->getVar('tanggal_input'),
                    'id_date_pembelian' => $session->get('date_id'),
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
                    'created_at' => $this->request->getVar('tanggal_input'),
                    'id_date_pembelian' => $session->get('date_id'),
                    'nama_supplier' => $this->request->getVar('supplier'),
                    'id_karyawan' => '2',
                    'no_faktur_supp' => $this->request->getVar('no_nota_supp'),
                    'no_transaksi' => $datapembelian1['no_transaksi'],
                    'tgl_faktur' => $this->request->getVar('tanggal_nota_sup') . ' ' . date('h:i:s'),
                    'total_berat_murni' => $this->request->getVar('total_berat_m'),
                    'byr_berat_murni' => $this->request->getVar('total_berat_m'),
                    'tgl_jatuh_tempo' => $this->request->getVar('tanggal_tempo') . ' ' . date('h:i:s'),
                    'cara_pembayaran' => 'Bayar Nanti',
                    'total_bayar' => $this->detailbeli->SumDataDetail($session->get('date_id')),
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
            $datapembelian = $this->datapembelian->getPembelianSupplier($session->get('date_id'));
            //$datastock = $this->datastock->CheckData(1);
            $id = $this->request->getVar('id');
            $data = $this->detailbeli->getDetailone($id);
            $this->datapembelian->save([
                'id_pembelian' =>  $datapembelian['id_pembelian'],
                'total_bayar' =>  $datapembelian['total_bayar'] - $data['total_harga'],
            ]);

            if ($data['nama_img'] != 'default.jpg') {
                unlink('img/' . $data['nama_img']); //untuk hapus file
            }
            $this->detailbeli->delete($id);

            $msg = [
                'sukses' => 'Berhasil'
            ];
            echo json_encode($msg);
        }
    }
    public function DeletePembayaran()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $databayar = $this->modelpembayaran->getDetailPembayaran($id);
            $datapembelian = $this->datapembelian->getPembelianSupplier($databayar['id_date_pembelian']);
            if ($databayar['cara_pembayaran'] == 'Rongsok') {
                $datarongsok = $this->modelbuyback->getDataDetailRongsok($databayar['kode_rongsok']);
                $this->modelbuyback->save([
                    'id_detail_buyback' => $datarongsok['id_detail_buyback'],
                    'status_proses' => 'Pending'
                ]);
            }
            if ($databayar['cara_pembayaran'] == 'Bahan24K') {
                $databahan24k = $this->datastock->CheckData($databayar['kode_24k']);
                $this->datastock->save([
                    'id_stock' => $databahan24k['id_stock'],
                    'qty' => $databayar['qty']
                ]);
            }
            if ($databayar['cara_pembayaran'] == 'ReturSales') {
                $dataretur = $this->modelretur->getDetailRetur($databayar['kode_retur']);
                $this->modelretur->save([
                    'id_retur' => $dataretur['id_retur'],
                    'status_proses' => 'Pending'
                ]);
            }

            $byrberatmurni = $datapembelian['byr_berat_murni'] + $databayar['berat_murni'];
            $this->datapembelian->save([
                'id_pembelian' =>  $datapembelian['id_pembelian'],
                'byr_berat_murni' =>  $byrberatmurni,
            ]);
            $this->modelpembayaran->delete($id);
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
            $data = $this->detailbeli->getDetailAll($session->get('date_id'));
            $datapembelian = $this->datapembelian->getPembelianSupplier($session->get('date_id'));
            $this->datapembelian->save([
                'id_pembelian' =>  $datapembelian['id_pembelian'],
                'total_bayar' =>  0,
            ]);
            foreach ($data as $row) {
                if ($row['nama_img'] != 'default.jpg') {
                    unlink('img/' . $row['nama_img']); //untuk hapus file
                }
            }
            $this->detailbeli->query('DELETE FROM tbl_detail_pembelian WHERE id_date_pembelian =' . $session->get('date_id') . ';');

            $msg = [
                'sukses' => 'Berhasil hapus semua'
            ];
            echo json_encode($msg);
        }
    }

    function MasukDraft($id)
    {
        $session = session();
        $session->set('date_id', $id);
        $data = $this->datapembelian->getPembelianSupplier($id);
        // dd($data['id_pembelian']);
        $datapembelian = [
            'datapembelian' => $data,
            'merek' => $this->datamerek->getMerek(),
            'kadar' => $this->datakadar->getKadar(),
            'supplier' => $this->datasupplier->getSupplier(),
            // 'databarcode' => $this->datastock->getBarcode()

        ];

        return view('barangmasuk/pembelian_supplier', $datapembelian);
    }

    function DetailPembelianSupp($id)
    {

        $data = [
            'datapembelian' => $this->datapembelian->getPembelianSupplier($id),
            'tampildata' =>  $this->detailbeli->getDetailAll($id),
            'tampil24k' =>  $this->datastock->getKodeBahan24k(),
            'tampilretur' =>  $this->modelbuyback->getDataRetur(),
            'databarang' => $this->detailbeli->getDetailAll($id),
            'totalberat' => $this->detailbeli->SumBeratDetail($id),
            'totalberatmurni' => $this->detailbeli->SumBeratMurniDetail($id),
            'merek' => $this->datamerek->getMerek(),
            'kadar' => $this->datakadar->getKadar(),
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
                $datadetailbeli = $this->detailbeli->getDetailAll($this->request->getVar('dateid'));
                if ($datadetailbeli) {
                    $totalbersih = $this->detailbeli->SumDataDetail($this->request->getVar('dateid'));
                    $totalharga = $totalbersih['total_harga'];
                    $datapembelian = $this->datapembelian->getPembelianSupplier($this->request->getVar('dateid'));
                    //$datastock = $this->datastock->CheckData(1);
                    $this->datapembelian->save([
                        'id_pembelian' =>  $datapembelian['id_pembelian'],
                        'created_at' => $this->request->getVar('tanggal_input'),
                        'nama_supplier' => $this->request->getVar('supplier'),
                        'id_karyawan' => '2',
                        'no_faktur_supp' => $this->request->getVar('no_nota_supp'),
                        'no_transaksi' => $datapembelian['no_transaksi'],
                        'tgl_faktur' => $this->request->getVar('tanggal_nota_sup'),
                        'total_berat_murni' => $this->request->getVar('total_berat_m'),
                        'byr_berat_murni' => $this->request->getVar('total_berat_m'),
                        'tgl_jatuh_tempo' => $this->request->getVar('tanggal_tempo'),
                        'total_berat_rill' => $this->detailbeli->SumBeratDetail($this->request->getVar('dateid'))['berat'],
                        'berat_murni_rill' => $this->detailbeli->SumBeratMurniDetail($this->request->getVar('dateid'))['berat_murni'],
                        'total_qty' => $this->detailbeli->SumQty($this->request->getVar('dateid'))['qty'],
                        'total_bayar' =>  $totalharga,
                        'status_dokumen' => 'Selesai'
                    ]);
                    foreach ($datadetailbeli as $row) {
                        $datacheck = $this->datastock->CheckData($row['kode']);
                        if ($datacheck) {
                            $datadetailkartu = $this->modeldetailkartustock->getKartuDetailStockKode($row['kode']);
                            $datakartu = $this->modelkartustock->getKartuStockkode($row['kode']);
                            $this->datastock->save([
                                'id_stock' => $datacheck['id_stock'],
                                'status' => $this->StatusBarang(substr($row['kode'], 0, 1)),
                                'no_faktur' => $datapembelian['no_faktur_supp'],
                                'tgl_faktur' => $datapembelian['tgl_faktur'],
                                'nama_supplier' => $datapembelian['nama_supplier'],
                                'qty' => (substr($row['kode'], 0, 1) == 4) ? $row['qty'] : $row['qty'] + $datacheck['qty'],
                                'jenis' => $row['jenis'],
                                'model' => $row['model'],
                                'keterangan' => $row['keterangan'],
                                'merek' => $row['merek'],
                                'kadar' => $row['kadar'],
                                'berat_murni' => $row['berat_murni'],
                                'berat' => (substr($row['kode'], 0, 1) == 4) ? $row['berat'] + $datakartu['saldo_akhir'] : $row['berat'],
                                'nilai_tukar' =>  $row['nilai_tukar'],
                                'ongkos' => $row['ongkos'],
                                'harga_beli' => $row['harga_beli'],
                                'total_harga' => $row['total_harga'] + $datacheck['total_harga'],
                            ]);
                            $saldoakhir = (substr($row['kode'], 0, 1) == 4) ? $row['berat'] + $datakartu['saldo_akhir'] : $row['qty'] + $datakartu['saldo_akhir'];
                            $this->modeldetailkartustock->save([
                                // 'id_detail_kartustock' => $datadetailkartu['id_detail_kartustock'],
                                'barcode' => $row['kode'],
                                'status' => $this->StatusBarang(substr($row['kode'], 0, 1)),
                                'no_faktur' => $datapembelian['no_faktur_supp'],
                                'tgl_faktur' => $datapembelian['tgl_faktur'],
                                'nama_customer' => $datapembelian['nama_supplier'],
                                'saldo' => $saldoakhir,
                                'masuk' => (substr($row['kode'], 0, 1) == 4) ? $row['berat'] : $row['qty'],
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

                            $this->modelkartustock->save([
                                'id_kartustock' => $datakartu['id_kartustock'],
                                'total_masuk' => $this->modeldetailkartustock->SumMasukKartu($row['kode']),
                                'total_keluar' => $this->modeldetailkartustock->SumKeluarKartu($row['kode']),
                                'saldo_akhir' => $saldoakhir,
                            ]);
                        } else {
                            $this->datastock->save([
                                'barcode' => $row['kode'],
                                'status' => $this->StatusBarang(substr($row['kode'], 0, 1)),
                                'no_faktur' => $datapembelian['no_faktur_supp'],
                                'tgl_faktur' => $datapembelian['tgl_faktur'],
                                'nama_supplier' => $datapembelian['nama_supplier'],
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
                            $this->modelkartustock->save([
                                'total_masuk' => 0,
                                'total_keluar' => 0,
                                'saldo_akhir' => (substr($row['kode'], 0, 1) == 4) ? $row['berat'] : $row['qty'],
                                'kode' => $row['kode']
                            ]);
                            $this->modeldetailkartustock->save([
                                'barcode' => $row['kode'],
                                'status' => $this->StatusBarang(substr($row['kode'], 0, 1)),
                                'no_faktur' => $datapembelian['no_faktur_supp'],
                                'tgl_faktur' => $datapembelian['tgl_faktur'],
                                'nama_customer' => $datapembelian['nama_supplier'],
                                'saldo' => (substr($row['kode'], 0, 1) == 4) ? $row['berat'] : $row['qty'],
                                'masuk' => (substr($row['kode'], 0, 1) == 4) ? $row['berat'] : $row['qty'],
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
            $data = $this->detailbeli->getDetailAll($session->get('date_id'));
            foreach ($data as $row) {
                if ($row['nama_img'] != 'default.jpg') {
                    unlink('img/' . $row['nama_img']); //untuk hapus file
                }
            }
            $this->detailbeli->query('DELETE FROM tbl_detail_pembelian WHERE id_date_pembelian =' . $session->get('date_id') . ';');
            $this->datapembelian->query('DELETE FROM tbl_pembelian WHERE id_date_pembelian =' . $session->get('date_id') . ';');
            echo json_encode($this->request->getVar('dateid'));
        }
    }
    public function ReturBarang($id)
    {
        $datapembelian = $this->datapembelian->getPembelianSupplier($this->request->getVar('dateid'));
        //$datastock = $this->datastock->CheckData(1);
        $data = $this->detailbeli->getDetailone($id);
        $this->datapembelian->save([
            'id_pembelian' =>  $datapembelian['id_pembelian'],
            'total_berat_rill' => $this->detailbeli->SumBeratDetail($this->request->getVar('dateid'))['berat'],
            'berat_murni_rill' => $this->detailbeli->SumBeratMurniDetail($this->request->getVar('dateid'))['berat_murni'],
            'total_qty' => $this->detailbeli->SumQty($this->request->getVar('dateid'))['qty'],
            'total_bayar' =>  $datapembelian['total_bayar'] - $data['total_harga'],
        ]);

        // if ($data['nama_img'] != 'default.jpg') {
        //     unlink('img/' . $data['nama_img']); //untuk hapus file
        // }
        $this->modelretur->save([
            'kode' => $data['kode'],
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
}
