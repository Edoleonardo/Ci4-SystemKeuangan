<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// ---------------Home-------------------

$routes->get('/', 'Home::index');
$routes->get('/databarang', 'Home::databarang');
$routes->get('/detail/(:any)', 'Home::detail/$1');
$routes->get('/print/(:any)', 'Home::print/$1');
$routes->get('/kartustock', 'Home::KatruStock');
$routes->get('/modaldetailkartustock', 'Home::DetailKartuStock');
$routes->get('/detailbarang/(:any)', 'Home::DetailBarangKode/$1');


// --------------------BarangMasuk-----------

$routes->get('/barangmasuk', 'Barangmasuk::supplier');
$routes->get('/pembelian', 'Barangmasuk::detail_pembelian');
$routes->get('/ajaxpembelian', 'Barangmasuk::pembelian_read');
$routes->get('/detailtlable', 'Barangmasuk::Detail_table');
$routes->post('/ajaxinsert', 'Barangmasuk::pembelian_insert');
$routes->get('/deletedetail', 'Barangmasuk::DeleteDetail');
$routes->get('/deletedetailsemua', 'Barangmasuk::DeleteDetailsemua');
$routes->get('/stockdata', 'Barangmasuk::StockDataMasuk');
$routes->get('/draft/(:any)', 'Barangmasuk::MasukDraft/$1');
$routes->get('/detailpembelian/(:any)', 'Barangmasuk::DetailPembelianSupp/$1');
$routes->get('/batalpembelian', 'Barangmasuk::BatalPembelian');
$routes->get('/printbarcode/(:any)', 'Barangmasuk::BarcodeGenerate/$1');
$routes->delete('/returbarang/(:num)', 'Barangmasuk::ReturBarang/$1');
$routes->delete('/cancelbarang/(:num)', 'Barangmasuk::CancelBarang/$1');
$routes->get('/ajaxdetailpembelian', 'Barangmasuk::pembelian_detail_read');
$routes->post('/ajaxpembayaran', 'Barangmasuk::Pembayaran_beli');
$routes->get('/editdetail', 'Barangmasuk::GetDataDetail');
$routes->post('/editdataform', 'Barangmasuk::EditDataPost');
$routes->get('/deletepembayaran', 'Barangmasuk::DeletePembayaran');
$routes->get('/modalbarcode', 'Barangmasuk::ModalBarcode');
$routes->get('/detailbarcode', 'Barangmasuk::DetailBarcode');




//--------------------------BarangKeluar---------------------------

$routes->get('/barangkeluar', 'Barangkeluar::DataPenjualan');
$routes->get('/jualbarang', 'Barangkeluar::PenjualanBarang');
$routes->post('/insertcustomer', 'Barangkeluar::InsertCust');
$routes->post('/kodebarang', 'Barangkeluar::InsertJual');
$routes->get('/tampilpenjualan', 'Barangkeluar::penjualan_read');
$routes->get('/deletedetailjual', 'Barangkeluar::DeleteDetailjual');
$routes->get('/draftpenjualan/(:any)', 'Barangkeluar::DraftPenjualan/$1');
$routes->get('/batalpenjualan', 'Barangkeluar::BatalPenjualan');
$routes->post('/ubahharga', 'Barangkeluar::UbahHarga');
$routes->get('/ajaxdetailpenjualan', 'Barangkeluar::penjualan_detail_read');
$routes->post('/ajaxpembayaranjual', 'Barangkeluar::Pembayaran_jual');
$routes->get('/printinvoice/(:any)', 'Barangkeluar::PrintInvoice/$1');
$routes->get('/detailpenjualan/(:any)', 'Barangkeluar::DetailDataPenjualan/$1');
$routes->get('/tampilcust', 'Barangkeluar::TampilCustomer');
$routes->get('/checkcust', 'Barangkeluar::CheckCustomer');

