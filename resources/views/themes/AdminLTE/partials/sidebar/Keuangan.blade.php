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
          <li class="{{ Request::is('dashboard') ? 'active':null}}"><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Beranda</span></a></li>
          <li class="{{ Request::is('mutasi-kas') ? 'active':null}}"><a href="{{ url('mutasi-kas') }}"><i class="fa fa-money"></i> <span>Mutasi Kas</span></a></li>
          <li class="{{ Request::is('jurnal') ? 'active':null}}"><a href="{{ url('jurnal') }}"><i class="fa fa-money"></i> <span>Jurnal Umum</span></a></li>
          <li class="treeview {{ Request::is('laporan/tabungan-berjangka') ? 'active':null}} {{ Request::is('laporan/simpanan-anggota') ? 'active':null}} {{ Request::is('laporan/tabungan-sukarela') ? 'active':null}} {{ Request::is('laporan/pinjaman') ? 'active':null}} {{ Request::is('laporan/keuangan') ? 'active':null}}">
            <a href="#">
              <i class="fa fa-clipboard" aria-hidden="true"></i>
              <span>Laporan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Request::is('laporan/simpanan-anggota') ? 'active':null}}"><a href="{{ url('laporan/simpanan-anggota') }}"><i class="fa fa-file-text-o"></i> Simpanan Anggota</a></li>
              <li class="{{ Request::is('laporan/tabungan-sukarela') ? 'active':null}}"><a href="{{ url('laporan/tabungan-sukarela') }}"><i class="fa fa-file-text-o"></i> Tabungan Sukarela</a></li>
              <li class="{{ Request::is('laporan/tabungan-berjangka') ? 'active':null}}"><a href="{{ url('laporan/tabungan-berjangka') }}"><i class="fa fa-file-text-o"></i> Tabungan Berjangka</a></li>
              <li class="{{ Request::is('laporan/pinjaman') ? 'active':null}}"><a href="{{ url('laporan/pinjaman') }}"><i class="fa fa-file-text-o"></i> Pinjaman</a></li>
              <li class="{{ Request::is('laporan/keuangan') ? 'active':null}}"><a href="{{ url('laporan/keuangan') }}"><i class="fa fa-file-text-o"></i> Keuangan</a></li>
            </ul>
          </li>
       
        </ul>
    </section>
    <!-- /.sidebar -->
  </aside>