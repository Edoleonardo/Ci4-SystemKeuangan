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
            'nama_img' => 'default.jpg',
            'kode' => '-',
            'jenis' => '-',
            'model' => '-',
            'keterangan' => '-',
            'kadar' => '24K',
            'berat' => '0',
            'qty' => '0',
            'tanggal_retur' => date('y-m-d'),
            'total_harga_bahan' => '0',
            'status_dokumen' => 'Draft'
        ]);
        //---------------------------------------------------
        return redirect()->to('/draftretur/' . $dateid);
    }
    public function DraftReturBarang($id)
    {
        $data = [
            'datamasterretur' => $this->modelretur->getDataReturAll($id),
            'dataretur' => $this->modeldetailbuyback->getDataReturAll(),
            'dataakanretur' => $this->modeldetailretur->getDetailRetur($id)
        ];
        return view('returbarang/retur_barang', $data);
    }

    public function TambahRetur()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $kode = $this->request->getVar('kode');
            $iddate =  $this->request->getVar('iddate');
            $databuyback = $this->modeldetailbuyback->getDataDetailKode($kode);
            $datadetailretur = $this->modeldetailretur->CheckDataretur($databuyback['kode']);
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

                $this->modeldetailbuyback->save([
                    'id_detail_buyback' => $databuyback['id_detail_buyback'],
                    'id_karyawan' => $session->get('id_user'),
                    'status_proses' => 'SudahRetur' . date('y-m-d')
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

            $this->modeldetailbuyback->save([
                'id_detail_buyback' => $databuyback['id_detail_buyback'],
                'id_karyawan' => $session->get('id_user'),
                'status_proses' => 'Retur'
            ]);
            $this->modeldetailretur->delete($this->request->getVar('id'));

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
