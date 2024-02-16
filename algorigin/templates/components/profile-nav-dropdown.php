<?php
    /**
     * WOOCOMMERCE ACCOUNT DROPDOWN
     * @param block_classes string (optional) - pass additional classes for the block
    **/

	$option_dashboard = $option_orders = $option_edit_addresses = $option_edit_account = $option_logout = '';
	$selected = ' selected';
	if(is_wc_endpoint_url('orders')) {
		$option_orders = $selected;
    } else if(is_wc_endpoint_url('edit-address')) {
        $option_edit_addresses = $selected;
    }
    else if(is_wc_endpoint_url('edit-account')) {
		$option_edit_account = $selected;
	} else {
		$option_dashboard = $selected;
	}
?>


<div class="mobile-account-nav">
	<?php do_action( 'woocommerce_before_account_navigation' ); ?>

	<div class="select">
		<select class="select__input mobile-account-nav__select mobile-select-nav js-nav-select">
			<option value="<?php echo wc_get_page_permalink('myaccount'); ?>"<?php echo $option_dashboard; ?>><?php _e( 'Dashboard', 'algorigin-theme' ); ?></option>
            <option value="<?php echo wc_get_account_endpoint_url('orders'); ?>"<?php echo $option_orders; ?>><?php _e( 'Orders', 'algorigin-theme' ); ?></option>
            <!--<option value="<?php echo wc_get_account_endpoint_url('edit-address'); ?>"<?php echo $option_edit_addresses; ?>><?php _e( 'Edit address', 'algorigin-theme' ); ?></option>-->
			<option value="<?php echo wc_get_account_endpoint_url('edit-account'); ?>"<?php echo $option_edit_account; ?>><?php _e( 'Edit details', 'algorigin-theme' ); ?></option>
			<option value="<?php echo wp_logout_url(home_url()); ?>"<?php echo $option_logout; ?>><?php _e( 'Log out', 'algorigin-theme' ); ?></option>
		</select>
	</div>

	<?php do_action( 'woocommerce_after_account_navigation' ); ?>
</div>