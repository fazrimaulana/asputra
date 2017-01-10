@extends('layouts.backend.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kelola Galery
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ url('/galery') }}">Kelola Galery</a></li>
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
          <div id="error"></div>
        </div>
      </div>

      <div class="row">        
        <div class="col-md-5">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Kelola Galery</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->            
              <div class="box-body">
                  <form method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <input type="text" style="display: none;" id="id" name="id">
                  <input type="text" style="display: none;" id="action" name="action">
                    <div class="form-group{{ $errors->has('deskripsi') ? ' has-error' : '' }}">
                      <label for="Deskripsi">Deskripsi</label>
                      <input type="text" class="form-control" id="deskripsi" placeholder="Deskripsi" name="deskripsi" value="{{ old('deskripsi') }}">
                      @if($errors->has('deskripsi'))
                        <span style="color: red;">{{ $errors->first('deskripsi') }}</span>
                      @endif
                    </div>
                      <img id="showgambar" style="max-width:80px;max-height:80px;display: none;">
                    <div class="form-group{{ $errors->has('gambar') ? ' has-error' : '' }}">
                      <label for="Gambar">Gambar</label>
                      <input type="file" class="form-control" id="gambar" name="gambar" value="{{ old('gambar') }}">
                      @if($errors->has('gambar'))
                        <span style="color: red;">{{ $errors->first('gambar') }}</span>
                      @endif
                    </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-sm btn-save" value="save" id="btn-save" name="btn">Save</button>
                <button type="reset" class="btn btn-warning btn-sm reset">Reset</button>
                </form>
              </div>

          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="col-md-7">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Galery</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->            
              <div class="box-body">
                  <table class="table table-bordered table-hover">
                    <tr>
                      <td align="center">No</td>
                      <td align="center">Deskripsi</td>
                      <td align="center">Foto</td>
                      <td align="center">Action</td>
                    </tr>
                    @foreach($dataGalery as $data)
                    <tr class="item{{ $data->id }}">
                      <td style="vertical-align: middle; text-align: center;">{{ $no++ }}.</td>
                      <td style="vertical-align: middle;">{{ $data->deskripsi }}</td>
                      <td style="vertical-align: middle; text-align: center;"><img src="{{ asset('image/'.$data->foto) }}" height="50px" width="50px"></td>
                      <td style="vertical-align: middle; text-align: center;">
                        <button class="btn btn-info edit-modal btn-xs" value="{{$data->id}}" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="glyphicon glyphicon-edit"></i></button>
                        <button class="btn btn-danger delete-modal btn-xs" data-id="{{$data->id}}" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="glyphicon glyphicon-trash"></i></button>
                      </td>
                    </tr>
                    @endforeach
                  </table>
                  {{ $dataGalery->render() }}
              </div>

              <!-- /.box-body -->
              <div class="box-footer">
                
              </div>

          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->


      </div>
      <!-- /.row -->

           
      


    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->

  <div class="modal fade bs-example-modal-sm3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Delete Data Galery</h4>
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


@endsection

@section('js')

<script type="text/javascript">
  
        $(document).on('click', '.delete-modal', function() {
            $('#id-delete').val($(this).data('id'));
            $('.bs-example-modal-sm3').modal('show');
        });

        $(document).on('click', '.reset', function() {
            $('#showgambar').hide();
        });


        $("#delete").click(function() {
            $.ajax({
                type: 'post',
                url: 'delete/galery',
                data: {
                 '_token': $('input[name=_token]').val(),
                 'id' : $('input[name=id-delete]').val()
                },
                success: function(data) {
                     $('.item' + data.id).remove();                     
                     console.log(data);
                }
            });
        });


        $(document).on('click', '.edit-modal', function() {
            $id = $(this).val();
            $.ajax({
                type: 'get',
                url: 'galery/'+$id+'/getData',
                success: function(data) {   
                    $('#id').val(data.id);   
                    $('#deskripsi').val(data.deskripsi);
                    /*$('#gambar').val(data.foto);*/    
                    $('#action').val("update");                
                    
                    $('#showgambar').replaceWith(" <img src='image/"+data.foto+"' id='showgambar' height='80px' width='80px'> ");
                    /*$('.bs-example-modal').modal('show');*/

                    console.log(data);
                },
                error: function()
                {
                     alert('gagal');   
                }
            });
        });

        function readURL(input){
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e)
            {
              $('#showgambar').attr('src', e.target.result);
              $('#showgambar').show();
            }
            reader.readAsDataURL(input.files[0]);
          }
        }
        $("#gambar").change(function (){
          readURL(this);
        });

</script>
  
@stop