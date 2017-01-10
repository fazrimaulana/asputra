@extends('layouts.backend.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Produksi Telur
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ url('/data-produksi') }}">Produksi</a></li>
        <!-- <li class="active">Fixed</li> -->
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          @if (session('status'))
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              {{ session('status') }}
            </div>
          @endif
        </div>
      </div>
      
      <div class="row">
        <!-- left column -->
        <div class="col-md-4">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Form Tambah Data Produksi Telur</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post">
            <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
            {{ csrf_field() }}
            <input type="text" style="display: none" name="action" id="action" class="form-control action" value="{{ old('action') }}">
            <input type="text" style="display: none" name="id" id="id" class="form-control id" value="{{ old('id') }}">
              <div class="box-body">
                <div class="form-group{{ $errors->has('tgl_produksi') ? ' has-error' : '' }}">
                  <label for="Tanggal Produksi">Tanggal Produksi</label>
                  <input type="text" class="form-control" id="datepicker" placeholder="Tanggal Produksi" name="tgl_produksi" value="{{ old('tgl_produksi') }}">
                  @if($errors->has('tgl_produksi'))
                    <span style="color: red;">{{ $errors->first('tgl_produksi') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('jml_produksi') ? ' has-error' : '' }}">
                  <label for="Jumlah Produksi">Jumlah Produksi</label>
                  <input type="text" class="form-control" id="jml_produksi" placeholder="Jumlah Produksi" name="jml_produksi" value="{{ old('jml_produksi') }}">
                  @if($errors->has('jml_produksi'))
                    <span style="color: red;">{{ $errors->first('jml_produksi') }}</span>
                  @endif
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-sm btn-save" value="save" id="btn-save" name="btn">Save</button>
                <button type="reset" class="btn btn-warning btn-sm">Reset</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>

        <div class="col-md-8">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Produksi Telur</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
                <table class="table table-bordered">
                <tr>
                  <th>No</th>
                  <th>Tanggal Produksi</th>
                  <th>Jumlah Produksi</th>
                  <th>Action</th>
                </tr>
                @foreach($produksi as $data)
                <tr class="item{{$data->id_produksi}}">
                  <td>{{ $no++ }}</td>
                  <td>{{ $data->tgl_produksi }}</td>
                  <td>{{ $data->jml_produksi }}</td>
                  <td>
                    <button href="javascript:;" class="btn btn-xs btn-info edit" data-id="{{ $data->id_produksi }}" data-tgl="{{ $data->tgl_produksi }}" data-jml="{{ $data->jml_produksi }}">Edit</button>
                    <!-- <a href="{{ url('/data-produksi/'.$data->id_produksi.'/delete') }}" class="btn btn-xs btn-danger">Delete</a> -->
                    <button class="delete-modal btn btn-danger btn-xs" data-id="{{$data->id_produksi}}">Delete</button>
                  </td>
                </tr>
                @endforeach
                <tr>
                  <td colspan="2" align="center"><label class="control-label">Total Produksi</label></td>
                  <td colspan="2" align="center"><label class="control-label">{{ $total_produksi }}</label></td>
                </tr>
              </table>
              {{ $produksi->render() }}
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>

      </div>

    </section>
    <!-- /.content -->

    <div class="modal fade bs-example-modal-sm3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Delete Data Produksi</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              {{ csrf_field() }}
              <input type="hidden" name="id-delete" id="id-delete">
              <p>Yakin Ingin Menghapus Data? </p>
            </div>
            <div class="form-group" align="right">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="button" id="delete" class="btn btn-danger" data-dismiss="modal">Delete</button>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
  <!-- /.content-wrapper -->

  

@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function(){

    $('#datepicker').datepicker({
          autoclose: true,
          format: 'yyyy/mm/dd',
          todayHighlight: true
        });

    $(document).on('click', '.edit', function() {
      $('#id').val($(this).data('id'));
      $('#datepicker').val($(this).data('tgl'));
      $('#jml_produksi').val($(this).data('jml'));
      $('#action').val('update');
    });


    $(document).on('click', '.delete-modal', function() {
    $('#id-delete').val($(this).data('id'));
    $('.bs-example-modal-sm3').modal('show');
    });


    $("#delete").click(function() {
        $.ajax({
            type: 'post',
            url: 'delete/produksi',
            data: {
                '_token': $('input[name=_token]').val(),
                'id' : $('input[name=id-delete]').val()
            },
            success: function(data) {
                $('.item' + data.id_produksi).remove();
                /*toastr.success("Data Berhasil Dihapus.");*/
                console.log(data);
            }
        });
    });


  });
     
</script>
@stop