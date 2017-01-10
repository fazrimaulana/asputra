<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\penjualan_ayam;
use Excel;
use App\Helpers\Tanggal;

class LaporanPenjualanAyamController extends Controller
{
    //
    //
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index(Request $request)
    {
    	$permission = "view_backend";
        if(Auth::user()->can($permission)):
        	$date = date('Y-m');
    		return view('backend.laporan.penjualan_ayam.index',['date' => $date]);
        endif;
    }

    public function search(Request $request)
    {    	
    	$search = $request->search;
    	$date = $request->search; 	
    	$penjualan_ayam = penjualan_ayam::where('tgl_penjualan_ayam', 'like', '%'. $search .'%')->get();
    	$total_penjualan_ayam = penjualan_ayam::where('tgl_penjualan_ayam', 'like', '%'. $search .'%')->sum('total');
        return view('backend.laporan.penjualan_ayam.datas-penjualan-ayam',[
        	'penjualan_ayam' => $penjualan_ayam,
        	'total_penjualan_ayam' => $total_penjualan_ayam,
    		'search' => $request->search,
    		'date' => $date,
    		'no' => 1
        ]);
    }

    public function download(Request $request)
    {
    	$search = $request->search;
    	$date = $request->search; 	
    	$penjualan_ayam = penjualan_ayam::where('tgl_penjualan_ayam', 'like', '%'. $search .'%')->get();
    	$total_penjualan_ayam = penjualan_ayam::where('tgl_penjualan_ayam', 'like', '%'. $search .'%')->sum('total');

        Excel::create('Data Pembelian '. Tanggal::BulanTahun($date), function($excel) use($search, $date, $penjualan_ayam, $total_penjualan_ayam) {

            $excel->sheet('New sheet', function($sheet) use($search, $date, $penjualan_ayam, $total_penjualan_ayam) {
                $sheet->setAutoSize(true);
                $sheet->loadView('backend.laporan.penjualan_ayam.download', [
                		'penjualan_ayam' => $penjualan_ayam,
        				'total_penjualan_ayam' => $total_penjualan_ayam,
    					'search' => $search,
    					'date' => $date,
    					'no' => 1
                	]);

            });

        })->export('xls');
    }

    public function print(Request $request)
    {
    	$search = $request->search;
    	$date = $request->search; 	
    	$penjualan_ayam = penjualan_ayam::where('tgl_penjualan_ayam', 'like', '%'. $search .'%')->get();
    	$total_penjualan_ayam = penjualan_ayam::where('tgl_penjualan_ayam', 'like', '%'. $search .'%')->sum('total');
        return view('backend.laporan.penjualan_ayam.penjualan-ayam-print',[
        	'penjualan_ayam' => $penjualan_ayam,
        	'total_penjualan_ayam' => $total_penjualan_ayam,
    		'search' => $request->search,
    		'date' => $date,
    		'no' => 1
        ]);
    }
}
