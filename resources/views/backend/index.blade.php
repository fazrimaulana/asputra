@extends('layouts.backend.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    @if($dataAyamNonProduktif)      
      @foreach($dataAyamNonProduktif as $a)
        <div class="alert alert-info alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          Jumlah Ayam Non produktif {{ $a->jml_pembelian }} <a href="javascript:;" class="btn btn-warning btn-xs">Lakukan Penjualan Ayam</a>
        </div>
      @endforeach
    @endif


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
        <div class="col-md-6">
          
          <div class="box box-info">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart"></i> <h3 class="box-title">Data Produksi Telur Tahun {{ $date }}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="canvas1" style="margin: 15px 10px 10px 0"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>

        <div class="col-md-6">

          <div class="box box-info" style="background-color: #33BEFF;">
            <div class="box-header with-border">
              <i class="fa fa-calendar"></i>
              <h3 class="box-title">Calendar</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body no-padding">
              <div id="calendar" style="width: 100%;"></div>
            </div>
            <!-- /.box-body -->
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


<script type="text/javascript" src="{{ url('/backend/plugins/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- Doughnut Chart -->
    <script>
      $(document).ready(function(){        
        var ctx = document.getElementById("canvas1"); 
        var data = {
            labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
            datasets: [
              {
                  label: "My First dataset",
                  backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)',
                      'rgba(75, 192, 192, 0.2)',
                      'rgba(153, 102, 255, 0.2)',
                      'rgba(255, 159, 64, 0.2)',
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)',
                      'rgba(75, 192, 192, 0.2)'
                  ],
                  borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                  ],
                borderWidth: 1,
                data: [{{ $dataJanuari }}, {{ $dataFebruari }}, {{ $dataMaret }}, {{ $dataApril }}, {{ $dataMei }}, {{ $dataJuni }}, {{ $dataJuli }}, {{ $dataAgustus }}, {{ $dataSeptember }}, {{ $dataOktober }}, {{ $dataNovember }}, {{ $dataDesember }}],
              }
            ]
      };         
        var myBarChart = new Chart(ctx, {
          type: 'bar',
          data: data,
          options: {
            scales: {
            xAxes: [{
                stacked: true
            }],
            yAxes: [{
                stacked: true
            }]
          }
          }
        });

    });
    </script>    
@stop
