$ = jQuery;
$(document).ready(function(){
	/**
	 * Allow only single product into cart.
	 * @author KK
	 * @return Custom message for user.
	 */
	if( $('body').hasClass('postid-3088') ){
		$('#dvPrice .price').html('<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">€</span>1,000</span>');
		$('#amount').prop('selectedIndex',0);

		$('.single_variation_wrap .single_variation').after('<div class="cidi_custom_price"><input type="number" name="cidi_bike_val" id="cidi_bike_val" step="100" value="100" min="100" max="10000" /></div>');
		$('.single_variation_wrap .cidi_custom_price').hide();
		$('#amount').change(function(e){
			e.preventDefault();
			if( $(this).val() == 'Custom - Share a Bike in a group' ){
				//$('.single_variation').css('visibility','hidden');
				$('.single_variation_wrap .cidi_custom_price').css('display' , 'inline-block');
				$('.single_add_to_cart_button').addClass('disabled');
			} else {
				//$('.single_variation').css('visibility','visible');
				$('.single_variation_wrap .cidi_custom_price').hide();
			}
		});
		$('#cidi_bike_val').keydown(function(e){
			e.preventDefault();
			return false;
		});

		$('#cidi_bike_val').change(function(e){
			e.preventDefault();
			$('.woocommerce-variation-price .price .woocommerce-Price-amount').html('<span class="woocommerce-Price-currencySymbol">€</span>' + $(this).val());
			if( $(this).val() == '' || $(this).val() == 0 ){
				$('.single_add_to_cart_button').addClass('disabled');
			} else {
				$('.single_add_to_cart_button').removeClass('disabled');
			}
		});
	}
});
