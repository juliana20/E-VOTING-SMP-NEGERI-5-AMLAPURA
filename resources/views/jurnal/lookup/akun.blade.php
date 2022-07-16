<script type="text/javascript">//<![CDATA[
	function lookupbox_row_selected( response ){
			var _response = JSON.parse(response);

			if( _response ){
					// cek apakah item sudah dipilih
					check = $("#dt_detail").DataTable().rows( function ( idx, data, node ) {
							return data.id_akun === _response.id_akun ?	true : false;
					}).data();
					
					if ( check.any() )
					{	
						message = "Akun yang sama sudah ada!";
						$.alert_error( message.replace(/%s/g, _response.nama_akun) );
						return;
					}
				try{
					var data_detail = {
						'id_akun' : _response.id_akun,
						'nama_akun' : _response.nama_akun,
						'debet'	: 0,
						'kredit' : 0,
						'keterangan' : ''
					}

					$("#dt_detail").DataTable().row.add( data_detail ).draw(true);
					
					ajax_modal.hide();
					$('body').removeClass('modal-open');
					$('.modal-backdrop').remove();
					$('body').removeAttr("style");
				} catch(e){console.log(e)}
			}
	}
	//]]></script>
<table class="table table-striped table-bordered table-hover" id="dt_akun" width="100%">   
	<thead>
	  <tr>
		<th class="no-sort"></th>
		<th>No Akun</th>
		<th>Nama Akun</th>
		<th>Kelompok</th>
	  </tr>
	</thead>
	<tbody>
	
  </tbody>
  </table>
		
<script type="text/javascript">//<![CDATA[
(function( $ ){
		$.fn.extend({
				dt_akun: function(){
						var _this = this;
						
						if( $.fn.DataTable.isDataTable( _this.attr("id") ) ){
							return _this
						}
						
						var _datatable = _this.DataTable( {
							lengthMenu: [ 15, 30, 60 ],
							processing: true,
							serverSide: false,								
							paginate: true,
							ordering: true,
							order: [[1, 'asc']],
							searching: true,
							info: true,
							responsive: true,
							//scrollCollapse: true,
							//scrollY: "200px",
							ajax: {
									url: "{{ url('akun/datatables') }}",
									type: "POST",
									data: function( params ){
			
									}
								},
							columns: [
									{ 
										data: "id_akun",
										className: "text-center actions",
										orderable: false,
										searchable: false,
										width: "70px",
										render: function ( val, type, row ){
												var json = JSON.stringify( row ).replace( /"/g, '\\"' );
												return "<a href='javascript:try{lookupbox_row_selected(\"" + json + "\")}catch(e){}' title=\"Pilih\" class=\"label label-primary\"><i class=\"fa fa-check\"></i> <span>Pilih</span></a>" 
											}
									},
									{ 
										data: "id_akun",     
										width: "100px",
										orderable: true,
										render: function ( val, type, row ){
												return val
											}
									},
									{ 
										data: "nama_akun", 
									},
									{ 
										data: "kelompok",
									},									
																	
								]
						} );
					
					return _this
				}
			});
		
		var _datatable = $( "#dt_akun" ).dt_akun();

		
	})( jQuery );
//]]></script>

	