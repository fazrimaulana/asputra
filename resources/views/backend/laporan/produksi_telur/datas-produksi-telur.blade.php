<div class="row">
  <div class="col-md-12">
  <center>
    <h3><b>Laporan Produksi Telur</b></h3>
    <h4><b><div class="tgl">{{App\Helpers\Tanggal::BulanTahun($date)}}</div></b></h4>                
    <hr>
  </center>
  </div>
</div>
<table class="table table-bordered" align="center">
  <tr>
    <th style="text-align: center;">No</th>
    <th style="text-align: center;">Tanggal</th>
    <th style="text-align: center;">Jumlah Produksi</th>
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