<table class="table table-bordered" align="center">
  <tr>
    <td colspan="6" align="center"><h2><b>Laporan Pembelian</b></h2></td>
  </tr>
  <tr>
    <td colspan="6" align="center"><h3><b>{{App\Helpers\Tanggal::BulanTahun($date)}}</b></h3></td>
  </tr>
  <tr></tr>
  <tr>
    <th style="width: 10px" align="center">No</th>
    <th style="width: 15px" align="center">Tanggal</th>
    <th style="width: 15px" align="center">Nama Barang</th>
    <th style="width: 15px" align="center">Jumlah Pembelian</th>
    <th style="width: 15px" align="center">Harga Satuan</th>
    <th style="width: 15px" align="center">Total</th>
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