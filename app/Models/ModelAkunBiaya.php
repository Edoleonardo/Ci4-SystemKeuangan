<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAkunBiaya extends Model
{

    protected $table = 'tbl_akun_biaya';
    protected $primaryKey = 'id_akun_biaya  ';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_akun', 'id_karyawan'];

    public function getAkunBiaya($id = false)
    {
        if ($id == false) {

            $data = $this->findAll();
            return $data;
        }
        return $this->where(['id_akun_biaya' => $id])->first();
    }
}
