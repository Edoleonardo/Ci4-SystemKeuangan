<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDetailMasuk extends Model
{

    protected $table = 'tbl_detail_pembelian';
    protected $primaryKey = 'id_detail_pembelian';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_date_pembelian', 'nama_img', 'kode', 'jenis', 'qty', 'model', 'keterangan', 'berat_bersih', 'berat_kotor', 'harga_beli', 'kadar', 'nilai_tukar', 'merek', 'total_harga'];

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
        $query = $this->getWhere(['id_date_pembelian' => $id]);
        return $query->getResult('array');
    }
    public function getDetailone($id)
    {
        return $this->where(['id_detail_pembelian' => $id])->first();
    }
    public function SumDataDetail($id)
    {
        $this->selectSum('total_harga');
        $this->where('id_date_pembelian', $id);
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    public function SumBeratKotorDetail($id)
    {
        $this->selectSum('berat_kotor');
        $this->where('id_date_pembelian', $id);
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    public function SumBeratBersihDetail($id)
    {
        $this->selectSum('berat_bersih');
        $this->where('id_date_pembelian', $id);
        $query = $this->get();
        return $query->getResult('array')[0];
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
