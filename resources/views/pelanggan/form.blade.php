<form  method="POST" action="{{ url($submit_url) }}" class="form-horizontal" name="form_crud">
  {{ csrf_field() }}
  <div class="form-group">
    <label class="col-lg-3 control-label">Kode Pelanggan *</label>
    <div class="col-lg-9">
      <input type="text" class="form-control" name="f[kode]" id="kode" value="{{ @$item->kode }}" placeholder="Kode Pelanggan" required="" readonly>
    </div>
  </div>
  <div class="form-group">
      <label class="col-lg-3 control-label">Nama Pelanggan *</label>
      <div class="col-lg-9">
        <input type="text" class="form-control" name="f[nama]" id="nama" value="{{ @$item->nama }}" placeholder="Nama Pelanggan" required="">
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
    <label class="col-lg-3 control-label">Alamat *</label>
    <div class="col-lg-9">
      <textarea name="f[alamat]" id="alamat" cols="30" rows="2" class="form-control" required>{{ @$item->alamat }}</textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Telepon *</label>
    <div class="col-lg-9">
      <input type="text" name="f[no_telepon]" id="no_telepon" class="form-control" placeholder="Telepon" value="{{ @$item->no_telepon }}" required="">
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