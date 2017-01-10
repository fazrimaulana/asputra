@extends('layouts.backend.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Penjualan Telur
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ url('/data-penjualan-telur') }}">Penjualan Telur</a></li>
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
              <h3 class="box-title">Form Data Penjualan Telur</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post">
            <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
            {{ csrf_field() }}
            <input type="text" style="display: none" name="action" id="action" class="form-control action" value="{{ old('action') }}">
            <input type="text" style="display: none" name="id" id="id" class="form-control id" value="{{ old('id') }}">
              <div class="box-body">
                <div class="form-group{{ $errors->has('stok') ? ' has-error' : '' }}">
                  <label for="Stok">Stok</label>
                  <input type="text" class="form-control" id="stok" placeholder="Stok" name="stok" value="{{ $stok }}" readonly="readonly">
                  @if($errors->has('stok'))
                    <span style="color: red;">{{ $errors->first('stok') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('tgl_penjualan_telur') ? ' has-error' : '' }}">
                  <label for="Tanggal Penjualan">Tanggal Penjualan</label>
                  <input type="text" class="form-control" id="datepicker" placeholder="Tanggal Penjualan" name="tgl_penjualan_telur" value="{{ old('tgl_penjualan_telur') }}">
                  @if($errors->has('tgl_penjualan_telur'))
                    <span style="color: red;">{{ $errors->first('tgl_penjualan_telur') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('jml_penjualan_telur') ? ' has-error' : '' }}">
                  <label for="Jumlah Penjualan">Jumlah Penjualan</label>
                  <input type="text" class="form-control jml_pemesanan" id="jml_penjualan_telur" placeholder="Jumlah Penjualan" name="jml_penjualan_telur" value="{{ old('jml_penjualan_telur') }}">
                  @if($errors->has('jml_penjualan_telur'))
                    <span style="color: red;">{{ $errors->first('jml_penjualan_telur') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('harga_per_peti') ? ' has-error' : '' }}">
                  <label for="Harga Per Peti">Harga Per Peti</label>
                  <input type="text" class="form-control harga" id="harga_per_peti" placeholder="Harga Per Peti" name="harga_per_peti" value="200000" readonly="readonly">
                  @if($errors->has('harga_per_peti'))
                    <span style="color: red;">{{ $errors->first('harga_per_peti') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('total') ? ' has-error' : '' }}">
                  <label for="Total">Total</label>
                  <input type="text" class="form-control total" id="total" placeholder="Total" name="total" readonly="readonly" value="{{ old('total') }}">
                  @if($errors->has('total'))
                    <span style="color: red;">{{ $errors->first('total') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                  <label for="Alamat">Alamat</label>
                  <input type="text" class="form-control" id="alamat" placeholder="Alamat" name="alamat" value="{{ old('alamat') }}">
                  @if($errors->has('alamat'))
                    <span style="color: red;">{{ $errors->first('alamat') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('no_hp') ? ' has-error' : '' }}">
                  <label for="No HP">No Handphone</label>
                  <input type="number" class="form-control" id="no_hp" placeholder="No Handphone" name="no_hp" value="{{ old('no_hp') }}">
                  @if($errors->has('no_hp'))
                    <span style="color: red;">{{ $errors->first('no_hp') }}</span>
                  @endif
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-sm btn-save" value="save" id="btn-save" name="btn">Save</button>
                <button type="reset" class="btn btn-warning btn-sm">Cancel</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>

        <div class="col-md-8">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Penjualan Telur</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
                <table class="table table-bordered">
                <tr>
                  <th>No</th>
                  <th>Tanggal Penjualan</th>
                  <th>Jumlah Penjualan</th>
                  <th>Action</th>
                </tr>
                @foreach($datas as $data)
                <tr class="item{{$data->id_penjualan_telur}}">
                  <td>{{ $no++ }}</td>
                  <td>{{ $data->tgl_penjualan_telur }}</td>
                  <td>{{ $data->jml_penjualan_telur }}</td>
                  <td>
                    <button href="javascript:;" class="btn btn-xs btn-info edit" data-id="{{ $data->id_penjualan_telur }}" data-tgl="{{ $data->tgl_penjualan_telur }}" data-jml="{{ $data->jml_penjualan_telur }}" data-total="{{ $data->total }}" data-alamat="{{ $data->alamat }}" data-no="{{ $data->no_hp }}">Edit</button>
                    <!-- <a href="{{ url('/data-penjualan-telur/'.$data->id_penjualan_telur.'/delete') }}" class="btn btn-xs btn-danger">Delete</a> -->
                    <button class="delete-modal btn btn-danger btn-xs" data-id="{{$data->id_penjualan_telur}}">Delete</button>
                  </td>
                </tr>
                @endforeach
                <tr>
                  <td colspan="2" align="center"><label class="control-label">Total Penjualan Telur</label></td>
                  <td colspan="2" align="center"><label class="control-label">{{ $total_penjualan }}</label></td>
                </tr>
              </table>
              {{ $datas->render() }}
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
    $(function () {
        $('#datepicker').datepicker({
          autoclose: true,
          format: 'yyyy/mm/dd'
        });
    });

    $(document).on('click', '.edit', function() {
      $('#id').val($(this).data('id'));
      $('#datepicker').val($(this).data('tgl'));
      $('#jml_penjualan_telur').val($(this).data('jml'));
      $('#total').val($(this).data('total'));
      $('#alamat').val($(this).data('alamat'));
      $('#no_hp').val($(this).data('no'));
      $('#action').val('update');
    });

    function calc() {
      var $num1 = ($.trim($(".jml_pemesanan").val()) != "" && !isNaN($(".jml_pemesanan").val())) ? parseInt($(".jml_pemesanan").val()) : 0;
      console.log($num1);
      var $num2 = ($.trim($(".harga").val()) != "" && !isNaN($(".harga").val())) ? parseInt($(".harga").val()) : 0;
      console.log($num2);
      $(".total").val($num1 * $num2);
    }
    $(".jml_pemesanan").keyup(function() {
       calc();
    });


    $(document).on('click', '.delete-modal', function() {
    $('#id-delete').val($(this).data('id'));
    $('.bs-example-modal-sm3').modal('show');
    });


    $("#delete").click(function() {
        $.ajax({
            type: 'post',
            url: 'delete/penjualan-telur',
            data: {
                '_token': $('input[name=_token]').val(),
                'id' : $('input[name=id-delete]').val()
            },
            success: function(data) {
                $('.item' + data.id_penjualan_telur).remove();
                /*toastr.success("Data Berhasil Dihapus.");*/
                console.log(data);
            }
        });
    });


   </script>
@stop