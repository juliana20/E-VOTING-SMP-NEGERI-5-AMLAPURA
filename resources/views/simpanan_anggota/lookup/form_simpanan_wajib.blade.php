<form  method="POST" action="{{ url($submit_url) }}" class="form-horizontal" name="form_crud">
  {{ csrf_field() }}
  <div class="form-group">
    <label class="col-lg-3 control-label">No Bukti</label>
    <div class="col-lg-9">
      <input type="text" class="form-control" name="f[id_simpanan_wajib]" id="id_simpanan_wajib" value="{{ (!empty(@$item->id_simpanan_wajib)) ? @$item->id_simpanan_wajib : @$no_bukti }}" placeholder="No Bukti" required="" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Tanggal</label>
    <div class="col-lg-9">
      <input type="date" class="form-control" name="f[tanggal]" id="tanggal" value="{{ (!empty(@$item->tanggal)) ? @$item->tanggal : date('Y-m-d') }}" placeholder="Tanggal" required="">
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">No Rekening</label>
    <div class="col-lg-9">
      <input type="hidden" name="f[id_nasabah]" id="id_nasabah" value="{{ @$item->id_nasabah }}">
      <input type="text" class="form-control" name="f[no_rek_sim_wajib]" id="no_rek_sim_wajib" value="{{ @$item->no_rek_sim_wajib }}" placeholder="No Rekening" required="" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Nama Anggota</label>
    <div class="col-lg-9">
      <input type="text" class="form-control" name="f[nama_nasabah]" id="nama_nasabah" value="{{ @$item->nama_nasabah }}" placeholder="Nama Nasabah" required="" readonly>
    </div>
  </div>
  <div class="form-group">
      <label class="col-lg-3 control-label">Saldo</label>
      <div class="col-lg-9">
        <div class="input-group">
          <div class="input-group-btn">
            <span class="btn btn-default btn-flat">Rp</span>
          </div>
          <input type="text" class="form-control mask-number" name="" id="saldo" value="{{ @$saldo }}" placeholder="Saldo" required="" readonly>
        </div>

      </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Setoran</label>
    <div class="col-lg-9">
      <div class="input-group">
        <div class="input-group-btn">
          <span class="btn btn-default btn-flat">Rp</span>
        </div>
        <input type="text" class="form-control mask-number" name="f[kredit]" id="setoran" value="{{ @$item->kredit }}" placeholder="Setoran" autocomplete="off"  min="1">
      </div>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Akun Kas</label>
    <div class="col-lg-9">
          <select name="f[id_akun]" class="form-control" required="" id="id_akun">
            <option value="" disabled="" selected="" hidden="">-- Pilih --</option>
            <?php foreach(@$option_akun as $dt): ?>
              <option value="<?php echo @$dt->id_akun ?>" <?= @$dt->id_akun == @$item->id_akun ? 'selected': null ?>><?php echo @$dt->nama_akun ?></option>
            <?php endforeach; ?>
          </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Saldo Akhir</label>
    <div class="col-lg-9">
      <div class="input-group">
        <div class="input-group-btn">
          <span class="btn btn-default btn-flat">Rp</span>
        </div>
        <input type="text" class="form-control mask-number" name="f[total_simp_wajib]" id="saldo_akhir" value="{{ @$saldo }}" placeholder="Saldo Akhir" readonly>
      </div>
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
$(document).ready(calculate);   
$(document).on("keyup",'#setoran', calculate);

  function calculate() {
      var saldo = mask_number.currency_remove($('#saldo').val());
          setoran = mask_number.currency_remove($('#setoran').val());
          saldo_akhir = parseFloat(saldo) + parseFloat(setoran);

          $("#saldo_akhir").val(mask_number.currency_add(saldo_akhir));
  }

  $(document).ready(function(){
    mask_number.init()
  })
  $('form[name="form_crud"]').on('submit',function(e) {
    e.preventDefault();
    setoran = mask_number.currency_remove($('#setoran').val());
    if(setoran == '' || setoran == 0)
    {
      $.alert_warning('Nominal setoran belum di masukkan!');
      return false
    }
    $('.btn-save').addClass('disabled', true);
    $(".spinner").css("display", "");
    var post_data = {
          'tanggal' : $("#tanggal").val(),
          'no_rek_sim_wajib' : $("#no_rek_sim_wajib").val(),
          'id_nasabah' : $("#id_nasabah").val(),
          'kredit' : mask_number.currency_remove($("#setoran").val()),
          'id_akun' : $("#id_akun").val(),
          'total_simp_wajib' : mask_number.currency_remove($("#saldo_akhir").val())
        }

     data_post = {
          "f" : post_data,
        }

        console.log(data_post)
        
    // var data_post = new FormData($(this)[0]);
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
  });
</script>