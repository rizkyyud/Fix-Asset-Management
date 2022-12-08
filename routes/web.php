<?php

use App\Http\Controllers\AssetsTController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangOutController;
use App\Http\Controllers\Controller_Assets;
use App\Http\Controllers\Controller_BarangIn;
use App\Http\Controllers\Controller_barangIven;
use App\Http\Controllers\Controller_Cart;
use App\Http\Controllers\Controller_Dashboard;
use App\Http\Controllers\Controller_Gudang;
use App\Http\Controllers\Controller_HargaSewa;
use App\Http\Controllers\Controller_Inventaris;
use App\Http\Controllers\Controller_jenisIven;
use App\Http\Controllers\Controller_Kategori;
use App\Http\Controllers\Controller_Keranjang;
use App\Http\Controllers\Controller_KlasB;
use App\Http\Controllers\Controller_Klass;
use App\Http\Controllers\Controller_Label;
use App\Http\Controllers\Controller_Login;
use App\Http\Controllers\Controller_Lokasi;
use App\Http\Controllers\Controller_Merk;
use App\Http\Controllers\Controller_Model;
use App\Http\Controllers\Controller_OrderAma;
use App\Http\Controllers\Controller_Orders;
use App\Http\Controllers\Controller_Pemilik;
use App\Http\Controllers\Controller_Pembelian;
use App\Http\Controllers\Controller_Sewa;
use App\Http\Controllers\Controller_subLokasi;
use App\Http\Controllers\Controller_ValidOrder;
use App\Http\Controllers\Controller_Vendors;
use App\Http\Controllers\Controller_Warehouse;
use App\Http\Controllers\Controller_Warna;

use App\Http\Controllers\CrudController;
use App\Http\Controllers\JnsTransportController;
use App\Http\Controllers\PenyewaanController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\reportReservController;
use App\Http\Controllers\ReqPesananController;
use App\Http\Controllers\testingController;
use App\Http\Controllers\ValidOrdController;
use App\Http\Controllers\viaController;
use App\Models\assetsT;
use App\Models\BarangOut;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::post('masuk/', [Controller_Login::class, 'authenticate']);

