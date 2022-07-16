@extends('themes.AdminLTE.layouts.template')
@section('content')  
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">{{ @$title }}</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-striped table-bordered table-hover" id="dt_tabungan_nasabah" width="100%">   
            <thead>
              <tr>
                <th class="no-sort">No</th>
                <th>Tanggal</th>
                <th>Pokok</th>
                <th>Bunga</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
            
          </tbody>
          </table>
      </div>
    </div>

<!-- DataTable -->
<script type="text/javascript">
    let _datatables_show = {
      dt__datatables_show:function(){
        var _this = $("#dt_tabungan_nasabah");
            _datatable = _this.DataTable({									
              ajax: {
								url: "{{ url('nasabah/pinjaman/datatables') }}",
								type: "POST",
								data: function(params){
                    params.id_nasabah = "{{ Helpers::isNasabah() }}"
									}
								},
              order:[ 1, 'asc'],
              columns: [
                          {
                              data: "id_nasabah",
                              className: "text-center",
                              render: function (data, type, row, meta) {
                                  return meta.row + meta.settings._iDisplayStart + 1;
                              }
                          },
                          { 
                                data: "tanggal", 
                                render: function ( val, type, row ){
                                    return val
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
                      ],
                      createdRow: function ( row, data, index ){		
 

                      }
                                                  
                  });
							
                  return _this;
				}
			}

$(document).ready(function() {
    _datatables_show.dt__datatables_show();
});
</script>
@endsection
 
