<?php
/**
 * Lost password reset form.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-reset-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.5
 */

defined( 'ABSPATH' ) || exit;
?>


<?php do_action( 'woocommerce_before_reset_password_form' ); ?>

<div class="password-reset">
	<form method="post" class="woocommerce-ResetPassword lost_reset_password">

		<h2 class="h2"><?php _e( 'Password recovery', 'woocommerce' ); ?></h2>
		<p><?php echo apply_filters( 'woocommerce_reset_password_message', esc_html__( 'Enter a new password below.', 'woocommerce' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>

		<div class="password-reset__password text-field">
			<input type="password" class="text-field__input" name="password_1" id="password_1" autocomplete="new-password" />
			<label for="password_1" class="text-field__placeholder"><?php esc_html_e( 'New password', 'woocommerce' ); ?></label>
		</div>
		<div class="password-reset__password-2 text-field">
			<input type="password" class="text-field__input" name="password_2" id="password_2" autocomplete="new-password" />
			<label for="password_2" class="text-field__placeholder"><?php esc_html_e( 'Re-enter new password', 'woocommerce' ); ?></label>
		</div>

		<input type="hidden" name="reset_key" value="<?php echo esc_attr( $args['key'] ); ?>" />
		<input type="hidden" name="reset_login" value="<?php echo esc_attr( $args['login'] ); ?>" />

		<?php do_action( 'woocommerce_resetpassword_form' ); ?>

		<input type="hidden" name="wc_reset_password" value="true" />
		<button type="submit" class="button" value="<?php esc_attr_e( 'Save', 'woocommerce' ); ?>"><?php esc_html_e( 'Save', 'woocommerce' ); ?></button>

		<?php wp_nonce_field( 'reset_password', 'woocommerce-reset-password-nonce' ); ?>

	</form>
</div>

<?php do_action( 'woocommerce_after_reset_password_form' ); ?>