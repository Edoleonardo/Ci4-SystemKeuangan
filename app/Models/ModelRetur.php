<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelRetur extends Model
{

    protected $table = 'tbl_retur';
    protected $primaryKey = 'id_retur';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_date_retur', 'id_karyawan', 'no_retur', 'kode', 'jenis', 'model', 'keterangan', 'berat', 'qty', 'tanggal_retur', 'status_dokumen', 'total_harga_bahan'];

    public function getDataReturAll($id = false)
    {
        if ($id == false) {
            $this->findAll();
            $this->orderBy('created_at', 'DESC');
            $data = $this->get();
            return $data->getResult('array');
        }
        return $this->where(['id_date_retur' => $id])->first();
    }
    public function getBarangkode($id)
    {
        return $this->where(['barcode' => $id])->first();
    }
    public function getNoTransRetur()
    {
        $db = db_connect();
        $data = $db->query('select max(substr(no_retur,3,10)) no_retur from tbl_retur limit 1');
        return $data->getResult('array')[0];
    }
}
