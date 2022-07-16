@extends('themes.AdminLTE.layouts.template')
@section('breadcrumb') 
@endsection
@section('content')  
<div class="col-sm-8 col-sm-offset-2">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{ @$header }}</h3>
        <div class="box-tools pull-right">
            <div class="btn-group">
              <button class="btn btn-info btn-sm" id="modalCreate"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{ __('global.label_create') }}</button>
            </div>
          </button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
        <table class="table table-hover" id="{{ $idDatatables }}" width="100%">   
            <thead>
              <tr>
                <th class="no-sort">No</th>
                <th>ID Kelas</th>
                <th>Nama Kelas</th>
                <th class="no-sort">Aksi</th>
              </tr>
            </thead>
            <tbody>
            
          </tbody>
          </table>
      </div>
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
              size : 'modal-md',
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
                                data: "kode_kelas", 
                                render: function ( val, type, row ){
                                    return val
                                  }
                          },
                          { 
                                data: "nama_kelas", 
                                render: function ( val, type, row ){
                                    return val
                                  }
                          },
                          { 
                                data: "id",
                                className: "text-center",
                                render: function ( val, type, row ){
                                    var buttons = '<div class="btn-group" role="group">';
                                      buttons += '<a class=\"btn btn-info btn-xs modalEdit\"><i class=\"glyphicon glyphicon-pencil\"></i> Ubah</a>';
                                      buttons += '<a href=\"{{ url('kelas/daftar-siswa') }}/'+ val +'\" class=\"btn btn-success btn-xs\"><i class=\"fa fa-group\"></i> Daftar Siswa</a>';
                                      buttons += "</div>";
                                    return buttons
                                  }
                              },
                      ],
                      createdRow: function ( row, data, index ){		
                        $( row ).on( "click", ".modalEdit",  function(e){
                            e.preventDefault();
                            var id = data.id;
                            var _prop= {
                                _this : $( this ),
                                remote : "{{ url("$nameroutes") }}/edit/" + id,
                                size : 'modal-md',
                                title : "<?= @$headerModalEdit ?>",
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
 
