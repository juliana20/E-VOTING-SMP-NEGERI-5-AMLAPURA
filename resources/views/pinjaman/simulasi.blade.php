<form action="" class="form-horizontal" style="z-index: 9999!important">
  {{ csrf_field() }}
  <div class="col-lg-6">
    <div class="form-group">
      <label class="col-lg-6 control-label">Angsuran Cicilan Per Bulan</label>
      <div class="col-lg-6">
        : <label class="control-label">Rp. {{ number_format(@$item->angsuran, 2) }}</label>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-6 control-label">Jumlah Pinjaman</label>
      <div class="col-lg-6">
        : <label class="control-label">Rp. {{ number_format( @$item->jumlah_pinjaman, 2 ) }}</label>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-6 control-label">Jangka Waktu</label>
      <div class="col-lg-6">
        : <label class="control-label">{{ @$item->jangka_waktu }} Bulan</label>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-6 control-label">Bunga</label>
      <div class="col-lg-6">
        : <label class="control-label">{{ @$item->bunga_pinjaman * 100 }} %  {{ ($item->menetap == 1) ? 'Tetap' : 'Menurun' }}</label>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="form-group">
      <label class="col-lg-6 control-label">Biaya Materai / Map</label>
      <div class="col-lg-6">
        : <label class="control-label">Rp. {{ number_format(@$item->biaya_materai,2) }}</label>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-6 control-label">Biaya Asuransi</label>
      <div class="col-lg-6">
        : <label class="control-label">Rp. {{ number_format(@$item->biaya_asuransi,2) }}</label>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-6 control-label">Biaya Admin</label>
      <div class="col-lg-6">
        : <label class="control-label">Rp. {{ number_format(@$item->biaya_admin,2) }}</label>
      </div>
    </div>
  </div>
  <br>
  <hr>
  <div class="box-body">
    <div class="col-lg-12">
      <table class="table table-striped table-hover" id="dt_pinjaman" width="100%">   
        <thead>
          <tr>
            <th>Periode</th>
            <th>Angsuran Bunga</th>
            <th>Angsuran Pokok</th>
            <th>Total Angsuran</th>
            <th>Sisa Pinjaman</th>
          </tr>
        </thead>
        <tbody>
          @foreach($collections as $row)
            <tr>
              <td>{{ $row['periode'] }}</td>
              <td>{{ number_format($row['angsuran_bunga'],2) }}</td>
              <td>{{ number_format($row['angsuran_pokok'],2) }}</td>
              <td>{{ number_format($row['total_angsuran'],2) }}</td>
              <td>{{ number_format($row['sisa_pinjaman'],2) }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div class="form-group">
      <div class="col-lg-12">
        <button type="button" class="btn btn-warning btn-block" data-dismiss="modal">Tutup</button>
      </div>
  </div>
</form>
      

<script type="text/javascript">
  $(document).ready(function(){
    
  })
</script>