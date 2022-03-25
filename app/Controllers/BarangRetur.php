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
// use App\Models\ModelBuyback;
use App\Models\ModelKartuStock;
use App\Models\ModelDetailKartuStock;
use App\Models\ModelRetur;
use App\Models\ModelDetailRetur;


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
        $this->datasupplier = new ModelSupplier();
        $this->datakadar = new ModelKadar();
        $this->datamerek = new ModelMerek();
        $this->datastock = new ModelHome();
        // $this->modelbuyback = new ModelBuyback();
        $this->modelkartustock = new ModelKartuStock();
        $this->modeldetailkartustock = new ModelDetailKartuStock();
        $this->modelretur = new ModelRetur();
        $this->modeldetailretur = new ModelDetailRetur();
    }

    public function HomeRetur()
    {
        // $asd = $this->modeldetailbuyback->JumlahDataBuyback(220311121607);
        // dd($asd['total']);
        $data = [
            'dataretur' => $this->modelretur->getDataReturAll(),
        ];
        return view('returbarang/data_retur', $data);
    }
    public function ReturBarang()
    {
        $session = session();
        $dateid = date('ymdhis');
        $this->modelretur->save([
            // 'created_at' => date("y-m-d"),
            'id_date_retur' => $dateid,
            'id_karyawan' => $session->get('id_user'),
            'no_retur' => $this->NoTransaksiGenerateRetur(),
            'total_berat' => 0,
            'jumlah_barang' => 0,
            'tanggal_retur' => date('y-m-d H:i:s'),
            'total_harga_bahan' => '0',
            'status_dokumen' => 'Draft'
        ]);
        //---------------------------------------------------
        return redirect()->to('/draftretur/' . $dateid);
    }
    public function DraftReturBarang($id)
    {
        $data = [
            'datasupplier' => $this->datasupplier->getSupplier(),
            'datamasterretur' => $this->modelretur->getDataReturAll($id),
            'dataretur' => $this->modeldetailbuyback->getDataReturAll(),
            'dataakanretur' => $this->modeldetailretur->getDetailRetur($id)
        ];
        return view('returbarang/retur_barang', $data);
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
                'supplier' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Harus di isi',
                    ]
                ],

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'tanggalretur' => $validation->getError('tanggalretur'),
                        'supplier' => $validation->getError('supplier'),
                    ]
                ];
                echo json_encode($msg);
            } else {
                $session = session();
                $datadetailretur =  $this->modeldetailretur->getDetailAllretur($this->request->getVar('iddate'));
                $dateretur = $this->modelretur->getDataReturAll($this->request->getVar('iddate'));
                if ($datadetailretur) {
                    $this->modelretur->save([
                        'id_retur' => $dateretur['id_retur'],
                        'id_karyawan' => $session->get('id_user'),
                        'keterangan' => $this->request->getVar('keterangan'),
                        'nama_supplier' => $this->request->getVar('supplier'),
                        'status_dokumen' => 'Selesai'
                    ]);
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
    public function PrintNotaRetur($id)
    {
        $data1 = [
            'datadetailretur' => $this->modeldetailretur->getDetailAllretur($id),
            'dataretur' => $this->modelretur->getDataReturAll($id),
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
            $dataretur = $this->modelretur->getDataReturAll($iddate);
            $datadetailretur = $this->modeldetailretur->CheckDataretur($databuyback['id_detail_buyback']);
            if (!$datadetailretur) {
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
                $this->modelretur->save([
                    'id_retur' => $dataretur['id_retur'],
                    'id_karyawan' => $session->get('id_user'),
                    'total_berat' => $this->modeldetailretur->SumBeratDetailRetur($iddate)['berat'],
                    'jumlah_barang' => $this->modeldetailretur->CountBeratDetailRetur($iddate)['berat'],
                ]);
                $this->modeldetailbuyback->save([
                    'id_detail_buyback' => $databuyback['id_detail_buyback'],
                    'id_karyawan' => $session->get('id_user'),
                    'status_proses' => 'SudahRetur' . $dataretur['no_retur']
                ]);
                $msg = 'sukses';
            } else {
                $msg = 'gagal';
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
        $datadetailretur =  $this->modeldetailretur->getDetailAllretur($id);
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
            $dataretur = $this->modelretur->getDataReturAll($kode['id_date_retur']);
            $this->modeldetailbuyback->save([
                'id_detail_buyback' => $databuyback['id_detail_buyback'],
                'id_karyawan' => $session->get('id_user'),
                'status_proses' => 'Retur'
            ]);
            $this->modeldetailretur->delete($this->request->getVar('id'));
            $this->modelretur->save([
                'id_retur' => $dataretur['id_retur'],
                'id_karyawan' => $session->get('id_user'),
                'total_berat' => $this->modeldetailretur->SumBeratDetailRetur($kode['id_date_retur'])['berat'],
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
        // dd($this->modelbuyback->getDataDetailKode(220307024148));
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
