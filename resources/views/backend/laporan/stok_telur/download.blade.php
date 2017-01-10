<table class="table table-bordered" align="center">
  <tr>
    <td colspan="5" align="center"><h2><b>Laporan Data Stok telur</b></h2></td>
  </tr>
  <tr>
    <td colspan="5" align="center"><h3><b>{{App\Helpers\Tanggal::BulanTahun($date)}}</b></h3></td>
  </tr>
  <tr></tr>
  <tr>
    <th style="width: 10px" align="center">No</th>
    <th style="width: 18px" align="center">Tanggal</th>
    <th style="width: 15px" align="center">Telur Masuk</th>
    <th style="width: 15px" align="center">Telur Keluar</th>
    <th style="width: 15px"></th>
  </tr>
  @foreach($stok_telur as $data)
  <tr class="item{{$data->id_stok_telur}}">
    <td align="center">{{ $no++ }}</td>
    <td align="center">{{ App\Helpers\Tanggal::BulanIndo($data->tgl_stok_telur) }}</td>
    <td align="center">{{ $data->telur_masuk }}</td>
    <td align="center">{{ $data->telur_keluar }}</td>
    <td></td>
  </tr>
  @endforeach
  <tr>
    <td colspan="5"><label class="label-control">Keterangan</label></td>
  </tr>
  <tr>
    <td colspan="2"><label class="label-control">Jumlah Telur Masuk</label></td>
    <td align="center"><label class="label-control"> {{ $telur_masuk }} </label></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="3"><label class="label-control">Jumlah Telur Keluar</label></td>
    <td align="center"><label class="label-control"> {{ $telur_keluar }} </label></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="4"><label class="label-control">Jumlah Stok Telur</label></td>
    <td align="center"><label class="label-control"> {{ $jml_stok }} </label></td>
  </tr>
</table>