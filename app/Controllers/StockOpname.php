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
}
