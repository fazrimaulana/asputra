<table class="table table-bordered" align="center">
  <tr>
    <td colspan="5" align="center"><h2><b>Laporan Penjualan Ayam</b></h2></td>
  </tr>
  <tr>
    <td colspan="5" align="center"><h3><b>{{App\Helpers\Tanggal::BulanTahun($date)}}</b></h3></td>
  </tr>
  <tr></tr>
  <tr>
    <th style="width: 10px" align="center">No</th>
    <th style="width: 15px" align="center">Tanggal</th>
    <th style="width: 15px" align="center">Jumlah Penjualan</th>
    <th style="width: 15px" align="center">Harga Per Ayam</th>
    <th style="width: 15px" align="center">Total</th>
  </tr>
  @foreach($penjualan_ayam as $data)
  <tr class="item{{$data->id_penjualan_ayam}}">
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