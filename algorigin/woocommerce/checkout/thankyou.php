<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>


<div class="page-content thank-you">
	<div class="container container--sm">

		<div class="woocommerce-order">
			<?php
				if ( $order ) :

					do_action( 'woocommerce_before_thankyou', $order->get_id() );
					?>

					<?php if ( $order->has_status( 'failed' ) ) : ?>

						<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

						<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
							<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
							<?php if ( is_user_logged_in() ) : ?>
								<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
							<?php endif; ?>
						</p>

					<?php else : ?>

						<h3 class="thank-you__title"><?php echo __( 'Thank you for choosing Algorigin.', 'algorigin-theme' ); ?></h3>
						<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'We have received your order, and a copy of all the details has been sent to your e-mail. Below is a quick summary.', 'woocommerce' ), $order ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

						<table class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

							<tr>
								<td><?php esc_html_e( 'Order number:', 'woocommerce' ); ?></td>
								<td><strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong></td>
							</tr>

							<tr>
								<td><?php esc_html_e( 'Date:', 'woocommerce' ); ?></td>
								<td><strong><?php echo wc_format_datetime( $order->get_date_created() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong></td>
							</tr>

							<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
							<tr>
								<td><?php esc_html_e( 'Email:', 'woocommerce' ); ?></td>
								<td><strong><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong></td>
							</tr>
							<?php endif; ?>

							<tr>
								<td><?php esc_html_e( 'Total:', 'woocommerce' ); ?></td>
								<td><strong><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong></td>
							</tr>
							
							<?php if ( $order->get_payment_method_title() ) : ?>
							<tr>
								<td><?php esc_html_e( 'Payment method:', 'woocommerce' ); ?></td>
								<td><strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong></td>
							</tr>
							<?php endif; ?>

						</table>

						<p class="thank-you__bottom-text"><?php echo __( 'You can track your order from', 'algorigin-theme' ); ?> <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>"><?php echo __( 'my orders screen', 'algorigin-theme' ); ?></a>.</p>

					<?php endif; ?>

				<?php else : ?>

					<h3 class="thank-you__title"><?php echo __( 'Thank you for choosing Algorigin', 'algorigin-theme' ); ?></h3>
					<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'We have received your order.', 'woocommerce' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

				<?php endif; 
			?>
		</div>

	</div>
</div>

