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
$routes->get('/kartustock/(:any)', ($session->get('role')) ? 'Home::KatruStock/$1' : 'Login::Login');
$routes->get('/modaldetailkartustock', ($session->get('role')) ? 'Home::DetailKartuStock' : 'Login::Login');
$routes->get('/tampildatakartu', ($session->get('role')) ? 'Home::TampilDataKartu' : 'Login::Login');
$routes->get('/detailbarang/(:any)', ($session->get('role')) ? 'Home::DetailBarangKode/$1' : 'Login::Login');
$routes->get('/printstatistik', ($session->get('role')) ? 'Home::PrintStatistik' : 'Login::Login');
$routes->get('/tampilmodalhome', ($session->get('role')) ? 'Home::TampilModalHome' : 'Login::Login');

//----------------------stockopname--------------------------
$routes->get('/stockopname', ($session->get('role')) ? 'StockOpname::HomeOpname' : 'Login::Login');
$routes->get('/tampilopname', ($session->get('role')) ? 'StockOpname::TampilOpname' : 'Login::Login');
$routes->get('/modaldetailopname', ($session->get('role')) ? 'StockOpname::TampilModalDetail' : 'Login::Login');
$routes->get('/editopname', ($session->get('role')) ? 'StockOpname::EditOpname' : 'Login::Login');
$routes->get('/caribarcodeopname', ($session->get('role')) ? 'StockOpname::CariBarcode' : 'Login::Login');
$routes->get('/pilihbarangopname', ($session->get('role')) ? 'StockOpname::PilihBarangOpname' : 'Login::Login');
$routes->get('/hapusopname', ($session->get('role')) ? 'StockOpname::HapusOpname' : 'Login::Login');
$routes->POST('/formeditopname', ($session->get('role')) ? 'StockOpname::SelesaiEdit' : 'Login::Login');
$routes->get('/selesaiopname', ($session->get('role')) ? 'StockOpname::SelesaiOpname' : 'Login::Login');
$routes->get('/openscanbarcode', ($session->get('role')) ? 'StockOpname::OpenScanBarcode' : 'Login::Login');

//---------------------MasterStock---------------------
$routes->get('/databarang/(:any)', ($session->get('role')) ? 'DataStock::databarang/$1' : 'Login::Login');
$routes->get('/tampildatabarang', ($session->get('role')) ? 'DataStock::TampilDataBarang' : 'Login::Login');
$routes->get('/detail/(:any)/(:any)', ($session->get('role')) ? 'DataStock::detail/$1/$2' : 'Login::Login');
$routes->get('/print/(:any)', ($session->get('role')) ? 'DataStock::print/$1' : 'Login::Login');


// --------------------BarangMasuk-----------
// $routes->get('/tampilbayarmodal', ($session->get('role')) ? 'Barangmasuk::TampilBayar' : 'Login::Login');
$routes->get('/tampilpembelian', ($session->get('role')) ? 'Barangmasuk::TampilPembelian' : 'Login::Login');
$routes->get('/ubahhargamurni', ($session->get('role')) ? 'Barangmasuk::UbahHargaMurni' : 'Login::Login');
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
$routes->get('/printbarcode/(:any)/(:any)', ($session->get('role')) ? 'Barangmasuk::BarcodeGenerate/$1/$2' : 'Login::Login');
$routes->delete('/returbarang/(:num)', ($session->get('role')) ? 'Barangmasuk::ReturBarang/$1' : 'Login::Login');
$routes->delete('/cancelbarang/(:num)', ($session->get('role')) ? 'Barangmasuk::CancelBarang/$1' : 'Login::Login');
$routes->get('/ajaxdetailpembelian', ($session->get('role')) ? 'Barangmasuk::pembelian_detail_read' : 'Login::Login');
$routes->post('/ajaxpembayaran', ($session->get('role')) ? 'Barangmasuk::Pembayaran_beli' : 'Login::Login');
$routes->get('/editdetail', ($session->get('role')) ? 'Barangmasuk::GetDataDetail' : 'Login::Login');
// $routes->get('/selesaipembayaran', ($session->get('role')) ? 'Barangmasuk::SelesaiPembayaran' : 'Login::Login');
// $routes->post('/editdataform', ($session->get('role')) ? 'Barangmasuk::EditDataPost' : 'Login::Login');
$routes->get('/deletepembayaran', ($session->get('role')) ? 'Barangmasuk::DeletePembayaran' : 'Login::Login');
$routes->get('/modalbarcode', ($session->get('role')) ? 'Barangmasuk::ModalBarcode' : 'Login::Login');
$routes->get('/detailbarcode', ($session->get('role')) ? 'Barangmasuk::DetailBarcode' : 'Login::Login');
$routes->POST('/pilihkelompok', ($session->get('role')) ? 'Barangmasuk::PilihKelompok' : 'Login::Login');
$routes->get('/tampilform', ($session->get('role')) ? 'Barangmasuk::TampilForm' : 'Login::Login');
$routes->get('/inputretursales', ($session->get('role')) ? 'Barangmasuk::InputReturSales' : 'Login::Login');
$routes->get('/inputbahan24k', ($session->get('role')) ? 'Barangmasuk::InputBahan' : 'Login::Login');

