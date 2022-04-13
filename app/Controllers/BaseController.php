<?php

namespace App\Controllers;

use CodeIgniter\Validation\Rules;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\ModelTransaksi;
use App\Models\ModelDetailTransaksi;



/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Constructor.
     */

    public function __construct()
    {
        $this->modeldetailtransaksi = new ModelDetailTransaksi();
        $this->modeltransaksi = new ModelTransaksi();
    }
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
        session();
    }
    public function BiayaHarianMaster($id, $session)
    {
        $sumkeluar = $this->modeldetailtransaksi->SumTotalKeluar();
        $summasuk = $this->modeldetailtransaksi->SumTotalMasuk();
        $sumbmasuktunai = $this->modeldetailtransaksi->SumTotalMasukTunai();
        $sumkeluartunai = $this->modeldetailtransaksi->SumTotalKeluarTunai();
        $sumbmasuktransfer = $this->modeldetailtransaksi->SumTotalMasukTransfer();
        $sumkeluartransfer = $this->modeldetailtransaksi->SumTotalKeluarTransfer();
        $sumbmasukdebitcc = $this->modeldetailtransaksi->SumTotalMasukDebitcc();
        $sumkeluardebitcc = $this->modeldetailtransaksi->SumTotalKeluarDebitcc();
        $this->modeltransaksi->save([
            'id_transaksi' => $id,
            'id_karyawan' => $session->get('id_user'),
            'total_masuk_tunai' => $sumbmasuktunai['masuk'],
            'total_keluar_tunai' => $sumkeluartunai['keluar'],
            'total_akhir_tunai' => $sumbmasuktunai['masuk'] - $sumkeluartunai['keluar'],
            'total_masuk_transfer' => $sumbmasuktransfer['masuk'],
            'total_keluar_transfer' => $sumkeluartransfer['keluar'],
            'total_akhir_transfer' => $sumbmasuktransfer['masuk'] - $sumkeluartransfer['keluar'],
            'total_masuk_debitcc' => $sumbmasukdebitcc['masuk'],
            'total_keluar_debitcc' => $sumkeluardebitcc['keluar'],
            'total_akhir_debitcc' =>  $sumbmasukdebitcc['masuk'] - $sumkeluardebitcc['keluar'],
            'total_keluar' => $sumkeluar['keluar'],
            'total_masuk' => $summasuk['masuk'],
            'saldo_akhir' => $summasuk['masuk'] - $sumkeluar['keluar'],
        ]);
    }
    public function TotalHargaJual($idate, $session)
    {
        $datajual = $this->penjualan->getDataPenjualan($idate);
        $totalharga = $this->modeldetailpenjualan->SumDataDetailJual($idate);
        $this->penjualan->save([
            'id_penjualan' => $datajual['id_penjualan'],
            'id_karyawan' => $session->get('id_user'),
            'total_harga' => $totalharga,
        ]);
    }
    public function KartuStockMaster($kode, $session)
    {
        $datakartu = $this->modelkartustock->getKartuStockkode($kode);
        if ($datakartu) {
            $masuk = $this->modeldetailkartustock->SumMasukKartu($kode)['masuk'];
            $keluar = $this->modeldetailkartustock->SumKeluarKartu($kode)['keluar'];
            $saldoakhir = $masuk - $keluar;
            $this->modelkartustock->save([
                'id_kartustock' => $datakartu['id_kartustock'],
                'id_karyawan' => $session->get('id_user'),
                'total_masuk' => $masuk,
                'total_keluar' => $keluar,
                'saldo_akhir' => $saldoakhir,
            ]);
        } else {
            $masuk = $this->modeldetailkartustock->SumMasukKartu($kode)['masuk'];
            $keluar = $this->modeldetailkartustock->SumKeluarKartu($kode)['keluar'];
            $saldoakhir = $masuk - $keluar;
            $this->modelkartustock->save([
                'kode' => $kode,
                'id_karyawan' => $session->get('id_user'),
                'total_masuk' => $masuk,
                'total_keluar' => $keluar,
                'saldo_akhir' => $saldoakhir,
            ]);
        }
    }
}
