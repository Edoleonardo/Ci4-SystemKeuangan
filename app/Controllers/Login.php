<?php

namespace App\Controllers;

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use App\Models\ModelStock1;
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
        $this->barangmodel = new ModelStock1();
        $this->modelkartustock = new ModelKartuStock();
        $this->modeldetailkartustock = new ModelDetailKartuStock();
        $this->modellogin = new ModelLogin();
        $this->chace = new ConfigCache();
    }
    public function login()
    {
        $session = session();
        $session->destroy();
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
                'username1' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Username Harus di isi',
                    ]
                ],
                'password1' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password Harus di isi',
                    ]
                ],

            ])) {
                $msg = [
                    'error' => [
                        'username1' => $validation->getError('username1'),
                        'password1' => $validation->getError('password1'),
                    ]
                ];
                echo json_encode($msg);
            } else {
                $username1 = $this->request->getVar('username1');
                $password1 = $this->request->getVar('password1');
                $check = $this->modellogin->getDatauserAll();
                $data = $this->multi_array_search($check, array('username' => $username1, 'password' =>  $password1));
                if ($data) {
                    if ($this->request->getVar('remember')) {
                        setcookie("username1", $username1, time() + (10 * 365 * 24 * 60 * 60), "/");
                        setcookie("password1", $password1, time() + (10 * 365 * 24 * 60 * 60), "/");
                    } else {
                        if (isset($_COOKIE['username1'])) {
                            setcookie('username1', '');
                        }
                        if (isset($_COOKIE['password1'])) {
                            setcookie('password1', '');
                        }
                    }
                    $session = session();
                    $session->set('role', $check[$data[0]]['role']);
                    $session->set('id_user', $check[$data[0]]['id_pegawai']);
                    $session->set('nama_user', $check[$data[0]]['nama_pegawai']);
                    $msg = 'berhasil';
                } else {
                    if (isset($_COOKIE['username1'])) {
                        setcookie('username1', '');
                    }
                    if (isset($_COOKIE['password1'])) {
                        setcookie('password1', '');
                    }
                    $msg = 'gagal';
                }
                echo json_encode($msg);
            }
        }
    }

    public  function multi_array_search($array, $search)
    {

        // Create the result array
        $result = array();

        // Iterate over each array element
        foreach ($array as $key => $value) {

            // Iterate over each search condition
            foreach ($search as $k => $v) {

                // If the array element does not meet the search condition then continue to the next element
                if (!isset($value[$k]) || $value[$k] != $v) {
                    continue 2;
                }
            }

            // Add the array element's key to the result array
            $result[] = $key;
        }

        // Return the result array
        return $result;
    }
}
