<?php

namespace App\Controllers;

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use App\Models\ModelDetailBuyback;
use App\Models\ModelPenjualan;
use App\Models\ModelDetailPenjualan;
use App\Models\ModelKadar;
use App\Models\ModelMerek;
use App\Models\ModelSupplier;
use App\Models\ModelHome;
use App\Models\ModelBuyback;
use App\Models\ModelKartuStock;
use App\Models\ModelDetailKartuStock;
use App\Models\ModelBank;
use App\Models\ModelCustomer;
use App\Models\ModelJenis;
use App\Models\ModelTransaksi;
use App\Models\ModelDetailTransaksi;
use App\Models\ModelPembelian;
use App\Models\ModelDetailMasuk;
use App\Models\ModelPembelianREAL;
use App\Models\ModelPenjualanREAL;
use App\Models\ModelStockREAL;
use App\Models\ModelBuybackREAL;

use CodeIgniter\Validation\Rules;

class PindahBarang extends BaseController
{
    protected $barangmodel;
    protected $barcodeG;

    public function __construct()
    {
        $this->modeldetailpenjualan =  new ModelDetailPenjualan();
        $this->barcodeG =  new BarcodeGenerator();
        $this->barcodeG =  new BarcodeGenerator();
        $this->penjualan =  new ModelPenjualan();
        $this->modeldetailbuyback = new ModelDetailBuyback();
        $this->datasupplier = new ModelSupplier();
        $this->datakadar = new ModelKadar();
        $this->datamerek = new ModelMerek();
        $this->datastock = new ModelHome();
        $this->modelbuyback = new ModelBuyback();
        $this->modelkartustock = new ModelKartuStock();
        $this->modeldetailkartustock = new ModelDetailKartuStock();
        $this->modelbank = new ModelBank();
        $this->datacust = new ModelCustomer();
        $this->datajenis = new ModelJenis();
        $this->modeldetailtransaksi = new ModelDetailTransaksi();
        $this->modeltransaksi = new ModelTransaksi();
        $this->modelpembelian = new ModelPembelian();
        $this->modeldetailpembelian = new ModelDetailMasuk();
        $this->modelbelireal = new ModelPembelianREAL();
        $this->modeljualreal = new ModelPenjualanREAL();
        $this->modelstockreal = new ModelStockREAL();
        $this->modelbuybackreal = new ModelBuybackREAL();
    }
    public function HomePindah()
    {
        $session = session();
        $data = $this->datastock->Getsemuadata();
        // dd($datapembelianreal);
        foreach ($data as $row) {
        }
        return view('pindahindata');
    }

    public  function inisial($nama)
    {
        $arr = explode(' ', $nama);
        $singkatan = '';
        foreach ($arr as $kata) {
            $singkatan .= substr($kata, 0, 1);
        }
        return $singkatan;
    }

    public function randomNumber($length)
    {
        $result = '';

        for ($i = 0; $i < $length; $i++) {
            $result .= mt_rand(1, 9);
        }

        return $result;
    }
}




//jeniss
// $dataenjualan = $this->datamerek->getNamaMerek($row['Merk']);
// if (!$dataenjualan) {
//     $this->datamerek->save([
//         'nama_merek' => $row['Merk'],
//         'id_karyawan' => $session->get('id_user'),
//     ]);
// }

// id_detail_pembelian
// if (!$databelikw) {
//     $datasup = $this->datasupplier->getSupplierNama($row['Nama_Supplier']);
//     $this->modelpembelian->save([
//         'created_at' => $row['Tanggal'] . ' ' . date('H:i:s'),
//         'id_date_pembelian' => $this->randomNumber(12),
//         'id_supplier' => ($datasup) ?  $datasup['id_supplier'] : '122',
//         'id_karyawan' => 1,
//         'no_faktur_supp' => $row['No_Faktur'],
//         'tgl_jatuh_tempo' => $row['Tanggal'] . ' ' . date('H:i:s'),
//         'no_transaksi' => ($row['No_Nota']) ? $row['No_Nota'] : 'NoNoTrans',
//         'tgl_faktur' => $row['Tanggal'] . ' ' . date('H:i:s'),
//         'status_dokumen' => 'Selesai'
//     ]);
// }

                // 'total_berat_murni' => $this->request->getVar('total_berat_m'),
                // 'byr_berat_murni' => $this->request->getVar('total_berat_m'),
                // 'tgl_jatuh_tempo' => $this->request->getVar('tanggal_tempo'),
                // 'total_berat_rill' => round($this->detailbeli->SumBeratDetail($this->request->getVar('dateid'))['berat'], 2),
                // 'berat_murni_rill' => round($this->detailbeli->SumBeratMurniDetail($this->request->getVar('dateid'))['berat_murni'], 2),
                // 'total_qty' => $this->detailbeli->SumQty($this->request->getVar('dateid'))['qty'],
                // 'total_bayar' =>  $totalharga,



