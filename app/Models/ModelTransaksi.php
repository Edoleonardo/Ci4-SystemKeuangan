<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTransaksi extends Model
{

    protected $table = 'tbl_transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_karyawan', 'total_masuk_tunai', 'total_keluar_tunai', 'total_akhir_tunai', 'total_masuk_transfer', 'total_keluar_transfer', 'total_akhir_transfer', 'total_masuk_debitcc', 'total_keluar_debitcc', 'total_akhir_debitcc', 'total_keluar', 'total_masuk', 'saldo_akhir'];

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
