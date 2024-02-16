<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

$discounts_info = get_field('discounts_info', 'options');
$display_discounts_info = false;
if($discounts_info['display_in_cart']) {
	$display_discounts_info = true;
}

?>

<div class="page-content">
	<div class="container">

		<h1 class="page-content__title h1"><?php the_title(); ?></h1>
			
		<?php do_action( 'woocommerce_before_cart' ); ?>

		<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
			<?php do_action( 'woocommerce_before_cart_table' ); ?>

			<table class="woocommerce-cart-form__contents cart-table" cellspacing="0">

				<tr class="cart-table__heading">
					<th class="cart-table__title"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
					<th class="cart-table__title"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
					<th class="cart-table__title"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
					<th class="cart-table__title"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
					<th class="cart-table__title">&nbsp;</th>
				</tr>

				<?php do_action( 'woocommerce_before_cart_contents' ); ?>

				<?php
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
						?>
						<tr class="woocommerce-cart-form__cart-item cart-table__item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

							<td class="cart-table__product" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
								<div class="cart-table__product-inner">
									<span class="cart-table__mobile-title"><?php echo __( 'Product', 'woocommerce' ); ?></span>

									<div class="cart-table__thumbnail">
										<?php
											$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

											if ( ! $product_permalink ) {
												echo $thumbnail; // PHPCS: XSS ok.
											} else {
												printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
											}
										?>
									</div>

									<div class="product-name">
										<?php
											if ( ! $product_permalink ) {
												echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
											} else {
												echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
											}

											do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

											// Meta data.
											echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

											// Backorder notification.
											if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
												echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
											}
										?>
									</div>
								</div>
							</td>

							<td class="cart-table__price product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
								<span class="cart-table__mobile-title"><?php echo __( 'Price', 'woocommerce' ); ?></span>
								<?php
									echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
								?>
							</td>

							<td class="cart-table__quantity product-amount" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
								<span class="cart-table__mobile-title"><?php echo __( 'Quantity', 'woocommerce' ); ?></span>
								<?php
								if ( $_product->is_sold_individually() ) {
									$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
								} else {
									$product_quantity = woocommerce_quantity_input(
										array(
											'input_name'   => "cart[{$cart_item_key}][qty]",
											'input_value'  => $cart_item['quantity'],
											'max_value'    => $_product->get_max_purchase_quantity(),
											'min_value'    => '0',
											'product_name' => $_product->get_name(),
										),
										$_product,
										false
									);
								}

								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
								?>
							</td>

							<td class="cart-table__subtotal product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
								<span class="cart-table__mobile-title"><?php echo __( 'Subtotal', 'woocommerce' ); ?></span>
								<?php
									echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
								?>
							</td>

							<td class="cart-table__remove product-remove">
								<?php
									echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										'woocommerce_cart_item_remove_link',
										sprintf(
											'<a href="%s" class="product-remove__button remove" aria-label="%s" data-product_id="%s" data-product_sku="%s" title="%s"><span class="product-remove__desktop-text">&times;</span><span class="product-remove__mobile-text">%s</span></a>',
											esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
											esc_html__( 'Remove this item', 'woocommerce' ),
											esc_attr( $product_id ),
											esc_attr( $_product->get_sku() ),
											esc_html__( 'Remove this item', 'woocommerce' ),
											esc_html__( 'Remove this item', 'woocommerce' )
										),
										$cart_item_key
									);
								?>
							</td>
						</tr>
						<?php
					}
				}
				?>

				<?php do_action( 'woocommerce_cart_contents' ); ?>
					
				<button type="submit" class="button button--color-accent" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

				<?php do_action( 'woocommerce_cart_actions' ); ?>

				<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>

				<?php do_action( 'woocommerce_after_cart_contents' ); ?>

			</table>

			<?php if($display_discounts_info) : ?>
			<div class="cart-discounts">
				<?php get_template_part('templates/components/discounts-info-bar', null, []); ?>
			</div>
			<?php endif; ?>

			<?php do_action( 'woocommerce_after_cart_table' ); ?>

			<?php if ( wc_coupons_enabled() ) : ?>
				<div class="coupon">
					<div class="coupon__inner">
						<p class="coupon__cta"><?php echo __( 'Have an Algorigin discount coupon? Use it here!', 'algorigin-theme' ); ?></p>

						<div class="coupon__form">
							<div class="coupon__field">
								<div class="text-field">
									<input type="text" name="coupon_code" class="text-field__input has-no-border" id="coupon_code" value="" placeholder="<?php echo __( 'Enter coupon code', 'algorigin-theme' ); ?>" />
									<label for="coupon_code" class="text-field__placeholder"><?php echo __( 'Enter coupon code', 'algorigin-theme' ); ?></label>
								</div>
							</div>

							<div class="coupon__button">
								<button type="submit" class="button button--bordered" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
							</div>
						</div>
						
						<?php do_action( 'woocommerce_cart_coupon' ); ?>
					</div>
				</div>
			<?php endif; ?>
		</form>

		<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

		<div class="cart-collaterals">
			<?php
				/**
				 * Cart collaterals hook.
				 *
				 * @hooked woocommerce_cross_sell_display
				 * @hooked woocommerce_cart_totals - 10
				 */
				do_action( 'woocommerce_cart_collaterals' );
			?>
		</div>

		<?php do_action( 'woocommerce_after_cart' ); ?>
		
	</div>
</div>