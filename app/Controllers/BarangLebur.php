<?php

namespace App\Controllers;

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use App\Models\ModelDetailBuyback;
use App\Models\ModelPenjualan;
use App\Models\ModelDetailPenjualan;
use App\Models\ModelKadar;
use App\Models\ModelMerek;
use App\Models\ModelSupplier;
use App\Models\ModelStock4;
use App\Models\ModelKartuStock;
use App\Models\ModelDetailKartuStock;
use App\Models\ModelLebur;
use App\Models\ModelDetailLebur;
use App\Models\ModelDetailMasuk;
use App\Models\ModelJenis;
use App\Models\ModelTukang;

use CodeIgniter\Model;
use CodeIgniter\Validation\Rules;
use Faker\Provider\ar_EG\Person;
use PhpParser\Node\Expr\Isset_;

class BarangLebur extends BaseController
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
        $this->datastock = new ModelStock4();
        $this->modelkartustock = new ModelKartuStock();
        $this->modeldetailkartustock = new ModelDetailKartuStock();
        $this->modellebur = new ModelLebur();
        $this->modeldetaillebur = new ModelDetailLebur();
        $this->detailbeli = new ModelDetailMasuk();
        $this->datajenis = new Modeljenis();
        $this->modeltukang = new ModelTukang();
    }

    public function HomeLebur()
    {
        // $asd = $this->modeldetailbuyback->JumlahDataBuyback(220311121607);
        // dd($asd['total']);
        $data = [
            'datalebur' => $this->modellebur->getDataLeburAll(),
        ];
        return view('leburbarang/data_lebur', $data);
    }
    public function TampilDataLebur()
    {
        if ($this->request->isAJAX()) {
            $data = $this->modellebur->DataFilterLebur($this->request->getVar('tmpildata'), $this->request->getVar('kelompok'), $this->request->getVar('status'),  $this->request->getVar('notrans'));
            $view = ['datalebur' => $data];
            $msg = ['tampildata' => view('leburbarang/tampildatalebur', $view)];
            echo json_encode($msg);
        }
    }
    public function UbahStatus()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $databuyback = $this->modeldetailbuyback->getDataDetailKode($this->request->getVar('id'));
            $this->modeldetailbuyback->save([
                'id_detail_buyback' => $databuyback['id_detail_buyback'],
                'id_karyawan' => $session->get('id_user'),
                'status_proses' => $this->request->getVar('status')
            ]);
            $msg = 'sukses ubahstatus';
            echo json_encode($this->request->getVar('status'));
        }
    }
    public function LeburBarang()
    {
        $session = session();
        $nolebur = $this->NoTransaksiGenerateLebur();
        $dateid = date('ymdhis') . substr($nolebur, 6, 4);
        $this->modellebur->save([
            // 'created_at' => date("y-m-d"),
            'id_date_lebur' => $dateid,
            'no_lebur' => $nolebur,
            'id_karyawan' => $session->get('id_user'),
            'nama_img' => 'default.jpg',
            'kode' => '-',
            'jenis' => '-',
            'model' => '-',
            'keterangan' => '-',
            'kadar' => '24K',
            'berat_murni' => '0',
            'total_berat' => '0',
            'qty' => '0',
            'tanggal_lebur' => date('y-m-d H:i:s'),
            'total_harga_bahan' => '0',
            'status_dokumen' => 'Draft'
        ]);
        //---------------------------------------------------
        return redirect()->to('/draftlebur/' . $dateid);
    }
    public function DraftLeburBarang($id)
    {
        // dd($this->modeldetaillebur->JumlahBarang(220317091458));
        $data = [
            'datamasterlebur' => $this->modellebur->getDataLeburAll($id),
            'datalebur' => $this->modeldetailbuyback->getDataLeburAll(),
            'jenis' => $this->datajenis->getJenis(),
            'datatukang' => $this->modeltukang->getTukang(),
            'databarcode' => $this->datastock->getBarcode(4),
            'dataakanlebur' => $this->modeldetaillebur->getDetailLebur($id),

        ];
        return view('leburbarang/lebur_barang', $data);
    }
    public function SelesaiLebur()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $filesampul = $this->request->getFile('gambar');
            if ($filesampul->getError() != 4 || $this->request->getPost('gambar')) {
                $valid = $this->validate([
                    'jenis' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Jenis Harus di isi',
                        ]
                    ],
                    'berat' => [
                        'rules' => 'required|greater_than[0]',
                        'errors' => [
                            'required' => 'Berat Harus di isi',
                            'greater_than' => 'Harus lebih dari 0',
                        ]
                    ],
                ]);
            } else {
                $valid = $this->validate([
                    'jenis' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Jenis Harus di isi',
                        ]
                    ],
                    'berat' => [
                        'rules' => 'required|greater_than[0]',
                        'errors' => [
                            'required' => 'Berat Harus di isi',
                            'greater_than' => 'Harus lebih dari 0',
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
                $datadetaillebur =  $this->modeldetaillebur->getDetailLebur($this->request->getVar('dateidlebur'));
                $datalebur = $this->modellebur->getDataLeburAll($this->request->getVar('dateidlebur'));
                $checkkode = $this->datastock->getBarangkode($this->request->getVar('barcode'));

                if ($datadetaillebur) {
                    if ($this->request->getVar('barcode') && $checkkode) { // jikda ada barcode
                        $datakartu = $this->modelkartustock->getKartuStockkode($checkkode['barcode']);
                        $saldoakhir = $this->request->getVar('berat') + $datakartu['saldo_akhir'];

                        $this->modellebur->save([
                            'id_lebur' => $datalebur['id_lebur'],
                            'id_karyawan' => $session->get('id_user'),
                            'nama_img'  =>  $namafile,
                            'kode' => $checkkode['barcode'],
                            'jenis' => $this->request->getVar('jenis'),
                            'model' => $this->request->getVar('model'),
                            'nama_tukang' => $this->request->getVar('nama_tukang'),
                            'keterangan' =>  $this->request->getVar('keterangan'),
                            'kadar' => '24K',
                            'berat_murni' => $this->request->getVar('berat'),
                            'tanggal_lebur' => $this->request->getVar('tanggallebur') . ' ' . date('H:i:s'),
                            'status_dokumen' => 'Selesai'
                        ]);

                        $this->datastock->save([
                            'id_stock_4' => $checkkode['id_stock_4'],
                            'id_karyawan' => $session->get('id_user'),
                            'status' => '24K',
                            'no_faktur' => $datalebur['no_lebur'],
                            'tgl_faktur' => $this->request->getVar('tanggallebur'),
                            'nama_supplier' => $datalebur['no_lebur'],
                            'jenis' => $this->request->getVar('jenis'),
                            'model' => $this->request->getVar('model'),
                            'keterangan' => $this->request->getVar('keterangan'),
                            'kadar' => '24K',
                            'berat' => $saldoakhir,
                            'harga_beli' => round($datalebur['total_harga_bahan'] / $this->request->getVar('berat'), 2),
                            'total_harga' => $saldoakhir * round($datalebur['total_harga_bahan'] / $this->request->getVar('berat'), 2),
                            'gambar' =>  $namafile,
                        ]);

                        $this->modeldetailkartustock->save([
                            // 'id_detail_kartustock' => $datadetailkartu['id_detail_kartustock'],
                            'barcode' => $checkkode['barcode'],
                            'status' => 'Masuk',
                            'no_faktur' => $datalebur['no_lebur'],
                            'id_karyawan' => $session->get('id_user'),
                            'tgl_faktur' => $this->request->getVar('tanggallebur'),
                            'nama_customer' => 'Lebur Barang',
                            'saldo' => $saldoakhir,
                            'masuk' =>  $this->request->getVar('berat'),
                            'keluar' => 0,
                            'jenis' => $this->request->getVar('jenis'),
                            'model' =>  $this->request->getVar('model'),
                            'keterangan' => $this->request->getVar('keterangan'),
                            'merek' => '-',
                            'kadar' => '24K',
                            'berat' => $this->request->getVar('berat'),
                            'nilai_tukar' =>  '100',
                            'harga_beli' => round($datalebur['total_harga_bahan'] / $this->request->getVar('berat'), 2),
                            'total_harga' => $datalebur['total_harga_bahan'],
                            'gambar' =>  $namafile,
                        ]);
                        $this->KartuStockMaster($checkkode['barcode'], $session);
                        $msg = $saldoakhir;
                    } else { // jika tanpa barcode, create baru
                        $barcode = $this->KodeDatailGenerate(4);
                        $this->modellebur->save([
                            'id_lebur' => $datalebur['id_lebur'],
                            'id_karyawan' => $session->get('id_user'),
                            'nama_img'  =>  $namafile,
                            'kode' => $barcode,
                            'jenis' => $this->request->getVar('jenis'),
                            'model' => $this->request->getVar('model'),
                            'nama_tukang' => $this->request->getVar('nama_tukang'),
                            'keterangan' =>  $this->request->getVar('keterangan'),
                            'kadar' => '24K',
                            'berat_murni' => $this->request->getVar('berat'),
                            'tanggal_lebur' => $this->request->getVar('tanggallebur') . ' ' . date('H:i:s'),
                            'status_dokumen' => 'Selesai'
                        ]);

                        $this->datastock->save([
                            'barcode' => $barcode,
                            'id_karyawan' => $session->get('id_user'),
                            'status' => '24K',
                            'no_faktur' => $datalebur['no_lebur'],
                            'tgl_faktur' => $this->request->getVar('tanggallebur'),
                            'nama_supplier' => $datalebur['no_lebur'],
                            'qty' => '1',
                            'jenis' => $this->request->getVar('jenis'),
                            'model' => $this->request->getVar('model'),
                            'keterangan' => $this->request->getVar('keterangan'),
                            'merek' => '-',
                            'kadar' => '24K',
                            'berat' => $this->request->getVar('berat'),
                            'harga_beli' => round($datalebur['total_harga_bahan'] / $this->request->getVar('berat'), 2),
                            'total_harga' => round($datalebur['total_harga_bahan'] / $this->request->getVar('berat'), 2) * $this->request->getVar('berat'),
                            'gambar' =>  $namafile,
                        ]);
                        $this->modelkartustock->save([
                            'kode' => $barcode,
                            'id_karyawan' => $session->get('id_user'),
                            'total_masuk' => $this->request->getVar('berat'),
                            'total_keluar' => 0,
                            'saldo_akhir' => $this->request->getVar('berat'),
                        ]);
                        $this->modeldetailkartustock->save([
                            // 'id_detail_kartustock' => $datadetailkartu['id_detail_kartustock'],
                            'barcode' => $barcode,
                            'id_karyawan' => $session->get('id_user'),
                            'status' => 'Masuk',
                            'no_faktur' => $datalebur['no_lebur'],
                            'tgl_faktur' => $this->request->getVar('tanggallebur'),
                            'nama_customer' => 'Lebur Barang',
                            'saldo' => $this->request->getVar('berat'),
                            'masuk' =>  $this->request->getVar('berat'),
                            'keluar' => 0,
                            'jenis' => $this->request->getVar('jenis'),
                            'model' =>  $this->request->getVar('model'),
                            'keterangan' => $this->request->getVar('keterangan'),
                            'merek' => '-',
                            'kadar' => '24K',
                            'berat' => $this->request->getVar('berat'),
                            'nilai_tukar' =>  0,
                            'harga_beli' => round($datalebur['total_harga_bahan'] / $this->request->getVar('berat'), 2),
                            'total_harga' => $datalebur['total_harga_bahan'],
                            'gambar' =>  $namafile,
                        ]);


                        $msg = $barcode;
                    }
                    foreach ($datadetaillebur as $row) {
                        $datadetailkartu = $this->modelkartustock->getKartuStockkode($row['kode']);
                        $this->modeldetailkartustock->save([
                            'barcode' => $row['kode'],
                            'status' => 'Keluar',
                            'id_karyawan' => $session->get('id_user'),
                            'no_faktur' => $datalebur['no_lebur'],
                            'tgl_faktur' => $datalebur['tanggal_lebur'] . ' ' . date('H:i:s'),
                            'nama_customer' => $datalebur['no_lebur'],
                            'saldo' => $datadetailkartu['saldo_akhir'] - $row['qty'],
                            'masuk' => 0,
                            'keluar' => $row['qty'],
                            'jenis' => $row['jenis'],
                            'model' => $row['model'],
                            'keterangan' => 'Lebur Barang',
                            'merek' => $row['merek'],
                            'kadar' => $row['kadar'],
                            'berat' => $row['berat'],
                            'nilai_tukar' =>  $row['nilai_tukar'],
                            'harga_beli' => $row['harga_beli'],
                            'total_harga' => $row['total_harga'],
                            'gambar' =>  $row['nama_img'],
                        ]);
                        $this->KartuStockMaster($row['kode'], $session);
                    }
                } else {
                    $msg = [
                        'error' => [
                            'data' => 'Tidak ada Data',
                        ]
                    ];
                }
                echo json_encode($msg);
            }
        }
    }
    public function TambahLebur()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $kode = $this->request->getVar('kode');
            $iddate =  $this->request->getVar('iddate');
            $datalebur = $this->modellebur->getDataLeburAll($iddate);
            $databuyback = $this->modeldetailbuyback->getDataDetailKode($kode);
            $datadetaillebur = $this->modeldetaillebur->CheckDataLebur($databuyback['id_detail_buyback']);
            if (!$datadetaillebur) {
                $this->modeldetaillebur->save([
                    'id_date_lebur' => $iddate,
                    'id_karyawan' => $session->get('id_user'),
                    'id_detail_buyback' => $databuyback['id_detail_buyback'],
                    'nama_img' => $databuyback['nama_img'],
                    'kode' =>  $databuyback['kode'],
                    'qty' => $databuyback['qty'],
                    'jenis' =>  $databuyback['jenis'],
                    'model' =>  $databuyback['model'],
                    'keterangan' =>  $databuyback['keterangan'],
                    'berat' =>  $databuyback['berat'],
                    'berat_murni' =>  $databuyback['berat_murni'],
                    'harga_beli' =>  $databuyback['harga_beli'],
                    'ongkos' => $databuyback['ongkos'],
                    'kadar' =>   $databuyback['kadar'],
                    'nilai_tukar' =>   $databuyback['nilai_tukar'],
                    'merek' =>  $databuyback['merek'],
                    'total_harga' => $databuyback['total_harga'],
                    'status_proses' => $databuyback['status_proses'],
                ]);
                $this->modellebur->save([
                    'id_lebur' => $datalebur['id_lebur'],
                    'id_karyawan' => $session->get('id_user'),
                    'qty' => 1,
                    'total_berat' => round($this->modeldetaillebur->SumBeratKotorLebur($datalebur['id_date_lebur'])['berat'], 2),
                    'jumlah_barang' => $this->modeldetaillebur->JumlahBarang($datalebur['id_date_lebur'])['berat'],
                    'berat_murni' => round($this->modeldetaillebur->GetSumBeratMurni($datalebur['id_date_lebur'])['hasil'], 2),
                    'total_harga_bahan' => round($this->modeldetaillebur->SumBeratHargaLebur($datalebur['id_date_lebur'])['total_harga'], 2)
                ]);
                $this->modeldetailbuyback->save([
                    'id_detail_buyback' => $databuyback['id_detail_buyback'],
                    'id_karyawan' => $session->get('id_user'),
                    'status_proses' => 'SudahLebur' . $datalebur['no_lebur'],
                ]);
                $msg = 'sukses';
            } else {
                $msg = 'gagal';
            }
            echo json_encode($msg);
        }
    }

    public function ModalLebur()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            if ($id == 1) {
                $data = [
                    'datalebur' => $this->modeldetailbuyback->getDataLeburAll(),
                    'pesan' => 'Data Lebur Sebelum Pilih'
                ];
            } else {
                $data = [
                    'datalebur' => $this->modeldetaillebur->getDetailLebur($this->request->getVar('dateid')),
                    'pesan' => 'Data Lebur Sesudah Pilih'
                ];
            }
            $msg = [
                'tampilmodal' => view('leburbarang/modallebur', $data)
            ];
            // $msg = 'sukses';
            echo json_encode($msg);
        }
    }
    public function DataDetailBarang()
    {
        if ($this->request->isAJAX()) {
            $tampil = [
                'datadetail' => $this->modeldetailbuyback->getDataDetailKode($this->request->getVar('id'))
            ];
            $data = [
                'data' => view('leburbarang/detailmodelbarang', $tampil)
            ];
            echo json_encode($data);
        }
    }
    public function BatalLebur($id)
    {
        $session = session();
        $datadetaillebur =  $this->modeldetaillebur->getDetailAllLebur($id);
        foreach ($datadetaillebur as $row) {
            $databuyback = $this->modeldetailbuyback->getDataDetailRetur($row['kode']);
            $this->modeldetailbuyback->save([
                'id_detail_buyback' => $databuyback['id_detail_buyback'],
                'id_karyawan' => $session->get('id_user'),
                'status_proses' => 'Lebur'
            ]);
        }
        $this->modeldetaillebur->query('DELETE FROM tbl_detail_lebur WHERE id_date_lebur =' . $id . ';');
        $this->modellebur->query('DELETE FROM tbl_lebur WHERE id_date_lebur =' . $id . ';');
        return redirect()->to('/datalebur');
    }
    public function DeleteLebur()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $kode =  $this->modeldetaillebur->getDataDetailLebur($this->request->getVar('id'));
            $databuyback = $this->modeldetailbuyback->getDataDetailRetur($kode['kode']);
            $datalebur = $this->modellebur->getDataLeburAll($kode['id_date_lebur']);

            $this->modeldetailbuyback->save([
                'id_detail_buyback' => $databuyback['id_detail_buyback'],
                'id_karyawan' => $session->get('id_user'),
                'status_proses' => 'Lebur'
            ]);
            $this->modeldetaillebur->delete($this->request->getVar('id'));
            $this->modellebur->save([
                'id_lebur' => $datalebur['id_lebur'],
                'id_karyawan' => $session->get('id_user'),
                'qty' => 1,
                'total_berat' => round($this->modeldetaillebur->SumBeratKotorLebur($datalebur['id_date_lebur'])['berat'], 2),
                'jumlah_barang' => $this->modeldetaillebur->JumlahBarang($datalebur['id_date_lebur'])['berat'],
                'berat_murni' => round($this->modeldetaillebur->GetSumBeratMurni($datalebur['id_date_lebur'])['hasil'], 2),
                'total_harga_bahan' => round($this->modeldetaillebur->SumBeratHargaLebur($datalebur['id_date_lebur'])['total_harga'], 2)
            ]);
            $msg = 'sukses';
            echo json_encode($msg);
        }
    }
    public function NoTransaksiGenerateLebur()
    {
        $data = $this->modellebur->getNoTransLebur();
        if ($this->modellebur->getNoTransLebur()) {
            if (substr($data['no_lebur'], 0, 2) == date('y')) {
                $valnotransaksi = substr($data['no_lebur'], 4, 10) + 1;
                $notransaksi = 'L-' . date('ym') . str_pad($valnotransaksi, 4, '0', STR_PAD_LEFT);

                return $notransaksi;
            } else {
                $notransaksi = 'L-' . date('ym') . str_pad(1, 4, '0', STR_PAD_LEFT);

                return $notransaksi;
            }
        } else {
            $notransaksi = 'L-' . date('ym') . str_pad(1, 4, '0', STR_PAD_LEFT);

            return $notransaksi;
        }
    }
    public function KodeDatailGenerate($id)
    {
        $kodestock = $this->datastock->getKodeStock($id);

        $kodelebur = $this->modellebur->getKodeLebur($id);

        if ($this->datastock->getKodeStock($id) || $this->detailbeli->getKode($id)) {
            if ($kodestock['kode'] >= $kodelebur['kode']) {
                if (substr($kodestock['kode'], 0, 2) == date('y')) {
                    $valkode = substr($kodestock['kode'], 2, 5) + 1;
                    $notransaksi = $id . date('y') . str_pad($valkode, 5, '0', STR_PAD_LEFT);

                    return $notransaksi;
                } else {
                    $kode = $id . date('y') . str_pad(1, 5, '0', STR_PAD_LEFT);

                    return $kode;
                }
            } else {
                if (substr($kodelebur['kode'], 0, 2) == date('y')) {
                    $valkode = substr($kodelebur['kode'], 2, 5) + 1;
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
