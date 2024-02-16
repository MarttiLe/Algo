<?php
    /**
     * HERO BLOCK
     * @param block_classes string (optional) - pass additional classes for the section element
    **/


    // Get block data
    $block_data = get_field('block_hero');

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }


    // Manage block details
    $button_text = __( 'Choose your algae', 'algorigin-theme' );
    if(!empty($block_data['button']['title'])) {
        $button_text = $block_data['button']['title'];
    }

    $image = '';
    if(!empty($block_data['image'])) {
        $image = theme_get_wp_image($block_data['image'], '720p', 'hero__img', __( 'Algorigin product bottles', 'algorigin-theme' ), false, ['sal' => 'slide-up', 'sal-delay' => 200]);
    }

    $button_target = '';
    if(!empty($block_data['button']['target'])) {
        $button_target = ' target="_blank" rel="noopener"';
    }
?>


<section class="hero" data-sal="fade-in">
    <?php if(!empty($block_data['nav_anchor'])) : ?>
        <div id="<?php echo $block_data['nav_anchor']; ?>" class="scroll-anchor">&nbsp;</div>
    <?php endif; ?>
    
    <div class="container">
        <div class="hero__inner">

            <div class="hero__content">
                <h1 class="hero__title h1" data-sal="slide-up"><?php echo $block_data['title']; ?></h1>

                <?php if(!empty($image)) : ?>
                    <?php echo $image; ?>
                <?php endif; ?>

                <?php if(!empty($block_data['button']['url'])) : ?>
                <div class="hero__actions actions" data-sal="slide-up" data-sal-delay="300">
                    <a href="<?php echo $block_data['button']['url']; ?>" class="button button--color-accent button--wide"<?php echo $button_target; ?>><?php echo $button_text; ?></a>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>