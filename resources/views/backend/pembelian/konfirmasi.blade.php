@extends('layouts.backend.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Pembelian
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pembelian</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Form Konfirmasi Data Pembelian</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post">
            <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
            {{ csrf_field() }}
            <input type="text" style="display: none" name="id_pembelian" id="id_pembelian" class="form-control id" value="{{ $data->id_pembelian }}">
              <div class="box-body">

              <table class="table table-bordere">
                <thead>
                  <td>No</td>
                  <td>Tanggal Pembelian</td>
                  <td>Jumlah Pembelian</td>
                  <td>Harga Satuan</td>
                  <td>Total</td>
                </thead>
                <tbody>
                  <td>1.</td>
                  <td>{{ $data->tgl_pembelian }}</td>
                  <td>{{ $data->jml_pembelian }}</td>
                  <td>{{ $data->harga_satuan }}</td>
                  <td>{{ $data->total }}</td>
                </tbody>
              </table>
                <div class="form-group{{ $errors->has('tgl_pembelian') ? ' has-error' : '' }}">
                  <label for="Tanggal Pembelian" style="display: none">Tanggal Pembelian</label>
                  <input type="text" class="form-control" id="datepicker" placeholder="Tanggal Pembelian" name="tgl_pembelian" value="{{ $data->tgl_pembelian }}" style="display: none" readonly="readonly">
                  @if($errors->has('tgl_pembelian'))
                    <span style="color: red;">{{ $errors->first('tgl_pembelian') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('jml_pembelian') ? ' has-error' : '' }}">
                  <label for="Jumlah Pembelian" style="display: none">Jumlah Pembelian</label>
                  <input type="text" class="form-control" id="jml_pembelian" placeholder="Jumlah Pembelian" name="jml_pembelian" value="{{ $data->jml_pembelian }}" readonly="readonly" style="display: none">
                  @if($errors->has('jml_pembelian'))
                    <span style="color: red;">{{ $errors->first('jml_pembelian') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('harga_satuan') ? ' has-error' : '' }}">
                  <label class="control-label" style="display: none">Harga Satuan</label>
                  <input type="text" class="form-control harga" id="harga" placeholder="Harga Satuan" name="harga_satuan" value="{{ $data->harga_satuan }}" readonly="readonly" style="display: none">
                  @if($errors->has('harga_satuan'))
                    <span style="color: red;">{{ $errors->first('harga_satuan') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('total') ? ' has-error' : '' }}">
                  <label class="control-label" style="display: none">Total</label>
                  <input type="text" class="form-control total" id="total" placeholder="Total" name="total" value="{{ $data->total }}" readonly="readonly" style="display: none">
                  @if($errors->has('total'))
                    <span style="color: red;">{{ $errors->first('total') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('tgl_konfirmasi') ? ' has-error' : '' }}">
                  <label class="control-label">Tanggal Konfirmasi</label>
                  <input type="text" class="form-control" id="tgl-konfirmasi" placeholder="Tanggal Konfirmasi" name="tgl_konfirmasi" value="{{ old('tgl_konfirmasi') }}">
                  @if($errors->has('tgl_konfirmasi'))
                    <span style="color: red;">{{ $errors->first('tgl_konfirmasi') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('ayam_masuk') ? ' has-error' : '' }}">
                  <label class="control-label">Jumlah Ayam Masuk</label>
                  <input type="text" class="form-control" id="ayam_masuk" placeholder="Jumlah Ayam Masuk" name="ayam_masuk" value="{{ old('ayam_masuk') }}">
                  @if($errors->has('ayam_masuk'))
                    <span style="color: red;">{{ $errors->first('ayam_masuk') }}</span>
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
