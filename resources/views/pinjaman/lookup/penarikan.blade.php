<form  method="POST" action="{{ url($submit_url) }}" id="form_crud" class="form-horizontal" name="form_crud">
  {{ csrf_field() }}
  <div class="form-group">
    <label class="col-lg-3 control-label">No Rekening</label>
    <div class="col-lg-9">
      <input type="text" class="form-control" name="f[id_tabungan_berjangka]" id="id_tabungan_berjangka" value="{{  @$item->id_tabungan_berjangka}}" placeholder="No Rekening" required="" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Nama Nasabah</label>
    <div class="col-lg-9">
      <input type="hidden" name="f[id_nasabah]" id="id_nasabah" value="{{ @$item->id_nasabah }}">
      <input type="text" class="form-control" name="f[nama_nasabah]" id="nama_nasabah" value="{{ @$item->nama_nasabah }}" placeholder="Nama Nasabah" required="" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Tanggal</label>
    <div class="col-lg-9">
      <input type="date" class="form-control" name="f[tanggal]" id="tanggal" value="{{ (!empty(@$item->tanggal)) ? @$item->tanggal : date('Y-m-d') }}" placeholder="Tanggal" required="" readonly>
    </div>
  </div>
  @if($item->jatuh_tempo > date('Y-m-d'))
    <div class="form-group">
      <label class="col-md-3 control-label">&nbsp</label>
      <div class="col-md-9">
        <label for="" class="label label-danger">Penarikan dilakukan sebelum jatuh tempo {{ date('d-m-Y', strtotime($item->jatuh_tempo)) }}, anda dikenai pinalti sebesar 1%</label>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-3 control-label">Denda Pinalti</label>
      <div class="col-lg-9">
        <div class="input-group">
          <div class="input-group-btn">
            <span class="btn btn-default btn-flat">Rp</span>
          </div>
          <input type="text" class="form-control mask-number" name="f[denda_pinalti]" id="denda_pinalti" value="{{ @$item->denda_pinalti }}" readonly>
        </div>
      </div>
    </div>
  @else
    <div class="form-group">
      <label class="col-lg-3 control-label">Bunga</label>
      <div class="col-lg-9">
        <div class="input-group">
          <div class="input-group-btn">
            <span class="btn btn-default btn-flat">Rp</span>
          </div>
          <input type="text" class="form-control mask-number" name="f[total_bunga]" id="total_bunga" value="{{ ($item->jatuh_tempo > date('Y-m-d')) ? 0 : @$item->total_bunga }}" readonly>
        </div>
      </div>
    </div>
  @endif

  <div class="form-group">
    <label class="col-lg-3 control-label">Saldo</label>
    <div class="col-lg-9">
      <div class="input-group">
        <div class="input-group-btn">
          <span class="btn btn-default btn-flat">Rp</span>
        </div>
        <input type="text" class="form-control mask-number" name="" id="saldo" value="{{ @$saldo_real }}" placeholder="Saldo" required="" readonly>
      </div>
    </div>
</div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Jumlah yang bisa ditarik</label>
    <div class="col-lg-9">
      <div class="input-group">
        <div class="input-group-btn">
          <span class="btn btn-default btn-flat">Rp</span>
        </div>
        <input type="text" class="form-control mask-number" name="f[debet]" id="penarikan" value="{{ @$saldo }}" placeholder="Penarikan" autocomplete="off" readonly>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Akun Kas</label>
    <div class="col-lg-9">
          <select name="f[id_akun]" class="form-control" required="" id="id_akun">
            <?php foreach(@$option_akun as $dt): ?>
              <option value="<?php echo @$dt->id_akun ?>" <?= @$dt->id_akun == @$item->id_akun ? 'selected': null ?>><?php echo @$dt->nama_akun ?></option>
            <?php endforeach; ?>
          </select>
    </div>
  </div>
  <div class="form-group">
      <div class="col-lg-offset-3 col-lg-9">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-success btn-save"><i class="fas fa-spinner fa-spin spinner" style="display: none"></i> Simpan</button>
      </div>
  </div>
</form>
      

<script type="text/javascript">
  $(document).ready(function(){
    mask_number.init()
    var saldo = mask_number.currency_remove($('#saldo').val());
        penarikan = mask_number.currency_remove($('#penarikan').val());
        denda_pinalti = parseFloat(saldo) - parseFloat(penarikan);
        $("#denda_pinalti").val(mask_number.currency_add(denda_pinalti))

  })
  $(".btn-save").on('click',function(e) {
    e.preventDefault();
    if(!confirm('Apakah anda yakin memproses data ini?')){
      return false
    }

    $('.btn-save').addClass('disabled', true);
    $(".spinner").css("display", "");
    var post_data = {
          'tanggal' : $("#tanggal").val(),
          'id_tabungan_berjangka' : $("#id_tabungan_berjangka").val(),
          'debet' : mask_number.currency_remove($("#penarikan").val()),
          'id_akun' : $("#id_akun").val(),
        }

        denda = {
          'denda_pinalti' : mask_number.currency_remove($("#denda_pinalti").val()),
        }

     data_post = {
          "f" : post_data,
          "g" : denda
        }
        
    $.post($("#form_crud").attr("action"), data_post, function(response, status, xhr) {
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