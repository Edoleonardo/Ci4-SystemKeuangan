<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDetailRetur extends Model
{

    protected $table = 'tbl_detail_retur';
    protected $primaryKey = 'id_detail_retur';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_date_retur', 'id_karyawan', 'id_detail_buyback', 'nama_img', 'kode', 'jenis', 'qty', 'model', 'keterangan', 'berat_murni', 'berat', 'harga_beli', 'ongkos', 'kadar', 'status', 'nilai_tukar', 'merek', 'total_harga', 'no_nota', 'status_proses', 'nama_bank', 'tunai', 'transfer', 'cara_pembayaran', 'status_proses', 'no_nota_jual'];

    public function getDetailAllretur($id = false)
    {
        if ($id == false) {
            $this->findAll();
            $this->orderBy('created_at', 'DESC');
            $data = $this->get();
            return $data->getResult('array');
        } else {
            $this->Where(['id_date_retur' => $id]);
            $this->orderBy('created_at', 'DESC');
            $data = $this->get();
            return $data->getResult('array');
        }
    }
    public function PrintNotaRetur($id)
    {
        $this->Where(['id_date_retur' => $id]);
        $this->orderBy('kadar', 'DESC');
        $data = $this->get();
        return $data->getResult('array');
    }
    public function getDataDetailretur($id)
    {
        return $this->where(['id_detail_retur' => $id])->first();
    }
    public function CheckDataretur($id)
    {
        return $this->where(['id_detail_buyback' => $id])->first();
    }
    public function getDetailretur($id)
    {
        // dd($id);
        $this->Where(['id_date_retur' => $id]);
        $this->orderBy('created_at', 'DESC');
        $data = $this->get();
        return $data->getResult('array');
    }

    public function getDataReturAll()
    {
        $this->where(['status_proses' => 'Retur']);
        $this->orderBy('created_at', 'DESC');
        $query = $this->get();
        return $query->getResult('array');
    }
    public function getDatareturAllC()
    {
        $this->where(['status_proses' => 'retur']);
        $this->orderBy('created_at', 'DESC');
        $query = $this->get();
        return $query->getResult('array');
    }

    public function getDataRetur()
    {
        $this->getWhere(['status_proses' => 'Retur']);
        $this->orderBy('created_at', 'DESC');
        $query = $this->get();
        return $query->getResult('array');
    }
    public function CountBeratDetailRetur($id)
    {
        $this->selectCount('berat');
        $this->where('id_date_retur', $id);
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    public function SumBeratDetailRetur($id)
    {
        $this->selectSum('berat');
        $this->where('id_date_retur', $id);
        $query = $this->get();
        return $query->getResult('array')[0];
    }
    public function getKode($id)
    {
        $db = db_connect();
        $data = $db->query('select max(substr(kode,2,7)) kode from tbl_detail_buyback where substr(kode,1,1) = ' . $id . ' limit 1');
        return $data->getResult('array')[0];
        //  $this->get();
        // return $query;
    }
}
