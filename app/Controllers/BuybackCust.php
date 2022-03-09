<?php

namespace App\Controllers;

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use App\Models\ModelDetailBuyback;
use App\Models\ModelPenjualan;
use App\Models\ModelDetailPenjualan;
use App\Models\ModelKadar;
use App\Models\ModelMerek;
use App\Models\ModelSupplier;
use App\Models\ModelHome;


use CodeIgniter\Model;
use CodeIgniter\Validation\Rules;
use Faker\Provider\ar_EG\Person;
use PhpParser\Node\Expr\Isset_;

class BuybackCust extends BaseController
{


    public function __construct()
    {
        $this->modeldetailpenjualan =  new ModelDetailPenjualan();
        $this->barcodeG =  new BarcodeGenerator();
        $this->barcodeG =  new BarcodeGenerator();
        $this->penjualan =  new ModelPenjualan();
        $this->modeldetailbuyback = new ModelDetailBuyback();
        $this->datasupplier = new ModelSupplier();
        $this->datakadar = new ModelKadar();
        $this->datamerek = new ModelMerek();
        $this->datastock = new ModelHome();
    }
    public function BuyBack()
    {
        $data = [
            'databuyback' => $this->modeldetailbuyback->getDetailAllBuyback(),
            'merek' => $this->datamerek->getMerek(),
            'kadar' => $this->datakadar->getKadar(),
            'supplier' => $this->datasupplier->getSupplier()

        ];
        return view('buybackcust/data_buyback', $data);
    }
    public function AdaNota()
    {
        $data = [
            'merek' => $this->datamerek->getMerek(),
            'kadar' => $this->datakadar->getKadar(),
            'supplier' => $this->datasupplier->getSupplier()

        ];

        return view('buybackcust/buyback_barang', $data);
    }
    public function Cari_notrans()
    {
        if ($this->request->isAJAX()) {
            $datatrans = $this->penjualan->getDataNoTrans($this->request->getVar('notrans'));
            if ($datatrans != null && $datatrans['pembayaran'] != 'Bayar Nanti') {
                $data = [
                    'tampildata' => $this->modeldetailpenjualan->getDetailAlljual($datatrans['id_date_penjualan']),
                    'tampildatabuyback' => $this->modeldetailbuyback->getDetailAllBuyback(),

                ];
                $msg = [
                    'data' => view('buybackcust/detailtablebuyback', $data),
                ];
            } else {
                $msg = [
                    'pesan_error' => 'Tidak ada Data No Trans'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function TampilBuyback()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $data = $this->modeldetailpenjualan->getDetailoneJual($id);
            $msg = [
                'data' => $data
            ];
            echo json_encode($msg);
        }
    }


    public function TambahBuybackNonota()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $filesampul = $this->request->getFile('gambar');
            if ($this->request->getVar('pembayaran') == 'Transfer') {

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
                        'gambar' => [
                            'rules' => 'uploaded[gambar]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                            'errors' => [
                                'uploaded' => 'gambar harus diisi',
                                'mime_in' => 'extention tidak cocok',
                                'is_image' => 'Bukan Gambar',

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

                    ]);
                }
            }
            if ($this->request->getVar('pembayaran') == 'Tunai') {

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
                        'tunai' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Tunai Harus di isi',
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
                        'gambar' => [
                            'rules' => 'uploaded[gambar]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                            'errors' => [
                                'uploaded' => 'gambar harus diisi',
                                'mime_in' => 'extention tidak cocok',
                                'is_image' => 'Bukan Gambar',

                            ]
                        ],
                        'tunai' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Tunai Harus di isi',
                            ]
                        ],

                    ]);
                }
            }
            if ($this->request->getVar('pembayaran') == 'Tunai&Transfer' || $this->request->getVar('pembayaran') == null) {

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
                        'gambar' => [
                            'rules' => 'uploaded[gambar]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                            'errors' => [
                                'uploaded' => 'gambar harus diisi',
                                'mime_in' => 'extention tidak cocok',
                                'is_image' => 'Bukan Gambar',

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

                    ]);
                }
            }
            if (!$valid) {
                $msg = [
                    'error' => [
                        'qty' => $validation->getError('qty'),
                        'nilai_tukar' => $validation->getError('nilai_tukar'),
                        'jenis' => $validation->getError('jenis'),
                        'berat' => $validation->getError('berat'),
                        'harga_beli' => $validation->getError('harga_beli'),
                        'gambar' => $validation->getError('gambar'),
                        'tunai' => $validation->getError('tunai'),
                        'transfer' => $validation->getError('transfer'),
                        'namabank' => $validation->getError('namabank'),
                        'pembayaran' => 'Pembayaran Harus di Isi',


                    ]
                ];
                echo json_encode($msg);
            } else {
                if ($this->request->getPost('gambar')) {
                    $image = $this->request->getPost('gambar');
                    $image = str_replace('data:image/jpeg;base64,', '', $image);
                    $image = base64_decode($image, true);
                    $namafile = date('ymdhis') . '.jpg';
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
                //$id = $this->request->getVar('id');
                $kode = 9;
                $qty = $this->request->getVar('qty');
                $harga = $this->request->getVar('harga_beli');
                $berat = $this->request->getVar('berat');
                $beratmurni = $berat * ($this->request->getVar('nilai_tukar') / 100);
                if ($kode == 1 || 4 || 5 || 9) {
                    $totalharga =  $beratmurni *  $harga;
                }
                if ($kode == 2) {
                    $totalharga = $harga;
                }
                if ($kode == 3) {
                    $totalharga =  $beratmurni *  $harga * $qty;
                }
                $barcode = $this->KodeDatailGenerate($this->request->getVar('kelompok'));
                $this->modeldetailbuyback->save([
                    'nama_img' => $namafile,
                    'id_date_buyback' => date('ymdhis'),
                    'kode' =>  $barcode,
                    'qty' => $this->request->getVar('qty'),
                    'jenis' =>  $this->request->getVar('jenis'),
                    'model' =>  $this->request->getVar('model'),
                    'status' => $this->request->getVar('status_proses'),
                    'keterangan' =>  $this->request->getVar('keterangan'),
                    'berat' =>  $this->request->getVar('berat'),
                    'berat_murni' =>  $beratmurni,
                    'harga_beli' =>  $this->request->getVar('harga_beli'),
                    'ongkos' => 0,
                    'kadar' =>   $this->request->getVar('kadar'),
                    'nilai_tukar' => $this->request->getVar('nilai_tukar'),
                    'merek' => $this->request->getVar('merek'),
                    'cara_pembayaran' => $this->request->getVar('pembayaran'),
                    'total_harga' => $totalharga,
                    'nama_bank' => $this->request->getVar('namabank'),
                    'tunai' => $this->request->getVar('tunai'),
                    'transfer' => $this->request->getVar('transfer'),
                    'no_nota' => 'NoNota',
                    'status_proses' => $this->request->getVar('status_proses')
                ]);

                $this->datastock->save([
                    'barcode' => $barcode,
                    'status' => $this->request->getVar('status_proses'),
                    'no_faktur' => 'NoFaktur',
                    'tgl_faktur' => 'NoFaktur',
                    'nama_supplier' => 'Buyback',
                    'qty' => 0,
                    'jenis' =>  $this->request->getVar('jenis'),
                    'model' =>  $this->request->getVar('model'),
                    'keterangan' =>  $this->request->getVar('keterangan'),
                    'merek' => $this->request->getVar('merek'),
                    'kadar' =>   $this->request->getVar('kadar'),
                    'berat' =>  $this->request->getVar('berat'),
                    'berat_murni' =>  $beratmurni,
                    'nilai_tukar' => $this->request->getVar('nilai_tukar'),
                    'ongkos' => 0,
                    'harga_beli' =>  $this->request->getVar('harga_beli'),
                    'total_harga' => $totalharga,
                    'kode_beli' =>  'JN',
                    'gambar' =>  $namafile,
                ]);
                $msg = 'sukses';
                echo json_encode($msg);
            }
        }
    }

    public function DetailBuyback($id)
    {
        $data = $this->modeldetailbuyback->getDetailBuyback($id)[0];
        // dd($data);
        $barcode = $this->barcodeG;
        $barcode->setText($data['kode']);
        $barcode->setType(BarcodeGenerator::Code128);
        $barcode->setScale(2);
        $barcode->setThickness(25);
        $barcode->setFontSize(10);
        $code = $barcode->generate();
        //echo '<img src="data:image/png;base64,' . $code . '" />';
        $data1 = [
            'barang' => $data,
            'barcode' => '<img src="data:image/png;base64,' . $code . '" />',
            // 'img' => $this->barangmodel->getImg($id)
        ];

        return view('buybackcust/detail_barang_buyback', $data1);
    }

    public function TambahBuyback()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            if ($this->request->getVar('pembayaran') == 'Transfer') {
                $valid = $this->validate([
                    'nilai_tukar' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Nilai Tukar Harus di isi',
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

                ]);
            }
            if ($this->request->getVar('pembayaran') == 'Tunai') {
                $valid = $this->validate([
                    'nilai_tukar' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Nilai Tukar Harus di isi',
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
                    'tunai' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Tunai Harus di isi',
                        ]
                    ],

                ]);
            }
            if ($this->request->getVar('pembayaran') == 'Tunai&Transfer' || $this->request->getVar('pembayaran') == null) {
                $valid = $this->validate([
                    'nilai_tukar' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Nilai Tukar Harus di isi',
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

                ]);
            }

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nilai_tukar' => $validation->getError('nilai_tukar'),
                        'berat' => $validation->getError('berat'),
                        'harga_beli' => $validation->getError('harga_beli'),
                        'tunai' => $validation->getError('tunai'),
                        'transfer' => $validation->getError('transfer'),
                        'namabank' => $validation->getError('namabank'),
                        'pembayaran' => 'Pembayaran Harus di Isi',
                    ]
                ];
                echo json_encode($msg);
            } else {
                $id = $this->request->getVar('id');
                $databarang = $this->modeldetailpenjualan->getDetailoneJual($id);
                $datamaster = $this->datastock->getBarangkode($databarang['kode']);
                $kode = substr($databarang['kode'], 0, 1);
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
                $datapenjualan = $this->penjualan->getDataPenjualan($databarang['id_date_penjualan']);
                $this->modeldetailbuyback->save([
                    'nama_img' => $databarang['nama_img'],
                    'id_date_buyback' => $databarang['id_date_penjualan'],
                    'kode' =>  $databarang['kode'],
                    'qty' => $databarang['qty'],
                    'jenis' =>  $databarang['jenis'],
                    'model' =>  $databarang['model'],
                    'status' => $this->request->getVar('status_proses'),
                    'keterangan' =>  $databarang['keterangan'],
                    'berat' =>  $this->request->getVar('berat'),
                    'berat_murni' =>  $beratmurni,
                    'harga_beli' =>  $this->request->getVar('harga_beli'),
                    'ongkos' => $databarang['ongkos'],
                    'kadar' =>   $databarang['kadar'],
                    'nilai_tukar' => $this->request->getVar('nilai_tukar'),
                    'merek' => $databarang['merek'],
                    'cara_pembayaran' => $this->request->getVar('pembayaran'),
                    'total_harga' => $totalharga + $this->request->getVar('ongkos'),
                    'nama_bank' => $this->request->getVar('namabank'),
                    'tunai' => $this->request->getVar('tunai'),
                    'transfer' => $this->request->getVar('transfer'),
                    'no_nota' => $datapenjualan['no_transaksi_jual'],
                    'status_proses' => $this->request->getVar('status_proses')
                ]);
                // $this->datastock->save([
                //     'id_stock' => $datamaster['id_stock'],
                //     'qty' => $databarang['qty']
                // ]);
                $msg = 'sukses';
                echo json_encode($msg);
            }
        }
    }

    public function KodeDatailGenerate($id)
    {
        $kodestock = $this->datastock->getKodeStock($id);
        $kodedetail = $this->modeldetailbuyback->getKode($id);

        if ($this->datastock->getKodeStock($id) || $this->modeldetailbuyback->getKode($id)) {
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
}
