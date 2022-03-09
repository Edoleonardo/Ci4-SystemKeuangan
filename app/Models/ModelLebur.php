<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLebur extends Model
{

    protected $table = 'tbl_lebur';
    protected $primaryKey = 'id_lebur';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_img', 'id_date_lebur', 'id_karyawan', 'kode', 'model', 'berat_murni', 'qty', 'tanggal_lebur', 'status_dokumen'];

    public function getDataLeburAll($id = false)
    {
        if ($id == false) {
            $this->findAll();
            $this->orderBy('created_at', 'DESC');
            $data = $this->get();
            return $data->getResult('array');
        }
        return $this->where(['id_date_lebur' => $id])->first();
    }
    public function getBarangkode($id)
    {
        return $this->where(['barcode' => $id])->first();
    }
    public function CheckData($id)
    {
        // $db = db_connect();
        // $data = $db->query('select * from tbl_stock where barcode = ' . $id . ' ');
        return $this->where(['barcode' => $id])->first();
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
        $data = $db->query('select * from tbl_stock where substr(barcode,1,1) = 3 or substr(barcode,1,1) = 4 ');
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
    public function getKode($id)
    {
        $db = db_connect();
        $data = $db->query('select max(substr(kode,2,7)) kode from tbl_lebur where substr(kode,1,1) = ' . $id . ' limit 1');
        return $data->getResult('array')[0];
        //  $this->get();
        // return $query;
    }
}
