<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\pembelian;
use Excel;
use App\Helpers\Tanggal;

class LaporanPembelianController extends Controller
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
    		return view('backend.laporan.pembelian.index',['date' => $date]);
        endif;
    }

    public function search(Request $request)
    {    	
    	$search = $request->search;
    	$date = $request->search; 	
    	$pembelian = pembelian::where('tgl_pembelian', 'like', '%'. $search .'%')->get();
    	$total_pembelian = pembelian::where('tgl_pembelian', 'like', '%'. $search .'%')->sum('total');
        return view('backend.laporan.pembelian.datas-pembelian',[
        	'pembelian' => $pembelian,
        	'total_pembelian' => $total_pembelian,
    		'search' => $request->search,
    		'date' => $date,
    		'no' => 1
        ]);
    }

    public function download(Request $request)
    {
    	$search = $request->search;
    	$date = $request->search; 	
    	$pembelian = pembelian::where('tgl_pembelian', 'like', '%'. $search .'%')->get();
    	$total_pembelian = pembelian::where('tgl_pembelian', 'like', '%'. $search .'%')->sum('total');

        Excel::create('Data Pembelian '. Tanggal::BulanTahun($date), function($excel) use($search, $date, $pembelian, $total_pembelian) {

            $excel->sheet('New sheet', function($sheet) use($search, $date, $pembelian, $total_pembelian) {
                $sheet->setAutoSize(true);
                $sheet->loadView('backend.laporan.pembelian.download', [
                		'pembelian' => $pembelian,
        				'total_pembelian' => $total_pembelian,
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
    	$pembelian = pembelian::where('tgl_pembelian', 'like', '%'. $search .'%')->get();
    	$total_pembelian = pembelian::where('tgl_pembelian', 'like', '%'. $search .'%')->sum('total');
        return view('backend.laporan.pembelian.pembelian-print',[
        	'pembelian' => $pembelian,
        	'total_pembelian' => $total_pembelian,
    		'search' => $request->search,
    		'date' => $date,
    		'no' => 1
        ]);
    }
}
