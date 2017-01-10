@extends('layouts.backend.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detail
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Detail</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Form Konfirmasi Data Produksi Telur Masuk Gudang</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post">
            <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
            {{ csrf_field() }}
            <input type="text" style="display: none" name="produksi_id" id="produksi_id" class="form-control id" value="{{ $konfirmasi->id_produksi }}">
              <div class="box-body">
                <div class="form-group{{ $errors->has('tgl_produksi') ? ' has-error' : '' }}">
                  <label for="Tanggal Produksi">Tanggal Produksi</label>
                  <input type="text" class="form-control" id="datepicker" placeholder="Tanggal Produksi" name="tgl_produksi" value="{{ $konfirmasi->tgl_produksi }}" readonly="readonly">
                  @if($errors->has('tgl_produksi'))
                    <span style="color: red;">{{ $errors->first('tgl_produksi') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('jml_produksi') ? ' has-error' : '' }}">
                  <label for="Jumlah Produksi">Jumlah Produksi</label>
                  <input type="text" class="form-control" id="jml_produksi" placeholder="Jumlah Produksi" name="jml_produksi" value="{{ $konfirmasi->jml_produksi }}" readonly="readonly">
                  @if($errors->has('jml_produksi'))
                    <span style="color: red;">{{ $errors->first('jml_produksi') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('tgl_stok_telur') ? ' has-error' : '' }}">
                  <label for="Tanggal Stok">Tanggal Stok</label>
                  <input type="text" class="form-control" id="tgl_stok_telur" placeholder="Tanggal Stok" name="tgl_stok_telur">
                  @if($errors->has('tgl_stok_telur'))
                    <span style="color: red;">{{ $errors->first('tgl_stok_telur') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('telur_masuk') ? ' has-error' : '' }}">
                  <label for="Telur Masuk">Telur Masuk</label>
                  <input type="text" class="form-control" id="telur_masuk" placeholder="Telur Masuk" name="telur_masuk">
                  @if($errors->has('telur_masuk'))
                    <span style="color: red;">{{ $errors->first('telur_masuk') }}</span>
                  @endif
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-sm btn-update" value="Update" id="btn-update" name="btn-update">Update</button>
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
        $('#tgl_stok_telur').datepicker({
          autoclose: true,
          format: 'yyyy/mm/dd',
        });
    </script>
@stop