//tbl_stock, kartustock, detail kartu stock
// $databelikw = $this->modelpembelian->GetDataNotrans($row['No_Nota']);
// $datasup = $this->datasupplier->getSupplierNama($row['Nama_Supplier']);
// $kode = substr($row['Kode'], 0, 1);
// $beratmurni = round($row['Berat'] * ($row['Nilai_Tukar'] / 100), 2);
// $harga = 800000;
// $qty = $row['Qty'];
// if ($kode == 1 || $kode == 4 || $kode == 5) {
//     $totalharga =  $beratmurni *  $harga;
// }
// if ($kode == 2) {
//     $totalharga = $harga;
// }
// if ($kode == 3) {
//     $totalharga =  $beratmurni *  $harga * $qty;
// }
// if ($kode == 6) {
//     $totalharga = $harga * $qty;
// }

// $this->modeldetailpembelian->save([
//     'id_karyawan' => 0,
//     'id_date_pembelian' => $row['id_date_pembelianreal'],
//     'nama_img' => $row['Kode'] . '.jpg',
//     'kode' =>   $row['Kode'],
//     'qty' => $qty,
//     'jenis' => $row['Jenis'],
//     'model' => $row['Model'],
//     'keterangan' => $row['Keterangan'],
//     'berat' => round($row['Berat'], 2),
//     'berat_murni' => $beratmurni,
//     'ongkos' => $row['Ongkos'],
//     'harga_beli' => $harga,
//     'kadar' =>  $row['Kadar'],
//     'nilai_tukar' =>  $row['Nilai_Tukar'],
//     'merek' => $row['Merek'],
//     'total_harga' => $totalharga + $row['Ongkos'],
// ]);
// $this->datastock->save([
//     'barcode' => $row['Kode'],
//     'id_karyawan' => $session->get('id_user'),
//     'status' => 'B',
//     'no_faktur' => $row['No_Nota'],
//     'tgl_faktur' =>  $row['Tanggal'],
//     'id_supplier' => ($datasup) ?  $datasup['id_supplier'] : '122',
//     'qty' => $qty,
//     'jenis' => $row['Jenis'],
//     'model' => $row['Model'],
//     'keterangan' => $row['Keterangan'],
//     'merek' => $row['Merek'],
//     'kadar' => $row['Kadar'],
//     'berat_murni' => $beratmurni,
//     'berat' => round($row['Berat'], 2),
//     'nilai_tukar' =>  $row['Nilai_Tukar'],
//     'ongkos' => $row['Ongkos'],
//     'harga_beli' => $harga,
//     'total_harga' => $totalharga + $row['Ongkos'],
//     'gambar' =>  $row['Kode'] . '.jpg',
// ]);
// if ($kode == 4) {
//     $saldo =  round($row['Berat'], 2);
// } else {
//     $saldo =  $qty;
// }
// $this->modeldetailkartustock->save([
//     // 'id_detail_kartustock' => $datadetailkartu['id_detail_kartustock'],
//     'barcode' =>  $row['Kode'],
//     'status' => 'Masuk',
//     'id_karyawan' => 1,
//     'no_faktur' => $row['No_Nota'],
//     'tgl_faktur' => $row['Tanggal'],
//     'nama_customer' => $row['Nama_Supplier'],
//     'saldo' => $saldo,
//     'masuk' => $saldo,
//     'keluar' => 0,
//     'jenis' => $row['Jenis'],
//     'model' => $row['Model'],
//     'keterangan' => 'Pembelian Supplier',
//     'merek' => $row['Merek'],
//     'kadar' => $row['Kadar'],
//     'berat' => round($row['Berat'], 2),
//     'nilai_tukar' =>  $row['Nilai_Tukar'],
//     'harga_beli' => $harga,
//     'total_harga' => $totalharga + $row['Ongkos'],
//     'gambar' => $row['Kode'] . '.jpg',
// ]);
// $this->KartuStockMaster($row['Kode'], $session);




// datastock
  // $kode = substr($row['Kode_Brg'], 0, 1);
            // $beratmurni = round($row['Berat'] * ($row['N_Tukar'] / 100), 2);
            // $harga = 800000;
            // $qty = $row['Jml'];
            // if ($kode == 1 || $kode == 4 || $kode == 5) {
            //     $totalharga =  $beratmurni *  $harga;
            // }
            // if ($kode == 2) {
            //     $totalharga = $harga;
            // }
            // if ($kode == 3) {
            //     $totalharga =  $beratmurni *  $harga * $qty;
            // }
            // if ($kode == 6) {
            //     $totalharga = $harga * $qty;
            // }
            // $this->datastock->save([
            //     'barcode' => $row['Kode_Brg'],
            //     'id_karyawan' => $session->get('id_user'),
            //     'status' => 'B',
            //     'no_faktur' => 'TidakAda',
            //     'tgl_faktur' =>  date("Y-m-d H:i:s"),
            //     'nama_supplier' => 'NoSup',
            //     'qty' => $qty,
            //     'jenis' => $row['Jenis'],
            //     'model' => $row['Model'],
            //     'keterangan' => $row['Keterangan'],
            //     'merek' => $row['Merk'],
            //     'kadar' => $row['Kadar'],
            //     'berat_murni' => $beratmurni,
            //     'berat' => round($row['Berat'], 2),
            //     'nilai_tukar' =>  $row['N_Tukar'],
            //     'harga_beli' => $harga,
            //     'ongkos' => $row['Ongkos'],
            //     'total_harga' => $totalharga + $row['Ongkos'],
            //     'gambar' =>  $row['Kode_Brg'] . '.jpg',
            // ]);