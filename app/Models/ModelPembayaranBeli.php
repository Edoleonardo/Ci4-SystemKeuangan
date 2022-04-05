<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPembayaranBeli extends Model
{

    protected $table = 'tbl_pembayaran_pembelian';
    protected $primaryKey = 'id_pembayaran';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_pembayaran', 'id_karyawan', 'id_date_pembelian', 'nama_bank', 'qty', 'jumlah_pembayaran', 'cara_pembayaran', 'no_retur', 'kode_24k', 'berat_murni', 'harga_murni', 'updated_at', 'created_at'];

    public function getPembayaran($id = false)
    {
        if ($id == false) {

            $data = $this->findAll();
            return $data;
        }
        $this->where(['id_date_pembelian' => $id]);
        $this->orderBy('created_at', 'DESC');
        $data = $this->get();
        return $data->getResult('array');
    }

    public function getCheckKode24k($id)
    {
        return $this->where(['kode_24k' => $id])->first();
    }

    public function getCheckNoRetur($id)
    {
        return $this->where(['no_retur' => $id])->first();
    }

    public function getDetailPembayaran($id)
    {
        return $this->where(['id_pembayaran' => $id])->first();
    }
}
