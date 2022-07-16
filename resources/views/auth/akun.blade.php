@extends('layouts.template')

 <?php 
 $title="Akun Pengguna -";
 ?>

@section('content')
  <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">AKUN PENGGUNA</h3>

              <div class="box-tools pull-right">
               <!--  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
              </div>
            </div> 
<div class="row kotak">
<!-- Modal Tambah produk-->
<table class="table">
  <tr>
    <td width="40%">
       <label for="name" class="col-sm-2 control-label tengah2">Username</label>
       <div class="col-md-10">
       <input type="text" class="form-control" name="txtUsername" value="{{$akun->username}}" disabled="" style="background-color: #fff">
     </div>
    </td>
    <td>&nbsp</td>
  </tr>
  <tr>
    <td>
      <label for="name" class="col-sm-2 control-label tengah2">Password</label>
      <div class="col-md-10">
              <input type="password" class="form-control" name="txtPassword" value="{{$akun->password}}" disabled="" style="background-color: #fff"></td>
      </div>
     <td>&nbsp</td>
  </tr>
  <tr>
    <td> 
      <label for="name" class="col-sm-2 control-label tengah2"></label>
      <div class="col-md-10">
      <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#modalEditAkun" data-id="{{$akun->id}}"><i class="fa fa-lock" aria-hidden="true"></i> Setting Akun</button>
      </div>
    </td>
    <td>&nbsp</td>
  </tr>
</table>
     
      
    </div>


  <!-- Modal Tambah produk-->
<div class="modal fade" id="modalEditAkun" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" align="center"><strong>SETTING AKUN PENGGUNA</strong></h5>
      </div>
      <div class="modal-body">
        <form action="{{ url('edit_akun/'.$akun->id) }}" method="POST"  enctype="multipart/form-data">
      {{csrf_field()}}
      {{method_field('PUT')}}
      <div class="form-group">
            <label for="name" class="col-sm-3 control-label tengah2">Username</label>
            <input type="hidden" name="id" value="{{$akun->id}}">
            <div class="col-md-9">
                <input type="text" class="form-control" name="txtUsername" value="{{$akun->username}}" required="">
            </div>
      </div>
          <div class="form-group">
            <label for="name" class="col-sm-3 control-label tengah2">Password Lama</label>
            <div class="col-md-9">
                <input type="password" class="form-control" name="txtPasswordLama" placeholder="Password lama" required="">
            </div>
                       
          </div> 
         <div class="form-group">
            <label for="name" class="col-sm-3 control-label tengah2">Password Baru</label>
            <div class="col-md-9">
                <input type="password" class="form-control" name="txtPasswordBaru" placeholder="Password baru" required="">
            </div>
                       
          </div> 
          <div class="form-group">
            <label for="name" class="col-sm-3 control-label tengah2">Verifikasi</label>
            <div class="col-md-9">
                <input type="password" class="form-control" name="txtVerifikasi"  placeholder="Ulang password baru" required="">
            </div>
                       
          </div>    
          
        <div class="modal-footer" style="border-top: 0px;">
          <button type="submit" class="btn btn-success tombolform">Simpan</button>
          <button type="button" class="btn btn-warning tombolform" data-dismiss="modal">Tutup</button>
        </div>
      </form>
      
      </div>
       
     
    </div>
  </div>
</div>
@endsection