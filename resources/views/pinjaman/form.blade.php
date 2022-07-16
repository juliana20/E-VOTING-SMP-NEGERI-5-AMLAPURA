<form  method="POST" action="{{ url($submit_url) }}" class="form-horizontal" name="form_crud">
  {{ csrf_field() }}
  <div class="form-group">
    <label class="col-lg-3 control-label">No Pinjaman</label>
    <div class="col-lg-9">
      <input type="text" class="form-control" name="f[id_pinjaman]" id="id_pinjaman" value="{{ @$item->id_pinjaman }}" required="" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Tanggal</label>
    <div class="col-lg-9">
      <input type="date" class="form-control" name="f[tgl_realisasi]" id="tgl_realisasi" value="{{ @$item->tgl_realisasi }}" required="" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Nasabah</label>
    <div class="col-lg-9">
      <div class="input-group data_collect_wrapper">
        <input type="hidden" id="id_nasabah" name="id[id_nasabah]" required>
        <input type="text" name="f[nama_nasabah]" id="nama_nasabah" class="form-control" placeholder="Nasabah" required="" readonly>
        <div class="input-group-btn">
          <a href="javascript:;" id="lookup_nasabah" class="btn btn-info btn-flat data_collect_btn"><i class="fa fa-search"></i> Cari</a>
        </div>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Rekening Tabungan</label>
    <div class="col-lg-9">
      <input type="text" class="form-control" name="f[no_rek_tabungan]" id="no_rek_tabungan" value="{{ @$item->no_rek_tabungan }}" placeholder="Rekening Tabungan" required="" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Saldo Tabungan Saat ini</label>
    <div class="col-lg-9">
      <div class="input-group">
        <div class="input-group-btn">
          <span class="btn btn-default btn-flat">Rp</span>
        </div>
        <input type="text" class="form-control mask-number" name="f[saldo_tabungan]" id="saldo_tabungan" value="{{ @$item->saldo_tabungan }}" placeholder="Saldo Tabungan Terakhir" autocomplete="off" readonly>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Jaminan</label>
    <div class="col-lg-9">
      <input type="text" class="form-control" name="f[jaminan]" id="jaminan" value="{{ @$item->jaminan }}" placeholder="Jaminan" required="">
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Harga Pasaran Jaminan</label>
    <div class="col-lg-9">
      <input type="text" class="form-control mask-number class_jaminan" name="f[harga_pasar_jaminan]" id="harga_pasar_jaminan" value="{{ @$item->harga_pasar_jaminan }}" placeholder="Harga Pasar Jaminan" required="">
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Maksimal Pinjaman</label>
    <div class="col-lg-9">
      <input type="text" class="form-control mask-number class_jaminan" name="f[maksimal_pinjaman]" id="maksimal_pinjaman" value="{{ @$item->maksimal_pinjaman }}" placeholder="Maksimal Pinjaman" required="" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Jumlah Pinjaman</label>
    <div class="col-lg-3">
      <div class="input-group">
        <div class="input-group-btn">
          <span class="btn btn-default btn-flat">Rp</span>
        </div>
        <input type="text" class="form-control mask-number calculate" name="f[jumlah_pinjaman]" id="jumlah_pinjaman" value="{{ @$item->jumlah_pinjaman }}" placeholder="Jumlah Pinjaman" autocomplete="off">
      </div>
    </div>
    <label class="col-lg-3 control-label">Bunga</label>
    <div class="col-lg-3">
          <select name="f[bunga_pinjaman]" class="form-control" required="" id="bunga_pinjaman">
            @php $bunga = [
                ['id' => '0.007','menetap' => '1','desc' => '0.7% Tetap'],
                ['id' => '0.009','menetap' => '1','desc' => '0.9% Tetap'],
                ['id' => '0.01','menetap' => '1','desc' => '1% Tetap'],
                ['id' => '0.0138','menetap' => '0','desc' => '1.38% Menurun'],
                ['id' => '0.014','menetap' => '0','desc' => '1.4% Menurun'],
                ['id' => '0.015','menetap' => '0','desc' => '1.5% Menurun'],
                ['id' => '0.0175','menetap' => '0','desc' => '1.75% Menurun'],

              ];
            @endphp
            <?php foreach(@$bunga as $dt): ?>
              <option data-status="<?php echo @$dt['menetap'] ?>" value="<?php echo @$dt['id'] ?>" <?= @$dt['id'] == @$item->bunga_pinjaman ? 'selected': null ?>><?php echo @$dt['desc'] ?></option>
            <?php endforeach; ?>
          </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Jangka Waktu</label>
    <div class="col-lg-3">
      <select name="f[jangka_waktu]" class="form-control" required="" id="jangka_waktu">
        @php $bunga = [
            ['id' => '12','desc' => '12 Bulan'],
            ['id' => '24','desc' => '24 Bulan'],
            ['id' => '36','desc' => '36 Bulan'],
            ['id' => '48','desc' => '48 Bulan'],
            ['id' => '60','desc' => '60 Bulan'],
            ['id' => '72','desc' => '72 Bulan'],
            ['id' => '120','desc' => '120 Bulan'],
          ];
        @endphp
         <option value="">-- Pilih --</option>
        <?php foreach(@$bunga as $dt): ?>
          <option value="<?php echo @$dt['id'] ?>" <?= @$dt['id'] == @$item->jangka_waktu ? 'selected': null ?>><?php echo @$dt['desc'] ?></option>
        <?php endforeach; ?>
      </select>
{{-- 
      <div class="input-group">
        <input type="number" class="form-control" name="f[jangka_waktu]" id="jangka_waktu" value="{{ @$item->jangka_waktu }}" placeholder="Jangka Waktu" autocomplete="off">
        <div class="input-group-btn">
          <span class="btn btn-default btn-flat">Bulan</span>
        </div>
      
      </div> --}}
    </div>
    {{-- <label class="col-lg-3 control-label">Propisi</label>
    <div class="col-lg-3">
      <div class="input-group">
        <div class="input-group-btn">
          <span class="btn btn-default btn-flat">Rp</span>
        </div>
        <input type="text" class="form-control mask-number calculate" name="f[propisi]" id="propisi" value="{{ @$item->propisi }}" placeholder="Propisi" autocomplete="off">
      </div>
    </div> --}}
    <label class="col-lg-3 control-label">Biaya Materai / Map</label>
    <div class="col-lg-3">
      <div class="input-group">
        <div class="input-group-btn">
          <span class="btn btn-default btn-flat">Rp</span>
        </div>
        <input type="text" class="form-control mask-number calculate" name="f[biaya_materai]" id="biaya_materai" value="{{ @$item->biaya_materai }}" placeholder="Biaya Materai" autocomplete="off">
      </div>
    </div>
  </div>
  <div class="form-group">
    {{-- <label class="col-lg-3 control-label">Biaya Lainnya</label>
    <div class="col-lg-3">
      <div class="input-group">
        <div class="input-group-btn">
          <span class="btn btn-default btn-flat">Rp</span>
        </div>
        <input type="text" class="form-control mask-number calculate" name="f[biaya_lainnya]" id="biaya_lainnya" value="{{ @$item->biaya_lainnya }}" placeholder="Biaya Lainnya" autocomplete="off">
      </div>
    </div> --}}
    <label class="col-lg-3 control-label">Biaya Asuransi</label>
    <div class="col-lg-3">
      <div class="input-group">
        <div class="input-group-btn">
          <span class="btn btn-default btn-flat">Rp</span>
        </div>
        <input type="text" class="form-control mask-number calculate" name="f[biaya_asuransi]" id="biaya_asuransi" value="{{ @$item->biaya_asuransi }}" placeholder="Biaya Asuransi" autocomplete="off">
      </div>
    </div>
    <label class="col-lg-3 control-label">Biaya Admin</label>
    <div class="col-lg-3">
      <div class="input-group">
        <div class="input-group-btn">
          <span class="btn btn-default btn-flat">Rp</span>
        </div>
        <input type="text" class="form-control mask-number calculate" name="f[biaya_admin]" id="biaya_admin" value="{{ @$item->biaya_admin }}" placeholder="Biaya Admin" autocomplete="off">
      </div>
    </div>

  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Jumlah Diterima</label>
    <div class="col-lg-3">
      <div class="input-group">
        <div class="input-group-btn">
          <span class="btn btn-default btn-flat">Rp</span>
        </div>
        <input type="text" class="form-control mask-number" name="f[jumlah_diterima]" id="jumlah_diterima" value="{{ @$item->jumlah_diterima }}" placeholder="Jumlah Diterima" autocomplete="off" readonly>
      </div>
    </div>
    <label class="col-lg-3 control-label">Jatuh Tempo</label>
    <div class="col-lg-3">
      <input type="date" name="f[jatuh_tempo]" id="jatuh_tempo" class="form-control" placeholder="Jatuh Tempo" value="{{ @$item->jatuh_tempo }}" readonly>
    </div>

  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Akun Kas</label>
    <div class="col-lg-3">
          <select name="f[id_akun]" class="form-control" required="" id="id_akun">
            <?php foreach(@$option_akun as $dt): ?>
              <option value="<?php echo @$dt->id_akun ?>" <?= @$dt->id_akun == @$item->id_akun ? 'selected': null ?>><?php echo @$dt->nama_akun ?></option>
            <?php endforeach; ?>
          </select>
    </div>
    <label class="col-lg-3 control-label">Angsuran</label>
    <div class="col-lg-3">
      <div class="input-group">
        <div class="input-group-btn">
          <span class="btn btn-default btn-flat">Rp</span>
        </div>
        <input type="text" class="form-control mask-number" name="f[angsuran]" id="angsuran" value="{{ @$item->angsuran }}" placeholder="Angsuran" autocomplete="off" readonly>
      </div>
    </div>


  </div>
  <div class="form-group">
  <label class="col-lg-3 control-label">Nominal Bunga</label>
  <div class="col-lg-3">
    <div class="input-group">
      <div class="input-group-btn">
        <span class="btn btn-default btn-flat">Rp</span>
      </div>
      <input type="text" class="form-control mask-number" name="f[nominal_bunga]" id="nominal_bunga" value="{{ @$item->nominal_bunga }}" placeholder="nominal_bunga" autocomplete="off" readonly>
    </div>
  </div>
  </div>
  <div class="form-group">
      <label class="col-lg-3 control-label">&nbsp;</label>
      <div class="col-lg-3">
        <button type="button" class="btn btn-danger btn-block" data-dismiss="modal"><i class="fa fa-window-close" aria-hidden="true"></i> Tutup</button>
      </div>
      <div class="col-lg-3">
        <button type="button" id="simulasi" class="btn btn-info btn-block"><i class="fa fa-refresh" aria-hidden="true"></i> Simulasi Pinjaman</button>
      </div>
      <div class="col-lg-3">
        <button id="submit_form" type="submit" class="btn btn-success btn-block btn-save"><i class="fa fa-floppy-o" aria-hidden="true"></i> @if($is_edit)  Perbarui @else Simpan @endif <i class="fas fa-spinner fa-spin spinner" style="display: none"></i></button> 
      </div>
    </div>
