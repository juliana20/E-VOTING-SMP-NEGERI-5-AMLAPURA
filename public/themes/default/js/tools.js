"use strict";

var ajax_modal = {
		init: function(){
				$( document ).on('click', '[data-toggle="ajax-modal"]', function(e) {
						e.preventDefault();
						
						var _prop = {
								_this : $( this ),
								remote : $( this ).data('action-url') || $( this ).attr('href'),
								size : $( this ).data('modal-size') || 'modal-md',
								title : $( this ).data('title') || 'Modal',
							}
							
						ajax_modal.show( _prop )
					});
					
				//$( '#ajax-modal' ).on("hide.bs.modal", function(e){ $( window ).trigger( "resize" ); });
			},
		show: function( _prop, fn, scope ){
				$( '#ajax-modal' ).find('#modal-btn-close').trigger('click');
				$( '#ajax-modal' ).remove();
				$("body").removeClass("modal-open");
				$('.modal-backdrop').remove();
				$('body').removeAttr("style");
				
				var _modal = $("<div class=\"modal\" \
						id=\"ajax-modal\" \
						role=\"dialog\" \
						tabindex=\"-1\" \
						aria-hidden=\"true\">\
							<div class=\"modal-dialog "+ _prop.size +"\" \
								role=\"document\">\
								<div class=\"modal-content\">\
									<div class=\"modal-header\">\
										<button id=\"modal-btn-close\" type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\"><i class=\"fa fa-times-circle-o\" aria-hidden=\"true\" style=\"color: red\" title=\"Tutup\"></i></span></button>\
										<h4 align=\"center\" class=\"modal-title\" id=\"ajaxModalTitle\" data-title=\"close\"><strong>"+ _prop.title +"</strong></h4>\
									</div>\
									<div class=\"modal-body\">\
										<center class=\"text-primary\">\
											<i class=\"fa fa-lg fa-circle-o-notch fa-spin\"></i> Loading...\
										</center>\
									</div>\
								</div>\
							</div>\
						</div>");
				
				$( "body" ).append( _modal );
				_modal.modal({backdrop: true, keyboard: true});
				_modal.find('.modal-body').load( _prop.remote );
				
				if( $.isFunction(fn) ){
					fn.call( scope || ajax_modal );
					return (scope || ajax_modal)
				}
				
				return ajax_modal
			},
		hide: function( fn, scope ){
				$( '#ajax-modal' )
					.find('div[class="modal-header"]')
					.find('button[class="close"]')
					.trigger('click');
				
				if( $.isFunction(fn) ){
					fn.call( scope || ajax_modal );
					return (scope || ajax_modal)
				}
				
				return ajax_modal
			}
	};


var lookup_ajax_modal = {
		init: function(){
				$( document ).on('click', '[data-toggle="lookup-ajax-modal"]', function(e) {
						e.preventDefault();
						
						var _prop = {
								_this : $( this ),
								remote : $( this ).data('action-url') || $( this ).attr('href'),
								size : $( this ).data('modal-size') || 'modal-md',
								title : $( this ).data('title') || 'Modal',
							}
	
						lookup_ajax_modal.show( _prop );

					});
			},
		show: function( _prop, fn, scope ){
				$( '#lookup-ajax-modal' ).find('#modal-btn-close').trigger('click');
				$( '#lookup-ajax-modal' ).remove();
				
				$("body").removeClass("modal-open");
				$('.modal-backdrop').remove();
				$('body').removeAttr("style");
				
				var _modal = $("<div class=\"modal\" \
						id=\"lookup-ajax-modal\" \
						role=\"dialog\" \
						tabindex=\"-1\" \
						aria-hidden=\"true\">\
							<div class=\"modal-dialog "+ _prop.size +"\" \
								role=\"document\">\
								<div class=\"modal-content\">\
									<div class=\"modal-header\">\
										<button id=\"modal-btn-close\" type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span></button>\
										<h4 class=\"modal-title\" id=\"ajaxModalTitle\" data-title=\"close\">"+ _prop.title +"</h4>\
									</div>\
									<div class=\"modal-body\">\
										<center class=\"text-primary\">\
											<i class=\"fa fa-lg fa-circle-o-notch fa-spin\"></i> Loading...\
										</center>\
									</div>\
								</div>\
							</div>\
						</div>");
				
				$( "body" ).append( _modal );
				_modal.modal({backdrop: true, keyboard: true});
				_modal.find('.modal-body').load( _prop.remote );
				
				if( $.isFunction(fn) ){
					fn.call( scope || lookup_ajax_modal );
					return (scope || lookup_ajax_modal)
				}
				
				return lookup_ajax_modal
			},
		hide: function( fn, scope ){
				$( '#lookup-ajax-modal' )
					.find('div[class="modal-header"]')
					.find('button[class="close"]')
					.trigger('click');
			

				if( $.isFunction(fn) ){
					fn.call( scope || lookup_ajax_modal );
					return (scope || lookup_ajax_modal)
				}
				
				return lookup_ajax_modal
			}
	};


