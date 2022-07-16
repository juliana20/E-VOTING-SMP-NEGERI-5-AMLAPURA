<ul class="nav nav-tabs">
  <li class="active"><a href="#BayarSPP" data-toggle="tab">Pembayaran SPP</a></li>
  <li><a href="#BayarGedung" data-toggle="tab">Pembayaran Uang Gedung</a></li>
</ul>
<div class="tab-content">
  <div class="tab-pane active" id="BayarSPP">
    <div class="box-body">
      <div class="col-md-3">
      <div class="form-group">
          <label for="tahun_ajaran_spp">Tahun Ajaran</label>
          <select name="tahun_ajaran_spp" class="form-control" required="" id="tahun_ajaran_spp">
            <?php foreach(@$option_tahun_ajaran as $dt): ?>
              <option value="<?php echo @$dt->tahun_ajaran ?>"><?php echo @$dt->tahun_ajaran ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
        <label for="bulan_spp">Bulan</label>
          <select name="bulan_spp" class="form-control" required="" id="bulan_spp">
            <option value="" disabled="" selected="" hidden="">-- Semua --</option>
            <?php foreach(@$bulan as $dt): ?>
              <option value="<?php echo @$dt['id'] ?>"><?php echo @$dt['desc'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
        <label for="id_kelas_spp">Kelas</label>
          <select name="id_kelas_spp" class="form-control" required="" id="id_kelas_spp">
            <option value="" disabled="" selected="" hidden="">-- Semua --</option>
            <?php foreach(@$option_kelas as $dt): ?>
              <option value="<?php echo @$dt->id ?>"><?php echo @$dt->tingkat_kelas ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
        <label for="status_bayar_spp">Status Bayar</label>
          <select name="status_bayar_spp" class="form-control" required="" id="status_bayar_spp">
              <option value="Sudah Bayar"><?php echo 'Sudah Bayar' ?></option>
              <option value="Belum Bayar"><?php echo 'Belum Bayar' ?></option>
          </select>
        </div>
      </div>
      <br><br>
      <hr>
      <table class="table table-striped table-bordered table-hover" id="dt_sudahBayarSPP" width="100%">   
          <thead>
            <tr>
              <th class="no-sort">No</th>
              <th>Nama Siswa</th>
              <th>Kelas</th>
              <th>Angkatan</th>
            </tr>
          </thead>
          <tbody>
          
        </tbody>
        </table>

        <script>
              let _datatables_dt_sudahBayarSPP = {
                dt_sudahBayarSPP:function(){
                  var _this = $("#dt_sudahBayarSPP");
                      _datatableSPP = _this.DataTable({				
                        ajax: {
                                url: "{{ url('datatables-pembayaran-spp') }}",
                                type: "POST",
                                data: function(params){
                                      params.tahun_ajaran = $('#tahun_ajaran_spp').val();
                                      params.bulan = $('#bulan_spp').val();
                                      params.id_kelas = $('#id_kelas_spp').val();
                                      params.status_bayar = $('#status_bayar_spp').val();
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
                                          data: "nama_siswa", 
                                          render: function ( val, type, row ){
                                              return val
                                            }
                                    },
                                    { 
                                          data: "tingkat_kelas", 
                                          render: function ( val, type, row ){
                                              return val
                                            }
                                    },
                                    { 
                                          data: "angkatan", 
                                          render: function ( val, type, row ){
                                              return val
                                            }
                                    },
                                ],
                                                            
                            });
                        
                            return _this;
                  }
                }
        </script>
    </div>
  </div>
  <!-- /.tab-pane -->
  <div class="tab-pane" id="BayarGedung">
    <div class="box-body">
      <div class="col-md-3">
      <div class="form-group">
          <label for="tahun_ajaran">Tahun Ajaran</label>
          <select name="tahun_ajaran_gedung" class="form-control" required="" id="tahun_ajaran_gedung">
            <?php foreach(@$option_tahun_ajaran as $dt): ?>
              <option value="<?php echo @$dt->tahun_ajaran ?>"><?php echo @$dt->tahun_ajaran ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
        <label for="bulan">Bulan</label>
          <select name="bulan_gedung" class="form-control" required="" id="bulan_gedung">
            <option value="" disabled="" selected="" hidden="">-- Semua --</option>
            <?php foreach(@$bulan as $dt): ?>
              <option value="<?php echo @$dt['id'] ?>"><?php echo @$dt['desc'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
        <label for="id_kelas_gedung">Kelas</label>
          <select name="id_kelas_gedung" class="form-control" required="" id="id_kelas_gedung">
            <option value="" disabled="" selected="" hidden="">-- Semua --</option>
            <?php foreach(@$option_kelas as $dt): ?>
              <option value="<?php echo @$dt->id ?>"><?php echo @$dt->tingkat_kelas ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
        <label for="status_bayar_gedung">Status Bayar</label>
          <select name="status_bayar_gedung" class="form-control" required="" id="status_bayar_gedung">
              <option value="Sudah Bayar"><?php echo 'Sudah Bayar' ?></option>
              <option value="Belum Bayar"><?php echo 'Belum Bayar' ?></option>
          </select>
        </div>
      </div>
      <br><br>
      <hr>
      <table class="table table-striped table-bordered table-hover" id="dt_sudahBayarGedung" width="100%">   
          <thead>
            <tr>
              <th class="no-sort">No</th>
              <th>Nama Siswa</th>
              <th>Kelas</th>
              <th>Angkatan</th>
            </tr>
          </thead>
          <tbody>
          
        </tbody>
        </table>

        <script>
              let _datatables_dt_sudahBayarGedung = {
                dt_sudahBayarGedung:function(){
                  var _this = $("#dt_sudahBayarGedung");
                      _datatableGedung = _this.DataTable({									
                        ajax: {
                                url: "{{ url('datatables-pembayaran-gedung') }}",
                                type: "POST",
                                data: function(params){
                                      params.tahun_ajaran = $('#tahun_ajaran_gedung').val();
                                      params.bulan = $('#bulan_gedung').val();
                                      params.id_kelas = $('#id_kelas_gedung').val();
                                      params.status_bayar = $('#status_bayar_gedung').val();
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
                                          data: "nama_siswa", 
                                          render: function ( val, type, row ){
                                              return val
                                            }
                                    },
                                    { 
                                          data: "tingkat_kelas", 
                                          render: function ( val, type, row ){
                                              return val
                                            }
                                    },
                                    { 
                                          data: "angkatan", 
                                          render: function ( val, type, row ){
                                              return val
                                            }
                                    },
                                ],
                                                            
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
    _datatables_dt_sudahBayarSPP.dt_sudahBayarSPP();
    _datatables_dt_sudahBayarGedung.dt_sudahBayarGedung();

    //SPP
    $('select[name="tahun_ajaran_spp"]').on('change', function(e){
        e.preventDefault();
        _datatableSPP.ajax.reload();
    });
    $('select[name="bulan_spp"]').on('change', function(e){
        e.preventDefault();
        _datatableSPP.ajax.reload();
    });
    $('select[name="id_kelas_spp"]').on('change', function(e){
        e.preventDefault();
        _datatableSPP.ajax.reload();
    });
    $('select[name="status_bayar_spp"]').on('change', function(e){
        e.preventDefault();
        _datatableSPP.ajax.reload();
    });

    //GEDUNG
    $('select[name="tahun_ajaran_gedung"]').on('change', function(e){
        e.preventDefault();
        _datatableGedung.ajax.reload();
    });
    $('select[name="bulan_gedung"]').on('change', function(e){
        e.preventDefault();
        _datatableGedung.ajax.reload();
    });
    $('select[name="id_kelas_gedung"]').on('change', function(e){
        e.preventDefault();
        _datatableGedung.ajax.reload();
    });
    $('select[name="status_bayar_gedung"]').on('change', function(e){
        e.preventDefault();
        _datatableGedung.ajax.reload();
    });
});
</script>