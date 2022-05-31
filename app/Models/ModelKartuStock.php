<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKartuStock extends Model
{

    protected $table = 'tbl_kartustock';
    protected $primaryKey = 'id_kartustock';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode', 'id_karyawan', 'total_masuk', 'total_keluar', 'saldo_akhir'];

    public function getKartuStock($id = false)
    {
        if ($id == false) {
            // $query =  $this->db->table('tbl_img')
            //     ->select('*')
            //     ->get();
            // $data[0] = $query;
            $this->findAll();
            $this->orderBy('updated_at', 'DESC');
            $this->limit(10);
            $data = $this->get();
            return $data->getResult('array');
            //return $this->findAll();
        }
        return $this->where(['id_stock_1' => $id])->first();
    }
    public function getKartuFilter($id, $stock, $kode)
    {
        $db = db_connect();
        if ($kode) {
            $search = "kode =" . "'" . $kode . "'";
        } else {
            $search = '1 = 1';
        }
        if ($id == 0) {
            $lim = 'Limit 10';
            $row = '1 = 1';
        } else {
            $lim  = '';
            $row = 'substr(kode,1,1) = ' . $id;
        }

        if ($stock == 0) {
            $qty = '1 = 1';
        }
        if ($stock == 1) {
            $qty = 'saldo_akhir > 0';
        }
        if ($stock == 2) {
            $qty = 'saldo_akhir = 0';
        }
        $data = $db->query('select * from tbl_kartustock where ' . $qty . ' and ' . $search . ' and ' . $row . ' order by created_at DESC ' . $lim . ' ');
        return $data->getResult('array');
    }

    public function getKartuStockkode($id)
    {
        return $this->where(['kode' => $id])->first();
    }
    public function CheckData($id)
    {
        // $db = db_connect();
        // $data = $db->query('select * from tbl_stock_1 where barcode = ' . $id . ' ');
        return $this->where(['barcode' => $id])->first();
    }
    public function getKodeStock($id)
    {
        $db = db_connect();
        $data = $db->query('select max(substr(barcode,2,7)) kode from tbl_stock_1 where substr(barcode,1,1) = ' . $id . ' limit 1');
        return $data->getResult('array')[0];
        //  $this->get();
        // return $query;
    }
    public function getKodeBahan24k()
    {
        $db = db_connect();
        $data = $db->query('select * from tbl_stock_1 where substr(barcode,1,1) = 3 or substr(barcode,1,1) = 4 ');
        return $data->getResult('array');
        //  $this->get();
        // return $query;
    }
    public function returdelete($id)
    {
        $db = db_connect();
        $data = $db->query('DELETE FROM tbl_stock_1 WHERE barcode = ' . $id . '');
        return 0;
        //  $this->get();
        // return $query;
    }
}
