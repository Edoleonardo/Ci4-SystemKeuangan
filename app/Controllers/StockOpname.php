<?php

namespace App\Controllers;

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use App\Models\ModelHome;
use App\Models\ModelKartuStock;
use App\Models\ModelDetailKartuStock;
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

        $this->barcodeG =  new BarcodeGenerator();
        $this->modelhome = new ModelHome();
        $this->modelkartustock = new ModelKartuStock();
        $this->modeldetailkartustock = new ModelDetailKartuStock();
        $this->modelstockopname = new ModelStockOpname();
        $this->datakadar = new ModelKadar();
        $this->datamerek = new ModelMerek();
        $this->datajenis = new ModelJenis();


        $this->chace = new ConfigCache();
    }

    public function HomeOpname()
    {

        return view('home/stock_opname');
    }
    public function TampilOpname()
    {
        if ($this->request->isAJAX()) {
            if ($this->request->getVar('pilihan') == 'sudah') {
                $dataopname = $this->modelstockopname->getBarang();
            } else {
                $dataopname = $this->modelhome->BelumOpname();
            }
            $data = [
                'dataopname' => $dataopname
            ];
            $msg = [
                'tampildata' => view('home/tabelstockopname', $data),
                'sisa_opname' => $this->modelstockopname->CountDataOpname()['barcode'],
                'jumlah_barang' => $this->modelhome->CountDataStock()['barcode'],
                'belum_opname' => $this->modelhome->SisahOpname()['barcode'],
            ];

            echo json_encode($msg);
        }
    }
    public function TampilModalDetail()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'barang' => $this->modelhome->getBarang($this->request->getVar('no_id'))
            ];
            $msg = [
                'tampilmodal' => view('home/modaldetailopname', $data),
            ];

            echo json_encode($msg);
        }
    }
    public function EditOpname()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'barang' => $this->modelhome->getBarang($this->request->getVar('iddetail')),
                'merek' => $this->datamerek->getMerek(),
                'jenis' => $this->datajenis->getJenis(),
                'kadar' => $this->datakadar->getKadar(),
            ];
            $msg = [
                'tampilmodaledit' => view('home/modaleditopname', $data),
            ];
            echo json_encode($msg);
        }
    }
    public function CariBarcode()
    {
        if ($this->request->isAJAX()) {
            if ($this->request->getVar('barcode')) {
                $data = $this->modelhome->getBarangOpname($this->request->getVar('barcode'));
            } else {
                $data = null;
            }
            if ($data) {
                $msg = ['id' => $data['id_stock']];
            } else {
                $msg = ['error' => 'Data Tidak Ada'];
            }
            echo json_encode($msg);
        }
    }
    public function PilihBarangOpname()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $data = $this->modelhome->getBarangOpnameId($this->request->getVar('iddetail'));
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
                    'merek' => $data['merek'],
                    'kadar' => $data['kadar'],
                    'berat_murni' => $data['berat_murni'],
                    'berat' => $data['berat'],
                    'nilai_tukar' =>  $data['nilai_tukar'],
                    'ongkos' => $data['ongkos'],
                    'kode_beli' => $data['kode_beli'],
                    'harga_beli' => $data['harga_beli'],
                    'total_harga' => $data['total_harga'],
                    'gambar' =>  $data['gambar'],
                ]);
                $msg = 'sukses';
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
            $filesampul = $this->request->getFile('gambar');
            // if ($filesampul->getError() != 4 || $this->request->getPost('gambar')) {
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
                        'qty' => $validation->getError('qty'),
                        'nilai_tukar' => $validation->getError('nilai_tukar'),
                        'jenis' => $validation->getError('jenis'),
                        'berat' => $validation->getError('berat'),
                        'harga_beli' => $validation->getError('harga_beli'),
                        'gambar' => $validation->getError('gambar'),
                    ]
                ];
                echo json_encode($msg);
            } else {
                $session = session();
                $datastock = $this->modelhome->getBarang($this->request->getVar('iddetail'));
                $check = $this->modelstockopname->getBarcodeData($datastock['barcode']);
                if (!$check) {
                    if ($this->request->getPost('gambar') && $filesampul->getError() == 4) {
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
                                $namafile = $filesampul->getRandomName(); // pake nama random
                                // $namafile = $filesampul->getName(); // ini pake nama asli di foto
                                $filesampul->move('img', $namafile);
                            }
                        }

                        $this->modelhome->save([
                            'id_stock' => $datastock['id_stock'],
                            'id_karyawan' => $session->get('id_user'),
                            'gambar' =>  $namafile,
                        ]);
                    } else {
                        $namafile = $datastock['gambar'];
                    }
                    $qty = $this->request->getVar('qty');
                    $harga = $this->request->getVar('harga_beli');
                    $berat = $this->request->getVar('berat');
                    $beratmurni = round($berat * ($this->request->getVar('nilai_tukar') / 100), 2);
                    $kode = substr($datastock['barcode'], 0, 1);
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
                        'merek' => $this->request->getVar('merek'),
                        'kadar' => $this->request->getVar('kadar'),
                        'berat_murni' => $datastock['berat_murni'],
                        'berat' => $this->request->getVar('berat'),
                        'nilai_tukar' =>  $this->request->getVar('nilai_tukar'),
                        'ongkos' => $this->request->getVar('ongkos'),
                        'kode_beli' => $datastock['kode_beli'],
                        'harga_beli' =>  $this->request->getVar('harga_beli'),
                        'total_harga' => $totalharga + $this->request->getVar('ongkos'),
                        'gambar' =>  $namafile,
                    ]);
                    $msg = [
                        'sukses' => 'berhasil'
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
                    $datastock = $this->modelhome->getBarangBarcode($row['barcode']);
                    $this->KartuStockMaster($row['barcode'], $session);
                    $kode = substr($row['barcode'], 0, 1);
                    $datakartu = $this->modelkartustock->getKartuStockkode($row['barcode']);
                    $saldobaru = ($kode == 4) ? $row['berat'] : $row['qty'];
                    if ($datakartu['saldo_akhir'] <= $saldobaru) {
                        $selisihsaldo = round($saldobaru - $datakartu['saldo_akhir'], 2);
                        $status = 'Masuk';
                    } else {
                        $selisihsaldo = round($datakartu['saldo_akhir'] - $saldobaru, 2);
                        $status = 'Keluar';
                    }

                    $this->modelhome->save([
                        'id_stock' => $datastock['id_stock'],
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
                        'total_harga' => $row['harga_beli'],
                        'gambar' =>  $row['gambar'],
                    ]);

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
    public function OpenScanBarcode()
    {
        if ($this->request->isAJAX()) {

            $msg = [
                'openscan' => view('modaldetail/scanbarcodecam')
            ];
            echo json_encode($msg);
        }
    }
}
