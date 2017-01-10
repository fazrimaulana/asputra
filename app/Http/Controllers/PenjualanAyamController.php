<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\penjualan_ayam;
use App\stok_ayam;

class PenjualanAyamController extends Controller
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

    public function index(Request $request)
    {
        $permission = "view_backend";
        if(Auth::user()->can($permission)):
            $pa = penjualan_ayam::paginate(10);
            $total = penjualan_ayam::sum('jml_penjualan_ayam');
            if ($request->has('page')) {
                # code...
                $page=$request->page;
            }
            else
            {
                $page=1;
            }
            $no = 10*$page-9;
            $ayam_masuk = stok_ayam::sum('ayam_masuk');
            $ayam_keluar = stok_ayam::sum('ayam_keluar');
            $stok = $ayam_masuk - $ayam_keluar;
            return view('backend.penjualan.ayam.index',[
                'datas' => $pa,
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
                $dataPenjualan = penjualan_ayam::find($request->id);
                $beli = $request->stok + $dataPenjualan->jml_penjualan_ayam;
                $this->validate($request, [
                'tgl_penjualan_ayam' => 'required|date',
                'jml_penjualan_ayam' => 'required|integer|max:'. $beli,
                'no_hp' => 'size:13'
                ]);
                $datas = [
                    'tgl_penjualan_ayam' => $request->tgl_penjualan_ayam,
                    'jml_penjualan_ayam' => $request->jml_penjualan_ayam,
                    'harga_per_ayam' => $request->harga_per_ayam,
                    'total' => $request->total,
                    'alamat' => $request->alamat,
                    'no_hp' => $request->no_hp,
                ];
                penjualan_ayam::where('id_penjualan_ayam', '=', $request->id)->update($datas);
                $data = [
                    'ayam_keluar' => $request->jml_penjualan_ayam
                ];
                stok_ayam::where('penjualan_ayam_id', '=', $request->id)->update($data);
                return redirect()->back()->with('status','Update Success !!!');
            }
            $this->validate($request, [
                'tgl_penjualan_ayam' => 'required|date',
                'jml_penjualan_ayam' => 'required|integer|max:'. $request->stok,
                'no_hp' => 'size:13'
                ]);
            $datas = [
                'tgl_penjualan_ayam' => $request->tgl_penjualan_ayam,
                'jml_penjualan_ayam' => $request->jml_penjualan_ayam,
                'harga_per_ayam' => $request->harga_per_ayam,
                'total' => $request->total,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
            ];
            penjualan_ayam::insert($datas);        
            $dataPenjualan = penjualan_ayam::all()->last();    
            $data = [
                'penjualan_ayam_id' => $dataPenjualan->id_penjualan_ayam,
                'tgl_stok_ayam' => $request->tgl_penjualan_ayam, 
                'ayam_keluar' => $request->jml_penjualan_ayam
            ];
            stok_ayam::insert($data);
            return redirect()->back()->with('status','Insert Success !!!');
        endif;        
    }

    /*public function delete(Request $request)
    {
        $deleteRow = penjualan_ayam::where('id_penjualan_ayam', $request->id)->delete();
        return redirect()->back()->with('status','Delete Success !!!');
    }*/

    public function delete(Request $request)
    {
        $penjualan_ayam = penjualan_ayam::find($request->id);
        $penjualan_ayam->delete();
        return response ()->json ( $penjualan_ayam );
    }

}
