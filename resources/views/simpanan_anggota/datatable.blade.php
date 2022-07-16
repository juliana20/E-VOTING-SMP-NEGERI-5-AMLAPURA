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
            {{-- <div class="btn-group">
              <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
              Tindakan <i class="fa fa-wrench"></i></button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="" id="modalCreate"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Baru</a></li>
              </ul>
            </div> --}}
          {{-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button> --}}
          <div class="form-group  pull-right">
            <div class="col-lg-12">
              <input type="radio" id="berjalan" name="status_proses" value="0" checked>
              <label for="berjalan">Berjalan</label>
              <input type="radio" id="berhenti" name="status_proses" value="1">
              <label for="berhenti">Berhenti</label>
            </div>
        </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-striped table-bordered table-hover" id="{{ $idDatatables }}" width="100%">   
            <thead>
              <tr>
                <th class="no-sort">No</th>
                <th>No Anggota</th>
                <th>No Rek. Sim. Pokok</th>
                <th>No Rek. Sim. Wajib</th>
                <th>Nama Anggota</th>
                <th>Tanggal Bergabung</th>
                <th>Saldo Pokok</th>
                <th>Saldo Wajib</th>
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
              title : "<?= @$headerModalTambah ?>",
            }
            ajax_modal.show(_prop);											
          });  
        },
    };
    let _datatables_show = {
      dt__datatables_show:function(){
        var _this = $("#{{ $idDatatables }}");
            _datatable = _this.DataTable({									
              ajax: {
								url: "{{ url("{$urlDatatables}") }}",
								type: "POST",
								data: function(params){
                        params.proses = $('input[name="status_proses"]:checked').val();
										}
								},
              order:[ 1, 'asc'],
              columns: [
                          {
                              data: "id",
                              className: "text-center",
                              render: function (data, type, row, meta) {
                                  return meta.row + meta.settings._iDisplayStart + 1;
                              }
                          },
                          { 
                                data: "no_anggota", 
                                render: function ( val, type, row ){
                                    return val
                                  }
                          },
                          { 
                                data: "no_rek_sim_pokok", 
                                render: function ( val, type, row ){
                                    return val
                                  }
                          },
                          { 
                                data: "no_rek_sim_wajib", 
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
                                data: "tanggal_daftar", 
                                render: function ( val, type, row ){
                                    return val
                                  }
                          },
                          { 
                                data: "saldo_pokok", 
                                render: function ( val, type, row ){
                                    return (val == 0 || !val) ? 'Rp ' +0 : 'Rp ' + mask_number.currency_add(val)
                                  }
                          },
                          { 
                                data: "saldo_wajib", 
                                render: function ( val, type, row ){
                                    return (val == 0 || !val) ? 'Rp ' +0 : 'Rp ' + mask_number.currency_add(val)
                                  }
                          },
                          { 
                                data: "no_anggota",
                                className: "text-center",
                                render: function ( val, type, row ){
                                    var buttons = '<div class="btn-group" role="group">';
                                      buttons += '<a href=\"{{ url('simpanan-anggota/wajib') }}/'+ val +'\" title=\"Wajib\" class=\"btn btn-info btn-xs\"><i class=\"fa fa-pencil\"></i> Wajib</a>';
                                      buttons += '<a href=\"{{ url('simpanan-anggota/pokok') }}/'+ val +'\" class=\"btn btn-warning btn-xs\"><i class=\"fa fa-pencil\"></i> Pokok</a>';
                                      if(row.berhenti_anggota == 1)
                                      {
                                        buttons += '<a href=\"{{ url('simpanan-anggota/cetak') }}/'+ val +'\" target=\"\_blank" title=\"Cetak\" class=\"btn btn-danger btn-xs\"><i class=\"fa fa-print\"></i> Cetak</a>';
                                      }else{
                                        buttons += '<a class=\"btn btn-danger btn-xs modalEdit\"><i class=\"fa fa-credit-card\"></i> Tarik</a>';
                                      }
                                     
                                      buttons += "</div>";
                                    return buttons
                                  }
                              },
                      ],
                      createdRow: function ( row, data, index ){		
                        $( row ).on( "click", ".modalEdit",  function(e){
                            e.preventDefault();
                            var id = data.no_anggota;
                            var _prop= {
                                _this : $( this ),
                                remote : "{{ url("$nameroutes") }}/tarik/" + id,
                                size : 'modal-md',
                                title : "Penarikan Simpanan Anggota",
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
    $('input[name="status_proses"]').on('change', function(e){
        e.preventDefault();
        _datatable.ajax.reload();
    });
});
</script>
@endsection
 
