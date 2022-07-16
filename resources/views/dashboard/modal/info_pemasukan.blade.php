<ul class="nav nav-tabs">
  <li class="active"><a href="#pemasukanSPP" data-toggle="tab">SPP</a></li>
  <li><a href="#pemasukanGedung" data-toggle="tab">Uang Gedung</a></li>
  <li><a href="#pemasukanLainnya" data-toggle="tab">Lainnya</a></li>
</ul>
<div class="tab-content">
  <div class="tab-pane active" id="pemasukanSPP">
    <div class="box-body">
      <div class="col-md-6">
      <div class="form-group">
          <label for="tahun_ajaran_pemasukan">Tahun Ajaran</label>
          <select name="tahun_ajaran_pemasukan_spp" class="form-control" required="" id="tahun_ajaran_pemasukan_spp">
            <?php foreach(@$option_tahun_ajaran as $dt): ?>
              <option value="<?php echo @$dt->tahun_ajaran ?>"><?php echo @$dt->tahun_ajaran ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
        <label for="bulan_pemasukan">Bulan</label>
          <select name="bulan_pemasukan_spp" class="form-control" required="" id="bulan_pemasukan_spp">
            <option value="" disabled="" selected="" hidden="">-- Semua --</option>
            <?php foreach(@$bulan as $dt): ?>
              <option value="<?php echo @$dt['id'] ?>"><?php echo @$dt['desc'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <hr>
      <table class="table table-striped table-bordered table-hover" id="dt_pemasukanSPP" width="100%">   
          <thead>
            <tr>
              <th class="no-sort">No</th>
              <th>Tanggal</th>
              <th>Nama Siswa</th>
              <th>Total</th>
            </tr>
          </thead>
         
          <tbody>
          
        </tbody>
        <tfoot>
          <tr>
            <th colspan="3" align="right">Grandtotal</th>
            <th><span id="grandtotalSPP">0</span></th>
          </tr>
        </tfoot>
        </table>

        <script>
            var _datatable_actions_spp = {
                calculate_sum: function(params, fn, scope){
                    var grandtotal = 0;
                    
                    var collection = $( "#dt_pemasukanSPP" ).DataTable().rows().data();
                    
                    collection.each(function(value, index){
                      
                      grandtotal += Number(mask_number.currency_remove( value.total ));
                        
                    });
                    $('#grandtotalSPP').text(mask_number.currency_add(grandtotal));
                    // $("input[name='f[total]']").val(mask_number.currency_add(grandtotal));	
                  },
            };

              let _datatables_dt_pemasukanSPP = {
                dt_pemasukanSPP:function(){
                  var _this = $("#dt_pemasukanSPP");
                      _datatableSPP = _this.DataTable({				
                        ajax: {
                                url: "{{ url('datatables-pemasukan-spp') }}",
                                type: "POST",
                                data: function(params){
                                      params.tahun_ajaran = $('#tahun_ajaran_pemasukan_spp').val();
                                      params.bulan = $('#bulan_pemasukan_spp').val();
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
                                          data: "nama_siswa", 
                                          render: function ( val, type, row ){
                                              return val
                                            }
                                    },
                                    { 
                                          data: "total", 
                                          render: function ( val, type, row ){
                                              return mask_number.currency_add(val)
                                            }
                                    },
                                ],
                                createdRow: function ( row, data, index ){		
                                    _datatable_actions_spp.calculate_sum();
                                    
                                    $('select[name="tahun_ajaran_pemasukan_spp"]').on('change', function(e){
                                        e.preventDefault();
                                        _datatableSPP.ajax.reload();
                                        _datatable_actions_spp.calculate_sum();
                                    });
                                    $('select[name="bulan_pemasukan_spp"]').on('change', function(e){
                                        e.preventDefault();
                                        _datatableSPP.ajax.reload();
                                        _datatable_actions_spp.calculate_sum();
                                    });
        
                                }
                                                            
                            });
                        
                            return _this;
                  }
                }
        </script>
    </div>
  </div>
  <!-- /.tab-pane -->
  <div class="tab-pane" id="pemasukanGedung">
    <div class="box-body">
      <div class="col-md-6">
      <div class="form-group">
          <label for="tahun_ajaran">Tahun Ajaran</label>
          <select name="tahun_ajaran_pemasukan_gedung" class="form-control" required="" id="tahun_ajaran_pemasukan_gedung">
            <?php foreach(@$option_tahun_ajaran as $dt): ?>
              <option value="<?php echo @$dt->tahun_ajaran ?>"><?php echo @$dt->tahun_ajaran ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
        <label for="bulan">Bulan</label>
          <select name="bulan_pemasukan_gedung" class="form-control" required="" id="bulan_pemasukan_gedung">
            <option value="" disabled="" selected="" hidden="">-- Semua --</option>
            <?php foreach(@$bulan as $dt): ?>
              <option value="<?php echo @$dt['id'] ?>"><?php echo @$dt['desc'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <table class="table table-striped table-bordered table-hover" id="dt_pemasukanGedung" width="100%">   
          <thead>
            <tr>
              <th class="no-sort">No</th>
              <th>Tanggal</th>
              <th>Nama Siswa</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
          
        </tbody>
        <tfoot>
          <tr>
            <th colspan="3" align="right">Grandtotal</th>
            <th><span id="grandtotalGedung">0</span></th>
          </tr>
        </tfoot>
        </table>

        <script>
             var _datatable_actions_gedung = {
                calculate_sum: function(params, fn, scope){
                    var grandtotal = 0;
                    
                    var collection = $( "#dt_pemasukanGedung" ).DataTable().rows().data();
                    
                    collection.each(function(value, index){
                      
                      grandtotal += Number(mask_number.currency_remove( value.total ));
                        
                    });
                    $('#grandtotalGedung').text(mask_number.currency_add(grandtotal));
                    // $("input[name='f[total]']").val(mask_number.currency_add(grandtotal));	
                  },
            };
              let _datatables_dt_pemasukanGedung = {
                dt_pemasukanGedung:function(){
                  var _this = $("#dt_pemasukanGedung");
                      _datatableGedung = _this.DataTable({									
                        ajax: {
                                url: "{{ url('datatables-pemasukan-gedung') }}",
                                type: "POST",
                                data: function(params){
                                      params.tahun_ajaran = $('#tahun_ajaran_pemasukan_gedung').val();
                                      params.bulan = $('#bulan_pemasukan_gedung').val();
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
                                          data: "nama_siswa", 
                                          render: function ( val, type, row ){
                                              return val
                                            }
                                    },
                                    { 
                                          data: "total", 
                                          render: function ( val, type, row ){
                                              return mask_number.currency_add(val)
                                            }
                                    },
                                ],
                                createdRow: function ( row, data, index ){		
                                    _datatable_actions_gedung.calculate_sum();
                                        //SPP
                                    $('select[name="tahun_ajaran_pemasukan_gedung"]').on('change', function(e){
                                        e.preventDefault();
                                        _datatableGedung.ajax.reload();
                                        _datatable_actions_gedung.calculate_sum();
                                    });
                                    $('select[name="bulan_pemasukan_gedung"]').on('change', function(e){
                                        e.preventDefault();
                                        _datatableGedung.ajax.reload();
                                        _datatable_actions_gedung.calculate_sum();
                                    });

                                }
                                                            
                            });
                        
                            return _this;
                  }
                }
        </script>
    </div>
  </div>
    <!-- /.tab-pane -->
    <div class="tab-pane" id="pemasukanLainnya">
      <div class="box-body">
        <div class="col-md-12">
          <div class="col-md-3">
          <div class="form-group">
          <label for="bulan_lainnya">Bulan</label>
            <select name="bulan_lainnya" class="form-control" required="" id="bulan_lainnya">
              <option value="" disabled="" selected="" hidden="">-- Semua --</option>
              <?php foreach(@$bulan as $dt): ?>
                <option value="<?php echo @$dt['id'] ?>"><?php echo @$dt['desc'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          </div>
        </div>
        <hr>
        <table class="table table-striped table-bordered table-hover" id="dt_pemasukanLainnya" width="100%">   
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
              <th><span id="grandtotalLainnya">0</span></th>
            </tr>
          </tfoot>
          </table>
  
          <script>
            var _datatable_actions_lainnya = {
                calculate_sum: function(params, fn, scope){
                    var grandtotal = 0;
                    
                    var collection = $( "#dt_pemasukanLainnya" ).DataTable().rows().data();
                    
                    collection.each(function(value, index){
                      
                      grandtotal += Number(mask_number.currency_remove( value.nominal  ));
                        
                    });
                    $('#grandtotalLainnya').text(mask_number.currency_add(grandtotal));
                    // $("input[name='f[total]']").val(mask_number.currency_add(grandtotal));	
                  },
            };
                let _datatables_dt_pemasukanLainnya = {
                  dt_pemasukanLainnya:function(){
                    var _this = $("#dt_pemasukanLainnya");
                    _datatableLainnya = _this.DataTable({									
                          ajax: {
                                  url: "{{ url('datatables-pemasukan-lainnya') }}",
                                  type: "POST",
                                  data: function(params){
                                        params.bulan = $('#bulan_lainnya').val();
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
                                    _datatable_actions_lainnya.calculate_sum();
                                    //Lainnya
                                    $('select[name="bulan_lainnya"]').on('change', function(e){
                                        e.preventDefault();
                                        _datatableLainnya.ajax.reload();
                                        _datatable_actions_lainnya.calculate_sum();
                                    });
                                }
                                                              
                              });
                          
                              return _this;
                    }
                  }
          </script>
      </div>
    </div>
</div>

<script>
  $(document).ready(function() {
    _datatables_dt_pemasukanSPP.dt_pemasukanSPP();
    _datatables_dt_pemasukanGedung.dt_pemasukanGedung();
    _datatables_dt_pemasukanLainnya.dt_pemasukanLainnya();
    
});
</script>