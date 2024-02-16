<?php
    /**
     * AMBASSADORS BLOCK
     * @param block_classes string (optional) - pass additional classes for the section element
    **/


    // Get block data
    $block_data = get_field('block_ambassadors');

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }


    // Manage block details

?>


<section class="ambassadors<?php echo $block_classes; ?>">
    <?php if(!empty($block_data['nav_anchor'])) : ?>
        <div id="<?php echo $block_data['nav_anchor']; ?>" class="scroll-anchor">&nbsp;</div>
    <?php endif; ?>
    
    <?php if(!empty($block_data['items'])) : ?>
        <?php foreach($block_data['items'] as $item) : ?>
            <?php
                $photo = theme_get_wp_image($item['photo'], 'product-thumb-lg', 'ambassador-card__img');
            ?>
            <div class="ambassadors__item">
                <div class="container">
        
                    <div class="ambassador-card">
                        <?php if(!empty($item['nav_anchor'])) : ?>
                            <div id="<?php echo $item['nav_anchor']; ?>" class="scroll-anchor">&nbsp;</div>
                        <?php endif; ?>

                        <div class="ambassador-card__heading" data-sal="slide-up">
                            <h2 class="ambassador-card__title h3"><?php echo $item['name']; ?></h2>
                            <div class="ambassador-card__subtitle"><?php echo $item['subtitle']; ?></div>
                        </div>

                        <div class="ambassador-card__inner">
                            <div class="ambassador-card__photo" data-sal="slide-up" data-sal-delay="200">
                                <?php echo $photo; ?>

                                <?php if(!empty($item['photo_credit'])) : ?>
                                <p class="ambassador-card__photo-credit"><?php echo __( 'Photo credit', 'algorigin-theme' ); ?>: <?php echo $item['photo_credit']; ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="ambassador-card__content" data-sal="slide-up" data-sal-delay="400">
                                <?php if(!empty($item['quote'])) : ?>
                                <blockquote class="ambassador-card__quote"><?php echo $item['quote']; ?></blockquote>
                                <?php endif; ?>

                                <div class="editor-content"><?php echo $item['content']; ?></div>

                                <?php if(!empty($item['socials']) || !empty($item['links'])) : ?>
                                    <div class="ambassador-card__actions">
                                        <ul class="ambassador-card__socials actions actions--gaps-md actions--centered-vertically">
                                            <?php if(!empty($item['socials']['facebook'])) : ?>
                                                <li class="actions__item">
                                                    <a href="<?php echo $item['socials']['facebook']; ?>" target="_blank" class="button button--icon-only-sm button--round" title="<?php echo __( 'Visit their Facebook', 'algorigin-theme' ); ?>"><?php icon_svg('socials-fb'); ?></a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if(!empty($item['socials']['instagram'])) : ?>
                                                <li class="actions__item">
                                                    <a href="<?php echo $item['socials']['instagram']; ?>" target="_blank" class="button button--icon-only-sm button--round" title="<?php echo __( 'Visit their Instagram', 'algorigin-theme' ); ?>"><?php icon_svg('socials-ig'); ?></a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if(!empty($item['socials']['twitter'])) : ?>
                                                <li class="actions__item">
                                                    <a href="<?php echo $item['socials']['twitter']; ?>" target="_blank" class="button button--icon-only-sm button--round" title="<?php echo __( 'Visit their Twitter', 'algorigin-theme' ); ?>"><?php icon_svg('socials-tw'); ?></a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if(!empty($item['socials']['linkedin'])) : ?>
                                                <li class="actions__item">
                                                    <a href="<?php echo $item['socials']['linkedin']; ?>" target="_blank" class="button button--icon-only-sm button--round" title="<?php echo __( 'Visit their LinkedIn', 'algorigin-theme' ); ?>"><?php icon_svg('socials-ln'); ?></a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if(!empty($item['links'])) : ?>
                                                <?php foreach($item['links'] as $link) : ?>
                                                    <?php
                                                        $link_text = __( 'Read more', 'algorigin-theme' );
                                                        if(!empty($link['link']['title'])) {
                                                            $link_text = $link['link']['title'];
                                                        }

                                                        $link_target = '';
                                                        if(!empty($link['link']['target'])) {
                                                            $link_target = ' target="_blank" rel="noopener"';
                                                        }
                                                    ?>
                                                    <li class="actions__item">
                                                        <a href="<?php echo $link['link']['url']; ?>"<?php echo $link_target; ?>><?php echo $link_text; ?></a>
                                                    </li>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</section>