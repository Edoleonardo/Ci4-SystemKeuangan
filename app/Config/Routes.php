<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();
$session = session();
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



//-----------------------------------------
$routes->get('/login', 'Login::Login');
$routes->get('/logout', 'Login::LogOut');
$routes->POST('/masuklogin', 'Login::MasukLogin');


// if ($session->get('role')) {
// ---------------Home-------------------

$routes->get('/', ($session->get('role')) ? 'Home::index' : 'Login::Login');
$routes->get('/databarang', ($session->get('role')) ? 'Home::databarang' : 'Login::Login');
$routes->get('/databarangjual', ($session->get('role')) ? 'Home::databarangjual' : 'Login::Login');
$routes->get('/detail/(:any)', ($session->get('role')) ? 'Home::detail/$1' : 'Login::Login');
$routes->get('/print/(:any)', ($session->get('role')) ? 'Home::print/$1' : 'Login::Login');
$routes->get('/kartustock', ($session->get('role')) ? 'Home::KatruStock' : 'Login::Login');
$routes->get('/modaldetailkartustock', ($session->get('role')) ? 'Home::DetailKartuStock' : 'Login::Login');
$routes->get('/detailbarang/(:any)', ($session->get('role')) ? 'Home::DetailBarangKode/$1' : 'Login::Login');


// --------------------BarangMasuk-----------

$routes->get('/barangmasuk', ($session->get('role')) ? 'Barangmasuk::supplier' : 'Login::Login');
$routes->get('/pembelian', ($session->get('role')) ? 'Barangmasuk::detail_pembelian' : 'Login::Login');
$routes->get('/ajaxpembelian', ($session->get('role')) ? 'Barangmasuk::pembelian_read' : 'Login::Login');
$routes->get('/detailtlable', ($session->get('role')) ? 'Barangmasuk::Detail_table' : 'Login::Login');
$routes->post('/ajaxinsert', ($session->get('role')) ? 'Barangmasuk::pembelian_insert' : 'Login::Login');
$routes->get('/deletedetail', ($session->get('role')) ? 'Barangmasuk::DeleteDetail' : 'Login::Login');
$routes->get('/deletedetailsemua', ($session->get('role')) ? 'Barangmasuk::DeleteDetailsemua' : 'Login::Login');
$routes->get('/stockdata', ($session->get('role')) ? 'Barangmasuk::StockDataMasuk' : 'Login::Login');
$routes->get('/draft/(:any)', ($session->get('role')) ? 'Barangmasuk::MasukDraft/$1' : 'Login::Login');
$routes->get('/detailpembelian/(:any)', ($session->get('role')) ? 'Barangmasuk::DetailPembelianSupp/$1' : 'Login::Login');
$routes->get('/batalpembelian', ($session->get('role')) ? 'Barangmasuk::BatalPembelian' : 'Login::Login');
$routes->get('/printbarcode/(:any)', ($session->get('role')) ? 'Barangmasuk::BarcodeGenerate/$1' : 'Login::Login');
$routes->delete('/returbarang/(:num)', ($session->get('role')) ? 'Barangmasuk::ReturBarang/$1' : 'Login::Login');
$routes->delete('/cancelbarang/(:num)', ($session->get('role')) ? 'Barangmasuk::CancelBarang/$1' : 'Login::Login');
$routes->get('/ajaxdetailpembelian', ($session->get('role')) ? 'Barangmasuk::pembelian_detail_read' : 'Login::Login');
$routes->post('/ajaxpembayaran', ($session->get('role')) ? 'Barangmasuk::Pembayaran_beli' : 'Login::Login');
$routes->get('/editdetail', ($session->get('role')) ? 'Barangmasuk::GetDataDetail' : 'Login::Login');
$routes->post('/editdataform', ($session->get('role')) ? 'Barangmasuk::EditDataPost' : 'Login::Login');
$routes->get('/deletepembayaran', ($session->get('role')) ? 'Barangmasuk::DeletePembayaran' : 'Login::Login');
$routes->get('/modalbarcode', ($session->get('role')) ? 'Barangmasuk::ModalBarcode' : 'Login::Login');
$routes->get('/detailbarcode', ($session->get('role')) ? 'Barangmasuk::DetailBarcode' : 'Login::Login');




//--------------------------BarangKeluar---------------------------

