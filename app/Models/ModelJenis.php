<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelJenis extends Model
{

    protected $table = 'tbl_jenis';
    protected $primaryKey = 'id_jenis';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama'];

    public function getJenis($id = false)
    {
        if ($id == false) {

            $data = $this->findAll();
            return $data;
        }
        return $this->where(['id_jenis' => $id])->first();
    }
}
