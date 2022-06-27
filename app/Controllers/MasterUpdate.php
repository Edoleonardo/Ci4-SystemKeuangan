<?php

namespace App\Controllers;

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use App\Models\ModelBarangMasuk;
use App\Models\ModelDetailMasuk;
use App\Models\ModelKadar;
use App\Models\ModelMerek;
use App\Models\ModelSupplier;
use App\Models\ModelPembelian;
use App\Models\ModelStock1;
use App\Models\ModelStock2;
use App\Models\ModelStock3;
use App\Models\ModelStock4;
use App\Models\ModelStock5;
use App\Models\ModelStock6;
use App\Models\ModelPembayaranBeli;
use App\Models\ModelKartuStock;
use App\Models\ModelKartuStock5;
use App\Models\ModelKartuStock6;
use App\Models\ModelDetailKartuStock;
use App\Models\ModelDetailKartuStock5;
use App\Models\ModelDetailKartuStock6;
use App\Models\ModelBank;
use App\Models\ModelJenis;
use App\Models\ModelRetur;
use App\Models\ModelTransaksi;
use App\Models\ModelDetailTransaksi;

use CodeIgniter\CLI\Console;
use CodeIgniter\Validation\Rules;
use PhpParser\Node\Expr\Isset_;

class MasterUpdate extends BaseController
{
    public function __construct()
    {

        $this->barcodeG =  new BarcodeGenerator();
        $this->detailbeli = new ModelDetailMasuk();
        $this->barangmasuk = new ModelBarangMasuk();
        $this->datasupplier = new ModelSupplier();
        $this->datakadar = new ModelKadar();
        $this->datamerek = new ModelMerek();
        $this->datajenis = new ModelJenis();
        $this->datapembelian = new ModelPembelian();
        $this->datastock1 = new ModelStock1();
        $this->datastock2 = new ModelStock2();
        $this->datastock3 = new ModelStock3();
        $this->datastock4 = new ModelStock4();
        $this->datastock5 = new ModelStock5();
        $this->datastock6 = new ModelStock6();
        $this->barcodeG =  new BarcodeGenerator();
        $this->modelpembayaran =  new ModelPembayaranBeli();
        $this->modelkartustock = new ModelKartuStock();
        $this->modelkartustock5 = new ModelKartuStock5();
        $this->modelkartustock6 = new ModelKartuStock6();
        $this->modeldetailkartustock = new ModelDetailKartuStock();
        $this->modeldetailkartustock5 = new ModelDetailKartuStock5();
        $this->modeldetailkartustock6 = new ModelDetailKartuStock6();
        $this->modelbank = new ModelBank();
        $this->modelretur = new ModelRetur();
        $this->modeltransaksi = new ModelTransaksi();
        $this->modeldetailtransaksi = new ModelDetailTransaksi();
    }

    public function UpdatePembelian()
    {
        return  view('masterupdate/pembelian');
    }

