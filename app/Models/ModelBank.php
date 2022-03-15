<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBank extends Model
{

    protected $table = 'tbl_bank';
    protected $primaryKey = 'id_bank';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_bank'];

    public function getBank($id = false)
    {
        if ($id == false) {
            $data = $this->findAll();
            return $data;
        }
        return $this->where(['id_merek' => $id])->first();
    }
}
