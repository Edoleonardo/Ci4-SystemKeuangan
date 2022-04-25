<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelStockOpname extends Model
{

    protected $table = 'tbl_stock_opname';
    protected $primaryKey = 'id_stock_1_opname ';
    protected $useTimestamps = true;
    protected $allowedFields = ['barcode', 'id_karyawan', 'status', 'no_faktur', 'tgl_faktur', 'nama_supplier', 'qty', 'jenis', 'model', 'keterangan', 'merek', 'kadar', 'berat_murni', 'berat', 'nilai_tukar', 'ongkos', 'harga_beli', 'total_harga', 'gambar'];

    public function getBarang($id = false)
    {
        if ($id == false) {
            $this->findAll();
            $this->orderBy('created_at', 'DESC');
            $data = $this->get();
            return $data->getResult('array');
        }
        return $this->where(['id_stock_1_opname' => $id])->first();
    }
    public function CountDataOpname()
    {
        $this->selectCount('barcode');
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    public function getBarcodeData($id)
    {
        return $this->where(['barcode' => $id])->first();
    }
}