$routes->get('/barangkeluar', ($session->get('role')) ? 'Barangkeluar::DataPenjualan' : 'Login::Login');
$routes->get('/jualbarang', ($session->get('role')) ? 'Barangkeluar::PenjualanBarang' : 'Login::Login');
$routes->post('/insertcustomer', ($session->get('role')) ? 'Barangkeluar::InsertCust' : 'Login::Login');
$routes->post('/kodebarang', ($session->get('role')) ? 'Barangkeluar::InsertJual' : 'Login::Login');
$routes->get('/tampilpenjualan', ($session->get('role')) ? 'Barangkeluar::penjualan_read' : 'Login::Login');
$routes->get('/deletedetailjual', ($session->get('role')) ? 'Barangkeluar::DeleteDetailjual' : 'Login::Login');
$routes->get('/draftpenjualan/(:any)', ($session->get('role')) ? 'Barangkeluar::DraftPenjualan/$1' : 'Login::Login');
$routes->get('/batalpenjualan', ($session->get('role')) ? 'Barangkeluar::BatalPenjualan' : 'Login::Login');
$routes->post('/ubahharga', ($session->get('role')) ? 'Barangkeluar::UbahHarga' : 'Login::Login');
$routes->get('/ajaxdetailpenjualan', ($session->get('role')) ? 'Barangkeluar::penjualan_detail_read' : 'Login::Login');
$routes->post('/ajaxpembayaranjual', ($session->get('role')) ? 'Barangkeluar::Pembayaran_jual' : 'Login::Login');
$routes->get('/printinvoice/(:any)', ($session->get('role')) ? 'Barangkeluar::PrintInvoice/$1' : 'Login::Login');
$routes->get('/detailpenjualan/(:any)', ($session->get('role')) ? 'Barangkeluar::DetailDataPenjualan/$1' : 'Login::Login');
$routes->get('/tampilcust', ($session->get('role')) ? 'Barangkeluar::TampilCustomer' : 'Login::Login');
$routes->get('/checkcust', ($session->get('role')) ? 'Barangkeluar::CheckCustomer' : 'Login::Login');

//------------------buyback----------------
$routes->get('/buybackcust', ($session->get('role')) ? 'BuybackCust::BuyBack' : 'Login::Login');
$routes->get('/halamanbuyback', ($session->get('role')) ? 'BuybackCust::HalamanTambah' : 'Login::Login');
$routes->post('/scantrans', ($session->get('role')) ? 'BuybackCust::Cari_notrans' : 'Login::Login');
$routes->get('/tampilbuyback', ($session->get('role')) ? 'BuybackCust::TampilBuyback' : 'Login::Login');
$routes->get('/tampildatabuyback', ($session->get('role')) ? 'BuybackCust::TampilDataBuyback' : 'Login::Login');
$routes->post('/tambahbuyback', ($session->get('role')) ? 'BuybackCust::TambahBuyback' : 'Login::Login');
$routes->post('/tambahbuybacknonota', ($session->get('role')) ? 'BuybackCust::TambahBuybackNonota' : 'Login::Login');
$routes->get('/draftbuyback/(:any)', ($session->get('role')) ? 'BuybackCust::DraftBuyback/$1' : 'Login::Login');
$routes->get('/deletedetailbuyback', ($session->get('role')) ? 'BuybackCust::DeleteDetailBuyback' : 'Login::Login');
$routes->post('/pembayaranform', ($session->get('role')) ? 'BuybackCust::PembayaranBuyback' : 'Login::Login');
$routes->get('/batalbuyback/(:any)', ($session->get('role')) ? 'BuybackCust::BatalBuyback/$1' : 'Login::Login');
$routes->get('/modalbarcodebb', ($session->get('role')) ? 'BuybackCust::ModalBarcode' : 'Login::Login');
$routes->get('/tampilcustbb', ($session->get('role')) ? 'BuybackCust::TampilCustomer' : 'Login::Login');
$routes->get('/detailbuyback/(:any)', ($session->get('role')) ? 'BuybackCust::DetailBuyback/$1' : 'Login::Login');



//-------------------------------------------------------

// $routes->get('/dataretur', 'Prosesbarang::HomeRetur');
// $routes->get('/datacuci', 'Prosesbarang::HomeCuci');
// $routes->get('/tampilcuci', 'Prosesbarang::TampilCuci');
// $routes->post('/updatecuci', 'Prosesbarang::UpdateCuci');

//-----------------Lebur--------------------------------------------
$routes->get('/datalebur', ($session->get('role')) ? 'BarangLebur::HomeLebur' : 'Login::Login');
$routes->get('/leburbarang', ($session->get('role')) ? 'BarangLebur::LeburBarang' : 'Login::Login');
$routes->get('/draftlebur/(:any)', ($session->get('role')) ? 'BarangLebur::DraftLeburBarang/$1' : 'Login::Login');
$routes->get('/tambahlebur', ($session->get('role')) ? 'BarangLebur::TambahLebur' : 'Login::Login');
$routes->get('/batallebur/(:any)', ($session->get('role')) ? 'BarangLebur::BatalLebur/$1' : 'Login::Login');
$routes->get('/hapuslebur', ($session->get('role')) ? 'BarangLebur::DeleteLebur' : 'Login::Login');
$routes->get('/detailbarang', ($session->get('role')) ? 'BarangLebur::DataDetailBarang' : 'Login::Login');
$routes->get('/ubahstatus', ($session->get('role')) ? 'BarangLebur::UbahStatus' : 'Login::Login');
$routes->get('/modalprintlebur', ($session->get('role')) ? 'BarangLebur::ModalLebur' : 'Login::Login');
$routes->post('/selesailebur', ($session->get('role')) ? 'BarangLebur::SelesaiLebur' : 'Login::Login');


