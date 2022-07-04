<?php

namespace App\Controllers;

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use App\Models\ModelStock1;
use App\Models\ModelKartuStock;
use App\Models\ModelDetailKartuStock;
use App\Models\ModelKartuStock5;
use App\Models\ModelDetailKartuStock5;
use App\Models\ModelKartuStock6;
use App\Models\ModelDetailKartuStock6;
use App\Models\ModelPenjualan;
use App\Models\ModelStock2;
use App\Models\ModelStock3;
use App\Models\ModelStock4;
use App\Models\ModelStock5;
use App\Models\ModelStock6;
use App\Models\ModelJenis;
use App\Models\ModelKadar;

use CodeIgniter\Validation\Rules;
use app\Config\Cache;
use Config\Cache as ConfigCache;

class Home extends BaseController
{
    public function __construct()
    {

        $this->datastock1 = new ModelStock1();
        $this->datastock2 = new ModelStock2();
        $this->datastock3 = new ModelStock3();
        $this->datastock4 = new ModelStock4();
        $this->datastock5 = new ModelStock5();
        $this->datastock6 = new ModelStock6();
        $this->modeljenis = new ModelJenis();
        $this->modelkadar = new ModelKadar();
        $this->penjualan =  new ModelPenjualan();
        $this->barcodeG =  new BarcodeGenerator();
        $this->modelkartustock = new ModelKartuStock();
        $this->modeldetailkartustock = new ModelDetailKartuStock();
        $this->modelkartustock5 = new ModelKartuStock5();
        $this->modeldetailkartustock5 = new ModelDetailKartuStock5();
        $this->modelkartustock6 = new ModelKartuStock6();
        $this->modeldetailkartustock6 = new ModelDetailKartuStock6();

        $this->chace = new ConfigCache();
    }
    public function index()
    {
        $data = [
            'totalbarang' => $this->datastock1->CountDataStock()['barcode'] +  $this->datastock2->CountDataStock()['barcode'] +  $this->datastock3->CountDataStock()['barcode'] + $this->datastock4->CountDataStock()['barcode'] + $this->datastock5->CountDataStock()['barcode'] + $this->datastock5->CountDataStock()['barcode'] + $this->datastock6->CountDataStock()['barcode'],
            'totalpenjualan' => $this->penjualan->CountDataStock(),

        ];
        return view('home/index', $data);
    }

    public function PrintStatistik()
    {
        $data = [
            'jenis' => $this->modeljenis->getJenis(),
            'kadar' => $this->modelkadar->getKadar()
        ];
        return view('home/printstatistik', $data);
    }
    public function DetailBarangKode($id)
    {
        $getid = $this->datastock1->getBarangkode($id);
        return redirect()->to('/detail/' . $getid['id_stock_1']);
    }

    public function KatruStock($kel)
    {
        if ($kel == 1) {
            $data = [
                'kartustock' => $this->modelkartustock->getKartuStock(),
                'detailkartustock' => $this->modeldetailkartustock->getDetailKartuStock(),
            ];
            $view = view('home/data_kartustock', $data);
        }
        if ($kel == 5) {
            $data = [
                'kartustock' => $this->modelkartustock5->getKartuStock(),
                'detailkartustock' => $this->modeldetailkartustock5->getDetailKartuStock(),
            ];
            $view = view('home/data_kartustock5', $data);
        }
        if ($kel == 6) {
            $data = [
                'kartustock' => $this->modelkartustock6->getKartuStock(),
                'detailkartustock' => $this->modeldetailkartustock6->getDetailKartuStock(),
            ];
            $view = view('home/data_kartustock6', $data);
        }
        $this->cachePage(1);
        return $view;
    }
    public function TampilDataKartu()
    {
        if ($this->request->isAJAX()) {
            if ($this->request->getVar('kel') == 1) {
                $dakar = $this->modelkartustock->getKartuFilter($this->request->getVar('kode'), $this->request->getVar('stock'), $this->request->getVar('barcode'));
                $data = [
                    'kartustock' =>  $dakar,
                ];
                $result = [
                    'datakartu' => view('home/tablekartustock', $data),
                ];
            }
            if ($this->request->getVar('kel') == 5) {
                $dakar = $this->modelkartustock5->getKartuFilter($this->request->getVar('kode'), $this->request->getVar('stock'), $this->request->getVar('barcode'));
                $data = [
                    'kartustock' =>  $dakar,
                ];
                $result = [
                    'datakartu' => view('home/tablekartustock5', $data),
                ];
            }
            if ($this->request->getVar('kel') == 6) {
                $dakar = $this->modelkartustock6->getKartuFilter($this->request->getVar('kode'), $this->request->getVar('stock'), $this->request->getVar('barcode'));
                $data = [
                    'kartustock' =>  $dakar,
                ];
                $result = [
                    'datakartu' => view('home/tablekartustock6', $data),
                ];
            }
            $this->cachePage(1);
            echo json_encode($result);
        }
    }
    public function DetailKartuStock()
    {
        if ($this->request->isAJAX()) {
            if ($this->request->getVar('kel') == 1) {
                $datadetail = [
                    'detailkartustock' => $this->modeldetailkartustock->getAllDetailKartuStock($this->request->getVar('kode')),
                ];
                $data = [
                    'modal' => view('home/modalkartustock', $datadetail)
                ];
            }
            if ($this->request->getVar('kel') == 5) {
                $datadetail = [
                    'detailkartustock' => $this->modeldetailkartustock5->getAllDetailKartuStock($this->request->getVar('kode')),
                ];
                $data = [
                    'modal' => view('home/modalkartustock5', $datadetail)
                ];
            }
            if ($this->request->getVar('kel') == 6) {
                $datadetail = [
                    'detailkartustock' => $this->modeldetailkartustock6->getAllDetailKartuStock($this->request->getVar('kode')),
                ];
                $data = [
                    'modal' => view('home/modalkartustock6', $datadetail)
                ];
            }

            echo json_encode($data);
        }
    }

    public function print($id)
    {
        $data = $this->datastock1->getBarang($id);
        $barcode = $this->barcodeG;
        $barcode->setText($data['barcode']);
        $barcode->setType(BarcodeGenerator::Code128);
        $barcode->setScale(1);
        $barcode->setThickness(25);
        $barcode->setFontSize(10);
        $code = $barcode->generate();
        //echo '<img src="data:image/png;base64,' . $code . '" />';
        $data1 = [
            'barcode' => '<img src="data:image/png;base64,' . $code . '" /> <br>',
        ];

        return view('home/print_barcode.php', $data1);
    }
}
