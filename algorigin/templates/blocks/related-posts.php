<?php
    /**
     * RELATED POSTS BLOCK
     * @param block_classes string (optional) - pass additional classes for the section element
    **/


    // Get block data
    $block_data = get_field('block_related_posts');

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }


    // Manage block details
    if(empty($block_data['title'])) {
        $block_data['title'] = __( 'Related posts', 'algorigin-theme' );
    }

    $post_amount = 3;
    if(!empty($block_data['amount_of_posts'])) {
        $post_amount = $block_data['amount_of_posts'];
    }
    switch($block_data['posts_display_type']) {
        case 'manual':
            $blog_items = new WP_Query([
                'post__in'          => $block_data['posts'],
                'post_type'         => 'post',
                'status'            => 'publish',
                'suppress_filters'  => false
            ]);
            break;
        case 'random':
            $blog_items = new WP_Query([
                'post_type'         => 'post',
                'status'            => 'publish',
                'posts_per_page'    => $post_amount,
                'orderby'           => 'rand',
                'suppress_filters'  => false
            ]);
            break;
        case 'newest':
            $blog_items = new WP_Query([
                'post_type'         => 'post',
                'status'            => 'publish',
                'posts_per_page'    => $post_amount,
                'suppress_filters'  => false
            ]);
            break;
    }
?>


<section class="related-posts<?php echo $block_classes; ?>">
    <?php if(!empty($block_data['nav_anchor'])) : ?>
        <div id="<?php echo $block_data['nav_anchor']; ?>" class="scroll-anchor">&nbsp;</div>
    <?php endif; ?>

    <div class="container container--md">
        <h2 class="related-posts__title h3"><?php echo $block_data['title']; ?></h2>

        <?php if($blog_items->have_posts()) : ?>
            <?php $animation_delay = 100; ?>
            <ul class="blog-preview__items blog-list">
                
                <?php while($blog_items->have_posts()) : ?>
                    <?php 
                        $blog_items->the_post(); 
                        $animation_delay = $animation_delay + 200;
                    ?>
                        
                    <li class="blog-list__item" data-sal="slide-up" data-sal-delay="<?php echo $animation_delay; ?>">
                        <?php get_template_part('templates/components/card-blog'); ?>
                    </li>

                    <?php wp_reset_postdata(); ?>
                <?php endwhile; ?>
            </ul>
        <?php else : ?>
            <div class="alert-bar alert-bar--white is-active"><p class="alert-bar__text"><?php echo __( 'There are currently no posts available', 'algorigin-theme' ); ?></p></div>
        <?php endif; ?>
    </div>
</section>