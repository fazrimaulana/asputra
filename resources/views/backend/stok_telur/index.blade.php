@extends('layouts.backend.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Stok Telur
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ url('/data-stok-telur') }}">Stok Telur</a></li>
        <!-- <li class="active">Fixed</li> -->
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-map"></i> <h3 class="box-title">Data Stok Telur</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
                <table class="table table-bordered">
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Telur Masuk</th>
                  <th>Telur Keluar</th>
                  <th>Action</th>
                </tr>
                @foreach($stok_telur as $data)
                <tr class="item{{$data->id_stok_telur}}">
                  <td>{{ $no++ }}</td>
                  <td>{{ $data->tgl_stok_telur }}</td>
                  <td>{{ $data->telur_masuk }}</td>
                  <td>{{ $data->telur_keluar }}</td>
                  <td>
                    <a href="{{ url('/data-stok-telur/'.$data->id_stok_telur.'/update') }}" class="btn btn-xs btn-info edit">Edit</a>
                    <!-- <a href="{{ url('/data-stok-telur/'.$data->id_stok_telur.'/delete') }}" class="btn btn-xs btn-danger">Delete</a> -->
                    <button class="delete-modal btn btn-danger btn-xs" data-id="{{$data->id_stok_telur}}">Delete</button>
                  </td>
                </tr>
                @endforeach
                <tr>
                  <td colspan="5">{{ $stok_telur->render() }}</td>
                </tr>
                <tr>
                  <td colspan="5"><label class="label-control">Keterangan</label></td>
                </tr>
                <tr>
                  <td colspan="2"><label class="label-control">Jumlah Telur Masuk</label></td>
                  <td colspan="3"><label class="label-control"> {{ $jml_telur_masuk }} </label></td>
                </tr>
                <tr>
                  <td colspan="3"><label class="label-control">Jumlah Telur Keluar</label></td>
                  <td colspan="2"><label class="label-control"> {{ $jml_telur_keluar }} </label></td>
                </tr>
                <tr>
                  <td colspan="4"><label class="label-control">Jumlah Stok Telur</label></td>
                  <td><label class="label-control"> {{ $jml_stok }} </label></td>
                </tr>
              </table>
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
  
  $(document).on('click', '.delete-modal', function() {
    $('#id-delete').val($(this).data('id'));
    $('.bs-example-modal-sm3').modal('show');
    });


    $("#delete").click(function() {
        $.ajax({
            type: 'post',
            url: 'delete/stok-telur',
            data: {
                '_token': $('input[name=_token]').val(),
                'id' : $('input[name=id-delete]').val()
            },
            success: function(data) {
                $('.item' + data.id_stok_telur).remove();
                /*toastr.success("Data Berhasil Dihapus.");*/
                console.log(data);
            }
        });
    });

</script>


@stop