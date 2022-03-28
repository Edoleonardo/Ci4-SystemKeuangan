<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTransaksi extends Model
{

    protected $table = 'tbl_transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_karyawan', 'total_keluar', 'total_masuk', 'saldo_akhir'];

    public function getTransaksi($id = false)
    {
        if ($id == false) {
            $this->findAll();
            $data = $this->get();
            return $data->getResult('array')[0];
        }
        return $this->where(['id_transaksi' => $id])->first();
    }
}
