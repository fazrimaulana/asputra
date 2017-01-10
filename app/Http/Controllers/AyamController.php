<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\stok_ayam;
use App\pembelian;
use App\penjualan_ayam;

class AyamController extends Controller
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
            $stok_ayam = stok_ayam::paginate(10);
        	$ayam_masuk = stok_ayam::sum('ayam_masuk');
        	$ayam_keluar = stok_ayam::sum('ayam_keluar');
        	$jml_stok = $ayam_masuk - $ayam_keluar;
    		if ($request->has('page')) {
    			# code...
    			$page=$request->page;
    		}
   			else
    		{
    			$page=1;
    		}
    		$no = 10*$page-9;
    		return view('backend.stok_ayam.index',[
    			'stok_ayam' => $stok_ayam,
    			'jml_ayam_masuk' => $ayam_masuk,
    			'jml_ayam_keluar' => $ayam_keluar,
    			'jml_stok' => $jml_stok,
    			'no' => $no,
    		]);
        endif;
    }

    public function delete(Request $request)
    {
        $stok = stok_ayam::find($request->id);
        if ($stok->penjualan_ayam_id==NULL) {
            # code...
            $pembelian = pembelian::find($stok->pembelian_id);
            $dataPembelian = [
                'konfirmasi_stok' => 'n'
            ];
            pembelian::where('id_pembelian', $pembelian->id_pembelian)->update($dataPembelian);
            stok_ayam::where('id_stok_ayam', $request->id)->delete();
            return response ()->json ( $stok );
        }

        $penjualan = penjualan_ayam::find($stok->penjualan_ayam_id);
        penjualan_ayam::where('id_penjualan_ayam', $penjualan->id_penjualan_ayam)->delete();
        stok_ayam::where('id_stok_ayam', $request->id)->delete();
        return response ()->json ( $stok );
    }

    public function getData(Request $request)
    {
        $stok = stok_ayam::find($request->id);
        if ($stok->penjualan_ayam_id==NULL) {
            # code...
            $pembelian = pembelian::find($stok->pembelian_id);
            return view('backend.stok_ayam.update', [
                'stok' => $stok,
                'pembelian' => $pembelian,
                'action' => 'in'
            ]);
        }

        $penjualan = penjualan_ayam::find($stok->penjualan_ayam_id);
        return view('backend.stok_ayam.update', [
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
                    'tgl_stok_ayam' => 'required|date',
                    'ayam_masuk' => 'required|integer|max:'.$request->jml_pembelian,
                ]);
                $stok = [
                    'pembelian_id' => $request->pembelian_id,
                    'tgl_stok_ayam' => $request->tgl_stok_ayam,
                    'ayam_masuk' => $request->ayam_masuk,
                ];
                stok_ayam::where('id_stok_ayam', $request->id_stok_ayam)->update($stok);
                return redirect('/home')->with('status','Update Stok Ayam Success !!!');
            }

            $this->validate($request, [
                    'tgl_stok_ayam' => 'required|date',
                    'ayam_keluar' => 'required|integer|max:'.$request->jml_penjualan_ayam,
                ]);
                $stok = [
                    'penjualan_ayam_id' => $request->id_penjualan_ayam,
                    'tgl_stok_ayam' => $request->tgl_stok_ayam,
                    'ayam_keluar' => $request->ayam_keluar,
                ];
                stok_ayam::where('id_stok_ayam', $request->id_stok_ayam)->update($stok);
                return redirect('/home')->with('status','Update Stok Ayam Success !!!');

        endif; 
    }


}
