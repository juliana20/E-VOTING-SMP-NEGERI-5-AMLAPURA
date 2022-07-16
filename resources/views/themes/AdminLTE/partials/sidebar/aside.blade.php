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
        <li class="header">MAIN NAVIGATION</li>
          <li class="{{ Request::is('dashboard') ? 'active':null}}"><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
          <li class="treeview {{ Request::is('user') ? 'active':null}} {{ Request::is('akun') ? 'active':null}} {{ Request::is('nasabah') ? 'active':null}}">
            <a href="#">
              <i class="fa fa-database" aria-hidden="true"></i>
              <span>Data Master</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Request::is('user') ? 'active':null}}"><a href="{{ url('user') }}"><i class="fa fa-circle-o"></i> <span> User</span></a></li>
              <li class="{{ Request::is('akun') ? 'active':null}}"><a href="{{ url('akun') }}"><i class="fa fa-circle-o"></i> <span> Akun</span></a></li>
              <li class="{{ Request::is('nasabah') ? 'active':null}}"><a href="{{ url('nasabah') }}"><i class="fa fa-circle-o"></i> <span> Nasabah</span></a></li>
            </ul>
          </li>
          <li class="{{ Request::is('simpanan-anggota') ? 'active':null}}"><a href="{{ url('simpanan-anggota') }}"><i class="fa fa-money"></i> <span>Simpanan Anggota</span></a></li>
          <li class="treeview {{ Request::is('tabungan') ? 'active':null}} {{ Request::is('tabungan/list-setoran') ? 'active':null}} {{ Request::is('tabungan/list-penarikan') ? 'active':null}}">
            <a href="#">
              <i class="fa fa-clipboard" aria-hidden="true"></i>
              <span>Tabungan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Request::is('tabungan') ? 'active':null}}"><a href="{{ url('tabungan') }}"><i class="fa fa-circle-o"></i> <span> Data Tabungan</span></a></li>
              <li class="{{ Request::is('tabungan/list-setoran') ? 'active':null}}"><a href="{{ url('tabungan/list-setoran') }}"><i class="fa fa-circle-o"></i> <span> Setoran Tabungan</span></a></li>
              <li class="{{ Request::is('tabungan/list-penarikan') ? 'active':null}}"><a href="{{ url('tabungan/list-penarikan') }}"><i class="fa fa-circle-o"></i> <span> Penarikan Tabungan</span></a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-archive" aria-hidden="true"></i>
              <span>Tabungan Berjangka</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Request::is('tabungan-berjangka') ? 'active':null}}"><a href="{{ url('tabungan-berjangka') }}"><i class="fa fa-circle-o"></i> <span> Data Tabungan Berjangka</span></a></li>
              <li class="{{ Request::is('tabungan-berjangka/list-setoran') ? 'active':null}}"><a href="{{ url('tabungan-berjangka/list-setoran') }}"><i class="fa fa-circle-o"></i> <span> Setoran Tabungan Berjangka</span></a></li>
              <li class="{{ Request::is('tabungan-berjangka/list-penarikan') ? 'active':null}}"><a href="{{ url('tabungan-berjangka/list-penarikan') }}"><i class="fa fa-circle-o"></i> <span> Tarik Tabungan Berjangka</span></a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-handshake-o" aria-hidden="true"></i>
              <span>Pinjaman</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Request::is('pinjaman') ? 'active':null}}"><a href="{{ url('pinjaman') }}"><i class="fa fa-circle-o"></i> <span> Data Pinjaman</span></a></li>
              <li class="{{ Request::is('akun') ? 'active':null}}"><a href="{{ url('akun') }}"><i class="fa fa-circle-o"></i> <span> Angsuran</span></a></li>
            </ul>
          </li>
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
       
        </ul>
    </section>
    <!-- /.sidebar -->
  </aside>