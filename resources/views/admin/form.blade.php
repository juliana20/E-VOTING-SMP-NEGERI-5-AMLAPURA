<form  method="POST" action="{{ url($submit_url) }}" class="form-horizontal" name="form_crud">
  {{ csrf_field() }}
  <div class="form-group">
    <label class="col-lg-3 control-label">ID Admin *</label>
    <div class="col-lg-9">
      <input type="text" class="form-control" name="f[kode_admin]" id="kode_admin" value="{{ @$item->kode_admin }}" placeholder="ID Admin" required="" readonly>
    </div>
  </div>
  <div class="form-group">
      <label class="col-lg-3 control-label">Nama Admin *</label>
      <div class="col-lg-9">
        <input type="text" class="form-control" name="f[nama_admin]" id="nama_admin" value="{{ @$item->nama_admin }}" placeholder="Nama Admin" required="">
      </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Username *</label>
    <div class="col-lg-9">
      <input type="text" name="f[username]" id="username" class="form-control" placeholder="Username" value="{{ @$item->username }}">
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Password *</label>
    <div class="col-lg-9">
      <input type="password" name="f[password]" id="password" class="form-control" placeholder="Password" value="{{ @$item->password }}">
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Jabatan *</label>
    <div class="col-lg-9">
      <select name="f[jabatan]" class="form-control" required="" id="jabatan">
        <option value="" disabled="" selected="" hidden="">-- Pilih --</option>
        <?php foreach(@$option_jabatan as $dt): ?>
          <option value="<?php echo @$dt['id'] ?>" <?= @$dt['id'] == @$item->jabatan ? 'selected': null ?>><?php echo @$dt['desc'] ?></option>
        <?php endforeach; ?>
      </select>
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
    var formData = new FormData($(this)[0]);
    $.ajax({
            url: $(this).prop('action'),
            type: 'POST',              
            data: formData,
            contentType : false,
            processData : false,
            success: function(response, status, xhr)
            {
                if( response.success == false){
                    $.alert_error(response.message);
                    return false
                }
                $.alert_success(response.message);
                setTimeout(function(){
                  document.location.href = "{{ url("$nameroutes") }}";
                }, 500);  
            }
    });
  });
</script>