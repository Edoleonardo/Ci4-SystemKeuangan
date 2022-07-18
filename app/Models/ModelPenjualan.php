<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;


class ModelPenjualan extends Model
{

    protected $table = 'tbl_penjualan';
    protected $primaryKey = 'id_penjualan';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_date_penjualan', 'no_transaksi_jual', 'id_karyawan', 'kelompok', 'nohp_cust', 'jumlah', 'bank_transfer', 'bank_debitcc', 'pembulatan', 'total_harga', 'pembayaran', 'pembayaran_retur', 'charge', 'tunai', 'debitcc', 'transfer', 'status_dokumen', 'created_at', 'updated_at'];

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
    public function DataFilterPenjualan($lim, $kel, $stat, $notrans)
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
            $notrans1  = 'no_transaksi_jual like ' . '"%' . $notrans . '%"';
        } else {
            $notrans1 = '1 = 1';
        }
        $data = $db->query('select * from tbl_penjualan where ' . $kel1 . ' and ' . $stat1 . ' and ' . $notrans1 . ' order by created_at DESC ' . $lim1 . ' ');
        return $data->getResult('array');
    }
    public function CountDataStock()
    {
        $this->selectCount('no_transaksi_jual');
        $query = $this->get();
        return $query->getResult('array')[0];
    }

    public function updatetanggal($id, $date)
    {
        $db = db_connect();
        $date = Time::createFromFormat('Y-m-d H:i:s', $date);

        $data = $db->query('UPDATE tbl_penjualan set created_at = "' . $date . '", updated_at = "' . $date . '" WHERE no_transaksi_jual = "' . $id . '"');
        $data = $db->query('UPDATE tbl_detail_transaksi set tanggal_transaksi = "' . $date . '", created_at = "' . $date . '", updated_at = "' . $date . '" WHERE keterangan = "' . $id . '"');
        $data = $db->query('UPDATE tbl_detail_kartustock set created_at = "' . $date . '", updated_at = "' . $date . '" WHERE no_faktur = "' . $id . '"');
        return 1;
    }
}
