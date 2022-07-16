<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ @$title }} | {{config('app.app_name')}} </title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" href="{{url('themes/default/images/favicon.ico')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="{{ url('themes/AdminLTE-2.4.3/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ url('themes/AdminLTE-2.4.3/bower_components/font-awesome/css/font-awesome.min.css') }}">
	<!-- Ionicons -->
	<link rel="stylesheet" href="{{ url('themes/AdminLTE-2.4.3/bower_components/Ionicons/css/ionicons.min.css') }}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ url('themes/AdminLTE-2.4.3/dist/css/AdminLTE.min.css') }}">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
		folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="{{ url('themes/AdminLTE-2.4.3/dist/css/skins/_all-skins.min.css') }}">
	<!-- Morris chart -->
	<link rel="stylesheet" href="{{ url('themes/AdminLTE-2.4.3/bower_components/morris.js/morris.css') }}">
	<!-- jvectormap -->
	<link rel="stylesheet" href="{{ url('themes/AdminLTE-2.4.3/bower_components/jvectormap/jquery-jvectormap.css') }}">
	<!-- Date Picker -->
	<link rel="stylesheet" href="{{ url('themes/AdminLTE-2.4.3/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="{{ url('themes/AdminLTE-2.4.3/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="{{ url('themes/AdminLTE-2.4.3/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

	<!-- DataTables -->
	<link rel="stylesheet" href="{{ url('themes/AdminLTE-2.4.3/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

	<!-- jQuery 3 -->
	<script src="{{ url('themes/AdminLTE-2.4.3/bower_components/jquery/dist/jquery.min.js') }}"></script>

	<!-- Select2 -->
	<link rel="stylesheet" href="{{ url('') }}/themes/AdminLTE-2.4.3/bower_components/select2/dist/css/select2.min.css">

	<!-- SweatAlert -->
	<script src="{{url('themes/default/js/alert/sweetalert.min.js')}}"></script>

	{{-- style custome --}}
	<link rel="stylesheet" href="{{ url('themes/default/css/style.custom.css') }}">


	<script>
		// AJAX TOKEN
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
	</script>
</head>
