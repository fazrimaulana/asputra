<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use App\produksi;
use App\pemesanan;
use App\pembelian;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $notif_produksi = produksi::where('konfirmasi_stok', '=', 'n')->count();
        $dataKonfirmasiProduksi = produksi::where('konfirmasi_stok', '=', 'n')->get();
        $dataKonfirmasiPemesanan = pemesanan::where('konfirmasi_pemesanan', '=', 'n')->get();
        $notif_pemesanan = pemesanan::where('konfirmasi_pemesanan', '=', 'n')->count();
        $notif_pembelian = pembelian::where('konfirmasi_stok', '=', 'n')->count();
        $dataKonfirmasiPembelian = pembelian::where('konfirmasi_stok', '=', 'n')->get();
        $dataAyamNonProduktif = pembelian::where('tgl_non_produktif', '<=', date('Y-m-d'))->get();

        View::share([
            'notif_produksi' => $notif_produksi,
            'dataKonfirmasiProduksi' => $dataKonfirmasiProduksi,
            'notif_pemesanan' => $notif_pemesanan,
            'dataKonfirmasiPemesanan' => $dataKonfirmasiPemesanan,
            'notif_pembelian' => $notif_pembelian,
            'dataKonfirmasiPembelian' => $dataKonfirmasiPembelian,
            'dataAyamNonProduktif' => $dataAyamNonProduktif,
            ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
