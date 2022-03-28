<?php

namespace App\Controllers;

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use App\Models\ModelHome;
use App\Models\ModelKartuStock;
use App\Models\ModelDetailKartuStock;
use App\Models\ModelLogin;
use App\Models\ModelDetailTransaksi;
use App\Models\ModelTransaksi;
use App\Models\ModelAkunBiaya;
use App\Models\ModelBank;

use CodeIgniter\Validation\Rules;
use app\Config\Cache;
use Config\Cache as ConfigCache;

class Transaksi extends BaseController
{
    protected $barangmodel;
    protected $barcodeG;

    public function __construct()
    {

        // $this->barcodeG =  new BarcodeGenerator();
        // $this->barangmodel = new ModelHome();
        // $this->modelkartustock = new ModelKartuStock();
        // $this->modeldetailkartustock = new ModelDetailKartuStock();
        // $this->modellogin = new ModelLogin();
        // $this->chace = new ConfigCache();
        $this->modeldetailtransaksi = new ModelDetailTransaksi();
        $this->modeltransaksi = new ModelTransaksi();
        $this->modelakun = new ModelAkunBiaya();
        $this->modelbank = new ModelBank();
    }
    public function DataTransaksi()
    {
        $data = [
            'detailtransaksi' => $this->modeldetailtransaksi->getDetailTransaksi(),
            'datatransaksi' => $this->modeltransaksi->getTransaksi(),
            'dataakun' => $this->modelakun->getAkunBiaya(),
            'bank' => $this->modelbank->getBank()

        ];
        // dd($this->modeltransaksi->getTransaksi());
        return view('transaksi/data_transaksi', $data);
    }
    public function TambahInput()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'kategori' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'kategori Harus di isi',
                    ]
                ],
                'keterangan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Keterangan Harus di isi',

                    ]
                ],
                'tangalinput' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'tangal input Harus di isi',

                    ]
                ],
                'amount' => [
                    'rules' => 'required|greater_than[0]',
                    'errors' => [
                        'required' => 'amount Harus di isi',
                        'greater_than' => 'harus lebih besar dari 0'

                    ]
                ],
                'nama_akun' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Akun Harus di isi',

                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'kategori' => $validation->getError('kategori'),
                        'keterangan' => $validation->getError('keterangan'),
                        'tangalinput' => $validation->getError('tangalinput'),
                        'amount' => $validation->getError('amount'),
                        'nama_akun' => $validation->getError('nama_akun'),
                    ]
                ];
                echo json_encode($msg);
            } else {
                $session = session();
                $datatransaksi = $this->modeltransaksi->getTransaksi($this->request->getVar('id_transaksi'));
                if ($this->request->getVar('kategori') == 'keluar') { //--------------------------------Kategori Masuk
                    if ($datatransaksi['saldo_akhir'] >= $this->request->getVar('amount')) {
                        $this->modeldetailtransaksi->save([
                            'tanggal_transaksi' => $this->request->getVar('tangalinput'),
                            'id_karyawan' => $session->get('id_user'),
                            'pembayaran' => $this->request->getVar('pembayaran'),
                            'keterangan' => $this->request->getVar('keterangan'),
                            'id_akun_biaya' => $this->request->getVar('nama_akun'),
                            'keluar' => $this->request->getVar('amount'),
                            'nama_bank' => ($this->request->getVar('namabank')) ? $this->request->getVar('namabank') : null,
                            'masuk' => 0
                        ]);

                        $this->BiayaHarianMaster($datatransaksi['id_transaksi'], $session);
                        $msg = 'berhasil';
                    } else {
                        $msg = [
                            'error' => [
                                'saldo' => 'Saldo Kurang',
                            ]
                        ];
                    }
                } else { //--------------------------------Kategori Masuk
                    $this->modeldetailtransaksi->save([
                        'tanggal_transaksi' => $this->request->getVar('tangalinput'),
                        'id_karyawan' => $session->get('id_user'),
                        'pembayaran' => $this->request->getVar('pembayaran'),
                        'keterangan' => $this->request->getVar('keterangan'),
                        'id_akun_biaya' => $this->request->getVar('nama_akun'),
                        'masuk' => $this->request->getVar('amount'),
                        'nama_bank' => ($this->request->getVar('namabank')) ? $this->request->getVar('namabank') : null,
                        'keluar' => 0
                    ]);
                    $this->BiayaHarianMaster($datatransaksi['id_transaksi'], $session);
                    $msg = 'berhasil';
                }
                echo json_encode($msg);
            }
        }
    }
}
