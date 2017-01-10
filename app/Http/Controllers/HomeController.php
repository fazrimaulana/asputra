<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\produksi;
use App\pemesanan;
use Carbon\Carbon;
use App\galeries;



class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function home(Request $request)
    {
        $permission = "view_backend";
        if(Auth::user()->can($permission)):
            $date = date("Y");
            $dataJanuari = produksi::where('tgl_produksi', 'like', '%'.$date.'-01%')->sum('jml_produksi');
            $dataFebruari = produksi::where('tgl_produksi', 'like', '%'.$date.'-02%')->sum('jml_produksi');
            $dataMaret = produksi::where('tgl_produksi', 'like', '%'.$date.'-03%')->sum('jml_produksi');
            $dataApril = produksi::where('tgl_produksi', 'like', '%'.$date.'-04%')->sum('jml_produksi');
            $dataMei = produksi::where('tgl_produksi', 'like', '%'.$date.'-05%')->sum('jml_produksi');
            $dataJuni = produksi::where('tgl_produksi', 'like', '%'.$date.'-06%')->sum('jml_produksi');
            $dataJuli = produksi::where('tgl_produksi', 'like', '%'.$date.'-07%')->sum('jml_produksi');
            $dataAgustus = produksi::where('tgl_produksi', 'like', '%'.$date.'-08%')->sum('jml_produksi');
            $dataSeptember = produksi::where('tgl_produksi', 'like', '%'.$date.'-09%')->sum('jml_produksi');
            $dataOktober = produksi::where('tgl_produksi', 'like', '%'.$date.'-10%')->sum('jml_produksi');
            $dataNovember = produksi::where('tgl_produksi', 'like', '%'.$date.'-11%')->sum('jml_produksi');
            $dataDesember = produksi::where('tgl_produksi', 'like', '%'.$date.'-12%')->sum('jml_produksi');
            return view('backend.index', [
                    'dataJanuari' => $dataJanuari,
                    'dataFebruari' => $dataFebruari,
                    'dataMaret' => $dataMaret,
                    'dataApril' => $dataApril,
                    'dataMei' => $dataMei,
                    'dataJuni' => $dataJuni,
                    'dataJuli' => $dataJuli,
                    'dataAgustus' => $dataAgustus,
                    'dataSeptember' => $dataSeptember,
                    'dataOktober' => $dataOktober,
                    'dataNovember' => $dataNovember,
                    'dataDesember' => $dataDesember,
                    'date' => $date,
                ]);
        else:
            $pemesanan = pemesanan::where('user_id', Auth::user()->id)->paginate(10);
            if ($request->has('page')) {
            # code...
            $page=$request->page;
            }
            else
            {
                $page=1;
            }
            $no = 10*$page-9;
            $date = date('Y/m/d');
            $galery = galeries::all();
            return view('frontend.index', [
                'pemesanan' => $pemesanan,
                'no' => $no,
                'date' => $date,
                'galeries' => $galery,
            ]);
        endif;
    }



}
