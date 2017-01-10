<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Print Laporan Stok Telur</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ url('/backend/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/backend/dist/css/AdminLTE.min.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body onload="window.print();">             
  <div class="row">
    <div class="col-md-12">
      <center>
        <h3><b>Laporan Data Stok Telur</b></h3>
        <h4><b><div class="tgl">{{App\Helpers\Tanggal::BulanTahun($date)}}</div></b></h4>                
        <hr>
      </center>
    </div>
  </div>
  <table class="table table-bordered" align="center">
    <tr>
      <th style="text-align: center;">No</th>
      <th style="text-align: center;">Tanggal</th>
      <th style="text-align: center;">Telur Masuk</th>
      <th style="text-align: center;">Telur Keluar</th>
      <th></th>
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
      <td><label class="label-control"> {{ $jml_stok }} </label></td>
    </tr>
  </table>
</body>
</html>
