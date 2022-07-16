<div class="box-body">
  <div class="col-md-12">
      <div class="col-md-3">
        <div class="form-group">
        <label for="bulan_spp">Bulan</label>
          <select name="bulan_pengeluaran" class="form-control" required="" id="bulan_pengeluaran">
            <option value="" disabled="" selected="" hidden="">-- Semua --</option>
            <?php foreach(@$bulan as $dt): ?>
              <option value="<?php echo @$dt['id'] ?>"><?php echo @$dt['desc'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
  </div>
      <table class="table table-striped table-bordered table-hover" id="dt_pengeluaran" width="100%">   
          <thead>
            <tr>
              <th class="no-sort">No</th>
              <th>Tanggal</th>
              <th>Keterangan</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
          
        </tbody>
        <tfoot>
          <tr>
            <th colspan="3" align="right">Grandtotal</th>
            <th><span id="grandtotalPengeluaran">0</span></th>
          </tr>
        </tfoot>
        </table>

        <script>
          var _datatable_actions_pengeluaran = {
                calculate_sum: function(params, fn, scope){
                    var grandtotal = 0;
                    
                    var collection = $( "#dt_pengeluaran" ).DataTable().rows().data();
                    
                    collection.each(function(value, index){
                      
                      grandtotal += Number(mask_number.currency_remove( value.nominal  ));
                        
                    });
                    $('#grandtotalPengeluaran').text(mask_number.currency_add(grandtotal));
                    // $("input[name='f[total]']").val(mask_number.currency_add(grandtotal));	
                  },
            };
              let _datatables_dt_pengeluaran = {
                dt_pengeluaran:function(){
                  var _this = $("#dt_pengeluaran");
                      _datatablePengeluaran = _this.DataTable({				
                        ajax: {
                                url: "{{ url('datatables-pengeluaran-dashboard') }}",
                                type: "POST",
                                data: function(params){
                                      params.bulan = $('#bulan_pengeluaran').val();
                                    }
                        },
                        order: [1, 'desc'],					
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
                                                return val
                                              }
                                      },
                                      { 
                                            data: "keterangan", 
                                            render: function ( val, type, row ){
                                                return val
                                              }
                                      },
                                      { 
                                            data: "nominal", 
                                            render: function ( val, type, row ){
                                                return mask_number.currency_add(val)
                                              }
                                      },
                                ],
                                createdRow: function ( row, data, index ){		
                                  _datatable_actions_pengeluaran.calculate_sum();
                                    //Lainnya
                                    $('select[name="bulan_pengeluaran"]').on('change', function(e){
                                        e.preventDefault();
                                        _datatablePengeluaran.ajax.reload();
                                        _datatables_dt_pengeluaran.calculate_sum();
                                    });
                                }
                                                            
                            });
                        
                            return _this;
                  }
                }
        </script>
    </div>
  
<script>
  $(document).ready(function() {
    _datatables_dt_pengeluaran.dt_pengeluaran();

    $('select[name="bulan_spp"]').on('change', function(e){
        e.preventDefault();
        _datatableSPP.ajax.reload();
    });

});
</script>