    //------------------------------------UpdatePembelian-----------------------------------------
    public function TampilPembelian()
    {
        if ($this->request->isAJAX()) {
            $data = $this->datapembelian->DataFilterPembelian($this->request->getVar('tmpildata'), $this->request->getVar('kelompok'), $this->request->getVar('status'),  $this->request->getVar('notrans'));
            $view = ['datapembelian' => $data];
            $msg = ['tampildata' => view('masterupdate/tampilpembelian_u', $view)];

            echo json_encode($msg);
        }
    }
    public function DetailPembelianSupp($id)
    {

        $data = [
            'datapembelian' => $this->datapembelian->getPembelianSupplierJoin($id),
            'tampildata' =>  $this->detailbeli->getDetailAll($id),
            'tampil24k' =>  $this->datastock4->getKodeBahan24k(),
            'tampilretur' =>  $this->modelretur->getDataReturBayar(),
            'databarang' => $this->detailbeli->getDetailAll($id),
            'totalberat' => $this->detailbeli->GetDataTotalBerat($id),
            'totalberatmurni' => $this->detailbeli->SumBeratMurniDetail($id),
            'merek' => $this->datamerek->getMerek(),
            'kadar' => $this->datakadar->getKadar(),
            'bank' => $this->modelbank->getBank(),
            'jenis' => $this->datajenis->getJenis(),
            'supplier' => $this->datasupplier->getSupplier(),
            'databayar' => $this->modelpembayaran->getPembayaran($id),


        ];
        return view('masterupdate/detail_pembelian_update', $data);
    }
    public function DataUpdateDetailPembelian()
    {
        if ($this->request->isAJAX()) {
            $kel = $this->request->getVar('kel');
            $iddetail = $this->request->getVar('id');
            $jenis_u = $this->request->getVar('jenis');
            if ($kel == 1 && $jenis_u == 'pembelian') {
                $data = [
                    'barang' =>  $this->detailbeli->getDetailone($iddetail),
                    'merek' => $this->datamerek->getMerek(),
                    'kadar' => $this->datakadar->getKadar(),
                    'jenis' => $this->datajenis->getJenis(),
                    'kel' => $kel,
                    'jenis_u' => $jenis_u
                ];
                $msg = [
                    'tampilupdate' => view('masterupdate/modalupdatedatapembelian', $data)
                ];
            }
            echo json_encode($msg);
        }
    }
    public function EditPembelian()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $kel = $this->request->getVar('kel1');
            $iddetail = $this->request->getVar('iddetail1');
            $jenis_u = $this->request->getVar('jenis_u');

