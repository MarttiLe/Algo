<?php
    /**
     * PRODUCT CARD (WC)
     * @param post_id int (optional) - pass post ID to get a specific post, otherwise global wp $post object will be used
     * @param item_classes string (optional) - pass additional classes for the LI element
    **/

    if(!empty($args['post_id']) && is_int($args['post_id'])) {
        $post = get_post($args['post_id']);
        $id = $args['post_id'];
    } else {
        global $post;
        $id = $post->ID;
    }
    if(empty($post) || is_wp_error($post)) {
        return;
    }

    $block_classes = '';
    if(!empty($args['classes'])) {
        $block_classes = ' ' . $args['classes'];
    }

    $product = wc_get_product($id);

    $featured_img = (int)$product->get_image_id();
    $gallery_imgs = $product->get_gallery_image_ids();
    $image_1 = '';
    $image_2 = '';

    if(!empty($featured_img)) {
        $image_1 = theme_get_wp_image($featured_img, 'product-thumb', 'product-card__img', __('Product photo', 'algorigin-theme') . ' - ' . $post->post_title);
    }
    if(array_key_exists(0, $gallery_imgs)) {
        $image_2 = theme_get_wp_image($gallery_imgs[0], 'product-thumb', 'product-card__img', __('Product photo', 'algorigin-theme') . ' - ' . $post->post_title);
    }

    $post_data = [
        'id'                => $id,
        'sku'               => $product->get_sku(),
        'title'             => $post->post_title,
        'url'               => get_permalink($id),
        'cart_url'          => $product->add_to_cart_url(),
        'images'            => [
            0 => $image_1,
            1 => $image_2
        ],
        'labels'            => [
            0 => get_post_meta($id, '_algo_product_label1', true),
            1 => get_post_meta($id, '_algo_product_label2', true)
        ],
        'price'             => theme_get_product_price_data($product, true)
    ];

    $is_regional_product = $product->get_attribute('regional-product');
    if($is_regional_product && !$product->is_type( 'woosb' ) && !$product->is_type( 'simple' )) {
        $regional_variation = theme_get_regional_variation_data($product);
        $post_data['id'] = $regional_variation['id'];
        $post_data['cart_url'] = $regional_variation['cart_url'];

    }

    if(!empty($args['post_id']) && is_int($args['post_id'])) {
        wp_reset_postdata();
    }
    
?>


<div class="product-card<?php echo $block_classes; ?>">
    <div class="product-card__image">
        <a href="<?php echo $post_data['url']; ?>" class="product-card__image-anchor" title="<?php echo __( 'View this product', 'algorigin-theme' ); ?>">
            <?php 
                echo $post_data['images'][0];
                echo $post_data['images'][1];
            ?>
        </a>
    </div>

    <div class="product-card__inner">
        <h3 class="product-card__title"><a href="<?php echo $post_data['url']; ?>" class="product-card__anchor" title="<?php echo __( 'View this product', 'algorigin-theme' ); ?>"><?php echo $post_data['title']; ?></a></h3>

        <div class="product-card__description">
            <?php if(!empty($post_data['labels'][0])) : ?>
                <span class="product-card__label"><?php echo $post_data['labels'][0]; ?></span>
            <?php endif; ?>
            <?php if(!empty($post_data['labels'][1])) : ?>
                <br><span class="product-card__label"><?php echo $post_data['labels'][1]; ?></span>
            <?php endif; ?>
        </div>

        <div class="product-card__bottom">
            <?php
                $block_attr = [
                    'classes' => 'product-card__price price--product-card',
                    'price_data'    => $post_data['price'],
                ];
                get_template_part('templates/components/price-tag', null, $block_attr);
            ?>

            <div class="product-card__actions">
                <a href="<?php echo $post_data['cart_url']; ?>" value="<?php echo $post_data['id']; ?>" class="button button--color-accent button--icon-only-sm button--round ajax_add_to_cart add_to_cart_button" data-product_id="<?php echo $post_data['id']; ?>" data-product_sku="<?php echo $post_data['sku']; ?>" title="<?php echo __( 'Add this product to your cart', 'algorigin-theme' ); ?>"><?php icon_svg('cart', 'button__icon'); ?></a>
            </div>
        </div>
    </div>
</div>