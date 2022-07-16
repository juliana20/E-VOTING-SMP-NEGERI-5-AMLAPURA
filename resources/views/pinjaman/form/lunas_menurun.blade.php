@extends('themes.AdminLTE.layouts.template')
@section('breadcrumb')  
  <h1>
    {{ @$title }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Master</a></li>
    <li><a href="{{ url(@$nameroutes) }}">{{ 'Pinjaman' }}</a></li>
    <li class="active">{{ @$title }}</li>
  </ol>
@endsection
@section('content')  
<div class="row">
  <div class="col-md-6">
  <div class="box">
        <!-- /.box-header -->
    <div class="box-body">
      <div class="col-md-12">
        <div class="form-group">
          <label for="exampleInputEmail1">No Pinjaman</label>
          : <label for="exampleInputEmail1">{{ @$item->id_pinjaman }}</label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label for="exampleInputEmail1">No Rekening</label>
          : <label for="exampleInputEmail1">{{ @$item->no_rek_tabungan }}</label>
        </div>
      </div>
    </div>  
  </div>
</div>

</div>

<div class="box">
  <div class="box-body">
    <div class="col-md-4">
        <div class="form-group">
          <label for="exampleInputEmail1">Tanggal Realisasi</label>
          <input type="date" class="form-control" name="f[tanggal]" id="tanggal" value="{{ date('Y-m-d') }}" placeholder="Tanggal" required="" readonly>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="exampleInputEmail1">No Nasabah</label>
        <input type="text" class="form-control" name="f[id_nasabah]" id="id_nasabah" value="{{ @$item->id_nasabah }}" placeholder="ID Nasabah" required="" readonly>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="exampleInputEmail1">Nama Nasabah</label>
        <input type="text" class="form-control" name="f[nama_nasabah]" id="nama_nasabah" value="{{ @$item->nama_nasabah }}" placeholder="Nama Nasabah" required="" readonly>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="exampleInputEmail1">Jumlah Pinjaman</label>
        <div class="input-group">
          <div class="input-group-btn">
            <span class="btn btn-default btn-flat">Rp</span>
          </div>
          <input type="text" class="form-control mask-number" name="f[jumlah_pinjaman]" id="jumlah_pinjaman" value="{{ @$item->jumlah_pinjaman }}" placeholder="Jumlah Pinjaman" required="" readonly>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="exampleInputEmail1">Jangka Waktu</label>
          <input type="text" class="form-control" name="f[jangka_waktu]" id="jangka_waktu" value="{{ @$item->jangka_waktu }}" placeholder="Jangka Waktu" required="" readonly>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="exampleInputEmail1">Jatuh Tempo</label>
          <input type="date" class="form-control" name="f[jatuh_tempo]" id="jatuh_tempo" value="{{ @$item->jatuh_tempo }}" placeholder="Jatuh Tempo" required="" readonly>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="exampleInputEmail1">Total Pokok Harus Dibayar</label>
        <div class="input-group">
          <div class="input-group-btn">
            <span class="btn btn-default btn-flat">Rp</span>
          </div>
          <input type="text" class="form-control mask-number" name="f[pokok]" id="pokok" value="{{ @$item->jumlah_pinjaman }}" placeholder="Pokok" required="" readonly>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="exampleInputEmail1">Total Pokok Sudah Dibayar</label>
        <div class="input-group">
          <div class="input-group-btn">
            <span class="btn btn-default btn-flat">Rp</span>
          </div>
          <input type="text" class="form-control mask-number" name="f[sudah_bayar_pokok]" id="sudah_bayar_pokok" value="{{ @$jumlah_pokok_sudah_dibayar }}" required="" readonly>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="exampleInputEmail1">Sisa Pokok</label>
        <div class="input-group">
          <div class="input-group-btn">
            <span class="btn btn-default btn-flat">Rp</span>
          </div>
          <input type="text" class="form-control mask-number" name="f[sisa_pokok]" id="sisa_pokok" value="{{ (@$item->jumlah_pinjaman - @$jumlah_pokok_sudah_dibayar) }}"  required="" readonly>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="exampleInputEmail1">Total Bunga Harus Dibayar</label>
        <div class="input-group">
          <div class="input-group-btn">
            <span class="btn btn-default btn-flat">Rp</span>
          </div>
          <input type="text" class="form-control mask-number" name="f[nominal_bunga]" id="nominal_bunga" value="{{ @$item->sisa_pinjaman * @$item->bunga_pinjaman }}"  required="" readonly>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="exampleInputEmail1">Total Bunga Sudah Dibayar</label>
        <div class="input-group">
          <div class="input-group-btn">
            <span class="btn btn-default btn-flat">Rp</span>
          </div>
          <input type="text" class="form-control mask-number" name="f[nominal_bunga_sudah_bayar]" id="nominal_bunga_sudah_bayar" value="{{ @$jumlah_bunga_sudah_dibayar }}"  required="" readonly>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="exampleInputEmail1">Total Pembayaran</label>
        <div class="input-group">
          <div class="input-group-btn">
            <span class="btn btn-default btn-flat">Rp</span>
          </div>
          @php 
            $bunga = @$item->sisa_pinjaman * @$item->bunga_pinjaman; 
            $pokok = @$item->jumlah_pinjaman - @$jumlah_pokok_sudah_dibayar;
          @endphp
          <input type="text" class="form-control mask-number" name="f[total]" id="total" value="{{ @$bunga + $pokok }}" placeholder="Total" required="" readonly>
          <input type="hidden" class="form-control mask-number" name="f[sisa_bunga]" id="sisa_bunga" value="0"  required="" readonly>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="exampleInputEmail1">Akun Kas</label>
        <select name="f[id_akun]" class="form-control" required="" id="id_akun">
          <?php foreach(@$option_akun as $dt): ?>
            <option value="<?php echo @$dt->id_akun ?>" <?= @$dt->id_akun == @$item->id_akun ? 'selected': null ?>><?php echo @$dt->nama_akun ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    @if(@$item->lunas == 1)
      <div class="form-group">
        <div class="col-lg-12">
          <h1 align="center">Status pinjaman ini sudah lunas!</h1>
        </div>
      </div>
    @else
      <div class="form-group">
        <div class="col-lg-12">
          <button id="submit_form" type="submit" class="btn btn-success btn-save btn-block">@if($is_edit) Perbarui @else Simpan @endif <i class="fas fa-spinner fa-spin spinner" style="display: none"></i></button> 
        </div>
      </div>
    @endif
  </div>

<script type="text/javascript">
  $(".btn-save").on('click',function(e) {
      e.preventDefault();
      if(!confirm('Apakah anda yakin memproses data ini?')){
        return false
      }
      $('.btn-save').addClass('disabled', true);
      $(".spinner").css("display", "");
          var header_data = {
                    'tanggal' : $("#tanggal").val(),
                    'pokok' : mask_number.currency_remove($("#sisa_pokok").val()),
                    'bunga' : mask_number.currency_remove($("#sisa_bunga").val()),
                    'id_akun' : $("#id_akun").val(),
                    'total' : mask_number.currency_remove($("#total").val()),
                    'sisa_pinjaman' : 0,
                    'sisa_bunga' : 0,
                    
                }

            var data_post = {
                    "f" : header_data
                }
        
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
                // location.reload();
                document.location.href = "{{ url("$nameroutes") }}";        
              }, 500);  
      }).catch(error => {
            $.alert_error(error);
                $('.btn-save').removeClass('disabled');
                $(".spinner").css("display", "none");
                return false
      });
});

</script>
@endsection