<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBuyback extends Model
{

    protected $table = 'tbl_buyback';
    protected $primaryKey = 'id_buyback';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_date_buyback', 'no_transaksi_buyback', 'id_karyawan', 'total_berat', 'jumlah', 'nama_bank', 'total_harga', 'total_harga', 'pembayaran', 'tunai', 'transfer', 'status_dokumen'];

    public function getDataBuyback($id = false)
    {
        if ($id == false) {
            // $query =  $this->db->table('tbl_img')
            //     ->select('*')
            //     ->get();
            // $data[0] = $query;
            $this->findAll();
            $this->orderBy('created_at', 'DESC');
            $data = $this->get();
            return $data->getResult('array');
            //return $this->findAll();
        }
        return $this->where(['id_date_buyback' => $id])->first();
    }
    public function getDataNoTrans($id)
    {
        return $this->where(['no_transaksi_buyback' => $id])->first();
    }
    public function getNoTransBuyback()
    {
        $this->selectMax('no_transaksi_buyback');
        $query = $this->get();
        return $query->getResult('array');
    }

    public function getNoTrans()
    {
        $db = db_connect();
        $data = $db->query('select max(substr(no_transaksi_buyback,3,10)) no_transaksi_buyback from tbl_buyback limit 1');
        return $data->getResult('array')[0];
    }
}
