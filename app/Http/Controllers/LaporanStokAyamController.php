<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\stok_ayam;
use Excel;
use App\Helpers\Tanggal;

class LaporanStokAyamController extends Controller
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
        	/*$stok_ayam = stok_ayam::where('tgl_stok_ayam', 'like', '%'. $date .'%')->paginate(10);
        	$ayam_masuk = stok_ayam::where('tgl_stok_ayam', 'like', '%'. $date .'%')->sum('ayam_masuk');
        	$ayam_keluar = stok_ayam::where('tgl_stok_ayam', 'like', '%'. $date .'%')->sum('ayam_keluar');
        	$jml_stok = $ayam_masuk - $ayam_keluar;*/
    		return view('backend.laporan.stok_ayam.index',[
    			/*'jml_ayam_masuk' => $ayam_masuk,
    			'jml_ayam_keluar' => $ayam_keluar,
    			'jml_stok' => $jml_stok,*/
    			'date' => $date,
    			/*'stok_ayam' => $stok_ayam*/
    		]);
        endif;
    }

    public function search(Request $request)
    {
    	/*$stok_telur = stok_telur::where('tgl_stok_telur', 'like', '%'. $request->search .'%')->paginate(10);
    	$telur_masuk = stok_telur::where('tgl_stok_telur', 'like', '%'. $request->search .'%')->sum('telur_masuk');
        $telur_keluar = stok_telur::where('tgl_stok_telur', 'like', '%'. $request->search .'%')->sum('telur_keluar');
        $jml_stok = $telur_masuk - $telur_keluar;
    	return response ()->json ([
    			'telur_masuk' => $telur_masuk,
    			'telur_keluar' => $telur_keluar,
    			'jml_stok' => $jml_stok,
    			'search' => $request->search,
    			'stok_telur' => $stok_telur
    		]);*/
    	
    	$search = $request->search;
    	$date = $request->search; 	
    	$stok_ayam = stok_ayam::where('tgl_stok_ayam', 'like', '%'. $search .'%')->get();
    	$ayam_masuk = stok_ayam::where('tgl_stok_ayam', 'like', '%'. $search .'%')->sum('ayam_masuk');
        $ayam_keluar = stok_ayam::where('tgl_stok_ayam', 'like', '%'. $search .'%')->sum('ayam_keluar');
        $jml_stok = $ayam_masuk - $ayam_keluar;
        return view('backend.laporan.stok_ayam.datas-stok-ayam',[
        	'ayam_masuk' => $ayam_masuk,
    		'ayam_keluar' => $ayam_keluar,
    		'jml_stok' => $jml_stok,
    		'search' => $request->search,
    		'stok_ayam' => $stok_ayam,
    		'date' => $date,
    		'no' => 1
        ]);
    }

    public function download(Request $request)
    {
    	$search = $request->search;
    	$date = $request->search; 	
    	$stok_ayam = stok_ayam::where('tgl_stok_ayam', 'like', '%'. $search .'%')->get();
    	$ayam_masuk = stok_ayam::where('tgl_stok_ayam', 'like', '%'. $search .'%')->sum('ayam_masuk');
        $ayam_keluar = stok_ayam::where('tgl_stok_ayam', 'like', '%'. $search .'%')->sum('ayam_keluar');
        $jml_stok = $ayam_masuk - $ayam_keluar;

        Excel::create('Stok Ayam '. Tanggal::BulanTahun($date), function($excel) use($search, $date, $stok_ayam, $ayam_keluar, $ayam_masuk, $jml_stok) {

            $excel->sheet('New sheet', function($sheet) use($search, $date, $stok_ayam, $ayam_keluar, $ayam_masuk, $jml_stok) {
                $sheet->setAutoSize(true);
                $sheet->loadView('backend.laporan.stok_ayam.download', [
                		'ayam_masuk' => $ayam_masuk,
    					'ayam_keluar' => $ayam_keluar,
    					'jml_stok' => $jml_stok,
    					'search' => $search,
    					'stok_ayam' => $stok_ayam,
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
    	$stok_ayam = stok_ayam::where('tgl_stok_ayam', 'like', '%'. $search .'%')->get();
    	$ayam_masuk = stok_ayam::where('tgl_stok_ayam', 'like', '%'. $search .'%')->sum('ayam_masuk');
        $ayam_keluar = stok_ayam::where('tgl_stok_ayam', 'like', '%'. $search .'%')->sum('ayam_keluar');
        $jml_stok = $ayam_masuk - $ayam_keluar;
        return view('backend.laporan.stok_ayam.stok-ayam-print',[
        	'ayam_masuk' => $ayam_masuk,
    		'ayam_keluar' => $ayam_keluar,
    		'jml_stok' => $jml_stok,
    		'search' => $request->search,
    		'stok_ayam' => $stok_ayam,
    		'date' => $date,
    		'no' => 1
        ]);
    }
}