var form_ajax_modal = {
		init: function(){
				$( document ).on('click', '[data-toggle="form-ajax-modal"]', function(e) {
						e.preventDefault();
						
						var _prop = {
								_this : $( this ),
								remote : $( this ).data('action-url') || $( this ).attr('href'),
								size : $( this ).data('modal-size') || 'modal-md',
								title : $( this ).data('title') || 'Modal',
							}
							
						form_ajax_modal.show( _prop );
					});
			},
		show: function( _prop, fn, scope ){
				$( '#form-ajax-modal' ).find('#modal-btn-close').trigger('click');
				$( '#form-ajax-modal' ).remove();
				
				var _modal = $("<div class=\"modal\" \
						id=\"form-ajax-modal\" \
						role=\"dialog\" \
						tabindex=\"-1\" \
						aria-hidden=\"true\">\
							<div class=\"modal-dialog "+ _prop.size +"\" \
								role=\"document\">\
								<div class=\"modal-content\">\
									<div class=\"modal-header\">\
										<button id=\"modal-btn-close\" type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span></button>\
										<h4 class=\"modal-title\" id=\"ajaxModalTitle\" data-title=\"close\">"+ _prop.title +"</h4>\
									</div>\
									<div class=\"modal-body\">\
										<center class=\"text-primary\">\
											<i class=\"fa fa-lg fa-circle-o-notch fa-spin\"></i> Loading...\
										</center>\
									</div>\
								</div>\
							</div>\
						</div>");
				
				$( "body" ).append( _modal );
				_modal.modal({backdrop: true, keyboard: true});
				//_modal.on("hidden.bs.modal", function(e){ $(window).trigger( "resize" ); });
				
				_modal.find('.modal-body').load( _prop.remote );
				
				if( $.isFunction(fn) ){
					setTimeout(function(){
							fn.call( scope || form_ajax_modal )
						}, 200);
					return (scope || form_ajax_modal)
				}
				
				return form_ajax_modal
			},
		hide: function( fn, scope ){
				$( '#form-ajax-modal' )
					.find('div[class="modal-header"]')
					.find('button[class="close"]')
					.trigger('click');
				
				if( $.isFunction(fn) ){
					setTimeout(function(){
							fn.call( scope || form_ajax_modal )
						}, 200);
					return (scope || form_ajax_modal)
				}
				
				return form_ajax_modal
			},
		post: function( fn, scope ){
				var _modal = $( '#form-ajax-modal' );
				var _form = _modal.find( "form" );
				
				if( _form.size() ){
					var remote = _form.attr( "action" );
					var data = _form.serialize();
					
					var posting = $.post( remote, data );
					posting.done(function( response ){
							$( '#form-ajax-modal' ).remove();
							
							var _modal = $("<div class=\"modal\" id=\"form-ajax-modal\" tabindex=\"-1\" aria-hidden=\"true\"><div class=\"modal-dialog\"><div class=\"modal-content\"><div class=\"modal-body\"><center><span class=\"label label-block label-danger\">Loading...</span></center></div></div></div></div>");
							$( "body" ).append( _modal );
							_modal.html( response );
							_modal.modal();
							
							if( $.isFunction(fn) ){
								setTimeout(function(){
										fn.call( scope || form_ajax_modal )
									}, 200);
							}
						})
				}
				
				return (scope || form_ajax_modal)
			}
	};

