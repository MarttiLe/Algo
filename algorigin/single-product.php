<?php get_header(); ?>


<?php 
    // Product data
    the_post();
    global $product;

    $discounts_info = get_field('discounts_info', 'options');
    $display_discounts_info = false;
    if($discounts_info['display_on_products']) {
        $display_discounts_info = true;
    }

    $general_info = get_field('general_options');

    $is_regional_product = $product->get_attribute('regional-product');
    $regional_content = '';
    if($is_regional_product && !$product->is_type( 'woosb' ) && !$product->is_type( 'simple' )) {
        $regional_variation_data = theme_get_regional_variation_data($product);
        $product_price = theme_get_product_price_data($product, true, true, $regional_variation_data);
        $regional_content = $regional_variation_data['description'];
    } else {
        $is_regional_product = false;
        $product_price = theme_get_product_price_data($product, true, false);
    }

    $product_data = [
        'title'                 => get_the_title(),
        'amount'                => $general_info['amount'],
        'content'               => get_the_content(),
        'regional_content'      => $regional_content,
        'price'                 => $product_price,
        'related_products'      => $product->get_upsell_ids()
    ];
?>


<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
    <div class="container">
        <div class="product__inner">

            <?php 
                // WC errors/notices
                do_action( 'woocommerce_before_single_product' ); 
            ?>

            <div class="product__mobile-heading">
                <h1 class="product__title h2"><?php echo $product_data['title']; ?></h1>

                <?php if(!empty($product_data['amount'])) : ?>
                <div class="product__amount"><?php echo $product_data['amount']; ?></div>
                <?php endif; ?>
            </div>

            <div class="product__breadcrumb">
                <?php echo theme_breadcrumbs_list('breadcrumbs--text-sm'); ?>
            </div>

            <div class="product__main">
                <div class="product__gallery">
                    <?php 
                        $block_attr = [];
                        get_template_part('templates/components/product-gallery', null, $block_attr);
                    ?>
                </div>

                <div class="product__content">
                    <div class="product__heading">
                        <h1 class="product__title h2"><?php echo $product_data['title']; ?></h1>

                        <?php if(!empty($product_data['amount'])) : ?>
                        <div class="product__amount"><?php echo $product_data['amount']; ?></div>
                        <?php endif; ?>
                    </div>

                    <?php if(!empty($product_data['content']) || !empty($product_data['regional_content'])) : ?>
                    <div class="product__description editor-content">
                        <?php if(!empty($product_data['regional_content'])) : ?>
                            <?php echo $product_data['regional_content']; ?>
                        <?php endif; ?>

                        <?php the_content(); ?>
                    </div>
                    <?php endif; ?>

                    <?php if(shortcode_exists('woosb_bundled')) : ?>
                    <div class="product__bundled">
                        <?php echo do_shortcode('[woosb_bundled]'); ?>
                    </div>
                    <?php endif; ?>

                    <div class="product__action-bar">
                        <div class="product__actions">
                            <div class="product__price">
                                <?php
                                    $block_attr = [
                                        'classes' => 'price--product',
                                        'price_data'    => $product_data['price'],
                                    ];
                                    get_template_part('templates/components/price-tag', null, $block_attr);
                                ?>
                            </div>

                            <div class="product__cart">
                                <?php woocommerce_template_single_add_to_cart(); ?>
                            </div>
                        </div>

                        <?php if($display_discounts_info) : ?>
                        <div class="product__discount-info">
                            <?php get_template_part('templates/components/discounts-info-bar', null, []); ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <?php if(shortcode_exists('woosb_bundles')) : ?>
                    <div class="product__bundles">
                        <?php echo do_shortcode('[woosb_bundles]'); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php 
                if(get_field('display_block_product_info_tabs')) {
                    $block_attr = [
                        'block_classes' => 'product__info'
                    ];
                    get_template_part('templates/components/product-info-tabs', null, $block_attr);
                }
            ?>
            <?php
            if(get_field('display_block_newsletter')) {
                $block_attr = [];
                get_template_part('templates/blocks/newsletter', null, $block_attr);
            }
            ?>

            <div class="product__reviews">
                <?php // TODO: Add reviews ?>
            </div>

            <?php
                if(!empty($product_data['related_products'])) {
                    $block_attr = [
                        'block_classes' => 'product__related',
                        'products'  => $product_data['related_products']
                    ];
                    get_template_part('templates/components/related-products', null, $block_attr);
                }
            ?>

            <div class="product__appointment">
                <?php get_template_part('templates/components/nutritionist-cta', null, []); ?>
            </div>

            <?php 
                if(get_field('display_block_faqs')) {
                    $block_attr = [
                        'block_classes' => 'product__faq'
                    ];
                    get_template_part('templates/components/faq', null, $block_attr);
                }
            ?>


            <?php do_action( 'woocommerce_after_single_product' ); ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>