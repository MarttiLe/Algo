<?php get_header(); ?>

<?php
    $page_refs = get_field('page_refs', 'options');
    $shop_page_id = $page_refs['shop'];

    $is_term = false;
    $current_term = get_queried_object();
    if(property_exists($current_term, 'term_id')) {
        $is_term = true;
    }
?>


<?php
    // PAGE HEADING
    if($is_term) {
        $block_attr = [
            'skip_acf_data'     => true,
            'title'             => $current_term->name,
            'subtitle'          => $current_term->description,
            'hide_breadcrumb'   => true
        ];
    } else {
        $block_attr = [
            'page_id'           => $shop_page_id,
            'hide_breadcrumb'   => true
        ];
    }
    get_template_part('templates/blocks/page-heading', null, $block_attr);
?>


<section class="shop">
    <div class="container">
        <div class="shop__inner">

            <div class="shop__aside">
                
                <div class="drawer js-drawer" data-drawer-id="shop-filters">
                    <div class="drawer__inner">
                        <div class="drawer__content">
                            <div class="shop__sidebar">
                                <?php
                                    // CATEGORIES SIDEBAR
                                    echo get_template_part('templates/components/sidebar-product-categories', null, [
                                        'title'             => __('Categories', 'algorigin-theme'),
                                        'taxonomy'          => 'product_cat',
                                        'exclude'           => 15,
                                        'display_shop_link' => true
                                    ]); 
                                ?>
                            </div>

                            <div class="shop__sidebar">
                            <?php 
                                    // TAGS SIDEBAR
                                    echo get_template_part('templates/components/sidebar-product-categories', null, [
                                        'title'             => __('Algaes', 'algorigin-theme'),
                                        'taxonomy'          => 'product_tag'
                                    ]); 
                                ?>
                            </div>
                        </div>

                        <button class="drawer__toggle js-drawer-toggle js-floating-drawer-toggle" data-drawer-id="shop-filters" title="<?php echo __( 'Open filters', 'algorigin-theme' ); ?>"><?php icon_svg('filters', 'drawer__open-icon'); ?><?php echo icon_svg('caron-down', 'drawer__close-icon'); ?></button>
                    </div>
                </div>

            </div>

            <div class="shop__main">
                <div class="shop__filters shop-filters">
                    <button class="shop-filters__mobile-toggle js-drawer-toggle" data-drawer-id="shop-filters"><?php icon_svg('filters'); ?><?php echo __( 'Open filters', 'algorigin-theme' ); ?></button>

                    <div class="shop-filters__count">
                        <?php woocommerce_result_count(); ?>
                    </div>

                    <div class="shop-filters__order">
                        <?php woocommerce_catalog_ordering(); ?>
                    </div>
                </div>

                <div class="shop__notices">
                    <?php do_action( 'woocommerce_output_all_notices' ); ?>
                </div>

                <div class="shop__products">
                    <?php if ( woocommerce_product_loop() ) : ?>

                        <ul class="product-list product-list--shop">
                            <?php while ( have_posts() ) : ?>
                                <?php the_post(); ?>

                                <li class="product-list__item">
                                    <?php echo get_template_part('templates/components/card-product', null, []); ?>
                                </li>
                            <?php endwhile; ?>
                        </ul>

                    <?php else : ?>

                        <div class="shop__alert">
                            <?php do_action( 'woocommerce_no_products_found' ); ?>
                        </div>

                    <?php endif; ?>
                
                    <?php do_action( 'woocommerce_pagination' ); ?>
                </div>
            </div>

        </div>
    </div>
</section>
<?php
if(get_field('display_block_newsletter', get_queried_object())) {
    $block_attr = [];
    get_template_part('templates/blocks/newsletter', null, $block_attr);
}
?>


<?php get_footer(); ?>