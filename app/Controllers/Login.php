<?php

namespace App\Controllers;

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use App\Models\ModelHome;
use App\Models\ModelKartuStock;
use App\Models\ModelDetailKartuStock;
use App\Models\ModelLogin;

use CodeIgniter\Validation\Rules;
use app\Config\Cache;
use Config\Cache as ConfigCache;

class Login extends BaseController
{
    protected $barangmodel;
    protected $barcodeG;

    public function __construct()
    {

        $this->barcodeG =  new BarcodeGenerator();
        $this->barangmodel = new ModelHome();
        $this->modelkartustock = new ModelKartuStock();
        $this->modeldetailkartustock = new ModelDetailKartuStock();
        $this->modellogin = new ModelLogin();
        $this->chace = new ConfigCache();
    }
    public function login()
    {
        return view('login/loginview');
    }
    public function LogOut()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
    public function MasukLogin()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            if (!$this->validate([
                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Username Harus di isi',
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password Harus di isi',
                    ]
                ],

            ])) {
                $msg = [
                    'error' => [
                        'username' => $validation->getError('username'),
                        'password' => $validation->getError('password'),
                    ]
                ];
                echo json_encode($msg);
            } else {
                $username = $this->request->getVar('username');
                $password = $this->request->getVar('password');
                if ($this->request->getVar('remember')) {
                    setcookie("username", $username, time() + (10 * 365 * 24 * 60 * 60));
                    setcookie("password", $password, time() + (10 * 365 * 24 * 60 * 60));
                } else {
                    if (isset($_COOKIE['username'])) {
                        setcookie('username', '');
                    }
                    if (isset($_COOKIE['password'])) {
                        setcookie('password', '');
                    }
                }
                $check = $this->modellogin->getLoginData($username, $password);
                $session = session();
                $session->set('role', $check['role']);
                $session->set('id_user', $check['id_pegawai']);
                $session->set('nama_user', $check['nama_pegawai']);

                echo json_encode($session->get('role'));
            }
        }
    }
}
