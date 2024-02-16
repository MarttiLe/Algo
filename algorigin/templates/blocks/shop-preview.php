<?php
    /**
     * SHOP PREVIEW BLOCK
     * @param block_classes string (optional) - pass additional classes for the section element
    **/


    // Get block data
    $block_data = get_field('block_shop_preview');

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }

    $has_container = true;
    if(!empty($args['skip_container']) && $args['skip_container']) {
        $has_container = false;
    }


    // Manage block details
    if(!empty($block_data['highlighted_products'])) {
        $block_data['highlighted_products'] = (array)$block_data['highlighted_products'];
    }

    $page_refs = get_field('page_refs', 'options');

    $highlighted_card_classes = '';
    if(strpos($block_classes, 'shop-preview--mini')) {
        $highlighted_card_classes = 'expanded-product-card--sm';
    }
?>


<section class="shop-preview<?php echo $block_classes; ?>">
    <?php if(!empty($block_data['nav_anchor'])) : ?>
        <div id="<?php echo $block_data['nav_anchor']; ?>" class="scroll-anchor">&nbsp;</div>
    <?php endif; ?>

    <?php if($has_container) : ?>
    <div class="container">
    <?php endif; ?>
        <h2 class="shop-preview__title h1" data-sal="slide-up"><?php echo $block_data['title']; ?></h2>

        <?php if(!empty($block_data['products']) || !empty($block_data['highlighted_products'])) : ?>

            <?php if(!empty($block_data['highlighted_products'])) : ?>
            <ul class="shop-preview__highlighted-items" data-sal="slide-up">
                <?php foreach($block_data['highlighted_products'] as $key => $highlighted_product) : ?>
                        
                    <li class="shop-preview__highlighted-item">
                        <?php 
                            get_template_part('templates/components/card-product-expanded', null, [
                                'post_id' => $highlighted_product,
                                'block_classes' => $highlighted_card_classes
                            ]); 
                        ?>
                    </li>

                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <?php if(!empty($block_data['products'])) : ?>
            <?php $animation_delay = 100; ?>
            <div class="shop-preview__slider product-slider">
                <div class="slider js-product-slider">
                    <div class="slider__track" data-glide-el="track">
                        <ul class="product-slider__items slider__items">
                            <?php $animation_delay = 0; ?>
                            <?php foreach($block_data['products'] as $key => $product) : ?>

                                <?php $animation_delay = $animation_delay + 200; ?>
                                <li class="product-slider__item slider__item<?php if($key === 0) { echo ' slider__item--active'; } ?>" data-sal="slide-up" data-sal-delay="<?php echo $animation_delay; ?>">
                                    <?php get_template_part('templates/components/card-product', null, ['post_id' => $product]); ?>
                                </li>

                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <?php if(count($block_data['products']) > 1) : ?>
                    <div class="product-slider__arrows slider-controls" data-glide-el="controls" data-sal="slide-up" data-sal-delay="400">
                        <button class="product-slider__arrow slider-controls__arrow slider-controls__arrow--prev js-product-slider-prev" data-glide-dir="<" title="<?php _e( 'Previous slide', 'algorigin-theme' ); ?>"><?php icon_svg('arrow-left', 'slider-controls__icon'); ?></button>
                        <button class="product-slider__arrow slider-controls__arrow slider-controls__arrow--next js-product-slider-next" data-glide-dir=">" title="<?php _e( 'Next slide', 'algorigin-theme' ); ?>"><?php icon_svg('arrow-right', 'slider-controls__icon'); ?></button>
                    </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        <?php else : ?>
            <div class="alert-bar alert-bar--white is-active" data-sal="slide-up"><p class="alert-bar__text"><?php echo __( 'There are currently no products available', 'algorigin-theme' ); ?></p></div>
        <?php endif; ?>

        <div class="shop-preview__actions" data-sal="slide-up" data-sal-delay="200">
            <a href="<?php echo get_permalink($page_refs['shop']); ?>" class="shop-preview__more more-link" data-text="<?php echo __( 'Discover all of our products', 'algorigin-theme' ); ?>"><?php echo __( 'Discover all of our products', 'algorigin-theme' ); ?></a>
        </div>

    <?php if($has_container) : ?>
    </div>
    <?php endif; ?>
</section>