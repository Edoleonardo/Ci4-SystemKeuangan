<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKadar extends Model
{

    protected $table = 'tbl_kadar';
    protected $primaryKey = 'id_kadar';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode', 'qty', 'jenis', 'model', 'keterangan', 'berat', 'harga_beli', 'kadar', 'nilai_tukar', 'merek', 'total_harga'];

    public function getKadar($id = false)
    {
        if ($id == false) {

            $data = $this->findAll();
            return $data;
        }
        return $this->where(['id_kadar' => $id])->first();
    }
}
