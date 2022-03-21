<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLogin extends Model
{

    protected $table = 'tbl_pegawai';
    protected $primaryKey = 'id_pegawai';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_pegawai', 'nohp', 'alamat', 'username', 'password', 'total_berat', 'role'];

    public function getDatauserAll($id = false)
    {
        if ($id == false) {
            $this->findAll();
            $this->orderBy('created_at', 'DESC');
            $data = $this->get();
            return $data->getResult('array');
        }
        return $this->where(['id_date_cuci' => $id])->first();
    }
    // public function getBarangkode($id)
    // {
    //     return $this->where(['barcode' => $id])->first();
    // }
    public function getNoTransCuci()
    {
        $db = db_connect();
        $data = $db->query('select max(substr(no_cuci,3,10)) no_cuci from tbl_cuci limit 1');
        return $data->getResult('array')[0];
    }
    public function getLoginData($usr, $pss)
    {
        // dd('asd');
        $this->findAll();
        $this->where('username', $usr);
        $this->where('password', $pss);
        $data = $this->get();
        return $data->getResult('array')[0];
    }
}
