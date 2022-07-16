@extends('themes.AdminLTE.layouts.template')
@section('breadcrumb')  
  <h1>
    {{ @$title }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Master</a></li>
    <li><a href="{{ url($nameroutes) }}">{{ @$title }}</a></li>
    <li class="active">{{ @$header }}</li>
  </ol>
@endsection
@section('content')  
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">{{ @$header }}</h3>
        <div class="box-tools pull-right">
            <div class="btn-group">
              <a href="{{ url('transaksi-retribusi-sampah/create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{ __('global.label_create') }}</a>
            </div>
          </button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="col-sm-9 col-sm-offset-1">
        <form  method="POST" action="{{ url($submit_url) }}" class="form-horizontal" name="form_crud">
          {{ csrf_field() }}
          <div class="form-group">
            <label class="col-lg-3 control-label">Kode Transaksi</label>
            <div class="col-lg-9">
              <input type="text" class="form-control" name="f[kode_transaksi_sampah]" id="kode_transaksi_sampah" value="{{ @$item->kode_transaksi_sampah }}" placeholder="Kode Transaksi Sampah" required="" readonly>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Tanggal Transaksi</label>
            <div class="col-lg-9">
              <input type="date" class="form-control" name="f[tanggal]" id="tanggal" value="{{ date('Y-m-d', strtotime($item->tanggal)) }}" placeholder="Tanggal Transaksi" required="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Pelanggan</label>
            <div class="col-lg-9">
              <div class="input-group data_collect_wrapper">
                <input type="hidden" value="{{ @$item->pelanggan_id }}" id="pelanggan_id" name="f[pelanggan_id]" required>
                <input type="text" name="f[nama_pelanggan]" id="nama_pelanggan" class="form-control" placeholder="Pelanggan" value="{{ @$item->nama_pelanggan }}" required readonly>
                <div class="input-group-btn">
                  <a href="javascript:;" id="lookup_pelanggan" class="btn btn-info btn-flat data_collect_btn"><i class="fa fa-search"></i> Cari</a>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Jumlah</label>
            <div class="col-lg-9">
              <div class="input-group">
                <div class="input-group-btn">
                  <span class="btn btn-default btn-flat">Rp</span>
                </div>
                <input type="text" name="f[jumlah]" id="jumlah" class="form-control mask-number" placeholder="Jumlah" value="{{ @$item->jumlah }}" required="">
              </div>
              </div>
            </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Biaya Jasa</label>
            <div class="col-lg-9">
              <div class="input-group">
                <div class="input-group-btn">
                  <span class="btn btn-default btn-flat">Rp</span>
                </div>
                <input type="text" class="form-control mask-number" name="f[biaya_jasa]" id="biaya_jasa" value="{{ @$item->biaya_jasa }}" placeholder="Biaya jasa" autocomplete="off">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Total Bayar</label>
            <div class="col-lg-9">
              <div class="input-group">
                <div class="input-group-btn">
                  <span class="btn btn-default btn-flat">Rp</span>
                </div>
                <input type="text" class="form-control mask-number" name="f[total_bayar]" id="total_bayar" value="{{ @$item->total_bayar }}" placeholder="Total Bayar" autocomplete="off" readonly>
              </div>
            </div>
          </div>
          <div class="form-group">
              <div class="col-lg-offset-3 col-lg-9">
                <button type="submit" class="btn btn-success btn-save">@if($is_edit) Perbarui @else Simpan @endif <i class="fas fa-spinner fa-spin spinner" style="display: none"></i></button> 
              </div>
          </div>
        </form>
      </div>
    </div>
    </div>
      

<script type="text/javascript">
  $(document).on("keyup",'#jumlah,#biaya_jasa', calculate);

  function calculate() {
      var jumlah = mask_number.currency_remove($('#jumlah').val());
          biaya_jasa = mask_number.currency_remove($('#biaya_jasa').val());
          total_bayar = jumlah + biaya_jasa;
          $("#total_bayar").val(mask_number.currency_add(total_bayar));
  }
  $(document).ready(function(){
    calculate();
    mask_number.init()
    
    $('#lookup_pelanggan').dataCollect({
        ajaxUrl: "{{ url('pelanggan/datatables') }}",
        modalSize : 'modal-lg',
        modalTitle : 'DAFTAR PILIHAN PELANGGAN',
        modalTxtSelect : 'Pilih Pelanggan',
        dtOrdering : true,
        dtOrder: [],
        dtThead:['Kode Pelanggan','Nama Pelanggan','Alamat'],
        dtColumns: [
            {data: "kode"}, 
            {data: "nama"}, 
            {data: "alamat"}, 
        ],
        onSelected: function(data, _this){	
          $('#pelanggan_id').val(data.id);
          $('#nama_pelanggan').val(data.nama); 
            
          return true;
        }
    });
  })

  $('form[name="form_crud"]').on('submit',function(e) {
    e.preventDefault();
    $('.btn-save').addClass('disabled', true);
    $(".spinner").css("display", "");

    var data = {
          'biaya_jasa' : mask_number.currency_remove($("#biaya_jasa").val()),
          'jumlah' : mask_number.currency_remove($("#jumlah").val()),
          'total_bayar' : mask_number.currency_remove($("#total_bayar").val()),
          'pelanggan_id' : $("#pelanggan_id").val(),
          'tanggal' : $("#tanggal").val(),
          'kode_transaksi_sampah' : $("#kode_transaksi_sampah").val(),
        }
     data_post = {
          "f" : data,
        }
    $.ajax({
        url: $(this).prop('action'),
        type: 'POST',              
        data: data_post,
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

@endsection