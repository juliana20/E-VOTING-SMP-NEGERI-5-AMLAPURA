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
          <li class="{{ Request::is('nasabah/tabungan') ? 'active':null}}"><a href="{{ url('nasabah/tabungan') }}"><i class="fa fa-money"></i> <span>Tabungan Sukarela</span></a></li>
          <li class="{{ Request::is('nasabah/tabungan-berjangka') ? 'active':null}}"><a href="{{ url('nasabah/tabungan-berjangka') }}"><i class="fa fa-credit-card-alt"></i> <span>Tabungan Berjangka</span></a></li>
          <li class="{{ Request::is('nasabah/simpanan-anggota') ? 'active':null}}"><a href="{{ url('nasabah/simpanan-anggota') }}"><i class="fa fa-cc"></i> <span>Simpanan Anggota</span></a></li>
          <li class="{{ Request::is('nasabah/pinjaman') ? 'active':null}}"><a href="{{ url('nasabah/pinjaman') }}"><i class="fa fa-american-sign-language-interpreting"></i> <span>Pinjaman</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
  </aside>