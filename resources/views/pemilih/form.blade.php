<form  method="POST" action="{{ url($submit_url) }}" class="form-horizontal" name="form_crud">
  {{ csrf_field() }}
  <div class="form-group">
    <label class="col-lg-3 control-label">NIS *</label>
    <div class="col-lg-9">
      <input type="text" class="form-control" name="f[nis]" id="nis" value="{{ @$item->nis }}" placeholder="NIS" required="">
    </div>
  </div>
  <div class="form-group">
      <label class="col-lg-3 control-label">Nama Pemilih *</label>
      <div class="col-lg-9">
        <input type="text" class="form-control" name="f[nama_pemilih]" id="nama_pemilih" value="{{ @$item->nama_pemilih }}" placeholder="Nama Pemilih" required="">
      </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Alamat *</label>
    <div class="col-lg-9">
      <textarea name="f[alamat]" id="alamat" id="" cols="10" rows="4" class="form-control" required>{{ @$item->alamat }}</textarea>
    </div>
</div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Tanggal Lahir *</label>
    <div class="col-lg-9">
      <input type="date" class="form-control" name="f[tanggal_lahir]" id="tanggal_lahir" value="{{ @$item->tanggal_lahir }}" placeholder="Tanggal Lahir" required="">
    </div>
</div>
<div class="form-group">
  <label class="col-lg-3 control-label">Kelas *</label>
  <div class="col-lg-9">
    <select name="f[kelas_id]" class="form-control" required="" id="kelas_id">
      <option value="" disabled="" selected="" hidden="">-- Pilih --</option>
      <?php foreach(@$kelas as $dt): ?>
        <option value="<?php echo @$dt->id ?>" <?= @$dt->id == @$item->kelas_id ? 'selected': null ?>><?php echo @$dt->nama_kelas ?></option>
      <?php endforeach; ?>
    </select>
  </div>
</div>
<div class="form-group">
  <label class="col-lg-3 control-label">Agama *</label>
  <div class="col-lg-9">
    <select name="f[agama]" class="form-control" required="" id="agama">
      <option value="" disabled="" selected="" hidden="">-- Pilih --</option>
      <?php foreach(@$agama as $dt): ?>
        <option value="<?php echo @$dt['id'] ?>" <?= @$dt['id'] == @$item->agama ? 'selected': null ?>><?php echo @$dt['desc'] ?></option>
      <?php endforeach; ?>
    </select>
  </div>
</div>
<div class="form-group">
  <label class="col-lg-3 control-label">Jenis Kelamin *</label>
  <div class="col-lg-9">
    <select name="f[jenis_kelamin]" class="form-control" required="" id="jenis_kelamin">
      <option value="" disabled="" selected="" hidden="">-- Pilih --</option>
      <?php foreach(@$jenis_kelamin as $dt): ?>
        <option value="<?php echo @$dt['id'] ?>" <?= @$dt['id'] == @$item->jenis_kelamin ? 'selected': null ?>><?php echo @$dt['desc'] ?></option>
      <?php endforeach; ?>
    </select>
  </div>
</div>
<div class="form-group">
  <label class="col-lg-3 control-label">Username *</label>
  <div class="col-lg-9">
    <input type="text" name="u[username]" id="username" class="form-control" placeholder="Username" value="{{ @$item->username }}">
  </div>
</div>
<div class="form-group">
  <label class="col-lg-3 control-label">Password *</label>
  <div class="col-lg-9">
    <input type="password" name="u[password]" id="password" class="form-control" placeholder="Password" value="{{ @$item->password }}">
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