@extends('layouts.backend.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan Stok Telur
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ url('/laporan-stok-telur') }}">Laporan Stok Telur</a></li>
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
              <h3 class="box-title">Laporan Stok Telur</h3>
              <div class="pull-right download">
              <a href="{{url('/download/'.$date)}}" class="btn btn-info btn-sm">Download <span class="fa fa-download"></span></a>
              <a href="{{url('/print/data-stok-telur/'.$date)}}" target="_blank" class="btn btn-info btn-sm">Print <span class="fa fa-print"></span></a>
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

                <div id="show-data-stok-telur"></div>

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

/*$(document).on('click', '.pagination a', function(e){
  e.preventDefault();

  console.log($(this).attr('href').split('page='));

  var page = $(this).attr('href').split('page=')[1];

  var search = $('input[name=search]').val(); 
  if (search=="") {
    var date = new Date();
    var tahun = date.getFullYear();
    var bulan = date.getMonth();
    search = tahun+'-'+ ( '0' + (bulan+1)).slice(-2);
  }

  getStokTelur(page, search);

});

function getStokTelur(page, search)
{
  console.log('getting stok telur for page = '+ page);

  $.ajax({

    url : 'pagination/' + search + '/' + page + '/laporan-stok-telur?page='+ page

  }).done(function(data){
      console.log(data);
      $('#show-data-stok-telur').html(data);
      location.hash = page;
  });

}*/

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
    $('#show-data-stok-telur').load('laporan-stok-telur/'+tahun+'-'+ ( '0' + (bulan+1)).slice(-2) );
    console.log(date.getFullYear(), date.getMonth()+1);

    $('#search').datepicker().on('changeDate', function () {
        var search = $('input[name=search]').val();
          $.ajax({
             type: 'get',
              url: 'laporan-stok-telur/'+ search,
              success: function(data) {
                /*console.log(data);*/
                $('#show-data-stok-telur').load('laporan-stok-telur/'+search);
                $('.download').replaceWith(" <div class='pull-right download'><a href='download/"+ search + "' class='btn btn-info btn-sm'>Download <span class='fa fa-download'></span></a> <a href='print/data-stok-telur/"+ search +"' class='btn btn-info btn-sm' target='_blank'>Print <span class='fa fa-print'></span></a> </div>  ");
              }
          });
    });


  });

    

    /*$('#search').datepicker().on('changeDate', function () {
          $.ajax({
             type: 'post',
              url: 'laporan-stok-telur',
              data: {
                 '_token': $('input[name=_token]').val(),
                 'search' : $('input[name=search]').val()
              },
              success: function(data) {
                console.log(data);
                console.log(data.search);
                console.log(data.telur_masuk);
                console.log(data.telur_keluar);
                console.log(data.stok_telur.data);

                $('.masuk').replaceWith("<label class='label-control masuk'>"+ data.telur_masuk +"</label>");
                $('.keluar').replaceWith("<label class='label-control keluar'>"+ data.telur_keluar +"</label>");
                $('.jml').replaceWith("<label class='label-control jml'>"+ data.jml_stok +"</label> ");

                $('.print').replaceWith(" <div class='pull-right print'><a href='/laporan-data-stok-telur/"+ data.search + "' class='btn btn-info btn-sm'>Print <span class='fa fa-print'></span></a></div> ");

                $('.tgl').replaceWith(function(){

                  var waktu = data.search;
                  var BulanIndo = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

                  var tahun = waktu.substr(0, 4);
                  var bulan = waktu.substr(5, 2);
                  return "<div class='tgl'>"+" "+ BulanIndo[bulan-1]+" "+ tahun +"</div>";

                });

              }
          });
    });*/


    

    

</script>
@stop