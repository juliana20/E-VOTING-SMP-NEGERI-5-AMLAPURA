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
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{ @$header }}</h3>
        <div class="box-tools pull-right">
            <div class="btn-group">
              <button class="btn btn-info btn-sm" id="modalCreate"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{ __('global.label_create') }}</button>
            </div>
            <div class="btn-group">
              <button class="btn btn-success btn-sm" id="modalImport"><i class="fa fa-file-text-o" aria-hidden="true"></i> Import</button>
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
                <th>NIS</th>
                <th>Nama Pemilih</th>
                <th>Kelas</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Agama</th>
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

										}
								},
              columns: [
                          {
                              data: "id",
                              className: "text-center",
                              render: function (data, type, row, meta) {
                                  return meta.row + meta.settings._iDisplayStart + 1;
                              }
                          },
                          { 
                                data: "nis", 
                                render: function ( val, type, row ){
                                    return val
                                  }
                          },
                          { 
                                data: "nama_pemilih", 
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
                                data: "jenis_kelamin", 
                                render: function ( val, type, row ){
                                    return val
                                  }
                          },
                          { 
                                data: "tanggal_lahir", 
                                render: function ( val, type, row ){
                                    return val
                                  }
                          },
                          { 
                                data: "alamat", 
                                render: function ( val, type, row ){
                                    return val
                                  }
                          },
                          { 
                                data: "agama", 
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
                                size : 'modal-lg',
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
 
