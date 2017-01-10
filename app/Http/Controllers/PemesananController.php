<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\facades\Mail;
use Auth;
use App\pemesanan;
use App\stok_telur;
use App\penjualan_telur;
use SMS;
use App\Events\ShippingStatusUpdated;

use Validator;

class PemesananController extends Controller
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

    public function index()
    {

    }

    public function store(Request $request)
    {
    	$permission = "view_frontend";
        if(Auth::user()->can($permission)):
            /*if ($request->action=="update") {
                # code...
                $this->validate($request, [
                'tgl_pemesanan' => 'required|date',
                'jml_pemesanan' => 'required|integer',
                'alamat' => 'required|string',
                'no_hp' => 'required|string|size:12'
                ]);
                $datas = [
                'tgl_pemesanan' => $request->tgl_pemesanan,
                'jml_pemesanan' => $request->jml_pemesanan,
                'harga_per_peti' => $request->harga_per_peti,
                'total' => $request->total,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                ];
                pemesanan::where('id_pemesanan', '=', $request->id)->update($datas); 
                return redirect()->back()->with('status','Update Success !!!');
            }  */          

            $this->validate($request, [
                'tgl_pemesanan' => 'required|date',
                'jml_pemesanan' => 'required|integer',
                'alamat' => 'required|string',
                'no_hp' => 'required|string|size:12'
                ]);
                $datas = [
                'user_id' => Auth::user()->id,
                'tgl_pemesanan' => $request->tgl_pemesanan,
                'jml_pemesanan' => $request->jml_pemesanan,
                'harga_per_peti' => $request->harga_per_peti,
                'total' => $request->total,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                ];
                $a = pemesanan::insert($datas);
                if ($a) {
                    event(new ShippingStatusUpdated());
                } 
                return redirect()->back()->with('status','Insert Success !!!');

        endif;  
    }

    public function getData(Request $request)
    {
        $pemesanan = pemesanan::find($request->id);
        $telur_masuk = stok_telur::sum('telur_masuk');
        $telur_keluar = stok_telur::sum('telur_keluar');
        $jml_stok = $telur_masuk - $telur_keluar;
        return view('backend.pemesanan.konfirmasi', [
                'data' => $pemesanan,
                'jml_stok' => $jml_stok,
            ]);
    }

    //mengatasi error curl certifikat pada sms http://curl.haxx.se/ca/cacert.pem set php.ini curl.cainfo =C:\xampp\sendmail\cacert.pem restart apache dan mysql

    public function konfirmasi(Request $request)
    {
        $this->validate($request, [
                'jml_pemesanan' => 'required|integer|max:'.$request->stok,
                ]);
        $datas = [
            'konfirmasi_pemesanan' => 'y',
        ];
        $datas_penjualan = [
            'tgl_penjualan_telur' => $request->tgl_konfirmasi,
            'jml_penjualan_telur' => $request->jml_pemesanan,
            'harga_per_peti' => $request->harga_per_peti,
            'total' => $request->total,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ];
        penjualan_telur::insert($datas_penjualan);
        pemesanan::where('id_pemesanan','=',$request->id_pemesanan)->update($datas);
        $data_penjualan = penjualan_telur::all()->last();
        $stok = [
            'penjualan_telur_id' => $data_penjualan->id_penjualan_telur,
            'tgl_stok_telur' => $data_penjualan->tgl_penjualan_telur,
            'telur_keluar' => $data_penjualan->jml_penjualan_telur,
        ];
        stok_telur::insert($stok);
        event(new ShippingStatusUpdated($request->id_pemesanan));
        $nomer = $request->no_hp;
        $no = substr($nomer, 1);
        $smsNo = "62".$no;
        /*SMS::send('sms_konfirmasi', ['tgl'=> $request->tgl_pemesanan, 'jml'=> $request->jml_pemesanan, 'total'=> $request->total], function($sms) use($smsNo) {
            $sms->to($smsNo);
        });*/                
        return redirect('/home')->with('status','Success !!!');
    }


    public function update(Request $request)
    {   

        $validator = Validator::make($request->all(), [
                'tgl_pemesanan' => 'required|date',
                'jml_pemesanan_edit' => 'required|integer',
                'alamat' => 'required|string',
                'no_hp' => 'required|string|size:12'
            ]);

        if ($validator->fails()) {
            return "error";
        }

        $datas = [
                'tgl_pemesanan' => $request->tgl_pemesanan,
                'jml_pemesanan' => $request->jml_pemesanan,
                'harga_per_peti' => $request->harga_per_peti,
                'total' => $request->total,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
            ];
        pemesanan::where('id_pemesanan', '=', $request->id)->update($datas);
        $pemesanan = pemesanan::findOrFail($request->id);
        event(new ShippingStatusUpdated());
        return response ()->json($pemesanan);
    }

    public function delete(Request $request)
    {
        $pemesanan = pemesanan::find($request->id);
        $pemesanan->delete();
        event(new ShippingStatusUpdated());
        return response ()->json ( $pemesanan );
    }

    public function ambilData(Request $request)
    {
        $pemesanan = pemesanan::find($request->id);
        return response ()->json ( $pemesanan );
    }

    public function showNotifPemesanan()
    {
        $pemesanan = pemesanan::where('konfirmasi_pemesanan', '=', 'n')->count();
        return view('showNotifPemesanan',[
                'data' => $pemesanan,
            ]);
    }

    public function showDatasPemesanan()
    {
        $pemesanan = pemesanan::where('konfirmasi_pemesanan', '=', 'n')->get();
        return view('showDatasPemesanan',[
                'data' => $pemesanan,
            ]);
    }



}
