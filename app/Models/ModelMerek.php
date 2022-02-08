<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMerek extends Model
{

    protected $table = 'tbl_merek';
    protected $primaryKey = 'id_merek';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode', 'qty', 'jenis', 'model', 'keterangan', 'berat', 'harga_beli', 'kadar', 'nilai_tukar', 'merek', 'total_harga'];

    public function getMerek($id = false)
    {
        if ($id == false) {

            $data = $this->findAll();
            return $data;
        }
        return $this->where(['id_merek' => $id])->first();
    }
}
