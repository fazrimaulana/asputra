<div class="row">
  <div class="col-md-12">
  <center>
    <h3><b>Laporan Penjualan Ayam</b></h3>
    <h4><b><div class="tgl">{{App\Helpers\Tanggal::BulanTahun($date)}}</div></b></h4>                
    <hr>
  </center>
  </div>
</div>
<table class="table table-bordered" align="center">
  <tr>
    <th style="text-align: center;">No</th>
    <th style="text-align: center;">Tanggal</th>
    <th style="text-align: center;">Jumlah Penjualan</th>
    <th style="text-align: center;">Harga Per Ayam</th>
    <th style="text-align: center;">Total</th>
  </tr>
  @foreach($penjualan_ayam as $data)
  <tr class="item{{$data->id_penjualan_telur}}">
    <td align="center">{{ $no++ }}</td>
    <td align="center">{{ App\Helpers\Tanggal::BulanIndo($data->tgl_penjualan_ayam) }}</td>
    <td align="center">{{ $data->jml_penjualan_ayam }}</td>
    <td align="center">{{ number_format($data->harga_per_ayam) }}</td>
    <td align="center">{{ number_format($data->total) }}</td>
  </tr>
  @endforeach
  <tr>
    <td colspan="5"><label class="label-control">Keterangan</label></td>
  </tr>
  <tr>
    <td colspan="4"><label class="label-control">Total Penjualan Ayam</label></td>
    <td align="center"><label class="label-control"> {{ number_format($total_penjualan_ayam) }} </label></td>
  </tr>
</table>