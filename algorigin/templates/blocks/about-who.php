<?php
    /**
     * ABOUT PAGE "WHO WE ARE" BLOCK
     * @param block_classes string (optional) - pass additional classes for the section element
    **/


    // Get block data
    $block_data = get_field('block_who_we_are');

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }

    if(!empty($block_data['video_thumbnail'])) {
        $block_data['video_thumbnail'] = wp_get_attachment_image_url($block_data['video_thumbnail'], '720p');
    }
?>


<section class="who-we-are<?php echo $block_classes; ?>">
    <?php if(!empty($block_data['nav_anchor'])) : ?>
        <div id="<?php echo $block_data['nav_anchor']; ?>" class="scroll-anchor">&nbsp;</div>
    <?php endif; ?>

    <div class="container container--sm">
        <div class="who-we-are__inner">
            <?php if(!empty($block_data['title'])) : ?>
            <h2 class="who-we-are__title h2"><?php echo $block_data['title']; ?></h2>
            <?php endif; ?>

            <?php if(!empty($block_data['content'])) : ?>
            <div class="editor-content">
                <?php echo $block_data['content']; ?>
            </div>
            <?php endif; ?>
        </div>

        <?php if(!empty($block_data['video_url'])) : ?>
        <div class="who-we-are__player" style="background-image:url(<?php echo $block_data['video_thumbnail']; ?>);">
            <div class="who-we-are__play">
                <button class="play-button js-modal-toggle" data-modal-id="story-video" title="<?php echo __( 'Watch video', 'algorigin-theme' ); ?>">
                    <?php icon_svg('play', 'play-button__icon'); ?>
                </button>
                <div class="play-tooltip">
                    <div class="tooltip"><?php echo __( 'Watch video introduction', 'algorigin-theme' ); ?></div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="who-we-are__inner">
            <?php if(!empty($block_data['title_2'])) : ?>
            <h2 class="who-we-are__title h2"><?php echo $block_data['title_2']; ?></h2>
            <?php endif; ?>

            <?php if(!empty($block_data['icon_list'])) : ?>
            <ul class="who-we-are__list icon-items-list">
                <?php foreach($block_data['icon_list'] as $item) : ?>
                <li class="icon-items-list__item">
                    <div class="icon-items-list__icon-wrap"><?php echo icon_svg($item['icon'], 'icon-items-list__icon'); ?></div>
                    <h3 class="icon-items-list__title"><?php echo $item['title']; ?></h3>
                    <div class="icon-items-list__text"><?php echo $item['text']; ?></div>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>

    <?php if(!empty($block_data['video_url'])) : ?>
    <div id="story-video" class="modal js-modal">
        <div class="modal__inner video-modal">
            <div class="video-modal__content video-player">
                <iframe class="video-player__iframe" width="100%" height="100%" src="<?php echo $block_data['video_url']; ?>" title="<?php echo __( 'Algorigin introduction video', 'algorigin-theme' ); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>

        <button class="modal__close js-modal-close" title="<?php echo __( 'Close modal', 'algorigin-theme' ); ?>"><?php icon_svg('close', 'modal__icon'); ?></button>
    </div>
    <?php endif; ?>
</section>