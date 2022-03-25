<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTukang extends Model
{

    protected $table = 'tbl_tukang';
    protected $primaryKey = 'id_tukang';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_karyawan', 'nama_tukang', 'nohp', 'alamat'];

    public function getTukang($id = false)
    {
        if ($id == false) {
            $this->findAll();
            $this->orderBy('created_at', 'DESC');
            $data = $this->get();
            return $data->getResult('array');
        }
        return $this->where(['id_tukang' => $id])->first();
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
