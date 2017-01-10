<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\galeries;
use Image;
use File;
use Validator;

class GaleryController extends Controller
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

    public function index(Request $request)
    {
        if ($request->has('page')) {
            # code...
            $page = $request->page;
        }
        else
        {
            $page = 1;
        }
        $no = 5*$page-4;
        $dataGalery = galeries::paginate(5);
    	return view('backend.galery.index', [
                'dataGalery' => $dataGalery,
                'no' => $no
            ]);
    }

    public function store(Request $request)
    {
    	$permission = "view_backend";
        if(Auth::user()->can($permission)):
            if ($request->action=="") {
                # code...
                $this->validate($request, [
                    'deskripsi' => 'required|string',
                    'gambar' => 'required|image',
                ]);

                $file = $request->file('gambar');
                $fileName = $file->getClientOriginalName();
                $path = public_path('image/'. $fileName);
                Image::make($file->getRealPath())->resize(650, 350)->save($path);
                $datas = [
                    'deskripsi' => $request->deskripsi,
                    'foto' => $fileName,
                ];
                galeries::insert($datas);
                return redirect()->back()->with('status','Insert Success !!!');
            }

            $this->validate($request, [
                    'deskripsi' => 'required|string',
                    'gambar' => 'image',
                ]);

            $dataGalery = galeries::where('id', $request->id)->first();

                if ($request->file('gambar') == "") {
                    # code...
                    $fileName = $dataGalery->foto;
                }

                else
                {
                    $file = $request->file('gambar');
                    $fileName = $file->getClientOriginalName();
                    $path = public_path('image/'. $fileName);
                    Image::make($file->getRealPath())->resize(650, 350)->save($path);
                    File::delete('image/'.$dataGalery->foto);
                }

                $datas = [
                    'deskripsi' => $request->deskripsi,
                    'foto' => $fileName,
                ];
                galeries::where('id', $request->id)->update($datas);
                return redirect()->back()->with('status','Update Success !!!');  
                          
        endif;
    }

    public function delete(Request $request)
    {
        $galery = galeries::find($request->id);
        File::delete('image/'.$galery->foto);
        $galery->delete();
        return response ()->json ( $galery );
    }

    public function getData(Request $request)
    {
        $galery = galeries::find($request->id);
        return response ()->json ( $galery );
    }

}