Route::middleware(['CekLogin'])->group(function () {
    Route::resource('dashboard', Controller_Dashboard::class);
    Route::get('logout', [Controller_Login::class, 'logout']);

    // Lokasi Route
    Route::resource('lokasi', Controller_Lokasi::class);
    Route::get('lokasi/cek/{id}', [Controller_Lokasi::class, 'cekEditLok']);
    Route::get('lokasi/getSub/{id}', [Controller_Lokasi::class, 'getSubLokasi']);
    Route::post('lokasi/storeMedia', [Controller_Lokasi::class, 'storeMedia']);
    Route::get('dokLok/load/{id}', [Controller_Lokasi::class, 'loadDokLokasi']);
    Route::get('lokasi/load/{id}', [Controller_Lokasi::class, 'loadLokasi']);
    Route::post('lokasi/in', [Controller_Lokasi::class, 'lokasiIn']);
    Route::get('lokasiE/load/{id}', [Controller_Lokasi::class, 'loadEditLokasi']);
    Route::get('lokasiE/{id}', [Controller_Lokasi::class, 'editLokasi']);
    Route::get('del/lokasi/{id}', [Controller_Lokasi::class, 'destroyLokasi']);
    Route::get('del/dokLokasi/{id}', [Controller_Lokasi::class, 'destroyDokLok']);

    // Sub Lokasi Route
    Route::get('subL/load/{id}', [Controller_Lokasi::class, 'loadSubL']);
    Route::get('subL/cek/{id}', [Controller_Lokasi::class, 'cekEditSub']);
    Route::get('dokSubLok/load/{id}', [Controller_Lokasi::class, 'loadDokSubL']);
    Route::post('subLokasi/storeMedia', [Controller_Lokasi::class, 'storeMediaSub']);
    Route::post('subL/in', [Controller_Lokasi::class, 'sublokasiIn']);
    Route::get('del/subL/{id}', [Controller_Lokasi::class, 'destroySubL']);
    Route::get('subLokasiE/load/{id}', [Controller_Lokasi::class, 'loadEditSubL']);
    Route::get('subLokasiE/{id}', [Controller_Lokasi::class, 'editSubL']);
    Route::get('del/dokSubLok/{id}', [Controller_Lokasi::class, 'destroyDokSubL']);

    // Kategori Route
    Route::resource('kategori', Controller_Kategori::class);
    Route::get('kategori/cek/{id}', [Controller_Kategori::class, 'cekEdit']);
    Route::get('kategori/load/{id}', [Controller_Lokasi::class, 'loadKategori']);
    Route::post('kategori/in', [Controller_Lokasi::class, 'kateIn']);
    Route::get('kategoriE/load/{id}', [Controller_Lokasi::class, 'loadEditKategori']);
    Route::get('del/kategori/{id}', [Controller_Lokasi::class, 'destroyKategori']);
    Route::get('kategoriE/{id}', [Controller_Lokasi::class, 'editKategori']);

    // Pemilik Route
    Route::resource('pemilik', Controller_Pemilik::class);
    Route::get('pemilik/cek/{id}', [Controller_Pemilik::class, 'cekEdit']);
    Route::get('pemilik/load/{id}', [Controller_Lokasi::class, 'loadPemilik']);
    Route::post('pemilik/in', [Controller_Lokasi::class, 'pemilikIn']);
    Route::get('pemilikE/load/{id}', [Controller_Lokasi::class, 'loadEditPemilik']);
    Route::get('pemilikE/{id}', [Controller_Lokasi::class, 'editPemilik']);
    Route::get('del/pemilik/{id}', [Controller_Lokasi::class, 'destroyPemilik']);

    // Assets Route
    Route::get('assets/load/{id}', [Controller_Assets::class, 'loadAssets']);
    Route::get('assetsD/load/{id}', [Controller_Assets::class, 'loadDetailAsset']);
    Route::get('assets/getTime/{id}', [Controller_Assets::class, 'getTime']);
    Route::get('subAsset/load/{id}', [Controller_Assets::class, 'loadSubAssets']);
    Route::get('subAsset/getAll/{id}', [Controller_Assets::class, 'getAllSub']);
    Route::get('subAsset/getLoad/{id}', [Controller_Assets::class, 'getSubAssets']);
    Route::get('subAsset/inAsset/{id}', [Controller_Assets::class, 'Get_Sub_InAsset']);
    Route::get('dokSubA/load/{id}', [Controller_Assets::class, 'loadSubADok']);
    Route::get('getAssetSub/load/{id}', [Controller_Assets::class, 'loadAssetSub']);
    Route::get('dokumen/load/{id}', [Controller_Assets::class, 'loadDokumen']);
    Route::get('assets/cekUp/{id}', [Controller_Assets::class, 'cekUpAsset']);
    Route::get('assets/cek/{id}', [Controller_Assets::class, 'cekAsset']);
    Route::get('assets/valid/{id}', [Controller_Assets::class, 'validBarang']);
    Route::post('assets/pindah', [Controller_Assets::class, 'pindahBarang']);

    Route::post('assets/in', [Controller_Assets::class, 'store']);
    Route::post('assets/Edit', [Controller_Assets::class, 'update']);
    Route::resource('assetsB', Controller_Assets::class);
    Route::get('assets/getLabel/{id}', [Controller_Assets::class, 'getLabel']);
    Route::get('subAsset/getLabel/{id}', [Controller_Assets::class, 'getSubLabel']);
    Route::get('assets/getItem/{id}', [Controller_Assets::class, 'getRepotItem']);
    Route::get('subAsset/getItem/{id}', [Controller_Assets::class, 'getSubItem']);
    Route::get('getSubL/{id_lokasi}', [Controller_Assets::class, 'getSubL']);
    Route::post('/assetsB/storeMedia', [Controller_Assets::class, 'storeMedia']);
    Route::post('/subAsset/storeMedia', [Controller_Assets::class, 'storeMediaSub']);


    Route::get('label/masuk/{id}', [Controller_Assets::class, 'masukBarang']);
    Route::get('label/keluar/{id}', [Controller_Assets::class, 'keluarBarang']);
    Route::get('asset/masuk/{id}', [Controller_Assets::class, 'barangMasuk']);
    Route::get('asset/keluar/{id}', [Controller_Assets::class, 'barangKeluar']);
    Route::post('assetsB/up/{id_assets}', [Controller_Assets::class, 'update']);
    Route::get('del/assets/{id}', [Controller_Assets::class, 'destroy']);
    Route::get('assetsB/delfoto/{name}', [Controller_Assets::class, 'delfoto']);
    Route::get('assetsB/clear/{id}', [Controller_Assets::class, 'clearTemp']);
    Route::post('subAsset/in', [Controller_Assets::class, 'storeSubAsset']);
    Route::post('subAsset/edit/{id}', [Controller_Assets::class, 'updateSubAsset']);
    Route::get('del/subAsset/{id}', [Controller_Assets::class, 'destroySub']);
    Route::get('del/dok/{id}', [Controller_Assets::class, 'destroyDok']);
    Route::get('del/subAssetdok/{id}', [Controller_Assets::class, 'destroySubDok']);

    // KLasifikasi Route
    Route::resource('klasB', Controller_KlasB::class);
    Route::resource('klassBarang', Controller_Klass::class);
    Route::get('kelasB/load/{id}', [Controller_KlasB::class, 'loadKlsB']);
    Route::post('storeKls/masuk', [Controller_KlasB::class, 'storeKlasB']);
    Route::get('del/klasB/{id}', [Controller_KlasB::class, 'destroyKls']);
    Route::get('edit/klasB/{id}', [Controller_KlasB::class, 'loadEditKls']);
    Route::get('editIn/klasB/{id}', [Controller_KlasB::class, 'editKls']);

    // Transport Route
    Route::resource('transport', JnsTransportController::class);
    Route::get('jnsTrnsprt', [JnsTransportController::class, 'getJnsTrnsprt']);
    Route::get('jnsTrnsprt/getById/{id}', [JnsTransportController::class, 'getJnsById']);
    Route::post('jnsKdr/in', [JnsTransportController::class, 'jnsKdrIn']);
    Route::post('jnsKdr/edit', [JnsTransportController::class, 'jnsKdrEdit']);
    Route::post('jnsKdr/del', [JnsTransportController::class, 'jnsKdrDel']);
    
    Route::get('supir', [JnsTransportController::class, 'getSupir']);
    Route::get('supir/getById/{id}', [JnsTransportController::class, 'getSupirById']);
    Route::post('supir/in', [JnsTransportController::class, 'supirIn']);
    Route::post('supir/edit', [JnsTransportController::class, 'supirEdit']);
    Route::post('supir/del', [JnsTransportController::class, 'supirDel']);

    Route::get('supir/getStatus', [JnsTransportController::class, 'getStatus']);
    Route::get('supir/getStatusById/{id}', [JnsTransportController::class, 'getStatusById']);
    Route::post('supir/statusIn', [JnsTransportController::class, 'statusIn']);
    Route::post('supir/statusEdit', [JnsTransportController::class, 'statusEdit']);
    Route::post('supir/statusDel', [JnsTransportController::class, 'statusDel']);

    Route::get('supir/getBBM', [JnsTransportController::class, 'getBBM']);
    Route::get('supir/getBBmById/{id}', [JnsTransportController::class, 'getBBmById']);
    Route::post('supir/BBmIn', [JnsTransportController::class, 'BBmIn']);
    Route::post('supir/BBmEdit', [JnsTransportController::class, 'bbmEdit']);
    Route::post('supir/BBmDel', [JnsTransportController::class, 'bbmDel']);

    // Input Asset Transport
    Route::resource('assetsT', AssetsTController::class);
    Route::get('getAssetsT', [AssetsTController::class, 'getAssetsT']);
    Route::get('getAssetsT/ById/{id}', [AssetsTController::class, 'getAssetsTByID']);
    Route::post('assetsT/in', [AssetsTController::class, 'store']);

    // Jenis Route
    Route::get('jenis/load/{id}', [Controller_KlasB::class, 'jenisLoad']);
    Route::get('editJ/{id}', [Controller_KlasB::class, 'loadEditJ']);
    Route::post('jenis/in', [Controller_KlasB::class, 'storeJenis']);
    Route::get('jenisE/{id}', [Controller_KlasB::class, 'jenisE']);
    Route::get('del/jenis/{id}', [Controller_KlasB::class, 'destroyJenis']);

    // Kategori Barang Route
    Route::get('kateBarang/load/{id}', [Controller_KlasB::class, 'barangLoad']);
    Route::get('kateBarang/cek/{id}', [Controller_KlasB::class, 'cek_Kategori']);
    Route::get('barang/load/{id}', [Controller_KlasB::class, 'loadBarang']);
    Route::post('barangKate/in', [Controller_KlasB::class, 'storeBarang']);
    Route::get('barang/editL/{id}', [Controller_KlasB::class, 'loadEditBarang']);
    Route::get('barang/editIn/{id}', [Controller_KlasB::class, 'editBarang']);
    Route::get('jenis/drop/{id}', [Controller_KlasB::class, 'jenisDrop']);
    Route::get('del/barang/{id}', [Controller_KlasB::class, 'destroyBarang']);

    // Route Vendors
    Route::resource('vendors', Controller_Vendors::class);
    Route::get('vendor/cek/{id}', [Controller_Vendors::class, 'cekVendor']);
    Route::get('vendor/load/{id}', [Controller_Vendors::class, 'loadVendors']);
    Route::post('vendors/in', [Controller_Vendors::class, 'store']);
    Route::get('vendor/get/{id}', [Controller_Vendors::class, 'getVendor']);
    Route::post('vendors/up/{id}', [Controller_Vendors::class, 'update']);
    Route::get('del/vendor/{id}', [Controller_Vendors::class, 'destroy']);


    // Nama Barang Route
    Route::post('barang/in', [Controller_Model::class, 'barangIn']);
    Route::get('barang/get/{id}', [Controller_Model::class, 'barangGet']);
    Route::get('filter/barang/{id}', [Controller_Model::class, 'filterBarang']);
    Route::get('barang/edit/{id}', [Controller_Model::class, 'barangEdit']);
    Route::get('barang/del/{id}', [Controller_Model::class, 'destroyBarang']);

    // Model Route
    Route::resource('modelB', Controller_Model::class);
    Route::get('modelB/load/{id}', [Controller_Model::class, 'loadModel']);
    Route::get('modelE/load/{id}', [Controller_Model::class, 'loadEditModel']);
    Route::post('modelB/in', [Controller_Model::class, 'modelIn']);
    Route::get('modelEdit/{id}', [Controller_Model::class, 'modelEdit']);
    Route::get('del/model/{id}', [Controller_Model::class, 'destroyModel']);

    // Merk Route
    Route::get('merk/load/{id}', [Controller_Model::class, 'loadMerk']);
    Route::get('merkE/load/{id}', [Controller_Model::class, 'loadEditMerk']);
    Route::post('merk/in', [Controller_Model::class, 'merkIn']);
    Route::get('merkEdit/{id}', [Controller_Model::class, 'merkEdit']);
    Route::get('del/merk/{id}', [Controller_Model::class, 'destroyMerk']);

    // Warna Route
    Route::get('warna/load/{id}', [Controller_Model::class, 'loadWarna']);
    Route::post('warna/in', [Controller_Model::class, 'warnaIn']);
    Route::get('warnaE/load/{id}', [Controller_Model::class, 'loadEditWarna']);
    Route::get('warnaEdit/{id}', [Controller_Model::class, 'warnaEdit']);
    Route::get('del/warna/{id}', [Controller_Model::class, 'destroyWarna']);

    // Cart Route
    Route::resource('cart', Controller_Cart::class);
    Route::get('cartLoad/detail/{id}', [Controller_Cart::class, 'getDetail']);
    Route::get('cartDok/get/{id}', [Controller_Cart::class, 'getDok']);
    // Route::get('cart/{id_cart}', [Controller_Cart::class, 'index']);
    Route::post('cart/list/{id_cart}', [Controller_Cart::class, 'list']);
    Route::get('cart/listB/{id_cart}', [Controller_Cart::class, 'listBarang']);
    Route::get('cart/item/{id_cart}', [Controller_Cart::class, 'getItems']);
    Route::post('cart/add/{id}', [Controller_Cart::class, 'add']);
    Route::post('cart/add', [Controller_Cart::class, 'cartIn']);
    Route::get('cart/brg/{id}', [Controller_Cart::class, 'nama_barang']);
    Route::get('cart/reqAma/{id}', [Controller_Cart::class, 'ReqList']);
    Route::get('cart/load/{id}', [Controller_Cart::class, 'loadCart']);
    Route::get('cart/del/{id_cart}', [Controller_Cart::class, 'destroy']);
    Route::post('/cart/storeMedia', [Controller_Cart::class, 'storeMedia']);
    Route::get('delDok/ord/{id}', [Controller_Cart::class, 'destroyDok']);

    // Pesanan Route
    Route::post('/orders/foto', [Controller_Orders::class, 'storeMedia'])->name('orders.storeMedia');
    Route::get('orders/delfoto/{name}', [Controller_Orders::class, 'delfoto']);
    Route::post('orders/up/{id_orders}', [Controller_Orders::class, 'update']);
    Route::get('orders/del/{id_orders}', [Controller_Orders::class, 'destroy']);
    Route::get('orders/getVendor/{id}', [Controller_Orders::class, 'getVendors']);

    // Pesanan New Route
    Route::resource('pesanan', PesananController::class);
    Route::post('pesanan/in', [PesananController::class, 'itemAdd']);
    Route::post('pesanan/req', [PesananController::class, 'reqPesanan']);
    Route::get('pesanan/wishList/{id}', [PesananController::class, 'getWishList']);
    Route::get('pesanan/List/{id}', [PesananController::class, 'getList']);
    Route::get('allOrd', [PesananController::class, 'allOrd']);
    Route::get('pesanan/allList/{id}', [PesananController::class, 'getListAll']);
    Route::get('pesanan/cartItem/{id}', [PesananController::class, 'getCartItem']);
    Route::get('pesanan/getTotalCost/{id}', [PesananController::class, 'getTotalCost']);
    Route::get('pesanan/getVendor/{id}', [PesananController::class, 'getVendor']);
    Route::get('pesanan/getVendorDrp/{id}', [PesananController::class, 'getVendorDrp']);
    Route::get('pesanan/detailOrd/{id}', [PesananController::class, 'detailOrd']);
    Route::get('delete/wishList/{id}', [PesananController::class, 'destroyWish']);

    // Check Route
    Route::resource('orderAma', Controller_OrderAma::class);
    Route::get('orders/beli/{id}', [Controller_OrderAma::class, 'beli']);
    Route::get('orders/valid/{id}', [Controller_OrderAma::class, 'valid']);
    Route::get('orders/stat/{id}', [Controller_OrderAma::class, 'stat']);
    Route::post('orders/Ama/{id}', [Controller_OrderAma::class, 'editAma']);
    Route::post('orders/rev/{id}', [Controller_OrderAma::class, 'revisi']);
    Route::get('getVendor/{id}', [Controller_OrderAma::class, 'getVendors']);

    // List Pesanan
    Route::resource('listPesanan', ReqPesananController::class);
    Route::get('listPesanan/get', [ReqPesananController::class, 'show']);
    Route::get('listPesanan/history/{id}', [ReqPesananController::class, 'history']);
    Route::get('listPesanan/historyByPass/{id}', [ReqPesananController::class, 'historyByPas']);
    Route::get('listPesanan/item/{id}', [ReqPesananController::class, 'getItem']);
    Route::get('listPesanan/cekUp/{id}', [ReqPesananController::class, 'cekUp']);
    Route::get('listPesanan/reqVal/{id}', [ReqPesananController::class, 'reqValidasi']);
    Route::get('listPesanan/beli/{id}', [ReqPesananController::class, 'beli']);

    // Valid Pesanan Route
    Route::resource('validOrder', ValidOrdController::class);
    Route::get('validOrder/get', [ValidOrdController::class, 'show']);
    Route::get('validO/ok/{id}', [ValidOrdController::class, 'approve']);
    Route::get('validO/okAll/{id}', [ValidOrdController::class, 'approveAll']);
    Route::get('validO/getTtd/{id}', [ValidOrdController::class, 'getAllTtd']);
    Route::get('validO/getPoTabel/{id}', [ValidOrdController::class, 'getPoTabel']);
    Route::get('validO/rej/{id}', [ValidOrdController::class, 'reject']);
    // Route::get('validO/cancel/{id}', [Controller_ValidOrder::class, 'cancel']);

    // Route Pembelian Barang
    Route::resource('pembelian', Controller_Pembelian::class);
    Route::get('pembelian/load/{id}', [Controller_Pembelian::class, 'loadPembelian']);
    Route::get('pembelian/list/{id}', [Controller_Pembelian::class, 'listPenambahan']);
    Route::post('pembelian/in', [Controller_Pembelian::class, 'addItem']);
    Route::post('pembelian/req', [Controller_Pembelian::class, 'reqPesanan']);

    // Route Barang IN
    Route::resource('barangIn', Controller_BarangIn::class);
    Route::post('barangIn/up', [Controller_BarangIn::class, 'insertBarang']);
    Route::get('barangIn/load/{id}', [Controller_BarangIn::class, 'loadJs']);
    Route::get('barangIn/kode/{id}', [Controller_BarangIn::class, 'loadKode']);
    Route::get('histori/load/{id}', [Controller_BarangIn::class, 'historiLoad']);
    Route::get('barangIn/assets/{id}', [Controller_BarangIn::class, 'loadAssets']);

    Route::get('detail/ord/{id}', [Controller_BarangIn::class, 'detailOrd']);

    Route::resource('barangOut', BarangOutController::class);
    Route::get('barangOut/getAsset/{id}', [BarangOutController::class, 'getAsset']);
    Route::post('barangOut/up', [BarangOutController::class, 'insertBarang']);
    Route::get('barangOut/load/{id}', [BarangOutController::class, 'getBarangOut']);
    Route::post('barangOut/store', [BarangOutController::class, 'setBarangOut']);
    Route::get('barangOut/getLebel/{id}', [BarangOutController::class, 'getLabel']);
    Route::get('historiOut/load/{id}', [BarangOutController::class, 'historiLoad']);
    Route::get('barangOut/assets/{id}', [BarangOutController::class, 'loadAssets']);

    Route::resource('gudang', Controller_Gudang::class);
    Route::get('label/{id}', [Controller_Gudang::class, 'getLabel']);

    Route::resource('label', Controller_Label::class);
    Route::get('label/load/{id}', [Controller_Label::class, 'labelLoad']);

    // Controller Pembuatan Sewa
    Route::resource('sewa', Controller_Sewa::class);
    Route::get('sewa/list/{id}', [Controller_Sewa::class, 'listSewa']);
    Route::post('sewa/add/{id}', [Controller_Sewa::class, 'add']);
    Route::get('sewa/item/{id}', [Controller_Sewa::class, 'getGedung']);

    // Controller Harga Sewa
    Route::resource('harga_sewa', Controller_HargaSewa::class);
    Route::get('getAssets/{id}', [Controller_HargaSewa::class, 'getAssets']);
    Route::get('getVilla/{id}', [Controller_HargaSewa::class, 'getVilla']);
    Route::get('hargaG/load/{id}', [Controller_HargaSewa::class, 'loadG']);
    Route::post('harga/gedung', [Controller_HargaSewa::class, 'storeGdg']);
    Route::get('hargaG/del/{id}', [Controller_HargaSewa::class, 'destroy']);

    Route::post('seasson/Add', [Controller_HargaSewa::class, 'addSeasson']);
    Route::post('sewa/addTanggal', [Controller_HargaSewa::class, 'addTanggal_Session']);
    Route::get('sewa/del/{id}', [Controller_HargaSewa::class, 'deleteSewa']);

    Route::get('seasson/load/{id}', [Controller_HargaSewa::class, 'getSeasson']);
    Route::get('session/range/{id}', [Controller_HargaSewa::class, 'getRangeSession']);
    Route::get('session/loadEdit/{id}', [Controller_HargaSewa::class, 'getEditSession']);
    Route::get('session/get/{id}', [Controller_HargaSewa::class, 'GET_SPECIFIC_SEASON']);
    Route::post('seasson/edit/{id}', [Controller_HargaSewa::class, 'editSeason']);
    Route::get('session/del/{id}', [Controller_HargaSewa::class, 'deleteSeason']);

    // Route::get('tanggal/load/{id}', [Controller_HargaSewa::class, 'getTanggal']);
    // Route::get('tanggal/get/{id}', [Controller_HargaSewa::class, 'GET_SPECIFIC_TANGGAL']);
    // Route::get('tanggal/cek/{id}', [Controller_HargaSewa::class, 'cekTanggal']);
    // Route::post('tanggal/edit/{id}', [Controller_HargaSewa::class, 'editTanggal']);
    // Route::get('tanggal/del/{id}', [Controller_HargaSewa::class, 'deleteTanggal']);

    // Reservasi
    Route::resource('reservasi', PenyewaanController::class);
    Route::post('reservasi/in', [PenyewaanController::class, 'store']);
    Route::post('reservasi/edit', [PenyewaanController::class, 'edit']);
    Route::post('reservasi/getData', [PenyewaanController::class, 'getDataReserv']);
    Route::post('reservasi/getCicil', [PenyewaanController::class, 'getDataCicil']);
    Route::get('reservasi/get/{id}', [PenyewaanController::class, 'getReservasi']);
    Route::get('reservasi/getById/{id}', [PenyewaanController::class, 'getReservById']);
    Route::get('reservasi/del/{id}', [PenyewaanController::class, 'delReservasi']);

    Route::post('penyewa/in', [PenyewaanController::class, 'addPenyewa']);
    Route::get('penyewa/get/{id}', [PenyewaanController::class, 'getPenyewa']);
    Route::get('penyewa/getId/{id}', [PenyewaanController::class, 'getPenyewaID']);
    Route::post('penyewa/edit', [PenyewaanController::class, 'editPenyewa']);
    Route::get('penyewa/del/{id}', [PenyewaanController::class, 'delPenyewa']);
    Route::get('harga/get/{id}', [PenyewaanController::class, 'getHarga']);
    Route::get('season/get/{id}', [PenyewaanController::class, 'getSeason']);

    Route::get('cekVilla/{id}', [PenyewaanController::class, 'cekKetersediaan']);
    Route::get('cekVillaEdit/{id}', [PenyewaanController::class, 'cekKetEdit']);

    // Via
    Route::resource('via', viaController::class);
    Route::post('viaP/in', [viaController::class, 'addVia']);
    Route::post('viaP/edit', [viaController::class, 'editVia']);
    Route::get('viaP/getId/{id}', [viaController::class, 'getViaById']);
    Route::get('viaP/getAll/{id}', [viaController::class, 'getViaAll']);
    Route::get('viaP/del/{id}', [viaController::class, 'delVia']);

    Route::post('via/in', [PenyewaanController::class, 'addVia']);
    Route::post('via/edit', [PenyewaanController::class, 'editVia']);
    Route::get('via/getId/{id}', [PenyewaanController::class, 'getViaById']);
    Route::get('via/getAll/{id}', [PenyewaanController::class, 'getViaAll']);
    Route::get('via/del/{id}', [PenyewaanController::class, 'delVia']);

    // Cicilan
    Route::post('cicil/in', [PenyewaanController::class, 'addCicilVil']);
    Route::post('cicil/getSisa', [PenyewaanController::class, 'getSisa']);
    Route::get('cicil/del/{id}', [PenyewaanController::class, 'delCicil']);
    Route::get('cicil/getInfo/{id}', [PenyewaanController::class, 'getCicilRe']);

    // Report Reservasi
    Route::resource('reportReserv', reportReservController::class);
    Route::get('reportReserv/get/{id}', [reportReservController::class, 'getCicilan']);
    Route::get('reportReserv/filter/{id}', [reportReservController::class, 'filter']);
    Route::get('reportReserv/filRes/{id}', [reportReservController::class, 'filterReserv']);
    Route::get('reportReserv/filBayar/{id}', [reportReservController::class, 'filterBayar']);

    Route::resource('tesWeb', testingController::class);
});
