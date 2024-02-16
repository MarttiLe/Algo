<?php
    /**
     * TESTIMONIALS SLIDER BLOCK
     * Requires glide.js slider component!
     * Initialization is handled in JS
     * @param block_classes string (optional) - pass additional classes for the section element
    **/


    // Get block data
    $block_data = get_field('block_testimonials');

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }


    // Manage block details
    $slider_items_total = 0;
    if(!empty($block_data['items'])) {
        $slider_items_total = count($block_data['items']);
    }
?>


<section class="testimonials<?php echo $block_classes; ?>">
    <?php if(!empty($block_data['nav_anchor'])) : ?>
        <div id="<?php echo $block_data['nav_anchor']; ?>" class="scroll-anchor">&nbsp;</div>
    <?php endif; ?>
    
    <div class="container">
        <div class="testimonials__inner">
            <h2 class="testimonials__title h1" data-sal="slide-up"><?php echo $block_data['title']; ?></h2>

            <?php if(!empty($block_data['items'])) : ?>
                <div class="testimonials__slider">
                    <div class="slider js-testimonials-slider">
                        <div class="slider__track" data-glide-el="track">
                            <ul class="slider__items">
                                <?php foreach($block_data['items'] as $key => $testimonial) : ?>
                                    <li class="testimonial-card slider__item<?php if($key === 0) { echo ' slider__item--active'; } ?>" data-sal="slide-up" data-sal-delay="100">
                                        <?php 
                                            $block_attr = [
                                                'testimonial_data' => $testimonial
                                            ];
                                            get_template_part('templates/components/card-testimonial', null, $block_attr);
                                        ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <?php if($slider_items_total > 1) : ?>
                        <div class="testimonials__dots slider__dots slider-nav" data-glide-el="controls[nav]">
                            <?php $page_counter = 0; foreach($block_data['items'] as $testimonial) : ?>
                                <button class="slider__dot slider-nav__item" data-glide-dir="=<?php echo $page_counter; ?>"></button>
                                <?php $page_counter++; ?>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <?php if($slider_items_total > 1) : ?>
                    <div class="testimonials__slider-arrows slider-controls" data-glide-el="controls" data-sal="slide-up" data-sal-delay="400">
                        <button class="slider-controls__arrow slider-controls__arrow--prev js-testimonials-slider-prev" data-glide-dir="<" title="<?php _e( 'Previous slide', 'algorigin-theme' ); ?>"><?php icon_svg('arrow-left', 'slider-controls__icon'); ?></button>
                        <button class="slider-controls__arrow slider-controls__arrow--next js-testimonials-slider-next" data-glide-dir=">" title="<?php _e( 'Next slide', 'algorigin-theme' ); ?>"><?php icon_svg('arrow-right', 'slider-controls__icon'); ?></button>
                    </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>