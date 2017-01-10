<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Vinkla\Pusher\Facades\Pusher;

use App\Events\ShippingStatusUpdated;
use App\produksi;

class PusherController extends Controller
{
    //
	public function index()
	{
		$notif_produksi = produksi::where('konfirmasi_stok', '=', 'n')->count();
		event(new ShippingStatusUpdated);
		return view('pusher',[
				'count' => $notif_produksi
			]);
	}
}
