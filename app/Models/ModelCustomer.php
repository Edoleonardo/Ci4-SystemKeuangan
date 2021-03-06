<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelCustomer extends Model
{

    protected $table = 'tbl_customer';
    protected $primaryKey = 'id_customer';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'id_karyawan', 'nohp_cust', 'alamat_cust', 'kota_cust', 'sales_cust', 'no_rekening', 'bank', 'point'];

    public function getDataCustomer($id = false)
    {
        if ($id == false) {

            $data = $this->findAll();
            return $data;
        }
        return $this->where(['id_customer' => $id])->first();
    }
    public function getDataCustomerone($id)
    {
        return $this->where(['nohp_cust' => $id])->first();
    }
}
