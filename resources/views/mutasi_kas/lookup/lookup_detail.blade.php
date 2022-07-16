<form  method="POST" action="" class="form-horizontal" name="form_crud">
	{{ csrf_field() }}
	<div class="form-group">
		<label class="col-lg-3 control-label">No Akun</label>
		<div class="col-lg-3">
			<input type="text" name="f[no_akun]" id="no_akun_lookup" class="form-control" placeholder="No Akun" required="" readonly>
		</div>
		<div class="col-lg-6">
		  <div class="input-group data_collect_wrapper">
			<input type="hidden" id="akun_id_lookup" name="f[akun_id]" required>
			<input type="text" name="f[nama_akun]" id="nama_akun_lookup" class="form-control" placeholder="Nama Akun" required="" readonly>
			<div class="input-group-btn">
			  <a href="javascript:;" id="lookup_akun_detail" class="btn btn-info btn-flat data_collect_btn"><i class="fa fa-search"></i> Cari</a>
			</div>
		  </div>
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-lg-3 control-label">Keterangan</label>
		<div class="col-lg-9">
			<textarea name="f[keterangan]" id="keterangan_detail" cols="30" rows="3" class="form-control" required>{{ @$item->keterangan }}</textarea>
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-lg-3 control-label">Nominal</label>
		<div class="col-lg-9">
		  <input type="text" class="form-control mask-number" name="f[nominal]" id="nominal" value="{{ @$item->nominal }}" placeholder="Nominal" required="">
		</div>
	  </div>
	<div class="form-group">
		<div class="col-lg-offset-3 col-lg-9">
		  <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Tutup</button>
		  <button id="btn_submit_detail" type="submit" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Simpan</button> 
		</div>
	</div>
  </form>
		
<script type="text/javascript">//<![CDATA[
	$("button#btn_submit_detail").on("click", function(e) {
        e.preventDefault();
        if( $("#keterangan").val() == null || $("#nominal").val() == null) {
            message = "Silahkan lengkapi data terlebih dahulu";
            $.alert_warning( message );
            return;
        }
        let akun_id = $("#akun_id_lookup").val();
        check = $("#dt_detail").DataTable().rows( function ( idx, data, node ) {
                    return data.akun_id === akun_id ?	true : false;
                } ).data();

        if ( check.any() )
        {	
            message = "Akun yang sama sudah ada pada list";
            $.alert_error( message );
            return;
        }
        try {                                        
            var collections = {
                    "nominal": mask_number.currency_remove($("#nominal").val()),
                    "keterangan" :$("#keterangan_detail").val(),
					"akun_id": $("#akun_id_lookup").val(),
					"nama_akun": $("#nama_akun_lookup").val(),
                };
   
            $("#dt_detail").DataTable().row.add( collections ).draw();
			ajax_modal.hide();
			$('body').removeClass('modal-open');
			$('.modal-backdrop').remove();
			$('body').removeAttr("style");
                
        } catch (e){console.log();}
    });

	$(document).ready(function() {
		$('.select2').select2({
		dropdownParent: $("#ajax-modal")
		});
		mask_number.init();

		$('#lookup_akun_detail').dataCollect({
        ajaxUrl: "{{ url('akun/lookup_collection') }}",
        ajaxMethod: 'GET',
			  ajaxData: function(params){
				  	var jenis_mutasi = "<?= $jenis_mutasi ?>";
				  		params.golongan = (jenis_mutasi == 'Penerimaan') ? "Pendapatan" : "Biaya";
			  },
        modalSize : 'modal-md',
        modalTitle : 'DAFTAR PILIHAN AKUN',
        modalTxtSelect : 'Pilih Akun',
        dtOrdering : true,
        dtOrder: [],
        dtThead:['No Akun','Nama Akun','Kelompok'],
        dtColumns: [
            {data: "id_akun"}, 
            {data: "nama_akun"}, 
            {data: "kelompok"}, 
        ],
        onSelected: function(data, _this){	
          $('#akun_id_lookup').val(data.id_akun);
          $('#nama_akun_lookup').val(data.nama_akun); 
		  $('#no_akun_lookup').val(data.id_akun); 
            
          return true;
        }
    });
	});
	//]]></script>
	