</form>
      

<script type="text/javascript">
$('#simulasi').on( "click", function(e){
  e.preventDefault();

  if(jangka_waktu == '' || jumlah_pinjaman == '')
  {
    alert('Silahkan lengkapi data pinjaman!')
    return false
  }
  var jumlah_pinjaman = mask_number.currency_remove($('#jumlah_pinjaman').val());
      biaya_materai = mask_number.currency_remove($('#biaya_materai').val());
      biaya_asuransi = mask_number.currency_remove($('#biaya_asuransi').val());
      jangka_waktu = mask_number.currency_remove($('#jangka_waktu').val());
      bunga_pinjaman =  $("#bunga_pinjaman").val();
      tgl_realisasi = $("#tgl_realisasi").val();
      jatuh_tempo = $("#jatuh_tempo").val();
      menetap = $("#bunga_pinjaman").find(':selected').attr('data-status');
      nominal_bunga = mask_number.currency_remove($("#nominal_bunga").val());


  var _prop= {
    _this : $( this ),
    remote : "{{ url("$nameroutes") }}/simulasi/" 
                              + jumlah_pinjaman 
                              + '/' 
                              + biaya_materai 
                              + '/' 
                              + biaya_asuransi 
                              + '/' 
                              + jangka_waktu
                              + '/' 
                              + bunga_pinjaman
                              + '/' 
                              + tgl_realisasi
                              + '/' 
                              + jatuh_tempo
                              + '/' 
                              + menetap
                              + '/' 
                              + nominal_bunga
                              + '/' 
                              + biaya_admin ,
    size : 'modal-lg',
    title : "Simulasi Pinjaman",
  }
  lookup_ajax_modal.show(_prop);											
});  

