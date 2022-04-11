<?php

namespace App\Controllers;

use App\Models\ModelDetailTransaksi;
use App\Models\ModelTransaksi;
use App\Models\ModelAkunBiaya;
use App\Models\ModelBank;

// use CodeIgniter\Validation\Rules;
// use app\Config\Cache;
// use Config\Cache as ConfigCache;

class Transaksi extends BaseController
{
    protected $barangmodel;
    protected $barcodeG;

    public function __construct()
    {
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
    public function TampilTransaksi()
    {
        if ($this->request->isAJAX()) {
            if ($this->request->getVar('dari') < $this->request->getVar('sampai')) {
                $msg = ['error' => 'Dari Tanggal Harus Lebih Besar'];
            } else {
                $data = [
                    'detailtransaksi' => $this->modeldetailtransaksi->getDetailTransaksiFilter($this->request->getVar('dari'), $this->request->getVar('sampai')),
                    'datatransaksi' => $this->modeltransaksi->getTransaksi(),
                ];
                $msg = ['tampiltrans' => view('transaksi/tabletransaksi', $data)];
            }

            echo json_encode($msg);
        }
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
                    if ($datatransaksi['total_akhir_tunai'] >= $this->request->getVar('amount') && $this->request->getVar('pembayaran') == 'Tunai') {
                        $keluar = $this->request->getVar('amount');
                        $masuk = 0;
                        $sukses = true;
                    }
                    if ($datatransaksi['total_akhir_transfer'] >= $this->request->getVar('amount') && $this->request->getVar('pembayaran') == 'Transfer') {
                        $keluar = $this->request->getVar('amount');
                        $masuk = 0;
                        $sukses = true;
                    }
                    if ($datatransaksi['total_akhir_debitcc'] >= $this->request->getVar('amount') && $this->request->getVar('pembayaran') == 'Debitcc') {
                        $keluar = $this->request->getVar('amount');
                        $masuk = 0;
                        $sukses = true;
                    }
                    if (!isset($sukses)) {
                        $msg = [
                            'error' => [
                                'saldo' => 'Saldo Kurang',
                            ]
                        ];
                    }
                } else {
                    $keluar = 0;
                    $masuk = $this->request->getVar('amount');
                    $sukses = true;
                }
                if (isset($sukses)) {
                    $this->modeldetailtransaksi->save([
                        'tanggal_transaksi' => $this->request->getVar('tangalinput') . ' ' . date("H:i:s"),
                        'id_karyawan' => $session->get('id_user'),
                        'pembayaran' => $this->request->getVar('pembayaran'),
                        'keterangan' => $this->request->getVar('keterangan'),
                        'id_akun_biaya' => $this->request->getVar('nama_akun'),
                        'keluar' => $keluar,
                        'masuk' => $masuk,
                        'nama_bank' => ($this->request->getVar('namabank')) ? $this->request->getVar('namabank') : null,
                    ]);

                    $this->BiayaHarianMaster($datatransaksi['id_transaksi'], $session);
                    $msg = 'berhasil';
                }
                echo json_encode($msg);
            }
        }
    }
}
