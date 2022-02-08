<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSupplier extends Model
{

    protected $table = 'tbl_supplier';
    protected $primaryKey = 'id_supplier';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode', 'qty', 'jenis', 'model', 'keterangan', 'berat', 'harga_beli', 'kadar', 'nilai_tukar', 'merek', 'total_harga'];

    public function getSupplier($id = false)
    {
        if ($id == false) {

            $data = $this->findAll();
            return $data;
        }
        return $this->where(['id_merek' => $id])->first();
    }
}
