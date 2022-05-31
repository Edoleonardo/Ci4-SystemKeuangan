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

use CodeIgniter\Validation\Rules;
use app\Config\Cache;
use Config\Cache as ConfigCache;

class Home extends BaseController
{
    protected $barangmodel;
    protected $barcodeG;

    public function __construct()
    {

        $this->barcodeG =  new BarcodeGenerator();
        $this->barangmodel = new ModelStock1();
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

        return view('home/index');
    }
    public function DetailBarangKode($id)
    {
        $getid = $this->barangmodel->getBarangkode($id);
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
        $data = $this->barangmodel->getBarang($id);
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
