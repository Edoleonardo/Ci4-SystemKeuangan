<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelRetur extends Model
{

    protected $table = 'tbl_retur';
    protected $primaryKey = 'id_retur';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_date_retur', 'id_karyawan', 'keterangan', 'no_retur', 'total_berat_murni', 'total_berat', 'jumlah_barang', 'tanggal_retur', 'no_transaksi', 'status_dokumen'];

    public function getDataReturAll($id = false)
    {
        if ($id == false) {
            $this->findAll();
            $this->orderBy('created_at', 'DESC');
            $data = $this->get();
            return $data->getResult('array');
        }
        return $this->where(['id_date_retur' => $id])->first();
    }
    public function GetDataJoinRetur($id)
    {
        $this->select('tbl_retur.id_retur,tbl_retur.id_date_retur, tbl_retur.id_karyawan, tbl_retur.keterangan, tbl_retur.no_retur, tbl_retur.total_berat_murni, tbl_retur.total_berat, tbl_retur.jumlah_barang, tbl_retur.tanggal_retur, tbl_retur.no_transaksi, tbl_retur.status_dokumen,tbl_pembelian.id_date_pembelian,tbl_pembelian.id_pembelian, tbl_pembelian.id_supplier, tbl_pembelian.no_faktur_supp, tbl_pembelian.tgl_faktur , tbl_pembelian.tgl_jatuh_tempo, tbl_pembelian.byr_barang, tbl_pembelian.total_berat_rill, tbl_pembelian.berat_murni_rill, tbl_pembelian.total_qty,tbl_pembelian.harga_murni,tbl_pembelian.total_berat_murni murnibeli');
        $this->join('tbl_pembelian', 'tbl_pembelian.no_transaksi = tbl_retur.no_transaksi');
        $this->where(['id_date_retur' => $id]);
        $this->orderBy('tbl_retur.created_at', 'DESC');
        $data = $this->get();
        return $data->getResult('array')[0];
    }
    public function GetDataNoRetur($id)
    {
        $this->select('tbl_retur.id_retur,tbl_retur.id_date_retur, tbl_retur.id_karyawan, tbl_retur.keterangan, tbl_retur.no_retur, tbl_retur.total_berat_murni, tbl_retur.total_berat, tbl_retur.jumlah_barang, tbl_retur.tanggal_retur, tbl_retur.no_transaksi, tbl_retur.status_dokumen,tbl_pembelian.id_date_pembelian,tbl_pembelian.id_pembelian, tbl_pembelian.id_supplier, tbl_pembelian.no_faktur_supp, tbl_pembelian.tgl_faktur , tbl_pembelian.tgl_jatuh_tempo, tbl_pembelian.byr_barang, tbl_pembelian.total_berat_rill, tbl_pembelian.berat_murni_rill, tbl_pembelian.total_qty');
        $this->join('tbl_pembelian', 'tbl_pembelian.no_transaksi = tbl_retur.no_transaksi');
        $this->where(['no_retur' => $id]);
        $this->orderBy('tbl_retur.created_at', 'DESC');
        $data = $this->get();
        return $data->getResult('array')[0];
    }
    public function getDataReturBayar($id = false)
    {
        if ($id == false) {
            $this->select('*');
            $this->where(['status_dokumen' => 'Selesai']);
            $this->where(['no_transaksi' => null]);
            $this->orderBy('created_at', 'DESC');
            $data = $this->get();
            return $data->getResult('array');
        }
        return $this->where(['id_date_retur' => $id])->first();
    }
    public function getBarangkode($id)
    {
        return $this->where(['barcode' => $id])->first();
    }
    public function getBarangNomor($id)
    {
        return $this->where(['no_retur' => $id])->first();
    }
    public function getNoTransRetur()
    {
        $db = db_connect();
        $data = $db->query('select max(substr(no_retur,3,10)) no_retur from tbl_retur where substr(no_retur,1,2) = "R-" limit 1');
        return $data->getResult('array')[0];
    }

    public function DataFilterRetur($lim, $kel, $stat, $notrans)
    {
        $db = db_connect();
        if ($lim == 'semua') {
            $lim1 = '';
        } else {
            $lim1  = 'Limit ' . $lim;
        }
        if ($notrans) {
            $notrans1  = 'no_retur = ' . '"' . $notrans . '"';
        } else {
            $notrans1 = '1 = 1';
        }
        $data = $db->query('select * from tbl_retur where ' . $notrans1 . ' order by created_at DESC ' . $lim1 . ' ');
        return $data->getResult('array');
    }
}
