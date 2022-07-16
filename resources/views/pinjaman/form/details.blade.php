@extends('themes.AdminLTE.layouts.template')
@section('breadcrumb')  
  <h1>
    {{ @$title }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Master</a></li>
    <li><a href="{{ url(@$nameroutes) }}">{{ 'Pinjaman' }}</a></li>
    <li class="active">{{ @$title }}</li>
  </ol>
@endsection
@section('content')  
<div class="row">
  <div class="col-md-6">
    <div class="box">
      <!-- /.box-header -->
    <div class="box-body">
      <div class="col-md-12">
        <div class="form-group">
          <label for="exampleInputEmail1">No Pinjaman</label>
          : <label for="exampleInputEmail1">{{ @$item->id_pinjaman }}</label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label for="exampleInputEmail1">Jumlah Pinjaman</label>
          : <label for="exampleInputEmail1">{{ number_format(@$item->jumlah_pinjaman, 2) }}</label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label for="exampleInputEmail1">Total Bunga</label>
          : <label for="exampleInputEmail1">{{ number_format(@$item->nominal_bunga, 2) }}</label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label for="exampleInputEmail1">Sisa Pinjaman</label>
          : <label for="exampleInputEmail1">{{ number_format(@$item->sisa_pinjaman + @$item->sisa_bunga, 2) }}</label>
        </div>
      </div>
     
    </div>  
  </div>
  </div>
  <div class="col-md-6">
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
          <div class="col-md-12">
            <div class="form-group">
              <label for="exampleInputEmail1">No Rekening</label>
              : <label for="exampleInputEmail1">{{ @$item->no_rek_tabungan }}</label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="exampleInputEmail1">Nama Nasabah</label>
              : <label for="exampleInputEmail1">{{ @$item->nama_nasabah }}</label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="exampleInputEmail1">Jaminan</label>
              : <label for="exampleInputEmail1">{{ @$item->jaminan }}</label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="exampleInputEmail1">Status</label>
              : <label for="exampleInputEmail1">{{ (@$item->lunas == 1) ? 'Lunas' : 'Belum Lunas' }}</label>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>

<div class="box">
  <div class="box-body">
    <div class="col-lg-12">
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
});


</script>
@endsection