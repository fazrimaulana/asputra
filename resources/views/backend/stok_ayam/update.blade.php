@extends('layouts.backend.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Update Data Stok Ayam
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Update Data Stok Ayam</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Form Update Data Stok Ayam</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
              @if ($action=="in")

                <form method="post">
                  <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
                  {{ csrf_field() }}
                  <input type="hidden" name="action" value="{{$action}}">
                  <input type="text" style="display: none" name="pembelian_id" id="pembelian_id" class="form-control id" value="{{ $pembelian->id_pembelian }}">
                  <input type="text" style="display: none" name="id_stok_ayam" id="id_stok_ayam" class="form-control id" value="{{ $stok->id_stok_ayam }}">
                <div class="form-group{{ $errors->has('tgl_pembelian') ? ' has-error' : '' }}">
                  <label for="Tanggal Pembelian">Tanggal Pembelian</label>
                  <input type="text" class="form-control" id="datepicker" placeholder="Tanggal Pembelian" name="tgl_pembelian" value="{{ $pembelian->tgl_pembelian }}" readonly="readonly">
                  @if($errors->has('tgl_pembelian'))
                    <span style="color: red;">{{ $errors->first('tgl_pembelian') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('jml_pembelian') ? ' has-error' : '' }}">
                  <label for="Jumlah Pembelian">Jumlah Pembelian</label>
                  <input type="text" class="form-control" id="jml_pembelian" placeholder="Jumlah Pembelian" name="jml_pembelian" value="{{ $pembelian->jml_pembelian }}" readonly="readonly">
                  @if($errors->has('jml_pembelian'))
                    <span style="color: red;">{{ $errors->first('jml_pembelian') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('tgl_stok_ayam') ? ' has-error' : '' }}">
                  <label for="Tanggal Stok">Tanggal Stok</label>
                  <input type="text" class="form-control" id="tgl_stok_ayam" placeholder="Tanggal Stok" name="tgl_stok_ayam" value="{{ $stok->tgl_stok_ayam }}">
                  @if($errors->has('tgl_stok_ayam'))
                    <span style="color: red;">{{ $errors->first('tgl_stok_ayam') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('ayam_masuk') ? ' has-error' : '' }}">
                  <label for="Ayam Masuk">Ayam Masuk</label>
                  <input type="text" class="form-control" id="ayam_masuk" placeholder="Ayam Masuk" name="ayam_masuk" value="{{ $stok->ayam_masuk }}">
                  @if($errors->has('ayam_masuk'))
                    <span style="color: red;">{{ $errors->first('ayam_masuk') }}</span>
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
                  <input type="text" style="display: none" name="id_penjualan_ayam" id="id_penjualan_ayam" class="form-control id" value="{{ $penjualan->id_penjualan_ayam }}">
                  <input type="text" style="display: none" name="id_stok_ayam" id="id_stok_ayam" class="form-control id" value="{{ $stok->id_stok_ayam }}">
                <div class="form-group{{ $errors->has('tgl_penjualan') ? ' has-error' : '' }}">
                  <label for="Tanggal Penjualan">Tanggal Penjualan</label>
                  <input type="text" class="form-control" id="datepicker" placeholder="Tanggal Penjualan" name="tgl_penjualan_ayam" value="{{ $penjualan->tgl_penjualan_ayam }}" readonly="readonly">
                  @if($errors->has('tgl_penjualan_ayam'))
                    <span style="color: red;">{{ $errors->first('tgl_penjualan_ayam') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('jml_penjualan_ayam') ? ' has-error' : '' }}">
                  <label for="Jumlah Penjualan Ayam">Jumlah Penjualan</label>
                  <input type="text" class="form-control" id="jml_penjualan_ayam" placeholder="Jumlah Penjualan Ayam" name="jml_penjualan_ayam" value="{{ $penjualan->jml_penjualan_ayam }}" readonly="readonly">
                  @if($errors->has('jml_penjualan_ayam'))
                    <span style="color: red;">{{ $errors->first('jml_penjualan_ayam') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('tgl_stok_ayam') ? ' has-error' : '' }}">
                  <label for="Tanggal Stok">Tanggal Stok</label>
                  <input type="text" class="form-control" id="tgl_stok_ayam" placeholder="Tanggal Stok" name="tgl_stok_ayam" value="{{ $stok->tgl_stok_ayam }}">
                  @if($errors->has('tgl_stok_ayam'))
                    <span style="color: red;">{{ $errors->first('tgl_stok_ayam') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('ayam_keluar') ? ' has-error' : '' }}">
                  <label for="Ayam Keluar">Ayam Keluar</label>
                  <input type="text" class="form-control" id="ayam_keluar" placeholder="Ayam Keluar" name="ayam_keluar" value="{{ $stok->ayam_keluar }}">
                  @if($errors->has('ayam_keluar'))
                    <span style="color: red;">{{ $errors->first('ayam_keluar') }}</span>
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
        $('#tgl_stok_ayam').datepicker({
          autoclose: true,
          format: 'yyyy/mm/dd',
        });
    </script>
@stop
