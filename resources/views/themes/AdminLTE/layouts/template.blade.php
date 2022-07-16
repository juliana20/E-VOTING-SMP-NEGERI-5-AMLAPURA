<!DOCTYPE html>
<html>
@include('themes.AdminLTE.partials.head')
<body class="hold-transition sidebar-mini skin-blue-light">
  <div class="wrapper">
    <!-- HEADER -->
    @include('themes.AdminLTE.partials.header')
    <!-- Left side column. contains the logo and sidebar -->
    {{-- @include('themes.AdminLTE.partials.sidebar.'.Helpers::getJabatan()) --}}
    @include('themes.AdminLTE.partials.sidebar.Admin')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        @include('themes.AdminLTE.partials.modal_data_collect')
        @yield('breadcrumb')
      </section>
      {{-- @include('themes.AdminLTE.partials.breadcrumb') --}}
      <!-- Main content -->
      @yield('bread')
      <section class="content">
        @include('sweet::alert')
        @yield('content')
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('themes.AdminLTE.partials.footer')

    <!-- Control Sidebar -->
    @include('themes.AdminLTE.partials.control_sidebar')
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
<!-- ./wrapper -->

@include('themes.AdminLTE.partials.bottom')
@stack('scripts')
</body>
</html>
