<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>


<?php do_action( 'woocommerce_before_account_navigation' ); ?>

<div class="sidebar-page-nav">
    <div class="sidebar-page-nav__title"><?php echo __( 'Your profile', 'algorigin-theme' ); ?></div>

    <nav class="sidebar-nav woocommerce-MyAccount-navigation">
		<ul class="sidebar-nav__items menu">
			<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
				<li class="menu__item is-top-level <?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
					<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>" class="menu__anchor is-top-level"><?php echo esc_html( $label ); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
    </nav>
</div>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
