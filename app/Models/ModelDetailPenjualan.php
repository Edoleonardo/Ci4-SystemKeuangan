<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDetailPenjualan extends Model
{

    protected $table = 'tbl_detail_penjualan';
    protected $primaryKey = 'id_detail_penjualan';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_date_penjualan', 'id_karyawan', 'nama_img', 'kode', 'jenis', 'qty', 'saldo', 'model', 'keterangan', 'berat_murni', 'berat', 'harga_beli', 'ongkos', 'kadar', 'nilai_tukar', 'merek', 'total_harga'];

    public function getDetailAllJual($id)
    {
        // if ($id == false) {
        //     // $query =  $this->db->table('tbl_img')
        //     //     ->select('*')
        //     //     ->get();
        //     // $data[0] = $query;
        //     $data = $this->findAll();
        //     return $data;
        //     //return $this->findAll();
        // }
        //$query = $this->select('(SELECT * FROM tbl_detail_pembelian WHERE id_date_pembelian = ' . $id . ')');
        $query = $this->getWhere(['id_date_penjualan' => $id]);
        return $query->getResult('array');
    }
    // public function getDetailJual($id)
    // {
    //     $query = $this->getWhere(['id_detail_penjualan' => $id]);
    //     return $query->getResult('array');
    // }
    public function getDetailoneJual($id)
    {
        return $this->where(['id_detail_penjualan' => $id])->first();
    }
    public function getDetailCheckJual($kode, $id)
    {
        $db = db_connect();
        $data = $db->query("SELECT * FROM `tbl_detail_penjualan` INNER JOIN tbl_penjualan on tbl_penjualan.id_date_penjualan = tbl_detail_penjualan.id_date_penjualan where status_dokumen = 'Draft' AND kode = " . $kode . ";");
        return $data->getResult('array');
    }
    public function getDetailDeleteJual($notrans, $kode)
    {
        $db = db_connect();
        $data = $db->query("SELECT * FROM `tbl_detail_penjualan` INNER JOIN tbl_penjualan on tbl_penjualan.id_date_penjualan = tbl_detail_penjualan.id_date_penjualan where status_dokumen = 'Draft' AND kode = " . $kode . ";");
        return $data->getResult('array');
    }
    public function SumBeratKotorDetailjual($id)
    {
        $this->selectSum('berat');
        $this->where('id_date_penjualan', $id);
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    public function SumBeratBersihDetailjual($id)
    {
        $this->selectSum('berat_murni');
        $this->where('id_date_penjualan', $id);
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    public function SumDataDetailJual($id)
    {
        $this->selectSum('total_harga');
        $this->where('id_date_penjualan', $id);
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    public function SumDataDetailBeliJual($id)
    {
        $this->selectSum('harga_beli');
        $this->where('id_date_penjualan', $id);
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    public function SumDataOngkosJual($id)
    {
        $this->selectSum('ongkos');
        $this->where('id_date_penjualan', $id);
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    public function SumBeratDetailJual($id)
    {
        $this->selectSum('berat');
        $this->where('id_date_penjualan', $id);
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    public function JumlahData($id)
    {
        $db = db_connect();
        $data = $db->query('SELECT count(*) as jumlah FROM tbl_detail_penjualan where id_date_penjualan = ' . $id . ';');
        return $data->getResult('array')[0];
    }
    // public function getKodeJual($id)
    // {
    //     $db = db_connect();
    //     $data = $db->query('select max(substr(kode,2,7)) kode from tbl_detail_pembelian where substr(kode,1,1) = ' . $id . ' limit 1');
    //     return $data->getResult('array')[0];
    //     //  $this->get();
    //     // return $query;
    // }
}