$routes->get('/pindahindata', ($session->get('role')) ? 'PindahBarang::HomePindah' : 'Login::Login');


//--------------------------BarangKeluar---------------------------
$routes->get('/tampilpenjualan', ($session->get('role')) ? 'Barangkeluar::TampilPenjualan' : 'Login::Login');
$routes->get('/tampildetailpenjualan', ($session->get('role')) ? 'Barangkeluar::penjualan_read' : 'Login::Login');
$routes->get('/barangkeluar', ($session->get('role')) ? 'Barangkeluar::DataPenjualan' : 'Login::Login');
$routes->get('/jualbarang', ($session->get('role')) ? 'Barangkeluar::PenjualanBarang' : 'Login::Login');
$routes->post('/insertcustomer', ($session->get('role')) ? 'Barangkeluar::InsertCust' : 'Login::Login');
$routes->post('/kodebarang', ($session->get('role')) ? 'Barangkeluar::InsertJual' : 'Login::Login');
$routes->post('/returcust', ($session->get('role')) ? 'Barangkeluar::ReturCust' : 'Login::Login');
// $routes->get('/tampilretur', ($session->get('role')) ? 'Barangkeluar::penjualan_retur' : 'Login::Login');
// $routes->get('/returcustomer', ($session->get('role')) ? 'Barangkeluar::penjualan_retur' : 'Login::Login');
$routes->POST('/bayarretur', ($session->get('role')) ? 'Barangkeluar::Pembayaran_Retur' : 'Login::Login');
$routes->POST('/gantiretur', ($session->get('role')) ? 'Barangkeluar::GantiBarangRetur' : 'Login::Login');
$routes->get('/deletedetailjual', ($session->get('role')) ? 'Barangkeluar::DeleteDetailjual' : 'Login::Login');
$routes->get('/deletedetailjualretur', ($session->get('role')) ? 'Barangkeluar::DeleteDetailjualRetur' : 'Login::Login');
$routes->get('/datadetailretur', ($session->get('role')) ? 'Barangkeluar::DataDetailRetur' : 'Login::Login');
$routes->get('/draftpenjualan/(:any)', ($session->get('role')) ? 'Barangkeluar::DraftPenjualan/$1' : 'Login::Login');
$routes->get('/batalpenjualan', ($session->get('role')) ? 'Barangkeluar::BatalPenjualan' : 'Login::Login');
$routes->post('/ubahharga', ($session->get('role')) ? 'Barangkeluar::UbahHarga' : 'Login::Login');
$routes->post('/ubahhargaretur', ($session->get('role')) ? 'Barangkeluar::UbahHargaRetur' : 'Login::Login');
$routes->get('/ajaxdetailpenjualan', ($session->get('role')) ? 'Barangkeluar::penjualan_detail_read' : 'Login::Login');
$routes->post('/ajaxpembayaranjual', ($session->get('role')) ? 'Barangkeluar::Pembayaran_jual' : 'Login::Login');
$routes->get('/printinvoice/(:any)', ($session->get('role')) ? 'Barangkeluar::PrintInvoice/$1' : 'Login::Login');
$routes->get('/detailpenjualan/(:any)', ($session->get('role')) ? 'Barangkeluar::DetailDataPenjualan/$1' : 'Login::Login');
$routes->get('/tampilcust', ($session->get('role')) ? 'Barangkeluar::TampilCustomer' : 'Login::Login');
$routes->get('/checkcust', ($session->get('role')) ? 'Barangkeluar::CheckCustomer' : 'Login::Login');
$routes->get('/ubahketjual', ($session->get('role')) ? 'Barangkeluar::UbahKeterangan' : 'Login::Login');