//------------------buyback----------------
$routes->get('/buybackcust', 'BuybackCust::BuyBack');
$routes->get('/halamanbuyback', 'BuybackCust::HalamanTambah');
$routes->post('/scantrans', 'BuybackCust::Cari_notrans');
$routes->get('/tampilbuyback', 'BuybackCust::TampilBuyback');
$routes->get('/tampildatabuyback', 'BuybackCust::TampilDataBuyback');
$routes->post('/tambahbuyback', 'BuybackCust::TambahBuyback');
$routes->post('/tambahbuybacknonota', 'BuybackCust::TambahBuybackNonota');
$routes->get('/draftbuyback/(:any)', 'BuybackCust::DraftBuyback/$1');
$routes->get('/deletedetailbuyback', 'BuybackCust::DeleteDetailBuyback');
$routes->post('/pembayaranform', 'BuybackCust::PembayaranBuyback');
$routes->get('/batalbuyback/(:any)', 'BuybackCust::BatalBuyback/$1');
$routes->get('/modalbarcodebb', 'BuybackCust::ModalBarcode');
$routes->get('/tampilcustbb', 'BuybackCust::TampilCustomer');
$routes->get('/detailbuyback/(:any)', 'BuybackCust::DetailBuyback/$1');



//-------------------------------------------------------

// $routes->get('/dataretur', 'Prosesbarang::HomeRetur');
// $routes->get('/datacuci', 'Prosesbarang::HomeCuci');
// $routes->get('/tampilcuci', 'Prosesbarang::TampilCuci');
// $routes->post('/updatecuci', 'Prosesbarang::UpdateCuci');

//-----------------Lebur--------------------------------------------
$routes->get('/datalebur', 'BarangLebur::HomeLebur');
$routes->get('/leburbarang', 'BarangLebur::LeburBarang');
$routes->get('/draftlebur/(:any)', 'BarangLebur::DraftLeburBarang/$1');
$routes->get('/tambahlebur', 'BarangLebur::TambahLebur');
$routes->get('/batallebur/(:any)', 'BarangLebur::BatalLebur/$1');
$routes->get('/hapuslebur', 'BarangLebur::DeleteLebur');
$routes->get('/detailbarang', 'BarangLebur::DataDetailBarang');
$routes->get('/ubahstatus', 'BarangLebur::UbahStatus');
$routes->get('/modalprintlebur', 'BarangLebur::ModalLebur');
$routes->post('/selesailebur', 'BarangLebur::SelesaiLebur');


//---------------------------------cuci-----------------------------------------
$routes->get('/datacuci', 'BarangCuci::HomeCuci');
$routes->get('/cucibarang', 'BarangCuci::CuciBarang');
$routes->get('/draftcuci/(:any)', 'BarangCuci::DraftCuciBarang/$1');
$routes->get('/batalcuci/(:any)', 'BarangCuci::BatalCuci/$1');
$routes->get('/modalprintcuci', 'BarangCuci::ModalCuci');
$routes->get('/tambahcuci', 'BarangCuci::TambahCuci');
$routes->get('/hapuscuci', 'BarangCuci::DeleteCuci');
$routes->post('/selesaicuci', 'BarangCuci::SelesaiCuci');
$routes->get('/tampilcuci', 'BarangCuci::TampilCuci');
$routes->post('/updatecuci', 'BarangCuci::UpdateCuci');
$routes->post('/updatecuci', 'BarangCuci::UpdateCuci');
$routes->get('/printbarcodecuci/(:any)', 'BarangCuci::BarcodeGenerate/$1');



//---------------------------------Retur-----------------------------------------
$routes->get('/dataretur', 'BarangRetur::HomeRetur');
$routes->get('/returbarang', 'BarangRetur::ReturBarang');
$routes->get('/draftretur/(:any)', 'BarangRetur::DraftReturBarang/$1');
$routes->get('/batalretur/(:any)', 'BarangRetur::BatalRetur/$1');
$routes->get('/tambahretur', 'BarangRetur::TambahRetur');
$routes->get('/hapusretur', 'BarangRetur::DeleteRetur');
$routes->get('/modalprintretur', 'BarangRetur::ModalRetur');

// $routes->get('/leburbarang/(:any)', 'BarangRetur::TampilLeburBarang/$1');
$routes->get('/detailbarang', 'BarangRetur::DataDetailBarang');

// $routes->post('/selesailebur', 'Prosesbarang::SelesaiLebur');




// $routes->get('/leburbarang/(:any)', 'Prosesbarang::LeburBarang/$1');




/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
