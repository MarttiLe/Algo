<?php
    /**
     * SOCIAL SHARE
     * @param block_classes string (optional) - pass additional classes for the block
    **/

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }
?>


<div class="social-share<?php echo $block_classes; ?>">
    <div class="social-share__title"><?php echo __( 'Share this post', 'algorigin-theme' ); ?>:</div>
    <ul class="social-share__items">
        <li class="social-share__item"><a href="<?php echo theme_get_social_share_url('facebook'); ?>" target="_blank" rel="noopener" class="social-share__anchor" title="<?php echo __( 'Share this story on Facebook', 'algorigin-theme' ); ?>"><?php icon_svg('socials-fb', 'social-share__icon'); ?></a></li>
        <li class="social-share__item"><a href="<?php echo theme_get_social_share_url('twitter'); ?>" target="_blank" rel="noopener" class="social-share__anchor" title="<?php echo __( 'Share this story on Twitter', 'algorigin-theme' ); ?>"><?php icon_svg('socials-tw', 'social-share__icon'); ?></a></li>
        <li class="social-share__item"><a href="<?php echo theme_get_social_share_url('linkedin'); ?>" target="_blank" rel="noopener" class="social-share__anchor" title="<?php echo __( 'Share this story on LinkedIn', 'algorigin-theme' ); ?>"><?php icon_svg('socials-in', 'social-share__icon'); ?></a></li>
    </ul>
</div>