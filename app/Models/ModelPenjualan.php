<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPenjualan extends Model
{

    protected $table = 'tbl_penjualan';
    protected $primaryKey = 'id_penjualan';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_date_penjualan', 'no_transaksi_jual', 'id_karyawan', 'nohp_cust', 'jumlah', 'nama_bank', 'pembulatan', 'total_harga', 'pembayaran', 'pembayaran_retur', 'charge', 'tunai', 'debitcc', 'transfer', 'status_dokumen'];

    public function getDataPenjualan($id = false)
    {
        if ($id == false) {
            $this->findAll();
            $this->orderBy('created_at', 'DESC');
            $data = $this->get();
            return $data->getResult('array');
        }
        return $this->where(['id_date_penjualan' => $id])->first();
    }
    public function getDataNoTrans($id)
    {
        return $this->where(['no_transaksi_jual' => $id])->first();
    }
    public function getNoTransJual()
    {
        $this->selectMax('no_transaksi_jual');
        $query = $this->get();
        return $query->getResult('array');
    }

    public function getNoTrans()
    {
        $db = db_connect();
        $data = $db->query('select max(substr(no_transaksi_jual,3,10)) no_transaksi_jual from tbl_penjualan where substr(no_transaksi_jual,1,2) = "S-" limit 1');
        return $data->getResult('array')[0];
    }
}
