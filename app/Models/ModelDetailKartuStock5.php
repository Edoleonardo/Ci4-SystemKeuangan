<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDetailKartuStock5 extends Model
{

    protected $table = 'tbl_detail_kartustock_5';
    protected $primaryKey = 'id_detail_kartustock_5';
    protected $useTimestamps = true;
    protected $allowedFields = ['barcode', 'id_karyawan', 'status', 'no_faktur', 'nama_customer', 'saldo', 'masuk', 'keluar', 'jenis', 'model', 'keterangan', 'merek', 'carat', 'saldo_carat', 'harga_beli', 'total_harga', 'gambar'];

    public function getDetailKartuStock($id = false)
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
        return $this->where(['barcode' => $id])->first();
    }
    public function getAllDetailKartuStock($id = false)
    {
        $this->Where(['barcode' => $id]);
        $this->orderBy('created_at', 'ASC');
        $data = $this->get();
        return $data->getResult('array');
    }
    public function SaldoAkhir($id = false)
    {
        $this->select('saldo');
        $this->Where(['barcode' => $id]);
        $this->orderBy('created_at', 'DESC');
        $data = $this->get();
        return $data->getResult('array')[0];
    }
    public function SumMasukKartu($id = false)
    {
        $this->selectSum('masuk');
        $this->where('barcode', $id);
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    public function SumKeluarKartu($id = false)
    {
        $this->selectSum('keluar');
        $this->where('barcode', $id);
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    public function SumKeluarBerat($id = false)
    {
        $this->selectSum('berat');
        $this->where('barcode', $id);
        $this->where('keluar !=', 0);
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    public function SumMasukBerat($id = false)
    {
        $this->selectSum('berat');
        $this->where('barcode', $id);
        $this->where('masuk !=', 0);
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    public function GetDataDelete($id, $nofaktur)
    {
        $this->selectSum('id_detail_kartustock');
        $this->where('barcode', $id);
        $this->where('no_faktur', $nofaktur);
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    public function getKartuDetailStockKode($id)
    {
        return $this->where(['barcode' => $id])->first();
    }
    public function CheckData($id)
    {
        // $db = db_connect();
        // $data = $db->query('select * from tbl_stock_1 where barcode = ' . $id . ' ');
        return $this->where(['barcode' => $id])->first();
    }
    public function SumSaldoBerat($id)
    {
        $db = db_connect();
        $data = $db->query('SELECT sum(a.carat) as carat1, sum(b.carat) as carat2, case WHEN sum(b.carat) is null THEN (sum(a.carat) - 0) ELSE (sum(a.carat) - sum(b.carat)) end as hasil from(SELECT barcode, sum(carat) carat from tbl_detail_kartustock_5 WHERE barcode = ' . $id . ' AND masuk != 0 GROUP BY barcode) a LEFT JOIN (SELECT barcode, sum(carat) carat from tbl_detail_kartustock_5 WHERE barcode = ' . $id . ' AND keluar != 0 GROUP BY barcode)b ON a.barcode = b.barcode;');
        return $data->getResult('array')[0];
        //  $this->get();
        // return $query;
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
