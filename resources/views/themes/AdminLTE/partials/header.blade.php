<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>{{ config('app.app_abbreviation') }}</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>{{ config('app.app_alias') }}</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ url('themes/AdminLTE-2.4.3/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Helpers::getNama() }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ url('themes/AdminLTE-2.4.3/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">

                <p>
                  {{ Helpers::getNama() }}
                  <small> {{ Helpers::getJabatan() }}</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="" class="btn btn-default btn-flat" title="Keluar" data-toggle="modal" data-target="#modalLogout" data-id="{{ Helpers::getId() }}" ><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" title="Keluar" data-toggle="modal" data-target="#modalLogout" data-id="{{ Helpers::getId() }}"  data-toggle="control-sidebar"><i class="fa fa-power-off" aria-hidden="true"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  
  <!-- MODAL LOGOUT -->
  @include('modal.header.modal_logout')