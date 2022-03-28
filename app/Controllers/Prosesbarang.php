<?php

namespace App\Controllers;

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use App\Models\ModelHome;
use App\Models\ModelDetailBuyback;
use App\Models\ModelLebur;
use App\Models\ModelDetailLebur;

use CodeIgniter\Validation\Rules;

class Prosesbarang extends BaseController
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
    public function HomeRetur()
    {
        // dd($this->modelstock->CheckData(92200003));
        $data = [
            'dataretur' => $this->modelbuyback->getDataReturAll(),
        ];
        return view('prosesbarang/data_proses_retur', $data);
    }
    public function HomeLebur()
    {
        $data = [
            'datalebur' => $this->modellebur->getDataLeburAll(),
        ];
        return view('prosesbarang/data_proses_lebur', $data);
    }
    public function HomeCuci()
    {
        $data = [
            'datacuci' => $this->modelbuyback->getDataCuciAll(),
        ];
        return view('prosesbarang/data_proses_cuci', $data);
    }

    public function TampilCuci()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $data = $this->modelbuyback->getDetailoneBuyback($id);
            $msg = [
                'data' => $data
            ];
            echo json_encode($msg);
        }
    }

    public function UpdateCuci()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nilai_tukar' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nilai Tukar Harus di isi',
                    ]
                ],

                'berat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Berat Harus di isi',
                    ]
                ],
            ]);
        }
        if (!$valid) {
            $msg = [
                'error' => [
                    'nilai_tukar' => $validation->getError('nilai_tukar'),
                    'berat' => $validation->getError('berat'),
                ]
            ];
            echo json_encode($msg);
        } else {
            $id = $this->request->getVar('id');
            $databuyback = $this->modelbuyback->getDetailoneBuyback($id);
            $datastock = $this->modelstock->CheckData($databuyback['kode']);
            $beratmurni = $this->request->getVar('berat') * ($this->request->getVar('nilai_tukar') / 100);
            $this->modelstock->save([
                'id_stock' => $datastock['id_stock'],
                'qty' => $databuyback['qty'],
                'berat' => $this->request->getVar('berat'),
                'berat_murni' => $beratmurni,
                'harga_beli' => $databuyback['harga_beli'],
                'total_harga' => $beratmurni * $databuyback['harga_beli'],
                'status' => 'C'
            ]);
            $this->modelbuyback->save([
                'id_detail_buyback' => $databuyback['id_detail_buyback'],
                'status_proses' => 'SelesaiCuci ' . date('d-m-y')
            ]);

            $msg = 'sukses';
            echo json_encode($msg);
        }
    }


    public function LeburBarang()
    {
        $session = session();
        $session->remove('date_id_lebur');
        $dateidlebur = date('ymdhis');
        $session->set('date_id_lebur', $dateidlebur);
        $this->modellebur->save([
            // 'created_at' => date("y-m-d"),
            'id_date_lebur' => $session->get('date_id_lebur'),
            'id_karyawan' => '1',
            'kode' => $this->KodeDatailGenerate(4),
            'tanggal_lebur' => date('y-m-d'),
            'status_dokumen' => 'Draft'
        ]);
        return redirect()->to('/leburbarang/' . $session->get('date_id_lebur'));
    }

    public function TambahLebur()
    {
        if ($this->request->isAJAX()) {
            $kode = $this->request->getVar('kode');
            $iddate =  $this->request->getVar('iddate');
            $databuyback = $this->modelbuyback->getDataDetailKode($kode);
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

                $this->modelbuyback->save([
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
    public function SelesaiLebur()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $filesampul = $this->request->getFile('gambar');
            if ($filesampul->getError() != 4 || $this->request->getPost('gambar')) {
                $valid = $this->validate([
                    'qty' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Qty Harus di isi',
                        ]
                    ],
                    'modellebur' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Model Harus di isi',
                        ]
                    ],
                    'berat_murni' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Berat Murni Harus di isi',
                        ]
                    ],

                ]);
            } else {
                $valid = $this->validate([
                    'qty' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Qty Harus di isi',
                        ]
                    ],
                    'modellebur' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Model Harus di isi',
                        ]
                    ],
                    'berat_murni' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Berat Murni Harus di isi',
                        ]
                    ], 'gambar' => [
                        'rules' => 'uploaded[gambar]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                        'errors' => [
                            'uploaded' => 'gambar harus diisi',
                            'mime_in' => 'extention tidak cocok',
                            'is_image' => 'Bukan Gambar',

                        ]
                    ]

                ]);
            }
            if (!$valid) {
                $msg = [
                    'error' => [
                        'qty' => $validation->getError('qty'),
                        'berat_murni' => $validation->getError('berat_murni'),
                        'modellebur' => $validation->getError('modellebur'),
                        'gambar' => $validation->getError('gambar'),

                    ]
                ];
                echo json_encode($msg);
            } else {
                if ($this->request->getPost('gambar')) {
                    $image = $this->request->getPost('gambar');
                    $image = str_replace('data:image/jpeg;base64,', '', $image);
                    $image = base64_decode($image, true);
                    $micro_date = microtime();
                    $date_array = explode(" ", $micro_date);
                    $date = date("ymdis", $date_array[1]);
                    $namafile = $date . $date_array[0] . '.jpg';
                    file_put_contents(FCPATH . '/img/' . $namafile, $image);
                } else {
                    $filesampul = $this->request->getFile('gambar');
                    if ($filesampul->getError() == 4) {
                        $namafile = 'default.jpg';
                    } else {
                        $namafile = $filesampul->getRandomName(); // pake nama random
                        // $namafile = $filesampul->getName(); // ini pake nama asli di foto
                        $filesampul->move('img', $namafile);
                    }
                }
                $datadetaillebur =  $this->modeldetaillebur->getDetailLebur($this->request->getVar('dateidlebur'));
                $datalebur = $this->modellebur->getDataLeburAll($this->request->getVar('dateidlebur'));
                if ($datadetaillebur) {
                    $this->modellebur->save([
                        'id_lebur' => $datalebur['id_lebur'],
                        'model' => $this->request->getVar('modellebur'),
                        'qty' => $this->request->getVar('qty'),
                        'berat_murni' => $this->request->getVar('berat_murni'),
                        'tanggal_lebur' => $this->request->getVar('tanggallebur'),
                        'nama_img' =>  $namafile,
                        'status_dokumen' => 'Selesai'
                    ]);

                    $this->modelstock->save([
                        'barcode' => $datalebur['kode'],
                        'status' => 'B',
                        'no_faktur' => $datalebur['kode'],
                        'tgl_faktur' => $this->request->getVar('tanggallebur'),
                        'nama_supplier' => '-',
                        'qty' => $this->request->getVar('qty'),
                        'jenis' => '',
                        'model' => $this->request->getVar('modellebur'),
                        'keterangan' => '',
                        'merek' => '',
                        'kadar' => '24K',
                        'berat_murni' => $this->request->getVar('berat_murni'),
                        'berat' => $this->request->getVar('berat_murni'),
                        'nilai_tukar' =>  100,
                        'ongkos' => 0,
                        'harga_beli' => 0,
                        'total_harga' => 0,
                        'kode_beli' =>  'JN',
                        'gambar' =>  $namafile,
                    ]);

                    $msg = 'sukses';
                    echo json_encode($msg);
                } else {
                    $msg = [
                        'error' => [
                            'data' => 'Tidak ada Data',
                        ]
                    ];
                    echo json_encode($msg);
                }
            }
        }
    }
    public function BatalLebur($id)
    {

        $datadetaillebur =  $this->modeldetaillebur->getDetailAllLebur($id);
        foreach ($datadetaillebur as $row) {
            $databuyback = $this->modelbuyback->getDataDetailRetur($row['kode']);
            $this->modelbuyback->save([
                'id_detail_buyback' => $databuyback['id_detail_buyback'],
                'status_proses' => 'Lebur'
            ]);
        }
        $this->modeldetaillebur->query('DELETE FROM tbl_detail_lebur WHERE id_date_lebur =' . $id . ';');
        $this->modellebur->query('DELETE FROM tbl_lebur WHERE id_date_lebur =' . $id . ';');
        return redirect()->to('/datalebur');
    }

    public function TampilLeburBarang($id)
    {
        // dd($this->modelbuyback->getDataDetailKode(220307024148));
        $data = [
            'datamasterlebur' => $this->modellebur->getDataLeburAll($id),
            'datalebur' => $this->modelbuyback->getDataLeburAll(),
            'dataakanlebur' => $this->modeldetaillebur->getDetailLebur($id)
        ];
        return view('prosesbarang/lebur_barang', $data);
    }

    public function DeleteLebur()
    {
        if ($this->request->isAJAX()) {
            $kode =  $this->modeldetaillebur->getDataDetailLebur($this->request->getVar('id'));
            $databuyback = $this->modelbuyback->getDataDetailRetur($kode['kode']);

            $this->modelbuyback->save([
                'id_detail_buyback' => $databuyback['id_detail_buyback'],
                'status_proses' => 'Lebur'
            ]);
            $this->modeldetaillebur->delete($this->request->getVar('id'));

            $msg = 'sukses';
            echo json_encode($msg);
        }
    }

    public function KodeDatailGenerate($id)
    {
        $kodestock = $this->modelstock->getKodeStock($id);
        $kodelebur = $this->modellebur->getKode($id);

        if ($this->modelstock->getKodeStock($id) || $this->detailbeli->getKode($id)) {
            if ($kodestock['kode'] >= $kodelebur['kode']) {
                if (substr($kodestock['kode'], 0, 2) == date('y')) {
                    $valkode = substr($kodestock['kode'], 2, 5) + 1;
                    $notransaksi = $id . date('y') . str_pad($valkode, 5, '0', STR_PAD_LEFT);

                    return $notransaksi;
                } else {
                    $kode = $id . date('y') . str_pad(1, 5, '0', STR_PAD_LEFT);

                    return $kode;
                }
            } else {
                if (substr($kodelebur['kode'], 0, 2) == date('y')) {
                    $valkode = substr($kodelebur['kode'], 2, 5) + 1;
                    $notransaksi = $id . date('y') . str_pad($valkode, 5, '0', STR_PAD_LEFT);

                    return $notransaksi;
                } else {
                    $kode = $id . date('y') . str_pad(1, 5, '0', STR_PAD_LEFT);

                    return $kode;
                }
            }
        } else {
            $kode = $id . date('y') . str_pad(1, 5, '0', STR_PAD_LEFT);

            return $kode;
        }
    }
}
