<head>
  <title>{{config('app.app_name')}} |     Login    </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ url('themes/AdminLTE-2.4.3/bower_components/font-awesome/css/font-awesome.min.css') }}">
     <link rel="shortcut icon" href="{{url('themes/default/images/favicon.ico')}}">
     <link rel="stylesheet" type="text/css" href="{{ url('themes/login/css/bootstrap.min.css')}}">
     <link rel="stylesheet" type="text/css" href="{{ url('themes/login/css/AdminLTE.min.css')}}">
     <link rel="stylesheet" type="text/css" href="{{ url('themes/login/css/ionicons.min.css')}}">
     <link rel="stylesheet" type="text/css" href="{{ url('themes/login/css/goggle_font.css')}}"> 
     <link rel="stylesheet" type="text/css" href="{{ url('themes/login/css/font-awesome.min.css')}}">
     <link rel="stylesheet" type="text/css" href="{{ url('themes/login/css/adds.css')}}">
     <link rel="stylesheet" type="text/css" href="{{ url('themes/login/css/jquery-ui.css')}}">
     <link rel="stylesheet" type="text/css" href="{{ url('themes/login/css/cmxform.css')}}">
     <link rel="stylesheet" type="text/css" href="{{ url('themes/login/css/pace.min.css')}}">
     <link rel="stylesheet" type="text/css" href="{{ url('themes/login/css/select2.css')}}">
  
     <script src="{{ url('themes/login/js/jquery.js')}}"></script>
     <script src="{{ url('themes/login/js/jquery.min.js')}}"></script>
     <script src="{{ url('themes/login/js/bootstrap.min.js')}}"></script>
    <script src="{{url('themes/default/js/alert/sweetalert.min.js')}}"></script>
    
    <style type="text/css">
      .clBgBody {
        background: url('themes/login/images/bg.jpg') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;overflow: hidden;"
      }
  
      .clLoginBox{
         border: 1px solid #ddd;
         padding: 3px;
         z-index:200;
         position: fixed;
         left: 50%;
         top: 40%;
         transform: translate(-50%, -50%);
      }

      input[type=password] {
        outline: none;border: none;border-bottom: 1px solid #ddd;font-size: 14px;
      }
      input[type=password]:focus {
        border-bottom: 1px solid #blue;
        color: #000;
      }
      
      input[type=text] {
        outline: none;border: none;border-bottom: 1px solid #ddd;font-size: 14px;
      }
      input[type=text]:focus {
        border-bottom: 1px solid #blue;
        color: #000;
      }

      .bg-bubbles {
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          z-index: 1;
        }
        .bg-bubbles li {
          position: absolute;
          list-style: none;
          display: block;
          width: 40px;
          height: 40px;
          background-color: rgba(255, 255, 255, 0.15);
          bottom: -160px;
          -webkit-animation: square 25s infinite;
          animation: square 25s infinite;
          -webkit-transition-timing-function: linear;
          transition-timing-function: linear;
        }
        .bg-bubbles li:nth-child(1) {
          left: 10%;
        }
        .bg-bubbles li:nth-child(2) {
          left: 20%;
          width: 80px;
          height: 80px;
          -webkit-animation-delay: 2s;
                  animation-delay: 2s;
          -webkit-animation-duration: 17s;
                  animation-duration: 17s;
        }
        .bg-bubbles li:nth-child(3) {
          left: 25%;
          -webkit-animation-delay: 4s;
                  animation-delay: 4s;
        }
        .bg-bubbles li:nth-child(4) {
          left: 40%;
          width: 60px;
          height: 60px;
          -webkit-animation-duration: 22s;
                  animation-duration: 22s;
          background-color: rgba(255, 255, 255, 0.25);
        }
        .bg-bubbles li:nth-child(5) {
          left: 70%;
        }
        .bg-bubbles li:nth-child(6) {
          left: 80%;
          width: 120px;
          height: 120px;
          -webkit-animation-delay: 3s;
                  animation-delay: 3s;
          background-color: rgba(255, 255, 255, 0.2);
        }
        .bg-bubbles li:nth-child(7) {
          left: 32%;
          width: 160px;
          height: 160px;
          -webkit-animation-delay: 7s;
                  animation-delay: 7s;
        }
        .bg-bubbles li:nth-child(8) {
          left: 55%;
          width: 20px;
          height: 20px;
          -webkit-animation-delay: 15s;
                  animation-delay: 15s;
          -webkit-animation-duration: 40s;
                  animation-duration: 40s;
        }
        .bg-bubbles li:nth-child(9) {
          left: 25%;
          width: 10px;
          height: 10px;
          -webkit-animation-delay: 2s;
                  animation-delay: 2s;
          -webkit-animation-duration: 40s;
                  animation-duration: 40s;
          background-color: rgba(255, 255, 255, 0.3);
        }
        .bg-bubbles li:nth-child(10) {
          left: 90%;
          width: 160px;
          height: 160px;
          -webkit-animation-delay: 11s;
                  animation-delay: 11s;
        }
        @-webkit-keyframes square {
          0% {
            -webkit-transform: translateY(0);
                    transform: translateY(0);
          }
          100% {
            -webkit-transform: translateY(-700px) rotate(600deg);
                    transform: translateY(-700px) rotate(600deg);
          }
        }
        @keyframes square {
          0% {
            -webkit-transform: translateY(0);
                    transform: translateY(0);
          }
          100% {
            -webkit-transform: translateY(-700px) rotate(600deg);
                    transform: translateY(-700px) rotate(600deg);
          }
        }
    </style>
  
  </head>