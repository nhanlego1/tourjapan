jQuery(document).ready(function($) {
	var payment_mode =  $('#woocommerce_wcmp_paypal_adaptive_payment__payment_mode').val();
	if(payment_mode == 'parallel') {
		$('#woocommerce_wcmp_paypal_adaptive_payment__payment_chained_fees').parent().parent().parent().hide();
		$('#woocommerce_wcmp_paypal_adaptive_payment__payment_parallel_fees').parent().parent().parent().show();		
	}
	else if(payment_mode == 'chained') {
		$('#woocommerce_wcmp_paypal_adaptive_payment__payment_chained_fees').parent().parent().parent().show();
		$('#woocommerce_wcmp_paypal_adaptive_payment__payment_parallel_fees').parent().parent().parent().hide();		
	}
	$('#woocommerce_wcmp_paypal_adaptive_payment__payment_mode').change(function(e){
		if($(this).val() == 'parallel') {
			$('#woocommerce_wcmp_paypal_adaptive_payment__payment_chained_fees').parent().parent().parent().hide();
			$('#woocommerce_wcmp_paypal_adaptive_payment__payment_parallel_fees').parent().parent().parent().show();					
		}
		else {
			$('#woocommerce_wcmp_paypal_adaptive_payment__payment_chained_fees').parent().parent().parent().show();
			$('#woocommerce_wcmp_paypal_adaptive_payment__payment_parallel_fees').parent().parent().parent().hide();
		}		
	});				
});
