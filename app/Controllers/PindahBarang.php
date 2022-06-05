<?php

namespace App\Controllers;

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use App\Models\ModelDetailBuyback;
use App\Models\ModelPenjualan;
use App\Models\ModelDetailPenjualan;
use App\Models\ModelKadar;
use App\Models\ModelMerek;
use App\Models\ModelSupplier;
use App\Models\ModelStock1;
use App\Models\ModelStock2;
use App\Models\ModelStock3;
use App\Models\ModelStock4;
use App\Models\ModelStock5;
use App\Models\ModelStock6;
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
        $this->datastock = new ModelStock1();
        $this->datastock2 = new ModelStock2();
        $this->datastock3 = new ModelStock3();
        $this->datastock4 = new ModelStock4();
        $this->datastock5 = new ModelStock5();
        $this->datastock6 = new ModelStock6();
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
        $data = $this->modelstockreal->DataStockReal();
        //dd($data);
        // dd($datapembelianreal);
        // foreach ($data as $row) {
        //     if (substr($row['Kode_Brg'], 0, 1) == 1) {
        //         $this->datastock->save([
        //             'barcode' => $row['Kode_Brg'],
        //             'id_karyawan' => 'dev',
        //             'status' => 'B',
        //             'no_faktur' => $row['No_Faktur'],
        //             'tgl_faktur' => date("Y-m-d H:i:s"),
        //             'nama_supplier' => $row['Supplier'],
        //             'qty' => $row['Jml'],
        //             'jenis' => $row['Jenis'],
        //             'model' => $row['Model'],
        //             'keterangan' => $row['Keterangan'],
        //             'merek' => $row['Merk'],
        //             'kadar' => $row['Kadar'],
        //             'berat_murni' => '0',
        //             'berat' => $row['Berat'],
        //             'nilai_tukar' =>  $row['N_Tukar'],
        //             'ongkos' => $row['Ongkos'],
        //             'harga_beli' => $row['Hrg_Jual'],
        //             'total_harga' => '0',
        //             'gambar' =>  $row['Kode_Brg'] . '.jpg',
        //         ]);
        //     }
        //     if (substr($row['Kode_Brg'], 0, 1) == 2) {
        //         $this->datastock2->save([
        //             'barcode' => $row['Kode_Brg'],
        //             'id_karyawan' => 'dev',
        //             'status' => 'B',
        //             'no_faktur' => $row['No_Faktur'],
        //             'tgl_faktur' => date("Y-m-d H:i:s"),
        //             'nama_supplier' => $row['Supplier'],
        //             'qty' => $row['Jml'],
        //             'jenis' => $row['Jenis'],
        //             'model' => $row['Model'],
        //             'keterangan' => $row['Keterangan'],
        //             'merek' => $row['Merk'],
        //             'kadar' => $row['Kadar'],
        //             'berat' => $row['Berat'],
        //             'harga_beli' => $row['Hrg_Jual'],
        //             'total_harga' => '0',
        //             'gambar' =>  $row['Kode_Brg'] . '.jpg',
        //         ]);
        //     }
        //     if (substr($row['Kode_Brg'], 0, 1) == 3) {

        //         $this->datastock3->save([
        //             'barcode' => $row['Kode_Brg'],
        //             'id_karyawan' => 'dev',
        //             'status' => 'B',
        //             'no_faktur' => $row['No_Faktur'],
        //             'tgl_faktur' => date("Y-m-d H:i:s"),
        //             'nama_supplier' => $row['Supplier'],
        //             'qty' => $row['Jml'],
        //             'jenis' => $row['Jenis'],
        //             'model' => $row['Model'],
        //             'keterangan' => $row['Keterangan'],
        //             'merek' => $row['Merk'],
        //             'kadar' => $row['Kadar'],
        //             'berat' => $row['Berat'],
        //             'harga_beli' => $row['Hrg_Jual'],
        //             'total_harga' => '0',
        //             'gambar' =>  $row['Kode_Brg'] . '.jpg',
        //         ]);
        //     }
        //     if (substr($row['Kode_Brg'], 0, 1) == 4) {
        //         $this->datastock4->save([
        //             'barcode' => $row['Kode_Brg'],
        //             'id_karyawan' => 'dev',
        //             'status' => 'B',
        //             'no_faktur' => $row['No_Faktur'],
        //             'tgl_faktur' => date("Y-m-d H:i:s"),
        //             'nama_supplier' => $row['Supplier'],
        //             'qty' => $row['Jml'],
        //             'jenis' => $row['Jenis'],
        //             'model' => $row['Model'],
        //             'keterangan' => $row['Keterangan'],
        //             'kadar' => $row['Kadar'],
        //             'berat' => $row['Berat'],
        //             'harga_beli' => $row['Hrg_Jual'],
        //             'total_harga' => '0',
        //             'gambar' =>  $row['Kode_Brg'] . '.jpg',
        //         ]);
        //     }
        //     if (substr($row['Kode_Brg'], 0, 1) == 5) {
        //         $this->datastock5->save([
        //             'barcode' => $row['Kode_Brg'],
        //             'id_karyawan' => 'dev',
        //             'status' => 'B',
        //             'no_faktur' => $row['No_Faktur'],
        //             'tgl_faktur' => date("Y-m-d H:i:s"),
        //             'nama_supplier' => $row['Supplier'],
        //             'qty' => $row['Jml'],
        //             'jenis' => $row['Jenis'],
        //             'model' => $row['Model'],
        //             'keterangan' => $row['Keterangan'],
        //             'merek' => $row['Merk'],
        //             'carat' => $row['Berat'],
        //             'harga_beli' => $row['Hrg_Jual'],
        //             'total_harga' => '0',
        //             'gambar' =>  $row['Kode_Brg'] . '.jpg',
        //         ]);
        //     }
        //     if (substr($row['Kode_Brg'], 0, 1) == 6) {
        //         $this->datastock6->save([
        //             'barcode' => $row['Kode_Brg'],
        //             'id_karyawan' => 'dev',
        //             'status' => 'B',
        //             'no_faktur' => $row['No_Faktur'],
        //             'tgl_faktur' => date("Y-m-d H:i:s"),
        //             'nama_supplier' => $row['Supplier'],
        //             'qty' => $row['Jml'],
        //             'jenis' => $row['Jenis'],
        //             'model' => $row['Model'],
        //             'keterangan' => $row['Keterangan'],
        //             'merek' => $row['Merk'],
        //             'harga_beli' => $row['Hrg_Jual'],
        //             'total_harga' => '0',
        //             'gambar' =>  $row['Kode_Brg'] . '.jpg',
        //         ]);
        //     }
        // }
        return view('home/pindahindata');
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


        //////////////////////////////////////////DIPAKE//////////////////////////////////////////////////////
   
        ////////////////////Tbl_stock_1///////////////////////////// urut 1
        // foreach ($data as $row) {
        //     $kode = substr($row['Kode_Brg'], 0, 1);
        //     $beratmurni = round($row['Berat'] * ($row['N_Tukar'] / 100), 2);
        //     $harga = 800000;
        //     $qty = $row['Jml'];
        //     if ($kode == 1 || $kode == 4 || $kode == 5) {
        //         $totalharga =  $beratmurni *  $harga;
        //     }
        //     if ($kode == 2) {
        //         $totalharga = $harga;
        //     }
        //     if ($kode == 3) {
        //         $totalharga =  $beratmurni *  $harga * $qty;
        //     }
        //     if ($kode == 6) {
        //         $totalharga = $harga * $qty;
        //     }
        //     $this->datastock->save([
        //         'barcode' => $row['Kode_Brg'],
        //         'id_karyawan' => $session->get('id_user'),
        //         'status' => ($row['Kode_Brg']) ? $row['Kode_Brg'] : 'B',
        //         'no_faktur' => ($row['No_Faktur']) ? $row['No_Faktur'] : 'NoFaktur',
        //         'tgl_faktur' =>  date("Y-m-d H:i:s"),
        //         'nama_supplier' => ($row['Supplier']) ? $row['Supplier'] : 'NoSupp',
        //         'qty' => $qty,
        //         'jenis' => $row['Jenis'],
        //         'model' => $row['Model'],
        //         'keterangan' => $row['Keterangan'],
        //         'merek' => $row['Merk'],
        //         'kadar' => $row['Kadar'],
        //         'berat_murni' => $beratmurni,
        //         'berat' => round($row['Berat'], 2),
        //         'nilai_tukar' =>  $row['N_Tukar'],
        //         'harga_beli' => $harga,
        //         'ongkos' => $row['Ongkos'],
        //         'total_harga' => $totalharga + $row['Ongkos'],
        //         'gambar' =>  $row['Kode_Brg'] . '.jpg',
        //     ]);
        // }


        //////////////////////////////////penjualan -> tbl_stock_1//////////////////////////////////////
         // foreach ($data as $row) {
        //     $kode = substr($row['Kode_Brg'], 0, 1);
        //     $beratmurni = round($row['Berat'] * ($row['N_Tukar'] / 100), 2);
        //     $harga = 800000;
        //     $qty = $row['Jml'];
        //     if ($kode == 1 || $kode == 4 || $kode == 5) {
        //         $totalharga =  $beratmurni *  $harga;
        //     }
        //     if ($kode == 2) {
        //         $totalharga = $harga;
        //     }
        //     if ($kode == 3) {
        //         $totalharga =  $beratmurni *  $harga * $qty;
        //     }
        //     if ($kode == 6) {
        //         $totalharga = $harga * $qty;
        //     }
        //     $this->datastock->save([
        //         'barcode' => $row['Kode_Brg'],
        //         'id_karyawan' => $session->get('id_user'),
        //         'status' => ($row['Kode_Brg']) ? $row['Kode_Brg'] : 'B',
        //         'no_faktur' => ($row['No_Faktur']) ? $row['No_Faktur'] : 'NoFaktur',
        //         'tgl_faktur' => date("Y-m-d H:i:s"),
        //         'nama_supplier' => ($row['Supplier']) ? $row['Supplier'] : 'NoSupp',
        //         'qty' => $qty,
        //         'jenis' => $row['Jenis'],
        //         'model' => $row['Model'],
        //         'keterangan' => $row['Keterangan'],
        //         'merek' => $row['Merk'],
        //         'kadar' => $row['Kadar'],
        //         'berat_murni' => $beratmurni,
        //         'berat' => round($row['Berat'], 2),
        //         'nilai_tukar' =>  $row['N_Tukar'],
        //         'harga_beli' => $harga,
        //         'ongkos' => $row['Ongkos'],
        //         'total_harga' => $totalharga + $row['Ongkos'],
        //         'gambar' =>  $row['Kode_Brg'] . '.jpg',
        //     ]);
        // }

        ///////////////////////Tbl_Pembelian/////////////////////////// urut 2
        
        // $data = $this->modelbelireal->getDataBeliREAL();
        // foreach ($data as $row) {
        //     $checkpembelian = $this->modelpembelian->GetNotransPindah($row['No_Nota']);
        //     if (!$checkpembelian) {
        //         $datasup = $this->datasupplier->getSupplierNama($row['Nama_Supplier']);
        //         $this->modelpembelian->save([
        //             'created_at' => $row['Tanggal'] . ' ' . date('H:i:s'),
        //             'id_date_pembelian' => $this->randomNumber(12),
        //             'id_supplier' => ($datasup) ?  $datasup['id_supplier'] : '122',
        //             'id_karyawan' => 1,
        //             'no_faktur_supp' => $row['No_Faktur'],
        //             'tgl_jatuh_tempo' => $row['Tanggal'] . ' ' . date('H:i:s'),
        //             'no_transaksi' => ($row['No_Nota']) ? $row['No_Nota'] : 'NoNoTrans',
        //             'tgl_faktur' => $row['Tanggal'] . ' ' . date('H:i:s'),
        //             'status_dokumen' => 'Selesai'
        //         ]);
        //     }