$(document).on("keyup",'.calculate', calculate);
$(document).on("change",'#bunga_pinjaman', calculate);
$(document).on("keyup",'.class_jaminan', calculate_jaminan);
$(document).on("keyup",'#jumlah_pinjaman', cek_max);
$(document).on("change",'#jangka_waktu', calculate);

function calculate() 
{
    var jumlah_pinjaman = mask_number.currency_remove($('#jumlah_pinjaman').val());
        biaya_materai = mask_number.currency_remove($("#biaya_materai").val());
        biaya_asuransi = mask_number.currency_remove($("#biaya_asuransi").val());

        $("#biaya_admin").val(mask_number.currency_add((jumlah_pinjaman * 3) / 100));
        biaya_admin = mask_number.currency_remove($("#biaya_admin").val());
        bunga_pinjaman = $("#bunga_pinjaman").val();
        jangka_waktu = $("#jangka_waktu").val();

        jumlah_diterima = jumlah_pinjaman - (biaya_materai + biaya_admin + biaya_asuransi);
        angsuran = (jumlah_pinjaman / jangka_waktu);
        nominal_bunga = jumlah_pinjaman * bunga_pinjaman;

        $("#jumlah_diterima").val(mask_number.currency_add(jumlah_diterima));
        $("#angsuran").val(mask_number.currency_add(angsuran));
        $("#nominal_bunga").val(mask_number.currency_add(nominal_bunga));

        

}


