@extends('themes.AdminLTE.layouts.template')
@section('breadcrumb')  
  <h1>
    {{ @$title }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Master</a></li>
    <li><a href="{{ url(@$nameroutes) }}">{{ @$breadcrumb }}</a></li>
    <li class="active">{{ @$title }}</li>
  </ol>
@endsection
@section('content')  
  <div class="box">
    <div class="box-header">
        {{-- <h3 class="box-title">{{ @$title }}</h3> --}}
        <div class="box-tools pull-right">
          <div class="btn-group">
            @if(@$item->berhenti_anggota == 1)
              <h4>Status anggota sudah berhenti!</h4>
            @else
              <button type="button" class="btn btn-sm btn-warning modalSetoran"><i class="fa fa-plus" aria-hidden="true"></i> Setoran</button>
              {{-- <button type="button" class="btn btn-sm btn-danger modalPenarikan"><i class="fa fa-minus" aria-hidden="true"></i> Penarikan</button> --}}
            @endif
          </div>
        </div>
      </div>
      <!-- /.box-header -->
  <div class="box-body">
    <div class="col-md-6">
      <div class="form-group">
          <label class="col-lg-3 control-label">No Rekening</label>
          <div class="col-lg-9">
            : <label class="control-label">{{ @$item->no_rek_sim_wajib }}</label>
          </div>
      </div>
      <div class="form-group">
        <label class="col-lg-3 control-label">Anggota</label>
        <div class="col-lg-9">
          <input type="hidden" id="id_nasabah" value="{{ @$item->id_nasabah }}">
          : <label class="control-label">( {{ @$item->no_anggota }} ) {{ @$item->nama_nasabah }}</label>
        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-3 control-label">Tgl Bergabung</label>
        <div class="col-lg-9">
          : <label class="control-label">{{ date('d M Y', strtotime(@$item->tanggal_daftar)) }}</label>
        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-3 control-label">Saldo</label>
        <div class="col-lg-9">
          : <label class="control-label">{{ number_format(@$saldo,2) }}</label>
        </div>
      </div>
    </div>
      
       
  </div>
  <div class="box-body">
    <div class="col-lg-12">
      {{-- tabel --}}
      <table class="table table-striped table-hover" id="dt_detail_pembayaran" width="100%">   
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Debit</th>
            <th>Kredit</th>
            <th>Saldo Akhir</th>
          </tr>
        </thead>
        <tbody>
        
        </tbody>
      </table>
    </div>
  </div>

<script type="text/javascript">
      let lookup = {
        lookup_modal_setoran: function() {
            $('.modalSetoran').on( "click", function(e){
              e.preventDefault();
              var id_nasabah = $('#id_nasabah').val();
              _prop= {
                  _this : $( this ),
                  remote : "{{ url("$nameroutes") }}/lookup_form_setoran_wajib?id_nasabah=" + id_nasabah,
                  size : 'modal-md',
                  title : "Setoran Simpanan Wajib",
              }
              ajax_modal.show(_prop);											
            });  
          },
          lookup_modal_penarikan: function() {
            $('.modalPenarikan').on( "click", function(e){
              e.preventDefault();
              var id_nasabah = $('#id_nasabah').val();
              _prop= {
                  _this : $( this ),
                  remote : "{{ url("$nameroutes") }}/lookup_form_setoran_wajib_penarikan?id_nasabah=" + id_nasabah,
                  size : 'modal-md',
                  title : "Penarikan Simpanan Wajib",
              }
              ajax_modal.show(_prop);											
            });  
          },
          
      };
      var _datatable_actions = {
          edit: function( row, data, index ){
												
                        switch( this.index() ){									
                          case 2:
                          
                            var _input = $( "<input type=\"text\" value=\"" + Number(data.nominal_bayar || 1) + "\" style=\"width:100%\"  class=\"form-control mask-number\" min=\"1\">" );
                            var total;
                            this.empty().append( _input );
                            
                            
                            _input.trigger( "focus" );
                            
                            _input.on("blur", function(e){
                                e.preventDefault();
                                try{
                                  data.nominal_bayar = this.value;
                                    _datatable.row( row ).data( data );
                                    _datatable_actions.calculate_sum()
                                  
                                } catch(ex){}
                              });
                          break;
            
                          
            
                        }
                        
                      },
            calculate_sum: function(params, fn, scope){
                var grandtotal = 0;
                
                var collection = $( "#dt_detail_pembayaran" ).DataTable().rows().data();
                
                collection.each(function(value, index){
                  
                  grandtotal += Number(mask_number.currency_remove( value.nominal_bayar ));
                    
                });
                $("input[name='f[total]']").val(mask_number.currency_add(grandtotal));	
              },
          remove: function( params, fn, scope ){
						_datatable.row( scope ).remove().draw(false);
          }
			};

  var _datatables_detail_pembayaran = {
      dt_detail_pembayaran:function(){
          _datatable = $('#dt_detail_pembayaran').DataTable({
            processing: true,
            serverSide: false,								
            paginate: true,
            ordering: true,
            searching: true,
            info: true,
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
                              data: "debet", 
                              render: function ( val, type, row ){
                                  return (val == 0 || !val) ? 'Rp ' +0 : 'Rp ' + mask_number.currency_add(val)
                                }
                        },
                        { 
                              data: "kredit", 
                              render: function ( val, type, row ){
                                  return (val == 0 || !val) ? 'Rp ' +0 : 'Rp ' + mask_number.currency_add(val)
                                }
                        },
                        { 
                              data: "total_simp_wajib", 
                              render: function ( val, type, row ){
                                return (val == 0 || !val) ? 'Rp ' +0 : 'Rp ' + mask_number.currency_add(val)
                                }
                        },
                    ],
                    createdRow: function ( row, data, index ){		
                      _datatable_actions.calculate_sum();
                      $( row ).on( "dblclick", "td", function(e){
                          e.preventDefault();												
                          var elem = $( e.target );
                          _datatable_actions.edit.call( elem, row, data, index );
                        });
                      $( row ).on( "click", "a.btn-remove", function(e){
                          e.preventDefault();												
                          var elem = $( e.target );
                          
                          if( confirm( "Apakah anda yakin menghapus data ini?" ) ){
                            _datatable_actions.remove( data, null, row )
                            _datatable_actions.calculate_sum();
                          }
                      });
                  }
                                                
                });
            
      }

    }

	$( document ).ready(function(e) {
    _datatables_detail_pembayaran.dt_detail_pembayaran();
    lookup.lookup_modal_setoran();
    lookup.lookup_modal_penarikan();
  });
  $("form#form_crud").on('submit',function(e) {
      e.preventDefault();
          var header_data = {
                    'id_kk' : $("#id_kk").val(),
                    'tanggal' : $("#tanggal").val(),
                    'nis' :  $("#nis").val(),
                    'tahun_ajaran': $("#tahun_ajaran").val(),
                    'total': mask_number.currency_remove($("#total").val()),
                }

            var data_post = {
                    "details" : {},
                    "header" : header_data
                }
            
              _datatable.rows().data().each(function (value, index){
                    var details_form = {
                        'bulan' : value.bulan,
                        'nominal_bayar' : mask_number.currency_remove(value.nominal_bayar),
                        'jenis_iuran' : value.jenis_iuran,
                    }
                    data_post.details[index] = details_form;
                });
        
    $.post($(this).attr("action"), data_post, function(response, status, xhr) {
        if( response.status == "error"){
              $.alert_error( response.message );
							return false
						}
						
            $.alert_success( response.message );
            setTimeout(function(){
              document.location.href = "{{ url("$nameroutes") }}";  
            }, 500);  
    });
    return false;
});

</script>
@endsection