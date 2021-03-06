<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPenjualanREAL extends Model
{

    protected $table = '220331_penjualan';
    protected $primaryKey = 'id_penjualanreal';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_date_cuci', 'pembayaran', 'nama_bank', 'id_karyawan', 'nama_tukang', 'no_cuci', 'keterangan', 'total_berat', 'jumlah_barang', 'tanggal_cuci', 'status_dokumen', 'harga_cuci', 'status_proses'];

    public function getDataPenjualan($id = false)
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
    public function GETJENISJUAL()
    {
        $db = db_connect();
        $data = $db->query('SELECT Kadar FROM `220331_penjualan` GROUP BY Kadar HAVING COUNT(Kadar) >1;');
        return $data->getResult('array');
    }
    public function penjualankestock()
    {
        $db = db_connect();
        $data = $db->query('SELECT * from 220331_jualstock WHERE Kode_Brg NOT IN (SELECT barcode FROM tbl_stock_1)');
        return $data->getResult('array');
    }
    public function getNoTransCuci()
    {
        $db = db_connect();
        $data = $db->query('select max(substr(no_cuci,3,10)) no_cuci from tbl_cuci where substr(no_cuci,1,2) = "S-" limit 1');
        return $data->getResult('array')[0];
    }
    public function Prinbarcode()
    {
        $db = db_connect();
        $data = $db->query('SELECT * FROM `tbl_stock_1` WHERE qty != 0 ORDER BY `tbl_stock_1`.`barcode` ASC');
        return $data->getResult('array');
    }
}
