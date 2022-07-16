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
      <!-- /.box-header -->
        <!-- Date and time range -->
        <div class="form-group">
          <div class="col-lg-6">
              <div class="input-group">
                <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                  <i class="fa fa-calendar"></i> Periode
                  <i class="fa fa-caret-down"></i>
                  <input type="text" id="date_start" readonly> s/d
                  <input type="text" id="date_end" readonly>
                </button>
              </div>
            </div>
          </div>
          <div class="form-group  pull-right">
            <div class="col-lg-12">
              <input type="radio" id="sudah" name="status_proses" value="1">
              <label for="sudah">Sudah Proses</label>
              <input type="radio" id="belum" name="status_proses" value="0" checked>
              <label for="belum">Belum Proses</label>
            </div>
        </div>
      </div><hr>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-striped table-bordered table-hover" id="dt_setoran" width="100%">   
            <thead>
              <tr>
                <th class="no-sort">No</th>
                <th>Tanggal</th>
                <th>No Rekeking</th>
                <th>Nama Nasabah</th>
                <th>Pokok</th>
                <th>Bunga</th>
                <th>Total</th>
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
        var _this = $("#dt_setoran");
            _datatable = _this.DataTable({									
              ajax: {
								url: "{{ url('pinjaman/datatables-angsuran') }}",
								type: "POST",
								data: function(params){
                        params.proses = $('input[name="status_proses"]:checked').val();
                        params.date_start = $("#date_start").val();
							          params.date_end = $("#date_end").val();
										}
								},
              order:[ 2, 'desc'],
              columns: [
                          {
                              data: "id",
                              className: "text-center",
                              render: function (data, type, row, meta) {
                                  return meta.row + meta.settings._iDisplayStart + 1;
                              }
                          },
                          { 
                                data: "tanggal", 
                                render: function ( val, type, row ){
                                  return moment(val).format("DD MMMM Y");  
                                  }
                          },
                          { 
                                data: "no_rek_tabungan", 
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
                                    if(row.proses == 1)
                                    {
                                      buttons += '<a href=\"{{ url('pinjaman/proses') }}/'+ val +'\" title=\"Lihat\" class=\"btn btn-info btn-xs\"><i class=\"fa fa-eye\"></i> Lihat</a>';
                                    }else{
                                      buttons += '<a href=\"{{ url('pinjaman/proses') }}/'+ val +'\" title=\"Proses\" class=\"btn btn-success btn-xs\"><i class=\"fa fa-handshake-o\"></i> Proses</a>';
                                    }
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
    $('input[name="status_proses"]').on('change', function(e){
        e.preventDefault();
        _datatable.ajax.reload();
    });
        //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn #date_start').val(start.format('D MMMM YYYY'))
        $('#daterange-btn #date_end').val(end.format('D MMMM YYYY'))
        _datatable.ajax.reload();
      }
    )
});
</script>
@endsection
 
