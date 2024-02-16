<?php
    /**
     * BLOG PREVIEW BLOCK
     * @param block_classes string (optional) - pass additional classes for the section element
    **/


    // Get block data
    $block_data = get_field('block_blog_preview');

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }


    // Manage block details
    if($block_data['select_posts_manually']) {
        $blog_items = new WP_Query([
            'post__in'          => $block_data['posts'],
            'post_type'         => 'advice',
            'status'            => 'publish',
            'suppress_filters'  => false
        ]);
    } else {
        $post_amount = 3;
        if(!empty($block_data['amount_of_posts'])) {
            $post_amount = $block_data['amount_of_posts'];
        }

        $blog_items = new WP_Query([
            'post_type'         => 'post',
            'status'            => 'publish',
            'posts_per_page'    => $post_amount,
            'suppress_filters'  => false
        ]);
    }

    $page_refs = get_field('page_refs', 'options');
?>


<section class="blog-preview<?php echo $block_classes; ?>">
    <?php if(!empty($block_data['nav_anchor'])) : ?>
        <div id="<?php echo $block_data['nav_anchor']; ?>" class="scroll-anchor">&nbsp;</div>
    <?php endif; ?>

    <div class="container">
        <div class="blog-preview__inner">
            <div class="section-heading section-heading--has-options" data-sal="slide-up">
                <h2 class="blog-preview__title section-heading__title h1"><?php echo $block_data['title']; ?></h2>
                
                <div class="section-heading__options">
                    <a href="<?php echo get_permalink($page_refs['blog']); ?>" class="more-link" data-text="<?php echo __( 'View all posts', 'algorigin-theme' ); ?>"><?php echo __( 'View all posts', 'algorigin-theme' ); ?></a>
                </div>
            </div>

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
    </div>
</section>