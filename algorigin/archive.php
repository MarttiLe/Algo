<?php
    $term = get_queried_object();
    $posts_per_page = get_option('posts_per_page');
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

    $blog_items = new WP_Query([
        'post_type'         => 'post',
        'status'            => 'publish',
        'posts_per_page'    => $posts_per_page,
        'paged'             => $paged,
        'order'             => 'DESC',
        'suppress_filters'  => false,
        'tax_query'         => [
            [
                'taxonomy'  => 'category',
                'terms'     =>  $term->term_id
            ]
        ]
    ]);
    $is_final_page = false;
	if($paged >= $blog_items->max_num_pages) {
		$is_final_page = true;
	}

    $categories = get_categories([
        'hide_empty'    => true,
        'exclude'       => 1
    ]);

    $page_refs = get_field('page_refs', 'options');
    $blog_page_url = get_permalink($page_refs['blog']);
?>

<?php get_header(); ?>


<?php
    $block_attr = [
        'skip_acf_data' => true,
        'title'         => get_the_archive_title(),
        'color_scheme'  => 'dark'
    ];
    get_template_part('templates/blocks/page-heading', null, $block_attr);
?>


<section class="blog page-content">
    <div class="container">

        <?php if(!empty($categories)) : ?>
        <div class="blog__categories">
            <ul class="category-list">
                <?php foreach($categories as $category) : ?>
                <li class="category-list__item">
                    <a href="<?php echo get_term_link($category->term_id, 'category'); ?>" class="category-list__anchor more-link" data-text="<?php echo $category->cat_name; ?>"><?php echo $category->cat_name; ?></a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="blog__categories-mobile">
            <select name="blog-categories" class="blog__category-select js-nav-select">
                <option value="<?php echo $blog_page_url; ?>"><?php echo __( 'All categories', 'algorigin-theme' ); ?></option>
                <?php foreach($categories as $category) : ?>
                    <option value="<?php echo get_term_link($category->term_id, 'category'); ?>"<?php if($category->term_id === $term->term_id) { echo ' selected'; } ?>><?php echo $category->cat_name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php endif; ?>

        <?php if($blog_items->have_posts()) : ?>
            <?php $animation_delay = 100; ?>
            <ul class="blog__items blog-list js-loadmore-posts-container">
                <?php while($blog_items->have_posts()) : ?>
                    <?php 
                        $blog_items->the_post(); 
                        $animation_delay = $animation_delay + 200;
                        if($animation_delay > 700) {
                            $animation_delay = 300;
                        }
                    ?>
                        
                    <li class="blog-list__item" data-sal="slide-up" data-sal-delay="<?php echo $animation_delay; ?>">
                        <?php get_template_part('templates/components/card-blog'); ?>
                    </li>

                    <?php wp_reset_postdata(); ?>
                <?php endwhile; ?>
            </ul>

            <?php if(!$is_final_page) : ?>
            <div class="blog__actions" data-sal="slide-up">
                <button class="blog__loadmore button loadmore-button js-loadmore-posts" data-category="<?php echo $term->term_id; ?>"><?php echo __( 'Load more posts', 'algorigin-theme' ); ?></button>
            </div>
            <?php endif; ?>
        <?php else : ?>
        <div class="blog__alert" data-sal="slide-up"><?php echo __( 'There are currently no posts available', 'algorigin-theme' ); ?></div>
        <?php endif; ?>

    </div>
</section>


<?php get_footer(); ?>