//---------------------------------cuci-----------------------------------------
$routes->get('/datacuci', ($session->get('role')) ? 'BarangCuci::HomeCuci' : 'Login::Login');
$routes->get('/cucibarang', ($session->get('role')) ? 'BarangCuci::CuciBarang' : 'Login::Login');
$routes->get('/draftcuci/(:any)', ($session->get('role')) ? 'BarangCuci::DraftCuciBarang/$1' : 'Login::Login');
$routes->get('/batalcuci/(:any)', ($session->get('role')) ? 'BarangCuci::BatalCuci/$1' : 'Login::Login');
$routes->get('/modalprintcuci', ($session->get('role')) ? 'BarangCuci::ModalCuci' : 'Login::Login');
$routes->get('/tambahcuci', ($session->get('role')) ? 'BarangCuci::TambahCuci' : 'Login::Login');
$routes->get('/hapuscuci', ($session->get('role')) ? 'BarangCuci::DeleteCuci' : 'Login::Login');
$routes->post('/selesaicuci', ($session->get('role')) ? 'BarangCuci::SelesaiCuci' : 'Login::Login');
$routes->get('/tampilcuci', ($session->get('role')) ? 'BarangCuci::TampilCuci' : 'Login::Login');
$routes->post('/updatecuci', ($session->get('role')) ? 'BarangCuci::UpdateCuci' : 'Login::Login');
$routes->post('/updatecuci', ($session->get('role')) ? 'BarangCuci::UpdateCuci' : 'Login::Login');
$routes->get('/printbarcodecuci/(:any)', ($session->get('role')) ? 'BarangCuci::BarcodeGenerate/$1' : 'Login::Login');



//---------------------------------Retur-----------------------------------------
$routes->get('/dataretur', ($session->get('role')) ? 'BarangRetur::HomeRetur' : 'Login::Login');
$routes->get('/returbarang', ($session->get('role')) ? 'BarangRetur::ReturBarang' : 'Login::Login');
$routes->get('/draftretur/(:any)', ($session->get('role')) ? 'BarangRetur::DraftReturBarang/$1' : 'Login::Login');
$routes->get('/batalretur/(:any)', ($session->get('role')) ? 'BarangRetur::BatalRetur/$1' : 'Login::Login');
$routes->get('/tambahretur', ($session->get('role')) ? 'BarangRetur::TambahRetur' : 'Login::Login');
$routes->get('/hapusretur', ($session->get('role')) ? 'BarangRetur::DeleteRetur' : 'Login::Login');
$routes->get('/modalprintretur', ($session->get('role')) ? 'BarangRetur::ModalRetur' : 'Login::Login');

// $routes->get('/leburbarang/(:any)', ($session->get('role')) ?'BarangRetur::TampilLeburBarang/$1': 'Login::Login');
$routes->get('/detailbarang', ($session->get('role')) ? 'BarangRetur::DataDetailBarang' : 'Login::Login');

// $routes->post('/selesailebur', 'Prosesbarang::SelesaiLebur');

//----------------------------------masterinput-------------------------
$routes->get('/masterinput', ($session->get('role')) ? 'MasterInput::HomeInput' : 'Login::Login');
$routes->POST('/insertsupp', ($session->get('role')) ? 'MasterInput::InsertSupp' : 'Login::Login');
$routes->POST('/insertkadar', ($session->get('role')) ? 'MasterInput::InsertKadar' : 'Login::Login');
$routes->POST('/insertmerek', ($session->get('role')) ? 'MasterInput::InsertMerek' : 'Login::Login');
$routes->POST('/insertbank', ($session->get('role')) ? 'MasterInput::InsertBank' : 'Login::Login');
$routes->POST('/updatesupp', ($session->get('role')) ? 'MasterInput::UpdateSupp' : 'Login::Login');
$routes->POST('/updatekadar', ($session->get('role')) ? 'MasterInput::UpdateKadar' : 'Login::Login');
$routes->POST('/updatemerek', ($session->get('role')) ? 'MasterInput::UpdateMerek' : 'Login::Login');
$routes->POST('/updatebank', ($session->get('role')) ? 'MasterInput::UpdateBank' : 'Login::Login');
$routes->POST('/updatecust', ($session->get('role')) ? 'MasterInput::UpdateCust' : 'Login::Login');


// $routes->POST('/hapusdata', 'MasterInput::HapusData');
$routes->get('/isidata', ($session->get('role')) ? 'MasterInput::DataMaster' : 'Login::Login');
// }

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