//------------------buyback----------------
$routes->get('/buybackcust', ($session->get('role')) ? 'BuybackCust::BuyBack' : 'Login::Login');
$routes->get('/halamanbuyback', ($session->get('role')) ? 'BuybackCust::HalamanTambah' : 'Login::Login');
$routes->post('/scantrans', ($session->get('role')) ? 'BuybackCust::Cari_notrans' : 'Login::Login');
$routes->get('/tampilbuyback', ($session->get('role')) ? 'BuybackCust::TampilBuyback' : 'Login::Login');
$routes->get('/tampilbuybacktable', ($session->get('role')) ? 'BuybackCust::TampilBuybackTable' : 'Login::Login');
$routes->get('/tampildatabuyback', ($session->get('role')) ? 'BuybackCust::TampilDataBuyback' : 'Login::Login');
$routes->post('/tambahbuyback', ($session->get('role')) ? 'BuybackCust::TambahBuyback' : 'Login::Login');
$routes->post('/tambahbuybacknonota', ($session->get('role')) ? 'BuybackCust::TambahBuybackNonota' : 'Login::Login');
$routes->get('/draftbuyback/(:any)', ($session->get('role')) ? 'BuybackCust::DraftBuyback/$1' : 'Login::Login');
$routes->post('/scanbarcode', ($session->get('role')) ? 'BuybackCust::ScanBarcodeData' : 'Login::Login');
$routes->get('/deletedetailbuyback', ($session->get('role')) ? 'BuybackCust::DeleteDetailBuyback' : 'Login::Login');
$routes->post('/pembayaranform', ($session->get('role')) ? 'BuybackCust::PembayaranBuyback' : 'Login::Login');
$routes->get('/batalbuyback/(:any)', ($session->get('role')) ? 'BuybackCust::BatalBuyback/$1' : 'Login::Login');
$routes->get('/modalbarcodebb', ($session->get('role')) ? 'BuybackCust::ModalBarcode' : 'Login::Login');
$routes->get('/tampilcustbb', ($session->get('role')) ? 'BuybackCust::TampilCustomer' : 'Login::Login');
$routes->get('/detailbuyback/(:any)', ($session->get('role')) ? 'BuybackCust::DetailBuyback/$1' : 'Login::Login');
$routes->get('/formnonota', ($session->get('role')) ? 'BuybackCust::FormNoNota' : 'Login::Login');
$routes->get('/databayarbuyback', ($session->get('role')) ? 'BuybackCust::DataBayarBuyback' : 'Login::Login');



$routes->get('/modaldetail', ($session->get('role')) ? 'ModalDetail::ModalDetail' : 'Login::Login');

//-----------------------------ubah----------------------------------
$routes->get('/ubahberat', ($session->get('role')) ? 'BuybackCust::UbahBerat' : 'Login::Login');
$routes->get('/ubahket', ($session->get('role')) ? 'BuybackCust::UbahKet' : 'Login::Login');

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
$routes->get('/tampildatalebur', ($session->get('role')) ? 'BarangLebur::TampilDataLebur' : 'Login::Login');


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
$routes->get('/ubahstatuslanjut', ($session->get('role')) ? 'BarangCuci::UbahStatusLanjut' : 'Login::Login');
$routes->get('/printnotacuci/(:any)', ($session->get('role')) ? 'BarangCuci::PrintNotaCuci/$1' : 'Login::Login');
$routes->get('/tampildatacuci', ($session->get('role')) ? 'BarangCuci::TampilDataCuci' : 'Login::Login');


