<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview"><a href="{{ url('/home') }}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i>
            <span>Data Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/data-stok-telur') }}"><i class="fa fa-map"></i> Data Stok Telur</a></li>
            <li><a href="{{ url('/data-stok-ayam') }}"><i class="fa fa-map"></i> Data Stok Ayam</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i>
            <span>Data Master Produksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/data-produksi') }}"><i class="fa fa-cart-plus"></i> Data Produksi Telur</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i>
            <span>Data Master Pembelian</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/data-pembelian') }}"><i class="fa fa-cart-plus"></i> Data Pembelian</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i>
            <span>Data Master Penjualan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/data-penjualan-telur') }}"><i class="fa fa-shopping-cart"></i> Data Penjualan Telur</a></li>
            <li><a href="{{ url('/data-penjualan-ayam') }}"><i class="fa fa-shopping-cart"></i> Data Penjualan Ayam</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i>
            <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/laporan-stok-telur') }}"><i class="fa fa-file"></i> Laporan Data Stok telur</a></li>
            <li><a href="{{ url('/laporan-stok-ayam') }}"><i class="fa fa-file"></i> Laporan Data Stok Ayam</a></li>
            <li><a href="{{ url('/laporan-produksi-telur') }}"><i class="fa fa-file"></i> Laporan Data Produksi Telur</a></li>
            <li><a href="{{ url('/laporan-pembelian') }}"><i class="fa fa-file"></i> Laporan Data Pembelian</a></li>
            <li><a href="{{ url('/laporan-penjualan-telur') }}"><i class="fa fa-file"></i> Laporan Data Penjualan Telur</a></li>
            <li><a href="{{ url('/laporan-penjualan-ayam') }}"><i class="fa fa-file"></i> Laporan Data Penjualan Ayam</a></li>
            <li><a href="{{ url('/laporan-keuangan') }}"><i class="fa fa-file"></i> Laporan Data Keuangan</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-globe"></i>
            <span>Kelola Site</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/galery') }}"><i class="fa fa-picture-o"></i> Galery</a></li>
          </ul>
        </li>
        <li class="treeview"><a href="{{ url('/') }}" target="_blank"><i class="fa fa-globe"></i> <span>Visit Site</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>