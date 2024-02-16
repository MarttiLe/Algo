<?php
    /**
     * TESTIMONIAL CARD
     * @param block_classes string (optional) - pass additional classes for the element
    **/

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }

    if(empty($args['testimonial_data'])) {
        return;
    }

    $block_data = $args['testimonial_data'];

    $block_data['photo'] = wp_get_attachment_image_url($block_data['photo'], 'profile-thumb');
?>

<div class="testimonial-card" style="background-image: url('<?php echo $block_data['photo']; ?>');">
    <div class="testimonial-card__inner">

        <div class="testimonial-card__info">
            <h3 class="testimonial-card__title h2"><?php echo $block_data['name']; ?></h3>

            <?php if(!empty($block_data['subtitle'])) : ?>
            <div class="testimonial-card__subtitle"><?php echo $block_data['subtitle']; ?></div>
            <?php endif; ?>

            <p class="testimonial-card__text"><?php echo $block_data['text']; ?></p>

            <?php if(!empty($block_data['read_more_link']['url'])) : ?>
                <?php
                
                    $link_target = '';
                    if(!empty($block_data['read_more_link']['target'])) {
                        $link_target = ' target="_blank" rel="noopener"';
                    }

                    $link_text = __( 'Read more', 'algorigin-theme' );
                    if(!empty($block_data['read_more_link']['title'])) {
                        $link_text = $block_data['read_more_link']['title'];
                    }
                ?>
                <div class="testimonial-card__actions">
                    <a href="<?php echo $block_data['read_more_link']['url']; ?>" class="testimonial-card__more"<?php echo $link_target; ?>><?php echo $link_text; ?></a>
                </div>
            <?php endif; ?>

            <?php if(!empty($block_data['contacts']['facebook']) || !empty($block_data['contacts']['instagram']) || !empty($block_data['contacts']['twitter']) || !empty($block_data['contacts']['linkedin'])) : ?>
            <ul class="testimonial-card__socials socials-list">
                <?php if(!empty($block_data['contacts']['facebook'])) : ?>
                <li class="socials-list__item"><a href="<?php echo $block_data['contacts']['facebook']; ?>" target="_blank" rel="noopener" class="social-link" title="<?php echo __( 'Visit Facebook profile', 'algorigin-theme' ); ?>"><?php icon_svg('socials-fb', 'social-link__icon'); ?></a></li>
                <?php endif; ?>

                <?php if(!empty($block_data['contacts']['instagram'])) : ?>
                <li class="socials-list__item"><a href="<?php echo $block_data['contacts']['instagram']; ?>" target="_blank" rel="noopener" class="social-link" title="<?php echo __( 'Visit Twitter profile', 'algorigin-theme' ); ?>"><?php icon_svg('socials-ig', 'social-link__icon'); ?></a></li>
                <?php endif; ?>
                
                <?php if(!empty($block_data['contacts']['twitter'])) : ?>
                <li class="socials-list__item"><a href="<?php echo $block_data['contacts']['twitter']; ?>" target="_blank" rel="noopener" class="social-link" title="<?php echo __( 'Visit Instagram profile', 'algorigin-theme' ); ?>"><?php icon_svg('socials-tw', 'social-link__icon'); ?></a></li>
                <?php endif; ?>

                <?php if(!empty($block_data['contacts']['linkedin'])) : ?>
                <li class="socials-list__item"><a href="<?php echo $block_data['contacts']['linkedin']; ?>" target="_blank" rel="noopener" class="social-link" title="<?php echo __( 'Visit LinkedIn profile', 'algorigin-theme' ); ?>"><?php icon_svg('socials-in', 'social-link__icon'); ?></a></li>
                <?php endif; ?>
            </ul>
            <?php endif; ?>
        </div>

    </div>
</div>