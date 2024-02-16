<?php
    /**
     * INSTAGRAM BLOCK
     * @param block_classes string (optional) - pass additional classes for the section element
    **/


    // Get block data
    $block_data = get_field('instagram_block', 'options')['block_instagram'];

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }

    if(empty($block_data['text'])) {
        $block_data['text'] = __( 'Follow us', 'algorigin-theme' );
    }

    $animation_timings = [
        0 => 0,
        1 => 400,
        2 => 200,
        3 => 500,
        4 => 300,
        5 => 200,
        6 => 500,
        7 => 300,
        8 => 600,
        9 => 400
    ];
    
    if(!empty($block_data['photos'])) {
        if(!empty($block_data['photo_display_style'])) {
            shuffle($block_data['photos']);
        }
        array_slice($block_data['photos'], 0, 9);
        foreach($block_data['photos'] as $key => $photo) {
            $block_data['photos'][$key] = theme_get_wp_image($photo['photo'], 'product-thumb', 'instagram__img', __('Instagram photo', 'algorigin-theme'));
        }
    }
?>


<section class="instagram<?php echo $block_classes; ?>">
    <?php if(!empty($block_data['nav_anchor'])) : ?>
        <div id="<?php echo $block_data['nav_anchor']; ?>" class="scroll-anchor">&nbsp;</div>
    <?php endif; ?>

    <div class="container container--xl">
        <div class="instagram__inner">
            <?php if(!empty($block_data['photos'])) : ?>
            <ul class="instagram__items">
                <?php foreach($block_data['photos'] as $key => $photo) : ?>
                <li class="instagram__item" data-sal="fade-in" data-sal-delay="<?php echo $animation_timings[$key]; ?>">
                    <?php echo $photo; ?>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <div class="instagram__label-wrap">
                <a href="https://instagram.com/<?php echo $block_data['handle']; ?>" target="_blank" class="instagram__label" title="<?php echo __( 'Visit our instagram page', 'algorigin-theme' ); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/icon-instagram-colored.svg" alt="<?php echo __( 'Instagram icon', 'algorigin-theme' ); ?>" class="instagram__icon">
                    <h4 class="instagram__title"><?php echo $block_data['text']; ?></h4>
                    <p class="instagram__subtitle">@<?php echo $block_data['handle']; ?></p>
                </a>
            </div>
        </div>
    </div>
</section>