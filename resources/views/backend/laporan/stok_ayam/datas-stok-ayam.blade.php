<div class="row">
  <div class="col-md-12">
  <center>
    <h3><b>Laporan Data Stok Ayam</b></h3>
    <h4><b><div class="tgl">{{App\Helpers\Tanggal::BulanTahun($date)}}</div></b></h4>                
    <hr>
  </center>
  </div>
</div>
<table class="table table-bordered" align="center">
  <tr>
    <th style="text-align: center;">No</th>
    <th style="text-align: center;">Tanggal</th>
    <th style="text-align: center;">Ayam Masuk</th>
    <th style="text-align: center;">Ayam Keluar</th>
    <th></th>
  </tr>
  @foreach($stok_ayam as $data)
  <tr class="item{{$data->id_stok_telur}}">
    <td align="center">{{ $no++ }}</td>
    <td align="center">{{ App\Helpers\Tanggal::BulanIndo($data->tgl_stok_ayam) }}</td>
    <td align="center">{{ $data->ayam_masuk }}</td>
    <td align="center">{{ $data->ayam_keluar }}</td>
    <td></td>
  </tr>
  @endforeach
  <tr>
    <td colspan="5"><label class="label-control">Keterangan</label></td>
  </tr>
  <tr>
    <td colspan="2"><label class="label-control">Jumlah Ayam Masuk</label></td>
    <td align="center"><label class="label-control"> {{ $ayam_masuk }} </label></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="3"><label class="label-control">Jumlah Ayam Keluar</label></td>
    <td align="center"><label class="label-control"> {{ $ayam_keluar }} </label></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="4"><label class="label-control">Jumlah Stok Ayam</label></td>
    <td><label class="label-control"> {{ $jml_stok }} </label></td>
  </tr>
</table>