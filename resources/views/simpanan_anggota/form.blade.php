<form  method="POST" action="{{ url($submit_url) }}" class="form-horizontal" name="form_crud">
  {{ csrf_field() }}
  <div class="form-group">
    <label class="col-lg-3 control-label">No Nasabah *</label>
    <div class="col-lg-9">
      <input type="text" class="form-control" name="f[id_nasabah]" id="id_nasabah" value="{{ @$item->id_nasabah }}" placeholder="No Nasabah" required="" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">No KTP *</label>
    <div class="col-lg-9">
      <input type="text" class="form-control" name="f[no_ktp]" id="no_ktp" value="{{ @$item->no_ktp }}" placeholder="No KTP" required="">
    </div>
  </div>
  <div class="form-group">
      <label class="col-lg-3 control-label">Nama Nasabah *</label>
      <div class="col-lg-9">
        <input type="text" class="form-control" name="f[nama_nasabah]" id="nama_nasabah" value="{{ @$item->nama_nasabah }}" placeholder="Nama Nasabah" required="">
      </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Pekerjaan *</label>
    <div class="col-lg-9">
      <input type="text" name="f[pekerjaan]" id="pekerjaan" class="form-control" placeholder="Pekerjaan" value="{{ @$item->pekerjaan }}">
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Alamat *</label>
    <div class="col-lg-9">
      <textarea name="f[alamat_nasabah]" id="alamat_nasabah" cols="30" rows="2" class="form-control" required>{{ @$item->alamat_nasabah }}</textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Tanggal Lahir *</label>
    <div class="col-lg-9">
      <input type="date" name="f[tanggal_lahir]" id="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir" value="{{ @$item->tanggal_lahir }}">
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Telepon *</label>
    <div class="col-lg-9">
      <input type="text" name="f[no_telp]" id="no_telp" class="form-control" placeholder="Telepon" value="{{ @$item->no_telp }}" required="">
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Jenis Kelamin *</label>
    <div class="col-lg-9">
      <select name="f[jenis_kelamin]" class="form-control" required="" id="jenis_kelamin">
        <option value="" disabled="" selected="" hidden="">-- Pilih --</option>
        <?php foreach(@$option_jenis_kelamin as $dt): ?>
          <option value="<?php echo @$dt['id'] ?>" <?= @$dt['id'] == @$item->jenis_kelamin ? 'selected': null ?>><?php echo @$dt['desc'] ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Tanggal Daftar *</label>
    <div class="col-lg-9">
      <input type="date" name="f[tanggal_daftar]" id="tanggal_daftar" class="form-control" placeholder="Tanggal Daftar" value="{{ @$item->tanggal_daftar }}">
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Status *</label>
    <div class="col-lg-9">
      <select name="f[aktif]" class="form-control" required="" id="aktif">
        <?php foreach(@$option_status as $dt): ?>
          <option value="<?php echo @$dt['id'] ?>" <?= @$dt['id'] == @$item->aktif ? 'selected': null ?>><?php echo @$dt['desc'] ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label"></label>
    <div class="col-lg-9">
      <input id="anggota" type="checkbox" name="f[anggota]" class="js-switch" {{ ( @$item->anggota == 1 ) ? 'checked': null }} value="{{ @$item->anggota }}"/> Tambahkan Sebagai Anggota
    </div>
  </div>

  <div class="form-group">
      <div class="col-lg-offset-3 col-lg-9">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button id="submit_form" type="submit" class="btn btn-success btn-save">@if($is_edit) Perbarui @else Simpan @endif <i class="fas fa-spinner fa-spin spinner" style="display: none"></i></button> 
      </div>
  </div>
</form>
      

<script type="text/javascript">
  $(document).ready(function(){
    $('#anggota').change(function(){
        ($(this).prop('checked')) ? $(this).val(1) : $(this).val(0);
    });
  })
  $('form[name="form_crud"]').on('submit',function(e) {
    e.preventDefault();

    $('.btn-save').addClass('disabled', true);
    $(".spinner").css("display", "");

    var data_post = new FormData($(this)[0]);
    $.ajax({
        url: $(this).prop('action'),
        type: 'POST',              
        data: data_post,
        contentType : false,
        processData : false,
        success: function(response, status, xhr)
        {
          if( response.status == "error"){
              $.alert_warning(response.message);
              $('.btn-save').removeClass('disabled', true);
              $(".spinner").css("display", "none");
              return false
          }
            
          $.alert_success(response.message);
              setTimeout(function(){
                document.location.href = "{{ url("$nameroutes") }}";        
              }, 500);  
          },
        error: function(error)
        {
          $.alert_error(error);
          $('.btn-save').removeClass('disabled', true);
          $(".spinner").css("display", "none");
          return false
        }
    });
});
</script>