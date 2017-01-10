<div class="row">
  <div class="col-md-12">
  <center>
    <h3><b>Laporan Pembelian</b></h3>
    <h4><b><div class="tgl">{{App\Helpers\Tanggal::BulanTahun($date)}}</div></b></h4>                
    <hr>
  </center>
  </div>
</div>
<table class="table table-bordered" align="center">
  <tr>
    <th style="text-align: center;">No</th>
    <th style="text-align: center;">Tanggal</th>
    <th style="text-align: center;">Nama Barang</th>
    <th style="text-align: center;">Jumlah Pembelian</th>
    <th style="text-align: center;">Harga Satuan</th>
    <th style="text-align: center;">Total</th>
  </tr>
  @foreach($pembelian as $data)
  <tr class="item{{$data->id_pembelian}}">
    <td align="center">{{ $no++ }}</td>
    <td align="center">{{ App\Helpers\Tanggal::BulanIndo($data->tgl_pembelian) }}</td>
    <td align="center">{{ $data->nama_barang }}</td>
    <td align="center">{{ $data->jml_pembelian }}</td>
    <td align="center">{{ number_format($data->harga_satuan) }}</td>
    <td align="center">{{ number_format($data->total) }}</td>
  </tr>
  @endforeach
  <tr>
    <td colspan="6"><label class="label-control">Keterangan</label></td>
  </tr>
  <tr>
    <td colspan="5"><label class="label-control">Total Pembelian</label></td>
    <td align="center"><label class="label-control"> {{ number_format($total_pembelian) }} </label></td>
  </tr>
</table>