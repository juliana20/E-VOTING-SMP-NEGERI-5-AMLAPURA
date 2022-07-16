@extends('themes.AdminLTE.layouts.template')
@section('breadcrumb')  
  <h1>
    {{ @$title }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Master</a></li>
    <li><a href="{{ url(@$nameroutes.'/angsuran') }}">{{ 'Angsuran' }}</a></li>
    <li class="active">{{ @$title }}</li>
  </ol>
@endsection
@section('content')  
<form  method="POST" action="{{ url($submit_url) }}" class="" name="form_crud">
  {{ csrf_field() }}
  <div class="box">
        <!-- /.box-header -->
    <div class="box-body" id="proses0">
      <div class="col-md-4">
        <div class="form-group">
          <label for="exampleInputEmail1">No Rekening</label>
          <input type="text" class="form-control" name="f[no_rek_tabungan]" id="no_rek_tabungan" value="{{ @$item->no_rek_tabungan }}" placeholder="No Rekening" required="" readonly>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="exampleInputEmail1">Nominal</label>
          <input type="text" class="form-control mask-number" name="f[total]" id="total" value="{{ @$item->total }}" required="" readonly>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="exampleInputEmail1"><?= '&nbsp' ?> </label>
          <button type="button" class="btn btn-success btn-block btn-save"><i class="fas fa-spinner fa-spin spinner" style="display: none"></i> Proses</button>
        </div>
      </div>
    </div>  
    {{-- <div class="box-body" id="proses1" style="display: none">
      <h1 style="text-align: center">Belum ada setoran tabungan!</h1>
    </div>   --}}
  </div>
</form>
<div class="box">
  <div class="box-body">
    <div class="col-md-6">
      <div class="form-group">
          <label class="col-lg-3 control-label">No Pinjaman</label>
          <div class="col-lg-9">
            : <label class="control-label">{{ @$item->id_pinjaman }}</label>
          </div>
      </div>
      <div class="form-group">
        <label class="col-lg-3 control-label">Nasabah</label>
        <div class="col-lg-9">
          <input type="hidden" id="id_nasabah" value="{{ @$item->id_nasabah }}">
          : <label class="control-label">{{ @$item->nama_nasabah }}</label>
        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-3 control-label">Tgl Bergabung</label>
        <div class="col-lg-9">
          : <label class="control-label">{{ date('d M Y', strtotime(@$item->tanggal_daftar)) }}</label>
        </div>
      </div>

    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label class="col-lg-3 control-label">Sisa Angsuran</label>
        <div class="col-lg-9">
          : <label class="control-label">Rp {{ number_format(@$item->sisa_pinjaman, 0) }}</label>
        </div>
      </div>
    </div>

 
    <div class="col-lg-12">
      <hr>
      <table class="table table-striped table-hover" id="dt_detail" width="100%">   
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Pokok</th>
            <th>Bunga</th>
            <th>Total</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        
        </tbody>
      </table>
    </div>
  </div>

<script type="text/javascript">
      var _datatable_actions = {

			};

      var _datatables_dt_detail = {
        dt_detail:function(){
        _datatable = $('#dt_detail').DataTable({
        processing: true,
        serverSide: false,								
        paginate: true,
        ordering: true,
        searching: true,
        info: true,
        order:[ 0, 'desc'],
        destroy: true,
        responsive: false,								
        <?php if (!empty(@$collection)):?>
          data: <?php print_r(json_encode(@$collection, JSON_NUMERIC_CHECK));?>,
        <?php endif; ?>
        columns: [
                    { 
                          data: "tanggal", 
                          render: function ( val, type, row ){
                              return moment(val).format("DD MMMM Y");  
                            }
                    },
                    { 
                          data: "pokok", 
                          render: function ( val, type, row ){
                              return (val == 0 || !val) ? 'Rp ' +0 : 'Rp ' + mask_number.currency_add(val)
                            }
                    },
                    { 
                          data: "bunga", 
                          render: function ( val, type, row ){
                              return (val == 0 || !val) ? 'Rp ' +0 : 'Rp ' + mask_number.currency_add(val)
                            }
                    },
                    { 
                          data: "total", 
                          render: function ( val, type, row ){
                            return (val == 0 || !val) ? 'Rp ' +0 : 'Rp ' + mask_number.currency_add(val)
                            }
                    },
                    { 
                            data: "id",
                            className: "text-center",
                            render: function ( val, type, row ){
                                var buttons = '<div class="btn-group" role="group">';
                                  buttons += '<a href=\"{{ url('pinjaman/cetak-detail') }}/'+ val +'\" target=\"\_blank" title=\"Cetak\" class=\"btn btn-warning btn-xs\"><i class=\"fa fa-print\"></i> Cetak</a>';
                                  buttons += "</div>";
                                return buttons
                              }
                          },
                ],
                createdRow: function ( row, data, index ){		

              }
                                            
            });
        
  }

}
	$( document ).ready(function(e) {
    _datatables_dt_detail.dt_detail();
    if("<?= @$item->proses == 1 ?>"){
      $("#proses1").css("display", "");
      $("#proses0").css("display", "none");
    }
  });
  $(".btn-save").on('click',function(e) {
      e.preventDefault();
      if(!confirm('Apakah anda yakin memproses data ini?')){
        return false
      }
      $('.btn-save').addClass('disabled', true);
      $(".spinner").css("display", "");
          var header_data = {
                    'no_rek_tabungan' : $("#no_rek_tabungan").val(),
                    'total' : $("#total").val(),
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
@endsection