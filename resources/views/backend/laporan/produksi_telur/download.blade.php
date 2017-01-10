<table class="table table-bordered" align="center">
  <tr>
    <td colspan="3" align="center"><h2><b>Laporan Produksi Telur</b></h2></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><h3><b>{{App\Helpers\Tanggal::BulanTahun($date)}}</b></h3></td>
  </tr>
  <tr></tr>
  <tr>
    <th style="width: 10px" align="center">No</th>
    <th style="width: 18px" align="center">Tanggal</th>
    <th style="width: 15px" align="center">Jumlah Produksi</th>
  </tr>
  @foreach($produksi as $data)
  <tr class="item{{$data->id_produksi}}">
    <td align="center">{{ $no++ }}</td>
    <td align="center">{{ App\Helpers\Tanggal::BulanIndo($data->tgl_produksi) }}</td>
    <td align="center">{{ $data->jml_produksi }}</td>
  </tr>
  @endforeach
  <tr>
    <td colspan="3"><label class="label-control">Keterangan</label></td>
  </tr>
  <tr>
    <td colspan="2"><label class="label-control">Total Produksi</label></td>
    <td align="center"><label class="label-control"> {{ $total_produksi }} </label></td>
  </tr>
</table>