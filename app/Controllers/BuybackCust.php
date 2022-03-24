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
use App\Models\ModelBuyback;
use App\Models\ModelKartuStock;
use App\Models\ModelDetailKartuStock;
use App\Models\ModelBank;
use App\Models\ModelCustomer;
use App\Models\ModelJenis;


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
        $this->modelbuyback = new ModelBuyback();
        $this->modelkartustock = new ModelKartuStock();
        $this->modeldetailkartustock = new ModelDetailKartuStock();
        $this->modelbank = new ModelBank();
        $this->datacust = new ModelCustomer();
        $this->datajenis = new ModelJenis();
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

    public function detail_pembelian()
    {
        $session = session();
        $dateid = date("ymdhis");
        $session->set('date_id', $dateid);
        $notransaksi = $this->NoTransaksiGenerateBuyback();
        $this->datapembelian->save([
            'id_date_pembelian' => $session->get('date_id'),
            'nama_supplier' => '-',
            'id_karyawan' => $session->get('id_user'),
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
    public function HalamanTambah()
    {
        $session = session();
        $dateidbuyback = date('ymdhis');
        $this->modelbuyback->save([
            // 'created_at' => date("y-m-d"),
            'id_date_buyback' => $dateidbuyback,
            'no_transaksi_buyback' => $this->NoTransaksiGenerateBuyback(),
            'id_karyawan' => $session->get('id_user'),
            'total_berat' => 0,
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
                    'tampildatabuyback' => $this->modeldetailbuyback->getDetailAllBuyback(),

                ];
                $msg = [
                    'data' => view('buybackcust/datamodaldenganota', $data),
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
                'tampildata' => $datadetail,
                // 'tampildatabuyback' => $this->modeldetailbuyback->getDetailAllBuyback(),
            ];
            $msg = [
                'data' => view('buybackcust/detailtablebuyback', $data),
                'totalharga' => ($totalharga['total_harga'] == null) ? 0 : $totalharga['total_harga'],
                'totalberat' => $totalberat
            ];
            echo json_encode($msg);
        }
    }
    function ModalBarcode()
    {
        if ($this->request->isAJAX()) {
            $databarcode = $this->datastock->getBarcode($this->request->getVar('kel'));
            $databar = [
                'databarcode' => $databarcode,
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
            $validation = \Config\Services::validation();
            if ($this->request->getVar('pembayaran') == 'Transfer') {
                $valid = $this->validate([
                    'inputcustomer' => [
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
            if ($this->request->getVar('pembayaran') == 'Tunai') {
                $valid = $this->validate([
                    'inputcustomer' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'No hp Harus di isi',
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
                    'inputcustomer' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'No hp Harus di isi',
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
                        'inputcustomer' => $validation->getError('inputcustomer'),
                        'tunai' => $validation->getError('tunai'),
                        'transfer' => $validation->getError('transfer'),
                        'namabank' => $validation->getError('namabank'),
                        'pembayaran' => 'Pembayaran Harus di Isi',
                    ]
                ];
                echo json_encode($msg);
            } else {
                $session = session();
                $databuyback = $this->modelbuyback->getDataBuyback($this->request->getVar('iddate'));
                $hasilbayar = $databuyback['total_harga'] - ($this->request->getVar('tunai') + $this->request->getVar('transfer'));
                if ($hasilbayar == 0 && $databuyback['total_harga'] != 0) {
                    $datadetail = $this->modeldetailbuyback->getDetailAllBuyback($this->request->getVar('iddate'));
                    $this->modelbuyback->save([
                        'id_buyback' => $databuyback['id_buyback'],
                        'id_karyawan' => $session->get('id_user'),
                        'pembayaran' => $this->request->getVar('pembayaran'),
                        'nohp_cust' => $this->request->getVar('inputcustomer'),
                        'tunai' => $this->request->getVar('tunai'),
                        'transfer' => $this->request->getVar('transfer'),
                        'nama_bank' => $this->request->getVar('namabank'),
                        'tgl_selesai' => date("Y-m-d h:i:s"),
                        'status_dokumen' => 'Selesai'
                    ]);

                    foreach ($datadetail as $row) {
                        if ($row['no_nota'] == 'NoNota') {
                            $datamasterstock = $this->datastock->getBarangkode($row['kode']);
                            $datakartu = $this->modelkartustock->getKartuStockkode($row['kode']);
                            if ($datakartu) {
                                $saldoakhir = (substr($row['kode'], 0, 1) == 4) ? $row['berat'] + $datakartu['saldo_akhir']  : $row['qty'] + $datakartu['saldo_akhir'];
                            } else {
                                $saldoakhir = (substr($row['kode'], 0, 1) == 4) ? $row['berat'] : $row['qty'];
                            }

                            if (substr($row['kode'], 0, 1) == 4) {
                                $this->datastock->save([
                                    'id_stock' => $datamasterstock['id_stock'],
                                    'id_karyawan' => $session->get('id_user'),
                                    'status' => 'B',
                                    'no_faktur' => $databuyback['no_transaksi_buyback'],
                                    'tgl_faktur' => date("Y-m-d H:i:s"),
                                    'nama_supplier' => $this->request->getVar('inputcustomer'),
                                    'qty' => 1,
                                    'jenis' => $row['jenis'],
                                    'model' => $row['model'],
                                    'keterangan' => $row['keterangan'],
                                    'merek' => $row['merek'],
                                    'kadar' => $row['kadar'],
                                    'berat_murni' => $row['berat_murni'],
                                    'berat' =>  $saldoakhir,
                                    'nilai_tukar' =>  $row['nilai_tukar'],
                                    'ongkos' => $row['ongkos'],
                                    'harga_beli' => $row['harga_beli'],
                                    'total_harga' => $saldoakhir * $row['harga_beli'],
                                    'gambar' =>  $row['nama_img'],
                                ]);
                            }
                            if (substr($row['kode'], 0, 1) == 3) {
                                $this->datastock->save([
                                    'id_stock' => $datamasterstock['id_stock'],
                                    'id_karyawan' => $session->get('id_user'),
                                    'status' => 'B',
                                    'no_faktur' => $databuyback['no_transaksi_buyback'],
                                    'tgl_faktur' => date("Y-m-d h:i:s"),
                                    'nama_supplier' => $this->request->getVar('inputcustomer'),
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
                            $this->modeldetailkartustock->save([
                                // 'id_detail_kartustock' => $datadetailkartu['id_detail_kartustock'],
                                'barcode' => $row['kode'],
                                'id_karyawan' => $session->get('id_user'),
                                'status' => 'Keluar',
                                'no_faktur' => $databuyback['no_transaksi_buyback'],
                                'tgl_faktur' => $databuyback['created_at'],
                                'nama_customer' => $this->request->getVar('inputcustomer'),
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
                            if ($datakartu) {
                                $this->modelkartustock->save([
                                    'id_kartustock' => $datakartu['id_kartustock'],
                                    'id_karyawan' => $session->get('id_user'),
                                    'total_masuk' => $this->modeldetailkartustock->SumMasukKartu($row['kode']),
                                    'total_keluar' => $this->modeldetailkartustock->SumKeluarKartu($row['kode']),
                                    'saldo_akhir' => $saldoakhir,
                                ]);
                            } else {
                                $this->modelkartustock->save([
                                    'kode' => $row['kode'],
                                    'id_karyawan' => $session->get('id_user'),
                                    'total_masuk' => $this->modeldetailkartustock->SumMasukKartu($row['kode']),
                                    'total_keluar' => $this->modeldetailkartustock->SumKeluarKartu($row['kode']),
                                    'saldo_akhir' => $saldoakhir,
                                ]);
                            }
                        } else {
                            $datakartu = $this->modelkartustock->getKartuStockkode($row['kode']);
                            $saldoakhir = (substr($row['kode'], 0, 1) == 4) ? $datakartu['saldo_akhir'] + $row['berat'] : $datakartu['saldo_akhir'] + $row['qty'];
                            if (substr($row['kode'], 0, 1) == 4) {
                                $datamasterstock = $this->datastock->getBarangkode($row['kode']);
                                $this->datastock->save([
                                    'id_stock' => $datamasterstock['id_stock'],
                                    'id_karyawan' => $session->get('id_user'),
                                    // 'barcode' => $row['kode'],
                                    'status' => 'B',
                                    'no_faktur' => $databuyback['no_transaksi_buyback'],
                                    'tgl_faktur' => date("Y-m-d h:i:s"),
                                    'nama_supplier' => $this->request->getVar('inputcustomer'),
                                    'qty' => 1,
                                    'jenis' => $row['jenis'],
                                    'model' => $row['model'],
                                    'keterangan' => $row['keterangan'],
                                    'merek' => $row['merek'],
                                    'kadar' => $row['kadar'],
                                    'berat_murni' => $row['berat_murni'],
                                    'berat' =>  $saldoakhir,
                                    'nilai_tukar' =>  $row['nilai_tukar'],
                                    'ongkos' => $row['ongkos'],
                                    'harga_beli' => $row['harga_beli'],
                                    'total_harga' => $row['total_harga'],
                                    'gambar' =>  $row['nama_img'],
                                ]);
                            }
                            if (substr($row['kode'], 0, 1) == 3) {
                                $datamasterstock = $this->datastock->getBarangkode($row['kode']);
                                $this->datastock->save([
                                    'id_stock' => $datamasterstock['id_stock'],
                                    'id_karyawan' => $session->get('id_user'),
                                    'status' => 'B',
                                    'no_faktur' => $databuyback['no_transaksi_buyback'],
                                    'tgl_faktur' => date("Y-m-d h:i:s"),
                                    'nama_supplier' => $this->request->getVar('inputcustomer'),
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
                    $msg = 'asd';
                } else {
                    $msg = [
                        'error' => [
                            'bayar' => 'Bayar Lebih / Kurang',
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
                    'harga_beli' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Berat Bersih Harus di isi',
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
                            'required' => 'Harga Harus di isi',
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

                ]);
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
                    ]
                ];
                echo json_encode($msg);
            } else {
                $session = session();
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
                $kode = $this->request->getVar('kelompok');
                $qty = $this->request->getVar('qty');
                $harga = $this->request->getVar('harga_beli');
                $berat = $this->request->getVar('berat');
                $beratmurni = $berat * ($this->request->getVar('nilai_tukar') / 100);
                if ($kode == 1 || $kode == 4 ||  $kode == 5 ||  $kode == 6) {
                    $totalharga =  $beratmurni *  $harga;
                }
                if ($kode == 2) {
                    $totalharga = $harga;
                }
                if ($kode == 3) {
                    $totalharga =  $beratmurni *  $harga * $qty;
                }

                if ($kode != 1 && $kode != 2) {
                    $barcode = $this->request->getVar('barcode');
                    // $checkcode = $this->datastock->getBarangkode($barcode);
                    if ($barcode) {
                        $this->modeldetailbuyback->save([
                            'nama_img' => $namafile,
                            'id_karyawan' => $session->get('id_user'),
                            'id_date_buyback' => $this->request->getVar('iddate'),
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
                            'status_proses' => 'Murni'
                        ]);
                        $msg = 'SUkses Barcode Lama';
                    } else {
                        $barcode = $this->KodeDatailGenerate($this->request->getVar('kelompok'));
                        $this->modeldetailbuyback->save([
                            'nama_img' => $namafile,
                            'id_karyawan' => $session->get('id_user'),
                            'id_date_buyback' => $this->request->getVar('iddate'),
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
                            'status_proses' => 'Murni'
                        ]);
                        $this->datastock->save([
                            'barcode' => $barcode,
                            'id_karyawan' => $session->get('id_user'),
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
                        $msg = [
                            'barcodebaru' => [
                                'barcode' => 'Barcode tidak ada & dibikin baru',
                            ]
                        ];
                    }
                } else {
                    $barcode = $this->KodeDatailGenerate($this->request->getVar('kelompok'));
                    $this->modeldetailbuyback->save([
                        'nama_img' => $namafile,
                        'id_karyawan' => $session->get('id_user'),
                        'id_date_buyback' => $this->request->getVar('iddate'),
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
                        'id_karyawan' => $session->get('id_user'),
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

            $data = $this->modeldetailbuyback->getDataDetailKode($id);
            $datakartu = $this->modelkartustock->getKartuStockkode($data['kode']);

            if ($data['no_nota'] == 'NoNota') {
                if ($datakartu) {
                    $this->modeldetailbuyback->delete($id);
                } else {
                    $datastock = $this->datastock->getBarangkode($data['kode']);
                    $this->datastock->delete($datastock['id_stock']);
                    if ($data['nama_img'] != 'default.jpg') { //buyback dengan nota, foto ikut terhapus
                        unlink('img/' . $data['nama_img']); //untuk hapus file
                    }
                    $this->modeldetailbuyback->delete($id);
                }
            } else {
                $session = session();
                $datadetailpenjualan = $this->modeldetailpenjualan->getDetailoneJual($data['id_detail_penjualan']);
                $this->modeldetailpenjualan->save([
                    'id_detail_penjualan' => $data['id_detail_penjualan'],
                    'id_karyawan' => $session->get('id_user'),
                    'saldo' => (substr($data['kode'], 0, 1) == 4) ? $data['berat'] + $datadetailpenjualan['saldo'] : $data['qty'] + $datadetailpenjualan['saldo']
                ]);
                $this->modeldetailbuyback->delete($id);
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
                $this->datastock->delete($datastock['id_stock']);
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

            $valid = $this->validate([
                'nilai_tukar1' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nilai Tukar Harus di isi',
                    ]
                ],
                'berat1' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Berat Harus di isi',
                    ]
                ],
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

                    ]
                ];
                echo json_encode($msg);
            } else {
                $session = session();
                $id = $this->request->getVar('id');
                $databarang = $this->modeldetailpenjualan->getDetailoneJual($id);
                // $datamaster = $this->datastock->getBarangkode($databarang['kode']);
                $kode = substr($databarang['kode'], 0, 1);
                $qty = $this->request->getVar('qty1');
                $harga = $this->request->getVar('harga_beli1');
                $berat = $this->request->getVar('berat1');
                if ($kode == 4) {
                    $check = $berat;
                } else {
                    $check = $qty;
                }
                if ($databarang['saldo'] >= $check && $check >= 0 && $check != 0) {
                    $beratmurni = $berat * ($this->request->getVar('nilai_tukar1') / 100);
                    if ($kode == 1 || 4 || 5) {
                        $totalharga =  $beratmurni * $harga;
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
                        'id_karyawan' => $session->get('id_user'),
                        'id_date_buyback' => $this->request->getVar('iddate'),
                        'id_detail_penjualan' => $databarang['id_detail_penjualan'],
                        'kode' =>  $databarang['kode'],
                        'qty' => $this->request->getVar('qty1'),
                        'jenis' =>  $databarang['jenis'],
                        'model' =>  $databarang['model'],
                        'status' => $this->request->getVar('status_proses'),
                        'keterangan' =>  $databarang['keterangan'],
                        'berat' =>  $this->request->getVar('berat1'),
                        'berat_murni' =>  $beratmurni,
                        'harga_beli' =>  $this->request->getVar('harga_beli1'),
                        'ongkos' => $databarang['ongkos'],
                        'kadar' =>   $databarang['kadar'],
                        'nilai_tukar' => $this->request->getVar('nilai_tukar1'),
                        'merek' => $databarang['merek'],
                        'no_nota' => $datapenjualan['no_transaksi_jual'],
                        'total_harga' => $totalharga,
                        'status_proses' => $this->request->getVar('status_proses')
                    ]);
                    $this->modeldetailpenjualan->save([
                        'id_detail_penjualan' => $databarang['id_detail_penjualan'],
                        'id_karyawan' => $session->get('id_user'),
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
}
