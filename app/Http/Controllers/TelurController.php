<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\stok_telur;
use App\produksi;
use App\penjualan_telur;

class TelurController extends Controller
{
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
            $stok_telur = stok_telur::paginate(10);
        	$telur_masuk = stok_telur::sum('telur_masuk');
        	$telur_keluar = stok_telur::sum('telur_keluar');
        	$jml_stok = $telur_masuk - $telur_keluar;
    		if ($request->has('page')) {
    		# code...
    		$page=$request->page;
    		}
   			else
    		{
    			$page=1;
    		}
    		$no = 10*$page-9;
    		return view('backend.stok_telur.index',[
    			'stok_telur' => $stok_telur,
    			'jml_telur_masuk' => $telur_masuk,
    			'jml_telur_keluar' => $telur_keluar,
    			'jml_stok' => $jml_stok,
    			'no' => $no,
    		]);
        endif;
    }

    public function store(Request $request)
    {
    	$permission = "view_backend";
        if(Auth::user()->can($permission)):
            $this->validate($request, [
                'tgl_produksi' => 'required|date',
                'jml_produksi' => 'required|integer',
            ]);
        	$produksi = [
            	'tgl_produksi' => $request->tgl_produksi,
            	'jml_produksi' => $request->jml_produksi,
        	];
        	$stok_telur = [
            	'tgl_stok_telur' => $request->tgl_produksi,
            	'telur_masuk' => $request->jml_produksi,
        	];
        	produksi::insert($produksi); 
        	stok_telur::insert($stok_telur);
        	return redirect()->back()->with('status','Success !!!');
        endif;        
    }

    public function getData(Request $request)
    {
        $stok = stok_telur::find($request->id);
        if ($stok->penjualan_telur_id==NULL) {
            # code...
            $produksi = produksi::find($stok->produksi_id);
            return view('backend.stok_telur.update', [
                'stok' => $stok,
                'produksi' => $produksi,
                'action' => 'in'
            ]);
        }

        $penjualan = penjualan_telur::find($stok->penjualan_telur_id);
        return view('backend.stok_telur.update', [
                'stok' => $stok,
                'penjualan' => $penjualan,
                'action' => 'out'
            ]);
    }

    public function update(Request $request)
    {
        $permission = "view_backend";
        if(Auth::user()->can($permission)):
            if ($request->action=="in") {
                # code...
                $this->validate($request, [
                    'tgl_stok_telur' => 'required|date',
                    'telur_masuk' => 'required|integer|max:'.$request->jml_produksi,
                ]);
                $stok = [
                    'produksi_id' => $request->produksi_id,
                    'tgl_stok_telur' => $request->tgl_stok_telur,
                    'telur_masuk' => $request->telur_masuk,
                ];
                stok_telur::where('id_stok_telur', $request->id_stok_telur)->update($stok);
                return redirect('/home')->with('status','Update Stok Success !!!');
            }

            $this->validate($request, [
                    'tgl_stok_telur' => 'required|date',
                    'telur_keluar' => 'required|integer|max:'.$request->jml_penjualan_telur,
                ]);
                $stok = [
                    'penjualan_telur_id' => $request->id_penjualan_telur,
                    'tgl_stok_telur' => $request->tgl_stok_telur,
                    'telur_keluar' => $request->telur_keluar,
                ];
                stok_telur::where('id_stok_telur', $request->id_stok_telur)->update($stok);
                return redirect('/home')->with('status','Update Stok Success !!!');

        endif; 
    }

    /*public function delete(Request $request)
    {
        $stok = stok_telur::find($request->id);
        $produksi = produksi::find($stok->produksi_id);
        $dataProduksi = [
            'konfirmasi_stok' => 'n'
        ];
        produksi::where('id_produksi', $produksi->id_produksi)->update($dataProduksi);
        $deleteStok = stok_telur::where('id_stok_telur', $request->id)->delete();
        return redirect('/home')->with('status','Delete Stok Success !!!');
    }*/

    public function delete(Request $request)
    {
        $stok = stok_telur::find($request->id);
        if ($stok->penjualan_telur_id==NULL) {
            # code...
            $produksi = produksi::find($stok->produksi_id);
            $dataProduksi = [
                'konfirmasi_stok' => 'n'
            ];
            produksi::where('id_produksi', $produksi->id_produksi)->update($dataProduksi);
            stok_telur::where('id_stok_telur', $request->id)->delete();
            return response ()->json ( $stok );
        }

        $penjualan = penjualan_telur::find($stok->penjualan_telur_id);
        penjualan_telur::where('id_penjualan_telur', $penjualan->id_penjualan_telur)->delete();
        stok_telur::where('id_stok_telur', $request->id)->delete();
        return response ()->json ( $stok );
        
    }

}
