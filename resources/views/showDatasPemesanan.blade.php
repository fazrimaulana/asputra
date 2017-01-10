<ul class="menu">
	<li>
		@foreach($data as $datas)
		<a href="{{ url('/data-pemesanan/'.$datas->id_pemesanan.'/konfirmasi') }}">
		<i class="fa fa-cart-plus"></i> &nbsp&nbsp{{ $datas->tgl_pemesanan }}
		<br>
		Jumlah Pemesanan {{$datas->jml_pemesanan}} Peti
    	</a>
		@endforeach
    </li>
</ul>
