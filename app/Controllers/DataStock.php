<?php

namespace App\Controllers;

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use App\Models\ModelStock1;
use App\Models\ModelStock2;
use App\Models\ModelStock3;
use App\Models\ModelStock4;
use App\Models\ModelStock5;
use App\Models\ModelStock6;
use App\Models\ModelKartuStock;
use App\Models\ModelDetailKartuStock;

use CodeIgniter\Validation\Rules;
use app\Config\Cache;
use Config\Cache as ConfigCache;

class DataStock extends BaseController
{
    protected $barangmodel;
    protected $barcodeG;

    public function __construct()
    {

        $this->barcodeG =  new BarcodeGenerator();
        $this->barangmodel = new ModelStock1();
        $this->barangmodel2 = new ModelStock2();
        $this->barangmodel3 = new ModelStock3();
        $this->barangmodel4 = new ModelStock4();
        $this->barangmodel5 = new ModelStock5();
        $this->barangmodel6 = new ModelStock6();
        $this->modelkartustock = new ModelKartuStock();
        $this->modeldetailkartustock = new ModelDetailKartuStock();
        $this->chace = new ConfigCache();
    }
    public function DetailBarangKode($id)
    {
        $getid = $this->barangmodel->getBarangkode($id);
        return redirect()->to('/detail/' . $getid['id_stock_1']);
    }
    public function databarang($kell)
    {
        if ($kell == 1) {
            $view = view('datastock/data_barang_1');
        }
        if ($kell == 2) {
            $view = view('datastock/data_barang_2');
        }
        if ($kell == 3) {
            $view = view('datastock/data_barang_3');
        }
        if ($kell == 4) {
            $view = view('datastock/data_barang_4');
        }
        if ($kell == 5) {
            $view = view('datastock/data_barang_5');
        }
        if ($kell == 6) {
            $view = view('datastock/data_barang_6');
        }
        return $view;
    }

    public function TampilDataBarang()
    {
        if ($this->request->isAJAX()) {
            if ($this->request->getVar('kel') == '1') {
                $dabar = $this->barangmodel->getBarangFilter($this->request->getVar('tmpildata'), $this->request->getVar('stock'), $this->request->getVar('searchkode'));
                $data = [
                    'barang' =>  $dabar,
                ];
                $result = [
                    'databarang' => view('datastock/tabledatabarang', $data),
                ];
            }
            if ($this->request->getVar('kel') == '2') {
                $dabar = $this->barangmodel2->getBarangFilter($this->request->getVar('tmpildata'), $this->request->getVar('stock'), $this->request->getVar('searchkode'));
                $data = [
                    'barang' =>  $dabar,
                ];
                $result = [
                    'databarang' => view('datastock/tabledatabarang2', $data),
                ];
            }
            if ($this->request->getVar('kel') == '3') {
                $dabar = $this->barangmodel3->getBarangFilter($this->request->getVar('tmpildata'), $this->request->getVar('stock'), $this->request->getVar('searchkode'));
                $data = [
                    'barang' =>  $dabar,
                ];
                $result = [
                    'databarang' => view('datastock/tabledatabarang3', $data),
                ];
            }
            if ($this->request->getVar('kel') == '4') {
                $dabar = $this->barangmodel4->getBarangFilter($this->request->getVar('tmpildata'), $this->request->getVar('stock'), $this->request->getVar('searchkode'));
                $data = [
                    'barang' =>  $dabar,
                ];
                $result = [
                    'databarang' => view('datastock/tabledatabarang4', $data),
                ];
            }
            if ($this->request->getVar('kel') == '5') {
                $dabar = $this->barangmodel5->getBarangFilter($this->request->getVar('tmpildata'), $this->request->getVar('stock'), $this->request->getVar('searchkode'));
                $data = [
                    'barang' =>  $dabar,
                ];
                $result = [
                    'databarang' => view('datastock/tabledatabarang5', $data),
                ];
            }
            if ($this->request->getVar('kel') == '6') {
                $dabar = $this->barangmodel6->getBarangFilter($this->request->getVar('tmpildata'), $this->request->getVar('stock'), $this->request->getVar('searchkode'));
                $data = [
                    'barang' =>  $dabar,
                ];
                $result = [
                    'databarang' => view('datastock/tabledatabarang6', $data),
                ];
            }
            $this->cachePage(1);
            echo json_encode($result);
        }
    }


    public function detail($id, $kode)
    {
        if ($kode == 1) {
            $data = $this->barangmodel->getBarang($id);
        }
        if ($kode == 2) {
            $data = $this->barangmodel2->getBarang($id);
        }
        if ($kode == 3) {
            $data = $this->barangmodel3->getBarang($id);
        }
        if ($kode == 4) {
            $data = $this->barangmodel4->getBarang($id);
        }
        if ($kode == 5) {
            $data = $this->barangmodel5->getBarang($id);
        }
        if ($kode == 6) {
            $data = $this->barangmodel6->getBarang($id);
        }

        $barcode = $this->barcodeG;
        $barcode->setText($data['barcode']);
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
        $this->cachePage(1);
        return view('datastock/detail_barang', $data1);
    }

    public function print($id)
    {
        $barcode = $this->barcodeG;
        $barcode->setText($id);
        $barcode->setType(BarcodeGenerator::Code128);
        $barcode->setScale(1);
        $barcode->setThickness(25);
        $barcode->setFontSize(10);
        $code = $barcode->generate();
        //echo '<img src="data:image/png;base64,' . $code . '" />';
        $data1 = [
            'barcode' => '<img src="data:image/png;base64,' . $code . '" /> <br>',
        ];

        return view('datastock/print_barcode.php', $data1);
    }
}
