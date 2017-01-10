<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    /*return view('welcome');*/
    $galery = App\galeries::all();
    return view('frontend.index', [
    		'galeries' => $galery,
    	]);
});



Auth::routes();

Route::get('/home', 'HomeController@home');

/*Route::get('/dashboard',function (){
		return view('backend.index');
	});*/

Route::group(['middleware' => ['role:Administrator,view_backend']], function () {
	
	Route::get('/data-stok-telur', 'TelurController@index');
	Route::post('/data-stok-telur', 'TelurController@store');
	Route::get('/data-stok-telur/{id}/update', 'TelurController@getData');
	Route::post('/data-stok-telur/{id}/update', 'TelurController@update');
	/*Route::get('/data-stok-telur/{id}/delete', 'TelurController@delete');*/
	Route::post('/delete/stok-telur', 'TelurController@delete');

	Route::get('/data-stok-ayam', 'AyamController@index');
	Route::post('/delete/stok-ayam', 'AyamController@delete');
	Route::get('/data-stok-ayam/{id}/update','AyamController@getData');
	Route::post('/data-stok-ayam/{id}/update','AyamController@update');

	Route::get('/data-produksi', 'ProduksiController@index');
	Route::post('/data-produksi', 'ProduksiController@store');
	/*Route::get('/data-produksi/{id}/delete', 'ProduksiController@delete');*/
	Route::get('/data-produksi/{id}/konfirmasi', 'ProduksiController@konfirmasi');
	Route::post('/data-produksi/{id}/konfirmasi', 'ProduksiController@validasi');
	Route::post('/delete/produksi', 'ProduksiController@delete');

	Route::get('/data-pemesanan/{id}/konfirmasi', 'PemesananController@getData');
	Route::post('/data-pemesanan/{id}/konfirmasi', 'PemesananController@konfirmasi');

	Route::get('/data-penjualan-telur', 'PenjualanTelurController@index');
	Route::post('/data-penjualan-telur', 'PenjualanTelurController@store');
	Route::get('/data-penjualan-telur/{id}/delete', 'PenjualanTelurController@delete');
	Route::post('/delete/penjualan-telur', 'PenjualanTelurController@delete');


	Route::get('/data-pembelian', 'PembelianController@index');
	Route::post('/data-pembelian', 'PembelianController@store');
	/*Route::get('/data-pembelian/{id}/delete', 'PembelianController@delete');*/
	Route::get('/data-pembelian/{id}/konfirmasi', 'PembelianController@getData');
	Route::post('/data-pembelian/{id}/konfirmasi', 'PembelianController@konfirmasi');
	Route::post('/delete/pembelian', 'PembelianController@delete');

	Route::get('/data-penjualan-ayam', 'PenjualanAyamController@index');
	Route::post('/data-penjualan-ayam', 'PenjualanAyamController@store');
	/*Route::get('/data-penjualan-ayam/{id}/delete', 'PenjualanAyamController@delete');*/
	Route::post('/delete/penjualan-ayam', 'PenjualanAyamController@delete');

	Route::get('/pemesanan/notifPemesanan', 'PemesananController@showNotifPemesanan');
	Route::get('/pemesanan/dataPemesanan', 'PemesananController@showDatasPemesanan');

	Route::get('/laporan-stok-telur', 'LaporanStokTelurController@index');
	Route::get('/laporan-stok-telur/{search}', 'LaporanStokTelurController@search');
	Route::get('/download/{search}', 'LaporanStokTelurController@download');
	Route::get('/print/data-stok-telur/{search}', 'LaporanStokTelurController@print');

	Route::get('/laporan-stok-ayam', 'LaporanStokAyamController@index');
	Route::get('/laporan-stok-ayam/{search}', 'LaporanStokAyamController@search');
	Route::get('/download/data-stok-ayam/{search}', 'LaporanStokAyamController@download');
	Route::get('/print/data-stok-ayam/{search}', 'LaporanStokAyamController@print');

	Route::get('/laporan-produksi-telur', 'LaporanProduksiTelurController@index');
	/*Route::get('/pagination/{search}/{page}/laporan-stok-telur', 'LaporanStokTelurController@pagination');*/
	Route::get('/laporan-produksi-telur/{search}', 'LaporanProduksiTelurController@search');
	Route::get('/download/data-produksi-telur/{search}', 'LaporanProduksiTelurController@download');
	Route::get('/print/data-produksi-telur/{search}', 'LaporanProduksiTelurController@print');

	Route::get('/laporan-pembelian', 'LaporanPembelianController@index');
	Route::get('/laporan-pembelian/{search}', 'LaporanPembelianController@search');
	Route::get('/download/data-pembelian/{search}', 'LaporanPembelianController@download');
	Route::get('/print/data-pembelian/{search}', 'LaporanPembelianController@print');

	Route::get('/laporan-penjualan-telur', 'LaporanPenjualanTelurController@index');
	Route::get('/laporan-penjualan-telur/{search}', 'LaporanPenjualanTelurController@search');
	Route::get('/download/data-penjualan-telur/{search}', 'LaporanPenjualanTelurController@download');
	Route::get('/print/data-penjualan-telur/{search}', 'LaporanPenjualanTelurController@print');	

	Route::get('/laporan-penjualan-ayam', 'LaporanPenjualanAyamController@index');
	Route::get('/laporan-penjualan-ayam/{search}', 'LaporanPenjualanAyamController@search');
	Route::get('/download/data-penjualan-ayam/{search}', 'LaporanPenjualanAyamController@download');
	Route::get('/print/data-penjualan-ayam/{search}', 'LaporanPenjualanAyamController@print');	

	Route::get('/galery', 'GaleryController@index');
	Route::post('/galery', 'GaleryController@store');
	Route::post('/delete/galery', 'GaleryController@delete');
	Route::get('/galery/{id}/getData', 'GaleryController@getData');
	Route::post('/galery/update', 'GaleryController@update');

});

Route::group(['middleware' => ['role:Konsumen,view_frontend']], function () {
    Route::get('/frontend',function (){
		return view('frontend.index');
	});
	Route::post('/home', 'PemesananController@store');
	Route::post('/pemesanan/update', 'PemesananController@update');
	Route::post('/delete/pemesanan', 'PemesananController@delete');
	Route::get('/pemesanan/{id}/getData', 'PemesananController@ambilData');
	
});

Route::get('auth/facebook', 'FacebookController@redirectToProvider');
Route::get('auth/facebook/callback', 'FacebookController@handleProviderCallback');


use Illuminate\Support\Facades\App;

Route::get('/bridge', function() {
    $pusher = App::make('pusher');

    $pusher->trigger( 'test-channel',
                      'test-event', 
                      array('text' => 'Pusher OK!!!'));

    return view('welcome');
});


use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TestEvent implements ShouldBroadcast
{
    public $text;

    public function __construct($text)
    {
        $this->text = $text;
    }

    public function broadcastOn()
    {
        return ['test-channel'];
    }
}

Route::get('/broadcast', function() {
    event(new TestEvent('Broadcasting in Laravel using Pusher!'));

    return view('welcome');
});

Route::get('notifications', 'NotificationController@getIndex');
Route::post('notifications/notify', 'NotificationController@postNotify');

Route::get('chat', 'ChatController@getIndex');
Route::post('chat', 'ChatController@postMessage');

Route::get('/pusher', 'PusherController@index');

