<?php

namespace App\Controllers;

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use App\Models\ModelDetailBuyback;
use App\Models\ModelPenjualan;
use App\Models\ModelDetailPenjualan;
use App\Models\ModelKadar;
use App\Models\ModelMerek;
use App\Models\ModelSupplier;
use App\Models\ModelStock1;
use App\Models\ModelStock2;
use App\Models\ModelStock3;
use App\Models\ModelStock4;
use App\Models\ModelStock5;
use App\Models\ModelStock6;
use App\Models\ModelBuyback;
use App\Models\ModelKartuStock;
use App\Models\ModelKartuStock5;
use App\Models\ModelKartuStock6;
use App\Models\ModelDetailKartuStock;
use App\Models\ModelDetailKartuStock5;
use App\Models\ModelDetailKartuStock6;
use App\Models\ModelBank;
use App\Models\ModelCustomer;
use App\Models\ModelJenis;
use App\Models\ModelTransaksi;
use App\Models\ModelDetailTransaksi;

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
        $this->datastock = new ModelStock1();
        $this->datastock2 = new ModelStock2();
        $this->datastock3 = new ModelStock3();
        $this->datastock4 = new ModelStock4();
        $this->datastock5 = new ModelStock5();
        $this->datastock6 = new ModelStock6();
        $this->modelbuyback = new ModelBuyback();
        $this->modelkartustock = new ModelKartuStock();
        $this->modelkartustock5 = new ModelKartuStock5();
        $this->modelkartustock6 = new ModelKartuStock6();
        $this->modeldetailkartustock = new ModelDetailKartuStock();
        $this->modeldetailkartustock5 = new ModelDetailKartuStock5();
        $this->modeldetailkartustock6 = new ModelDetailKartuStock6();
        $this->modelbank = new ModelBank();
        $this->datacust = new ModelCustomer();
        $this->datajenis = new ModelJenis();
        $this->modeldetailtransaksi = new ModelDetailTransaksi();
        $this->modeltransaksi = new ModelTransaksi();
    }

    public function BuyBack()
    {
        // $asd = $this->modeldetailbuyback->JumlahDataBuyback(220311121607);
        // dd($asd['total']);
        $data = [
            'databuyback' => $this->modelbuyback->getDataBuyback(),

        ];
        return view('buybackcust/data_buyback', $data);
    }

    public function HalamanTambah()
    {
        $session = session();
        $nobuyback = $this->NoTransaksiGenerateBuyback();
        $dateidbuyback = date('ymdhis') . substr($nobuyback, 6, 4);
        $this->modelbuyback->save([
            // 'created_at' => date("y-m-d"),
            'id_date_buyback' => $dateidbuyback,
            'no_transaksi_buyback' => $nobuyback,
            'id_karyawan' => $session->get('id_user'),
            'total_berat' => 0,
            'kelompok' => 0,
            'jumlah' => '0',
            'total_harga' => '0',
            'pembayaran' => 'Bayar Nanti',
            'tunai' => '0',
            'transfer' => '0',
            'status_dokumen' => 'Draft'
        ]);
        //---------------------------------------------------
        return redirect()->to('/draftbuyback/' . $dateidbuyback);
    }

    public function UbahBerat()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $session = session();
            $valid = $this->validate([
                'val' => [
                    'rules' => 'required|numeric|greater_than[0]',
                    'errors' => [
                        'required' => 'Berat Harus di isi',
                        'numeric' => 'Harus Number',
                        'greater_than' => 'Tidak Boleh 0'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'val' => $validation->getError('val'),
                    ]
                ];
                echo json_encode($msg);
            } else {
                $datadetailbuyback = $this->modeldetailbuyback->getDataDetailKode($this->request->getVar('id'));
                $berat = $this->request->getVar('val');
                $hasil = round($berat * ($datadetailbuyback['nilai_tukar'] / 100), 2);
                if (substr($datadetailbuyback['kode'], 0, 1) == 2) {
                    $harabeli = $datadetailbuyback['harga_beli'];
                } else {
                    $harabeli = round($datadetailbuyback['total_harga'] / $berat);
                }
                $this->modeldetailbuyback->save([
                    'id_detail_buyback' => $this->request->getVar('id'),
                    'id_karyawan' => $session->get('id_user'),
                    'berat' => $this->request->getVar('val'),
                    'berat_murni' => $hasil,
                    'harga_beli' => $harabeli
                ]);
                $msg = $hasil;
                echo json_encode($msg);
            }
        }
    }
    public function UbahKet()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $session = session();
            $valid = $this->validate([
                'val' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Keterangan Harus di isi',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'val' => $validation->getError('val'),
                    ]
                ];
                echo json_encode($msg);
            } else {
                $session = session();
                $this->modeldetailbuyback->save([
                    'id_detail_buyback' => $this->request->getVar('id'),
                    'id_karyawan' => $session->get('id_user'),
                    'keterangan' => $this->request->getVar('val')
                ]);
                $msg = 'berhasil keterangan';
                echo json_encode($msg);
            }
        }
    }
    public function DraftBuyback($id)
    {
        $databuyback = $this->modelbuyback->getDataBuyback($id);

        $data = [
            'merek' => $this->datamerek->getMerek(),
            'bank' => $this->modelbank->getBank(),
            'kadar' => $this->datakadar->getKadar(),
            'jenis' => $this->datajenis->getJenis(),
            'supplier' => $this->datasupplier->getSupplier(),
            'databuyback' => $databuyback
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
                    // 'tampildatabuyback' => $this->modeldetailbuyback->getDetailAllBuyback(),
                    'kel' => $datatrans['kelompok']
                ];
                $msg = [
                    'data' => view('buybackcust/datamodaldenganota', $data),
                    'datacust' =>  $datatrans['nohp_cust'],
                    'asd' => $datatrans
                ];
            } else {
                $msg = [
                    'pesan_error' => 'Tidak ada Transaksi'
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
            $data1 = [
                'kel' => substr($data['kode'], 0, 1),
                'dataval' => $data,
                'databuyback' => $this->request->getVar('iddate'),
                'merek' => $this->datamerek->getMerek(),
                'kadar' => $this->datakadar->getKadar(),
                'jenis' => $this->datajenis->getJenis(),
            ];
            $msg = [
                'tampilform' => view('buybackcust/formdgnnota', $data1),
                'dataval' => $data['kode'],
            ];
            echo json_encode($msg);
        }
    }
    public function TampilDataBuyback()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $databuyback = $this->modelbuyback->getDataBuyback($this->request->getVar('iddate'));
            $totalharga = $this->modeldetailbuyback->SumTotalHargaBuyback($this->request->getVar('iddate'));
            // $totalberat = $this->modeldetailbuyback->SumBeratDetailBuyback($this->request->getVar('iddate'));
            $totaljumlah = $this->modeldetailbuyback->JumlahDataBuyback($this->request->getVar('iddate'));
            $datadetail = $this->modeldetailbuyback->getDetailAllBuyback($this->request->getVar('iddate'));
            $totalberat = 0;
            foreach ($datadetail as $row) {
                if (substr($row['kode'], 0, 1) == 3) {
                    $totalberat =  $totalberat + ($row['berat'] * $row['qty']);
                } else {
                    $totalberat = $totalberat + $row['berat'];
                }
            }
            $this->modelbuyback->save([
                'id_buyback' =>  $databuyback['id_buyback'],
                'id_karyawan' => $session->get('id_user'),
                'total_berat' =>  $totalberat,
                'jumlah' => ($totaljumlah['total'] == null) ? 0 : $totaljumlah['total'],
                'total_harga' => ($totalharga['total_harga'] == null) ? 0 : $totalharga['total_harga'],
            ]);

            $data = [
                'databuyback' => $databuyback,
                'tampildata' => $datadetail,
                'totalberat' => $this->modeldetailbuyback->SumBeratDetailBuyback($this->request->getVar('iddate')),
                'totalberat3' => $this->modeldetailbuyback->SumBerat3DetailBuyback($this->request->getVar('iddate')),
                'totalcarat' => $this->modeldetailbuyback->SumCartDetailBuyback($this->request->getVar('iddate')),
                'totalqty' => $this->modeldetailbuyback->SumQtyDetailBuyback($this->request->getVar('iddate')),
                'totalharga' => $this->modeldetailbuyback->SumTotalHargaBuyback($this->request->getVar('iddate'))
                // 'tampildatabuyback' => $this->modeldetailbuyback->getDetailAllBuyback(),
            ];
            if ($databuyback['kelompok'] == 1) {
                $view = view('buybackcust/detailtablebuyback', $data);
            } elseif ($databuyback['kelompok'] == 2) {
                $view = view('buybackcust/detailtablebuyback2', $data);
            } elseif ($databuyback['kelompok'] == 3) {
                $view = view('buybackcust/detailtablebuyback3', $data);
            } elseif ($databuyback['kelompok'] == 4) {
                $view = view('buybackcust/detailtablebuyback4', $data);
            } elseif ($databuyback['kelompok'] == 5) {
                $view = view('buybackcust/detailtablebuyback5', $data);
            } elseif ($databuyback['kelompok'] == 6) {
                $view = view('buybackcust/detailtablebuyback6', $data);
            } else {
                $view = null;
            }
            $msg = [
                'data' => $view,
                'totalharga' => ($totalharga['total_harga'] == null) ? 0 : $totalharga['total_harga'],
                'totalberat' => $totalberat
            ];
            echo json_encode($msg);
        }
    }
    function ModalBarcode()
    {
        if ($this->request->isAJAX()) {
            if ($this->request->getVar('kel') == 1) {
                $databarcode = $this->datastock->getBarcode($this->request->getVar('kel'));
            } elseif ($this->request->getVar('kel') == 2) {
                $databarcode = $this->datastock2->getBarcode($this->request->getVar('kel'));
            } elseif ($this->request->getVar('kel') == 3) {
                $databarcode = $this->datastock3->getBarcode($this->request->getVar('kel'));
            } elseif ($this->request->getVar('kel') == 4) {
                $databarcode = $this->datastock4->getBarcode($this->request->getVar('kel'));
            } elseif ($this->request->getVar('kel') == 5) {
                $databarcode = $this->datastock5->getBarcode($this->request->getVar('kel'));
            } elseif ($this->request->getVar('kel') == 6) {
                $databarcode = $this->datastock6->getBarcode($this->request->getVar('kel'));
            }
            $databar = [
                'databarcode' => $databarcode,
                'kel' => $this->request->getVar('kel'),
            ];
            $data = [
                'modalbarcode' => view('buybackcust/modalbarcode',  $databar),
            ];
            echo json_encode($data);
        }
    }
    public function PembayaranBuyback()
    {
        if ($this->request->isAJAX()) {
            $saldobiaya = $this->modeltransaksi->getTransaksi();
            $validation = \Config\Services::validation();
            if ($this->request->getVar('transfer')) {
                $valid = $this->validate([
                    'nohpcust' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'No hp Harus di isi',
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
            $valid = $this->validate([
                'nohpcust' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'No hp Harus di isi',
                    ]
                ],

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nohpcust' => $validation->getError('nohpcust'),
                        'transfer' => $validation->getError('transfer'),
                        'namabank' => $validation->getError('namabank'),
                    ]
                ];
                echo json_encode($msg);
            } else {
                $datacust = $this->datacust->getDataCustomerone($this->request->getVar('nohpcust'));
                if ($datacust) {
                    $session = session();
                    $tunai = ($this->request->getVar('tunai')) ? $this->request->getVar('tunai') : 0;
                    $transfer = ($this->request->getVar('transfer')) ? $this->request->getVar('transfer') : 0;
                    $pembulatan = ($this->request->getVar('pembulatan')) ? $this->request->getVar('pembulatan') : 0;
                    $totalvar = $tunai + $transfer;
                    $databuyback = $this->modelbuyback->getDataBuyback($this->request->getVar('iddate'));
                    $hasilbayar = ($databuyback['total_harga'] - $totalvar) - $pembulatan;
                    if ($saldobiaya['total_akhir_tunai'] >= $this->request->getVar('tunai')) {
                        $sukses = true;
                    }
                    if ($this->request->getVar('transfer')) {
                        $sukses = true;
                    }
                    if ($saldobiaya['total_akhir_tunai'] >= $this->request->getVar('tunai') && $this->request->getVar('transfer')) {
                        $sukses = true;
                    }

                    if (isset($sukses)) {
                        if ($hasilbayar <= 0 && $databuyback['total_harga'] != 0) {
                            $datadetail = $this->modeldetailbuyback->getDetailAllBuyback($this->request->getVar('iddate'));
                            $namabank = ($this->request->getVar('transfer')) ? $this->request->getVar('namabank') : null;
                            $this->modelbuyback->save([
                                'id_buyback' => $databuyback['id_buyback'],
                                'id_karyawan' => $session->get('id_user'),
                                'pembayaran' => 'Lunas',
                                'nohp_cust' => $this->request->getVar('nohpcust'),
                                'tunai' => $this->request->getVar('tunai'),
                                'transfer' => $this->request->getVar('transfer'),
                                'nama_bank' => $namabank,
                                //'tgl_selesai' => date("Y-m-d H:i:s"),
                                'tgl_selesai' => $this->request->getVar('datebuyback'),
                                'status_dokumen' => 'Selesai',
                                'created_at' => $this->request->getVar('datebuyback'),
                                'updated_at' => $this->request->getVar('datebuyback'),
                            ]);

                            foreach ($datadetail as $row) {
                                if ($row['no_nota'] == 'NoNota') {
                                    if (substr($row['kode'], 0, 1) == 1) {
                                        $saldoakhir = $row['qty'];
                                        $datamasterstock = $this->datastock->getBarangkode($row['kode']);
                                        $this->datastock->save([
                                            'id_stock_1' => $datamasterstock['id_stock_1'],
                                            'id_karyawan' => $session->get('id_user'),
                                            'nama_supplier' => $this->request->getVar('nohpcust'),
                                        ]);
                                        $this->modeldetailkartustock->save([
                                            // 'id_detail_kartustock' => $datadetailkartu['id_detail_kartustock'],
                                            'barcode' => $row['kode'],
                                            'id_karyawan' => $session->get('id_user'),
                                            'status' => 'Masuk',
                                            'no_faktur' => $databuyback['no_transaksi_buyback'],
                                            'tgl_faktur' => $databuyback['created_at'],
                                            'nama_customer' => $this->datacust->getDataCustomerone($this->request->getVar('nohpcust'))['nama'],
                                            'saldo' => $saldoakhir,
                                            'masuk' => $row['qty'],
                                            'keluar' => 0,
                                            'jenis' => $row['jenis'],
                                            'model' => $row['model'],
                                            'keterangan' => $row['status_proses'],
                                            'merek' => $row['merek'],
                                            'kadar' => $row['kadar'],
                                            'berat' => $row['berat'],
                                            'nilai_tukar' =>  $row['nilai_tukar'],
                                            'harga_beli' => $row['harga_beli'],
                                            'total_harga' => $row['total_harga'],
                                            'gambar' =>  $row['nama_img'],
                                        ]);
                                        $this->KartuStockMaster($row['kode'], $session);
                                    } else if (substr($row['kode'], 0, 1) == 2) {
                                        $saldoakhir = $row['qty'];
                                        $datamasterstock = $this->datastock2->getBarangkode($row['kode']);
                                        $this->datastock2->save([
                                            'id_stock_2' => $datamasterstock['id_stock_2'],
                                            'id_karyawan' => $session->get('id_user'),
                                            'nama_supplier' => $this->request->getVar('nohpcust'),
                                        ]);
                                        $this->modeldetailkartustock->save([
                                            // 'id_detail_kartustock' => $datadetailkartu['id_detail_kartustock'],
                                            'barcode' => $row['kode'],
                                            'id_karyawan' => $session->get('id_user'),
                                            'status' => 'Masuk',
                                            'no_faktur' => $databuyback['no_transaksi_buyback'],
                                            'tgl_faktur' => $databuyback['created_at'],
                                            'nama_customer' => $this->datacust->getDataCustomerone($this->request->getVar('nohpcust'))['nama'],
                                            'saldo' => $saldoakhir,
                                            'masuk' => $row['qty'],
                                            'keluar' => 0,
                                            'jenis' => $row['jenis'],
                                            'model' => $row['model'],
                                            'keterangan' => $row['status_proses'],
                                            'merek' => $row['merek'],
                                            'kadar' => $row['kadar'],
                                            'berat' => $row['berat'],
                                            'nilai_tukar' =>  $row['nilai_tukar'],
                                            'harga_beli' => $row['harga_beli'],
                                            'total_harga' => $row['total_harga'],
                                            'gambar' =>  $row['nama_img'],
                                        ]);
                                        $this->KartuStockMaster($row['kode'], $session);
                                    } elseif (substr($row['kode'], 0, 1) == 3) {
                                        $datamasterstock = $this->datastock3->getBarangkode($row['kode']);
                                        $datakartu = $this->modelkartustock->getKartuStockkode($row['kode']);
                                        $saldoakhir = ($datakartu) ? $row['qty'] + $datakartu['saldo_akhir'] : $row['qty'];
                                        $this->datastock3->save([
                                            'id_stock_3' => $datamasterstock['id_stock_3'],
                                            'id_karyawan' => $session->get('id_user'),
                                            'status' => $row['status'],
                                            'no_faktur' => $databuyback['no_transaksi_buyback'],
                                            'tgl_faktur' => date("Y-m-d H:i:s"),
                                            'nama_supplier' => $this->request->getVar('nohpcust'),
                                            'qty' => $saldoakhir,
                                            'jenis' => $row['jenis'],
                                            'model' => $row['model'],
                                            'keterangan' => $row['keterangan'],
                                            'merek' => $row['merek'],
                                            'kadar' => $row['kadar'],
                                            'berat' =>  $row['berat'],
                                            'harga_beli' => $row['harga_beli'],
                                            'total_harga' => $saldoakhir *  $row['qty'] * $row['harga_beli'],
                                            'gambar' =>  $row['nama_img'],
                                        ]);
                                        $this->modeldetailkartustock->save([
                                            // 'id_detail_kartustock' => $datadetailkartu['id_detail_kartustock'],
                                            'barcode' => $row['kode'],
                                            'id_karyawan' => $session->get('id_user'),
                                            'status' => 'Masuk',
                                            'no_faktur' => $databuyback['no_transaksi_buyback'],
                                            'tgl_faktur' => $databuyback['created_at'],
                                            'nama_customer' => $this->datacust->getDataCustomerone($this->request->getVar('nohpcust'))['nama'],
                                            'saldo' => $saldoakhir,
                                            'masuk' => $row['qty'],
                                            'keluar' => 0,
                                            'jenis' => $row['jenis'],
                                            'model' => $row['model'],
                                            'keterangan' => $row['status_proses'],
                                            'merek' => $row['merek'],
                                            'kadar' => $row['kadar'],
                                            'berat' => $row['berat'],
                                            'nilai_tukar' =>  $row['nilai_tukar'],
                                            'harga_beli' => $row['harga_beli'],
                                            'total_harga' => $row['total_harga'],
                                            'gambar' =>  $row['nama_img'],
                                        ]);
                                        $this->KartuStockMaster($row['kode'], $session);
                                    } elseif (substr($row['kode'], 0, 1) == 4) {
                                        $datamasterstock = $this->datastock4->getBarangkode($row['kode']);
                                        $datakartu = $this->modelkartustock->getKartuStockkode($row['kode']);
                                        $saldoakhir = ($datakartu) ? $row['berat'] + $datakartu['saldo_akhir'] : $row['berat'];
                                        $this->datastock4->save([
                                            'id_stock_4' => $datamasterstock['id_stock_4'],
                                            'id_karyawan' => $session->get('id_user'),
                                            'status' => $row['status'],
                                            'no_faktur' => $databuyback['no_transaksi_buyback'],
                                            'tgl_faktur' => date("Y-m-d H:i:s"),
                                            'nama_supplier' => $this->request->getVar('nohpcust'),
                                            'qty' => 1,
                                            'jenis' => $row['jenis'],
                                            'model' => $row['model'],
                                            'keterangan' => $row['keterangan'],
                                            'merek' => $row['merek'],
                                            'kadar' => $row['kadar'],
                                            'berat' =>  $saldoakhir,
                                            'harga_beli' => $row['harga_beli'],
                                            'total_harga' => $saldoakhir * $row['harga_beli'],
                                            'gambar' =>  $row['nama_img'],
                                        ]);
                                        $this->modeldetailkartustock->save([
                                            // 'id_detail_kartustock' => $datadetailkartu['id_detail_kartustock'],
                                            'barcode' => $row['kode'],
                                            'id_karyawan' => $session->get('id_user'),
                                            'status' => 'Masuk',
                                            'no_faktur' => $databuyback['no_transaksi_buyback'],
                                            'tgl_faktur' => $databuyback['created_at'],
                                            'nama_customer' => $this->datacust->getDataCustomerone($this->request->getVar('nohpcust'))['nama'],
                                            'saldo' => $saldoakhir,
                                            'masuk' => $row['berat'],
                                            'keluar' => 0,
                                            'jenis' => $row['jenis'],
                                            'model' => $row['model'],
                                            'keterangan' => $row['status_proses'],
                                            'merek' => $row['merek'],
                                            'kadar' => $row['kadar'],
                                            'berat' => $row['berat'],
                                            'nilai_tukar' =>  $row['nilai_tukar'],
                                            'harga_beli' => $row['harga_beli'],
                                            'total_harga' => $row['total_harga'],
                                            'gambar' =>  $row['nama_img'],
                                        ]);
                                        $this->KartuStockMaster($row['kode'], $session);
                                    } elseif (substr($row['kode'], 0, 1) == 5) {
                                        $datamasterstock = $this->datastock5->getBarangkode($row['kode']);
                                        $datakartu = $this->modelkartustock5->getKartuStockkode($row['kode']);
                                        if ($datakartu) {
                                            $saldoakhircarat = $row['carat'] + $datakartu['saldo_carat'];
                                            $saldoakhirqty = $row['qty'] + $datakartu['saldo_akhir'];
                                        } else {
                                            $saldoakhircarat = $row['carat'];
                                            $saldoakhirqty = $row['qty'];
                                        }
                                        $this->datastock5->save([
                                            'id_stock_5' => $datamasterstock['id_stock_5'],
                                            'id_karyawan' => $session->get('id_user'),
                                            'status' => $row['status'],
                                            'no_faktur' => $databuyback['no_transaksi_buyback'],
                                            'tgl_faktur' => date("Y-m-d H:i:s"),
                                            'nama_supplier' => $this->request->getVar('nohpcust'),
                                            'qty' => $saldoakhirqty,
                                            'jenis' => $row['jenis'],
                                            'model' => $row['model'],
                                            'keterangan' => $row['keterangan'],
                                            'merek' => $row['merek'],
                                            'kadar' => $row['kadar'],
                                            'berat_murni' => $row['berat_murni'],
                                            'carat' =>  $saldoakhircarat,
                                            'nilai_tukar' =>  $row['nilai_tukar'],
                                            'ongkos' => $row['ongkos'],
                                            'harga_beli' => $row['harga_beli'],
                                            'total_harga' => $saldoakhircarat * $row['harga_beli'],
                                            'gambar' =>  $row['nama_img'],
                                        ]);
                                        $this->modeldetailkartustock5->save([
                                            'barcode' => $row['kode'],
                                            'status' => 'Masuk',
                                            'id_karyawan' => $session->get('id_user'),
                                            'no_faktur' => $databuyback['no_transaksi_buyback'],
                                            'tgl_faktur' => $databuyback['created_at'],
                                            'nama_customer' => $this->datacust->getDataCustomerone($this->request->getVar('nohpcust'))['nama'],
                                            'saldo_carat' => $saldoakhircarat,
                                            'saldo' => $saldoakhirqty,
                                            'masuk' => $row['qty'],
                                            'keluar' => 0,
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
                                        ]);
                                        $this->KartuStockMaster5($row['kode'], $session, 'noopname');
                                    } elseif (substr($row['kode'], 0, 1) == 6) {
                                        $datamasterstock = $this->datastock6->getBarangkode($row['kode']);
                                        $datakartu = $this->modelkartustock6->getKartuStockkode($row['kode']);
                                        $saldoakhir = ($datakartu) ? $row['qty'] + $datakartu['saldo_akhir'] : $row['qty'];
                                        $this->datastock6->save([
                                            'id_stock_6' => $datamasterstock['id_stock_6'],
                                            'id_karyawan' => $session->get('id_user'),
                                            'status' => $row['status'],
                                            'no_faktur' => $databuyback['no_transaksi_buyback'],
                                            'tgl_faktur' => date("Y-m-d H:i:s"),
                                            'nama_supplier' => $this->request->getVar('nohpcust'),
                                            'qty' => $saldoakhir,
                                            'jenis' => $row['jenis'],
                                            'model' => $row['model'],
                                            'keterangan' => $row['keterangan'],
                                            'merek' => $row['merek'],
                                            'harga_beli' => $row['harga_beli'],
                                            'total_harga' => $saldoakhir * $row['harga_beli'],
                                            'gambar' =>  $row['nama_img'],
                                        ]);
                                        $this->modeldetailkartustock6->save([
                                            'barcode' => $row['kode'],
                                            'status' => 'Masuk',
                                            'id_karyawan' => $session->get('id_user'),
                                            'no_faktur' => $databuyback['no_transaksi_buyback'],
                                            'tgl_faktur' => $databuyback['created_at'],
                                            'nama_customer' => $this->datacust->getDataCustomerone($this->request->getVar('nohpcust'))['nama'],
                                            'saldo' => $saldoakhir,
                                            'masuk' => $row['qty'],
                                            'keluar' => 0,
                                            'jenis' => $row['jenis'],
                                            'model' => $row['model'],
                                            'keterangan' => $row['keterangan'],
                                            'merek' => $row['merek'],
                                            'harga_beli' => $row['harga_beli'],
                                            'total_harga' => $row['total_harga'],
                                            'gambar' =>  $row['nama_img'],
                                        ]);
                                        $this->KartuStockMaster6($row['kode'], $session);
                                    }
                                } else {
                                    if (substr($row['kode'], 0, 1) == 1 || substr($row['kode'], 0, 1) == 2) {
                                        $datakartu = $this->modelkartustock->getKartuStockkode($row['kode']);
                                        $saldoakhir = (isset($datakartu['saldo_akhir'])) ? $datakartu['saldo_akhir'] : 0 + $row['qty'];
                                    } elseif (substr($row['kode'], 0, 1) == 3) {
                                        $datakartu = $this->modelkartustock->getKartuStockkode($row['kode']);
                                        $saldoakhir = $datakartu['saldo_akhir'] + $row['qty'];
                                        $datamasterstock = $this->datastock3->getBarangkode($row['kode']);
                                        $this->datastock3->save([
                                            'id_stock_3' => $datamasterstock['id_stock_3'],
                                            'id_karyawan' => $session->get('id_user'),
                                            'status' => $row['status'],
                                            'no_faktur' => $databuyback['no_transaksi_buyback'],
                                            'tgl_faktur' => date("Y-m-d H:i:s"),
                                            'nama_supplier' => $this->request->getVar('nohpcust'),
                                            'qty' =>  $saldoakhir,
                                            'jenis' => $row['jenis'],
                                            'model' => $row['model'],
                                            'keterangan' => $row['keterangan'],
                                            'merek' => $row['merek'],
                                            'kadar' => $row['kadar'],
                                            'berat' => $row['berat'],
                                            'harga_beli' => $row['harga_beli'],
                                            'total_harga' => ($saldoakhir * $row['berat']) * $row['total_harga'],
                                            'gambar' =>  $row['nama_img'],
                                        ]);
                                    } elseif (substr($row['kode'], 0, 1) == 4) {
                                        $datakartu = $this->modelkartustock->getKartuStockkode($row['kode']);
                                        $saldoakhir =  $datakartu['saldo_akhir'] + $row['berat'];
                                        $datamasterstock = $this->datastock4->getBarangkode($row['kode']);
                                        $this->datastock4->save([
                                            'id_stock_4' => $datamasterstock['id_stock_4'],
                                            'id_karyawan' => $session->get('id_user'),
                                            // 'barcode' => $row['kode'],
                                            'status' => $row['status'],
                                            'no_faktur' => $databuyback['no_transaksi_buyback'],
                                            'tgl_faktur' => date("Y-m-d H:i:s"),
                                            'nama_supplier' => $this->request->getVar('nohpcust'),
                                            'qty' => 1,
                                            'jenis' => $row['jenis'],
                                            'model' => $row['model'],
                                            'keterangan' => $row['keterangan'],
                                            'merek' => $row['merek'],
                                            'kadar' => $row['kadar'],
                                            'berat' =>  $saldoakhir,
                                            'harga_beli' => $row['harga_beli'],
                                            'total_harga' => $row['total_harga'],
                                            'gambar' =>  $row['nama_img'],
                                        ]);
                                    } elseif (substr($row['kode'], 0, 1) == 5) {
                                        $datakartu = $this->modelkartustock5->getKartuStockkode($row['kode']);
                                        $saldoakhir =  $datakartu['saldo_akhir'] + $row['qty'];
                                        $saldocarat =  $datakartu['saldo_carat'] + $row['carat'];
                                        $datamasterstock = $this->datastock5->getBarangkode($row['kode']);
                                        $this->datastock5->save([
                                            'id_stock_5' => $datamasterstock['id_stock_5'],
                                            'id_karyawan' => $session->get('id_user'),
                                            // 'barcode' => $row['kode'],
                                            'status' => $row['status'],
                                            'no_faktur' => $databuyback['no_transaksi_buyback'],
                                            'tgl_faktur' => date("Y-m-d H:i:s"),
                                            'nama_supplier' => $this->request->getVar('nohpcust'),
                                            'qty' => $saldoakhir,
                                            'jenis' => $row['jenis'],
                                            'model' => $row['model'],
                                            'keterangan' => $row['keterangan'],
                                            'merek' => $row['merek'],
                                            'kadar' => $row['kadar'],
                                            'carat' =>  $saldocarat,
                                            'harga_beli' => $row['harga_beli'],
                                            'total_harga' => $row['total_harga'],
                                            'gambar' =>  $row['nama_img'],
                                        ]);
                                    } elseif (substr($row['kode'], 0, 1) == 6) {
                                        $datakartu = $this->modelkartustock6->getKartuStockkode($row['kode']);
                                        $saldoakhir =  $datakartu['saldo_akhir'] + $row['qty'];
                                        $datamasterstock = $this->datastock6->getBarangkode($row['kode']);
                                        $this->datastock6->save([
                                            'id_stock_6' => $datamasterstock['id_stock_6'],
                                            'id_karyawan' => $session->get('id_user'),
                                            // 'barcode' => $row['kode'],
                                            'status' => $row['status'],
                                            'no_faktur' => $databuyback['no_transaksi_buyback'],
                                            'tgl_faktur' => date("Y-m-d H:i:s"),
                                            'nama_supplier' => $this->request->getVar('nohpcust'),
                                            'qty' => $saldoakhir,
                                            'jenis' => $row['jenis'],
                                            'model' => $row['model'],
                                            'keterangan' => $row['keterangan'],
                                            'merek' => $row['merek'],
                                            'harga_beli' => $row['harga_beli'],
                                            'total_harga' => $saldoakhir * $row['harga_beli'],
                                            'gambar' =>  $row['nama_img'],
                                        ]);
                                    }

                                    if ($row['status_proses'] == 'CancelBeli') {
                                        if (substr($row['kode'], 0, 1) == 1) {
                                            $datamasterstock = $this->datastock->getBarangkode($row['kode']);
                                            $this->datastock->save([
                                                'id_stock_1' => $datamasterstock['id_stock_1'],
                                                'id_karyawan' => $session->get('id_user'),
                                                'status' =>  $row['status'],
                                                'no_faktur' => $databuyback['no_transaksi_buyback'],
                                                'tgl_faktur' => date("Y-m-d H:i:s"),
                                                'nama_supplier' => $this->request->getVar('nohpcust'),
                                                'qty' =>  $saldoakhir,
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
                                                'gambar' =>  $row['nama_img'],
                                            ]);
                                        } elseif (substr($row['kode'], 0, 1) == 2) {
                                            $datamasterstock = $this->datastock2->getBarangkode($row['kode']);
                                            $this->datastock2->save([
                                                'id_stock_2' => $datamasterstock['id_stock_2'],
                                                'id_karyawan' => $session->get('id_user'),
                                                'status' =>  $row['status'],
                                                'no_faktur' => $databuyback['no_transaksi_buyback'],
                                                'tgl_faktur' => date("Y-m-d H:i:s"),
                                                'nama_supplier' => $this->request->getVar('nohpcust'),
                                                'qty' =>  $saldoakhir,
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
                                                'gambar' =>  $row['nama_img'],
                                            ]);
                                        } elseif (substr($row['kode'], 0, 1) == 3) {
                                            $datamasterstock = $this->datastock3->getBarangkode($row['kode']);
                                            $this->datastock3->save([
                                                'id_stock_3' => $datamasterstock['id_stock_3'],
                                                'id_karyawan' => $session->get('id_user'),
                                                'status' =>  $row['status'],
                                                'no_faktur' => $databuyback['no_transaksi_buyback'],
                                                'tgl_faktur' => date("Y-m-d H:i:s"),
                                                'nama_supplier' => $this->request->getVar('nohpcust'),
                                                'qty' =>  $saldoakhir,
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
                                                'gambar' =>  $row['nama_img'],
                                            ]);
                                        } elseif (substr($row['kode'], 0, 1) == 4) {
                                            $datamasterstock = $this->datastock4->getBarangkode($row['kode']);
                                            $this->datastock4->save([
                                                'id_stock_4' => $datamasterstock['id_stock_4'],
                                                'id_karyawan' => $session->get('id_user'),
                                                'status' =>  $row['status'],
                                                'no_faktur' => $databuyback['no_transaksi_buyback'],
                                                'tgl_faktur' => date("Y-m-d H:i:s"),
                                                'nama_supplier' => $this->request->getVar('nohpcust'),
                                                'qty' =>  $saldoakhir,
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
                                                'gambar' =>  $row['nama_img'],
                                            ]);
                                        } elseif (substr($row['kode'], 0, 1) == 5) {
                                            $datamasterstock = $this->datastock5->getBarangkode($row['kode']);
                                            $this->datastock5->save([
                                                'id_stock_5' => $datamasterstock['id_stock_5'],
                                                'id_karyawan' => $session->get('id_user'),
                                                'status' =>  $row['status'],
                                                'no_faktur' => $databuyback['no_transaksi_buyback'],
                                                'tgl_faktur' => date("Y-m-d H:i:s"),
                                                'nama_supplier' => $this->request->getVar('nohpcust'),
                                                'qty' =>  $saldoakhir,
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
                                                'gambar' =>  $row['nama_img'],
                                            ]);
                                        } elseif (substr($row['kode'], 0, 1) == 6) {
                                            $datamasterstock = $this->datastock6->getBarangkode($row['kode']);
                                            $this->datastock6->save([
                                                'id_stock_6' => $datamasterstock['id_stock_6'],
                                                'id_karyawan' => $session->get('id_user'),
                                                'status' =>  $row['status'],
                                                'no_faktur' => $databuyback['no_transaksi_buyback'],
                                                'tgl_faktur' => date("Y-m-d H:i:s"),
                                                'nama_supplier' => $this->request->getVar('nohpcust'),
                                                'qty' =>  $saldoakhir,
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
                                                'gambar' =>  $row['nama_img'],
                                            ]);
                                        }
                                    }

                                    if (substr($row['kode'], 0, 1) != 5 && substr($row['kode'], 0, 1) != 6) {
                                        $this->modeldetailkartustock->save([
                                            // 'id_detail_kartustock' => $datadetailkartu['id_detail_kartustock'],
                                            'barcode' => $row['kode'],
                                            'id_karyawan' => $session->get('id_user'),
                                            'status' => 'Keluar',
                                            'no_faktur' => $databuyback['no_transaksi_buyback'],
                                            'tgl_faktur' => $databuyback['created_at'],
                                            'nama_customer' => $row['no_nota'],
                                            'saldo' => $saldoakhir,
                                            'masuk' => (substr($row['kode'], 0, 1) == 4) ? $row['berat'] : $row['qty'],
                                            'keluar' => 0,
                                            'jenis' => $row['jenis'],
                                            'model' => $row['model'],
                                            'keterangan' => $row['status_proses'],
                                            'merek' => $row['merek'],
                                            'kadar' => $row['kadar'],
                                            'berat' => $row['berat'],
                                            'nilai_tukar' =>  $row['nilai_tukar'],
                                            'harga_beli' => $row['harga_beli'],
                                            'total_harga' => $row['total_harga'],
                                            'gambar' =>  $row['nama_img'],
                                        ]);
                                        $this->KartuStockMaster($row['kode'], $session);
                                    } elseif (substr($row['kode'], 0, 1) == 5) {
                                        $this->modeldetailkartustock5->save([
                                            'barcode' => $row['kode'],
                                            'status' => 'Masuk',
                                            'id_karyawan' => $session->get('id_user'),
                                            'no_faktur' => $databuyback['no_transaksi_buyback'],
                                            'tgl_faktur' => $databuyback['created_at'],
                                            'nama_customer' => $this->datacust->getDataCustomerone($this->request->getVar('nohpcust'))['nama'],
                                            'saldo_carat' => $saldocarat,
                                            'saldo' => $saldoakhir,
                                            'masuk' => $row['qty'],
                                            'keluar' => 0,
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
                                        ]);
                                        $this->KartuStockMaster5($row['kode'], $session, 'noopname');
                                    } elseif (substr($row['kode'], 0, 1) == 6) {
                                        $this->modeldetailkartustock6->save([
                                            'barcode' => $row['kode'],
                                            'status' => 'Masuk',
                                            'id_karyawan' => $session->get('id_user'),
                                            'no_faktur' => $databuyback['no_transaksi_buyback'],
                                            'tgl_faktur' => $databuyback['created_at'],
                                            'nama_customer' => $this->datacust->getDataCustomerone($this->request->getVar('nohpcust'))['nama'],
                                            'saldo' => $saldoakhir,
                                            'masuk' => $row['qty'],
                                            'keluar' => 0,
                                            'jenis' => $row['jenis'],
                                            'model' => $row['model'],
                                            'keterangan' => $row['keterangan'],
                                            'merek' => $row['merek'],
                                            'harga_beli' => $row['harga_beli'],
                                            'total_harga' => $row['total_harga'],
                                            'gambar' =>  $row['nama_img'],
                                        ]);
                                        $this->KartuStockMaster6($row['kode'], $session);
                                    }
                                }
                            }

                            if ($this->request->getVar('tunai')) {
                                $this->modeldetailtransaksi->save([
                                    //'tanggal_transaksi' => date("Y-m-d H:i:s"),sementara
                                    'tanggal_transaksi' => $this->request->getVar('datebuyback'),
                                    'id_karyawan' => $session->get('id_user'),
                                    'pembayaran' => 'Tunai',
                                    'keterangan' => $databuyback['no_transaksi_buyback'],
                                    'id_akun_biaya' => 8,
                                    'masuk' => 0,
                                    'keluar' =>  $this->request->getVar('tunai'),
                                    'nama_bank' => ($this->request->getVar('namabank')) ? $this->request->getVar('namabank') : null,
                                ]);
                            }
                            if ($this->request->getVar('transfer')) {
                                $this->modeldetailtransaksi->save([
                                    //'tanggal_transaksi' => date("Y-m-d H:i:s"),sementara
                                    'tanggal_transaksi' => $this->request->getVar('datebuyback'),
                                    'id_karyawan' => $session->get('id_user'),
                                    'pembayaran' => 'Transfer',
                                    'keterangan' => $databuyback['no_transaksi_buyback'],
                                    'id_akun_biaya' => 8,
                                    'masuk' => 0,
                                    'keluar' => $this->request->getVar('transfer'),
                                    'nama_bank' => ($this->request->getVar('namabank')) ? $this->request->getVar('namabank') : null,
                                ]);
                            }
                            $this->BiayaHarianMaster($saldobiaya['id_transaksi'], $session);
                            $msg = 'sukses';
                        } else {
                            $msg = [
                                'error' => [
                                    'bayar' => 'Bayar Kurang',
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
                            'bayar' => 'Data Customer Tidak Ada',
                        ]
                    ];
                }
                echo json_encode($msg);
            }
        }
    }
    public function TambahBuybackNonota()
    {
        if ($this->request->isAJAX()) {
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
                    'carat' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Carat Harus di isi',
                        ]
                    ],
                    'harga_beli' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Berat Bersih Harus di isi',
                        ]
                    ],
                ]);
            } else {
                $valid = $this->validate([
                    'gambar' => [
                        'rules' => 'uploaded[gambar]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                        'errors' => [
                            'uploaded' => 'gambar harus diisi',
                            'mime_in' => 'extention tidak cocok',
                            'is_image' => 'Bukan Gambar',

                        ]
                    ],

                ]);
            }
            if (!$valid) {
                $msg = [
                    'error' => [
                        'qty' => $validation->getError('qty'),
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
                $databuyback = $this->modelbuyback->getDataBuyback($this->request->getVar('iddate'));
                if ($this->request->getVar('barcode')) {
                    if (substr($this->request->getVar('barcode'), 0, 1) == 3) {
                        $checkkode = $this->datastock3->getBarangBarcode($this->request->getVar('barcode'));
                    } elseif (substr($this->request->getVar('barcode'), 0, 1) == 4) {
                        $checkkode = $this->datastock4->getBarangBarcode($this->request->getVar('barcode'));
                    } elseif (substr($this->request->getVar('barcode'), 0, 1) == 5) {
                        $checkkode = $this->datastock5->getBarangBarcode($this->request->getVar('barcode'));
                    } elseif (substr($this->request->getVar('barcode'), 0, 1) == 6) {
                        $checkkode = $this->datastock6->getBarangBarcode($this->request->getVar('barcode'));
                    } else {
                        $statuskode = false;
                        $checkkode = false;
                    }
                    if ($checkkode) {
                        $statuskode = true;
                    } else {
                        $statuskode = false;
                    }
                } else {
                    $statuskode = true;
                }
                if ($statuskode) {
                    if ($databuyback['kelompok'] == $this->request->getVar('kelompok') || $databuyback['kelompok'] == 0) {
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
                        $this->modelbuyback->save([
                            'id_buyback' =>  $databuyback['id_buyback'],
                            'id_karyawan' => $session->get('id_user'),
                            'kelompok' =>  $this->request->getVar('kelompok'),
                        ]);
                        $kode = $this->request->getVar('kelompok');
                        $qty = ($this->request->getVar('qty')) ? $this->request->getVar('qty') : 0;
                        $harga = ($this->request->getVar('harga_beli')) ? $this->request->getVar('harga_beli') : 0;
                        $berat = $this->request->getVar('berat');
                        $carat = $this->request->getVar('carat');
                        if ($this->request->getVar('barcode')) {
                            $barcode = $this->request->getVar('barcode');
                        } else {
                            $barcode = $this->KodeDatailGenerate($this->request->getVar('kelompok'));
                        }
                        $beratmurni = round($berat * ($this->request->getVar('nilai_tukar') / 100), 2);
                        if ($kode == 1) {
                            $totalharga =  $berat *  $harga;
                            $kadar = $this->request->getVar('kadar');
                            $merek = $this->request->getVar('merek');
                            $this->datastock->save([
                                'barcode' => $barcode,
                                'id_karyawan' => $session->get('id_user'),
                                'status' => $this->request->getVar('status_proses'),
                                'no_faktur' => $databuyback['no_transaksi_buyback'],
                                'tgl_faktur' => $databuyback['created_at'],
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
                                'gambar' =>  $namafile,
                            ]);
                            $statusproses = $this->request->getVar('status_proses');
                        } elseif ($kode == 2) {
                            $totalharga = $harga;
                            $kadar = $this->request->getVar('kadar');
                            $merek = $this->request->getVar('merek');
                            $this->datastock2->save([
                                'barcode' => $barcode,
                                'id_karyawan' => $session->get('id_user'),
                                'status' => $this->request->getVar('status_proses'),
                                'no_faktur' => $databuyback['no_transaksi_buyback'],
                                'tgl_faktur' => $databuyback['created_at'],
                                'nama_supplier' => 'Buyback',
                                'qty' => 0,
                                'jenis' =>  $this->request->getVar('jenis'),
                                'model' =>  $this->request->getVar('model'),
                                'keterangan' =>  $this->request->getVar('keterangan'),
                                'merek' => $this->request->getVar('merek'),
                                'kadar' =>   $this->request->getVar('kadar'),
                                'berat' =>  $this->request->getVar('berat'),
                                'harga_beli' =>  $this->request->getVar('harga_beli'),
                                'total_harga' => $totalharga,
                                'gambar' =>  $namafile,
                            ]);
                            $statusproses = $this->request->getVar('status_proses');
                        } elseif ($kode == 3) {
                            $totalharga =  $berat *  $harga * $qty;
                            $kadar = '24K';
                            $merek = $this->request->getVar('merek');
                            if (!$this->request->getVar('barcode')) {
                                $this->datastock3->save([
                                    'barcode' => $barcode,
                                    'id_karyawan' => $session->get('id_user'),
                                    'status' => $this->request->getVar('status_proses'),
                                    'no_faktur' => $databuyback['no_transaksi_buyback'],
                                    'tgl_faktur' => $databuyback['created_at'],
                                    'nama_supplier' => 'Buyback',
                                    'qty' => 0,
                                    'jenis' =>  $this->request->getVar('jenis'),
                                    'model' =>  $this->request->getVar('model'),
                                    'keterangan' =>  $this->request->getVar('keterangan'),
                                    'merek' => $this->request->getVar('merek'),
                                    'kadar' => '24K',
                                    'berat' =>  $this->request->getVar('berat'),
                                    'harga_beli' =>  $this->request->getVar('harga_beli'),
                                    'total_harga' => $totalharga,
                                    'gambar' =>  $namafile,
                                ]);
                            }
                        } elseif ($kode == 4) {
                            $totalharga =  $berat *  $harga;
                            $kadar = '24K';
                            $merek = '-';
                            if (!$this->request->getVar('barcode')) {
                                $this->datastock4->save([
                                    'barcode' => $barcode,
                                    'id_karyawan' => $session->get('id_user'),
                                    'status' => $this->request->getVar('status_proses'),
                                    'no_faktur' => $databuyback['no_transaksi_buyback'],
                                    'tgl_faktur' => $databuyback['created_at'],
                                    'nama_supplier' => 'Buyback',
                                    'qty' => 0,
                                    'jenis' =>  $this->request->getVar('jenis'),
                                    'model' =>  $this->request->getVar('model'),
                                    'keterangan' =>  $this->request->getVar('keterangan'),
                                    'merek' => '-',
                                    'kadar' => '24K',
                                    'berat' =>  $this->request->getVar('berat'),
                                    'harga_beli' =>  $this->request->getVar('harga_beli'),
                                    'total_harga' => $totalharga,
                                    'gambar' =>  $namafile,
                                ]);
                            }
                        } elseif ($kode == 5) {
                            $totalharga =  $carat *  $harga;
                            $merek = '-';
                            $kadar = '-';
                            if (!$this->request->getVar('barcode')) {
                                $this->datastock5->save([
                                    'barcode' => $barcode,
                                    'id_karyawan' => $session->get('id_user'),
                                    'status' => $this->request->getVar('status_proses'),
                                    'no_faktur' => $databuyback['no_transaksi_buyback'],
                                    'tgl_faktur' => $databuyback['created_at'],
                                    'nama_supplier' => 'Buyback',
                                    'qty' => 0,
                                    'jenis' =>  $this->request->getVar('jenis'),
                                    'model' =>  $this->request->getVar('model'),
                                    'keterangan' =>  $this->request->getVar('keterangan'),
                                    'merek' => $merek,
                                    'kadar' =>   $this->request->getVar('kadar'),
                                    'carat' => $this->request->getVar('carat'),
                                    'harga_beli' =>  $this->request->getVar('harga_beli'),
                                    'total_harga' => $totalharga,
                                    'gambar' =>  $namafile,
                                ]);
                            }
                        } elseif ($kode == 6) {
                            $totalharga = $harga * $qty;
                            $merek = $this->request->getVar('merek');
                            $kadar = '-';
                            if (!$this->request->getVar('barcode')) {
                                $this->datastock6->save([
                                    'barcode' => $barcode,
                                    'id_karyawan' => $session->get('id_user'),
                                    'status' => 'B',
                                    'no_faktur' => $databuyback['no_transaksi_buyback'],
                                    'tgl_faktur' => $databuyback['created_at'],
                                    'nama_supplier' => 'Buyback',
                                    'qty' => 0,
                                    'jenis' =>  $this->request->getVar('jenis'),
                                    'model' =>  $this->request->getVar('model'),
                                    'keterangan' =>  $this->request->getVar('keterangan'),
                                    'merek' => $this->request->getVar('merek'),
                                    'harga_beli' =>  $this->request->getVar('harga_beli'),
                                    'total_harga' => $totalharga,
                                    'gambar' =>  $namafile,
                                ]);
                            }
                        }
                        $this->modeldetailbuyback->save([
                            'nama_img' => $namafile,
                            'id_karyawan' => $session->get('id_user'),
                            'id_date_buyback' => $this->request->getVar('iddate'),
                            'kode' =>  $barcode,
                            'qty' => $this->request->getVar('qty'),
                            'jenis' =>  $this->request->getVar('jenis'),
                            'model' =>  $this->request->getVar('model'),
                            'status' => 'B',
                            'keterangan' =>  $this->request->getVar('keterangan'),
                            'berat' =>  $this->request->getVar('berat'),
                            'carat' => $this->request->getVar('carat'),
                            'berat_murni' =>  $beratmurni,
                            'harga_beli' =>  $this->request->getVar('harga_beli'),
                            'ongkos' => 0,
                            'kadar' => $kadar,
                            'nilai_tukar' => $this->request->getVar('nilai_tukar'),
                            'merek' => $merek,
                            'total_harga' => $totalharga,
                            'no_nota' => 'NoNota',
                            'status_proses' => (isset($statusproses)) ? $statusproses : 'Murni'
                        ]);
                        //$this->request->getVar('status_proses') kalo murni tidak bisa di buyback
                        $msg = ['berhasil' => 'Berhasil Dimasukan'];
                    } else {
                        $msg = ['gagal' => 'Kelompok Barang Berbeda'];
                    }
                } else {
                    $msg = ['gagal' => 'Barcode Barang Tidak ada'];
                }
                echo json_encode($msg);
            }
        }
    }
    public function TampilCustomer()
    {
        if ($this->request->isAJAX()) {
            $data = $this->datacust->getDataCustomer();
            echo json_encode($data);
        }
    }

    public function DeleteDetailBuyback()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $session = session();
            $data = $this->modeldetailbuyback->getDataDetailKode($id);
            if (substr($data['kode'], 0, 1) == 3 || substr($data['kode'], 0, 1) == 4) {
                $datakartu = $this->modelkartustock->getKartuStockkode($data['kode']);
            } elseif (substr($data['kode'], 0, 1) == 5) {
                $datakartu = $this->modelkartustock5->getKartuStockkode($data['kode']);
            } elseif (substr($data['kode'], 0, 1) == 6) {
                $datakartu = $this->modelkartustock6->getKartuStockkode($data['kode']);
            }
            if ($data['no_nota'] == 'NoNota') {
                if ($datakartu) {
                    $this->modeldetailbuyback->delete($id);
                } else {
                    if (substr($data['kode'], 0, 1) == 1) {
                        $datastock = $this->datastock->getBarangkode($data['kode']);
                        $this->datastock->delete($datastock['id_stock_1']);
                    } elseif (substr($data['kode'], 0, 1) == 2) {
                        $datastock2 = $this->datastock2->getBarangkode($data['kode']);
                        $this->datastock2->delete($datastock2['id_stock_2']);
                    } elseif (substr($data['kode'], 0, 1) == 3) {
                        $datastock3 = $this->datastock3->getBarangkode($data['kode']);
                        $this->datastock3->delete($datastock3['id_stock_3']);
                    } elseif (substr($data['kode'], 0, 1) == 4) {
                        $datastock4 = $this->datastock4->getBarangkode($data['kode']);
                        $this->datastock4->delete($datastock4['id_stock_4']);
                    } elseif (substr($data['kode'], 0, 1) == 5) {
                        $datastock5 = $this->datastock5->getBarangkode($data['kode']);
                        $this->datastock5->delete($datastock5['id_stock_5']);
                    } elseif (substr($data['kode'], 0, 1) == 6) {
                        $datastock6 = $this->datastock6->getBarangkode($data['kode']);
                        $this->datastock6->delete($datastock6['id_stock_6']);
                    }

                    if ($data['nama_img'] != 'default.jpg') { //buyback dengan nota, foto ikut terhapus
                        if ($data['nama_img'] != 'default.jpg') {
                            unlink('img/' . $data['nama_img']); //untuk hapus file
                        }
                    }
                    $this->modeldetailbuyback->delete($id);
                }
            } else {
                $datadetailpenjualan = $this->modeldetailpenjualan->getDetailoneJual($data['id_detail_penjualan']);
                $this->modeldetailpenjualan->save([
                    'id_detail_penjualan' => $data['id_detail_penjualan'],
                    'id_karyawan' => $session->get('id_user'),
                    'saldo_carat' => (substr($data['kode'], 0, 1) == 5) ? $data['carat'] + $datadetailpenjualan['saldo_carat'] : 0,
                    'saldo' => (substr($data['kode'], 0, 1) == 4) ? $data['berat'] + $datadetailpenjualan['saldo'] : $data['qty'] + $datadetailpenjualan['saldo']
                ]);
                $this->modeldetailbuyback->delete($id);
            }
            $jumlahdata = $this->modeldetailbuyback->JumlahDataBuyback($data['id_date_buyback'])['total'];
            if ($jumlahdata == 0) {
                $databuyback = $this->modelbuyback->getDataBuyback($data['id_date_buyback']);
                $this->modelbuyback->save([
                    'id_buyback' => $databuyback['id_buyback'],
                    'id_karyawan' => $session->get('id_user'),
                    'kelompok' => 0,
                ]);
            }
            $msg = [
                'sukses' => 'Berhasil'
            ];
            echo json_encode($msg);
        }
    }
    public function BatalBuyback($id)
    {
        $session = session();
        $databuyback = $this->modelbuyback->getDataBuyback($id);
        $datadetailbb = $this->modeldetailbuyback->getDetailAllBuyback($id);
        foreach ($datadetailbb as $row) {
            // $data = $this->modeldetailbuyback->getDataDetailKode($row['id_detail_buyback']);
            if ($row['no_nota'] == 'NoNota') {
                $datastock = $this->datastock->getBarangkode($row['kode']);
                $this->datastock->delete($datastock['id_stock_1']);
                if ($row['nama_img'] != 'default.jpg') { //buyback dengan nota, foto ikut terhapus
                    unlink('img/' . $row['nama_img']); //untuk hapus file
                }
            } else {
                $datadetailpenjualan = $this->modeldetailpenjualan->getDetailoneJual($row['id_detail_penjualan']);
                $this->modeldetailpenjualan->save([
                    'id_detail_penjualan' => $row['id_detail_penjualan'],
                    'id_karyawan' => $session->get('id_user'),
                    'saldo' => (substr($row['kode'], 0, 1) == 4) ? $row['berat'] + $datadetailpenjualan['saldo'] : $row['qty'] + $datadetailpenjualan['saldo']
                ]);
            }

            $this->modeldetailbuyback->delete($id);
        }
        $this->modelbuyback->delete($databuyback['id_buyback']);
        return redirect()->to('/buybackcust');
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
            if ($this->request->getVar('kel') == 1) {
                $valid = $this->validate([
                    'nilai_tukar1' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Nilai Tukar Harus di isi',
                        ]
                    ],

                ]);
            }
            if ($this->request->getVar('kel') == 5) {
                $valid = $this->validate([
                    'carat1' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Carat Harus di isi',
                        ]
                    ],

                ]);
            }
            if ($this->request->getVar('kel') == 1 || $this->request->getVar('kel') == 2 || $this->request->getVar('kel') == 3 || $this->request->getVar('kel') == 4) {
                $valid = $this->validate([
                    'berat1' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Berat Harus di isi',
                        ]
                    ],

                ]);
            }
            $valid = $this->validate([

                'harga_beli1' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Berat Bersih Harus di isi',
                    ]
                ],
                'qty1' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Qty Harus di isi',
                    ]
                ],
            ]);


            if (!$valid) {
                $msg = [
                    'error' => [
                        'nilai_tukar1' => $validation->getError('nilai_tukar1'),
                        'berat1' => $validation->getError('berat1'),
                        'harga_beli1' => $validation->getError('harga_beli1'),
                        'qty1' => $validation->getError('qty1'),
                        'carat1' => $validation->getError('carat1'),
                    ]
                ];
                echo json_encode($msg);
            } else {

                $session = session();
                $id = $this->request->getVar('id');
                $databarang = $this->modeldetailpenjualan->getDetailoneJual($id);
                // $datamaster = $this->datastock->getBarangkode($databarang['kode']);
                $filesampul = $this->request->getFile('gambar1');
                $kode = $this->request->getVar('kel');
                $qty = $this->request->getVar('qty1');
                $harga = $this->request->getVar('harga_beli1');
                $berat = $this->request->getVar('berat1');
                $carat = $this->request->getVar('carat1');
                $nilaitukar = ($this->request->getVar('nilai_tukar1')) ? $this->request->getVar('nilai_tukar1') : 0;
                $checkkel = $this->modelbuyback->getDataBuyback($this->request->getVar('iddate'));
                $saldocarat = 0;
                if ($checkkel['kelompok'] == $kode || $checkkel['kelompok'] == 0) {
                    $check = ($kode == 4) ? $berat : $qty;
                    if ($databarang['saldo'] >= $check && $check >= 0 && $check != 0) {
                        if ($kode == 1) {
                            $statusproses = $this->request->getVar('status_proses');
                            $beratmurni = round($berat * ($nilaitukar / 100), 2);
                            $totalharga =  $berat * $harga;
                            $carat = 0;
                        } elseif ($kode == 2) {
                            $statusproses = $this->request->getVar('status_proses');
                            $totalharga = $harga;
                            $beratmurni = 0;
                            $carat = 0;
                        } elseif ($kode == 3) {
                            $statusproses = 'Murni';
                            $totalharga =  ($berat * $qty) * $harga;
                            $beratmurni = 0;
                            $carat = 0;
                        } elseif ($kode == 4) {
                            $statusproses = 'Murni';
                            $totalharga =  $berat * $harga;
                            $beratmurni = 0;
                            $carat = 0;
                        } elseif ($kode == 5) {
                            $statusproses = 'Murni';
                            $totalharga =  $carat * $harga;
                            $saldocarat = $databarang['saldo_carat'] - $carat;
                            $berat = 0;
                            $beratmurni = 0;
                        } elseif ($kode == 6) {
                            $statusproses = 'Murni';
                            $totalharga = $harga * $qty;
                            $berat = 0;
                            $beratmurni = 0;
                            $carat = 0;
                        }
                        $datapenjualan = $this->penjualan->getDataPenjualan($databarang['id_date_penjualan']);
                        $this->modelbuyback->save([
                            'id_buyback' =>  $checkkel['id_buyback'],
                            'id_karyawan' => $session->get('id_user'),
                            'kelompok' =>  $kode,
                        ]);
                        if ($filesampul->getError() != 4 || $this->request->getPost('gambar1')) {
                            if (file_exists('img/' .  $databarang['nama_img'])) {
                                unlink('img/' . $databarang['nama_img']); //untuk hapus file
                            }
                            if ($this->request->getPost('gambar1')) {
                                $image = $this->request->getPost('gambar1');
                                $image = str_replace('data:image/jpeg;base64,', '', $image);
                                $image = base64_decode($image, true);
                                $namafile = date('ymdhis') . $databarang['kode'] . '.jpg';
                                file_put_contents(FCPATH . '/img/' . $namafile, $image);
                            } else {
                                $filesampul = $this->request->getFile('gambar');
                                if ($filesampul->getError() == 4) {
                                    $namafile = 'default.jpg';
                                } else {
                                    $namafile = date('ymdhis') . $databarang['kode'] . '.jpg'; // pake nama random
                                    // $namafile = $filesampul->getName(); // ini pake nama asli di foto
                                    $filesampul->move('img', $namafile);
                                }
                            }
                        } else {
                            $namafile = 'default.jpg';
                        }
                        $this->modeldetailbuyback->save([
                            'nama_img' =>  $namafile,
                            'id_karyawan' => $session->get('id_user'),
                            'id_date_buyback' => $this->request->getVar('iddate'),
                            'id_detail_penjualan' => $databarang['id_detail_penjualan'],
                            'kode' =>  $databarang['kode'],
                            'qty' => $qty,
                            'jenis' =>  $this->request->getVar('jenis1'),
                            'model' =>  $this->request->getVar('model1'),
                            'status' =>  $databarang['status'],
                            'keterangan' => $this->request->getVar('keterangan1'),
                            'carat' => $carat,
                            'berat' =>  $berat,
                            'berat_murni' =>  $beratmurni,
                            'harga_beli' =>  $harga,
                            'ongkos' => $databarang['ongkos'],
                            'kadar' =>   $this->request->getVar('kadar1'),
                            'nilai_tukar' => $nilaitukar,
                            'merek' => $this->request->getVar('merek1'),
                            'no_nota' => $datapenjualan['no_transaksi_jual'],
                            'total_harga' => $totalharga,
                            'status_proses' => $statusproses
                        ]);
                        $this->modeldetailpenjualan->save([
                            'id_detail_penjualan' => $databarang['id_detail_penjualan'],
                            'id_karyawan' => $session->get('id_user'),
                            'saldo_carat' => $saldocarat,
                            'saldo' => ($kode == 4) ? $databarang['saldo'] - $this->request->getVar('berat1') : $databarang['saldo'] - $this->request->getVar('qty1'),
                        ]);
                        $msg = 'sukses';
                    } else {
                        $msg = [
                            'error' => [
                                'kurang' => 'Saldo Kurang'

                            ]
                        ];
                    }
                } else {
                    $msg = [
                        'error' => [
                            'kurang' => 'Kelompok Barang Berbeda'

                        ]
                    ];
                }
                echo json_encode($msg);
            }
        }
    }

    public function KodeDatailGenerate($id)
    {
        if ($id == 1) {
            $kodestock = $this->datastock->getKodeStock($id);
        } elseif ($id == 2) {
            $kodestock = $this->datastock2->getKodeStock($id);
        } elseif ($id == 3) {
            $kodestock = $this->datastock3->getKodeStock($id);
        } elseif ($id == 4) {
            $kodestock = $this->datastock4->getKodeStock($id);
        } elseif ($id == 5) {
            $kodestock = $this->datastock5->getKodeStock($id);
        } elseif ($id == 6) {
            $kodestock = $this->datastock6->getKodeStock($id);
        }
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
    public function DataBayarBuyback()
    {
        if ($this->request->isAJAX()) {

            $totalharga = $this->modeldetailbuyback->SumTotalHargaBuyback($this->request->getVar('dateid'));

            echo json_encode($totalharga);
        }
    }
    public function NoTransaksiGenerateBuyback()
    {
        $data = $this->modelbuyback->getNoTrans();
        if ($this->modelbuyback->getNoTrans()) {
            if (substr($data['no_transaksi_buyback'], 0, 2) == date('y')) {
                $valnotransaksi = substr($data['no_transaksi_buyback'], 4, 10) + 1;
                $notransaksi = 'B-' . date('ym') . str_pad($valnotransaksi, 4, '0', STR_PAD_LEFT);

                return $notransaksi;
            } else {
                $notransaksi = 'B-' . date('ym') . str_pad(1, 4, '0', STR_PAD_LEFT);

                return $notransaksi;
            }
        } else {
            $notransaksi = 'B-' . date('ym') . str_pad(1, 4, '0', STR_PAD_LEFT);

            return $notransaksi;
        }
    }

    public function ScanBarcodeData()
    {
        if ($this->request->isAJAX()) {
            $databarcode = $this->modeldetailpenjualan->getDetailKode($this->request->getVar('nobarcode'));
            if ($databarcode) {
                $datatrans = $this->penjualan->getDataPenjualan($databarcode['id_date_penjualan']);
                if ($datatrans != null && $datatrans['pembayaran'] != 'Bayar Nanti') {
                    $data = [
                        'tampildata' => $this->modeldetailpenjualan->getDetailAlljual($datatrans['id_date_penjualan']),
                        'tampildatabuyback' => $this->modeldetailbuyback->getDetailAllBuyback(),
                        'kel' => $datatrans['kelompok']

                    ];
                    $msg = [
                        'data' => view('buybackcust/datamodaldenganota', $data),
                        'datacust' =>  $datatrans['nohp_cust'],
                    ];
                } else {
                    $msg = [
                        'pesan_error' => 'Tidak ada Data Barcode'
                    ];
                }
            } else {
                $msg = [
                    'pesan_error' => 'Tidak ada Data Barcode'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function TampilBuybackTable()
    {
        if ($this->request->isAJAX()) {
            $data = $this->modelbuyback->DataFilterBuyback($this->request->getVar('tmpildata'), $this->request->getVar('kelompok'), $this->request->getVar('status'),  $this->request->getVar('notrans'));
            $view = ['databuyback' => $data];
            $msg = ['tampildata' => view('buybackcust/tampilbuyback', $view)];

            echo json_encode($msg);
        }
    }
    public function FormNoNota()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'kel' => $this->request->getVar('kel'),
                'merek' => $this->datamerek->getMerek(),
                'bank' => $this->modelbank->getBank(),
                'kadar' => $this->datakadar->getKadar(),
                'jenis' => $this->datajenis->getJenis(),
                'supplier' => $this->datasupplier->getSupplier(),
            ];
            $view = view('buybackcust/formnonota', $data);
            $msg = ['form' => $view];

            echo json_encode($msg);
        }
    }
}
