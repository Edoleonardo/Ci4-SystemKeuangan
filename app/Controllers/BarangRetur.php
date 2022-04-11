<?php

namespace App\Controllers;

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use App\Models\ModelDetailBuyback;
use App\Models\ModelPenjualan;
use App\Models\ModelDetailPenjualan;
use App\Models\ModelKadar;
use App\Models\ModelMerek;
use App\Models\ModelHome;
use App\Models\ModelKartuStock;
use App\Models\ModelDetailKartuStock;
use App\Models\ModelRetur;
use App\Models\ModelDetailRetur;
use App\Models\ModelPembelian;
use App\Models\ModelSupplier;
use App\Models\ModelPembayaranBeli;

use CodeIgniter\Model;
use CodeIgniter\Validation\Rules;
use Faker\Provider\ar_EG\Person;
use PhpParser\Node\Expr\Isset_;

class BarangRetur extends BaseController
{


    public function __construct()
    {
        $this->modeldetailpenjualan =  new ModelDetailPenjualan();
        $this->barcodeG =  new BarcodeGenerator();
        $this->barcodeG =  new BarcodeGenerator();
        $this->penjualan =  new ModelPenjualan();
        $this->modeldetailbuyback = new ModelDetailBuyback();
        $this->datakadar = new ModelKadar();
        $this->datamerek = new ModelMerek();
        $this->datastock = new ModelHome();
        $this->modelkartustock = new ModelKartuStock();
        $this->modeldetailkartustock = new ModelDetailKartuStock();
        $this->modelretur = new ModelRetur();
        $this->modeldetailretur = new ModelDetailRetur();
        $this->modelpembelian = new ModelPembelian();
        $this->modelsupplier = new ModelSupplier();
        $this->modelpembayaran = new ModelPembayaranBeli();
    }

