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
        $this->modeltransaksi->save([
            'id_transaksi' => $id,
            'id_karyawan' => $session->get('id_user'),
            'total_keluar' => $sumkeluar['keluar'],
            'total_masuk' => $summasuk['masuk'],
            'saldo_akhir' => $summasuk['masuk'] - $sumkeluar['keluar'],
        ]);
    }
}
