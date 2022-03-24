<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelReturSales extends Model
{

    protected $table = 'tbl_retur_sales';
    protected $primaryKey = 'id_retur';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_date_pembelian', 'id_karyawan', 'nama_img', 'kode', 'jenis', 'qty', 'model', 'keterangan', 'berat', 'berat_murni', 'harga_beli', 'kadar', 'ongkos', 'nilai_tukar', 'merek', 'total_harga', 'status_proses'];

    public function getPembayaran($id = false)
    {
        if ($id == false) {

            $data = $this->findAll();
            return $data;
        }
        return $this->where(['id_pembayaran ' => $id])->first();
    }
    public function getDataRetur()
    {
        $query = $this->getWhere(['status_proses' => 'Pending']);
        return $query->getResult('array');
    }
    public function getDetailRetur($id)
    {
        return $this->where(['kode' => $id])->first();
    }
}