///////////////////////Tbl_Kartu,Tbl_detailkart,Tbl_stock_1,tbl_detailbeli/////////////////////////// urut 3
        // $data = $this->modelbelireal->getDataBeliREAL();
        // // dd($datapembelianreal);
        // foreach ($data as $row) {
        //     $datapembelian = $this->modelpembelian->GetNotransPindah($row['No_Nota']);
        //     $kode = substr($row['Kode'], 0, 1);
        //     $beratmurni = round($row['Berat'] * ($row['Nilai_Tukar'] / 100), 2);
        //     $harga = 800000;
        //     $qty = $row['Qty'];
        //     if ($kode == 1 || $kode == 4 || $kode == 5) {
        //         $totalharga =  $beratmurni *  $harga;
        //     }
        //     if ($kode == 2) {
        //         $totalharga = $harga;
        //     }
        //     if ($kode == 3) {
        //         $totalharga =  $beratmurni *  $harga * $qty;
        //     }
        //     if ($kode == 6) {
        //         $totalharga = $harga * $qty;
        //     }

        //     $this->modeldetailpembelian->save([
        //         'id_karyawan' => 0,
        //         'id_date_pembelian' => $datapembelian['id_date_pembelian'],
        //         'nama_img' => $row['Kode'] . '.jpg',
        //         'kode' =>   $row['Kode'],
        //         'qty' => $qty,
        //         'jenis' => $row['Jenis'],
        //         'model' => $row['Model'],
        //         'keterangan' => $row['Keterangan'],
        //         'berat' => round($row['Berat'], 2),
        //         'berat_murni' => $beratmurni,
        //         'ongkos' => $row['Ongkos'],
        //         'harga_beli' => $harga,
        //         'kadar' =>  $row['Kadar'],
        //         'nilai_tukar' =>  $row['Nilai_Tukar'],
        //         'merek' => $row['Merek'],
        //         'total_harga' => $totalharga + $row['Ongkos'],
        //     ]);

        //     $datastock = $this->datastock->getBarangkode($row['Kode']);
        //     if ($datastock) {
        //         $this->datastock->delete($datastock['id_stock_1']);
        //         $bikinbaru = true;
        //     } else {
        //         $bikinbaru = true;
        //     }
        //     if ($bikinbaru) {
        //         $this->datastock->save([
        //             'barcode' => $row['Kode'],
        //             'id_karyawan' => $session->get('id_user'),
        //             'status' => 'B',
        //             'no_faktur' => $row['No_Nota'],
        //             'tgl_faktur' =>  $row['Tanggal'],
        //             'id_supplier' => $datapembelian['id_supplier'],
        //             'qty' => $qty,
        //             'jenis' => $row['Jenis'],
        //             'model' => $row['Model'],
        //             'keterangan' => $row['Keterangan'],
        //             'merek' => $row['Merek'],
        //             'kadar' => $row['Kadar'],
        //             'berat_murni' => $beratmurni,
        //             'berat' => round($row['Berat'], 2),
        //             'nilai_tukar' =>  $row['Nilai_Tukar'],
        //             'ongkos' => $row['Ongkos'],
        //             'harga_beli' => $harga,
        //             'total_harga' => $totalharga + $row['Ongkos'],
        //             'gambar' =>  $row['Kode'] . '.jpg',
        //         ]);
        //     }

        //     $datakartu = $this->modelkartustock->getKartuStockkode($row['Kode']);
        //     if ($datakartu) {
        //         $saldoakhir = $datakartu['saldo_akhir'];
        //     } else {
        //         $saldoakhir = 0;
        //     }
        //     if ($kode == 4) {
        //         $saldo =  round($row['Berat'], 2);
        //         $saldofinal = round($row['Berat'], 2) + $saldoakhir;
        //     } else {
        //         $saldo =  $qty;
        //         $saldofinal =  $qty + $saldoakhir;
        //     }
        //     $this->modeldetailkartustock->save([
        //         // 'id_detail_kartustock' => $datadetailkartu['id_detail_kartustock'],
        //         'barcode' =>  $row['Kode'],
        //         'status' => 'Masuk',
        //         'id_karyawan' => 1,
        //         'no_faktur' => $row['No_Nota'],
        //         'tgl_faktur' => $row['Tanggal'],
        //         'nama_customer' => $row['Nama_Supplier'],
        //         'saldo' => $saldofinal,
        //         'masuk' => $saldo,
        //         'keluar' => 0,
        //         'jenis' => $row['Jenis'],
        //         'model' => $row['Model'],
        //         'keterangan' => 'Pembelian Supplier',
        //         'merek' => $row['Merek'],
        //         'kadar' => $row['Kadar'],
        //         'berat' => round($row['Berat'], 2),
        //         'nilai_tukar' =>  $row['Nilai_Tukar'],
        //         'harga_beli' => $harga,
        //         'total_harga' => $totalharga + $row['Ongkos'],
        //         'gambar' => $row['Kode'] . '.jpg',
        //     ]);
        //     $this->KartuStockMaster($row['Kode'], $session);
        // }

        ////////////////////////////////Update Tbl_Pembelian///////////////////////////////////////////////
        // foreach ($data as $row) {
        //     $this->modelpembelian->save([
        //         'id_pembelian' => $row['id_pembelian'],
        //         'total_berat_murni' => round($this->modeldetailpembelian->SumBeratMurniDetail($row['id_date_pembelian'])['berat_murni'], 2),
        //         'byr_barang' => round($this->modeldetailpembelian->SumBeratMurniDetail($row['id_date_pembelian'])['berat_murni'], 2),
        //         'total_berat_rill' => round($this->modeldetailpembelian->SumBeratDetail($row['id_date_pembelian'])['berat'], 2),
        //         'berat_murni_rill' => round($this->modeldetailpembelian->SumBeratMurniDetail($row['id_date_pembelian'])['berat_murni'], 2),
        //         'cara_pembayaran' => 'Bayar Nanti',
        //         'total_bayar' => $this->modeldetailpembelian->SumDataDetail($row['id_date_pembelian']),
        //         'total_qty' => $this->modeldetailpembelian->SumQty($row['id_date_pembelian'])['qty'],
        //     ]);
        // }


        /////////////////////////////////Tbl_Penjualan/////////////////////////////////////////////
        //$data = $this->modeljualreal->getDataPenjualan();
        // foreach ($data as $row) {
        //     $datajual = $this->penjualan->getDataNoTrans($row['No_Nota']);
        //     $datakartu = $this->modelkartustock->getKartuStockkode($row['Kode']);
        //     if (!$datajual && $datakartu) {
        //         $this->penjualan->save([
        //             'id_date_penjualan' => $this->randomNumber(12),
        //             'no_transaksi_jual' => $row['No_Nota'],
        //             'id_customer' => '',
        //             'id_karyawan' => $session->get('id_user'),
        //             'nohp_cust' => $row['Nama_Customer'],
        //             'jumlah' => '0',
        //             'pembulatan' => '0',
        //             'total_harga' => '0',
        //             'nama_bank' => 'NoBank',
        //             'charge' =>   $this->request->getVar('charge'),
        //             'pembayaran' => $row['Pembayaran'],
        //             'tunai' =>  $row['Tunai'],
        //             'debitcc' =>  $row['DebitCC'],
        //             'transfer' =>  $row['Transfer'],
        //             'status_dokumen' => 'Selesai',
        //         ]);
        //     }

        // foreach ($data as $row) {
        //     $datajual = $this->penjualan->getDataNoTrans($row['No_Nota']);
        //     // $datakartu = $this->modelkartustock->getKartuStockkode($row['Kode']);
        //     if (!$datajual) {
        //         $this->penjualan->save([
        //             'id_date_penjualan' => $this->randomNumber(12),
        //             'no_transaksi_jual' => $row['No_Nota'],
        //             'id_customer' => '',
        //             'id_karyawan' => $session->get('id_user'),
        //             'nohp_cust' => ($row['Nama_Customer']) ? $row['Nama_Customer'] : 'NoCust',
        //             'jumlah' => '0',
        //             'pembulatan' => '0',
        //             'total_harga' => '0',
        //             'nama_bank' => 'NoBank',
        //             'charge' =>   0,
        //             'pembayaran' => 'PindahData',
        //             'tunai' =>  0,
        //             'debitcc' =>  0,
        //             'transfer' =>  0,
        //             'status_dokumen' => 'Selesai',
        //         ]);
        //     }


        /////////////////////////////Tbl_detailjual//////////////////////////////////
        // $data = $this->modeljualreal->getDataPenjualan();
        // // dd($datapembelianreal);
        // foreach ($data as $row) {
        //     $datajual = $this->penjualan->getDataNoTrans($row['No_Nota']);
        //     $datakartu = $this->modelkartustock->getKartuStockkode($row['Kode']);
        //     if ($datajual && $datakartu) {
        //         // $datastock = $this->modelkartustock->getKartuStockkode($row['Kode']);
        //         $datastock = $this->datastock->getBarangkode($row['Kode']);
        //         $this->modeldetailpenjualan->save([
        //             'id_date_penjualan' => $datajual['id_date_penjualan'],
        //             'id_karyawan' => $session->get('id_user'),
        //             'nama_img' => $datastock['gambar'],
        //             'status' => $datastock['status'],
        //             'kode' =>  $datastock['barcode'],
        //             'qty' => $row['Qty'],
        //             'saldo' => $row['Qty'],
        //             'jenis' =>  $row['Jenis'],
        //             'model' =>  $row['Model'],
        //             'keterangan' =>  $row['Keterangan'],
        //             'berat' =>  $row['Berat'],
        //             'berat_murni' =>  $datastock['berat_murni'],
        //             'harga_beli' =>  $datastock['harga_beli'],
        //             'ongkos' => $datastock['ongkos'],
        //             'kadar' =>   $row['Kadar'],
        //             'nilai_tukar' =>   $datastock['nilai_tukar'],
        //             'merek' =>  $datastock['merek'],
        //             'total_harga' => $row['Total'],
        //         ]);
        //     }
        // }