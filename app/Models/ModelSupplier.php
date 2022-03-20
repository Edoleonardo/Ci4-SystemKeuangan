<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSupplier extends Model
{

    protected $table = 'tbl_supplier';
    protected $primaryKey = 'id_supplier';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_supp', 'alamat_supp', 'kota_supp', 'sales_supp', 'no_hp', 'no_ktr'];

    public function getSupplier($id = false)
    {
        if ($id == false) {

            $data = $this->findAll();
            return $data;
        }
        return $this->where(['id_supplier' => $id])->first();
    }
}
