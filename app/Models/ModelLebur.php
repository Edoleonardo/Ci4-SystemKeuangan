<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLebur extends Model
{

    protected $table = 'tbl_lebur';
    protected $primaryKey = 'id_lebur';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_img', 'nama_tukang', 'total_berat', 'id_date_lebur', 'id_karyawan', 'no_lebur', 'kode', 'jenis', 'kadar', 'jumlah_barang', 'model', 'keterangan', 'berat_murni', 'qty', 'tanggal_lebur', 'status_dokumen', 'total_harga_bahan'];

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
    public function getNoLebur($id)
    {
        return $this->where(['no_lebur' => $id])->first();
    }
    public function getNoTransLebur()
    {
        $db = db_connect();
        $data = $db->query('select max(substr(no_lebur,3,10)) no_lebur from tbl_lebur limit 1');
        return $data->getResult('array')[0];
    }
    public function getKodeLebur($id)
    {
        $db = db_connect();
        $data = $db->query('select max(substr(kode,2,7)) kode from tbl_lebur where substr(kode,1,1) = ' . $id . ' limit 1');
        return $data->getResult('array')[0];
        //  $this->get();
        // return $query;
    }
}
