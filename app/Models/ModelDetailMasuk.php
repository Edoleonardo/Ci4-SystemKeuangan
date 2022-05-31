<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDetailMasuk extends Model
{

    protected $table = 'tbl_detail_pembelian';
    protected $primaryKey = 'id_detail_pembelian';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_date_pembelian', 'id_karyawan', 'nama_img', 'kode', 'jenis', 'qty', 'model', 'keterangan', 'berat', 'carat', 'berat_murni', 'harga_beli', 'kadar', 'ongkos', 'nilai_tukar', 'merek', 'total_harga'];

    public function getDetailAll($id)
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
        $this->Where(['id_date_pembelian' => $id]);
        $this->orderBy('created_at', 'DESC');
        $query = $this->get();
        return $query->getResult('array');
    }
    public function getDetailone($id)
    {
        return $this->where(['id_detail_pembelian' => $id])->first();
    }
    public function getDetailKode($id)
    {
        return $this->where(['kode' => $id])->first();
    }
    public function SumDataDetail($id)
    {
        $this->selectSum('total_harga');
        $this->where('id_date_pembelian', $id);
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    public function SumDataDetailOngkos($id)
    {
        $this->selectSum('ongkos');
        $this->where('id_date_pembelian', $id);
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    public function SumBeratDetail($id)
    {
        $this->selectSum('berat');
        $this->where('id_date_pembelian', $id);
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    public function SumCaratDetail($id)
    {
        $this->selectSum('carat');
        $this->where('id_date_pembelian', $id);
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    public function SumBeratMurniDetail($id)
    {
        $this->selectSum('berat_murni');
        $this->where('id_date_pembelian', $id);
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    public function SumQty($id)
    {
        $this->selectSum('qty');
        $this->where('id_date_pembelian', $id);
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    public function GetJumlahData($id)
    {
        $db = db_connect();
        $data = $db->query('SELECT count(id_date_pembelian) as jml FROM `tbl_detail_pembelian` WHERE id_date_pembelian = ' . $id . ';');
        return $data->getResult('array')[0];
        //  $this->get();
        // return $query;
    }
    public function GetDataTotalBerat($id)
    {
        $db = db_connect();
        $data = $db->query('SELECT CASE WHEN substr(kode,1,1) = 3 THEN sum(berat * qty) ELSE sum(berat) END as berat FROM `tbl_detail_pembelian` WHERE id_date_pembelian = ' . $id . ';');
        return $data->getResult('array')[0];
        //  $this->get();
        // return $query;
    }
    public function getKode($id)
    {
        $db = db_connect();
        $data = $db->query('select max(substr(kode,2,7)) kode from tbl_detail_pembelian where substr(kode,1,1) = ' . $id . ' limit 1');
        return $data->getResult('array')[0];
        //  $this->get();
        // return $query;
    }
}
