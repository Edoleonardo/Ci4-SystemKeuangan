<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBarangMasuk extends Model
{

    protected $table = 'tbl_pembelian';
    protected $primaryKey = 'id_barang';
    //protected $useTimestamps = true;
    protected $allowedFields = ['id_img', 'id_karyawan', 'barcode', 'nama_barang', 'nama_gbr', 'jenis_barang', 'berat_barang', 'stock_barang', 'harga_barang'];

    public function getBarang($id = false)
    {
        if ($id == false) {
            // $query =  $this->db->table('tbl_img')
            //     ->select('*')
            //     ->get();
            // $data[0] = $query;
            $data = $this->findAll();
            return $data;
            //return $this->findAll();
        }
        return $this->where(['id_stock' => $id])->first();
    }
    // public function getImg($id)
    // {
    //     return $this->where(['id_img' => $id])->first();
    // }
    // public function getKomikid($id = false)
    // {
    //     if ($id == false) {
    //         return $this->findAll();
    //     }

    //     return $this->where(['id' => $id])->first();
    // }
}