    public function HomeRetur()
    {
        // $asd = $this->modeldetailbuyback->JumlahDataBuyback(220311121607);
        // dd($asd['total']);
        $data = [
            'dataretur' => $this->modelretur->getDataReturAll(),
            'datapembelian' => $this->modelpembelian->getPembelianTotalRetur(),
        ];
        return view('returbarang/data_retur', $data);
    }
    public function ReturBarang()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $dateid = date('ymdhis');
            $datapembelian = $this->modelpembelian->getPembelian($this->request->getVar('idbeli'));
            $this->modelretur->save([
                // 'created_at' => date("y-m-d"),
                'id_date_retur' => $dateid,
                'id_karyawan' => $session->get('id_user'),
                'no_retur' => $this->NoTransaksiGenerateRetur(),
                'no_transaksi' => $datapembelian['no_transaksi'],
                'total_berat' => 0,
                'total_berat_murni' => 0,
                'jumlah_barang' => 0,
                'tanggal_retur' => date('y-m-d H:i:s'),
                'total_harga_bahan' => '0',
                'status_dokumen' => 'Draft'
            ]);
            $msg = [
                'success' => 'berhasil',
                'dateid' => $dateid
            ];
            echo json_encode($msg);
        }
    }
    public function DraftReturBarang($id)
    {
        $check = $this->modelretur->GetDataJoinRetur($id);
        if ($check['no_transaksi'] != null) {
            $data = [
                'datamasterretur' =>  $check,
                'dataretur' => $this->modeldetailbuyback->getDataReturAll(),
                'dataakanretur' => $this->modeldetailretur->getDetailRetur($id),
            ];
            return view('returbarang/retur_barang', $data);
        } else {
            return redirect()->to('/dataretur');
        }
    }

    public function SelesaiRetur()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'tanggalretur' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Harus di isi',
                    ]
                ],
                'harga_murni' => [
                    'rules' => 'required|greater_than[0]',
                    'errors' => [
                        'required' => 'Harga Harus di isi',
                        'greater_than' => 'Harus Lebih Dari 0',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'tanggalretur' => $validation->getError('tanggalretur'),
                        'harga_murni' => $validation->getError('harga_murni'),
                    ]
                ];
                echo json_encode($msg);
            } else {
                $session = session();
                $datadetailretur =  $this->modeldetailretur->getDetailAllretur($this->request->getVar('iddate'));
                $dataretur = $this->modelretur->GetDataJoinRetur($this->request->getVar('iddate'));
                $datasupp = $this->modelsupplier->getSupplier($dataretur['id_supplier']);
                if ($datadetailretur) {
                    $jmlbyr = $this->request->getVar('harga_murni') * $dataretur['total_berat_murni'];
                    $this->modelretur->save([
                        'id_retur' => $dataretur['id_retur'],
                        'id_karyawan' => $session->get('id_user'),
                        'keterangan' => $this->request->getVar('keterangan'),
                        'status_dokumen' => 'Selesai'
                    ]);
                    $this->modelpembelian->save([
                        'id_pembelian' => $dataretur['id_pembelian'],
                        'id_karyawan' => $session->get('id_user'),
                        'harga_murni' => $this->request->getVar('harga_murni'),
                    ]);
                    $this->modelpembayaran->save([
                        'id_date_pembelian' => $dataretur['id_date_pembelian'],
                        'id_karyawan' => $session->get('id_user'),
                        'nama_bank' => null,
                        'cara_pembayaran' => 'ReturSales',
                        'jumlah_pembayaran' => $jmlbyr,
                        'qty' => $dataretur['jumlah_barang'],
                        'no_retur' => $dataretur['no_retur'],
                        'kode_24k' => null,
                        'harga_murni' => $this->request->getVar('harga_murni'),
                        'berat_murni' => $dataretur['total_berat_murni'],
                    ]);
                    foreach ($datadetailretur as $row) {
                        $datadetailkartu = $this->modelkartustock->getKartuStockkode($row['kode']);
                        $this->modeldetailkartustock->save([
                            'barcode' => $row['kode'],
                            'status' => 'Keluar',
                            'id_karyawan' => $session->get('id_user'),
                            'no_faktur' => $dataretur['no_retur'],
                            'tgl_faktur' => $dataretur['tanggal_retur'],
                            'nama_customer' => $datasupp['nama_supp'],
                            'saldo' => $datadetailkartu['saldo_akhir'] - $row['qty'],
                            'masuk' => 0,
                            'keluar' => $row['qty'],
                            'jenis' => $row['jenis'],
                            'model' => $row['model'],
                            'keterangan' => 'Retur Sales',
                            'merek' => $row['merek'],
                            'kadar' => $row['kadar'],
                            'berat' => $row['berat'],
                            'nilai_tukar' =>  $row['nilai_tukar'],
                            'harga_beli' => $row['harga_beli'],
                            'total_harga' => $row['total_harga'],
                            'gambar' =>  $row['nama_img'],
                        ]);
                        // $this->KartuStockMaster($row['kode'], $session);
                        $masuk = $this->modeldetailkartustock->SumMasukKartu($row['kode'])['masuk'];
                        $keluar = $this->modeldetailkartustock->SumKeluarKartu($row['kode'])['keluar'];
                        $this->modelkartustock->save([
                            'id_kartustock' => $datadetailkartu['id_kartustock'],
                            'id_karyawan' => $session->get('id_user'),
                            'total_masuk' => $masuk,
                            'total_keluar' => $keluar,
                            'saldo_akhir' => 0,
                        ]);
                    }
                    $msg = 'sukses';
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
    public function UbahStatusLanjut()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $datadetailretur = $this->modeldetailretur->getDataDetailretur($this->request->getVar('id'));
            $dataretur = $this->modelretur->getDatareturAll($datadetailretur['id_date_retur']);
            if ($dataretur['no_transaksi']) {
                $datapembelian = $this->modelpembelian->getPembelianRetur($dataretur['no_transaksi']);
                $harusbayar = $datapembelian['byr_berat_murni'] + $datadetailretur['berat_murni'];
                $updatestat = true;
            }

            $this->modeldetailbuyback->save([
                'id_detail_buyback' => $datadetailretur['id_detail_buyback'],
                'id_karyawan' => $session->get('id_user'),
                'status_proses' => $this->request->getVar('status')
            ]);
            $datadetailkartu = $this->modeldetailkartustock->GetDataDelete($datadetailretur['kode'], $dataretur['no_retur']);
            $this->modeldetailkartustock->delete($datadetailkartu['id_detail_kartustock']);
            $this->KartuStockMaster($datadetailretur['kode'], $session);
            $this->modeldetailretur->delete($this->request->getVar('id'));
            $totalberatmurni = round($this->modeldetailretur->SumBeratMurniDetailRetur($datadetailretur['id_date_retur'])['berat_murni'], 2);
            $this->modelretur->save([
                'id_retur' => $dataretur['id_retur'],
                'id_karyawan' => $session->get('id_user'),
                'total_berat' => round($this->modeldetailretur->SumBeratDetailRetur($datadetailretur['id_date_retur'])['berat'], 2),
                'total_berat_murni' => $totalberatmurni,
                'jumlah_barang' => $this->modeldetailretur->CountBeratDetailRetur($datadetailretur['id_date_retur'])['berat'],
            ]);
            $msg = 'berhasil';

            if (isset($updatestat)) {
                $databayar = $this->modelpembayaran->getCheckNoRetur($dataretur['no_retur']);
                $this->modelpembelian->save([
                    'id_pembelian' => $datapembelian['id_pembelian'],
                    'id_karyawan' => $session->get('id_user'),
                    'byr_berat_murni' => $harusbayar,
                    'cara_pembayaran' => 'Belum Selesai',
                ]);
                $msg = $harusbayar;

                $jumlahbayar = $totalberatmurni * $databayar['harga_murni'];
                $this->modelpembayaran->save([
                    'id_pembayaran' => $databayar['id_pembayaran'],
                    'id_karyawan' => $session->get('id_user'),
                    'berat_murni' => $totalberatmurni,
                    'qty' => $this->modeldetailretur->CountBeratDetailRetur($datadetailretur['id_date_retur'])['berat'],
                    'jumlah_pembayaran' => $jumlahbayar,
                ]);
            }
            $msg = 'berhasil';

            echo json_encode($msg);
        }
    }
    public function PrintNotaRetur($id)
    {
        $dataretur = $this->modelretur->GetDataJoinRetur($id);
        $data1 = [
            'datadetailretur' => $this->modeldetailretur->getDetailAllretur($id),
            'dataretur' => $dataretur,
            'datasup' => $this->modelsupplier->getSupplier($dataretur['id_supplier'])
            // 'img' => $this->barangmodel->getImg($id)
        ];

        return view('returbarang/print_nota_retur', $data1);
    }
    public function TambahRetur()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $kode = $this->request->getVar('kode');
            $iddate =  $this->request->getVar('iddate');
            $databuyback = $this->modeldetailbuyback->getDataDetailKode($kode);
            $dataretur = $this->modelretur->GetDataJoinRetur($iddate);
            $datadetailretur = $this->modeldetailretur->CheckDataretur($databuyback['id_detail_buyback']);
            $sumberat = round($this->modeldetailretur->SumBeratMurniDetailRetur($iddate)['berat_murni'], 2);
            // $hasilskhr = $sumberat + $databuyback['berat_murni'];
            if (!$datadetailretur) {
                if ($databuyback['berat_murni'] <= $dataretur['byr_berat_murni']) {
                    $this->modeldetailretur->save([
                        'id_date_retur' => $iddate,
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
                        'status_proses' => 'Retur'
                    ]);
                    $this->modelpembelian->save([
                        'id_pembelian' => $dataretur['id_pembelian'],
                        'id_karyawan' => $session->get('id_user'),
                        'byr_berat_murni' => $dataretur['byr_berat_murni'] - $databuyback['berat_murni']
                    ]);
                    $this->modelretur->save([
                        'id_retur' => $dataretur['id_retur'],
                        'id_karyawan' => $session->get('id_user'),
                        'total_berat' => round($this->modeldetailretur->SumBeratDetailRetur($iddate)['berat'], 2),
                        'total_berat_murni' => round($this->modeldetailretur->SumBeratMurniDetailRetur($iddate)['berat_murni'], 2),
                        'jumlah_barang' => $this->modeldetailretur->CountBeratDetailRetur($iddate)['berat'],
                    ]);
                    $this->modeldetailbuyback->save([
                        'id_detail_buyback' => $databuyback['id_detail_buyback'],
                        'id_karyawan' => $session->get('id_user'),
                        'status_proses' => 'SudahRetur' . $dataretur['no_retur']
                    ]);
                    $msg = 'sukses';
                } else {
                    $msg = ['error' => 'Lebih Bayar'];
                }
            } else {
                $msg = ['error' => 'Data Sudah Masuk'];;
            }
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
    public function BatalRetur($id)
    {
        $session = session();
        $dataretur = $this->modelretur->GetDataJoinRetur($id);
        $datadetailretur =  $this->modeldetailretur->getDetailAllretur($id);
        $this->modelpembelian->save([
            'id_pembelian' => $dataretur['id_pembelian'],
            'id_karyawan' => $session->get('id_user'),
            'byr_berat_murni' => $dataretur['byr_berat_murni'] + $dataretur['total_berat_murni']
        ]);
        foreach ($datadetailretur as $row) {
            $databuyback = $this->modeldetailbuyback->getDataDetailRetur($row['kode']);
            $this->modeldetailbuyback->save([
                'id_detail_buyback' => $databuyback['id_detail_buyback'],
                'id_karyawan' => $session->get('id_user'),
                'status_proses' => 'Retur'
            ]);
        }
        $this->modeldetailretur->query('DELETE FROM tbl_detail_retur WHERE id_date_retur =' . $id . ';');
        $this->modelretur->query('DELETE FROM tbl_retur WHERE id_date_retur =' . $id . ';');
        return redirect()->to('/dataretur');
    }
    public function DeleteRetur()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $kode =  $this->modeldetailretur->getDataDetailRetur($this->request->getVar('id'));
            $databuyback = $this->modeldetailbuyback->getDataDetailRetur($kode['kode']);
            $dataretur = $this->modelretur->GetDataJoinRetur($kode['id_date_retur']);
            $this->modeldetailbuyback->save([
                'id_detail_buyback' => $databuyback['id_detail_buyback'],
                'id_karyawan' => $session->get('id_user'),
                'status_proses' => 'Retur'
            ]);
            $this->modelpembelian->save([
                'id_pembelian' => $dataretur['id_pembelian'],
                'id_karyawan' => $session->get('id_user'),
                'byr_berat_murni' => $dataretur['byr_berat_murni'] + $kode['berat_murni']
            ]);
            $this->modeldetailretur->delete($this->request->getVar('id'));
            $this->modelretur->save([
                'id_retur' => $dataretur['id_retur'],
                'id_karyawan' => $session->get('id_user'),
                'total_berat' => round($this->modeldetailretur->SumBeratDetailRetur($kode['id_date_retur'])['berat'], 2),
                'total_berat_murni' => round($this->modeldetailretur->SumBeratMurniDetailRetur($kode['id_date_retur'])['berat_murni'], 2),
                'jumlah_barang' => $this->modeldetailretur->CountBeratDetailRetur($kode['id_date_retur'])['berat'],
            ]);
            $msg = 'sukses';
            echo json_encode($msg);
        }
    }

    public function ModalRetur()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            if ($id == 1) {
                $data = [
                    'dataretur' => $this->modeldetailbuyback->getDataReturAll(),
                    'pesan' => 'Data Retur Sebelum Pilih'
                ];
            } else {
                $data = [
                    'dataretur' => $this->modeldetailretur->getDetailRetur($this->request->getVar('dateid')),
                    'pesan' => 'Data Retur Sesudah Pilih'
                ];
            }
            $msg = [
                'tampilmodal' => view('returbarang/modalretur', $data)
            ];
            // $msg = 'sukses';
            echo json_encode($msg);
        }
    }
    public function TampilLeburBarang($id)
    {
        $data = [
            'datamasterlebur' => $this->modellebur->getDataLeburAll($id),
            'datalebur' => $this->modeldetailbuyback->getDataLeburAll(),
            'dataakanlebur' => $this->modeldetaillebur->getDetailLebur($id)
        ];
        return view('leburbarang/lebur_barang', $data);
    }
    public function NoTransaksiGenerateRetur()
    {
        $data = $this->modelretur->getNoTransRetur();
        if ($this->modelretur->getNoTransRetur()) {
            if (substr($data['no_retur'], 0, 2) == date('y')) {
                $valnotransaksi = substr($data['no_retur'], 4, 10) + 1;
                $notransaksi = 'R-' . date('ym') . str_pad($valnotransaksi, 4, '0', STR_PAD_LEFT);

                return $notransaksi;
            } else {
                $notransaksi = 'R-' . date('ym') . str_pad(1, 4, '0', STR_PAD_LEFT);

                return $notransaksi;
            }
        } else {
            $notransaksi = 'R-' . date('ym') . str_pad(1, 4, '0', STR_PAD_LEFT);

            return $notransaksi;
        }
    }
}
