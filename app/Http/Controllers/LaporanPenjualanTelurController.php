<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\penjualan_telur;
use Excel;
use App\Helpers\Tanggal;

class LaporanPenjualanTelurController extends Controller
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
    		return view('backend.laporan.penjualan_telur.index',['date' => $date]);
        endif;
    }

    public function search(Request $request)
    {    	
    	$search = $request->search;
    	$date = $request->search; 	
    	$penjualan_telur = penjualan_telur::where('tgl_penjualan_telur', 'like', '%'. $search .'%')->get();
    	$total_penjualan_telur = penjualan_telur::where('tgl_penjualan_telur', 'like', '%'. $search .'%')->sum('total');
        return view('backend.laporan.penjualan_telur.datas-penjualan-telur',[
        	'penjualan_telur' => $penjualan_telur,
        	'total_penjualan_telur' => $total_penjualan_telur,
    		'search' => $request->search,
    		'date' => $date,
    		'no' => 1
        ]);
    }

    public function download(Request $request)
    {
    	$search = $request->search;
    	$date = $request->search; 	
    	$penjualan_telur = penjualan_telur::where('tgl_penjualan_telur', 'like', '%'. $search .'%')->get();
    	$total_penjualan_telur = penjualan_telur::where('tgl_penjualan_telur', 'like', '%'. $search .'%')->sum('total');

        Excel::create('Data Pembelian '. Tanggal::BulanTahun($date), function($excel) use($search, $date, $penjualan_telur, $total_penjualan_telur) {

            $excel->sheet('New sheet', function($sheet) use($search, $date, $penjualan_telur, $total_penjualan_telur) {
                $sheet->setAutoSize(true);
                $sheet->loadView('backend.laporan.penjualan_telur.download', [
                		'penjualan_telur' => $penjualan_telur,
        				'total_penjualan_telur' => $total_penjualan_telur,
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
    	$penjualan_telur = penjualan_telur::where('tgl_penjualan_telur', 'like', '%'. $search .'%')->get();
    	$total_penjualan_telur = penjualan_telur::where('tgl_penjualan_telur', 'like', '%'. $search .'%')->sum('total');
        return view('backend.laporan.penjualan_telur.penjualan-telur-print',[
        	'penjualan_telur' => $penjualan_telur,
        	'total_penjualan_telur' => $total_penjualan_telur,
    		'search' => $request->search,
    		'date' => $date,
    		'no' => 1
        ]);
    }
}
