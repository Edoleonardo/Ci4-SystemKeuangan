<?php

namespace App\Controllers;

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use App\Models\ModelHome;
use App\Models\ModelKartuStock;
use App\Models\ModelDetailKartuStock;
use App\Models\ModelCustomer;
use App\Models\ModelSupplier;
use App\Models\ModelKadar;
use App\Models\ModelMerek;
use App\Models\ModelBank;


use CodeIgniter\Validation\Rules;
use app\Config\Cache;
use Config\Cache as ConfigCache;

class MasterInput extends BaseController
{
    protected $barangmodel;
    protected $barcodeG;

    public function __construct()
    {

        $this->datastock = new ModelHome();
        $this->modelkartustock = new ModelKartuStock();
        $this->modeldetailkartustock = new ModelDetailKartuStock();
        $this->modelcust = new ModelCustomer();
        $this->modelsup = new ModelSupplier();
        $this->datakadar = new ModelKadar();
        $this->datamerek = new ModelMerek();
        $this->modelbank = new ModelBank();
        $this->chace = new ConfigCache();
    }
    public function HomeInput()
    {
        $data = [
            'datacust' => $this->modelcust->getDataCustomer(),
            'datasup' => $this->modelsup->getSupplier(),
            'datakadar' => $this->datakadar->getKadar(),
            'datamerek' => $this->datamerek->getMerek(),
            'databank' => $this->modelbank->getBank(),
        ];

        return view('masterinput/masterinput_home', $data);
    }
    public function InsertSupp()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_supp' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Supplier Harus di isi',
                    ]
                ],
                'alamat1' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Alamat Harus di isi',
                    ]
                ],
                'kota1' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kota Harus di isi',
                    ]
                ],
                'nama_sales' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Sales Harus di isi',
                    ]
                ],
                'no_hp' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'No Hp Harus di isi',
                    ]
                ],
                'no_ktr' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'No kantor Harus di isi',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_supp' => $validation->getError('nama_supp'),
                        'alamat' => $validation->getError('alamat1'),
                        'kota' => $validation->getError('kota1'),
                        'nama_sales' => $validation->getError('nama_sales'),
                        'no_hp' => $validation->getError('no_hp'),
                        'no_ktr' => $validation->getError('no_ktr'),
                    ]
                ];
                echo json_encode($msg);
            } else {
                if ($this->request->getVar('id_supp')) {
                    $this->modelsup->save([
                        'id_supplier' => $this->request->getVar('id_supp'),
                        'nama_supp' => $this->request->getVar('nama_supp'),
                        'alamat_supp' => $this->request->getVar('alamat1'),
                        'kota_supp' => $this->request->getVar('kota1'),
                        'sales_supp' => $this->request->getVar('nama_sales'),
                        'no_hp' => $this->request->getVar('no_hp'),
                        'no_ktr' => $this->request->getVar('no_ktr'),
                    ]);
                } else {
                    $this->modelsup->save([
                        'nama_supp' => $this->request->getVar('nama_supp'),
                        'alamat_supp' => $this->request->getVar('alamat1'),
                        'kota_supp' => $this->request->getVar('kota1'),
                        'sales_supp' => $this->request->getVar('nama_sales'),
                        'no_hp' => $this->request->getVar('no_hp'),
                        'no_ktr' => $this->request->getVar('no_ktr'),
                    ]);
                }
                $msg = 'sukses';
                echo json_encode($msg);
            }
        }
    }
    public function InsertKadar()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nilai_kadar' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nilai Kadar Harus di isi',
                    ]
                ],
                'nama_kadar' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Kadar Harus di isi',
                    ]
                ],

            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nilai_kadar' => $validation->getError('nilai_kadar'),
                        'nama_kadar' => $validation->getError('nama_kadar'),
                    ]
                ];
                echo json_encode($msg);
            } else {
                if ($this->request->getVar('id_kadar')) {
                    $this->datakadar->save([
                        'id_kadar' => $this->request->getVar('id_kadar'),
                        'nilai_kadar' => $this->request->getVar('nilai_kadar'),
                        'nama_kadar' => $this->request->getVar('nama_kadar'),
                    ]);
                } else {
                    $this->datakadar->save([
                        'nilai_kadar' => $this->request->getVar('nilai_kadar'),
                        'nama_kadar' => $this->request->getVar('nama_kadar'),
                    ]);
                }

                $msg = 'sukses';
                echo json_encode($msg);
            }
        }
    }
    public function InsertMerek()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_merek' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Merek Harus di isi',
                    ]
                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_merek' => $validation->getError('nama_merek'),
                    ]
                ];
                echo json_encode($msg);
            } else {
                if ($this->request->getVar('id_merek')) {
                    $this->datamerek->save([
                        'id_merek' => $this->request->getVar('id_merek'),
                        'nama_merek' => $this->request->getVar('nama_merek'),
                    ]);
                } else {
                    $this->datamerek->save([
                        'nama_merek' => $this->request->getVar('nama_merek'),
                    ]);
                }
                $msg = 'sukses';
                echo json_encode($msg);
            }
        }
    }
    public function InsertBank()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_bank' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Bank Harus di isi',
                    ]
                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_bank' => $validation->getError('nama_bank'),
                    ]
                ];
                echo json_encode($msg);
            } else {
                if ($this->request->getVar('id_bank')) {
                    $this->modelbank->save([
                        'id_bank' => $this->request->getVar('id_bank'),
                        'nama_bank' => $this->request->getVar('nama_bank'),
                    ]);
                } else {
                    $this->modelbank->save([
                        'nama_bank' => $this->request->getVar('nama_bank'),
                    ]);
                }
                $msg = 'sukses';
                echo json_encode($msg);
            }
        }
    }
    public function UpdateCust()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            if (!$this->validate([
                // 'nohpu' => [
                //     'rules' => 'required|is_unique[tbl_customer.nohp_cust]',
                //     'errors' => [
                //         'required' => 'NpHp Harus di isi',
                //         'is_unique' => 'NoHp Sudah Ada'
                //     ]
                // ],
                'nama_custu' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Harus di isi',
                    ]
                ],
            ])) {
                $msg = [
                    'error' => [
                        // 'inputcustomer' => $validation->getError('inputcustomer'),
                        // 'nohp' => $validation->getError('nohpu'),
                        'nama_cust' => $validation->getError('nama_custu'),
                    ]
                ];
            } else {
                $this->modelcust->save([
                    'id_customer' => $this->request->getVar('id_cust'),
                    'nama' => $this->request->getVar('nama_custu'),
                    'alamat_cust' => $this->request->getVar('alamatu'),
                    'kota_cust' => $this->request->getVar('kotau'),
                ]);
                $msg = [
                    'pesan' => 'Berahasil'
                ];
            }
            echo json_encode($msg);
        }
    }
    public function DataMaster()
    {
        if ($this->request->isAJAX()) {
            $jenis = $this->request->getVar('jenis');
            $id = $this->request->getVar('id');
            if ($jenis == 'customer') {
                $data = $this->modelcust->getDataCustomer($id);
            }
            if ($jenis == 'supplier') {
                $data = $this->modelsup->getSupplier($id);
            }
            if ($jenis == 'kadar') {
                $data = $this->datakadar->getKadar($id);
            }
            if ($jenis == 'merek') {
                $data = $this->datamerek->getMerek($id);
            }
            if ($jenis == 'bank') {
                $data = $this->modelbank->getBank($id);
            }
            echo json_encode($data);
        }
    }




    // public function HapusData()
    // {
    //     if ($this->request->isAJAX()) {
    //         $jenis = $this->request->getVar('jenis');
    //         $id = $this->request->getVar('id');
    //         if ($jenis == 'customer') {
    //             $this->modelcust->delete($id);
    //         }
    //         if ($jenis == 'supplier') {
    //         }
    //         echo json_encode('sukses');
    //     }
    // }
}
