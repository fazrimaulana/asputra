<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\produksi;
use Excel;
use App\Helpers\Tanggal;

class LaporanProduksiTelurController extends Controller
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
    		return view('backend.laporan.produksi_telur.index',['date' => $date]);
        endif;
    }

    public function search(Request $request)
    {    	
    	$search = $request->search;
    	$date = $request->search; 	
    	$produksi = produksi::where('tgl_produksi', 'like', '%'. $search .'%')->get();
    	$total_produksi = produksi::where('tgl_produksi', 'like', '%'. $search .'%')->sum('jml_produksi');
        return view('backend.laporan.produksi_telur.datas-produksi-telur',[
        	'produksi' => $produksi,
        	'total_produksi' => $total_produksi,
    		'search' => $request->search,
    		'date' => $date,
    		'no' => 1
        ]);
    }

    public function download(Request $request)
    {
    	$search = $request->search;
    	$date = $request->search; 	
    	$produksi = produksi::where('tgl_produksi', 'like', '%'. $search .'%')->get();
    	$total_produksi = produksi::where('tgl_produksi', 'like', '%'. $search .'%')->sum('jml_produksi');

        Excel::create('Produksi '. Tanggal::BulanTahun($date), function($excel) use($search, $date, $produksi, $total_produksi) {

            $excel->sheet('New sheet', function($sheet) use($search, $date, $produksi, $total_produksi) {
                $sheet->setAutoSize(true);
                $sheet->loadView('backend.laporan.produksi_telur.download', [
                		'produksi' => $produksi,
                		'total_produksi' => $total_produksi,
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
    	$produksi = produksi::where('tgl_produksi', 'like', '%'. $search .'%')->get();
    	$total_produksi = produksi::where('tgl_produksi', 'like', '%'. $search .'%')->sum('jml_produksi');
        return view('backend.laporan.produksi_telur.produksi-telur-print',[
        	'produksi' => $produksi,
        	'total_produksi' => $total_produksi,
    		'search' => $request->search,
    		'date' => $date,
    		'no' => 1
        ]);
    }
}
