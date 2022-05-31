<?php

namespace App\Controllers;

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use App\Models\ModelStock1;
use App\Models\ModelStock2;
use App\Models\ModelStock3;
use App\Models\ModelStock4;
use App\Models\ModelStock5;
use App\Models\ModelStock6;
use App\Models\ModelKartuStock;
use App\Models\ModelKartuStock5;
use App\Models\ModelKartuStock6;
use App\Models\ModelDetailKartuStock;
use App\Models\ModelDetailKartuStock5;
use App\Models\ModelDetailKartuStock6;
use App\Models\ModelStockOpname;
use App\Models\ModelKadar;
use App\Models\ModelMerek;
use App\Models\ModelJenis;


use CodeIgniter\Validation\Rules;
use app\Config\Cache;
use Config\Cache as ConfigCache;

class StockOpname extends BaseController
{

    public function __construct()
    {

        $this->modelstockopname = new ModelStockOpname();
        $this->barcodeG =  new BarcodeGenerator();
        $this->datastock = new ModelStock1();
        $this->datastock2 = new ModelStock2();
        $this->datastock3 = new ModelStock3();
        $this->datastock4 = new ModelStock4();
        $this->datastock5 = new ModelStock5();
        $this->datastock6 = new ModelStock6();
        $this->modelkartustock = new ModelKartuStock();
        $this->modeldetailkartustock = new ModelDetailKartuStock();
        $this->modelkartustock5 = new ModelKartuStock5();
        $this->modeldetailkartustock5 = new ModelDetailKartuStock5();
        $this->modelkartustock6 = new ModelKartuStock6();
        $this->modeldetailkartustock6 = new ModelDetailKartuStock6();
        $this->datakadar = new ModelKadar();
        $this->datamerek = new ModelMerek();
        $this->datajenis = new ModelJenis();


        $this->chace = new ConfigCache();
    }

