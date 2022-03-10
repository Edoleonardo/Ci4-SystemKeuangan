<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKartuStock extends Model
{

    protected $table = 'tbl_kartustock';
    protected $primaryKey = 'id_kartustock';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode', 'total_masuk', 'total_keluar', 'saldo_akhir'];

    public function getKartuStock($id = false)
    {
        if ($id == false) {
            // $query =  $this->db->table('tbl_img')
            //     ->select('*')
            //     ->get();
            // $data[0] = $query;
            $this->findAll();
            $this->orderBy('created_at', 'DESC');
            // $this->limit(10);
            $data = $this->get();
            return $data->getResult('array');
            //return $this->findAll();
        }
        return $this->where(['id_stock' => $id])->first();
    }
    public function getKartuStockkode($id)
    {
        return $this->where(['kode' => $id])->first();
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
}