//---------------------------------Retur-----------------------------------------
$routes->get('/dataretur', ($session->get('role')) ? 'BarangRetur::HomeRetur' : 'Login::Login');
$routes->get('/returbarang', ($session->get('role')) ? 'BarangRetur::ReturBarang' : 'Login::Login');
$routes->get('/draftretur/(:any)', ($session->get('role')) ? 'BarangRetur::DraftReturBarang/$1' : 'Login::Login');
$routes->get('/batalretur/(:any)', ($session->get('role')) ? 'BarangRetur::BatalRetur/$1' : 'Login::Login');
$routes->get('/tambahretur', ($session->get('role')) ? 'BarangRetur::TambahRetur' : 'Login::Login');
$routes->get('/hapusretur', ($session->get('role')) ? 'BarangRetur::DeleteRetur' : 'Login::Login');
$routes->get('/modalprintretur', ($session->get('role')) ? 'BarangRetur::ModalRetur' : 'Login::Login');
$routes->post('/selesairetur', ($session->get('role')) ? 'BarangRetur::SelesaiRetur' : 'Login::Login');
$routes->get('/printnotaretur/(:any)', ($session->get('role')) ? 'BarangRetur::PrintNotaRetur/$1' : 'Login::Login');
$routes->get('/ubahstatuslanjutretur', ($session->get('role')) ? 'BarangRetur::UbahStatusLanjut' : 'Login::Login');
$routes->get('/tampildataretur', ($session->get('role')) ? 'BarangRetur::TampilDataRetur' : 'Login::Login');

// $routes->get('/leburbarang/(:any)', ($session->get('role')) ?'BarangRetur::TampilLeburBarang/$1': 'Login::Login');
$routes->get('/detailbarang', ($session->get('role')) ? 'BarangRetur::DataDetailBarang' : 'Login::Login');


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
$routes->POST('/insertjenis', ($session->get('role')) ? 'MasterInput::InsertJenis' : 'Login::Login');
$routes->POST('/insertuser', ($session->get('role')) ? 'MasterInput::InsertUser' : 'Login::Login');
$routes->POST('/insertukang', ($session->get('role')) ? 'MasterInput::InsertTukang' : 'Login::Login');
$routes->POST('/insertakun', ($session->get('role')) ? 'MasterInput::InsertAkun' : 'Login::Login');

// $routes->POST('/hapusdata', 'MasterInput::HapusData');
$routes->get('/isidata', ($session->get('role')) ? 'MasterInput::DataMaster' : 'Login::Login');
// }

//----------------------------------Transaksi-------------------------------------
$routes->get('/transaksiharian', ($session->get('role')) ? 'Transaksi::DataTransaksi' : 'Login::Login');
$routes->POST('/tambahinput', ($session->get('role')) ? 'Transaksi::TambahInput' : 'Login::Login');
$routes->get('/tampiltrans', ($session->get('role')) ? 'Transaksi::TampilTransaksi' : 'Login::Login');
$routes->get('/printtransaksi/(:any)/(:any)', ($session->get('role')) ? 'Transaksi::PrintTransaksi/$1/$2' : 'Login::Login');

//--------------------------------MasterUpdate----------------------------------------------
$routes->get('/updatepembelian', ($session->get('role')) ? 'MasterUpdate::UpdatePembelian' : 'Login::Login');
$routes->post('/editpembelian', ($session->get('role')) ? 'MasterUpdate::EditPembelian' : 'Login::Login');
$routes->get('/dataupdatedetailpembelian', ($session->get('role')) ? 'MasterUpdate::DataUpdateDetailPembelian' : 'Login::Login');
$routes->get('/tampilpembelian_u', ($session->get('role')) ? 'MasterUpdate::TampilPembelian' : 'Login::Login');
$routes->get('/detailpembelian_u/(:any)', ($session->get('role')) ? 'MasterUpdate::DetailPembelianSupp/$1' : 'Login::Login');
$routes->get('/updatedata', ($session->get('role')) ? 'MasterUpdate::UpdateData' : 'Login::Login');

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
