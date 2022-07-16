<form  method="POST" action="{{ url($submit_url) }}" class="form-horizontal" name="form_crud">
  {{ csrf_field() }}
  <div class="form-group">
    <label class="col-lg-3 control-label">No Anggota</label>
    <div class="col-lg-9">
      <input type="text" class="form-control" name="f[no_anggota]" id="no_anggota" value="{{ @$item->no_anggota }}" placeholder="" required="" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Nama Anggota</label>
    <div class="col-lg-9">
      <input type="text" class="form-control" name="f[nama_nasabah]" id="nama_nasabah" value="{{ @$item->nama_nasabah }}" placeholder="Nama Nasabah" required="" readonly>
    </div>
  </div>
  <div class="form-group">
      <label class="col-lg-3 control-label">Saldo Simpanan Pokok</label>
      <div class="col-lg-9">
        <div class="input-group">
          <div class="input-group-btn">
            <span class="btn btn-default btn-flat">Rp</span>
          </div>
          <input type="text" class="form-control mask-number" name="" id="saldo" value="{{ @$saldo_pokok }}" placeholder="Saldo" required="" readonly>
        </div>

      </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Saldo Simpanan Wajib</label>
    <div class="col-lg-9">
      <div class="input-group">
        <div class="input-group-btn">
          <span class="btn btn-default btn-flat">Rp</span>
        </div>
        <input type="text" class="form-control mask-number" name="" id="saldo" value="{{ @$saldo_wajib }}" placeholder="Saldo" required="" readonly>
      </div>

    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Total Saldo</label>
    <div class="col-lg-9">
      <div class="input-group">
        <div class="input-group-btn">
          <span class="btn btn-default btn-flat">Rp</span>
        </div>
        <input type="text" class="form-control mask-number" name="f[total_simp_wajib]" id="saldo_akhir" value="{{ (@$saldo_pokok + @$saldo_wajib) }}" placeholder="Saldo Akhir" readonly>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Biaya Admin</label>
    <div class="col-lg-9">
      <div class="input-group">
        <div class="input-group-btn">
          <span class="btn btn-default btn-flat">Rp</span>
        </div>
        <input type="text" class="form-control mask-number" name="f[biaya_admin]" id="biaya_admin" value="50000" placeholder="Biaya Admin" readonly>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Jumlah Diterima</label>
    <div class="col-lg-9">
      <div class="input-group">
        <div class="input-group-btn">
          <span class="btn btn-default btn-flat">Rp</span>
        </div>
        <input type="text" class="form-control mask-number" name="f[jumlah_diterima]" id="jumlah_diterima" value="{{ (@$saldo_pokok + @$saldo_wajib) - 50000 }}" placeholder="Jumlah Diterima" readonly>
      </div>
    </div>
  </div>
  <div class="form-group">
      <div class="col-lg-offset-3 col-lg-9">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button id="submit_form" type="submit" class="btn btn-success btn-save">Proses Penarikan <i class="fas fa-spinner fa-spin spinner" style="display: none"></i></button> 
      </div>
  </div>
</form>
      

<script type="text/javascript">
  $(document).ready(function(){
    mask_number.init()
  })
  $('form[name="form_crud"]').on('submit',function(e) {
    e.preventDefault();
    var saldo_akhir = $("#saldo_akhir").val();
    if(saldo_akhir <= 0)
    {
      alert('Anda belum memiliki saldo!');
      return false;
    }
    else{
      if(confirm('Apakah anda yakin ingin melakukan penarikan?'))
      {
          $('.btn-save').addClass('disabled', true);
          $(".spinner").css("display", "");
          var post_data = {
                'no_anggota' : $("#no_anggota").val(),
              }

          data_post = {
                "f" : post_data,
              }
          $.post($(this).attr("action"), data_post, function(response, status, xhr) {
            if( response.status == "error"){
                $.alert_warning(response.message);
                    $('.btn-save').removeClass('disabled');
                    $(".spinner").css("display", "none");
                    return false
                }
                $.alert_success(response.message);
                    $('.btn-save').removeClass('disabled');
                    $(".spinner").css("display", "none");
                    ajax_modal.hide();
                    setTimeout(function(){
                      location.reload();
                      // document.location.href = "{{ url("$nameroutes") }}";        
                    }, 500);  
            }).catch(error => {
                  $.alert_error(error);
                      $('.btn-save').removeClass('disabled');
                      $(".spinner").css("display", "none");
                      return false
            });
      }
    }
   
        

  });
</script>