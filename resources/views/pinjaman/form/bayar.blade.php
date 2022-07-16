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
      <div class="col-md-6">
        <div class="form-group">
          <label for="exampleInputEmail1">No Pinjaman</label>
          : <label for="exampleInputEmail1">{{ @$item->id_pinjaman }}</label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="exampleInputEmail1">Tunggakan Pokok</label>
          : <label for="exampleInputEmail1">{{ number_format(@$item->jumlah_pinjaman - @$jumlah_pokok_sudah_dibayar, 2) }}</label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="exampleInputEmail1">Jumlah Pinjaman</label>
          : <label for="exampleInputEmail1">{{ number_format(@$item->jumlah_pinjaman, 2) }}</label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="exampleInputEmail1">Pokok Bulan Ini</label>
          : <label for="exampleInputEmail1">{{ number_format(round(@$item->jumlah_pinjaman / @$item->jangka_waktu), 2) }}</label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="exampleInputEmail1">Jumlah Sudah Dibayar</label>
          : <label for="exampleInputEmail1">{{ number_format(@$jumlah_sudah_dibayar, 2) }}</label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="exampleInputEmail1">Total Bunga</label>
          : <label for="exampleInputEmail1">{{ number_format(@$item->sisa_bunga, 2) }}</label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="exampleInputEmail1">Sisa Pinjaman</label>
          : <label for="exampleInputEmail1">{{ number_format((@$item->jumlah_pinjaman) - @$jumlah_sudah_dibayar, 2) }}</label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="exampleInputEmail1">Bunga Bulan Ini</label>
          : <label for="exampleInputEmail1">{{ number_format(@$item->nominal_bunga, 2) }}</label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="exampleInputEmail1">Tanggal Bayar Terakhir</label>
          : <label for="exampleInputEmail1">{{ @$tanggal_bayar_terakhir->tanggal }}</label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="exampleInputEmail1">Denda</label>
          : <label for="exampleInputEmail1">{{ number_format(0, 2) }}</label>
        </div>
      </div>
    </div>  
  </div>
  </div>
  <div class="col-md-6">
  <div class="box">
        <!-- /.box-header -->
    <div class="box-body">
      <div class="col-md-12">
        <div class="form-group">
          <label for="exampleInputEmail1">No Rekening</label>
          : <label for="exampleInputEmail1">{{ @$item->no_rek_tabungan }}</label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label for="exampleInputEmail1">Nama Nasabah</label>
          : <label for="exampleInputEmail1">{{ @$item->nama_nasabah }}</label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label for="exampleInputEmail1">Keterangan Bunga</label>
          : <label for="exampleInputEmail1">{{ (@$item->menetap == 1) ? @$item->bunga_pinjaman * 100 .'% '.' Menetap' : @$item->bunga_pinjaman * 100 .'% '.' Menurun'  }}</label>
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
          <label for="exampleInputEmail1">Tanggal</label>
          <input type="date" class="form-control" name="f[tanggal]" id="tanggal" value="{{ date('Y-m-d') }}" placeholder="Tanggal" required="" readonly>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="exampleInputEmail1">Pembayaran Pokok</label>
        <div class="input-group">
          <div class="input-group-btn">
            <span class="btn btn-default btn-flat">Rp</span>
          </div>
          <input type="text" class="form-control mask-number calculate" name="f[pokok]" id="pokok" value="{{ ($item->lunas == 1) ? 0 : round(@$item->jumlah_pinjaman / @$item->jangka_waktu) }}" placeholder="Pokok" required="">
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="exampleInputEmail1">Pembayaran Bunga</label>
        <div class="input-group">
          <div class="input-group-btn">
            <span class="btn btn-default btn-flat">Rp</span>
          </div>
          <input type="text" class="form-control mask-number calculate" name="f[bunga]" id="bunga" value="{{ ($item->lunas == 1) ? 0 : round(@$item->nominal_bunga) }}" placeholder="Bunga" required="" >
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="exampleInputEmail1">Pembayaran Denda</label>
        <div class="input-group">
          <div class="input-group-btn">
            <span class="btn btn-default btn-flat">Rp</span>
          </div>
          <input type="text" class="form-control mask-number" name="f[denda]" id="denda" value="{{ ($item->lunas == 1) ? 0 : @$denda }}" placeholder="Denda" required="">
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
    <div class="col-md-4">
      <div class="form-group">
        <label for="exampleInputEmail1">Total</label>
        <div class="input-group">
          <div class="input-group-btn">
            <span class="btn btn-default btn-flat">Rp</span>
          </div>
          @php $total = round((@$item->jumlah_pinjaman / @$item->jangka_waktu) + (@$item->nominal_bunga)); @endphp
          <input type="text" class="form-control mask-number" name="f[total]" id="total" value="{{ ($item->lunas == 1) ? 0 : @$total }}" placeholder="Total" required="" readonly>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="exampleInputEmail1">Sisa Pinjaman</label>
        <div class="input-group">
          <div class="input-group-btn">
            <span class="btn btn-default btn-flat">Rp</span>
          </div>
          @php $sisa_pinjaman = ((@$item->jumlah_pinjaman + @$item->nominal_bunga) - @$jumlah_sudah_dibayar) - $total; @endphp
          <input type="text" class="form-control mask-number" name="f[sisa_pinjaman]" id="sisa_pinjaman" value="{{ ($item->lunas == 1) ? 0 : @$sisa_pinjaman }}" placeholder="Sisa Pinjaman" required="" readonly>
        </div>
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
  $(document).on("keyup",'.calculate', calculate);
  function calculate() {
    var pokok = mask_number.currency_remove($('#pokok').val());
        bunga = mask_number.currency_remove($("#bunga").val());
        sisa_pinjaman = "{{ $item->sisa_pinjaman }}";

        total = pokok +bunga;
        sisa_pinjaman = sisa_pinjaman - total;

        $("#total").val(mask_number.currency_add(total));
        $("#sisa_pinjaman").val(mask_number.currency_add(sisa_pinjaman));
  }
 
  $(".btn-save").on('click',function(e) {
      e.preventDefault();
      if(!confirm('Apakah anda yakin memproses data ini?')){
        return false
      }
      $('.btn-save').addClass('disabled', true);
      $(".spinner").css("display", "");
          var header_data = {
                    'tanggal' : $("#tanggal").val(),
                    'pokok' : mask_number.currency_remove($("#pokok").val()),
                    'bunga' : mask_number.currency_remove($("#bunga").val()),
                    'denda' : mask_number.currency_remove($("#denda").val()),
                    'id_akun' : $("#id_akun").val(),
                    'total' : mask_number.currency_remove($("#total").val()),
                    'sisa_pinjaman' : mask_number.currency_remove($("#sisa_pinjaman").val()),
                    
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