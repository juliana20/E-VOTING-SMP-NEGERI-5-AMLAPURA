<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ url('themes/AdminLTE-2.4.3/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Helpers::getNama() }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN MENU</li>
          <li class="{{ Request::is('dashboard') ? 'active':null}}"><a href="{{ url('dashboard') }}"><i class="glyphicon glyphicon-home"></i> <span>Dashboard</span></a></li>
          <li class="{{ Request::is('admin') ? 'active':null}}"><a href="{{ url('admin') }}"><i class="fa fa-users"></i> <span>Admin</span></a></li>
          <li class="{{ Request::is('kelas') ? 'active':null}}"><a href="{{ url('kelas') }}"><i class="fa fa-institution"></i> <span>Kelas</span></a></li>
          <li class="{{ Request::is('pemilih') ? 'active':null}}"><a href="{{ url('pemilih') }}"><i class="fa fa-odnoklassniki"></i> <span>Pemilih</span></a></li>
          <li class="{{ Request::is('transaksi-retribusi-sampah') ? 'active':null}}"><a href="{{ url('transaksi-retribusi-sampah') }}"><i class="fa fa-money"></i> <span>Transaksi Retribusi Sampah</span></a></li>
          <li class="{{ Request::is('transaksi-pembayaran-online') ? 'active':null}}"><a href="{{ url('transaksi-pembayaran-online') }}"><i class="fa fa-book"></i> <span>Transaksi Pembayaran Online</span></a></li>
          <li class="{{ Request::is('tabungan-berjangka') ? 'active':null}}"><a href="{{ url('tabungan-berjangka') }}"><i class="fa fa-archive"></i> <span>Tabungan Berjangka</span></a></li>
          <li class="{{ Request::is('pinjaman') ? 'active':null}}"><a href="{{ url('pinjaman') }}"><i class="fa fa-handshake-o"></i> <span> Data Pinjaman</span></a></li>
          <?php /* <li class="treeview {{ Request::is('tabungan') ? 'active':null}} {{ Request::is('tabungan/list-setoran') ? 'active':null}} {{ Request::is('tabungan/list-penarikan') ? 'active':null}}">
            <a href="#">
              <i class="fa fa-clipboard" aria-hidden="true"></i>
              <span>Tabungan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Request::is('tabungan') ? 'active':null}}"><a href="{{ url('tabungan') }}"><i class="fa fa-circle-o"></i> <span> Data Tabungan</span></a></li>
              <li class="{{ Request::is('tabungan/list-setoran') ? 'active':null}}"><a href="{{ url('tabungan/list-setoran') }}"><i class="fa fa-circle-o"></i> <span> Proses Tabungan</span></a></li>
              {{-- <li class="{{ Request::is('tabungan/list-penarikan') ? 'active':null}}"><a href="{{ url('tabungan/list-penarikan') }}"><i class="fa fa-circle-o"></i> <span> Penarikan Tabungan</span></a></li> --}}
            </ul>
          </li> */ ?>
          <?php /*<li class="treeview">
            <a href="#">
              <i class="fa fa-archive" aria-hidden="true"></i>
              <span>Tabungan Berjangka</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Request::is('tabungan-berjangka') ? 'active':null}}"><a href="{{ url('tabungan-berjangka') }}"><i class="fa fa-circle-o"></i> <span> Data Tabungan Berjangka</span></a></li>
              <li class="{{ Request::is('tabungan-berjangka/list-setoran') ? 'active':null}}"><a href="{{ url('tabungan-berjangka/list-setoran') }}"><i class="fa fa-circle-o"></i> <span> Proses Tabungan Berjangka</span></a></li>
              {{-- <li class="{{ Request::is('tabungan-berjangka/list-penarikan') ? 'active':null}}"><a href="{{ url('tabungan-berjangka/list-penarikan') }}"><i class="fa fa-circle-o"></i> <span> Tarik Tabungan Berjangka</span></a></li> --}}
            </ul>
          </li> */ ?>
          <?php /* <li class="treeview">
            <a href="#">
              <i class="fa fa-handshake-o" aria-hidden="true"></i>
              <span>Pinjaman</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Request::is('pinjaman') ? 'active':null}}"><a href="{{ url('pinjaman') }}"><i class="fa fa-circle-o"></i> <span> Data Pinjaman</span></a></li>
              <li class="{{ Request::is('pinjaman/angsuran') ? 'active':null}}"><a href="{{ url('pinjaman/angsuran') }}"><i class="fa fa-circle-o"></i> <span> Angsuran</span></a></li>
            </ul>
          </li> 
          */ ?>
          {{-- <li class="treeview {{ Request::is('laporan/pemasukan') ? 'active':null}} {{ Request::is('laporan/pengeluaran') ? 'active':null}} 
            {{ Request::is('laporan/pembayaran-spp') ? 'active':null}} {{ Request::is('laporan/tunggakan-spp') ? 'active':null}} 
            {{ Request::is('laporan/pembayaran-gedung') ? 'active':null}} {{ Request::is('laporan/tunggakan-gedung') ? 'active':null}}">
            <a href="#">
              <i class="fa fa-clipboard" aria-hidden="true"></i>
              <span>Laporan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Request::is('laporan/pemasukan') ? 'active':null}}"><a href="{{ url('laporan/pemasukan') }}"><i class="fa fa-file-text-o"></i> Pamasukan</a></li>
              <li class="{{ Request::is('laporan/pengeluaran') ? 'active':null}}"><a href="{{ url('laporan/pengeluaran') }}"><i class="fa fa-file-text-o"></i> Pengeluaran</a></li>
              <li class="{{ Request::is('laporan/pembayaran-siswa') ? 'active':null}}"><a href="{{ url('laporan/pembayaran-siswa') }}"><i class="fa fa-file-text-o"></i> Pembayaran Siswa</a></li>
              <li class="{{ Request::is('laporan/pembayaran-spp') ? 'active':null}}"><a href="{{ url('laporan/pembayaran-spp') }}"><i class="fa fa-file-text-o"></i> Pembayaran SPP</a></li>
              <li class="{{ Request::is('laporan/tunggakan-spp') ? 'active':null}}"><a href="{{ url('laporan/tunggakan-spp') }}"><i class="fa fa-file-text-o"></i> Tunggakan SPP</a></li>
              <li class="{{ Request::is('laporan/pembayaran-gedung') ? 'active':null}}"><a href="{{ url('laporan/pembayaran-gedung') }}"><i class="fa fa-file-text-o"></i> Pembayaran Uang Gedung</a></li>
              <li class="{{ Request::is('laporan/tunggakan-gedung') ? 'active':null}}"><a href="{{ url('laporan/tunggakan-gedung') }}"><i class="fa fa-file-text-o"></i> Tunggakan Uang Gedung</a></li>
            </ul>
          </li> --}}
          <li class="header">SETTING</li>
          <li class="{{ Request::is('setting-parameter') ? 'active':null}}"><a href="{{ url('setting-parameter') }}"><i class="glyphicon glyphicon-cog"></i> <span>Biaya Sampah</span></a></li>
        </ul>

    </section>
    <!-- /.sidebar -->
  </aside>