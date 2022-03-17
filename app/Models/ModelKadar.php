<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKadar extends Model
{

    protected $table = 'tbl_kadar';
    protected $primaryKey = 'id_kadar';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_kadar', 'nilai_kadar'];

    public function getKadar($id = false)
    {
        if ($id == false) {

            $data = $this->findAll();
            return $data;
        }
        return $this->where(['id_kadar' => $id])->first();
    }
}
