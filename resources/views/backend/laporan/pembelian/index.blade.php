@extends('layouts.backend.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan Pembelian
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ url('/laporan-pembelian') }}">Laporan Pembelian</a></li>
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
              <h3 class="box-title">Laporan Pembelian</h3>
              <div class="pull-right download">
              <a href="{{url('/download/data-pembelian/'.$date)}}" class="btn btn-info btn-sm">Download <span class="fa fa-download"></span></a>
              <a href="{{url('/print/data-pembelian/'.$date)}}" target="_blank" class="btn btn-info btn-sm">Print <span class="fa fa-print"></span></a>
              </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">

                <div class="input-group pull-right" style="width: 30%">
                  {{csrf_field()}}
                  <input type="text" name="search" class="form-control search" placeholder="Search..." id="search">
                  <span class="input-group-addon"><i class="fa fa-search"></i></span>
                </div>                  

                <br>

                <div id="show-data-pembelian"></div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
              </div>

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
  $(document).ready(function(){

    $('#search').datepicker({
          autoclose: true,
          format: 'yyyy-mm',
          viewMode: "months", 
          minViewMode: "months",

    });

    var date = new Date();
    var tahun = date.getFullYear();
    var bulan = date.getMonth();
    $('#show-data-pembelian').load('laporan-pembelian/'+tahun+'-'+ ( '0' + (bulan+1)).slice(-2) );
    console.log(date.getFullYear(), date.getMonth()+1);

    $('#search').datepicker().on('changeDate', function () {
        var search = $('input[name=search]').val();
          $.ajax({
             type: 'get',
              url: 'laporan-pembelian/'+ search,
              success: function(data) {
                /*console.log(data);*/
                $('#show-data-pembelian').load('laporan-pembelian/'+search);
                $('.download').replaceWith(" <div class='pull-right download'><a href='download/data-pembelian/"+ search + "' class='btn btn-info btn-sm'>Download <span class='fa fa-download'></span></a> <a href='print/data-pembelian/"+ search +"' class='btn btn-info btn-sm' target='_blank'>Print <span class='fa fa-print'></span></a> </div>  ");
              }
          });
    });

  });  

</script>
@stop