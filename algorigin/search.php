<?php get_header(); ?>


<?php
    $search_query = get_search_query();

    $search_items = new WP_Query([
        'post_type'         => ['post', 'page', 'product'],
        'posts_per_page'    => -1,
        'status'            => 'publish',
        's'                 => $search_query,
        'order'             => 'DESC',
        'suppress_filters'  => false
    ]);
    $search_items = $search_items->posts;
?>


<?php
    // PAGE HEADING
    $block_attr = [
        'skip_acf_data'     => true,
        'title'             => __( 'Search results', 'algorigin-theme' ),
        'subtitle'          => __( 'For the term', 'algorigin-theme' ) . ' <span class="search-query">'. $search_query .'</span>',
        'color_scheme'      => 'dark',
        'hide_breadcrumb'   => true
    ];
    get_template_part('templates/blocks/page-heading', null, $block_attr);
?>


<div class="search-results page-content">
    <div class="container container--sm">
        <div class="search-results__inner">
            <?php if(!empty($search_items)) : ?>
            <ul class="search-results__items">
                <?php foreach($search_items as $search_item) : ?>
                <?php
                    $post_type = get_post_type($search_item->ID);
                    switch($post_type) {
                        case 'post' :
                            $post_type = __('Blog post', 'algorigin-theme');
                            break;
                        case 'page' : 
                            $post_type = __('Page', 'algorigin-theme');
                            break;
                        case 'product' : 
                            $post_type = __('Product', 'algorigin-theme');
                            break;
                    }
                    $url = get_permalink($search_item->ID);
                    $excerpt = theme_get_excerpt($search_item->ID, 300);

                    $breadcrumbs = theme_breadcrumbs_list('search-results__breadcrumb', false, $search_item->ID);
                ?>
                <li class="search-results__item search-result-card">
                    <div class="search-result-card__inner">
                        <h2 class="search-result-card__title"><a href="<?php echo $url; ?>" class="search-result-card__anchor"><?php echo $search_item->post_title; ?></a></h2>

                        <p class="search-result-card__type"><?php echo $post_type; ?></p>

                        <?php //echo $breadcrumbs; ?>
                        
                        <?php if(!empty($excerpt)) : ?>
                        <p class="search-result-card__excerpt"><?php echo $excerpt; ?></p>
                        <?php endif; ?>

                        <div class="search-result-card__actions">
                            <a href="<?php echo $url; ?>" class="button button--color-accent button--icon-only-sm button--round button--icon-animated" title="<?php echo __( 'Read more', 'algorigin-theme' ); ?>"><?php icon_svg('arrow-right', 'button__icon'); ?></a>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <div class="search-results__actions">
                <?php if(!empty($search_items)) : ?>
                <p class="search-results__actions-text"><?php echo __( "Didn't find what you were looking for?", 'algorigin-theme' ); ?></p>
                <?php else : ?>
                <p class="search-results__error"><?php echo __( "Unfortunately we didn't find anything that matches your query", 'algorigin-theme' ); ?></p>
                <?php endif; ?>
                <button class="button button--color-accent button--icon-left js-searchbar-toggle"><?php icon_svg('search', 'button__icon'); ?><?php echo __( 'Try a different term', 'algorigin-theme' ); ?></button>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>