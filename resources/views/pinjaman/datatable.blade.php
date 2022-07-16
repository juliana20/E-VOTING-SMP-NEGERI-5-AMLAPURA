@extends('themes.AdminLTE.layouts.template')
@section('breadcrumb')  
  <h1>
    {{ @$title }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Master</a></li>
    <li class="active">{{ @$title }}</li>
  </ol>
@endsection
@section('content')  
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">{{ @$title }}</h3>
        <div class="box-tools pull-right">
            <div class="btn-group">
              <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
              Tindakan <i class="fa fa-wrench"></i></button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="" id="modalCreate"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Baru</a></li>
              </ul>
            </div>
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-striped table-bordered table-hover" id="dt_pinjaman" width="100%">   
            <thead>
              <tr>
                <th class="no-sort">No</th>
                <th>No Pinjaman</th>
                <th>Nama Nasabah</th>
                <th>Jumlah Pinjaman</th>
                <th>Jumlah Diterima</th>
                <th>Angsuran</th>
                <th>Sisa Pinjaman</th>
                <th>Jatuh Tempo</th>
                <th class="no-sort">Aksi</th>
              </tr>
            </thead>
            <tbody>
            
          </tbody>
          </table>
      </div>
    </div>

<!-- DataTable -->
<script type="text/javascript">
    let lookup = {
      lookup_modal_create: function() {
          $('#modalCreate').on( "click", function(e){
            e.preventDefault();
            var _prop= {
              _this : $( this ),
              remote : "{{ url("$nameroutes") }}/create",
              size : 'modal-lg',
              title : "Tambah Pinjaman",
            }
            ajax_modal.show(_prop);											
          });  
        },
    };
    let _datatables_show = {
      dt__datatables_show:function(){
        var _this = $("#dt_pinjaman");
            _datatable = _this.DataTable({									
              ajax: {
								url: "{{ url("$nameroutes") }}/datatables",
								type: "POST",
                data: function(params){

										}
								},
              order:[ 1, 'asc'],
              columns: [
                          {
                              data: "id_pinjaman",
                              className: "text-center",
                              render: function (data, type, row, meta) {
                                  return meta.row + meta.settings._iDisplayStart + 1;
                              }
                          },
                          { 
                                data: "id_pinjaman", 
                                render: function ( val, type, row ){
                                    return val
                                  }
                          },
                          { 
                                data: "nama_nasabah", 
                                render: function ( val, type, row ){
                                    return val
                                  }
                          },
                          { 
                                data: "jumlah_pinjaman", 
                                render: function ( val, type, row ){
                                    return (val == 0 || !val) ? 'Rp ' +0 : 'Rp ' + mask_number.currency_add(val)
                                  }
                          },
                          { 
                                data: "jumlah_diterima", 
                                render: function ( val, type, row ){
                                    return (val == 0 || !val) ? 'Rp ' +0 : 'Rp ' + mask_number.currency_add(val)
                                  }
                          },
                          { 
                                data: "angsuran", 
                                render: function ( val, type, row ){
                                    return (val == 0 || !val) ? 'Rp ' +0 : 'Rp ' + mask_number.currency_add(val)
                                  }
                          },
                          { 
                                data: "sisa_pinjaman", 
                                render: function ( val, type, row ){
                                    return (val == 0 || !val) ? 'Rp ' +0 : 'Rp ' + mask_number.currency_add(val)
                                  }
                          },
                          { 
                                data: "jatuh_tempo", 
                                render: function ( val, type, row ){
                                    return moment(val).format('DD MMM YYYY')
                                  }
                          },
                          { 
                                data: "id_pinjaman",
                                className: "text-center",
                                width: '200px',
                                render: function ( val, type, row ){
                                    var buttons = '<div class="btn-group" role="group">';
          
                                        buttons += '<a href=\"{{ url('pinjaman/bayar') }}/'+ val +'\" class=\"btn btn-warning btn-xs\"><i class=\"fa fa-credit-card\"></i> Bayar</a>';
                                        buttons += '<a href=\"{{ url('pinjaman/lunas') }}/'+ val +'\" class=\"btn btn-success btn-xs\"><i class=\"fa fa-usd\"></i> Lunas</a>';
                                        buttons += '<a href=\"{{ url('pinjaman/details') }}/'+ val +'\" title=\"Lihat\" class=\"btn btn-info btn-xs\"><i class=\"fa fa-eye\"></i> Detail</a>';
                                     
                                    buttons += "</div>";
                                    return buttons
                                  }
                              },
                      ],
                      createdRow: function ( row, data, index ){		
                        $( row ).on( "click", ".modalSetoran",  function(e){
                            e.preventDefault();
                            var id = data.id_tabungan_berjangka;
                            var _prop= {
                                _this : $( this ),
                                remote : "{{ url("$nameroutes") }}/setoran/" + id,
                                size : 'modal-md',
                                title : "Setoran Pinjaman",
                            }
                            ajax_modal.show(_prop);											
                        }),
                        $( row ).on( "click", ".modalPenarikan",  function(e){
                            e.preventDefault();
                            var id = data.id_tabungan_berjangka;
                            var _prop= {
                                _this : $( this ),
                                remote : "{{ url("$nameroutes") }}/penarikan/" + id,
                                size : 'modal-md',
                                title : "Penarikan Tabungan Berjangka",
                            }
                            ajax_modal.show(_prop);											
                        })

                      }
                                                  
                  });
							
                  return _this;
				}
			}

$(document).ready(function() {
    _datatables_show.dt__datatables_show();
    lookup.lookup_modal_create();
});
</script>
@endsection
 
