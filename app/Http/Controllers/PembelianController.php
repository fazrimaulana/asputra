<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\pembelian;
use App\stok_ayam;

class PembelianController extends Controller
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

    public function index(Request $request)
    {
    	$permission = "view_backend";
        if(Auth::user()->can($permission)):
            $dataPembelian = pembelian::paginate(10);
    		if ($request->has('page')) {
    		# code...
    		 $page=$request->page;
    		}
   			else
    		{
    			$page=1;
    		}
    		$no = 10*$page-9;
    		return view('backend.pembelian.index', [
    				'datas' => $dataPembelian,
    				'no' => $no
    			]);
        endif;
    }

    public function store(Request $request)
    {
    	$permission = "view_backend";
        if(Auth::user()->can($permission)):
           if ($request->action=="update") {
           		$this->validate($request, [
                	'tgl_pembelian' => 'required|date',
                	'nama_barang' => 'required|string',
                	'jml_pembelian' => 'required|integer',
                	'harga_satuan' => 'required|integer',
                    'tgl_non_produktif' => 'required',
            	]);

                
                $tgl = $request->tgl_non_produktif;
                $date = substr($tgl, 0,2);
                $month = substr($tgl, 3,2);
                $year = substr($tgl, 6);
                $tgl_non_produktif = $year."/".$month."/".$date;
                
        		$dataPembelian = [
            		'tgl_pembelian' => $request->tgl_pembelian,
            		'nama_barang' => $request->nama_barang,
            		'jml_pembelian' => $request->jml_pembelian,
            		'harga_satuan' => $request->harga_satuan,
            		'total' => $request->total,
                    'tgl_non_produktif' => $tgl_non_produktif,
        		];
        		pembelian::where('id_pembelian', $request->id)->update($dataPembelian);
                return redirect()->back()->with('status','Update Success !!!');
            }

            $this->validate($request, [
                'tgl_pembelian' => 'required|date',
                'nama_barang' => 'required|string',
                'jml_pembelian' => 'required|integer',
                'harga_satuan' => 'required|integer',
                'tgl_non_produktif' => 'required'
            ]);

                $tgl = $request->tgl_non_produktif;
                $date = substr($tgl, 0,2);
                $month = substr($tgl, 3,2);
                $year = substr($tgl, 6);
                $tgl_non_produktif = $year."/".$month."/".$date;

        	$dataPembelian = [
            	'tgl_pembelian' => $request->tgl_pembelian,
            	'nama_barang' => $request->nama_barang,
            	'jml_pembelian' => $request->jml_pembelian,
            	'harga_satuan' => $request->harga_satuan,
            	'total' => $request->total,
                'tgl_non_produktif' => $tgl_non_produktif,
        	];
        	pembelian::insert($dataPembelian); 
            return redirect()->back()->with('status','Insert Success !!!');
        endif;
    }

    /*public function delete(Request $request)
    {
        $deleteRow = pembelian::where('id_pembelian', $request->id)->delete();
        return redirect()->back()->with('status','Delete Success !!!');
    }*/

    public function getData(Request $request)
    {
        $data = pembelian::find($request->id);
        return view('backend.pembelian.konfirmasi',[
                'data' => $data,
            ]);
    }

    public function konfirmasi(Request $request)
    {
        $this->validate($request, [
                'tgl_konfirmasi' => 'required|date',
                'ayam_masuk' => 'required|integer|max:'. $request->jml_pembelian,
            ]);
        $datas = [
            'pembelian_id' => $request->id_pembelian,
            'tgl_stok_ayam' => $request->tgl_konfirmasi,
            'ayam_masuk' => $request->ayam_masuk
        ];
        stok_ayam::insert($datas);
        $dataKonfirmasi = [
            'konfirmasi_stok' => 'y'
        ];
        pembelian::where('id_pembelian', $request->id_pembelian)->update($dataKonfirmasi);
        return redirect('/home')->with('status','Konfirmasi Success !!!');
    }

    public function delete(Request $request)
    {
        $pembelian = pembelian::find($request->id);
        $pembelian->delete();
        return response ()->json ( $pembelian );
    }

}
