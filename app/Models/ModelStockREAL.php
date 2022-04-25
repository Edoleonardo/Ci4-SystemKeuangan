<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelStockREAL extends Model
{

    protected $table = '220331_stock';
    protected $primaryKey = 'id_stock_1real';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_date_cuci', 'pembayaran', 'nama_bank', 'id_karyawan', 'nama_tukang', 'no_cuci', 'keterangan', 'total_berat', 'jumlah_barang', 'tanggal_cuci', 'status_dokumen', 'harga_cuci', 'status_proses'];

    public function DataStockReal($id = false)
    {
        if ($id == false) {
            $this->findAll();
            $data = $this->get();
            return $data->getResult('array');
        }
        return $this->where(['id_date_cuci' => $id])->first();
    }
    public function getBarangkode($id)
    {
        return $this->where(['barcode' => $id])->first();
    }
    public function getNoCuci($id)
    {
        return $this->where(['no_cuci' => $id])->first();
    }
    public function GetJenisStockReal()
    {
        $db = db_connect();
        $data = $db->query('SELECT Merk FROM 220331_stock GROUP BY Merk HAVING COUNT(Merk) > 1;');
        return $data->getResult('array');
    }
}
