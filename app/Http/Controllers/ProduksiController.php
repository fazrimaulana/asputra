<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\produksi;
use App\stok_telur;
use App\Events\ShippingStatusUpdated;

class ProduksiController extends Controller
{
    
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
            $produksi = produksi::paginate(10);
            $total = produksi::sum('jml_produksi');
    		if ($request->has('page')) {
    		# code...
    		$page=$request->page;
    		}
   			else
    		{
    			$page=1;
    		}
    		$no = 10*$page-9;
    		return view('backend.produksi.index',[
    			'produksi' => $produksi,
    			'no' => $no,
                'total_produksi' => $total,
                /*'total' => $produksi->sum('jml_produksi'), menghitung total tiap page*/
    		]);
        endif;
    }


    public function store(Request $request)
    {
    	$permission = "view_backend";
        if(Auth::user()->can($permission)):
            if ($request->action=="update") {
                # code...
                $this->validate($request, [
                'tgl_produksi' => 'required|date',
                'jml_produksi' => 'required|integer',
                ]);
                $produksi = produksi::find($request->id);
                $produksi->tgl_produksi = $request->tgl_produksi;
                $produksi->jml_produksi = $request->jml_produksi;
                $produksi->save();
                return redirect()->back()->with('status','Update Success !!!');
            }
            $this->validate($request, [
                'tgl_produksi' => 'required|date',
                'jml_produksi' => 'required|integer',
            ]);
        	$produksi = [
            	'tgl_produksi' => $request->tgl_produksi,
            	'jml_produksi' => $request->jml_produksi,
        	];
        	$a = produksi::insert($produksi); 
            if ($a) {
                event(new ShippingStatusUpdated());
            }
            return redirect()->back()->with('status','Insert Success !!!');
        endif;        
    }

    /*public function delete(Request $request)
    {
        $deleteRow = produksi::where('id_produksi', $request->id)->delete();
        return redirect()->back()->with('status','Delete Success !!!');
    }*/     

    public function konfirmasi(Request $request)
    {
        $konfirmasi = produksi::find($request->id);
        return view('backend.produksi.konfirmasi', [
                'konfirmasi' => $konfirmasi
            ]);
    }

    public function validasi(Request $request)
    {
        $permission = "view_backend";
        if(Auth::user()->can($permission)):
            $this->validate($request, [
                'tgl_stok_telur' => 'required|date',
                'telur_masuk' => 'required|integer|max:'.$request->jml_produksi,
            ]);
            $stok = [
                'produksi_id' => $request->produksi_id,
                'tgl_stok_telur' => $request->tgl_stok_telur,
                'telur_masuk' => $request->telur_masuk,
            ];
            $produksi = [
                'konfirmasi_stok' => 'y'
            ];
            stok_telur::insert($stok); 
            produksi::where('id_produksi', $request->produksi_id)->update($produksi);
            return redirect('/home')->with('status','Insert Success !!!');
        endif;        
    }

    public function delete(Request $request)
    {
        $produksi = produksi::find($request->id);
        $a = produksi::find($request->id)->delete();
        if ($a) {
                event(new ShippingStatusUpdated());
            }
        return response ()->json ( $produksi );
    }

}
