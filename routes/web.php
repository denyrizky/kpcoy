<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Route::group(['prefix' => 'auth'], function () {
    Auth::routes();
});

Route::group(['prefix' => 'excel', 'as' => 'excel.barang.', 'middleware' => 'auth'], function () {
    Route::group(['prefix' => 'barang'], function () {
        Route::get('/export', 'Commodities\CommodityExportImportController@export')->name('export');
        Route::post('/import', 'Commodities\CommodityExportImportController@import')->name('import');
    });
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    Route::get('/settings', "SettingController@index")->name('settings');
    Route::post('/settings', "SettingController@simpan")->name('settings.simpan');

    Route::get('getDataChart', "HomeController@getChart")->name('getChart');

    Route::group(['prefix' => 'barang', 'as' => 'barang.'], function () {
        Route::get('/print', 'Commodities\PdfController@generatePdf')->name('print');
        Route::get('/print/{id}', "Commodities\PdfController@generatePdfOne")->name('print.one');
    });
    Route::resource('barang', 'CommodityController');
    Route::get('/dashboard', 'HomeController@index')->name('home');
    Route::resource('/barang', 'Commodities\CommodityController');
    Route::resource('/bantuan-dana-operasional', 'SchoolOperationalAssistances\SchoolOperationalAssistance');
    Route::resource('/ruang', 'CommodityLocations\CommodityLocationController');

    // Route::get('/barangKeluar', [BarangKeluarController::class, 'index']);
    Route::resource('/commodities/json', 'Commodities\Ajax\CommodityAjaxController');
    Route::resource('/school-operational/json', 'SchoolOperationalAssistances\Ajax\SchoolOperationalAssistanceAjaxController');
    Route::resource('/commodity-locations/json', 'CommodityLocations\Ajax\CommodityLocationAjaxController');

    Route::resource('/trx_barang', 'Transaksi\TrxController');
    Route::resource('/BarangMaster', 'BarangMaster\BarangMasterController');
    Route::resource('/det_trx_barang', 'kelola\trx_kelola_barangController');
    Route::post('KelolaBarang/simpan', 'kelola\trx_kelola_barangController@store');
    Route::get('KelolaBarang/getDetail/{id}', 'Kelola\trx_kelola_barangController@getDetail');
    Route::resource('laporan', 'laporanController');
    Route::get('cetak/pertanggal/{tglawal}/{tglakhir}/{status}','laporanController@cetak');
    //Route::post('/BarangMaster/json','BarangMaster\BarangMasterController@store')->name('product.store');  

    
});