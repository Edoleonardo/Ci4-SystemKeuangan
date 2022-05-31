<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPembelian extends Model
{

    protected $table = 'tbl_pembelian';
    protected $primaryKey = 'id_pembelian';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_date_pembelian', 'id_supplier', 'kelompok', 'no_faktur_supp', 'no_transaksi', 'id_karyawan', 'tgl_faktur', 'total_berat_murni', 'tgl_jatuh_tempo', 'cara_pembayaran', 'byr_barang', 'total_berat_rill', 'berat_murni_rill', 'total_carat_rill', 'total_qty', 'tanggal_bayar', 'harga_murni', 'total_bayar', 'status_dokumen'];

    public function getPembelianSupplier($id = false)
    {
        if ($id == false) {
            $this->findAll();
            $this->orderBy('created_at', 'DESC');
            $data = $this->get();
            return $data->getResult('array');
        }
        return $this->where(['id_date_pembelian' => $id])->first();
    }
    public function DataFilterPembelian($lim, $kel, $stat, $notrans)
    {
        $db = db_connect();
        if ($kel == 'semua') {
            $kel1 = '1 = 1';
        } else {
            $kel1 = 'kelompok =' . $kel;
        }
        if ($lim == 'semua') {
            $lim1 = '';
        } else {
            $lim1  = 'Limit ' . $lim;
        }
        if ($stat == 'semua') {
            $stat1 = '1 = 1';
        } else {
            $stat1  = 'cara_pembayaran = ' . '"' . $stat . '"';
        }
        if ($notrans) {
            $notrans1  = 'no_transaksi = ' . '"' . $notrans . '"';
        } else {
            $notrans1 = '1 = 1';
        }


        $data = $db->query('select * from tbl_pembelian where ' . $kel1 . ' and ' . $stat1 . ' and ' . $notrans1 . ' order by created_at DESC ' . $lim1 . ' ');
        return $data->getResult('array');
    }
    public function GetNotransPindah($id) //pindah data
    {
        return $this->where(['no_transaksi' => $id])->first();
    }
    public function getPembelian($id)
    {
        $this->select('no_transaksi');
        $this->where(['id_pembelian' => $id]);
        $data = $this->get();
        return $data->getResult('array')[0];
    }
    public function GetDataNotrans($id)
    {
        $this->select('*');
        $this->join('tbl_supplier', 'tbl_supplier.id_supplier = tbl_pembelian.id_supplier');
        $this->where(['no_transaksi' => $id]);
        $this->orderBy('tbl_pembelian.created_at', 'DESC');
        $data = $this->get();
        if ($data->getResult('array')) {
            return $data->getResult('array')[0];
        } else {
            return $data->getResult('array');
        }
    }
    public function getPembelianSupplierJoin($id)
    {
        $this->select('*');
        $this->join('tbl_supplier', 'tbl_supplier.id_supplier = tbl_pembelian.id_supplier');
        $this->where(['id_date_pembelian' => $id]);
        $this->orderBy('tbl_pembelian.created_at', 'DESC');
        $data = $this->get();
        return $data->getResult('array')[0];
    }
    public function getPembelianRetur($id)
    {
        $this->select('*');
        $this->join('tbl_supplier', 'tbl_supplier.id_supplier = tbl_pembelian.id_supplier');
        $this->where(['no_transaksi' => $id]);
        $this->orderBy('tbl_pembelian.created_at', 'DESC');
        $data = $this->get();
        return $data->getResult('array')[0];
    }
    public function getPembelianTotalRetur()
    {
        $db = db_connect();
        $data = $db->query('select * from tbl_pembelian join tbl_supplier on tbl_supplier.id_supplier = tbl_pembelian.id_supplier where tbl_pembelian.status_dokumen = "Selesai" AND (tbl_pembelian.cara_pembayaran = "Bayar Nanti" OR tbl_pembelian.cara_pembayaran ="Belum Selesai") AND kelompok = 1 order by tbl_pembelian.created_at DESC;');
        return $data->getResult('array');
    }
    public function getNoTrans()
    {
        $db = db_connect();
        $data = $db->query('select max(substr(no_transaksi,3,10)) no_transaksi from tbl_pembelian where substr(no_transaksi,1,2) = "M-" limit 1');
        return $data->getResult('array')[0];
    }
}
