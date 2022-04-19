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
use App\Models\ModelJenis;
use App\Models\ModelUsers;
use App\Models\ModelTukang;
use App\Models\ModelAkunBiaya;

use CodeIgniter\Validation\Rules;
use app\Config\Cache;
use Config\Cache as ConfigCache;

class MasterInput extends BaseController
{
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
        $this->datajenis = new ModelJenis();
        $this->modelusers = new ModelUsers();
        $this->modeltukang = new ModelTukang();
        $this->chace = new ConfigCache();
        $this->modelakun = new ModelAkunBiaya();
    }
    public function HomeInput()
    {
        $data = [
            'datacust' => $this->modelcust->getDataCustomer(),
            'datasup' => $this->modelsup->getSupplier(),
            'datakadar' => $this->datakadar->getKadar(),
            'datamerek' => $this->datamerek->getMerek(),
            'datajenis' => $this->datajenis->getjenis(),
            'databank' => $this->modelbank->getBank(),
            'datausers' => $this->modelusers->getUsers(),
            'datatukang' => $this->modeltukang->getTukang(),
            'dataakun' => $this->modelakun->getAkunBiaya(),
        ];

        return view('masterinput/masterinput_home', $data);
    }
    public function InsertSupp()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            if ($this->request->getVar('id_supp')) {
                $datasupp = $this->modelsup->getSupplier($this->request->getVar('id_supp'));
                if ($datasupp && $this->request->getVar('inisial') == $datasupp['inisial']) {
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
                } else {
                    $valid = $this->validate([
                        'nama_supp' => [
                            'rules' => 'required',
                            'errors' => [
                                'required' => 'Nama Supplier Harus di isi',
                            ]
                        ],
                        'inisial' => [
                            'rules' => 'required|is_unique[tbl_supplier.inisial]',
                            'errors' => [
                                'required' => 'Inisial Harus di isi',
                                'is_unique' => 'Inisial Sudah Ada',
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
                }
            } else {
                $valid = $this->validate([
                    'nama_supp' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Nama Supplier Harus di isi',
                        ]
                    ],
                    'inisial' => [
                        'rules' => 'required|is_unique[tbl_supplier.inisial]',
                        'errors' => [
                            'required' => 'Inisial Harus di isi',
                            'is_unique' => 'Inisial Sudah Ada',
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
            }
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_supp' => $validation->getError('nama_supp'),
                        'alamat' => $validation->getError('alamat1'),
                        'inisial' => $validation->getError('inisial'),
                        'kota' => $validation->getError('kota1'),
                        'nama_sales' => $validation->getError('nama_sales'),
                        'no_hp' => $validation->getError('no_hp'),
                        'no_ktr' => $validation->getError('no_ktr'),
                    ]
                ];
                echo json_encode($msg);
            } else {
                $session = session();
                if ($this->request->getVar('id_supp')) {
                    $this->modelsup->save([
                        'id_supplier' => $this->request->getVar('id_supp'),
                        'id_karyawan' => $session->get('id_user'),
                        'nama_supp' => $this->request->getVar('nama_supp'),
                        'inisial' => $this->request->getVar('inisial'),
                        'alamat_supp' => $this->request->getVar('alamat1'),
                        'kota_supp' => $this->request->getVar('kota1'),
                        'sales_supp' => $this->request->getVar('nama_sales'),
                        'no_hp' => $this->request->getVar('no_hp'),
                        'no_ktr' => $this->request->getVar('no_ktr'),
                    ]);
                } else {
                    $this->modelsup->save([
                        'nama_supp' => $this->request->getVar('nama_supp'),
                        'id_karyawan' => $session->get('id_user'),
                        'alamat_supp' => $this->request->getVar('alamat1'),
                        'inisial' => $this->request->getVar('inisial'),
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
                $session = session();
                if ($this->request->getVar('id_kadar')) {
                    $this->datakadar->save([
                        'id_kadar' => $this->request->getVar('id_kadar'),
                        'id_karyawan' => $session->get('id_user'),
                        'nilai_kadar' => $this->request->getVar('nilai_kadar'),
                        'nama_kadar' => $this->request->getVar('nama_kadar'),
                    ]);
                } else {
                    $this->datakadar->save([
                        'nilai_kadar' => $this->request->getVar('nilai_kadar'),
                        'id_karyawan' => $session->get('id_user'),
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
                $session = session();
                if ($this->request->getVar('id_merek')) {
                    $this->datamerek->save([
                        'id_merek' => $this->request->getVar('id_merek'),
                        'id_karyawan' => $session->get('id_user'),
                        'nama_merek' => $this->request->getVar('nama_merek'),
                    ]);
                } else {
                    $this->datamerek->save([
                        'nama_merek' => $this->request->getVar('nama_merek'),
                        'id_karyawan' => $session->get('id_user'),
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
                $session = session();
                if ($this->request->getVar('id_bank')) {
                    $this->modelbank->save([
                        'id_bank' => $this->request->getVar('id_bank'),
                        'id_karyawan' => $session->get('id_user'),
                        'nama_bank' => $this->request->getVar('nama_bank'),
                    ]);
                } else {
                    $this->modelbank->save([
                        'nama_bank' => $this->request->getVar('nama_bank'),
                        'id_karyawan' => $session->get('id_user'),
                    ]);
                }
                $msg = 'sukses';
                echo json_encode($msg);
            }
        }
    }
    public function InsertAkun()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_akun' => [
                    'rules' => 'required|is_unique[tbl_akun_biaya.nama_akun]',
                    'errors' => [
                        'required' => 'Nama Akun Harus di isi',
                        'is_unique' => 'Nama Sudah Ada',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_akun' => $validation->getError('nama_akun'),
                    ]
                ];
                echo json_encode($msg);
            } else {
                $session = session();
                if ($this->request->getVar('id_akun')) {
                    $this->modelakun->save([
                        'id_akun_biaya' => $this->request->getVar('id_akun'),
                        'id_karyawan' => $session->get('id_user'),
                        'nama_akun' => $this->request->getVar('nama_akun'),
                    ]);
                } else {
                    $this->modelakun->save([
                        'nama_akun' => $this->request->getVar('nama_akun'),
                        'id_karyawan' => $session->get('id_user'),
                    ]);
                }
                $msg = 'sukses';
                echo json_encode($msg);
            }
        }
    }
    public function InsertJenis()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_jenis' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Jenis Harus di isi',
                    ]
                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_jenis' => $validation->getError('nama_jenis'),
                    ]
                ];
                echo json_encode($msg);
            } else {
                $session = session();
                if ($this->request->getVar('id_jenis')) {
                    $this->datajenis->save([
                        'id_jenis' => $this->request->getVar('id_jenis'),
                        'id_karyawan' => $session->get('id_user'),
                        'nama' => $this->request->getVar('nama_jenis'),
                    ]);
                } else {
                    $this->datajenis->save([
                        'nama' => $this->request->getVar('nama_jenis'),
                        'id_karyawan' => $session->get('id_user'),
                    ]);
                }
                $msg = 'sukses';
                echo json_encode($msg);
            }
        }
    }
    public function InsertTukang()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_tukang' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Tukang Harus di isi',
                    ]
                ],
                'nohp_tukang' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'No Hp Harus di isi',
                    ]
                ],
                'alamattukng' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Alamat Harus di isi',
                    ]
                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_tukang' => $validation->getError('nama_tukang'),
                        'nohp_tukang' => $validation->getError('nohp_tukang'),
                        'alamattukng' => $validation->getError('alamattukng'),
                    ]
                ];
                echo json_encode($msg);
            } else {
                $session = session();
                if ($this->request->getVar('id_tukang')) {
                    $this->modeltukang->save([
                        'id_tukang' => $this->request->getVar('id_tukang'),
                        'nama_tukang' => $this->request->getVar('nama_tukang'),
                        'id_karyawan' => $session->get('id_user'),
                        'nohp' => $this->request->getVar('nohp_tukang'),
                        'alamat' => $this->request->getVar('alamattukng'),
                    ]);
                } else {
                    $this->modeltukang->save([
                        'id_karyawan' => $session->get('id_user'),
                        'nama_tukang' => $this->request->getVar('nama_tukang'),
                        'nohp' => $this->request->getVar('nohp_tukang'),
                        'alamat' => $this->request->getVar('alamattukng'),
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
                $session = session();
                $this->modelcust->save([
                    'id_customer' => $this->request->getVar('id_cust'),
                    'id_karyawan' => $session->get('id_user'),
                    'nama' => $this->request->getVar('nama_custu'),
                    'alamat_cust' => $this->request->getVar('alamatu'),
                    'kota_cust' => $this->request->getVar('kotau'),
                    'bank' => $this->request->getVar('banku1'),
                    'no_rekening' => $this->request->getVar('no_rek1'),
                ]);
                $msg = [
                    'pesan' => 'Berahasil'
                ];
            }
            echo json_encode($msg);
        }
    }
    public function InsertUser()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_user' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama User Harus di isi',
                    ]
                ],
                'nohp_user' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nomor Hp Harus di isi',
                    ]
                ],
                'alamatusr' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Alamat Harus di isi',
                    ]
                ],
                'username' => [
                    'rules' => 'required|is_unique[tbl_pegawai.username]',
                    'errors' => [
                        'required' => 'Username Harus di isi',
                        'is_unique' => 'Username Sudah Ada'
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password Harus di isi',
                    ]
                ],
                'role' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Role Harus di isi',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_user' => $validation->getError('nama_user'),
                        'nohp_user' => $validation->getError('nohp_user'),
                        'alamatusr' => $validation->getError('alamatusr'),
                        'username' => $validation->getError('username'),
                        'password' => $validation->getError('password'),
                        'role' => $validation->getError('role'),
                    ]
                ];
                echo json_encode($msg);
            } else {
                $session = session();
                if ($this->request->getVar('id_pegawai')) {
                    $this->modelusers->save([
                        'id_pegawai' => $this->request->getVar('id_pegawai'),
                        'id_karyawan' => $session->get('id_user'),
                        'nama_pegawai' => $this->request->getVar('nama_user'),
                        'nohp' => $this->request->getVar('nohp_user'),
                        'alamat' => $this->request->getVar('alamatusr'),
                        'username' => $this->request->getVar('username'),
                        'password' => $this->request->getVar('password'),
                        'role' => $this->request->getVar('role'),
                    ]);
                } else {
                    $this->modelusers->save([
                        'nama_pegawai' => $this->request->getVar('nama_user'),
                        'id_karyawan' => $session->get('id_user'),
                        'nohp' => $this->request->getVar('nohp_user'),
                        'alamat' => $this->request->getVar('alamatusr'),
                        'username' => $this->request->getVar('username'),
                        'password' => $this->request->getVar('password'),
                        'role' => $this->request->getVar('role'),
                    ]);
                }
                $msg = 'sukses';
                echo json_encode($msg);
            }
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
            if ($jenis == 'jenis') {
                $data = $this->datajenis->getJenis($id);
            }
            if ($jenis == 'user') {
                $data = $this->modelusers->getUsers($id);
            }
            if ($jenis == 'tukang') {
                $data = $this->modeltukang->getTukang($id);
            }
            if ($jenis == 'namaakun') {
                $data = $this->modelakun->getAkunBiaya($id);
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
