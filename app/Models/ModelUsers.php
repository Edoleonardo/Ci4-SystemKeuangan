<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUsers extends Model
{

    protected $table = 'tbl_pegawai';
    protected $primaryKey = 'id_pegawai';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_pegawai', 'id_karyawan', 'nohp', 'alamat', 'username', 'password', 'role'];

    public function getUsers($id = false)
    {
        if ($id == false) {

            $data = $this->findAll();
            return $data;
        }
        return $this->where(['id_pegawai' => $id])->first();
    }
}