var mask_number = {    
		init: function(){
			if( $(".mask-number").length > 0 )
			{
				var $this =	$(".mask-number");
				var _form = $this.closest("form");
				
				$('.mask-number').each(function(index, element){
					var _val = mask_number.currency_remove($(this).val()) || 0;
					$(element).val( mask_number.currency_add(_val) )
				});
				
				$this.on("focus", function(){
						var val = mask_number.currency_remove($(this).val()) || 0;
					
						if ( val == 0 || val == '')
						{
							$(this).val("");
							return;
						}
						
						$(this).val( mask_number.currency_remove( val ) );
					});
						
				$this.on("blur", function(){
						var val = mask_number.currency_remove($(this).val()) || 0;
						if ( val != 0)
						{
							$(this).val( mask_number.currency_add(val) );
						} else {
							$(this).val( "0" );
						}
					});				
				
				_form.on('submit', function(e){
					mask_number.currency_remove_in_form( $(this) );
				});
			}
		},
		currency_add: function( _operand, _fixed = 2 ){
				_operand = String( _operand );

				return parseFloat( _operand ).toFixed( _fixed ).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
		
			},
		currency_remove: function( _operand ){
				_operand = String( _operand );

				return parseFloat( _operand.replace(/[^0-9\.-]+/g,"") );			
			},
		currency_remove_in_form: function( _form ){
				_form.find('.mask-number').each(function(index, element){
					$(element).val( mask_number.currency_remove($(this).val()) );
				});
			},
		currency_ceil( _operand, _increment = 1000 ){
				return Number( Math.ceil( parseFloat(_operand) / _increment) * _increment );
			}
	}
var _hotkeys = {};
var hotkey = {
		init: function(){
			if( $(".hotkey").length > 0 )
				return false;
				
			$(".hotkey").each(function(i, e){
				_hotkeys[$(this).attr('data-hotkey-key')] = {
					'element' : e.id,
					'trigger' : $(this).attr('data-hotkey-trigger'),
				}
			});
		},
		action: function(){			
			if($.isEmptyObject(_hotkeys)) return false;
			
			$( document ).on('keydown keypress', function(e){
				//if( e.target.nodeName == "INPUT" || e.target.nodeName == "TEXTAREA" ) return;
				if( ! $.isEmptyObject(_hotkeys[e.key]) || ! $.isEmptyObject(_hotkeys[e.keyCode]))
				{
					e.preventDefault();
					return false;
				}
			});
			
			$( document ).on('keyup', function(e){
				var e = e || window.event;
				//if( e.target.nodeName == "INPUT" || e.target.nodeName == "TEXTAREA" ) return;
				
				var s = e.key;
				var _capsLock = false;
				if (( s.toUpperCase() === s && s.toLowerCase() !== s && !e.shiftKey )
				|| ( s.toLowerCase() === s && s.toUpperCase() !== s && e.shiftKey )) {
					_capsLock = true;
				}				
				
				var _key = String(e.key);
				var _keyCode = e.keyCode; 
				if(e.keyCode >= 65 && e.keyCode <= 122){ // If the key is a letter
					if(e.shiftKey){ // If the SHIFT key is down, return the ASCII code for the capital letter
						_key = _capsLock ? _key.toUpperCase() : _key.toLowerCase();
						_keyCode = _capsLock ? _keyCode : _keyCode+32;
						
					}else{ // If the SHIFT key is not down, convert to the ASCII code for the lowecase letter
						_key = _capsLock ? _key.toLowerCase() : _key.toUpperCase();
						_keyCode = _capsLock ? _keyCode+32 : _keyCode;
					}
					
					if( ! $.isEmptyObject(_hotkeys[e.key]))
					{
						$( "#"+ _hotkeys[e.key].element ).trigger( _hotkeys[e.key].trigger );
						return;
					}else if( ! $.isEmptyObject(_hotkeys[_key])){
						$( "#"+ _hotkeys[_key].element ).trigger( _hotkeys[_key].trigger );
						return;
					}
					
					if( ! $.isEmptyObject(_hotkeys[e.keyCode]))
					{
						$( "#"+ _hotkeys[e.keyCode].element ).trigger( _hotkeys[e.keyCode].trigger );
						return;
					}else if( ! $.isEmptyObject(_hotkeys[_keyCode])){
						$( "#"+ _hotkeys[_keyCode].element ).trigger( _hotkeys[_keyCode].trigger );
						return;
					}
				} else { // If the key is NOT a letter
				
					if( ! $.isEmptyObject(_hotkeys[e.key]))
					{
						$( "#"+ _hotkeys[e.key].element ).trigger( _hotkeys[e.key].trigger );
						return;
					}
					if( ! $.isEmptyObject(_hotkeys[e.keyCode]))
					{
						$( "#"+ _hotkeys[e.keyCode].element ).trigger( _hotkeys[e.keyCode].trigger );
						return;
					}
				}
			});
		}
	};
	
