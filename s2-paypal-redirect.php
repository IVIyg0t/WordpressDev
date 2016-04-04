<?php

// Simple plugin to use custom buttons with S2Members paypal standard forms.

add_action('wp_loaded' , function()
{
	if(isset($_REQUEST['paypal']) && $_REQUEST['paypal'] === 'redirect-standard')
	{
		$paypal_checkout = do_shortcode( '[s2Member-PayPal-Button level="1" ccaps="" desc="Standard Member Upgrade Package" ps="paypal" lc="" cc="USD" dg="0" ns="1" custom="germany.collegiatesoccerusa.com" ta="0" tp="0" tt="D" ra="1500" rp="1" rt="L" rr="BN" rrt="" rra="1" image="default" output="url" /] ' );
		wp_redirect($paypal_checkout); exit;
	}
	else if( isset($_REQUEST['paypal']) && $_REQUEST['paypal'] === 'redirect-elite')
	{
		$paypal_checkout = do_shortcode( '[s2Member-PayPal-Button level="2" ccaps="" desc="Elite Member Upgrade package" ps="paypal" lc="" cc="USD" dg="0" ns="1" custom="germany.collegiatesoccerusa.com" ta="0" tp="0" tt="D" ra="2000" rp="1" rt="L" rr="BN" rrt="" rra="1" image="default" output="url" /]' );
		wp_redirect($paypal_checkout); exit;
	}
});

?>
