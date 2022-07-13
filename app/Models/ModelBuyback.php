<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBuyback extends Model
{

    protected $table = 'tbl_buyback';
    protected $primaryKey = 'id_buyback';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_date_buyback', 'no_transaksi_buyback', 'id_karyawan', 'nohp_cust', 'total_berat', 'kelompok', 'jumlah', 'nama_bank', 'total_harga', 'total_harga', 'pembayaran', 'tunai', 'transfer', 'status_dokumen', 'tgl_selesai', 'created_at', 'updated_at'];

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
        $data = $db->query('select max(substr(no_transaksi_buyback,3,10)) no_transaksi_buyback from tbl_buyback where substr(no_transaksi_buyback,1,2) = "B-" limit 1');
        return $data->getResult('array')[0];
    }
    public function DataFilterBuyback($lim, $kel, $stat, $notrans)
    {
        $db = db_connect();
        if ($kel == 'semua') {
            $kel1 = '1 = 1';
        } else {
            $kel1 = 'kelompok = ' . $kel;
        }
        if ($lim == 'semua') {
            $lim1 = '';
        } else {
            $lim1  = 'Limit ' . $lim;
        }
        if ($stat == 'semua') {
            $stat1 = '1 = 1';
        } else {
            $stat1  = 'pembayaran = ' . '"' . $stat . '"';
        }
        if ($notrans) {
            $notrans1  = 'no_transaksi_buyback = ' . '"' . $notrans . '"';
        } else {
            $notrans1 = '1 = 1';
        }
        $data = $db->query('select * from tbl_buyback where ' . $kel1 . ' and ' . $stat1 . ' and ' . $notrans1 . ' order by created_at DESC ' . $lim1 . ' ');
        return $data->getResult('array');
    }
}
