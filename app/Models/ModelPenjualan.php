<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPenjualan extends Model
{

    protected $table = 'tbl_penjualan';
    protected $primaryKey = 'id_penjualan';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_date_penjualan', 'no_transaksi_jual', 'id_customer', 'id_karyawan', 'nama_customer', 'jumlah', 'ongkos', 'nama_bank', 'pembulatan', 'total_harga', 'pembayaran', 'charge', 'tunai', 'debitcc', 'transfer', 'status_dokumen'];

    public function getDataPenjualan($id = false)
    {
        if ($id == false) {
            // $query =  $this->db->table('tbl_img')
            //     ->select('*')
            //     ->get();
            // $data[0] = $query;
            $data = $this->findAll();
            return $data;
            //return $this->findAll();
        }
        return $this->where(['id_date_penjualan' => $id])->first();
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
        $data = $db->query('select max(substr(no_transaksi_jual,3,10)) no_transaksi_jual from tbl_penjualan limit 1');
        return $data->getResult('array')[0];
    }
}
