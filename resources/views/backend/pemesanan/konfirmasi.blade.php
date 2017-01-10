@extends('layouts.backend.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Pemesanan
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pemesanan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Form Konfirmasi Data Pemesanan</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post">
            <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
            {{ csrf_field() }}
            <input type="text" style="display: none" name="id_pemesanan" id="id_pemesanan" class="form-control id" value="{{ $data->id_pemesanan }}">
              <div class="box-body">

              <table class="table table-bordere">
                <thead>
                  <td>No</td>
                  <td>Tanggal Pemesanan</td>
                  <td>Jumlah Pemesanan</td>
                  <td>Harga Per Peti</td>
                  <td>Total</td>
                  <td>Alamat</td>
                  <td>No Handphone</td>
                </thead>
                <tbody>
                  <td>1.</td>
                  <td>{{ $data->tgl_pemesanan }}</td>
                  <td>{{ $data->jml_pemesanan }}</td>
                  <td>{{ $data->harga_per_peti }}</td>
                  <td>{{ $data->total }}</td>
                  <td>{{ $data->alamat }}</td>
                  <td>{{ $data->no_hp }}</td>
                </tbody>
              </table>
                <div class="form-group{{ $errors->has('tgl_pemesanan') ? ' has-error' : '' }}">
                  <label for="Tanggal Pemesanan" style="display: none">Tanggal Pemesanan</label>
                  <input type="text" class="form-control" id="datepicker" placeholder="Tanggal Pemesanan" name="tgl_pemesanan" value="{{ $data->tgl_pemesanan }}" style="display: none" readonly="readonly">
                  @if($errors->has('tgl_pemesanan'))
                    <span style="color: red;">{{ $errors->first('tgl_pemesanan') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('jml_pemesanan') ? ' has-error' : '' }}">
                  <label for="Jumlah Pemesanan" style="display: none">Jumlah Pemesanan (Per Peti)</label>
                  <input type="text" class="form-control" id="jml_pemesanan" placeholder="Jumlah Pemesanan" name="jml_pemesanan" value="{{ $data->jml_pemesanan }}" readonly="readonly" style="display: none">
                  @if($errors->has('jml_pemesanan'))
                    <span style="color: red;">{{ $errors->first('jml_pemesanan') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                  <label class="control-label" style="display: none">Alamat</label>
                  <input type="text" class="form-control" placeholder="Alamat" name="alamat" value="{{ $data->alamat }}" readonly="readonly" style="display: none">
                  @if($errors->has('alamat'))
                    <span style="color: red;">{{ $errors->first('alamat') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('no_hp') ? ' has-error' : '' }}">
                  <label class="control-label" style="display: none">No Handphone</label>
                  <input type="text" class="form-control" placeholder="No Handphone" name="no_hp" value="{{ $data->no_hp }}" readonly="readonly" style="display: none">
                  @if($errors->has('no_hp'))
                    <span style="color: red;">{{ $errors->first('no_hp') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('harga_per_peti') ? ' has-error' : '' }}">
                  <label class="control-label" style="display: none">Harga Per Peti</label>
                  <input type="text" class="form-control harga" id="harga" placeholder="Harga Per Peti" name="harga_per_peti" value="{{ $data->harga_per_peti }}" readonly="readonly" style="display: none">
                  @if($errors->has('harga_per_peti'))
                    <span style="color: red;">{{ $errors->first('harga_per_peti') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('total') ? ' has-error' : '' }}">
                  <label class="control-label" style="display: none">Total</label>
                  <input type="text" class="form-control total" id="total" placeholder="Total" name="total" value="{{ $data->total }}" readonly="readonly" style="display: none">
                  @if($errors->has('total'))
                    <span style="color: red;">{{ $errors->first('total') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('jml_stok') ? ' has-error' : '' }}">
                  <label class="control-label" style="display: none">Stok</label>
                  <input type="text" class="form-control" id="stok" placeholder="Stok" name="stok" value="{{ $jml_stok }}" readonly="readonly" style="display: none">
                  @if($errors->has('stok'))
                    <span style="color: red;">{{ $errors->first('stok') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('tgl_konfirmasi') ? ' has-error' : '' }}">
                  <label class="control-label">Tanggal Konfirmasi</label>
                  <input type="text" class="form-control" id="tgl-konfirmasi" placeholder="Tanggal Konfirmasi" name="tgl_konfirmasi" value="{{ old('tgl_konfirmasi') }}">
                  @if($errors->has('tgl_konfirmasi'))
                    <span style="color: red;">{{ $errors->first('tgl_konfirmasi') }}</span>
                  @endif
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-sm btn-update" value="Update" id="btn-update" name="btn-update">Konfirmasi</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

@section('js')
    <script type="text/javascript">
      $('#tgl-konfirmasi').datepicker({
                    format: "yyyy/mm/dd",
                    autoclose:true,
                    todayHighlight: true
                });
    </script>
@stop
