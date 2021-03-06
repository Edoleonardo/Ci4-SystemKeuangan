<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKadar extends Model
{

    protected $table = 'tbl_kadar';
    protected $primaryKey = 'id_kadar';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_kadar', 'nilai_kadar', 'id_karyawan'];

    public function getKadar($id = false)
    {
        if ($id == false) {
            $this->findAll();
            $this->orderBy('nilai_kadar', 'ASC');
            $data = $this->get();
            return $data->getResult('array');
        }
        return $this->where(['id_kadar' => $id])->first();
    }
    public function getNamaKadar($id = false)
    {
        return $this->where(['nama_kadar' => $id])->first();
    }
}
