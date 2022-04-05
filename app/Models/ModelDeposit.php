<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDeposit extends Model
{

    protected $table = 'tbl_deposit';
    protected $primaryKey = 'id_deposit';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_karyawan', 'no_transaksi', 'no_retur', 'id_supplier', 'masuk', 'keluar'];

    public function getdeposit($id = false)
    {
        if ($id == false) {
            $data = $this->findAll();
            return $data;
        }
        return $this->where(['id_deposit' => $id])->first();
    }
    public function getDataDeleteDepo($trans, $retur)
    {
        $this->select('*');
        $this->where(['no_retur' => $retur]);
        $this->where(['no_transaksi' => $trans]);
        $query = $this->get();
        return $query->getResult('array')[0];
    }
}
