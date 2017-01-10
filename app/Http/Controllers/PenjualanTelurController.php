<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\penjualan_telur;
use App\stok_telur;
use Auth;

class PenjualanTelurController extends Controller
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
            $pt = penjualan_telur::paginate(10);
            $total = penjualan_telur::sum('jml_penjualan_telur');
    		if ($request->has('page')) {
    		# code...
    		$page=$request->page;
    		}
   			else
    		{
    			$page=1;
    		}
    		$no = 10*$page-9;
            $telur_masuk = stok_telur::sum('telur_masuk');
            $telur_keluar = stok_telur::sum('telur_keluar');
            $stok = $telur_masuk - $telur_keluar;
    		return view('backend.penjualan.telur.index',[
    			'datas' => $pt,
    			'no' => $no,
                'total_penjualan' => $total,
                'stok' => $stok,
    		]);
        endif;
    	/*return view('backend.produksi.index', compact('produksi', $produksi));*/
    }

    public function store(Request $request)
    {
    	$permission = "view_backend";
        if(Auth::user()->can($permission)):
            if ($request->action=="update") {
                # code...
                $dataPenjualan = penjualan_telur::find($request->id);
                $beli = $request->stok + $dataPenjualan->jml_penjualan_telur;
                $this->validate($request, [
                'tgl_penjualan_telur' => 'required|date',
                'jml_penjualan_telur' => 'required|integer|max:'. $beli,
                'no_hp' => 'size:13'
                ]);
                $datas = [
                    'tgl_penjualan_telur' => $request->tgl_penjualan_telur,
                    'jml_penjualan_telur' => $request->jml_penjualan_telur,
                    'harga_per_peti' => $request->harga_per_peti,
                    'total' => $request->total,
                    'alamat' => $request->alamat,
                    'no_hp' => $request->no_hp,
                ];
                penjualan_telur::where('id_penjualan_telur', '=', $request->id)->update($datas);
                $data = [
                    'telur_keluar' => $request->jml_penjualan_telur
                ];
                stok_telur::where('penjualan_telur_id', '=', $request->id)->update($data);
                return redirect()->back()->with('status','Update Success !!!');
            }
            $this->validate($request, [
                'tgl_penjualan_telur' => 'required|date',
                'jml_penjualan_telur' => 'required|integer|max:'. $request->stok,
                'no_hp' => 'size:13'
                ]);
        	$datas = [
            	'tgl_penjualan_telur' => $request->tgl_penjualan_telur,
            	'jml_penjualan_telur' => $request->jml_penjualan_telur,
                'harga_per_peti' => $request->harga_per_peti,
                'total' => $request->total,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
        	];
        	penjualan_telur::insert($datas);        
            $dataPenjualan = penjualan_telur::all()->last();    
            $data = [
                'penjualan_telur_id' => $dataPenjualan->id_penjualan_telur,
                'tgl_stok_telur' => $request->tgl_penjualan_telur, 
                'telur_keluar' => $request->jml_penjualan_telur
            ];
            stok_telur::insert($data);
            return redirect()->back()->with('status','Insert Success !!!');
            /*$produk = produksi::last();*/
            /*return Response::json($produk);*/

        endif;        
    }

    /*public function delete(Request $request)
    {
        $deleteRow = penjualan_telur::where('id_penjualan_telur', $request->id)->delete();
        return redirect()->back()->with('status','Delete Success !!!');
    }*/

    public function delete(Request $request)
    {
        $penjualan_telur = penjualan_telur::find($request->id);
        $penjualan_telur->delete();
        return response ()->json ( $penjualan_telur );
    }

}
