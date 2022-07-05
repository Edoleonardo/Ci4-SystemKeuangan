<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelStock3 extends Model
{

    protected $table = 'tbl_stock_3';
    protected $primaryKey = 'id_stock_3';
    protected $useTimestamps = true;
    protected $allowedFields = ['barcode', 'id_karyawan', 'status', 'no_faktur', 'tgl_faktur', 'nama_supplier', 'qty', 'jenis', 'model', 'keterangan', 'merek', 'kadar', 'berat_murni', 'berat', 'nilai_tukar', 'ongkos', 'harga_beli', 'total_harga', 'gambar'];

    public function getBarang($id = false)
    {
        if ($id == false) {
            $db = db_connect();
            $data = $db->query('select * from tbl_stock_3 order by created_at DESC limit 10');
            return $data->getResult('array');
        }
        return $this->where(['id_stock_3' => $id])->first();
    }
    public function getBarangQty()
    {
        $db = db_connect();
        $data = $db->query('select * from tbl_stock_3 where qty != 0');
        return $data->getResult('array');
    }
    public function getBarangBarcode($id)
    {
        return $this->where(['barcode' => $id])->first();
    }

    public function getBarangOpname($id)
    {
        $db = db_connect();
        $data = $db->query('SELECT * FROM `tbl_stock_3` WHERE barcode not in (SELECT barcode from tbl_stock_opname) AND barcode = ' . $id . ';');
        if ($data->getResult('array')) {
            return $data->getResult('array')[0];
        } else {
            return $data->getResult('array');
        }
    }
    public function getBarangOpnameId($id)
    {
        $db = db_connect();
        $data = $db->query('SELECT * FROM `tbl_stock_3` WHERE barcode not in (SELECT barcode from tbl_stock_opname) AND id_stock_3 = ' . $id . ';');
        if ($data->getResult('array')) {
            return $data->getResult('array')[0];
        } else {
            return $data->getResult('array');
        }
    }

    public function Getsemuadata()
    {
        $this->findAll();
        // $this->limit(10);
        $data = $this->get();
        return $data->getResult('array');
    }

    public function getBarangFilter($tampil, $stock, $kode)
    {
        $db = db_connect();
        if ($kode) {
            $search = 'barcode =' . "'" . $kode . "'";
        } else {
            $search = '1 = 1';
        }
        if ($tampil != 'semua') {
            $row = 'Limit ' . $tampil;
        } else {
            $row = '';
        }

        if ($stock == 0) {
            $qty = '1 = 1';
        }
        if ($stock == 1) {
            $qty = 'qty > 0';
        }
        if ($stock == 2) {
            $qty = 'qty = 0';
        }
        $data = $db->query('select * from tbl_stock_3 where ' . $qty . ' and ' . $search . ' order by created_at DESC ' . $row . ' ');
        return $data->getResult('array');
    }
    public function getBarangkode($id)
    {
        return $this->where(['barcode' => $id])->first();
    }
    public function getBarcode($id)
    {
        $db = db_connect();
        $data = $db->query('select * from tbl_stock_3 where qty != 0 order by created_at DESC');
        return $data->getResult('array');
    }
    public function CheckData($id)
    {
        $db = db_connect();
        $data = $db->query('select * from tbl_stock_3 where barcode = ' . $id . ' and substr(barcode,1,1) = 4  and substr(barcode,1,1) = 3');
        if ($data->getResult('array')) {
            $data = $data->getResult('array')[0];
        } else {
            $data = $data->getResult('array');
        }
        return $data;
    }
    public function CheckDataCuci($id) //untukcuci
    {
        $db = db_connect();
        $data = $db->query('select * from tbl_stock_3 where barcode = ' . $id . ' ');
        if ($data->getResult('array')) {
            $data = $data->getResult('array')[0];
        } else {
            $data = $data->getResult('array');
        }
        return $data;
    }
    public function getKodeStock($id)
    {
        $db = db_connect();
        $data = $db->query('select max(substr(barcode,2,7)) kode from tbl_stock_3 where substr(barcode,1,1) = ' . $id . ' limit 1');
        return $data->getResult('array')[0];
        //  $this->get();
        // return $query;
    }
    public function getKodeBahan24k()
    {
        $db = db_connect();
        $data = $db->query('select * from tbl_stock_3 where substr(barcode,1,1) = 4 ');
        return $data->getResult('array');
        //  $this->get();
        // return $query;
    }
    public function returdelete($id)
    {
        $db = db_connect();
        $data = $db->query('DELETE FROM tbl_stock_3 WHERE barcode = ' . $id . '');
        return 0;
        //  $this->get();
        // return $query;
    }
    public function SisahOpname()
    {
        $db = db_connect();
        $data = $db->query('SELECT count(barcode) barcode FROM `tbl_stock_3` WHERE barcode NOT IN (SELECT barcode FROM tbl_stock_opname);');
        return $data->getResult('array')[0];
    }
    public function BelumOpname()
    {
        $db = db_connect();
        $data = $db->query('SELECT * FROM `tbl_stock_3` WHERE barcode NOT IN (SELECT barcode FROM tbl_stock_opname)  limit 20;');
        return $data->getResult('array');
    }
    public function CountDataStock()
    {
        $this->selectCount('barcode');
        $query = $this->get();
        return $query->getResult('array')[0];
    }
}