(function ( $ ) {
	jQuery.fn.dataCollect = function( _params ){
		var _default = {
				ajaxUrl: '',
				ajaxMethod: 'GET',
				ajaxData: {},
				modalSize : 'modal-md',
				modalTitle : 'Lookup Data',
				modalTxtClose : 'Close',
				modalTxtSelect : 'Select',
				dtProcessing: true,
				dtServerSide: true,								
				dtPaginate: true,
				dtOrdering: false,
				dtLengthMenu: [ 10, 25, 50],
				dtOrder: [[0, 'asc']],
				dtSearching: true,
				dtInfo: true,
				dtResponsive: true,
				dtThead:[],
				dtTfoot:[],
				dtColumns: [],
				thMinLength: 3,
				thDisplayText: 0,
				thSelectOnBlur: false,
				onSelected: function(data, {}){},
				clearAfterSelected: true,
				autoComplete: false,

			}				
		
		return this.each(function(){
			var _this = $(this), _option = $.extend({}, _default, _params);						
			
			function onSelected( data ){
				if( _option.onSelected( data, _this )){ 
					hideLookupModal();
					if( _option.clearAfterSelected ) _this.val('').focus();
				}
			}
			
			function getSingleData( _key ){
				$.ajax({
					url: _option.ajaxUrl,
					method: _option.ajaxMethod,
					data: {key : _key},
				}).done(function( response, textStatus ){
					if(response.recordsTotal == 1){
						onSelected( response.data[0] );
					} else {
						callLookupModal( _key );
					}
				}).fail(function(jqXHR, textStatus, errorThrown ) {
					$.alert_error(errorThrown);
				});
			}
			
			function callLookupModal( _key ){
				
				var _modal = $("#data-collect-modal");
				_modal.find('.modal-dialog').addClass(_option.modalSize);
				_modal.find('.modal-title').html(_option.modalTitle);
				_modal.find('#data-collect-modal-close').html(_option.modalTxtClose);
				_modal.find('#data-collect-modal-select').html(_option.modalTxtSelect);
				_modal.modal({backdrop: true, keyboard: true});				
				
				var _table = $('<table id="dt_data_collect" class="datatable table table-bordered table-hover" width="100%" cellspacing="0">\
									<thead><tr></tr></thead>\
									<tbody></tbody>\
								</table>');
				
				$.each(_option.dtThead, function(i, v){
					_table.find('thead > tr').append('<td>'+ v +'</td>');
				});
				/*$.each(_option.dtTfoot, function(i, v){
					_table.find('tfoot > tr').append('<td>'+ v +'</td>');
				});*/
				_modal.find('.modal-body').html('<div></div>');
				_modal.find('.modal-body').html(_table);
			
				_table.DataTable({
					processing: _option.dtProcessing,
					serverSide: _option.dtServerSide,								
					paginate: _option.dtPaginate,
					ordering: _option.dtOrdering,
					order: _option.dtOrder,
					lengthMenu: _option.dtLengthMenu,
					searching: _option.dtSearching,
					info: _option.dtInfo,
					responsive: _option.dtResponsive,
					search: {search: _key},
					keys: {blurable: true},
					ajax: {
						url: _option.ajaxUrl,
						type: _option.ajxMethod,
						data: function( params ){
							if($.isFunction(_option.ajaxData) )
							{
								params = _option.ajaxData(params);
							} else {
								$.each(_option.ajaxData, function(i, v){
									params[i] = v;
								});
							}
						}
					},
					columns: _option.dtColumns,
					createdRow: function ( row, data, index ){
						$( row ).on( "click", function(e){
							if ( $(this).hasClass('selected danger') ) {
								$(this).removeClass('selected danger');
							} else {
								_table.DataTable().$('tr.selected').removeClass('selected danger');
								$(this).addClass('selected danger');
							}
						});
						$( row ).on( "dblclick", function(e){
							onSelected( data );							
						});
					},
					initComplete: function () {
						$('#dt_data_collect_filter input').focus();
						$('#dt_data_collect_filter input').on('keyup', function(e){
							if( e.which == 40 ){
								e.preventDefault();
								$(this).blur();
								_table.DataTable().cell( ':eq(0)' ).focus();
							}
							if( e.which == 38 ){
								e.preventDefault();
								$(this).blur();
								_table.DataTable().cell( ':last' ).focus();
							}
						});
						
						$("#dt_data_collect_wrapper").find(".datatable-tools").addClass("row");
						$("#dt_data_collect_wrapper").find(".datatable-tools").removeClass("clearfix");
					}
				});
				
				var timer = 0;
				$( "#dt_data_collect_filter" ).find('input').unbind();
				$( "#dt_data_collect_filter" ).find('input').on("keyup paste change", function(e){					
					if (timer) {
						clearTimeout(timer);
					}
					
					timer = setTimeout(function(){
						var words = $.trim( $( "#dt_data_collect_filter" ).find('input').val() || "" );
						if( ! (e.keyCode >= 37 && e.keyCode <= 40) && (e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 122) || e.keyCode == 46 || e.keyCode == 8)
						{ 
							_table.DataTable().search( words );
							_table.DataTable().draw();	
						}
					}, 400); 
				});
				 
				_table.on( 'key-focus', function ( e, datatable, cell ) {
					var _row = _table.DataTable().row( cell.index().row ).node();
					if ( ! $(_row).hasClass('selected info') ) {
						_table.DataTable().$('tr.selected').removeClass('selected info');
						$(_row).addClass('selected info');
					}
				}).on( 'key', function ( e, datatable, key, cell, originalEvent ) {
					if ((key >= 48 && key <= 57) || (key >= 65 && key <= 122) || key == 46 || key == 8 )
					{
						_table.DataTable().cell.blur();
						$('#dt_data_collect_filter input').focus();
					} else if( key == 13){
						var data = _table.DataTable().row( cell.index().row ).data();
						onSelected( data );	
					}
				});
				
				_modal.find("#data-collect-modal-select").unbind();
				_modal.find('#data-collect-modal-select').on('click', function(){
					var data = _table.DataTable().row( '.selected' ).data();
					onSelected( data );		
				});
			}
			
			function hideLookupModal(){
				$('#data-collect-modal-close').trigger('click');
			}
			
			// AutoComplete Boostrap TypeHead			
			if(_option.autoComplete){
				_this.css('autocomplete', 'off');
				_this.typeahead({
					async: true,
					minLength: _option.thMinLength,
					name: _option.modalTitle,
					autoSelect: false,
					selectOnBlur: _option.thSelectOnBlur,
					displayText: function(item){ 
						return item[ _option.thDisplayText ] || 'No display set';
					},
					afterSelect: function(_response) { 
						onSelected( _response );
					}
				});
				
				var timer;
				_this.keyup(function(e){
					var keyCode = e.keyCode || e.which;
					var _key = this.value;
					if (keyCode === 13 && this.value.length >= _option.thMinLength) { 							
						clearInterval(timer);
						timer = setTimeout(function(){
							getSingleData(_key);
						}, 300); 
					} else {
						clearInterval(timer);
						timer = setTimeout(function(){
							_this.data('typeahead').source = function findMatches(query, processSync) {
								$.ajax({
									url: _option.ajaxUrl,
									type: _option.ajaxMethod,
									data: {
										key : query,
									},
									dataType: 'json',
									success: function (_response) {
										processSync(_response.data);
									}
								});
							}
						}, 300); 			
					}
				});
				
			} else { // Jika AutoComplete false
				
				var timer;
				_this.keyup(function(e){
					var keyCode = e.keyCode || e.which;
					var _key = this.value;
					if (keyCode === 13 && this.value.length >= _option.thMinLength) { 							
						clearInterval(timer);
						timer = setTimeout(function(){
							getSingleData(_key);
						}, 300); 
					}
				});
			}
			
			_this.closest(".data_collect_wrapper").find(".data_collect_btn").on("click", function(e){
				hideLookupModal();
				callLookupModal( _this.val() );
			});
		});
	};
}( jQuery ));

