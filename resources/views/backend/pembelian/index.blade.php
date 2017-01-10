@extends('layouts.backend.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pembelian
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
              <h3 class="box-title">Form Tambah Data Pembelian</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post">
            <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
            {{ csrf_field() }}
            <input type="text" style="display: none" name="action" id="action" class="form-control action" value="{{ old('action') }}">
            <input type="text" style="display: none" name="id" id="id" class="form-control id" value="{{ old('id') }}">
              <div class="box-body">
                <div class="form-group{{ $errors->has('tgl_pembelian') ? ' has-error' : '' }}">
                  <label for="Tanggal Pembelian">Tanggal Pembelian</label>
                  <input type="text" class="form-control tgl_pembelian" id="datepicker" placeholder="Tanggal Pembelian" name="tgl_pembelian" value="{{ old('tgl_pembelian') }}">
                  @if($errors->has('tgl_pembelian'))
                    <span style="color: red;">{{ $errors->first('tgl_pembelian') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('jml_pembelian') ? ' has-error' : '' }}">
                  <label for="Nama Barang">Nama Barang</label>
                  <input type="text" class="form-control" id="nama_barang" placeholder="Nama Barang" name="nama_barang" value="{{ old('nama_barang') }}">
                  @if($errors->has('nama_barang'))
                    <span style="color: red;">{{ $errors->first('nama_barang') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('jml_pembelian') ? ' has-error' : '' }}">
                  <label for="Jumlah Pembelian">Jumlah Pembelian</label>
                  <input type="text" class="form-control jml_pemesanan" id="jml_pembelian" placeholder="Jumlah Pembelian" name="jml_pembelian" value="{{ old('jml_pembelian') }}">
                  @if($errors->has('jml_pembelian'))
                    <span style="color: red;">{{ $errors->first('jml_pembelian') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('harga_satuan') ? ' has-error' : '' }}">
                  <label for="Harga Satuan">Harga Satuan</label>
                  <input type="text" class="form-control harga" id="harga_satuan" placeholder="Harga Satuan" name="harga_satuan" value="{{ old('harga_satuan') }}">
                  @if($errors->has('harga_satuan'))
                    <span style="color: red;">{{ $errors->first('harga_satuan') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('total') ? ' has-error' : '' }}">
                  <label for="Total">Total</label>
                  <input type="text" class="form-control total" id="total" placeholder="Total" name="total" value="{{ old('total') }}" readonly="readonly">
                  @if($errors->has('total'))
                    <span style="color: red;">{{ $errors->first('total') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('tgl_non_produktif') ? ' has-error' : '' }}" style="display: none;">
                  <label for="Tanggal Non Produktif">Tanggal Non Produktif</label>
                  <input type="text" class="form-control tgl_non_produktif" id="tgl_non_produktif" placeholder="Tanggal Non produktif" name="tgl_non_produktif" value="{{ old('tgl_non_produktif') }}" readonly="readonly">
                  @if($errors->has('tgl_non_produktif'))
                    <span style="color: red;">{{ $errors->first('tgl_non_produktif') }}</span>
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
              <h3 class="box-title">Data Pembelian</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
                <table class="table table-bordered">
                <tr>
                  <th>No</th>
                  <th>Tanggal Pembelian</th>
                  <th>Jumlah Pembelian</th>
                  <th>Action</th>
                </tr>
                @foreach($datas as $data)
                <tr class="item{{$data->id_pembelian}}">
                  <td>{{ $no++ }}</td>
                  <td>{{ $data->tgl_pembelian }}</td>
                  <td>{{ $data->jml_pembelian }}</td>
                  <td>
                    <button href="javascript:;" class="btn btn-xs btn-info edit" data-id="{{ $data->id_pembelian }}" data-tgl="{{ $data->tgl_pembelian }}" data-jml="{{ $data->jml_pembelian }}" data-nama="{{ $data->nama_barang }}" data-harga="{{ $data->harga_satuan }}" data-total="{{ $data->total }}" data-tglnonproduktif = "{{App\Helpers\Tanggal::TanggalIndo($data->tgl_non_produktif)}}">Edit</button>
                    <!-- <a href="{{ url('/data-pembelian/'.$data->id_pembelian.'/delete') }}" class="btn btn-xs btn-danger">Delete</a> -->
                    <button class="delete-modal btn btn-danger btn-xs" data-id="{{$data->id_pembelian}}">Delete</button>
                  </td>
                </tr>
                @endforeach
              </table>
              {{ $datas->render() }}
              </div>
              <!-- /.box-body -->

              <div class="box-footer">

              <?php
                /*$tgl = "01/10/2016";
                $a = substr($tgl, 0,2);
                $b = substr($tgl, 3,2);
                $c = substr($tgl, 6);
                echo "".$a."-".$b."-".$c."<br>";
                echo "".$c."/".$b."/".$a;
                $tg = $c."/".$b."/".$a;
                echo "".$tg;*/
              ?>                
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
      $('#datepicker').datepicker({
          autoclose: true,
          format: 'yyyy/mm/dd',
          todayHighlight: true
        });  

      $('#datepicker').datepicker().on('changeDate', function (ev) {
          $('#tgl_non_produktif').change();
      });
      
      $('#tgl_non_produktif').val('');
      $('#tgl_non_produktif').change(function () {
          var tglbeli = $('#datepicker').val();
            var d = new Date(tglbeli);
            d.setDate(d.getDate() + 30);
            var data = ( '0' + d.getDate(d.setDate(d.getDate() + 30)) ).slice(-2) +'/'+ ( '0' + (d.getMonth())).slice(-2)  + '/' + d.getFullYear() ;

            console.log(data);
            $('#tgl_non_produktif').val(data);
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

        $(".harga").keyup(function() {
            calc();
        });

        $(document).on('click', '.edit', function() {
          $('#id').val($(this).data('id'));
          $('#datepicker').val($(this).data('tgl'));
          $('#jml_pembelian').val($(this).data('jml'));
          $('#action').val('update');
          $('#nama_barang').val($(this).data('nama'));
          $('#harga_satuan').val($(this).data('harga'));
          $('#total').val($(this).data('total'));
          $('#tgl_non_produktif').val($(this).data('tglnonproduktif'));
        });


        $(document).on('click', '.delete-modal', function() {
        $('#id-delete').val($(this).data('id'));
        $('.bs-example-modal-sm3').modal('show');
        });


        $("#delete").click(function() {
          $.ajax({
             type: 'post',
              url: 'delete/pembelian',
              data: {
                 '_token': $('input[name=_token]').val(),
                 'id' : $('input[name=id-delete]').val()
              },
              success: function(data) {
                $('.item' + data.id_pembelian).remove();
                /*toastr.success("Data Berhasil Dihapus.");*/
                console.log(data);
              }
          });
        });

    </script>
@stop
