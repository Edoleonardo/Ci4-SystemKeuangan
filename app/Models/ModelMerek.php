<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMerek extends Model
{

    protected $table = 'tbl_merek';
    protected $primaryKey = 'id_merek';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_merek', 'id_karyawan'];

    public function getMerek($id = false)
    {
        if ($id == false) {
            $this->findAll();
            $this->orderBy('nama_merek', 'ASC');
            $data = $this->get();
            return $data->getResult('array');
        }
        return $this->where(['id_merek' => $id])->first();
    }
    public function getNamaMerek($id = false)
    {
        return $this->where(['nama_merek' => $id])->first();
    }
}
