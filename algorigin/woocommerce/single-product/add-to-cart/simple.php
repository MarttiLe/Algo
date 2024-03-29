<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

echo wc_get_stock_html( $product ); // WPCS: XSS ok.

if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
		<div class="product-cart">
			<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

			<?php do_action( 'woocommerce_before_add_to_cart_quantity' ); ?>

			<div class="product-cart__quantity product-quantity">
				<button class="product-quantity__button js-product-quantity-minus">-</button>

				<?php
					woocommerce_quantity_input(
						array(
							'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
							'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
							'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
						)
					);
				?>

				<button class="product-quantity__button js-product-quantity-plus">+</button>
			</div>

			<?php do_action( 'woocommerce_after_add_to_cart_quantity' ); ?>

			<div class="product-cart__options">
				<a href="<?php echo $product->add_to_cart_url(); ?>" value="<?php echo $product->get_id(); ?>" class="product-cart__button button button--color-accent button--icon-left ajax_add_to_cart add_to_cart_button js-product-add-to-cart-button" data-product_id="<?php echo $product->get_id(); ?>" data-product_sku="<?php echo $product->get_sku(); ?>" data-quantity="1"><?php icon_svg('cart', 'button__icon'); ?><?php echo esc_html( $product->single_add_to_cart_text() ); ?></a>
			</div>

			<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
		</div>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
