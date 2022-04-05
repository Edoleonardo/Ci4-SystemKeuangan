<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDetailTransaksi extends Model
{

    protected $table = 'tbl_detail_transaksi';
    protected $primaryKey = 'id_detail_transaksi';
    protected $useTimestamps = true;
    protected $allowedFields = ['tanggal_transaksi', 'pembayaran', 'nama_bank', 'keterangan', 'id_akun_biaya', 'masuk', 'keluar'];

    public function getDetailTransaksi($id = false)
    {
        if ($id == false) {
            $this->select('*');
            $this->join('tbl_akun_biaya', 'tbl_akun_biaya.id_akun_biaya = tbl_detail_transaksi.id_akun_biaya');
            $this->orderBy('tanggal_transaksi', 'DESC');
            // $this->orderBy('pembayaran', 'ASC');
            $query = $this->get();
            return  $query->getResult('array');
        }
        return $this->where(['id_detail_transaksi' => $id])->first();
    }
    public function SumTotalKeluar()
    {
        $this->selectSum('keluar');
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    public function SumTotalMasuk()
    {
        $this->selectSum('masuk');
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    public function getDataDeleteTrans($faktur, $method)
    {
        $this->selectSum('id_detail_transaksi');
        $this->where(['keterangan' => $faktur]);
        $this->where(['pembayaran' => $method]);
        $query = $this->get();
        return $query->getResult('array')[0];
    }
}
