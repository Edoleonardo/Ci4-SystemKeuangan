<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPembelianREAL extends Model
{

    protected $table = '220331_pembelian';
    protected $primaryKey = 'id_pembelianreal';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_date_cuci', 'pembayaran', 'nama_bank', 'id_karyawan', 'nama_tukang', 'no_cuci', 'keterangan', 'total_berat', 'jumlah_barang', 'tanggal_cuci', 'status_dokumen', 'harga_cuci', 'status_proses'];

    public function getDataBeliREAL()
    {
        $this->findAll();
        $data = $this->get();
        return $data->getResult('array');
    }
    public function getBarangkode($id)
    {
        return $this->where(['barcode' => $id])->first();
    }
    public function getNoCuci($id)
    {
        return $this->where(['no_cuci' => $id])->first();
    }

    public function GetJenis()
    {
        $db = db_connect();
        $data = $db->query('SELECT Jenis FROM 220331_pembelian GROUP BY Jenis HAVING COUNT(Jenis) > 1');
        return $data->getResult('array');
    }
    public function GetSupplier()
    {
        $db = db_connect();
        $data = $db->query('SELECT Nama_Supplier FROM `220331_pembelian` GROUP BY Nama_Supplier;');
        return $data->getResult('array');
    }
}
