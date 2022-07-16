@extends('themes.AdminLTE.layouts.template')
@section('breadcrumb')  
  <h1>
    {{ @$title }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Master</a></li>
    <li class="active">{{ @$header }}</li>
  </ol>
@endsection
@section('content')  
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">{{ @$header }}</h3>
        <div class="box-tools pull-right">
            <div class="btn-group">
              <a href="{{ url('transaksi-pembayaran-online/create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{ __('global.label_create') }}</a>
            </div>
          </button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-striped table-bordered table-hover" id="{{ $idDatatables }}" width="100%">   
            <thead>
              <tr>
                <th class="no-sort">No</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal Transaksi</th>
                <th>Jenis Transaksi</th>
                <th>Total Bayar</th>
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
                                data: "nama_pelanggan", 
                                render: function ( val, type, row ){
                                    return val
                                  }
                          },
                          { 
                                data: "tanggal", 
                                render: function ( val, type, row ){
                                    return moment(val).format('DD/MM/Y')
                                  }
                          },
                          { 
                                data: "jenis_transaksi", 
                                render: function ( val, type, row ){
                                    return val
                                  }
                          },
                          { 
                                data: "total_bayar", 
                                render: function ( val, type, row ){
                                    return (val == 0 || !val) ? 'Rp ' +0 : 'Rp ' + mask_number.currency_add(val)
                                  }
                          },
                          { 
                                data: "id",
                                className: "text-center",
                                render: function ( val, type, row ){
                                    var buttons = '<div class="btn-group" role="group">';
                                      buttons += '<a href=\"{{ url('transaksi-pembayaran-online/show') }}/'+ val +'\" title=\"Lihat Data\" class=\"btn btn-warning btn-xs\"><i class=\"fa fa-eye\"></i> Lihat</a>';
                                      buttons += '<a href=\"{{ url('transaksi-pembayaran-online/edit') }}/'+ val +'\" title=\"Ubah Data\" class=\"btn btn-info btn-xs\"><i class=\"glyphicon glyphicon-pencil\"></i> Ubah</a>';
                                      buttons += "</div>";
                                    return buttons
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
 
