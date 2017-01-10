<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\produksi;
use App\pemesanan;
use Vinkla\Pusher\Facades\Pusher;

class ShippingStatusUpdated implements ShouldBroadcast
{
    //
    public $id;

    public function __construct($id=null)
    {
        $this->id = $id;
    }

    public function broadcaston()
    {
    	$notif_produksi = produksi::where('konfirmasi_stok', '=', 'n')->count();
    	$notif_pemesanan = pemesanan::where('konfirmasi_pemesanan', '=', 'n')->count();
		Pusher::trigger('my-channel', 'my-event', ['message' => $notif_produksi]);
		Pusher::trigger('my-pemesanan', 'my-pemesanan', ['pemesanan' => $notif_pemesanan]);
		Pusher::trigger('my-konfir-pemesanan', 'my-konfir-pemesanan', ['konfir_pemesanan' => $this->id]);
    }
}