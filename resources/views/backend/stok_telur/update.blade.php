@extends('layouts.backend.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Update Data Stok
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Update Data Stok</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Form Update Data Stok</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
              @if ($action=="in")

                <form method="post">
                  <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
                  {{ csrf_field() }}
                  <input type="hidden" name="action" value="{{$action}}">
                  <input type="text" style="display: none" name="produksi_id" id="produksi_id" class="form-control id" value="{{ $produksi->id_produksi }}">
                  <input type="text" style="display: none" name="id_stok_telur" id="id_stok_telur" class="form-control id" value="{{ $stok->id_stok_telur }}">
                <div class="form-group{{ $errors->has('tgl_produksi') ? ' has-error' : '' }}">
                  <label for="Tanggal Produksi">Tanggal Produksi</label>
                  <input type="text" class="form-control" id="datepicker" placeholder="Tanggal Produksi" name="tgl_produksi" value="{{ $produksi->tgl_produksi }}" readonly="readonly">
                  @if($errors->has('tgl_produksi'))
                    <span style="color: red;">{{ $errors->first('tgl_produksi') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('jml_produksi') ? ' has-error' : '' }}">
                  <label for="Jumlah Produksi">Jumlah Produksi</label>
                  <input type="text" class="form-control" id="jml_produksi" placeholder="Jumlah Produksi" name="jml_produksi" value="{{ $produksi->jml_produksi }}" readonly="readonly">
                  @if($errors->has('jml_produksi'))
                    <span style="color: red;">{{ $errors->first('jml_produksi') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('tgl_stok_telur') ? ' has-error' : '' }}">
                  <label for="Tanggal Stok">Tanggal Stok</label>
                  <input type="text" class="form-control" id="tgl_stok_telur" placeholder="Tanggal Stok" name="tgl_stok_telur" value="{{ $stok->tgl_stok_telur }}">
                  @if($errors->has('tgl_stok_telur'))
                    <span style="color: red;">{{ $errors->first('tgl_stok_telur') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('telur_masuk') ? ' has-error' : '' }}">
                  <label for="Telur Masuk">Telur Masuk</label>
                  <input type="text" class="form-control" id="telur_masuk" placeholder="Telur Masuk" name="telur_masuk" value="{{ $stok->telur_masuk }}">
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

            @else

                <form method="post">
                  <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
                  {{ csrf_field() }}
                  <input type="text" style="display: none" name="id_penjualan_telur" id="id_penjualan_telur" class="form-control id" value="{{ $penjualan->id_penjualan_telur }}">
                  <input type="text" style="display: none" name="id_stok_telur" id="id_stok_telur" class="form-control id" value="{{ $stok->id_stok_telur }}">
                <div class="form-group{{ $errors->has('tgl_penjualan') ? ' has-error' : '' }}">
                  <label for="Tanggal Penjualan">Tanggal Penjualan</label>
                  <input type="text" class="form-control" id="datepicker" placeholder="Tanggal Penjualan" name="tgl_penjualan_telur" value="{{ $penjualan->tgl_penjualan_telur }}" readonly="readonly">
                  @if($errors->has('tgl_penjualan_telur'))
                    <span style="color: red;">{{ $errors->first('tgl_penjualan_telur') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('jml_penjualan_telur') ? ' has-error' : '' }}">
                  <label for="Jumlah Penjualan Telur">Jumlah Penjualan</label>
                  <input type="text" class="form-control" id="jml_penjualan_telur" placeholder="Jumlah Penjualan Telur" name="jml_penjualan_telur" value="{{ $penjualan->jml_penjualan_telur }}" readonly="readonly">
                  @if($errors->has('jml_penjualan_telur'))
                    <span style="color: red;">{{ $errors->first('jml_penjualan_telur') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('tgl_stok_telur') ? ' has-error' : '' }}">
                  <label for="Tanggal Stok">Tanggal Stok</label>
                  <input type="text" class="form-control" id="tgl_stok_telur" placeholder="Tanggal Stok" name="tgl_stok_telur" value="{{ $stok->tgl_stok_telur }}">
                  @if($errors->has('tgl_stok_telur'))
                    <span style="color: red;">{{ $errors->first('tgl_stok_telur') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('telur_keluar') ? ' has-error' : '' }}">
                  <label for="Telur Keluar">Telur Keluar</label>
                  <input type="text" class="form-control" id="telur_keluar" placeholder="Telur Keluar" name="telur_keluar" value="{{ $stok->telur_keluar }}">
                  @if($errors->has('telur_keluar'))
                    <span style="color: red;">{{ $errors->first('telur_keluar') }}</span>
                  @endif
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-sm btn-update" value="Update" id="btn-update" name="btn-update">Update</button>
              </div>
              </form>

            @endif
            
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
