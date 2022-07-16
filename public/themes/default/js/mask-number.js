"use strict";


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
$(function(){
	
   	mask_number.init();
	
});