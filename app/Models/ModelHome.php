<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelHome extends Model
{

    protected $table = 'tbl_stock';
    protected $primaryKey = 'id_stock';
    protected $useTimestamps = true;
    protected $allowedFields = ['barcode', 'id_karyawan', 'status', 'no_faktur', 'tgl_faktur', 'nama_supplier', 'qty', 'jenis', 'model', 'keterangan', 'merek', 'kadar', 'berat_murni', 'berat', 'nilai_tukar', 'ongkos', 'harga_beli', 'total_harga', 'kode_beli', 'gambar'];

    public function getBarang($id = false)
    {
        if ($id == false) {

            // $this->findAll();
            // $this->orderBy('created_at', 'DESC');
            // // $this->limit(10);
            // $data = $this->get();
            // return $data->getResult('array');

            $db = db_connect();
            $data = $db->query('select * from tbl_stock order by created_at DESC limit 10');
            return $data->getResult('array');
        }
        return $this->where(['id_stock' => $id])->first();
    }

    public function getBarangFilter($id, $stock)
    {
        $db = db_connect();
        if ($stock == 0) {
            $data = $db->query('select * from tbl_stock where substr(barcode,1,1) = ' . $id . ' order by created_at DESC');
        }
        if ($stock == 1) {
            $data = $db->query('select * from tbl_stock where substr(barcode,1,1) = ' . $id . ' AND qty > 0 order by created_at DESC');
        }
        if ($stock == 2) {
            $data = $db->query('select * from tbl_stock where substr(barcode,1,1) = ' . $id . '  AND qty = 0  order by created_at DESC');
        }
        return $data->getResult('array');
    }
    public function getBarangkode($id)
    {
        return $this->where(['barcode' => $id])->first();
    }
    public function getBarcode($id)
    {
        $db = db_connect();
        $data = $db->query('select * from tbl_stock where substr(barcode,1,1) = ' . $id . ' order by created_at DESC limit 10');
        return $data->getResult('array');
    }
    public function CheckData($id)
    {
        $db = db_connect();
        $data = $db->query('select * from tbl_stock where barcode = ' . $id . ' and substr(barcode,1,1) = 4 ');
        // return $this->where(['barcode' => $id])->first();
        // $db = db_connect();
        // $data = $db->query('select * from tbl_stock where substr(barcode,1,1) = 4 AND barcode = ' . $id . ' ');
        // $data = $this->get();
        if ($data->getResult('array')) {
            $data = $data->getResult('array')[0];
        } else {
            $data = $data->getResult('array');
        }
        return $data;
    }
    public function getKodeStock($id)
    {
        $db = db_connect();
        $data = $db->query('select max(substr(barcode,2,7)) kode from tbl_stock where substr(barcode,1,1) = ' . $id . ' limit 1');
        return $data->getResult('array')[0];
        //  $this->get();
        // return $query;
    }
    public function getKodeBahan24k()
    {
        $db = db_connect();
        $data = $db->query('select * from tbl_stock where substr(barcode,1,1) = 4 ');
        return $data->getResult('array');
        //  $this->get();
        // return $query;
    }
    public function returdelete($id)
    {
        $db = db_connect();
        $data = $db->query('DELETE FROM tbl_stock WHERE barcode = ' . $id . '');
        return 0;
        //  $this->get();
        // return $query;
    }
}
