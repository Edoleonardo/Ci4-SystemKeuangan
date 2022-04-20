<?php

namespace App\Controllers;

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use App\Models\ModelHome;
use App\Models\ModelKartuStock;
use App\Models\ModelDetailKartuStock;

use CodeIgniter\Validation\Rules;
use app\Config\Cache;
use Config\Cache as ConfigCache;

class Home extends BaseController
{
    protected $barangmodel;
    protected $barcodeG;

    public function __construct()
    {

        $this->barcodeG =  new BarcodeGenerator();
        $this->barangmodel = new ModelHome();
        $this->modelkartustock = new ModelKartuStock();
        $this->modeldetailkartustock = new ModelDetailKartuStock();

        $this->chace = new ConfigCache();
    }
    public function index()
    {

        return view('home/index');
    }
    public function DetailBarangKode($id)
    {
        $getid = $this->barangmodel->getBarangkode($id);
        return redirect()->to('/detail/' . $getid['id_stock']);
    }
    public function databarang()
    {
        $data = [
            'barang' => $this->barangmodel->getBarang(),
            'pages' => 1,
            'validation' => \Config\Services::validation()

            // 'img' => $this->barangmodel->getBarang()[0]->getResult()
        ];
        $this->cachePage(1);
        return view('home/data_barang', $data);
    }
    public function TampilDataBarang()
    {
        if ($this->request->isAJAX()) {
            if ($this->request->getVar('kode') != 0) {
                $dabar = $this->barangmodel->getBarangFilter($this->request->getVar('kode'), $this->request->getVar('stock'));
            } else {
                $dabar = $this->barangmodel->getBarang();
            }
            $data = [
                'barang' =>  $dabar,
            ];
            $result = [
                'databarang' => view('home/tabledatabarang', $data),
            ];
            $this->cachePage(1);
            echo json_encode($result);
        }
    }
    public function KatruStock()
    {
        $data = [
            'kartustock' => $this->modelkartustock->getKartuStock(),
            'detailkartustock' => $this->modeldetailkartustock->getDetailKartuStock(),
        ];
        $this->cachePage(1);
        return view('home/data_kartustock', $data);
    }
    public function TampilDataKartu()
    {
        if ($this->request->isAJAX()) {
            if ($this->request->getVar('kode') != 0) {
                $dakar = $this->modelkartustock->getKartuFilter($this->request->getVar('kode'), $this->request->getVar('stock'));
            } else {
                $dakar = $this->modelkartustock->getKartuStock();
            }
            $data = [
                'kartustock' =>  $dakar,
            ];
            $result = [
                'datakartu' => view('home/tablekartustock', $data),
            ];
            $this->cachePage(1);
            echo json_encode($result);
        }
    }
    public function DetailKartuStock()
    {
        if ($this->request->isAJAX()) {
            $datadetail = [
                'detailkartustock' => $this->modeldetailkartustock->getAllDetailKartuStock($this->request->getVar('kode')),
            ];
            $data = [
                'modal' => view('home/modalkartustock', $datadetail)
            ];
            echo json_encode($data);
        }
    }
    public function detail($id)
    {
        $data = $this->barangmodel->getBarang($id);
        $barcode = $this->barcodeG;
        $barcode->setText($data['barcode']);
        $barcode->setType(BarcodeGenerator::Code128);
        $barcode->setScale(2);
        $barcode->setThickness(25);
        $barcode->setFontSize(10);
        $code = $barcode->generate();
        //echo '<img src="data:image/png;base64,' . $code . '" />';
        $data1 = [
            'barang' => $data,
            'barcode' => '<img src="data:image/png;base64,' . $code . '" />',
            // 'img' => $this->barangmodel->getImg($id)
        ];
        $this->cachePage(1);
        return view('home/detail_barang', $data1);
    }

    public function print($id)
    {
        $data = $this->barangmodel->getBarang($id);
        $barcode = $this->barcodeG;
        $barcode->setText($data['barcode']);
        $barcode->setType(BarcodeGenerator::Code128);
        $barcode->setScale(1);
        $barcode->setThickness(25);
        $barcode->setFontSize(10);
        $code = $barcode->generate();
        //echo '<img src="data:image/png;base64,' . $code . '" />';
        $data1 = [
            'barcode' => '<img src="data:image/png;base64,' . $code . '" /> <br>',
        ];

        return view('home/print_barcode.php', $data1);
    }

    public function save()
    {
        if (!$this->validate([
            'namabarang' => [
                'rules' => 'required|is_unique[tbl_barang.nama_barang]',
                'errors' => [
                    'required' => 'Nama Barang Harus di isi',
                    'is_unique' => 'Nama Barang sudah ada'
                ]
            ],
            'idbarcode' => [
                'rules' => 'required|is_unique[tbl_barang.barcode]',
                'errors' => [
                    'required' => 'Id Barcode Harus di isi',
                    'is_unique' => 'Id Barcode sudah Terpakai'
                ]
            ],
            'jenisbarang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Barang Harus di isi',
                ]
            ],
            'jumlahbarang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Stock Barang Harus di isi',
                ]
            ],
            'beratbarang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Berat Barang Harus di isi',
                ]
            ],
            'hargabarang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harga Barang Harus di isi',
                ]
            ],
            'gambar' => [
                'rules' => 'is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran Gambar teralu besar',
                    'is_image' => 'Bukan Gambar',
                    'mime_in' => 'extention tidak cocok'

                ]
            ]

        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/komik/create')->withInput()->with('validation', $validation);
            return redirect()->to('/home/databarang')->withInput();
        }
        $filesampul = $this->request->getFile('gambar');
        if ($filesampul->getError() == 4) {
            $namafile = 'default.jpg';
        } else {
            $namafile = $filesampul->getRandomName(); // pake nama random
            // $namafile = $filesampul->getName(); // ini pake nama asli di foto
            $filesampul->move('img', $namafile);
        }
        $session = session();
        $this->barangmodel->save([
            'id_img' => $this->request->getVar('idbarcode'),
            'id_karyawan' => $session->get('id_user'),
            'barcode' => $this->request->getVar('idbarcode'),
            'nama_barang' => $this->request->getVar('namabarang'),
            'jenis_barang' => $this->request->getVar('jenisbarang'),
            'berat_barang' => $this->request->getVar('beratbarang'),
            'stock_barang' => $this->request->getVar('jumlahbarang'),
            'harga_barang' => $this->request->getVar('hargabarang'),
            'nama_gbr' => $namafile,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/databarang');
    }
}
