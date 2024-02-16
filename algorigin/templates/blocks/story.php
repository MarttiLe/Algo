<?php
    /**
     * STORY BLOCK
     * @param block_classes string (optional) - pass additional classes for the section element
    **/


    // Get block data
    $block_data = get_field('block_story');

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }


    // Manage block details
    $button_text = __( 'Read more about Algorigin', 'algorigin-theme' );
    if(!empty($block_data['link']['title'])) {
        $button_text = $block_data['link']['title'];
    }

    $background_image = '';
    if(!empty($block_data['image'])) {
        $background_image = wp_get_attachment_image_url($block_data['image'], '720p');
        $background_image = ' style="background-image: url('. $background_image .');"';
    }

    $button_target = '';
    if(!empty($block_data['link']['target'])) {
        $button_target = ' target="_blank" rel="noopener"';
    }
?>


<section class="story<?php echo $block_classes; ?>">
    <?php if(!empty($block_data['nav_anchor'])) : ?>
        <div id="<?php echo $block_data['nav_anchor']; ?>" class="scroll-anchor">&nbsp;</div>
    <?php endif; ?>
    
    <div class="container">
        <div class="story__inner">
            <div class="story__main" data-sal="slide-up" data-sal-delay="100">
                <h2 class="story__title h1"><?php echo $block_data['title']; ?></h2>

                <?php if(!empty($block_data['quote']['text'])) : ?>
                <blockquote>
                    <p class="story__text"><?php echo $block_data['quote']['text']; ?></p>
                    
                    <?php if(!empty($block_data['quote']['author'])) : ?>
                    <cite><?php echo $block_data['quote']['author']; ?></cite>
                    <?php endif; ?>
                </blockquote>
                <?php endif; ?>

                <?php if(!empty($block_data['link']['url'])) : ?>
                <div class="story__actions">
                    <a href="<?php echo $block_data['link']['url']; ?>" class="story__more more-link" data-text="<?php echo $button_text; ?>"<?php echo $button_target; ?>><?php echo $button_text; ?></a>
                </div>
                <?php endif; ?>
            </div>

            <div class="story__aside" data-sal="slide-up" data-sal-delay="300">
                <h2 class="story__title-mobile h1"><?php echo $block_data['title']; ?></h2>

                <div class="story__player"<?php echo $background_image; ?>>
                    <?php if(!empty($block_data['video'])) : ?>
                    <div class="story__play">
                        <button class="play-button js-modal-toggle" data-modal-id="story-video" title="<?php echo __( 'Watch video', 'algorigin-theme' ); ?>">
                            <?php icon_svg('play', 'play-button__icon'); ?>
                        </button>
                        <div class="play-tooltip">
                            <div class="tooltip"><?php echo __( 'Watch video introduction', 'algorigin-theme' ); ?></div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php if(!empty($block_data['video'])) : ?>
    <div id="story-video" class="modal js-modal">
        <div class="modal__inner video-modal">
            <div class="video-modal__content video-player">
                <iframe class="video-player__iframe" width="100%" height="100%" src="<?php echo $block_data['video']; ?>" title="<?php echo __( 'Algorigin introduction video', 'algorigin-theme' ); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>

        <button class="modal__close js-modal-close" title="<?php echo __( 'Close modal', 'algorigin-theme' ); ?>"><?php icon_svg('close', 'modal__icon'); ?></button>
    </div>
    <?php endif; ?>
</section>