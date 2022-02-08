<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPembelian extends Model
{

    protected $table = 'tbl_pembelian';
    protected $primaryKey = 'id_pembelian';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_date_pembelian', 'nama_supplier', 'no_faktur_supp', 'no_transaksi', 'id_karyawan', 'tgl_faktur', 'harga_emas_24k', 'total_berat_murni', 'tgl_jatuh_tempo', 'cara_pembayaran', 'nama_bank', 'tunai', 'debitcc', 'transfer', 'charge', 'tanggal_bayar', 'pembulatan', 'total_bayar', 'status_dokumen'];

    public function getPembelianSupplier($id = false)
    {
        if ($id == false) {

            $data = $this->findAll();
            return $data;
        }
        return $this->where(['id_date_pembelian' => $id])->first();
    }
    public function getNoTrans()
    {
        $db = db_connect();
        $data = $db->query('select max(substr(no_transaksi,3,10)) no_transaksi from tbl_pembelian limit 1');
        return $data->getResult('array')[0];
    }
}
