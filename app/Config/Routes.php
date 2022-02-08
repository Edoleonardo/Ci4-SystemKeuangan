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
