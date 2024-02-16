<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

$page_refs = get_field('page_refs', 'options');
?>

<div class="page-content cart cart--empty">
	<div class="container">

		<h1 class="page-content__title h1"><?php the_title(); ?></h1>

		<div class="editor-content">
			<div class="cart__empty-text">
				<?php
					/*
					* @hooked wc_empty_cart_message - 10
					*/
					do_action( 'woocommerce_cart_is_empty' );
				?>
			</div>

			<div class="checkout-options">
				<div class="checkout-options__item"><a href="<?php echo get_permalink($page_refs['shop']); ?>" class="button"><?php echo __( 'Continue shopping', 'algorigin-theme' ); ?></a></div>
			</div>
		</div>
		
	</div>
</div>