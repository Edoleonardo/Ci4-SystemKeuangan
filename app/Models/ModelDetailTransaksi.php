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
    public function getDetailTransaksiFilter($dari, $sampai)
    {
        $db = db_connect();
        $data = $db->query('select * from tbl_detail_transaksi join tbl_akun_biaya on tbl_akun_biaya.id_akun_biaya = tbl_detail_transaksi.id_akun_biaya where SUBSTR(tbl_detail_transaksi.tanggal_transaksi,1,10) <= "' . $dari  . '" and SUBSTR(tbl_detail_transaksi.tanggal_transaksi,1,10) >= "' .  $sampai   . '" order by tanggal_transaksi DESC');
        return $data->getResult('array');
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
    //----------------------------tunai

    public function SumTotalMasukTunai()
    {
        $this->selectSum('masuk');
        $this->where(['pembayaran' => 'Tunai']);
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    public function SumTotalKeluarTunai()
    {
        $this->selectSum('keluar');
        $this->where(['pembayaran' => 'Tunai']);
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    //----------------------------transfer

    public function SumTotalMasukTransfer()
    {
        $this->selectSum('masuk');
        $this->where(['pembayaran' => 'Transfer']);
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    public function SumTotalKeluarTransfer()
    {
        $this->selectSum('keluar');
        $this->where(['pembayaran' => 'Transfer']);
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    //----------------------------debitcc
    public function SumTotalMasukDebitcc()
    {
        $this->selectSum('masuk');
        $this->where(['pembayaran' => 'Debitcc']);
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    public function SumTotalKeluarDebitcc()
    {
        $this->selectSum('keluar');
        $this->where(['pembayaran' => 'Debitcc']);
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
    //---------------------------------delete transaksi
    public function DeleteTransaksi($notrans) //delete semua data transaksi
    {
        $db = db_connect();
        $data = $db->query('DELETE FROM tbl_detail_transaksi WHERE keterangan = "' . $notrans . '"');
        return true;
    }
}
