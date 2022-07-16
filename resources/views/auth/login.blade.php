<html>
@include('themes.login.head_login')
<body class="hold-transition clBgBody">
@include('sweet::alert')
<div class="login-box clLoginBox">
    <p><h3 align="center">{{ config('app.app_alias') }}</h3></p>
    <h4 align="center" style="padding: 0px 10px 0px 10px"><small>{{ config('app.app_name') }}</small></h4>
      {{-- <div class="login-logo">
        <img src="{{url('themes/login/images/logo_koperasi.png')}}" width="140" style="margin-top: 10px">
      </div> --}}
        <div class="login-box-body">  
            <form action="{{url('/auth')}}" method="post">
                 {{ csrf_field() }}
                <div class="form-group has-feedback ">
                    <input type="text" name="username" class="form-control" placeholder="Username" required="" autofocus autocomplete="off">
                    <span class="glyphicon glyphicon-user form-control-feedback" style="color: #000"></span>
                </div>
                <div class="form-group has-feedback ">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="">
                    <span class="glyphicon glyphicon-lock form-control-feedback" style="color: #000"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                               <input type="checkbox" onclick="myFunction()"> <span style="font-size: 12.5px;vertical-align: 2.5;color:#585858">Show Password</span>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat" style="background-color: #277242!important;border-color: #277242!important;"> Login <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
    </div>
    <ul class="bg-bubbles">
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
    </ul>
</body>
</html>

<script>
function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>