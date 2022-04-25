<?php

namespace App\Controllers;

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use App\Models\ModelStock1;
use App\Models\ModelBuyback;
use App\Models\ModelDetailBuyback;
use App\Models\ModelDetailPenjualan;
use App\Models\ModelPenjualan;
use App\Models\ModelCustomer;
use App\Models\ModelPembelian;
use App\Models\ModelDetailMasuk;
use App\Models\ModelSupplier;
use App\Models\ModelPembayaranBeli;
use App\Models\ModelCuci;
use App\Models\ModelDetailCuci;
use App\Models\ModelLebur;
use App\Models\ModelDetailLebur;
use App\Models\ModelRetur;
use App\Models\ModelDetailRetur;
use Config\Cache as ConfigCache;

class ModalDetail extends BaseController
{
    public function __construct()
    {

        $this->barcodeG =  new BarcodeGenerator();
        $this->barangmodel = new ModelStock1();
        $this->modelbuyback = new ModelBuyback();
        $this->modeldetailbuyback = new ModelDetailBuyback();
        $this->modelpenjualan = new ModelPenjualan();
        $this->modeldetailpenjualan = new ModelDetailPenjualan();
        $this->modelcustomer = new ModelCustomer();
        $this->modelpembelian = new ModelPembelian();
        $this->modeldetailpembelian = new ModelDetailMasuk();
        $this->modelsupplier = new ModelSupplier();
        $this->modelpembayaranbeli = new ModelPembayaranBeli();
        $this->modelcuci = new ModelCuci();
        $this->modeldetailcuci = new ModelDetailCuci();
        $this->modellebur = new ModelLebur();
        $this->modeldetaillebur = new ModelDetailLebur();
        $this->modelretur = new ModelRetur();
        $this->modeldetailretur = new ModelDetailRetur();

        $this->chace = new ConfigCache();
    }
    public function ModalDetail()
    {
        if ($this->request->isAJAX()) {
            $nomor = $this->request->getVar('no_id');
            $nomorjenis = substr($nomor, 0, 1);
            if ($nomorjenis == 'M') {
                $data = $this->modelpembelian->GetDataNotrans($nomor);
                if ($data) {
                    $databb = [
                        'datapembelian' => $data,
                        'tampildata' => $this->modeldetailpembelian->getDetailAll($data['id_date_pembelian']),
                        'databayar' => $this->modelpembayaranbeli->getPembayaran($data['id_date_pembelian'])
                    ];
                    $view =  view('modaldetail/modaldetailbeli',  $databb);
                    $ada = true;
                } else {
                    $msg = ['error' => 'No data'];
                }
            }
            if ($nomorjenis == 'B') {
                $data = $this->modelbuyback->getDataNoTrans($nomor);
                if ($data) {
                    $databb = [
                        'databuyback' => $data,
                        'tampildata' => $this->modeldetailbuyback->getDetailAllBuyback($data['id_date_buyback'])
                    ];
                    $view =  view('modaldetail/modaldetailbuyback',  $databb);
                    $ada = true;
                } else {
                    $msg = ['error' => 'No data'];
                }
            }
            if ($nomorjenis == 'S') {
                $data = $this->modelpenjualan->getDataNoTrans($nomor);
                if ($data) {
                    $databb = [
                        'datapenjualan' => $data,
                        'tampildata' => $this->modeldetailpenjualan->getDetailAllJual($data['id_date_penjualan']),
                        'datacust' => $this->modelcustomer->getDataCustomerone($data['nohp_cust'])
                    ];
                    $view =  view('modaldetail/modaldetailjual',  $databb);
                    $ada = true;
                } else {
                    $msg = ['error' => 'No data'];
                }
            }
            if ($nomorjenis == 'R') {
                $data = $this->modelretur->GetDataNoRetur($nomor);
                if ($data) {
                    $databb = [
                        'datamasterretur' => $data,
                        'dataakanretur' => $this->modeldetailretur->getDetailAllretur($data['id_date_retur']),
                    ];
                    $view =  view('modaldetail/modaldetailretur',  $databb);
                    $ada = true;
                } else {
                    $msg = ['error' => 'No data'];
                }
            }
            if ($nomorjenis == 'C') {
                $data = $this->modelcuci->getNoCuci($nomor);
                if ($data) {
                    $databb = [
                        'datamastercuci' => $data,
                        'dataakancuci' => $this->modeldetailcuci->getDetailAllCuci($data['id_date_cuci']),
                    ];
                    $view =  view('modaldetail/modaldetailcuci',  $databb);
                    $ada = true;
                } else {
                    $msg = ['error' => 'No data'];
                }
            }
            if ($nomorjenis == 'L') {
                $data = $this->modellebur->getNoLebur($nomor);
                if ($data) {
                    $databb = [
                        'datamasterlebur' => $data,
                        'dataakanlebur' => $this->modeldetaillebur->getDetailAllLebur($data['id_date_lebur']),
                    ];
                    $view =  view('modaldetail/modaldetaillebur',  $databb);
                    $ada = true;
                } else {
                    $msg = ['error' => 'No data'];
                }
            } else {
                $msg = ['error' => 'No data'];
            }
            if (isset($ada)) {
                $msg = [
                    'modaldetail' => $view
                ];
            }
            echo json_encode($msg);
        }
    }
}
