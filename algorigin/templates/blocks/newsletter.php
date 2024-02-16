<?php
    /**
     * NEWSLETTER MAILING LIST SUBSCRIPTION BLOCK
     * @param block_classes string (optional) - pass additional classes for the section element
    **/


    // Get block data
    $block_data = get_field('block_newsletter', get_queried_object());

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }


    // Manage block details
    $newsletter_image = wp_get_attachment_image_url($block_data['image'], 'newsletter-thumb');
?>


<section class="newsletter<?php echo $block_classes; ?>">
    <?php if(!empty($block_data['nav_anchor'])) : ?>
        <div id="<?php echo $block_data['nav_anchor']; ?>" class="scroll-anchor">&nbsp;</div>
    <?php endif; ?>

    <div class="container">
        <div class="newsletter__inner">
            <div class="newsletter__main" data-sal="slide-up" data-sal-delay="100">
                <h2 class="newsletter__title h1"><?php echo $block_data['title']; ?></h2>

                <?php if(!empty($block_data['text'])) : ?>
                <p class="newsletter__text"><?php echo $block_data['text']; ?></p>
                <?php endif; ?>

                <?php if(!empty($block_data['form_shortcode'])) : ?>
                <div class="newsletter__form">
                                    
                    <?php echo do_shortcode($block_data['form_shortcode']); ?>
                    
                </div>
                <?php endif; ?>
            </div>

            <div class="newsletter__aside" data-sal="slide-up" data-sal-delay="300">
                <h2 class="newsletter__title-mobile h1"><?php echo $block_data['title']; ?></h2>

                <div class="newsletter__illustration">
                    <img src="<?php echo $newsletter_image; ?>" alt="<?php echo __( 'Photo of the e-book cover', 'algorigin-theme' ); ?>" class="newsletter__img">
                    <img src="<?php echo $newsletter_image; ?>" alt="<?php echo __( 'Photo of the e-book cover', 'algorigin-theme' ); ?>" class="newsletter__img">
                </div>
            </div>
        </div>
    </div>
</section>