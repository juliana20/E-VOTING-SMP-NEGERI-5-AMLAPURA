@extends('themes.AdminLTE.layouts.template')
@section('breadcrumb')  
  <h1>
    {{ @$title }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Master</a></li>
    <li><a href="{{ url(@$nameroutes) }}">Kelas</a></li>
    <li class="active">{{ @$title }}</li>
  </ol>
@endsection
@section('content')  
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{ @$header }}</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
        <table class="table table-hover" id="daftar_siswa" width="100%">   
            <thead>
              <tr>
                <th class="no-sort">No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
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
        var _this = $("#daftar_siswa");
            _datatable = _this.DataTable({			
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
                          }
                      ],
                                                  
                  });
							
                  return _this;
				}
			}

$(document).ready(function() {
    _datatables_show.dt__datatables_show();
});
</script>
@endsection
 
