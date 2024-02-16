<?php 
    /**
     * PRODUCT CATEGORIES NAV SIDEBAR
     * @param block_classes string (optional) - pass additional classes for the block
     * @param title string (optional) - pass to show a title, defaults to "Categories"
     * @param taxonomy string (optional) - pass to change the query taxonomy
     * @param exclude array (optional) - pass an array of IDs (int) which need to be excluded from the query
     * @param current_term int (optional) - pass the ID of the current category
     * @param display_shop_link bool (optional) - show/hide the link to all categories (shop page)
    **/


    // Manage block details
    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }

    $title = __( 'Categories', 'algorigin-theme' );
    $taxonomy = 'product_cat';
    $exclude = [];
    $display_shop_link = false;
    
    $is_category = false;
    $current_term = get_queried_object();
    if(property_exists($current_term, 'term_id')) {
        $is_category = true;
        $current_term = $current_term->term_id;
    } else {
        $current_term = '';
    }

    if(!empty($args['title'])) {
        $title = $args['title'];
    }

    if(!empty($args['taxonomy'])) {
        $taxonomy = $args['taxonomy'];
    }

    if(!empty($args['exclude'])) {
        $exclude = $args['exclude'];
    }

    if(!empty($args['current_term'])) {
        $is_category = true;
        $current_term = $args['current_term'];
    }

    if(!empty($args['display_shop_link'])) {
        $display_shop_link = true;
    }

    $categories = get_terms([
        'taxonomy'   => $taxonomy,
        'exclude'    => $exclude,
        'hide_empty' => false
    ]);

    if($display_shop_link) {
        $page_refs = get_field('page_refs', 'options');
        $shop_page_url = get_permalink($page_refs['shop']);
        $total_product_count = theme_get_total_product_count();
    }
?>


<?php if(!empty($categories)) : ?>
<div class="sidebar-categories<?php echo $block_classes; ?>">
    <p class="sidebar-categories__title"><?php echo $title; ?>:</p>

    <ul class="sidebar-categories__items">
        <?php if($display_shop_link) : ?>
            <li class="sidebar-categories__item<?php if(!$is_category) { echo ' is-active'; } ?>"><a href="<?php echo $shop_page_url; ?>" class="sidebar-categories__anchor"><?php echo __( 'All products', 'algorigin-theme' ); ?></a><span class="sidebar-categories__amount">(<?php echo $total_product_count; ?>)</span></li>
        <?php endif; ?>

        <?php foreach($categories as $category) : ?>
            <?php 
                $item_classes = '';
                if($category->term_id === $current_term) {
                    $item_classes = ' is-active';
                }
            ?>
            <li class="sidebar-categories__item<?php echo $item_classes; ?>"><a href="<?php echo get_term_link($category->term_id, $taxonomy); ?>" class="sidebar-categories__anchor"><?php echo $category->name; ?></a><span class="sidebar-categories__amount">(<?php echo $category->count; ?>)</span></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>