$(function(){
	lookup_ajax_modal.init();
	ajax_modal.init();
	form_ajax_modal.init();
	mask_number.init();
	hotkey.init();
	hotkey.action();
	
	$( document ).on('hidden.bs.modal', '.modal', function(event) {
        $(this).removeClass( 'fv-modal-stack' );
        $('body').data( 'fv_open_modals', $('body').data( 'fv_open_modals' ) - 1 );
		
		if ( $('body').data( 'fv_open_modals' ) == 0 ) {
			$('html').removeClass('modal-open');
			$('body').removeClass('modal-open');
		}
		
    });

    $( document ).on('shown.bs.modal', '.modal', function (event) {
        // keep track of the number of open modals
        if ( typeof( $('body').data( 'fv_open_modals' ) ) == 'undefined' ) {
            $('body').data( 'fv_open_modals', 0 );
        }

        // if the z-index of this modal has been set, ignore.
        if ($(this).hasClass('fv-modal-stack')) {
            return;
        }

        $(this).addClass('fv-modal-stack');
        $('body').data('fv_open_modals', $('body').data('fv_open_modals' ) + 1 );
        $(this).css('z-index', 1040 + (10 * $('body').data('fv_open_modals' )));
        $('.modal-backdrop').not('.fv-modal-stack').css('z-index', 1039 + (10 * $('body').data('fv_open_modals')));
        $('.modal-backdrop').not('fv-modal-stack').addClass('fv-modal-stack'); 
		$('html').addClass('modal-open');
		$('body').addClass('modal-open');

    });        
	
	
});