<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSupplier extends Model
{

    protected $table = 'tbl_supplier';
    protected $primaryKey = 'id_supplier';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_supp', 'id_karyawan', 'inisial', 'alamat_supp', 'kota_supp', 'sales_supp', 'no_hp', 'no_ktr'];

    public function getSupplier($id = false)
    {
        if ($id == false) {
            $this->findAll();
            $this->orderBy('nama_supp', 'ASC');
            $data = $this->get();
            return $data->getResult('array');
        }
        return $this->where(['id_supplier' => $id])->first();
    }
    public function getSupplierNama($id = false)
    {
        return $this->where(['nama_supp' => $id])->first();
    }
}
