	<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>AS</b>&nbspPUTRA</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-success notif_produksi">{{ $notif_produksi }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Anda Memiliki <span class="label label-success notif_produksi">{{ $notif_produksi }}</span> Notifikasi Produksi Telur</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                @foreach($dataKonfirmasiProduksi as $datakonfir)
                  <li><!-- start message -->
                    <a href="{{ url('/data-produksi/'.$datakonfir->id_produksi.'/konfirmasi') }}" >
                      <div class="pull-left">
                        <!-- <img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image"> -->
                      </div>
                      <h4>
                        Produksi {{ $datakonfir->tgl_produksi }}
                      </h4>
                      <p>Jumlah Produksi {{ $datakonfir->jml_produksi }}</p>
                    </a>
                  </li>
                  <!-- end message -->
                @endforeach
                </ul>
              </li>
              <li class="footer"><a href="#">View All</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-cart-plus"></i>
              <span class="label label-warning notif_pemesanan">{{ $notif_pemesanan }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Anda Memiliki <span class="label label-warning notif_pemesanan">{{ $notif_pemesanan }}</span> Notifikasi Pemesanan Telur</li>
              <li>
                <!-- inner menu: contains the actual data -->                
                    <span id="show2">
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-database"></i>
              <span class="label label-danger">{{ $notif_pembelian }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Anda Memiliki <span class="label label-danger">{{ $notif_pembelian }}</span> Konfirmasi Pembelian</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                @foreach($dataKonfirmasiPembelian as $dataKonfirmasiPembelian)
                  <li><!-- Task item -->
                    <a href="{{ url('/data-pembelian/'.$dataKonfirmasiPembelian->id_pembelian.'/konfirmasi') }}">
                        Tanggal {{ $dataKonfirmasiPembelian->tgl_pembelian }}
                        <small class="pull-right"></small>
                      <br>
                      Jumlah Pembelian {{ $dataKonfirmasiPembelian->jml_pembelian }}
                    </a>
                  </li>
                  <!-- end task item -->
                @endforeach
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
              <span class="hidden-xs">Alexander Pierce</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">

                <p>
                  Alexander Pierce - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ url('/logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign out</a>
                  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->


<script src="https://js.pusher.com/3.2/pusher.js"></script>
<script>
/*Pusher.logToConsole = true;*/

var pusher = new Pusher('{{env("PUSHER_KEY")}}');
var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function(data){
    console.log(data.message);
    $(".notif_produksi").replaceWith("<span class='label label-success notif_produksi'>"+ data.message +"</span>");

});
var channel_pemesanan = pusher.subscribe('my-pemesanan');
channel_pemesanan.bind('my-pemesanan', function(data){
    console.log(data.pemesanan);
    $(".notif_pemesanan").replaceWith(" <span class='label label-warning notif_pemesanan'>"+ data.pemesanan +"</span> ");
    $('#show2').load("{{ url('pemesanan/dataPemesanan') }}");
});

</script>
