<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelCuci extends Model
{

    protected $table = 'tbl_cuci';
    protected $primaryKey = 'id_cuci';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_date_cuci', 'pembayaran', 'nama_bank', 'id_karyawan', 'nama_tukang', 'no_cuci', 'keterangan', 'total_berat', 'jumlah_barang', 'tanggal_cuci', 'status_dokumen', 'harga_cuci', 'status_proses'];

    public function getDataCuciAll($id = false)
    {
        if ($id == false) {
            $this->findAll();
            $this->orderBy('created_at', 'DESC');
            $data = $this->get();
            return $data->getResult('array');
        }
        return $this->where(['id_date_cuci' => $id])->first();
    }
    public function getBarangkode($id)
    {
        return $this->where(['barcode' => $id])->first();
    }
    public function getNoCuci($id)
    {
        return $this->where(['no_cuci' => $id])->first();
    }
    public function getNoTransCuci()
    {
        $db = db_connect();
        $data = $db->query('select max(substr(no_cuci,3,10)) no_cuci from tbl_cuci where substr(no_cuci,1,2) = "C-" limit 1');
        return $data->getResult('array')[0];
    }
    public function DataFilterCuci($lim, $kel, $stat, $notrans)
    {
        $db = db_connect();
        if ($lim == 'semua') {
            $lim1 = '';
        } else {
            $lim1  = 'Limit ' . $lim;
        }
        if ($notrans) {
            $notrans1  = 'no_cuci = ' . '"' . $notrans . '"';
        } else {
            $notrans1 = '1 = 1';
        }
        $data = $db->query('select * from tbl_cuci where ' . $notrans1 . ' order by created_at DESC ' . $lim1 . ' ');
        return $data->getResult('array');
    }
}