    public function HomeOpname()
    {
        $data = [
            'merek' => $this->datamerek->getMerek(),
            'jenis' => $this->datajenis->getJenis(),
            'kadar' => $this->datakadar->getKadar(),
        ];
        return view('stockopname/stock_opname', $data);
    }
    public function TampilOpname()
    {
        if ($this->request->isAJAX()) {
            if ($this->request->getVar('status') == 'sdh') {
                $dataopname = $this->modelstockopname->getKellBarang($this->request->getVar('kel'));
            } else {
                $dataopname = $this->modelstockopname->BelumOpname($this->request->getVar('kel'));
            }
            $data = [
                'dataopname' => $dataopname,
                'stat' => $this->request->getVar('status'),
                'kel' => $this->request->getVar('kel')
            ];
            if ($this->request->getVar('kel') == 1) {
                $jumlah_barang = $this->datastock->CountDataStock()['barcode'];
                $belum_opname = $this->datastock->SisahOpname()['barcode'];
            } elseif ($this->request->getVar('kel') == 2) {
                $jumlah_barang = $this->datastock2->CountDataStock()['barcode'];
                $belum_opname = $this->datastock2->SisahOpname()['barcode'];
            } elseif ($this->request->getVar('kel') == 3) {
                $jumlah_barang = $this->datastock3->CountDataStock()['barcode'];
                $belum_opname = $this->datastock3->SisahOpname()['barcode'];
            } elseif ($this->request->getVar('kel') == 4) {
                $jumlah_barang = $this->datastock4->CountDataStock()['barcode'];
                $belum_opname = $this->datastock4->SisahOpname()['barcode'];
            } elseif ($this->request->getVar('kel') == 5) {
                $jumlah_barang = $this->datastock5->CountDataStock()['barcode'];
                $belum_opname = $this->datastock5->SisahOpname()['barcode'];
            } elseif ($this->request->getVar('kel') == 6) {
                $jumlah_barang = $this->datastock6->CountDataStock()['barcode'];
                $belum_opname = $this->datastock6->SisahOpname()['barcode'];
            }
            $msg = [
                'tampildata' => view('stockopname/tabelstockopname', $data),
                'sisa_opname' => $this->modelstockopname->CountDataOpname($this->request->getVar('kel'))['jumlah'],
                'jumlah_barang' => $jumlah_barang,
                'belum_opname' => $belum_opname,
            ];

            echo json_encode($msg);
        }
    }
    public function TampilModalDetail()
    {
        if ($this->request->isAJAX()) {

            if ($this->request->getVar('kel') == 1) {
                $data = [
                    'barang' => $this->datastock->getBarangBarcode($this->request->getVar('barcode')),
                    'kel' => $this->request->getVar('kel')
                ];
            } elseif ($this->request->getVar('kel') == 2) {
                $data = [
                    'barang' => $this->datastock2->getBarangBarcode($this->request->getVar('barcode')),
                    'kel' => $this->request->getVar('kel')
                ];
            } elseif ($this->request->getVar('kel') == 3) {
                $data = [
                    'barang' => $this->datastock3->getBarangBarcode($this->request->getVar('barcode')),
                    'kel' => $this->request->getVar('kel')
                ];
            } elseif ($this->request->getVar('kel') == 4) {
                $data = [
                    'barang' => $this->datastock4->getBarangBarcode($this->request->getVar('barcode')),
                    'kel' => $this->request->getVar('kel')
                ];
            } elseif ($this->request->getVar('kel') == 5) {
                $data = [
                    'barang' => $this->datastock5->getBarangBarcode($this->request->getVar('barcode')),
                    'kel' => $this->request->getVar('kel')
                ];
            } elseif ($this->request->getVar('kel') == 6) {
                $data = [
                    'barang' => $this->datastock6->getBarangBarcode($this->request->getVar('barcode')),
                    'kel' => $this->request->getVar('kel')
                ];
            }

            $msg = [
                'tampilmodal' => view('stockopname/modaldetailopname', $data),
            ];

            echo json_encode($msg);
        }
    }
    public function EditOpname()
    {
        if ($this->request->isAJAX()) {

            if ($this->request->getVar('kel') == 1) {
                $data = [
                    'barang' => $this->datastock->getBarang($this->request->getVar('iddetail')),
                    'kel' => $this->request->getVar('kel'),
                    'merek' => $this->datamerek->getMerek(),
                    'jenis' => $this->datajenis->getJenis(),
                    'kadar' => $this->datakadar->getKadar(),
                ];
            } elseif ($this->request->getVar('kel') == 2) {
                $data = [
                    'barang' => $this->datastock2->getBarang($this->request->getVar('iddetail')),
                    'kel' => $this->request->getVar('kel'),
                    'merek' => $this->datamerek->getMerek(),
                    'jenis' => $this->datajenis->getJenis(),
                    'kadar' => $this->datakadar->getKadar(),
                ];
            } elseif ($this->request->getVar('kel') == 3) {
                $data = [
                    'barang' => $this->datastock3->getBarang($this->request->getVar('iddetail')),
                    'kel' => $this->request->getVar('kel'),
                    'merek' => $this->datamerek->getMerek(),
                    'jenis' => $this->datajenis->getJenis(),
                    'kadar' => $this->datakadar->getKadar(),
                ];
            } elseif ($this->request->getVar('kel') == 4) {
                $data = [
                    'barang' => $this->datastock4->getBarang($this->request->getVar('iddetail')),
                    'kel' => $this->request->getVar('kel'),
                    'merek' => $this->datamerek->getMerek(),
                    'jenis' => $this->datajenis->getJenis(),
                    'kadar' => $this->datakadar->getKadar(),
                ];
            } elseif ($this->request->getVar('kel') == 5) {
                $data = [
                    'barang' => $this->datastock5->getBarang($this->request->getVar('iddetail')),
                    'kel' => $this->request->getVar('kel'),
                    'merek' => $this->datamerek->getMerek(),
                    'jenis' => $this->datajenis->getJenis(),
                    'kadar' => $this->datakadar->getKadar(),
                ];
            } elseif ($this->request->getVar('kel') == 6) {
                $data = [
                    'barang' => $this->datastock6->getBarang($this->request->getVar('iddetail')),
                    'kel' => $this->request->getVar('kel'),
                    'merek' => $this->datamerek->getMerek(),
                    'jenis' => $this->datajenis->getJenis(),
                    'kadar' => $this->datakadar->getKadar(),
                ];
            }
            $view = view('stockopname/modaledit', $data);
            $msg = ['tampildata' => $view];
            echo json_encode($msg);
        }
    }
    public function CariBarcode()
    {
        if ($this->request->isAJAX()) {
            $kel = substr($this->request->getVar('barcode'), 0, 1);
            if ($kel == 1) {
                $data = $this->datastock->getBarangBarcode($this->request->getVar('barcode'));
            } elseif ($kel == 2) {
                $data = $this->datastock2->getBarangBarcode($this->request->getVar('barcode'));
            } elseif ($kel == 3) {
                $data = $this->datastock3->getBarangBarcode($this->request->getVar('barcode'));
            } elseif ($kel == 4) {
                $data = $this->datastock4->getBarangBarcode($this->request->getVar('barcode'));
            } elseif ($kel == 5) {
                $data = $this->datastock5->getBarangBarcode($this->request->getVar('barcode'));
            } elseif ($kel == 6) {
                $data = $this->datastock6->getBarangBarcode($this->request->getVar('barcode'));
            } else {
                $data = null;
            }
            if ($data) {
                $data1 = [
                    'barang' => $data,
                    'kel' => $kel
                ];
                $msg = ['tampildetail' => view('stockopname/modaldetailopname', $data1)];
            } else {
                $msg = ['error' => 'Data Tidak Ada / Sudah Masuk'];
            }
            echo json_encode($msg);
        }
    }
    public function PilihBarangOpname()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $kel = $this->request->getVar('kel');
            if ($kel == 1) {
                $data = $this->datastock->getBarangOpnameId($this->request->getVar('iddetail'));
            } elseif ($kel == 2) {
                $data = $this->datastock2->getBarangOpnameId($this->request->getVar('iddetail'));
            } elseif ($kel == 3) {
                $data = $this->datastock3->getBarangOpnameId($this->request->getVar('iddetail'));
            } elseif ($kel == 4) {
                $data = $this->datastock4->getBarangOpnameId($this->request->getVar('iddetail'));
            } elseif ($kel == 5) {
                $data = $this->datastock5->getBarangOpnameId($this->request->getVar('iddetail'));
            } elseif ($kel == 6) {
                $data = $this->datastock6->getBarangOpnameId($this->request->getVar('iddetail'));
            }
            if ($data) {
                $check = $this->modelstockopname->getBarcodeData($data['barcode']);
                if (!$check) {
                    $this->modelstockopname->save([
                        'barcode' => $data['barcode'],
                        'id_karyawan' => $session->get('id_user'),
                        'status' => $data['status'],
                        'tgl_faktur' => $data['tgl_faktur'],
                        'no_faktur' => $data['no_faktur'],
                        'tgl_faktur' => $data['tgl_faktur'],
                        'nama_supplier' => $data['nama_supplier'],
                        'qty' => $data['qty'],
                        'jenis' => $data['jenis'],
                        'model' => $data['model'],
                        'keterangan' => $data['keterangan'],
                        'merek' => (isset($data['merek'])) ? $data['merek'] : '-',
                        'kadar' => (isset($data['kadar'])) ? $data['kadar'] : '-',
                        'berat_murni' => (isset($data['berat_murni'])) ? $data['berat'] : 0,
                        'berat' => (isset($data['berat'])) ? $data['berat'] : 0,
                        'nilai_tukar' => (isset($data['nilai_tukar'])) ? $data['nilai_tukar'] : 0,
                        'ongkos' => (isset($data['ongkos'])) ? $data['ongkos'] : 0,
                        'harga_beli' => $data['harga_beli'],
                        'total_harga' => $data['total_harga'],
                        'gambar' =>  $data['gambar'],
                    ]);
                    $msg = 'sukses';
                } else {
                    $msg = ['error' => 'Data Tidak Ada'];
                }
            } else {
                $msg = ['error' => 'Data Tidak Ada'];
            }
            echo json_encode($msg);
        }
    }
    public function HapusOpname()
    {
        if ($this->request->isAJAX()) {

            $this->modelstockopname->delete($this->request->getVar('iddetail'));
            $msg = 'sukses';
            echo json_encode($msg);
        }
    }

    public function SelesaiEdit()
    {

        if ($this->request->isAJAX()) {
            date_default_timezone_set('Asia/Jakarta');
            $validation = \Config\Services::validation();
            // if ($filesampul->getError() != 4 || $this->request->getPost('gambar')) {
            if ($this->request->getVar('kel') == 1) {
                $valid = $this->validate([
                    'nilai_tukar' => [
                        'rules' => 'required|greater_than[0]',
                        'errors' => [
                            'required' => 'Nilai Tukar Harus di isi',
                            'greater_than' => 'TIdak Boleh 0'
                        ]
                    ],
                ]);
            }
            if ($this->request->getVar('kel') == 1 || $this->request->getVar('kel') == 2 || $this->request->getVar('kel') == 3 || $this->request->getVar('kel') == 4) {
                $valid = $this->validate([
                    'berat' => [
                        'rules' => 'required|greater_than[0]',
                        'errors' => [
                            'required' => 'Berat Harus di isi',
                            'greater_than' => 'TIdak Boleh 0'
                        ]
                    ],

                ]);
            }
            if ($this->request->getVar('kel') == 5) {
                $valid = $this->validate([
                    'carat' => [
                        'rules' => 'required|greater_than[0]',
                        'errors' => [
                            'required' => 'Nilai Tukar Harus di isi',
                            'greater_than' => 'TIdak Boleh 0'
                        ]
                    ],
                ]);
            }
            $valid = $this->validate([
                'jenis' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Harus di isi',
                        'greater_than' => 'TIdak Boleh 0'

                    ]
                ],

                'harga_beli' => [
                    'rules' => 'required|greater_than[0]',
                    'errors' => [
                        'required' => 'Berat Bersih Harus di isi',
                        'greater_than' => 'TIdak Boleh 0'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nilai_tukar' => $validation->getError('nilai_tukar'),
                        'jenis' => $validation->getError('jenis'),
                        'berat' => $validation->getError('berat'),
                        'carat' => $validation->getError('carat'),
                        'harga_beli' => $validation->getError('harga_beli'),
                        'gambar' => $validation->getError('gambar'),
                    ]
                ];
                echo json_encode($msg);
            } else {
                $session = session();
                $kel = $this->request->getVar('kel');
                if ($kel == 1) {
                    $datastock = $this->datastock->getBarang($this->request->getVar('iddetail'));
                } elseif ($kel == 2) {
                    $datastock = $this->datastock2->getBarang($this->request->getVar('iddetail'));
                } elseif ($kel == 3) {
                    $datastock = $this->datastock3->getBarang($this->request->getVar('iddetail'));
                } elseif ($kel == 4) {
                    $datastock = $this->datastock4->getBarang($this->request->getVar('iddetail'));
                } elseif ($kel == 5) {
                    $datastock = $this->datastock5->getBarang($this->request->getVar('iddetail'));
                } elseif ($kel == 6) {
                    $datastock = $this->datastock6->getBarang($this->request->getVar('iddetail'));
                }
                $check = $this->modelstockopname->getBarcodeData($datastock['barcode']);
                if (!$check) {
                    $filesampul = $this->request->getFile('gambar');
                    if ($this->request->getPost('gambar') || $filesampul->getError() != 4) {
                        if (file_exists('img/' . $datastock['gambar'])) {
                            if ($datastock['gambar'] == 'default.jpg') {
                                $micro_date = microtime();
                                $date_array = explode(" ", $micro_date);
                                $date = date("ymdis", $date_array[1]);
                                $namafile = $date . $date_array[0] . '.jpg';
                            } else {
                                unlink('img/' . $datastock['gambar']);
                                $namafile = $datastock['gambar'];
                            }
                        } else {
                            $namafile = $datastock['gambar'];
                        }
                        if ($this->request->getPost('gambar')) {
                            $image = $this->request->getPost('gambar');
                            $image = str_replace('data:image/jpeg;base64,', '', $image);
                            $image = base64_decode($image, true);
                            file_put_contents(FCPATH . '/img/' . $namafile, $image);
                        } else {
                            $filesampul = $this->request->getFile('gambar');
                            if ($filesampul->getError() == 4) {
                                $namafile = 'default.jpg';
                            } else {
                                // $namafile = $filesampul->getRandomName(); // pake nama random
                                // $namafile = $filesampul->getName(); // ini pake nama asli di foto
                                $filesampul->move('img', $namafile);
                            }
                        }
                        if ($kel == 1) {
                            $this->datastock->save([
                                'id_stock_1' => $datastock['id_stock_1'],
                                'id_karyawan' => $session->get('id_user'),
                                'gambar' =>  $namafile,
                            ]);
                        } elseif ($kel == 2) {
                            $this->datastock->save([
                                'id_stock_2' => $datastock['id_stock_2'],
                                'id_karyawan' => $session->get('id_user'),
                                'gambar' =>  $namafile,
                            ]);
                        } elseif ($kel == 3) {
                            $this->datastock->save([
                                'id_stock_3' => $datastock['id_stock_3'],
                                'id_karyawan' => $session->get('id_user'),
                                'gambar' =>  $namafile,
                            ]);
                        } elseif ($kel == 4) {
                            $this->datastock->save([
                                'id_stock_4' => $datastock['id_stock_4'],
                                'id_karyawan' => $session->get('id_user'),
                                'gambar' =>  $namafile,
                            ]);
                        } elseif ($kel == 5) {
                            $this->datastock->save([
                                'id_stock_5' => $datastock['id_stock_5'],
                                'id_karyawan' => $session->get('id_user'),
                                'gambar' =>  $namafile,
                            ]);
                        } elseif ($kel == 6) {
                            $this->datastock->save([
                                'id_stock_6' => $datastock['id_stock_6'],
                                'id_karyawan' => $session->get('id_user'),
                                'gambar' =>  $namafile,
                            ]);
                        }
                    } else {
                        $namafile = $datastock['gambar'];
                    }
                    $qty = $this->request->getVar('qty');
                    $harga = $this->request->getVar('harga_beli');
                    $kadar = ($this->request->getVar('kadar')) ? $this->request->getVar('kadar') : '-';
                    $merek = ($this->request->getVar('merek')) ? $this->request->getVar('merek') : '-';
                    $berat = ($this->request->getVar('berat')) ? $this->request->getVar('berat') : 0;
                    $carat =  ($this->request->getVar('carat')) ? $this->request->getVar('carat') : 0;
                    $ongkos = ($this->request->getVar('ongkos')) ? $this->request->getVar('ongkos') : 0;
                    $nilaitkr = ($this->request->getVar('nilai_tukar')) ? $this->request->getVar('nilai_tukar') : 0;
                    if ($kel == 1) {
                        $beratmurni = round($berat * ($this->request->getVar('nilai_tukar') / 100), 2);
                        $totalharga =  ($beratmurni * $harga) + $ongkos;
                    } elseif ($kel == 2) {
                        $beratmurni = 0;
                        $totalharga = $harga;
                    } elseif ($kel == 3) {
                        $totalharga = $berat *  $harga * $qty;
                        $beratmurni = 0;
                    } elseif ($kel == 4) {
                        $totalharga = $berat * $harga;
                        $beratmurni = 0;
                    } elseif ($kel == 5) {
                        $totalharga =  $carat *  $harga;
                        $beratmurni = 0;
                    } elseif ($kel == 6) {
                        $totalharga = $harga * $qty;
                        $beratmurni = 0;
                    }
                    $this->modelstockopname->save([
                        'barcode' => $datastock['barcode'],
                        'id_karyawan' => $session->get('id_user'),
                        'status' => $datastock['status'],
                        'tgl_faktur' => $datastock['tgl_faktur'],
                        'no_faktur' => $datastock['no_faktur'],
                        'tgl_faktur' => $datastock['tgl_faktur'],
                        'nama_supplier' => $datastock['nama_supplier'],
                        'qty' => $this->request->getVar('qty'),
                        'jenis' =>  $this->request->getVar('jenis'),
                        'model' => $this->request->getVar('model'),
                        'keterangan' => $this->request->getVar('keterangan'),
                        'merek' => $merek,
                        'kadar' => $kadar,
                        'berat_murni' => $beratmurni,
                        'berat' => $berat,
                        'carat' => $carat,
                        'nilai_tukar' =>  $nilaitkr,
                        'ongkos' =>  $ongkos,
                        'harga_beli' =>  $harga,
                        'total_harga' => $totalharga,
                        'gambar' =>  $namafile,
                    ]);
                    $msg = [
                        'sukses' => $totalharga
                    ];
                } else {
                    $msg = [
                        'error' => [
                            'error' => 'Data Tidak Ada'
                        ]
                    ];
                }
                echo json_encode($msg);
            }
        }
    }

    public function SelesaiOpname()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $checkdataopname = $this->modelstockopname->getBarang();
            if ($checkdataopname) {
                foreach ($checkdataopname as $row) {
                    $kel = substr($row['barcode'], 0, 1);
                    if ($kel == 1) {
                        $datastock = $this->datastock->getBarangBarcode($row['barcode']);
                        $this->KartuStockMaster($row['barcode'], $session);
                        $datakartu = $this->modelkartustock->getKartuStockkode($row['barcode']);
                        $saldobaru = $row['qty'];
                        if ($datakartu['saldo_akhir'] <= $row['qty']) {
                            $selisihsaldo = round($row['qty'] - $datakartu['saldo_akhir'], 2);
                            $status = 'Masuk';
                        } else {
                            $selisihsaldo = round($datakartu['saldo_akhir'] - $row['qty'], 2);
                            $status = 'Keluar';
                        }
                        $this->datastock->save([
                            'id_stock_1' => $datastock['id_stock_1'],
                            'id_karyawan' => $session->get('id_user'),
                            'qty' => $row['qty'],
                            'jenis' =>  $row['jenis'],
                            'model' => $row['model'],
                            'keterangan' => $row['keterangan'],
                            'merek' => $row['merek'],
                            'kadar' => $row['kadar'],
                            'berat' => $row['berat'],
                            'nilai_tukar' =>  $row['nilai_tukar'],
                            'harga_beli' =>  $row['harga_beli'],
                            'total_harga' => $row['total_harga'],
                            'gambar' =>  $row['gambar'],
                        ]);
                    } elseif ($kel == 2) {
                        $datastock = $this->datastock2->getBarangBarcode($row['barcode']);
                        $this->KartuStockMaster($row['barcode'], $session);
                        $datakartu = $this->modelkartustock->getKartuStockkode($row['barcode']);
                        $saldobaru = $row['qty'];
                        if ($datakartu['saldo_akhir'] <= $row['qty']) {
                            $selisihsaldo = round($row['qty'] - $datakartu['saldo_akhir'], 2);
                            $status = 'Masuk';
                        } else {
                            $selisihsaldo = round($datakartu['saldo_akhir'] - $row['qty'], 2);
                            $status = 'Keluar';
                        }
                        $this->datastock2->save([
                            'id_stock_2' => $datastock['id_stock_2'],
                            'id_karyawan' => $session->get('id_user'),
                            'qty' => $row['qty'],
                            'jenis' =>  $row['jenis'],
                            'model' => $row['model'],
                            'keterangan' => $row['keterangan'],
                            'merek' => $row['merek'],
                            'kadar' => $row['kadar'],
                            'berat' => $row['berat'],
                            'harga_beli' =>  $row['harga_beli'],
                            'total_harga' => $row['total_harga'],
                            'gambar' =>  $row['gambar'],
                        ]);
                    } elseif ($kel == 3) {
                        $datastock = $this->datastock3->getBarangBarcode($row['barcode']);
                        $this->KartuStockMaster($row['barcode'], $session);
                        $datakartu = $this->modelkartustock->getKartuStockkode($row['barcode']);
                        $saldobaru = $row['qty'];
                        if ($datakartu['saldo_akhir'] <= $row['qty']) {
                            $selisihsaldo = round($row['qty'] - $datakartu['saldo_akhir'], 2);
                            $status = 'Masuk';
                        } else {
                            $selisihsaldo = round($datakartu['saldo_akhir'] - $row['qty'], 2);
                            $status = 'Keluar';
                        }
                        $this->datastock3->save([
                            'id_stock_3' => $datastock['id_stock_3'],
                            'id_karyawan' => $session->get('id_user'),
                            'qty' => $row['qty'],
                            'jenis' =>  $row['jenis'],
                            'model' => $row['model'],
                            'keterangan' => $row['keterangan'],
                            'merek' => $row['merek'],
                            'kadar' => $row['kadar'],
                            'berat' => $row['berat'],
                            'harga_beli' =>  $row['harga_beli'],
                            'total_harga' => $row['total_harga'],
                            'gambar' =>  $row['gambar'],
                        ]);
                    } elseif ($kel == 4) {
                        $datastock = $this->datastock4->getBarangBarcode($row['barcode']);
                        $this->KartuStockMaster($row['barcode'], $session);
                        $datakartu = $this->modelkartustock->getKartuStockkode($row['barcode']);
                        $saldobaru = $row['berat'];
                        if ($datakartu['saldo_akhir'] <= $row['berat']) {
                            $selisihsaldo = round($row['berat'] - $datakartu['saldo_akhir'], 2);
                            $status = 'Masuk';
                        } else {
                            $selisihsaldo = round($datakartu['saldo_akhir'] - $row['berat'], 2);
                            $status = 'Keluar';
                        }
                        $this->datastock4->save([
                            'id_stock_4' => $datastock['id_stock_4'],
                            'id_karyawan' => $session->get('id_user'),
                            'qty' => $row['qty'],
                            'jenis' =>  $row['jenis'],
                            'model' => $row['model'],
                            'keterangan' => $row['keterangan'],
                            'kadar' => $row['kadar'],
                            'berat' => $row['berat'],
                            'harga_beli' =>  $row['harga_beli'],
                            'total_harga' => $row['total_harga'],
                            'gambar' =>  $row['gambar'],
                        ]);
                    } elseif ($kel == 5) {
                        $this->KartuStockMaster5($row['barcode'], $session, 'opname');
                        $datastock = $this->datastock5->getBarangBarcode($row['barcode']);
                        $this->KartuStockMaster($row['barcode'], $session);
                        $datakartu = $this->modelkartustock5->getKartuStockkode($row['barcode']);
                        $saldobaru = $row['qty'];
                        if ($datakartu['saldo_akhir'] <= $row['qty']) {
                            $selisihsaldo = $row['qty'] - $datakartu['saldo_akhir'];
                            $status = 'Masuk';
                        } else {
                            $selisihsaldo = $datakartu['saldo_akhir'] - $row['qty'];
                            $status = 'Keluar';
                        }
                        $this->datastock5->save([
                            'id_stock_5' => $datastock['id_stock_5'],
                            'id_karyawan' => $session->get('id_user'),
                            'qty' => $row['qty'],
                            'jenis' =>  $row['jenis'],
                            'model' => $row['model'],
                            'keterangan' => $row['keterangan'],
                            'merek' => $row['merek'],
                            'carat' => $row['carat'],
                            'harga_beli' =>  $row['harga_beli'],
                            'total_harga' => $row['total_harga'],
                            'gambar' =>  $row['gambar'],
                        ]);
                    } elseif ($kel == 6) {
                        $datastock = $this->datastock6->getBarangBarcode($row['barcode']);
                        $this->KartuStockMaster($row['barcode'], $session);
                        $datakartu = $this->modelkartustock->getKartuStockkode($row['barcode']);
                        $saldobaru = $row['qty'];
                        if ($datakartu['saldo_akhir'] <= $row['qty']) {
                            $selisihsaldo = round($row['qty'] - $datakartu['saldo_akhir'], 2);
                            $status = 'Masuk';
                        } else {
                            $selisihsaldo = round($datakartu['saldo_akhir'] - $row['qty'], 2);
                            $status = 'Keluar';
                        }
                        $this->datastock6->save([
                            'id_stock_6' => $datastock['id_stock_6'],
                            'id_karyawan' => $session->get('id_user'),
                            'qty' => $row['qty'],
                            'jenis' =>  $row['jenis'],
                            'model' => $row['model'],
                            'keterangan' => $row['keterangan'],
                            'merek' => $row['merek'],
                            'harga_beli' =>  $row['harga_beli'],
                            'total_harga' => $row['total_harga'],
                            'gambar' =>  $row['gambar'],
                        ]);
                    }

                    if ($kel == 1 || $kel == 2 || $kel == 3 || $kel == 4) {
                        $this->modeldetailkartustock->save([
                            'barcode' => $row['barcode'],
                            'status' => $status,
                            'id_karyawan' => $session->get('id_user'),
                            'no_faktur' => 'Stock Opname',
                            'tgl_faktur' => date('Y-m-d H:i:s'),
                            'nama_customer' => $session->get('nama_user'),
                            'saldo' => $saldobaru,
                            'masuk' => ($status == 'Masuk') ? $selisihsaldo : 0,
                            'keluar' => ($status == 'Keluar') ? $selisihsaldo : 0,
                            'jenis' => $row['jenis'],
                            'model' => $row['model'],
                            'keterangan' => 'Stock Opname',
                            'merek' => $row['merek'],
                            'kadar' => $row['kadar'],
                            'berat' => $row['berat'],
                            'nilai_tukar' =>  $row['nilai_tukar'],
                            'harga_beli' => $row['harga_beli'],
                            'total_harga' => $row['total_harga'],
                            'gambar' =>  $row['gambar'],
                        ]);
                        $this->KartuStockMaster($row['barcode'], $session);
                        $this->modelstockopname->delete($row['id_stock_opname']);
                    } elseif ($kel == 5) {
                        $this->modeldetailkartustock5->save([
                            'barcode' => $row['barcode'],
                            'status' => $status,
                            'id_karyawan' => $session->get('id_user'),
                            'no_faktur' => 'Stock Opname',
                            'tgl_faktur' => date('Y-m-d H:i:s'),
                            'nama_customer' => $session->get('nama_user'),
                            'saldo' => $row['qty'],
                            'saldo_carat' => $row['carat'],
                            'masuk' => ($status == 'Masuk') ? $selisihsaldo : 0,
                            'keluar' => ($status == 'Keluar') ? $selisihsaldo : 0,
                            'jenis' => $row['jenis'],
                            'model' => $row['model'],
                            'keterangan' => 'Stock Opname',
                            'merek' => $row['merek'],
                            'kadar' => $row['kadar'],
                            'carat' => $row['carat'],
                            'nilai_tukar' =>  $row['nilai_tukar'],
                            'harga_beli' => $row['harga_beli'],
                            'total_harga' => $row['total_harga'],
                            'gambar' =>  $row['gambar'],
                        ]);
                        $this->KartuStockMaster5($row['barcode'], $session, $row['carat']);
                        $this->modelstockopname->delete($row['id_stock_opname']);
                    } elseif ($kel == 6) {
                        $this->modeldetailkartustock6->save([
                            'barcode' => $row['barcode'],
                            'status' => $status,
                            'id_karyawan' => $session->get('id_user'),
                            'no_faktur' => 'Stock Opname',
                            'tgl_faktur' => date('Y-m-d H:i:s'),
                            'nama_customer' => $session->get('nama_user'),
                            'saldo' => $row['qty'],
                            'saldo_carat' => $saldobaru,
                            'masuk' => ($status == 'Masuk') ? $selisihsaldo : 0,
                            'keluar' => ($status == 'Keluar') ? $selisihsaldo : 0,
                            'jenis' => $row['jenis'],
                            'model' => $row['model'],
                            'keterangan' => 'Stock Opname',
                            'harga_beli' => $row['harga_beli'],
                            'total_harga' => $row['total_harga'],
                            'gambar' =>  $row['gambar'],
                        ]);
                        $this->KartuStockMaster6($row['barcode'], $session);
                        $this->modelstockopname->delete($row['id_stock_opname']);
                    }

                    $msg = 'berhasil';
                }
            } else {
                $msg = [
                    'error' => 'Tidak ada data opname'
                ];
            }


            echo json_encode($msg);
        }
    }
}
