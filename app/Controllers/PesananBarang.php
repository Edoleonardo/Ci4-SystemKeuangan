<?php

namespace App\Controllers;

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use App\Models\ModelHome;
use App\Models\ModelDetailBuyback;
use App\Models\ModelLebur;
use App\Models\ModelDetailLebur;
use CodeIgniter\Validation\Rules;

class PesananBarang extends BaseController
{
    protected $barangmodel;
    protected $barcodeG;

    public function __construct()
    {
        $this->barcodeG =  new BarcodeGenerator();
        $this->modelstock = new ModelHome();
        $this->modelbuyback = new ModelDetailBuyback();
        $this->modellebur = new ModelLebur();
        $this->modeldetaillebur = new ModelDetailLebur();
    }
    public function HomePesanan()
    {
        // dd($this->modelstock->CheckData(92200003));
        $data = [
            'datapesanan' => $this->modelbuyback->getDataReturAll(),
        ];
        return view('pesananbarang/data_pesanan', $data);
    }
}
