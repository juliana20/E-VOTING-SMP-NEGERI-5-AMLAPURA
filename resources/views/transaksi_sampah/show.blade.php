@extends('themes.AdminLTE.layouts.template')
<style>
  .form-horizontal .control-label {
    text-align: left!important;
}
</style>
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
            <a href="{{ url("transaksi-retribusi-sampah/cetak-nota/{$item->id}") }}" target="_blank" class="btn btn-warning btn-sm"><i class="fa fa-print" aria-hidden="true"></i> Cetak Nota Transaksi</a>
          </div>
        </button>
      </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="col-sm-10 col-sm-offset-1">
        <form  method="POST" action="{{ url($submit_url) }}" class="form-horizontal" name="form_crud">
          <div class="form-group">
            <label class="col-lg-3 control-label">Kode Transaksi</label>
            <div class="col-lg-9">
              <label class="control-label">: {{ $item->kode_transaksi_sampah }}</label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Tanggal Transaksi</label>
            <div class="col-lg-9">
              <label class="control-label">: {{ date('d-m-Y', strtotime($item->tanggal)) }}</label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Pelanggan</label>
            <div class="col-lg-9">
              <label class="control-label">: {{ @$item->nama_pelanggan }}</label>
            </div>
          </div>
        </form>
          <table class="table table-bordered table-hover" width="100%">   
            <thead>
              <tr>
                <th>Jumlah Tagihan</th>
                <th>Biaya Jasa</th>
                <th>Total Bayar</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Rp. {{ number_format($item->jumlah, 0) }}</td>
                <td>Rp. {{ number_format($item->biaya_jasa, 0) }}</td>
                <td>Rp. {{ number_format($item->total_bayar, 0) }}</td>
              </tr>
            </tbody>
          </table>
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