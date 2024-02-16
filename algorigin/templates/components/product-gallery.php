<?php
    /**
     * PRODUCT GALLERY
     * @param block_classes string (optional) - pass additional classes for the block
     * @param product_id int (optional) - pass in the id of a specific product
    **/

    if(!empty($args['product_id']) && is_int($args['product_id'])) {
        $product_id = $args['product_id'];
        $product = wc_get_product($product_id);
    } else {
        global $product;
        $product_id = get_the_ID();
    }

    $block_classes = '';
    if(!empty($args['classes'])) {
        $block_classes = ' ' . $args['classes'];
    }

    $featured_img = get_post_thumbnail_id($product_id);
    if(!empty($featured_img)) {
        $featured_img_full = wp_get_attachment_image_url($featured_img, 'full');
        $featured_img = theme_get_wp_image($featured_img, 'product-thumb', 'gallery-image__img', __('Product photo', 'algorigin-theme'));
    } else {
        $featured_img_full = wp_get_attachment_image_url(get_field('placeholder_img_product', 'options'), 'full');
        $featured_img = theme_get_wp_image(get_field('placeholder_img_product', 'options'), 'product-thumb', 'gallery-image__img', __('Product photo', 'algorigin-theme'));
    }
    $gallery_featured = [
        'thumb'     => $featured_img,
        'full'      => $featured_img_full
    ];
    $gallery_images = $product->get_gallery_image_ids();
    $gallery_items = [];
    if(!empty($gallery_images)) {
        foreach($gallery_images as $key => $image) {
            $image = [
                'thumb'     => theme_get_wp_image($image, 'product-thumb', 'gallery-image__img'),
                'full'      => wp_get_attachment_image_url($image, 'full')
            ];
            $gallery_items[$key] = $image;
        }
    }
    $gallery_count = count($gallery_items);
    $more_images_text = '+' . ($gallery_count - 2) . ' ' . __( 'more', 'algorigin-theme' );
?>


<?php if(!empty($featured_img)) : ?>
<div class="product-gallery<?php echo $block_classes; ?>">
    <ul class="product-gallery__items">
        <li class="product-gallery__item">
            <div class="gallery-image">
                <a href="<?php echo $gallery_featured['full']; ?>" data-fancybox="product-gallery" class="gallery-image__anchor" title="<?php echo __( 'View product gallery', 'algorigin-theme' ); ?>">
                    <?php echo $gallery_featured['thumb']; ?>
                </a>
            </div>
        </li>

        <?php if(!empty($gallery_items)) : ?>
            <?php foreach($gallery_items as $key => $gallery_item) : ?>
                <?php if($key < 2 || ($key === 2 && $gallery_count <= 3)) : ?>
                <li class="product-gallery__item">
                    <div class="gallery-image">
                        <a href="<?php echo $gallery_item['full']; ?>" data-fancybox="product-gallery" class="gallery-image__anchor" title="<?php echo __( 'View product gallery', 'algorigin-theme' ); ?>">
                            <?php echo $gallery_item['thumb']; ?>
                        </a>
                    </div>
                </li>
                <?php elseif($key === 2 && $gallery_count > 3) : ?>
                <li class="product-gallery__item">
                    <a href="<?php echo $gallery_item['full']; ?>" data-fancybox="product-gallery" class="product-gallery__more" title="<?php echo __( 'View product gallery', 'algorigin-theme' ); ?>">
                        <?php icon_svg('gallery', 'product-gallery__icon'); ?>
                        <span><?php echo $more_images_text; ?></span>
                    </a>
                </li>
                <?php else : ?>
                    <li class="product-gallery__item">
                        <a href="<?php echo $gallery_item['full']; ?>" data-fancybox="product-gallery" class="gallery-image__anchor">&nbsp;</a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>
<?php endif; ?>