function cek_max() 
{
    var jumlah_pinjaman = mask_number.currency_remove($('#jumlah_pinjaman').val());
        maksimal_pinjaman = mask_number.currency_remove($("#maksimal_pinjaman").val());
        if(jumlah_pinjaman > maksimal_pinjaman)
        {
          alert('Jumlah Pinjaman lebih besar dari batas maksimal!')
          $('#jumlah_pinjaman').val('0')
          return false
        }
        

}


function calculate_jaminan() 
{
    var harga_pasar_jaminan = mask_number.currency_remove($('#harga_pasar_jaminan').val());
        maksimal_pinjaman = (harga_pasar_jaminan * 60) /100
        $("#maksimal_pinjaman").val(mask_number.currency_add(maksimal_pinjaman));
}

function get_saldo_tabungan() {
    var id_nasabah = $("#id_nasabah").val();
    $.get("<?= url('pinjaman/get_saldo') ?>/"+id_nasabah, function(response, status, xhr) {
          $("#saldo_tabungan").val(mask_number.currency_add(response.saldo));
    })
        
}

  $(document).ready(function(){

    $("#jangka_waktu").on('change', function(e){
			var _date_end = moment($("#tanggal_awal").val()).add(Number($("#jangka_waktu").val() * 365 / 12), 'days').format("YYYY-MM-DD");
			$('#jatuh_tempo').val(_date_end);
      calculate()
		});

    mask_number.init()
    
    $('#lookup_nasabah').dataCollect({
        ajaxUrl: "{{ url('pinjaman/nasabah') }}",
        modalSize : 'modal-lg',
        modalTitle : 'DAFTAR PILIHAN NASABAH',
        modalTxtSelect : 'Pilih Nasabah',
        dtOrdering : true,
        dtOrder: [],
        dtThead:['ID Nasabah','Nama Nasabah','Alamat','Rekening Tabungan'],
        dtColumns: [
            {data: "id_nasabah"}, 
            {data: "nama_nasabah"}, 
            {data: "alamat_nasabah"}, 
            {data: "no_rek_tabungan"}, 
        ],
        onSelected: function(data, _this){	
          $('#id_nasabah').val(data.id_nasabah);
          $('#nama_nasabah').val(data.nama_nasabah); 
          $('#no_rek_tabungan').val(data.no_rek_tabungan); 
          get_saldo_tabungan()
            
          return true;
        }
    });
  })
  $('form[name="form_crud"]').on('submit',function(e) {
    e.preventDefault();

    if($("#id_nasabah").val() == '' || mask_number.currency_remove($("#jumlah_pinjaman").val()) <= 0 || $("#jangka_waktu").val() == '' )
    {
      alert('Silahkan lengkapi data pinjaman!');
      return false
    }

    $('.btn-save').addClass('disabled', true);
    $(".spinner").css("display", "");
    var post_data = {
          'id_nasabah' : $("#id_nasabah").val(),
          'no_rek_tabungan' : $("#no_rek_tabungan").val(),
          'jaminan' : $("#jaminan").val(),
          'jumlah_pinjaman' : mask_number.currency_remove($("#jumlah_pinjaman").val()),
          'biaya_materai' : mask_number.currency_remove($("#biaya_materai").val()),
          'biaya_admin' : mask_number.currency_remove($("#biaya_admin").val()) || 0,
          'biaya_asuransi' : mask_number.currency_remove($("#biaya_asuransi").val()),
          'saldo_tabungan' : mask_number.currency_remove($("#saldo_tabungan").val()),
          'jumlah_diterima' : mask_number.currency_remove($("#jumlah_diterima").val()),
          'jangka_waktu' : $("#jangka_waktu").val(),
          'jatuh_tempo' : $("#jatuh_tempo").val(),
          'jumlah_diterima' : mask_number.currency_remove($("#jumlah_diterima").val()),
          'angsuran' : mask_number.currency_remove($("#angsuran").val()),
          'id_akun' : $("#id_akun").val(),
          'bunga_pinjaman' : $("#bunga_pinjaman").val(),
          'menetap' : $("#bunga_pinjaman").find(':selected').attr('data-status'),
          'nominal_bunga' : mask_number.currency_remove($("#nominal_bunga").val()),
        }


     data_post = {
          "f" : post_data,
        }

    // var data_post = new FormData($(this)[0]);
    $.post($(this).attr("action"), data_post, function(response, status, xhr) {
      if( response.status == "error"){
          $.alert_warning(response.message);
              $('.btn-save').removeClass('disabled', true);
              $(".spinner").css("display", "none");
              return false
          }
          $.alert_success(response.message);
              $('.btn-save').removeClass('disabled');
              $(".spinner").css("display", "none");
              ajax_modal.hide();
              setTimeout(function(){
                // location.reload();
                document.location.href = "{{ url("$nameroutes") }}";        
              }, 500);  
      }).catch(error => {
            $.alert_error(error);
                $('.btn-save').removeClass('disabled', true);
                $(".spinner").css("display", "none");
                return false
      });
});
</script>