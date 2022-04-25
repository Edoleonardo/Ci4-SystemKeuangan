<?php

namespace App\Controllers;

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use App\Models\ModelStock1;
use App\Models\ModelKartuStock;
use App\Models\ModelDetailKartuStock;

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

    public function KatruStock()
    {
        $data = [
            'kartustock' => $this->modelkartustock->getKartuStock(),
            'detailkartustock' => $this->modeldetailkartustock->getDetailKartuStock(),
        ];
        $this->cachePage(1);
        return view('home/data_kartustock', $data);
    }
    public function TampilDataKartu()
    {
        if ($this->request->isAJAX()) {
            if ($this->request->getVar('kode') != 0) {
                $dakar = $this->modelkartustock->getKartuFilter($this->request->getVar('kode'), $this->request->getVar('stock'));
            } else {
                $dakar = $this->modelkartustock->getKartuStock();
            }
            $data = [
                'kartustock' =>  $dakar,
            ];
            $result = [
                'datakartu' => view('home/tablekartustock', $data),
            ];
            $this->cachePage(1);
            echo json_encode($result);
        }
    }
    public function DetailKartuStock()
    {
        if ($this->request->isAJAX()) {
            $datadetail = [
                'detailkartustock' => $this->modeldetailkartustock->getAllDetailKartuStock($this->request->getVar('kode')),
            ];
            $data = [
                'modal' => view('home/modalkartustock', $datadetail)
            ];
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
