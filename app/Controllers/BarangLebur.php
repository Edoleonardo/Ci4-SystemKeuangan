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
use App\Models\ModelLebur;
use App\Models\ModelDetailLebur;


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
        $this->datastock = new ModelHome();
        // $this->modelbuyback = new ModelBuyback();
        $this->modelkartustock = new ModelKartuStock();
        $this->modeldetailkartustock = new ModelDetailKartuStock();
        $this->modellebur = new ModelLebur();
        $this->modeldetaillebur = new ModelDetailLebur();
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
    public function LeburBarang()
    {

        $dateid = date('ymdhis');
        $this->modellebur->save([
            // 'created_at' => date("y-m-d"),
            'id_date_lebur' => $dateid,
            'no_lebur' => $this->NoTransaksiGenerateLebur(),
            'id_karyawan' => '1',
            'nama_img' => 'default.jpg',
            'kode' => '-',
            'jenis' => '-',
            'model' => '-',
            'keterangan' => '-',
            'kadar' => '24K',
            'berat' => '0',
            'qty' => '0',
            'tanggal_lebur' => date('y-m-d'),
            'total_harga_bahan' => '0',
            'status_dokumen' => 'Draft'
        ]);
        //---------------------------------------------------
        return redirect()->to('/draftlebur/' . $dateid);
    }
    public function DraftLeburBarang($id)
    {
        $data = [
            'datamasterlebur' => $this->modellebur->getDataLeburAll($id),
            'datalebur' => $this->modeldetailbuyback->getDataLeburAll(),
            'dataakanlebur' => $this->modeldetaillebur->getDetailLebur($id)
        ];
        return view('leburbarang/lebur_barang', $data);
    }

    public function TambahLebur()
    {
        if ($this->request->isAJAX()) {
            $kode = $this->request->getVar('kode');
            $iddate =  $this->request->getVar('iddate');
            $databuyback = $this->modeldetailbuyback->getDataDetailKode($kode);
            $datadetaillebur = $this->modeldetaillebur->CheckDataLebur($databuyback['kode']);
            if (!$datadetaillebur) {
                $this->modeldetaillebur->save([
                    'id_date_lebur' => $iddate,
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
                ]);

                $this->modeldetailbuyback->save([
                    'id_detail_buyback' => $databuyback['id_detail_buyback'],
                    'status_proses' => 'SudahLebur' . date('y-m-d')
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
    public function BatalLebur($id)
    {

        $datadetaillebur =  $this->modeldetaillebur->getDetailAllLebur($id);
        foreach ($datadetaillebur as $row) {
            $databuyback = $this->modeldetailbuyback->getDataDetailRetur($row['kode']);
            $this->modeldetailbuyback->save([
                'id_detail_buyback' => $databuyback['id_detail_buyback'],
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
            $kode =  $this->modeldetaillebur->getDataDetailLebur($this->request->getVar('id'));
            $databuyback = $this->modeldetailbuyback->getDataDetailRetur($kode['kode']);

            $this->modeldetailbuyback->save([
                'id_detail_buyback' => $databuyback['id_detail_buyback'],
                'status_proses' => 'Lebur'
            ]);
            $this->modeldetaillebur->delete($this->request->getVar('id'));

            $msg = 'sukses';
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
}