            if ($kel == 1 && $jenis_u == 'pembelian') {
                $filesampul = $this->request->getFile('gambar1');
                if ($this->request->getPost('gambar1')) {
                    $image = $this->request->getPost('gambar1');
                    $image = str_replace('data:image/jpeg;base64,', '', $image);
                    $image = base64_decode($image, true);
                    $micro_date = microtime();
                    $date_array = explode(" ", $micro_date);
                    $date = date("ymdis", $date_array[1]);
                    $namafile = $date . $date_array[0] . '.jpg';
                    file_put_contents(FCPATH . '/img/' . $namafile, $image);
                    unlink('img/' . $this->request->getVar('nm_img'));
                } else if ($filesampul->getError() != 4) {
                    // $namafile = $filesampul->getRandomName(); // pake nama random
                    // $namafile = $filesampul->getName(); // ini pake nama asli di foto
                    $micro_date = microtime();
                    $date_array = explode(" ", $micro_date);
                    $date = date("ymdis", $date_array[1]);
                    $namafile = $date . $date_array[0] . '.jpg';
                    $filesampul->move('img', $namafile);
                    unlink('img/' . $this->request->getVar('nm_img'));
                } else {
                    $namafile = $this->request->getVar('nm_img');
                }

                $harga = $this->request->getVar('harga_beli1');
                $berat = $this->request->getVar('berat1');
                $beratmurni = round($berat * ($this->request->getVar('nilai_tukar1') / 100), 2);
                $totalharga =  $beratmurni *  $harga + $this->request->getVar('ongkos1');
                $this->detailbeli->save([
                    'id_detail_pembelian' => $iddetail,
                    'id_karyawan' => $session->get('id_user'),
                    'nama_img' => $namafile,
                    'qty' => $this->request->getVar('qty1'),
                    'jenis' => $this->request->getVar('jenis1'),
                    'model' => $this->request->getVar('model1'),
                    'keterangan' => $this->request->getVar('keterangan1'),
                    'berat' => $this->request->getVar('berat1'),
                    'ongkos' => $this->request->getVar('ongkos1'),
                    'berat_murni' => $beratmurni,
                    'harga_beli' => $this->request->getVar('harga_beli1'),
                    'kadar' =>  $this->request->getVar('kadar1'),
                    'nilai_tukar' =>  $this->request->getVar('nilai_tukar1'),
                    'merek' => $this->request->getVar('merek1'),
                    'total_harga' => $totalharga,
                ]);
                $msg = 'sukses';
            }
            echo json_encode($msg);
        }
    }
    public function UpdateData()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $value = $this->request->getVar('value');
            $jenis = $this->request->getVar('jenis');
            $dataupdate = $this->datapembelian->getPembelianSupplier($this->request->getVar('iddate'));
            $datadetailbeli = $this->detailbeli->getDetailAll($this->request->getVar('iddate'));

            if ($value || $value != 0) {
                if ($jenis == 'supplier') {
                    $this->datapembelian->save([
                        'id_pembelian' => $dataupdate['id_pembelian'],
                        'id_karyawan' => $session->get('id_user'),
                        'id_supplier' => $value
                    ]);
                    foreach ($datadetailbeli as $detail) {
                        $datamaster = $this->DataBarangBase($detail['kode']);
                        $namasup = $this->datasupplier->getSupplier($value);
                        $this->UpdateStock($dataupdate['kelompok'], $namasup['nama_supp'], $datamaster, 'nama_supplier');
                    }
                } else if ($jenis == 'tgl_input') {
                    $this->datapembelian->save([
                        'id_pembelian' => $dataupdate['id_pembelian'],
                        'id_karyawan' => $session->get('id_user'),
                        'created_at' => $value . ' ' . date("H:i:s")
                    ]);
                } else if ($jenis == 'tgl_nota') {
                    $this->datapembelian->save([
                        'id_pembelian' => $dataupdate['id_pembelian'],
                        'id_karyawan' => $session->get('id_user'),
                        'tgl_faktur' => $value . ' ' . date("H:i:s")
                    ]);
                    foreach ($datadetailbeli as $detail) {
                        $datamaster = $this->DataBarangBase($detail['kode']);
                        $this->UpdateStock($dataupdate['kelompok'], $value . ' ' . date("H:i:s"), $datamaster, 'tgl_faktur');
                    }
                } else if ($jenis == 'no_nota') {
                    $this->datapembelian->save([
                        'id_pembelian' => $dataupdate['id_pembelian'],
                        'id_karyawan' => $session->get('id_user'),
                        'no_faktur_supp' => $value
                    ]);
                    foreach ($datadetailbeli as $detail) {
                        $datamaster = $this->DataBarangBase($detail['kode']);
                        $this->UpdateStock($dataupdate['kelompok'], $value, $datamaster, 'no_faktur');
                    }
                } else if ($jenis == 'tgl_tempo') {
                    $this->datapembelian->save([
                        'id_pembelian' => $dataupdate['id_pembelian'],
                        'id_karyawan' => $session->get('id_user'),
                        'tgl_jatuh_tempo' => $value . ' ' . date("H:i:s")
                    ]);
                } else if ($jenis == 'total_murni') {
                    $this->datapembelian->save([
                        'id_pembelian' => $dataupdate['id_pembelian'],
                        'id_karyawan' => $session->get('id_user'),
                        'total_berat_murni' => $value
                    ]);
                }
                $msg = 'sukses';
            } else {
                $msg = ['errors' => 'Tidak Boleh Kosong'];
            }
            echo json_encode($msg);
        }
    }
    public function UpdateStock($kel, $val, $data, $jnis)
    {
        $session = session();
        if ($kel == '1') {
            $this->datastock1->save([
                'id_stock_1' => $data['id_stock_1'],
                'id_karyawan' => $session->get('id_user'),
                $jnis => $val
            ]);
        } elseif ($kel == '2') {
            $this->datastock2->save([
                'id_stock_2' => $data['id_stock_2'],
                'id_karyawan' => $session->get('id_user'),
                $jnis => $val
            ]);
        } elseif ($kel == '3') {
            $this->datastock3->save([
                'id_stock_3' => $data['id_stock_3'],
                'id_karyawan' => $session->get('id_user'),
                $jnis => $val
            ]);
        } elseif ($kel == '4') {
            $this->datastock4->save([
                'id_stock_4' => $data['id_stock_4'],
                'id_karyawan' => $session->get('id_user'),
                $jnis => $val
            ]);
        } elseif ($kel == '5') {
            $this->datastock5->save([
                'id_stock_5' => $data['id_stock_5'],
                'id_karyawan' => $session->get('id_user'),
                $jnis => $val
            ]);
        } elseif ($kel == '6') {
            $this->datastock6->save([
                'id_stock_6' => $data['id_stock_6'],
                'id_karyawan' => $session->get('id_user'),
                $jnis => $val
            ]);
        }
    }
    //------------------------------------------------Update Penjualan-----------------------------------------------------
}
