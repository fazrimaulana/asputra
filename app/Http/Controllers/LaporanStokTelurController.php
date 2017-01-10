<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\stok_telur;
use Excel;
use App\Helpers\Tanggal;

class LaporanStokTelurController extends Controller
{
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
        	/*$stok_telur = stok_telur::where('tgl_stok_telur', 'like', '%'. $date .'%')->paginate(10);
        	$telur_masuk = stok_telur::where('tgl_stok_telur', 'like', '%'. $date .'%')->sum('telur_masuk');
        	$telur_keluar = stok_telur::where('tgl_stok_telur', 'like', '%'. $date .'%')->sum('telur_keluar');
        	$jml_stok = $telur_masuk - $telur_keluar;*/
    		return view('backend.laporan.stok_telur.index',[
    			/*'jml_telur_masuk' => $telur_masuk,
    			'jml_telur_keluar' => $telur_keluar,
    			'jml_stok' => $jml_stok,*/
    			'date' => $date,
    			/*'stok_telur' => $stok_telur*/
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
    	$stok_telur = stok_telur::where('tgl_stok_telur', 'like', '%'. $search .'%')->get();
    	$telur_masuk = stok_telur::where('tgl_stok_telur', 'like', '%'. $search .'%')->sum('telur_masuk');
        $telur_keluar = stok_telur::where('tgl_stok_telur', 'like', '%'. $search .'%')->sum('telur_keluar');
        $jml_stok = $telur_masuk - $telur_keluar;
        return view('backend.laporan.stok_telur.datas-stok-telur',[
        	'telur_masuk' => $telur_masuk,
    		'telur_keluar' => $telur_keluar,
    		'jml_stok' => $jml_stok,
    		'search' => $request->search,
    		'stok_telur' => $stok_telur,
    		'date' => $date,
    		'no' => 1
        ]);
    }

    /*public function pagination(Request $request)
    {        
        if ($request->has('page')) {
                # code...
            $page=$request->page;
        }
        else
        {
            $page=1;
        }
        $no = 2*$page-1;
        $search = $request->search;
        $date = $request->search;
        $stok_telur = stok_telur::where('tgl_stok_telur', 'like', '%'. $search .'%')->paginate(2);
        $telur_masuk = stok_telur::where('tgl_stok_telur', 'like', '%'. $search .'%')->sum('telur_masuk');
        $telur_keluar = stok_telur::where('tgl_stok_telur', 'like', '%'. $search .'%')->sum('telur_keluar');
        $jml_stok = $telur_masuk - $telur_keluar;
        return view('backend.laporan.stok_telur.datas-stok-telur',[
            'telur_masuk' => $telur_masuk,
            'telur_keluar' => $telur_keluar,
            'jml_stok' => $jml_stok,
            'search' => $request->search,
            'stok_telur' => $stok_telur,
            'date' => $date,
            'no' => $no
        ]);
    }*/

    public function download(Request $request)
    {
    	$search = $request->search;
    	$date = $request->search; 	
    	$stok_telur = stok_telur::where('tgl_stok_telur', 'like', '%'. $search .'%')->get();
    	$telur_masuk = stok_telur::where('tgl_stok_telur', 'like', '%'. $search .'%')->sum('telur_masuk');
        $telur_keluar = stok_telur::where('tgl_stok_telur', 'like', '%'. $search .'%')->sum('telur_keluar');
        $jml_stok = $telur_masuk - $telur_keluar;

        Excel::create('Stok Telur '. Tanggal::BulanTahun($date), function($excel) use($search, $date, $stok_telur, $telur_keluar, $telur_masuk, $jml_stok) {

            $excel->sheet('New sheet', function($sheet) use($search, $date, $stok_telur, $telur_keluar, $telur_masuk, $jml_stok) {
                $sheet->setAutoSize(true);
                $sheet->loadView('backend.laporan.stok_telur.download', [
                		'telur_masuk' => $telur_masuk,
    					'telur_keluar' => $telur_keluar,
    					'jml_stok' => $jml_stok,
    					'search' => $search,
    					'stok_telur' => $stok_telur,
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
    	$stok_telur = stok_telur::where('tgl_stok_telur', 'like', '%'. $search .'%')->get();
    	$telur_masuk = stok_telur::where('tgl_stok_telur', 'like', '%'. $search .'%')->sum('telur_masuk');
        $telur_keluar = stok_telur::where('tgl_stok_telur', 'like', '%'. $search .'%')->sum('telur_keluar');
        $jml_stok = $telur_masuk - $telur_keluar;
        return view('backend.laporan.stok_telur.stok-telur-print',[
        	'telur_masuk' => $telur_masuk,
    		'telur_keluar' => $telur_keluar,
    		'jml_stok' => $jml_stok,
    		'search' => $request->search,
    		'stok_telur' => $stok_telur,
    		'date' => $date,
    		'no' => 1
        ]);
    }

}
