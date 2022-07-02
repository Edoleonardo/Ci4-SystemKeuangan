<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelStockOpname extends Model
{

    protected $table = 'tbl_stock_opname';
    protected $primaryKey = 'id_stock_opname';
    protected $useTimestamps = true;
    protected $allowedFields = ['barcode', 'id_karyawan', 'status', 'no_faktur', 'tgl_faktur', 'nama_supplier', 'qty', 'jenis', 'model', 'keterangan', 'merek', 'kadar', 'berat_murni', 'berat', 'carat', 'nilai_tukar', 'ongkos', 'harga_beli', 'total_harga', 'gambar'];

    public function getBarang($id = false)
    {
        if ($id == false) {
            $this->findAll();
            $this->orderBy('created_at', 'DESC');
            $data = $this->get();
            return $data->getResult('array');
        }
        return $this->where(['id_stock_opname' => $id])->first();
    }
    public function getKellBarang($kel)
    {
        $db = db_connect();
        $data = $db->query('SELECT * FROM tbl_stock_opname WHERE substr(barcode,1,1) =' . $kel . ' ;');
        return $data->getResult('array');
    }
    public function CountDataOpname($kel)
    {
        $db = db_connect();
        $data = $db->query('SELECT count(barcode) as jumlah FROM tbl_stock_opname WHERE substr(barcode,1,1) =' . $kel . ' ;');
        return $data->getResult('array')[0];
    }
    public function BeratSisaOpname($kel)
    {
        $db = db_connect();
        $data = $db->query('SELECT sum(berat) as berat FROM tbl_stock_opname WHERE substr(barcode,1,1) =' . $kel . ' AND qty != 0 ;');
        return $data->getResult('array')[0];
    }
    public function BeratBelumOpname($kel)
    {
        if ($kel == 1) {
            $tbl = 'tbl_stock_1';
            $where = 'berat';
        } elseif ($kel == 2) {
            $tbl = 'tbl_stock_2';
            $where = 'berat';
        } elseif ($kel == 3) {
            $tbl = 'tbl_stock_3';
            $where = 'berat';
        } elseif ($kel == 4) {
            $tbl = 'tbl_stock_4';
            $where = 'berat';
        } elseif ($kel == 5) {
            $tbl = 'tbl_stock_5';
            $where = 'carat';
        } elseif ($kel == 6) {
            $tbl = 'tbl_stock_6';
            $where = 'qty';
        }
        $db = db_connect();
        $data = $db->query('SELECT sum(' .  $where . ' ) as berat FROM ' . $tbl . ' WHERE qty != 0 AND barcode not in (select barcode from tbl_stock_opname) ;');
        return $data->getResult('array')[0];
    }
    public function BeratTotalOpname($kel)
    {
        if ($kel == 1) {
            $tbl = 'tbl_stock_1';
            $where = 'berat';
        } elseif ($kel == 2) {
            $tbl = 'tbl_stock_2';
            $where = 'berat';
        } elseif ($kel == 3) {
            $tbl = 'tbl_stock_3';
            $where = 'berat';
        } elseif ($kel == 4) {
            $tbl = 'tbl_stock_4';
            $where = 'berat';
        } elseif ($kel == 5) {
            $tbl = 'tbl_stock_5';
            $where = 'carat';
        } elseif ($kel == 6) {
            $tbl = 'tbl_stock_6';
            $where = 'qty';
        }
        $db = db_connect();
        $data = $db->query('SELECT sum(' .  $where . ' ) as berat FROM ' . $tbl . ' WHERE qty != 0 ;');
        return $data->getResult('array')[0];
    }
    public function getBarcodeData($id)
    {
        return $this->where(['barcode' => $id])->first();
    }

    public function BelumOpname($kel)
    {
        $db = db_connect();
        if ($kel == 1) {
            $data = $db->query('SELECT * FROM `tbl_stock_1` WHERE barcode not in (SELECT barcode from tbl_stock_opname) limit 20;');
        } elseif ($kel == 2) {
            $data = $db->query('SELECT * FROM `tbl_stock_2` WHERE barcode not in (SELECT barcode from tbl_stock_opname) limit 20;');
        } elseif ($kel == 3) {
            $data = $db->query('SELECT * FROM `tbl_stock_3` WHERE barcode not in (SELECT barcode from tbl_stock_opname) limit 20;');
        } elseif ($kel == 4) {
            $data = $db->query('SELECT * FROM `tbl_stock_4` WHERE barcode not in (SELECT barcode from tbl_stock_opname) limit 20;');
        } elseif ($kel == 5) {
            $data = $db->query('SELECT * FROM `tbl_stock_5` WHERE barcode not in (SELECT barcode from tbl_stock_opname) limit 20;');
        } elseif ($kel == 6) {
            $data = $db->query('SELECT * FROM `tbl_stock_6` WHERE barcode not in (SELECT barcode from tbl_stock_opname) limit 20;');
        }

        return $data->getResult('array');
    }
}
